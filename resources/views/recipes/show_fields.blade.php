<!-- Diet Type Field -->
<div class="col-sm-12">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    <p>{{ $recipe->diet_type }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $recipe->title['en'] ?? '' }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $recipe->description['en'] ?? '' }}</p>
</div>

<!-- Instruction Field -->
<div class="col-sm-12">
    {!! Form::label('instruction', 'Instruction:') !!}
    <p>{{ $recipe->instruction['en'] ?? '' }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <br/>
    <img src="{{ $recipe->image }}" alt="" height="150">
</div>

<!-- Units In Recipe Field -->
<div class="col-sm-12">
    {!! Form::label('units_in_recipe', 'Units In Recipe:') !!}
    <p>{{ $recipe->units_in_recipe }}</p>
</div>

<!-- Divide Recipe By Field -->
<div class="col-sm-12">
    {!! Form::label('divide_recipe_by', 'Divide Recipe By:') !!}
    <p>{{ $recipe->divide_recipe_by }}</p>
</div>

<!-- Number Of Units Field -->
<div class="col-sm-12">
    {!! Form::label('number_of_units', 'Number Of Units:') !!}
    <p>{{ $recipe->number_of_units }}</p>
</div>

<!-- Calories Field -->
<div class="col-sm-12">
    {!! Form::label('calories', 'Calories:') !!}
    <p>{{ $recipe->calories }}</p>
</div>

<!-- Carbs Field -->
<div class="col-sm-12">
    {!! Form::label('carbs', 'Carbs:') !!}
    <p>{{ $recipe->carbs }}</p>
</div>

<!-- Fats Field -->
<div class="col-sm-12">
    {!! Form::label('fats', 'Fats:') !!}
    <p>{{ $recipe->fats }}</p>
</div>

<!-- Protein Field -->
<div class="col-sm-12">
    {!! Form::label('protein', 'Protein:') !!}
    <p>{{ $recipe->protein }}</p>
</div>

