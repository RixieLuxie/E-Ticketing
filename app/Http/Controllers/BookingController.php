<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Schedule;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $bookings = Booking::with(['schedule'])->where('statuspay', 'Pending')->paginate(3);
        } else {
            $bookings = Booking::with(['schedule'])->where('userid', auth()->user()->id)->paginate(3);
        }

        return view('dashboard.booking.index', compact('bookings'));
    }

    public function approve(Booking $booking)
    {
        $booking->update([
            'statuspay' => 'Done'
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking Approved');
    }

    public function decline(Booking $booking)
    {
        $booking->update([
            'statuspay' => 'Rejected'
        ]);
        return redirect()->route('booking.index')->with('success', 'Booking Declined');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function preview(Request $request, $booking_id)
    {
        $bookings = Booking::with(['payment', 'schedule'])->find($booking_id);
        $payments = Payment::all();

        return view('dashboard.booking.preview', compact('payments', 'bookings'));
    }

    public function filter(Request $request)
    {
        $query = Booking::where('userid', auth()->user()->id);

        if ($request->has('status') && !empty($request->status)) {
            $query->whereHas('schedule', function ($query) use ($request) {
                $query->where('status', $request->status);
            });
        }

        if ($request->has('statuspay') && !empty($request->statuspay)) {
            $query->where('statuspay', $request->statuspay);
        }

        $bookings = $query->paginate(3)->appends($request->query());

        return view('dashboard.booking.index', compact('bookings'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
