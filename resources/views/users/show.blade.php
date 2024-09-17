@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <h1>User</h1>
                </div>
                <div>
                    <a class="btn btn-default"
                        href="{{ route('users.index') }}">
                        Back
                    </a>
                    <a href="{{ route('user_details.show', $users?->details?->id ?? 0) }}" class="btn btn-primary">
                        View User Details
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('users.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
