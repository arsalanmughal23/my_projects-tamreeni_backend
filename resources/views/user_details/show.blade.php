@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <h1>User Details</h1>
                </div>
                <div>
                    <a class="btn btn-default"
                        href="{{ route('user_details.index') }}">
                        Back
                    </a>
                    <a href="{{ route('users.show', $userDetail->user_id) }}" class="btn btn-primary">View User</a>
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
