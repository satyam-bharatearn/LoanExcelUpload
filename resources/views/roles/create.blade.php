@extends('layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <h1>Add Role</h41>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('roles.index') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item active">Add Role</li>
                    </ol>
                </div>
            </div>
        </div>
        {{-- </section>

    <section class="content"> --}}
        <div class="row justify-content-center">
            <div class="col-lg-10 p-2">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-user-shield me-2"></i>Create New Role</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Role Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter role name"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Permissions <span class="text-danger">*</span></label>
                                    <select name="permission[]" id="permission" class="form-control select2"
                                        multiple="multiple" required>
                                        @foreach ($permission as $perm)
                                            <option value="{{ $perm->id }}">{{ $perm->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Select one or more permissions.</small>
                                </div>

                                <div class="col-12 mt-4">
                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary px-4">
                                        <i class="fas fa-arrow-left me-1"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-success px-4 float-right">
                                        <i class="fas fa-save me-1"></i> Create Role
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#permission').select2({
                placeholder: "Select permissions"
            });
        });
    </script>
@endpush
