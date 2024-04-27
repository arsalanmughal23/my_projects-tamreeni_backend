<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (En):') !!}
    <p>{{ $meal->getTranslation('name', 'en') }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (Ar):') !!}
    <p>{{ $meal->getTranslation('name', 'ar') }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p><img src="{{ $meal->image }}" width="50"  height="50" onerror="brokenImageHandler(this);"></p>
</div>

<!-- Description En Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description (En):') !!}
    <p>{{ $meal->getTranslation('description', 'en')}}</p>
</div>

<!-- Description Ar Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description (Ar):') !!}
    <p>{{ $meal->getTranslation('description', 'ar')}}</p>
</div>

<!-- Calories Field -->
<div class="col-sm-12">
    {!! Form::label('calories', 'Calories:') !!}
    <p>{{ $meal->calories }}</p>
</div>


<!-- Diet Type Field -->
<div class="col-sm-12">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    <p>{{ $meal->diet_type }}</p>
</div>

<!-- Meal Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('meal_category', 'Meal Category:') !!}
    <p>{{ $meal->mealCategory->name }}</p>
</div>

<!-- Meal created_at Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $meal->created_at }}</p>
</div>

