@extends('layout')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">Roles</a>
                    </li>
                    <li class="breadcrumb-item active"><span>Edit Role</span></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title h4">Edit Role</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>Name:</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Created By</label>
                                <input type="number" name="created_by" class="form-control" value="{{ old('created_by', $role->created_by) }}">
                            </div>

                            <div class="col-6 mb-3">
                                <label>Level:</label>
                                <input type="number" name="level" class="form-control" value="{{ old('level', $role->level) }}" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label>Is Employee?</label>
                                <select name="is_employe" class="form-control" required>
                                    <option value="1" {{ $role->is_employe ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !$role->is_employe ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="permission">Permission</label>
                                <select name="permission[]" id="permission" class="form-select" multiple>
                                    @foreach ($permission as $perm)
                                        <option value="{{ $perm->name }}" {{ in_array($perm->name, $selectedPermissions) ? 'selected' : '' }}>
                                            {{ $perm->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success">Update Role</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
