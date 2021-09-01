@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Transaction</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('transactions.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('transactions.update',$transaction->id) }}" method="post">
    @csrf

    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                <input type="date" name="date" class="form-control" placeholder="Date" value="{{ $transaction->date }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Rental Unit:</strong>
                <select class="form-control" name="unit_id">
                    <option>Select Rental Unit</option>
                    @foreach ($rentals as $key => $value)
                        <option value="{{ $key }}"
                        @if ($transaction->unit_id == $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Account:</strong>
                <select class="form-control" name="account_id">
                    <option>Select Account</option>
                    @foreach ($accounts as $key => $value)
                        <option value="{{ $key }}"
                        @if ($transaction->account_id == $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Payment Method:</strong>
                <select class="form-control" name="payment_id">
                    <option>Select Payment Method</option>
                    @foreach ($payments as $key => $value)
                        <option value="{{ $key }}"
                        @if ($transaction->payment_id == $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                <input type="text" name="description" class="form-control" placeholder="Description" value="{{ $transaction->description }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Amount:</strong>
                <input type="number" step="0.01" name="amount" class="form-control" placeholder="Amount"  value="{{ $transaction->amount }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection
