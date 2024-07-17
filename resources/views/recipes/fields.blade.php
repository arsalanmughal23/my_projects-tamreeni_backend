<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    {!! Form::select('diet_type', ['' => 'Select Diet Type', 'traditional' => 'Traditional', 'keto' => 'Keto'], null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-6">
    {!! Form::label('image', 'Image:') !!}
    <br/>
    {!! Form::file('image', null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Calories Field -->
<div class="form-group col-sm-3">
    {!! Form::label('calories', 'Calories:') !!}
    {!! Form::number('calories', null, ['class' => 'form-control', 'step' => 100, 'min' => 1000, 'max' => 3000, 'required' => true]) !!}
</div>

<!-- Carbs Field -->
<div class="form-group col-sm-3">
    {!! Form::label('carbs', 'Carbs:') !!}
    {!! Form::number('carbs', null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Fats Field -->
<div class="form-group col-sm-3">
    {!! Form::label('fats', 'Fats:') !!}
    {!! Form::number('fats', null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Protein Field -->
<div class="form-group col-sm-3">
    {!! Form::label('protein', 'Protein:') !!}
    {!! Form::number('protein', null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Units In Recipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('units_in_recipe', 'Units In Recipe:') !!}
    {!! Form::number('units_in_recipe', null, ['class' => 'form-control', 'required' => true, 'step' => 1, 'min' => 0, 'max' => 100]) !!}
</div>

<!-- Divide Recipe By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('divide_recipe_by', 'Divide Recipe By:') !!}
    {!! Form::number('divide_recipe_by', null, ['class' => 'form-control', 'required' => true, 'step' => 1, 'min' => 0, 'max' => 100]) !!}
</div>

<!-- Number Of Units Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('number_of_units', 'Number Of Units:') !!}
    {!! Form::number('number_of_units', null, ['class' => 'form-control', 'required' => true, 'step' => 1, 'min' => 0, 'max' => 10]) !!}
</div> -->

<!-- Title (English) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (English):') !!}
    {!! Form::text('title[en]', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191, 'required' => true, 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>
<!-- Title (Arabic) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (Arabic):') !!}
    {!! Form::text('title[ar]', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191, 'required' => true, 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (English):') !!}
    {!! Form::textarea('description[en]', null, ['class' => 'form-control', 'required' => true, 'rows' => 5]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (Arabic):') !!}
    {!! Form::textarea('description[ar]', null, ['class' => 'form-control', 'required' => true, 'rows' => 5, 'dir' => 'rtl']) !!}
</div>

<!-- Instruction Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('instruction', 'Instruction (English):') !!}
    {!! Form::textarea('instruction[en]', null, ['class' => 'form-control', 'required' => true, 'rows' => 5]) !!}
</div>

<!-- Instruction Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('instruction', 'Instruction (Arabic):') !!}
    {!! Form::textarea('instruction[ar]', null, ['class' => 'form-control', 'required' => true, 'rows' => 5, 'dir' => 'rtl']) !!}
</div>
