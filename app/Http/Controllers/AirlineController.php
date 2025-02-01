<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.master.airlines.index', [
            'airlines' => Airline::paginate(10),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:airlines|max:255',
            'code' => 'required|unique:airlines|max:7',
            'country' => 'required|max:255',
        ]);

        Airline::create($validatedData);

        return redirect()->back()->with('success', 'New Airline has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Airline $airline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airline $airline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:7',
            'country' => 'required|max:255',
            'status' => 'required',
        ]);

        $airline->where('id', $airline->id)->update($validatedData);

        return redirect()->back()->with('success', 'Airline data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        $airline->delete();
        return redirect()->back()->with('success', 'Plane deleted successfully.');
    }
}
