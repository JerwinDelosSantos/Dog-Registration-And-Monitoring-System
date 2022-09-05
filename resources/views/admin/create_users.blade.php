@extends('layouts.main')

@section('content')
    <div class="container-fluid p-0">
        <h3><strong>Create New User</strong> </h3>
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex">
                        <div class="">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle fs-4">Add new user</span>
                        </div>
                        <div class="d-flex ms-auto">
                            <a href="{{ route('users.index') }}" class="btn btn-primary" ><i class="align-middle me-1" data-feather="arrow-left"></i>Back</a>
                        </div>
                    </div>
                </div>

                @livewire('admin.create-user-form')

            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('dist/js/validation.js') }}"></script>
    @endpush

@endsection
