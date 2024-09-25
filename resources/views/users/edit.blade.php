@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-2">
                <div>
                    @if($users->id == auth()->user()->id)
                        <h1>Edit Profile</h1>
                    @else
                        <h1>Edit User</h1>
                    @endif
                </div>
                <div>
                    @can('user_details.edit')
                        @if($users?->details?->id ?? null)
                            <a href="{{ route('user_details.edit', $users?->details?->id) }}" class="btn btn-primary">
                                Edit User Details
                            </a>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        @include('flash::message')

        <div class="card">

            {!! Form::model($users, ['route' => ['users.update', $users->id], 'method' => 'patch', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('users.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id'=>'submitButton']) !!}
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
