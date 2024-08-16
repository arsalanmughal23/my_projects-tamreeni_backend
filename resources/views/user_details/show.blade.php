@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex justify-content-between">
                    <h1>User Detail Details</h1>

                    <!-- User Field -->
                    <div>
                        <a href="{{ route('users.show', $userDetail->user_id) }}" class="btn btn-primary">View User</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('user_details.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('user_details.show_fields')
    </div>

    <div class="content px-3">
        @include('user_details.show_personal_statistics_fields')
    </div>
@endsection
