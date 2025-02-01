<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planes = Plane::with('airline')->paginate(10);
        $airlines = Airline::select('id', 'name')->get();
        return view ('dashboard.master.plane.index', compact('planes', 'airlines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'airlineid' => 'required|exists:airlines,id',
    ]);

    Plane::create($validatedData);

    return redirect()->back()->with('success', 'Plane created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Plane $plane)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plane $plane)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plane $plane)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'airlineid' => 'required|exists:airlines,id',
        ]);

        Plane::where('id', $plane->id)->update($validatedData);

        return redirect()->back()->with('success', 'Plane updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plane $plane)
    {
        $plane->delete();
        return redirect()->back()->with('success', 'Plane deleted successfully.');
    }
}
