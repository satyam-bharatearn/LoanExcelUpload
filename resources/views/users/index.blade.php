@extends('layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <h1>All Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
                <div class="col-12 text-right">
                    <a class="btn btn-primary justify-content-end" href="{{ route('users.create') }}">
                        Add User
                    </a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </section>
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="excelForm" action="{{ route('users.change-password') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="mb-3">
                            <label for="password">New Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="confirm_password" class="form-control"
                                placeholder="Enter Confirm Password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-submit"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive p-2" style="overflow-x: auto;">
        <table class="table table-bordered table-striped table-hover" id="users-table" style="width:100%;">
            <thead class="thead-primary">
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                scrollX: true
            });
        });

        function openChangePasswordModal(userId) {
            $('#user_id').val(userId);
        }
    </script>
@endpush
