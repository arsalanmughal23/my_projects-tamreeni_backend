<!-- Nutrition Plan Day Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nutrition_plan_day_id', 'Nutrition Plan Day Id:') !!}
    {!! Form::number('nutrition_plan_day_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Meal Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meal_id', 'Meal Id:') !!}
    {!! Form::number('meal_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Meal Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meal_category_id', 'Meal Category Id:') !!}
    {!! Form::number('meal_category_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    {!! Form::text('diet_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Calories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('calories', 'Calories:') !!}
    {!! Form::number('calories', null, ['class' => 'form-control']) !!}
</div>

<!-- Carbs Field -->
<div class="form-group col-sm-6">
    {!! Form::label('carbs', 'Carbs:') !!}
    {!! Form::number('carbs', null, ['class' => 'form-control']) !!}
</div>

<!-- Fats Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fats', 'Fats:') !!}
    {!! Form::number('fats', null, ['class' => 'form-control']) !!}
</div>

<!-- Protein Field -->
<div class="form-group col-sm-6">
    {!! Form::label('protein', 'Protein:') !!}
    {!! Form::number('protein', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div>