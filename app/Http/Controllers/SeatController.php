<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use App\Models\Seat;
use Illuminate\Cache\NoLock;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = Seat::with('plane')->paginate(10);
        $planes = Plane::select('id', 'name')->get();
        return view('dashboard.master.seat.index', compact('seats', 'planes'));
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
        $request -> validate([
            'codeseat' => 'required|string|max:255',
            'planeid' => 'required|exists:planes,id',
        ]);

        $plane = Plane::find($request->planeid);
        $totalSeat = $request->codeseat;

        $seats = [];
        for ($i = 1; $i <= $totalSeat; $i++) {
            $row = ceil($i / 5);
            $codeseat = $row . chr(64 + ($i % 5 == 0 ? 5 : $i % 5));
            $seats[] = [
                'planeid' => $plane->id,
                'codeseat' => $codeseat,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Seat::insert($seats);
    
        return redirect()->back()->with('success', 'Seat created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seat $seat)
    {
        $validatedData = $request->validate([
            'codeseat' => 'required|string|max:255',
            'planeid' => 'required|exists:planes,id',
        ]);
    
        $seat->update($validatedData);
    
        return redirect()->back()->with('success', 'Seat created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect()->back()->with('success', 'Seat deleted successfully.');
    }
}
