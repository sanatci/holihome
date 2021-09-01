@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Show Transaction</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('transactions.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date:</strong>
                    {{ date('d/m/Y',strtotime($transaction->date)) }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Rental Unit:</strong>
                        @foreach ($rentals as $key => $value)
                            @if ($transaction->unit_id == $key)
                                {{ $value }} ({{ $key }})
                            @endif
                        @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Account:</strong>
                        @foreach ($accounts as $key => $value)
                            @if ($transaction->account_id == $key)
                                {{ $value }} ({{ $key }})
                            @endif
                        @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Payment Method:</strong>
                        @foreach ($accounts as $key => $value)
                            @if ($transaction->payment_id == $key)
                                {{ $value }} ({{ $key }})
                            @endif
                        @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $transaction->description }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Amount:</strong>
                    {{ $transaction->amount }}
                </div>
            </div>
    </div>
</div>
@endsection
