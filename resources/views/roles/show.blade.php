@extends('layout')

@section('content')
    <div class="container mt-5">

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-user-shield me-2"></i> Role Details
                            </h3>
                            <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Name:</strong> {{ $role->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Created By:</strong> {{ $role->user->name ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Permission:</strong>
                                    @if($role->permissions->isNotEmpty())
                                        @foreach($role->permissions as $permission)
                                            <span
                                                class="badge bg-secondary">{{ ucwords(str_replace('_', ' ', $permission->name)) }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-secondary">No Permission</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection