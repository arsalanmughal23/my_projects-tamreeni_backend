<!-- Recipe Id Field -->
<div class="col-sm-12">
    {!! Form::label('recipe_id', 'Recipe Id:') !!}
    <p>{{ $recipeIngredient->recipe_id }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $recipeIngredient->type }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $recipeIngredient->name }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $recipeIngredient->quantity }}</p>
</div>

<!-- Unit Field -->
<div class="col-sm-12">
    {!! Form::label('unit', 'Unit:') !!}
    <p>{{ $recipeIngredient->unit }}</p>
</div>

