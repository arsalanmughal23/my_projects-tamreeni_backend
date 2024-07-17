<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    {!! Form::text('diet_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::textarea('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Instruction Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('instruction', 'Instruction:') !!}
    {!! Form::textarea('instruction', null, ['class' => 'form-control']) !!}
</div>

<!-- Units In Recipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('units_in_recipe', 'Units In Recipe:') !!}
    {!! Form::number('units_in_recipe', null, ['class' => 'form-control']) !!}
</div>

<!-- Divide Recipe By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('divide_recipe_by', 'Divide Recipe By:') !!}
    {!! Form::number('divide_recipe_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Number Of Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_of_units', 'Number Of Units:') !!}
    {!! Form::number('number_of_units', null, ['class' => 'form-control']) !!}
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