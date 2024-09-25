@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-2">
                <div>
                    <h1>Edit Profile</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        @include('flash::message')

        <div class="card">

            {!! Form::model($users, ['route' => ['user_profile.update'], 'method' => 'post', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('user_profile.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id'=>'submitButton']) !!}
                <a href="{{ route('user_profile.edit') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
