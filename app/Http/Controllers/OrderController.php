<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::with(['plane.seats', 'bookings'])
            ->where('status', 'pending')
            ->paginate(4);

        $schedules->each(function ($schedule) {
            $excludedSeatIds = $schedule->bookings
                ->where('statuspay', '!=', 'rejected')
                ->pluck('seatid')
                ->filter()
                ->unique();

            $schedule->availableSeats = $schedule->plane->seats
                ->whereNotIn('id', $excludedSeatIds)
                ->count();
        });

        return view('order.index', compact('schedules'));
    }

    public function filter(Request $request)
    {
        $schedules = Schedule::where('status', 'pending')->with('airline');

        if ($request->search) {
            $schedules = $schedules->whereHas('airline', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
                $query->orWhere('code', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->departing) {
            $schedules = $schedules->where('departing', 'like', '%' . $request->departing . '%');
        }

        if ($request->arriving) {
            $schedules = $schedules->where('arriving', 'like', '%' . $request->arriving . '%');
        }

        if ($request->departuredate) {
            $schedules = $schedules->where('departuredate', 'like', '%' . $request->departuredate . '%');
        }

        if ($request->arrivaldate) {
            $schedules = $schedules->where('arrivaldate', 'like', '%' . $request->arrivaldate . '%');
        }

        $schedules = $schedules->paginate(4);

        return view('order.index', compact('schedules'));
    }

    public function create(Request $request)
    {
        $scheduleId = $request->schedule_id;
        $schedule = Schedule::with('plane.seats')->findOrFail($scheduleId);
        $payments = Payment::all();

        $hasBookings = Schedule::where('id', $schedule->id)->where('status', '!=', 'pending')->exists();

        if ($hasBookings) {
            return redirect()->route('order.index')->with('error', 'Schedule is not available for booking.');
        }

        $bookedSeats = \App\Models\Booking::where('scheduleid', $schedule->id)
            ->where('statuspay', '!=', 'Rejected')
            ->pluck('seatid')
            ->toArray();

        $seats = $schedule->plane->seats->map(function ($seat) use ($bookedSeats) {
            $seat->is_booked = in_array($seat->id, $bookedSeats);
            return $seat;
        });

        return view('order.create', compact('schedule', 'payments', 'seats'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'scheduleid' => 'required|exists:schedules,id',
            'seatid' => 'required|exists:seats,id',
            'paymentid' => 'required|exists:payments,id',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $ticketNumber = $this->generateTicketNumber();

        $BuktiPembayaranpath = null;

        if ($request->hasFile('bukti_pembayaran')) {
            $BuktiPembayaranpath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $request->merge([
            'noticket' => $ticketNumber,
            'bukti_pembayaran' => $BuktiPembayaranpath,
        ]);

        Booking::create([
            'userid' => $request->user()->id,
            'scheduleid' => $request->scheduleid,
            'seatid' => $request->seatid,
            'noticket' => $ticketNumber,
            'paymentid' => $request->paymentid,
            'bukti_pembayaran' => $BuktiPembayaranpath
        ]);

        return redirect()->route('order.index')->with('success', 'Order created successfully with Ticket Number: ' . $ticketNumber);
    }


    public function generateTicketNumber()
    {
        $now = now();
        $year = $now->year;
        $month = str_pad($now->month, 2, '0', STR_PAD_LEFT);
        $day = str_pad($now->day, 2, '0', STR_PAD_LEFT);

        $dateCode = $year . $month . $day;

        $latestOrder = Booking::where('noticket', 'like', "$dateCode%")
            ->latest('created_at')
            ->first();

        if ($latestOrder) {
            $lastTicket = (int) substr($latestOrder->noticket, 8);

            $newCode = str_pad($lastTicket + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = '001';
        }
        return $dateCode . $newCode;
    }
}
