@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Meals</h1>
                </div>
                @can('meals.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                        href="{{ route('meals.create') }}">
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
                @include('meals.table')
            </div>

        </div>
    </div>

@endsection

