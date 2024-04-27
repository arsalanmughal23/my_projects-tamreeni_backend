<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (En):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($mealCategory)?$mealCategory->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 255, 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Ar):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($mealCategory)?$mealCategory->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 255, 'required']) !!}
</div>

<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:', ['class'=>'required']) !!}

    <select name="diet_type" class="form-control" required>
        <option value="traditional"
                @if(isset($mealCategory) && $mealCategory->diet_type == \App\Models\Meal::DIET_TYPE_TRADITION_EN) selected @endif>
            Traditional
        </option>
        <option value="keto" @if(isset($mealCategory) && $mealCategory->diet_type == \App\Models\Meal::DIET_TYPE_KETO_EN) selected @endif>Keto
        </option>
    </select>
</div>