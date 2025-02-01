<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userCount = User::where('role', 'user')->count();
        $airlineCount = Airline::where('status', 'Active')->count();
        $bookingCount = Booking::where('statuspay', 'Done')->count();
        $scheduleCount = Schedule::whereIn('Status', ['pending', 'landing', 'departing', 'arriving'])->count();
        $schedules = Schedule::with(['airline', 'plane'])->paginate(10);
        $today = Carbon::today();
        $schedules = \App\Models\Schedule::whereDate('departuredate', $today)->paginate(10);

        if (auth()->user()->role == 'user') {
            $bookings = Booking::where('userid', auth()->user()->id)->paginate(10);
        } else {
            $bookings = Booking::get();
        }

        return view('dashboard', compact('scheduleCount', 'userCount', 'airlineCount', 'bookingCount', 'schedules', 'bookings'));
    }

    public function landingpage () {
        $schedules = Schedule::where('status', 'pending')->with(['airline', 'plane'])->paginate(2);
        
        return view('welcome', compact('schedules'));
    }

    public function filter(Request $request)
    {
        $query = Schedule::where('status', 'pending')->with(['airline', 'plane']);
        $airports = Airport::select('id', 'name')->paginate(2);

        if ($request->departing) {
            $query->where('departing', 'like', '%' . $request->departing . '%');
        }

        if ($request->arriving) {
            $query->where('arriving', 'like', '%' . $request->arriving . '%');
        }

        if ($request->departuredate) {
            $query->where('departuredate', 'like', '%' . $request->departuredate . '%');
        }

        if ($request->arrivaldate) {
            $query->where('arrivaldate', 'like', '%' . $request->arrivaldate . '%');
        }

        $schedules = $query->paginate(2);

        return view('welcome', compact('schedules', 'airports'));
    }

}
