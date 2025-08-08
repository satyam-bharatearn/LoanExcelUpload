@extends('layout')
@section('content')
    <div class="container-lg">
        {{-- <div class="fs-2 fw-semibold">Permission</div> --}}
        <nav aria-label="breadcrumb" class="breadcrumb-header justify-content-between">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single-->
                    {{-- <a href="{{ route('dashboard') }}">Dashboard</a> --}}
                </li>
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><a href="{{ route('permission.index') }}">Permission</a>
                </li>
                <li class="breadcrumb-item active"><span>Add Permission</span></li>
            </ol>
        </nav>
        <header class="d-flex justify-content-between mb-4 align-items-center">
            <h5>New Permission</h5>
            <a href="{{ route('permission.index') }}" class="btn btn-sm btn-secondary">Back</a>
        </header>
        <div class="card mb-4">
            {{-- <div class="card-header">All Permission </div> --}}
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <button type="submit" class="btn btn-primary mb-5">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
