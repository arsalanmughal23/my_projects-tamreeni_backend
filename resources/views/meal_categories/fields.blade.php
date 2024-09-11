<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (English):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($mealCategory)?$mealCategory->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Arabic):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($mealCategory)?$mealCategory->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>

<!-- Diet Type Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:', ['class'=>'required']) !!}

    <select name="diet_type" class="form-control" required>
        <option value="" selected disabled>Select Diet Type</option>
        <option value="traditional"
                @if(isset($mealCategory) && $mealCategory->diet_type == \App\Models\Meal::DIET_TYPE_TRADITION_EN) selected @endif>
            Traditional
        </option>
        <option value="keto" @if(isset($mealCategory) && $mealCategory->diet_type == \App\Models\Meal::DIET_TYPE_KETO_EN) selected @endif>Keto
        </option>
    </select>
</div> -->
