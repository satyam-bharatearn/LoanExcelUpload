@extends('layout')

@section('content')
<div class="container">
    <h2>Role List</h2>
    <a href="{{ route('permission.create') }}" class="btn btn-primary mb-3">Add Permission</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Permission Name</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($permission as $permissions)
            <tr>
                <td>{{ $permissions->name }}</td>
                
                 {{-- <td>
            <a href="{{ route('permissions.show', $roles->id) }}" class="btn btn-info btn-sm">View</a>
        </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
