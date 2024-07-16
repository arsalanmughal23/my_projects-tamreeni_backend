<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    {!! Form::select('diet_type', ['' => 'Select Diet Type', 'traditional' => 'Traditional', 'keto' => 'Keto'], null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Total Calories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_calories', 'Total Calories:') !!}
    {!! Form::number('total_calories', null, ['class' => 'form-control', 'step' => 100, 'min' => 1000, 'max' => 3000]) !!}
</div>

<!-- Breakfast Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('breakfast_units', 'Breakfast Units:') !!}
    {!! Form::number('breakfast_units', null, ['class' => 'form-control', 'step' => 1, 'min' => 0, 'max' => 10]) !!}
</div>

<!-- Lunch Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lunch_units', 'Lunch Units:') !!}
    {!! Form::number('lunch_units', null, ['class' => 'form-control', 'step' => 1, 'min' => 0, 'max' => 10]) !!}
</div>

<!-- Dinner Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dinner_units', 'Dinner Units:') !!}
    {!! Form::number('dinner_units', null, ['class' => 'form-control', 'step' => 1, 'min' => 0, 'max' => 10]) !!}
</div>

<!-- Fruit Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fruit_units', 'Fruit Units:') !!}
    {!! Form::number('fruit_units', null, ['class' => 'form-control', 'step' => 1, 'min' => 0, 'max' => 10]) !!}
</div>

<!-- Snack Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('snack_units', 'Snack Units:') !!}
    {!! Form::number('snack_units', null, ['class' => 'form-control', 'step' => 1, 'min' => 0, 'max' => 10]) !!}
</div>