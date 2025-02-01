<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Plane;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with(['airline', 'plane'])->paginate(10);
        $airlines = Airline::select('id', 'name')->get();
        $planes = Plane::select('id', 'name')->get();
        $airports = Airport::select('id', 'name')->get();
        return view('dashboard.schedule.index', compact('schedules', 'airlines', 'planes','airports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'airlineid' => 'required|exists:airlines,id',
            'planesid' => 'required|exists:planes,id',
            'Status' => 'required|string',
            'departuredate' => 'required',
            'arrivaldate' => 'required',
            'departing' => 'required|string',
            'arriving' => 'required|string',
            'Status' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Schedule::create($validatedData);

        return redirect()->back()->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'airlineid' => 'required|exists:airlines,id',
            'planesid' => 'required|exists:planes,id',
            'Status' => 'required|string',
            'departuredate' => 'required',
            'arrivaldate' => 'required',
            'departing' => 'required|string',
            'arriving' => 'required|string',
            'Status' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $schedule->update($validatedData);

        return redirect()->back()->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Plane deleted successfully.');
    }
}
