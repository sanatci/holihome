@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Rental Units</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('units.create') }}"> Create New Rental Unit</a>
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
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($units as $unit)
            <tr>
                <td>{{ $unit->unit_name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('units.show',$unit->id) }}">Show</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('units.edit',$unit->id) }}">Edit</a>
                </td>
                <td>
                    <form onsubmit="return confirm('Do you really want to delete?');" action="{{ route('units.destroy',$unit) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
