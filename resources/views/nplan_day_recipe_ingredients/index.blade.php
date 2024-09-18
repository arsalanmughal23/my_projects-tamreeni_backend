@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nutrition Plan Day Recipe Ingredients</h1>
                </div>
                @if(false)
                    @can('nplan_day_recipe_ingredients.create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                            href="{{ route('nplan_day_recipe_ingredients.create') }}">
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
                @include('nplan_day_recipe_ingredients.table')
            </div>

        </div>
    </div>

@endsection

