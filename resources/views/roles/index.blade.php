@extends('layout')

@section('content')
    <div class="container">
        <h2>Role List</h2>
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Add Role</a>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Created By</th>
                        <th>Level</th>
                        <th>Is Employee</th>
                        <th>Permission</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($role as $roles)
                        <tr>
                            <td><strong>{{ $roles->name }}</strong></td>
                            <td>{{ $roles->created_by }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $roles->level }}</span>
                            </td>
                            <td>
                                @if($roles->is_employe)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($roles->permission))
                                    <span class="badge bg-info">{{ $roles->permission }}</span>
                                @else
                                    <span class="badge bg-secondary">No Permission</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('roles.show', $roles->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i> View
                                </a>

                                <a href="{{ route('roles.edit', $roles->id) }}" class="btn btn-sm btn-outline-success">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No roles found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection