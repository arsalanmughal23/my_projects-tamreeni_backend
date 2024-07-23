@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Nplan Day Recipe Ingredient</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($nplanDayRecipeIngredient, ['route' => ['nplan_day_recipe_ingredients.update', $nplanDayRecipeIngredient->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('nplan_day_recipe_ingredients.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('nplan_day_recipe_ingredients.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
