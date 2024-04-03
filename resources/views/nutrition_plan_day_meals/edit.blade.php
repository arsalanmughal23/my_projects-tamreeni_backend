@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Nutrition Plan Day Meal</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($nutritionPlanDayMeal, ['route' => ['nutrition_plan_day_meals.update', $nutritionPlanDayMeal->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('nutrition_plan_day_meals.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('nutrition_plan_day_meals.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
