@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Nutrition Plan Day Recipe</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($nutritionPlanDayRecipe, ['route' => ['nutrition_plan_day_recipes.update', $nutritionPlanDayRecipe->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('nutrition_plan_day_recipes.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('nutrition_plan_day_recipes.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
