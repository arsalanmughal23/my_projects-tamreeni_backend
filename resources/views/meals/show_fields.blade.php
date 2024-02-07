<!-- Diet Type Field -->
<div class="col-sm-12">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    <p>{{ $meal->diet_type }}</p>
</div>

<!-- Meal Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('meal_category_id', 'Meal Category Id:') !!}
    <p>{{ $meal->meal_category_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $meal->name }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $meal->image }}</p>
</div>

<!-- Calories Field -->
<div class="col-sm-12">
    {!! Form::label('calories', 'Calories:') !!}
    <p>{{ $meal->calories }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $meal->description }}</p>
</div>

