@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Meal Categories</h1>
                </div>
                @if(Route::has('meal_categories.create'))
                    @can('meal_categories.create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                            href="{{ route('meal_categories.create') }}">
                                Add New
                            </a>
                        </div>
                    @endcan
                @endif
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @include('meal_categories.table')
            </div>

        </div>
    </div>

@endsection

