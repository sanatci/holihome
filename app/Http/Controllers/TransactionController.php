<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\PaymentMethod;
use App\Models\Unit;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$transactions = Transaction::all();
        // $transactions = Transaction::paginate(10);
        $key = trim($request->get('term'));
        $transactions = DB::Table('transactions')
            ->leftJoin('units', 'unit_id', '=', 'units.id')
            ->leftJoin('accounts', 'account_id', '=', 'accounts.id')
            ->leftJoin('payment_methods', 'payment_id', '=', 'payment_methods.id')
            ->where('transactions.id', 'like', "%{$key}%")
            ->orWhere('units.unit_name', 'like', "%{$key}%")
            ->orWhere('accounts.name', 'like', "%{$key}%")
            ->orWhere('payment_methods.name', 'like', "%{$key}%")
            ->orWhere('transactions.description', 'like', "%{$key}%")
            ->orWhere('date', 'like', "%{$key}%")
            ->orWhere('amount', 'like', "%{$key}%")
            ->select('transactions.*','units.unit_name as unitname','accounts.name as accountname','payment_methods.name as paymentname')
            ->paginate(10);
        return view('transactions.index', compact('transactions','key'));
     //   return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rentals = Unit::pluck('unit_name', 'id');
        $accounts= Account::pluck('name','id');
        $payments= PaymentMethod::pluck('name','id');
        return view('transactions.create',compact('rentals','accounts','payments'));
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
            'date' => 'required',
            'unit_id' => 'required|integer',
            'account_id' => 'required|integer',
            'payment_id' => 'required|integer',
            'amount' => 'required'
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success','Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $rentals = Unit::pluck('unit_name', 'id');
        $accounts= Account::pluck('name','id');
        $payments= PaymentMethod::pluck('name','id');
        return view('transactions.show',compact('transaction','rentals','accounts','payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $rentals = Unit::pluck('unit_name', 'id');
        $accounts= Account::pluck('name','id');
        $payments= PaymentMethod::pluck('name','id');
        return view('transactions.edit',compact('transaction','rentals','accounts','payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'date' => 'required',
            'unit_id' => 'required',
            'account_id' => 'required',
            'amount' => 'required'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success','transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('success','transaction deleted successfully');
    }

    public function report(Request $request)
    {
        //$transactions = Transaction::all();
        // $transactions = Transaction::paginate(10);

        $rentals = Unit::pluck('unit_name', 'id');
        $accounts= Account::pluck('name','id');
        $payments= PaymentMethod::pluck('name','id');

        $xunit_id = trim($request->get('xunit_id'));
        $xaccount_id = trim($request->get('xaccount_id'));
        $xpayment_id = trim($request->get('xpayment_id'));

        $xdate1 = trim($request->get('xdate1'));
        $xdate2 = trim($request->get('xdate2'));

        // DB::enableQueryLog(); // Enable query log
        $totalpast = DB::Table('transactions')
            ->whereRaw($xunit_id==0?'unit_id>?':'unit_id=?', [$xunit_id])
            ->whereRaw($xaccount_id==0?'account_id>?':'account_id=?', [$xaccount_id])
            ->whereRaw($xpayment_id==0?'payment_id>?':'payment_id=?', [$xpayment_id])
            ->where('date','<',[$xdate1])
            ->sum('amount');

        $transactions = DB::Table('transactions')
            ->leftJoin('units', 'unit_id', '=', 'units.id')
            ->leftJoin('accounts', 'account_id', '=', 'accounts.id')
            ->leftJoin('payment_methods', 'payment_id', '=', 'payment_methods.id')
            ->whereRaw($xunit_id==0?'unit_id>?':'unit_id=?', [$xunit_id])
            ->whereRaw($xaccount_id==0?'account_id>?':'account_id=?', [$xaccount_id])
            ->whereRaw($xpayment_id==0?'payment_id>?':'payment_id=?', [$xpayment_id])
            ->whereBetween('date', [$xdate1,$xdate2])
            ->select('transactions.*','units.unit_name as unitname','accounts.name as accountname','payment_methods.name as paymentname')
            ->get();

        // dd(DB::getQueryLog()); // Show results of log
        return view('report', compact('transactions','xdate1','xdate2','xpayment_id','xunit_id','xaccount_id','rentals','accounts','payments','totalpast'));
        //   return view('transactions.index', compact('transactions'));
    }


}
