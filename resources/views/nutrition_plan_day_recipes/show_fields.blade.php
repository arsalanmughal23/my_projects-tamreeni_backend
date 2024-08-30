<!-- Diet Type Field -->
<div class="col-sm-12">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    <p>{{ $nutritionPlanDayRecipe->diet_type }}</p>
</div>

<!-- Nutrition Plan Day Id Field -->
<div class="col-sm-12">
    {!! Form::label('nutrition_plan_day_id', 'Nutrition Plan Day Id:') !!}
    <p>{{ $nutritionPlanDayRecipe->nutrition_plan_day_id }}</p>
</div>

<!-- Meal Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('meal_type_id', 'Meal Type Id:') !!}
    <p>{{ $nutritionPlanDayRecipe->mealType->name }}</p>
</div>

<!-- Recipe Id Field -->
<div class="col-sm-12">
    {!! Form::label('recipe_id', 'Recipe Id:') !!}
    <a href="{{ route('recipes.show', $nutritionPlanDayRecipe->recipe_id) }}">{{ $nutritionPlanDayRecipe?->recipe?->title }}</a>
</div>

<!-- Meal Category Ids Field -->
<div class="col-sm-12">
    {!! Form::label('meal_category_ids', 'Meal Category Ids:') !!}
    <p>{{ implode(', ', $nutritionPlanDayRecipe?->mealCategories?->pluck('name')?->toArray() ?? []) }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $nutritionPlanDayRecipe->title }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $nutritionPlanDayRecipe->description }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <img src="{{ $nutritionPlanDayRecipe->image }}" width="200" alt="">
</div>

<!-- Instruction Field -->
<div class="col-sm-12">
    {!! Form::label('instruction', 'Instruction:') !!}
    <p>{{ $nutritionPlanDayRecipe->instruction }}</p>
</div>

<!-- Units In Recipe Field -->
<div class="col-sm-12">
    {!! Form::label('units_in_recipe', 'Units In Recipe:') !!}
    <p>{{ $nutritionPlanDayRecipe->units_in_recipe }}</p>
</div>

<!-- Divide Recipe By Field -->
<div class="col-sm-12">
    {!! Form::label('divide_recipe_by', 'Divide Recipe By:') !!}
    <p>{{ $nutritionPlanDayRecipe->divide_recipe_by }}</p>
</div>

<!-- Number Of Units Field -->
<div class="col-sm-12">
    {!! Form::label('number_of_units', 'Number Of Units:') !!}
    <p>{{ $nutritionPlanDayRecipe->number_of_units }}</p>
</div>

<!-- Calories Field -->
<div class="col-sm-12">
    {!! Form::label('calories', 'Calories:') !!}
    <p>{{ $nutritionPlanDayRecipe->calories }}</p>
</div>

<!-- Carbs Field -->
<div class="col-sm-12">
    {!! Form::label('carbs', 'Carbs:') !!}
    <p>{{ $nutritionPlanDayRecipe->carbs }}</p>
</div>

<!-- Fats Field -->
<div class="col-sm-12">
    {!! Form::label('fats', 'Fats:') !!}
    <p>{{ $nutritionPlanDayRecipe->fats }}</p>
</div>

<!-- Protein Field -->
<div class="col-sm-12">
    {!! Form::label('protein', 'Protein:') !!}
    <p>{{ $nutritionPlanDayRecipe->protein }}</p>
</div>

