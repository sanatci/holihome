@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Payment Methods</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('paymentmethods.create') }}"> Create New Payment Method</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($paymentmethods as $pm)
            <tr>
                <td>{{ $pm->name }}</td>
                <td>{{ $pm->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('paymentmethods.show',$pm->id) }}">Show</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('paymentmethods.edit',$pm->id) }}">Edit</a>
                </td>
                <td>
                    <form onsubmit="return confirm('Do you really want to delete?');" action="{{ route('paymentmethods.destroy',$pm) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
