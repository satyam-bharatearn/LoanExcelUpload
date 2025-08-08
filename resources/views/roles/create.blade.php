@extends('layout')

@section('content')
<section class="content-header mb-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="fw-bold mb-0">Add Role</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">Roles</a>
                    </li>
                    <li class="breadcrumb-item active">Add Role</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-user-shield me-2"></i>Create New Role</span>
                    <button type="button" class="btn btn-sm btn-light" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter role name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Created By</label>
                                <input type="number" name="created_by" class="form-control" placeholder="Enter creator ID">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Level <span class="text-danger">*</span></label>
                                <input type="number" name="level" class="form-control" placeholder="Enter role level" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Is Employee? <span class="text-danger">*</span></label>
                                <select name="is_employe" class="form-select" required>
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Permission</label>
                                <select name="permission[]" id="permission" class="form-select" multiple>
                                    @foreach ($permission as $perm)
                                        <option value="{{ $perm->name }}">{{ $perm->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple permissions.</small>
                            </div>

                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="fas fa-save me-1"></i> Create Role
                                </button>
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary px-4">
                                    <i class="fas fa-arrow-left me-1"></i> Back
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>



    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection