@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Account</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('accounts.create') }}"> Create New Account</a>
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
        @foreach ($accounts as $account)
            <tr>
                <td>{{ $account->name }}</td>
                <td>{{ $account->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('accounts.show',$account->id) }}">Show</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('accounts.edit',$account->id) }}">Edit</a>
                </td>
                <td>
                    <form onsubmit="return confirm('Do you really want to delete?');" action="{{ route('accounts.destroy',$account) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
