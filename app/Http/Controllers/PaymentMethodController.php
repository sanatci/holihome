<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentmethod = PaymentMethod::all();

        return view('paymentmethod.index', compact('paymentmethod'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymentmethod.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('paymentmethod.index')->with('success','Payment Method created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $PaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentmethod)
    {
        return view('paymentmethod.show',compact('paymentmethod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $PaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentmethod)
    {
        return view('paymentmethod.edit',compact('paymentmethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $PaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentmethod)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $paymentmethod->update($request->all());

        return redirect()->route('paymentmethod.index')->with('success','PaymentMethod updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $PaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentmethod)
    {
        $paymentmethod->delete();

        return redirect()->route('paymentmethod.index')
            ->with('success','PaymentMethod deleted successfully');
    }
}
