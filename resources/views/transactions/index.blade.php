@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Transaction</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('transactions.create') }}"> Create New Transaction</a>
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
                <form action="{{ route('transactions.index') }}" method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control mr-2" name="term" placeholder="Search transactions" id="term" value="{{ $key }}">
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Search">
                                Search
                            </button>
                        </span>
                        <a href="{{ route('transactions.index') }}" class=" mt-1">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    Clear
                                </button>
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <tr>
            <th>id</th>
            <th>Date</th>
            <th>Rental Unit</th>
            <th>Account</th>
            <th>Payment</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ date("d/m/Y",strtotime($transaction->date)) }}</td>
                <td>{{ $transaction->unitname }} ({{$transaction->unit_id}})</td>
                <td>{{ $transaction->accountname }} ({{$transaction->account_id}})</td>
                <td>{{ $transaction->paymentname }} ({{$transaction->payment_id}})</td>
                <td>{{ $transaction->description }}</td>
                <td class="float-right">
                    <span style=
                    @if ($transaction->amount > 0)
                        "color:blue"
                    @elseif ($transaction->amount < 0)
                        "color:red"
                    @else
                        "color:gray"
                    @endif
                        >
                    {{ number_format($transaction->amount,2) }}</span>
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('transactions.show',$transaction->id) }}">Show</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Edit</a>
                </td>
                <td>
                    <form onsubmit="return confirm('Do you really want to delete?');" action="{{ route('transactions.destroy',$transaction->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center">
        {{ $transactions->render() }}
    </div>

@endsection
