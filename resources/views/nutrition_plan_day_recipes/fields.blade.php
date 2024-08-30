<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    <!-- {!! Form::select('diet_type', ['' => 'Select Diet Type', 'traditional' => 'Traditional', 'keto' => 'Keto'], null, ['class' => 'form-control', 'required' => true]) !!} -->
    <select name="diet_type" id="" class="form-control" required=true disabled=true >
        <option value="">Select Diet Type</option>
        @foreach($dietTypeSelectOptions as $dietType)
        <option value="{{ $dietType }}" {{ isset($nutritionPlanDayRecipe) ? ($nutritionPlanDayRecipe->diet_type == $dietType ? 'selected' : '') : '' }}>{{ $dietType }}</option>
        @endforeach
    </select>
</div>

<!-- Nutrition Plan Day Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nutrition_plan_day_id', 'Nutrition Plan Day Id:') !!}
    {!! Form::number('nutrition_plan_day_id', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Meal Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meal_type_id', 'Meal Type Id:') !!}
    {!! Form::select('meal_type_id[]',$mealTypeSelectOptions, isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->meal_type_id : null,['class' => 'form-control select2', 'disabled' => true]) !!}
</div>

<!-- Recipe Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recipe_id', 'Recipe Id:') !!}
    {!! Form::select('recipe_id',$recipeSelectOptions, isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->recipe_id : null,['class' => 'form-control select2', 'disabled' => true]) !!}
</div>

<!-- Meal Category Ids Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('meal_category_ids', 'Meal Category Ids:') !!}
    {!! Form::select('meal_category_ids[]',$mealCategorySelectOptions, isset($nutritionPlanDayRecipe) ? $selectedMealCategory : [],['class' => 'form-control select2', 'multiple'=>'multiple', 'disabled' => true]) !!}

</div>

<!-- Title (English) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('title', 'Title (English):') !!}
    {!! Form::textarea('title[en]', isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->getTranslation('title', 'en') : null, ['class' => 'form-control', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Title (Arabic) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('title', 'Title (Arabic):') !!}
    {!! Form::textarea('title[ar]', isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->getTranslation('title', 'ar') : null, ['class' => 'form-control', 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>


<!-- Description (English) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (English):') !!}
    {!! Form::textarea('description[en]', isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->getTranslation('description', 'en') : null, ['class' => 'form-control', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Description (Arabic) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (Arabic):') !!}
    {!! Form::textarea('description[ar]', isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->getTranslation('description', 'ar') : null, ['class' => 'form-control', 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>


<!-- Image Field -->
<!-- <div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Instruction (English) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('instruction', 'Instruction (English):') !!}
    {!! Form::textarea('instruction[en]', isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->getTranslation('instruction', 'en') : null, ['class' => 'form-control', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Instruction (Arabic) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('instruction', 'Instruction (Arabic):') !!}
    {!! Form::textarea('instruction[ar]', isset($nutritionPlanDayRecipe) ? $nutritionPlanDayRecipe->getTranslation('instruction', 'ar') : null, ['class' => 'form-control', 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>


<!-- Units In Recipe Field -->
<div class="form-group col-sm-6">
    {!! Form::label('units_in_recipe', 'Units In Recipe:') !!}
    {!! Form::number('units_in_recipe', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Divide Recipe By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('divide_recipe_by', 'Divide Recipe By:') !!}
    {!! Form::number('divide_recipe_by', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Number Of Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number_of_units', 'Number Of Units:') !!}
    {!! Form::number('number_of_units', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Calories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('calories', 'Calories:') !!}
    {!! Form::number('calories', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Carbs Field -->
<div class="form-group col-sm-6">
    {!! Form::label('carbs', 'Carbs:') !!}
    {!! Form::number('carbs', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Fats Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fats', 'Fats:') !!}
    {!! Form::number('fats', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Protein Field -->
<div class="form-group col-sm-6">
    {!! Form::label('protein', 'Protein:') !!}
    {!! Form::number('protein', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>
