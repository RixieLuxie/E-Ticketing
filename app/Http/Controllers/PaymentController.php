<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::paginate(10);
        return view('dashboard.master.payment.index', compact('payments'));
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

    $request->validate([
        'logo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'name' => 'required|string|max:255',
        'nomortujuan' => 'required|string|max:255',
    ]);

    $logopath = null;

    if ($request->hasFile('logo')) {
        $logopath = $request->file('logo')->store('logo_payments', 'public');
    }

    Payment::create([
        'name' => $request->name,
        'nomortujuan' => $request->nomortujuan,
        'logo' => $logopath,
    ]);

    return redirect()->back()->with('success', 'Payment data created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'name' => 'required|string|max:255',
            'nomortujuan' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            // Hapus bukti pembayaran lama jika ada
            if ($payment->logo) {
                Storage::disk('public')->delete($payment->logo);
            }
            $logopath = $request->file('logo')->store('logo_payments', 'public');
            $validatedData['logo'] = $logopath;
        }

        $payment->update($validatedData);

        return redirect()->back()->with('success', 'Payment data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->back()->with('success', 'Payment data deleted successfully.');
    }
}
