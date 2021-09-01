@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Transaction List</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div>
        <div class="mx-auto pull-right">
            <div class="">
                <form action="{{ route('report') }}" method="GET" role="report">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Start Date:</strong>
                            <input type="date" name="xdate1" class="form-control" placeholder="Date" value="{{ $xdate1 }}">
                        </div>
                        <div class="form-group">
                            <strong>End Date:</strong>
                            <input type="date" name="xdate2" class="form-control" placeholder="Date" value="{{ $xdate2 }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Rental Unit:</strong>
                            <select class="form-control" name="xunit_id">
                                <option value="0">All</option>
                                @foreach ($rentals as $key => $value)
                                    <option value="{{ $key }}"
                                            @if ($xunit_id == $key)
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
                            <select class="form-control" name="xaccount_id">
                                <option value="0">All</option>
                                @foreach ($accounts as $key => $value)
                                    <option value="{{ $key }}"
                                            @if ($xaccount_id == $key)
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
                            <select class="form-control" name="xpayment_id">
                                <option value="0">All</option>
                                @foreach ($payments as $key => $value)
                                    <option value="{{ $key }}"
                                            @if ($xpayment_id == $key)
                                            selected
                                        @endif
                                    >{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Report">
                                Prepare Report
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table id="tabreport" class="table table-bordered table-striped">
        <tr>
            <th>id</th>
            <th>Date</th>
            <th>Rental Unit</th>
            <th>Account</th>
            <th>Payment</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Balance</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: right">Balance</th>
            <th></th>
            <th style="text-align: right;color:
                @if ($totalpast > 0)
                      blue
                @elseif ($totalpast < 0)
                    red
                @else
                    gray
                @endif
                "><b>
                {{ number_format($totalpast,2) }}</b>
            </th>

        </tr>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ date("d/m/Y",strtotime($transaction->date)) }}</td>
                <td>{{ $transaction->unitname }} ({{$transaction->unit_id}})</td>
                <td>{{ $transaction->accountname }} ({{$transaction->account_id}})</td>
                <td>{{ $transaction->paymentname }} ({{$transaction->payment_id}})</td>
                <td>{{ $transaction->description }}</td>
                <td style="text-align:right;color:
                    @if ($transaction->amount > 0)
                        blue
                    @elseif ($transaction->amount < 0)
                        red
                    @else
                        gray
                    @endif
                        ">
                    {{ number_format($transaction->amount,2) }}
                    @php $totalpast+=$transaction->amount @endphp
                </td>

                <td style="text-align:right;color:
                @if ($totalpast > 0)
                    blue
                @elseif ($totalpast < 0)
                    red
                @else
                    gray
                @endif
                    ">
                    {{ number_format($totalpast,2) }}
                </td>
            </tr>
        @endforeach
    </table>
@endsection
