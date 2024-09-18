@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Workout Day Exercises</h1>
                </div>
                @can('workout_day_exercises.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                        href="{{ route('workout_day_exercises.create') }}">
                            Add New
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @include('workout_day_exercises.table')
            </div>

        </div>
    </div>

@endsection

