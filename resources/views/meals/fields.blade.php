<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (English):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($meal)?$meal->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Arabic):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($meal)?$meal->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'dir'=>'rtl', 'pattern'=>'[ا-ي0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Meal Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meal_category', 'Meal Category:', ['class'=>'required']) !!}

    <select name="meal_category_id" class="form-control select2" required>
        <option></option>
        @foreach ($meal_categories as $meal_category)
            <option value="{{ $meal_category->id }}"
                @if(@old('meal_category_id', $meal?->meal_category_id) == $meal_category->id) selected @endif>{{ $meal_category->name }}</option>
        @endforeach
    </select>
</div>

<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:', ['class'=>'required']) !!}

    <select name="diet_type" class="form-control" required>
        <option value="traditional"
            @if(@old('diet_type', $meal?->diet_type) == \App\Models\Meal::DIET_TYPE_TRADITION_EN) selected @endif>
            Traditional
        </option>
        <option value="keto"
            @if(@old('diet_type', $meal?->diet_type) == \App\Models\Meal::DIET_TYPE_KETO_EN) selected @endif>Keto
        </option>
    </select>
</div>

<!-- Meal Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('meal_type_id', 'Meal Type:', ['class'=>'required']) !!}

    <select name="meal_type_id" class="form-control select2" required>
        <option></option>
        @foreach ($meal_types as $meal_type)
            <option value="{{ $meal_type->id }}"
                @if(@old('meal_type_id', $meal?->meal_type_id) == $meal_type->id) selected @endif>{{ $meal_type->name }}</option>
        @endforeach
    </select>
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
{!! Form::label('image', 'Image:', ['class'=>'required']) !!}
{!! Form::file('image', ['class' => 'form-control', (isset($meal)) ? '' : 'required' => 'required', 'accept' => 'image/jpeg,image/png']) !!}
@if(isset($meal))
    <!-- Image Field -->
        <img src="{{ $meal->image}}" width="100" onerror="brokenImageHandler(this);">
    @endif
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (English):', ['class'=>'required']) !!}
    {!! Form::textarea('description[en]', isset($meal)?$meal->getTranslation('description', 'en'):null, ['class' => 'form-control', 'rows'=>3, 'cols'=>3, 'required', 'maxlength' => 256]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (Arabic):', ['class'=>'required']) !!}
    {!! Form::textarea('description[ar]', isset($meal)?$meal->getTranslation('description', 'ar'):null, ['class' => 'form-control', 'rows'=>3, 'cols'=>3, 'required', 'maxlength' => 256, 'dir'=>'rtl']) !!}
</div>

<!-- Calories Field -->
<div class="form-group col-sm-3">
    {!! Form::label('calories', 'Calories:', ['class'=>'required']) !!}
    {!! Form::number('calories', null, ['class' => 'form-control', 'required', 'min'=>0, 'max'=>1000, 'oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>

<!-- protein Field -->
<div class="form-group col-sm-3">
    {!! Form::label('protein', 'Protein:', ['class'=>'required']) !!}
    {!! Form::number('protein', null, ['class' => 'form-control', 'required', 'min'=>0, 'max'=>1000, 'oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>

<!-- fats Field -->
<div class="form-group col-sm-3">
    {!! Form::label('fats', 'Fats:', ['class'=>'required']) !!}
    {!! Form::number('fats', null, ['class' => 'form-control', 'required', 'min'=>0, 'max'=>1000, 'oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>

<!-- Carbs Field -->
<div class="form-group col-sm-3">
    {!! Form::label('carbs', 'Carbs:', ['class'=>'required']) !!}
    {!! Form::number('carbs', null, ['class' => 'form-control', 'required', 'min'=>0, 'max'=>1000, 'oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>


@push('page_scripts')
    <script>
        function allowOnlyNumbers(input, maxLength, allowDecimal) {
            input.addEventListener('input', function () {
                // Store the current cursor position and value length
                var cursorPosition = input.selectionStart;
                var oldValueLength = this.value.length;

                // Remove non-numeric characters from the input value
                let sanitizedValue = this.value.replace(/[^\d.]/g, '');

                // If decimal point is allowed, ensure only one decimal point exists
                if (allowDecimal) {
                    sanitizedValue = sanitizedValue.replace(/(\.[^.]*)\./g, '$1');
                }

                // If maxLength is provided, truncate input if necessary
                if (maxLength && sanitizedValue.length > maxLength) {
                    sanitizedValue = sanitizedValue.slice(0, maxLength);
                }

                // Update input value
                this.value = sanitizedValue;

                // Calculate the difference in value length
                var diff = this.value.length - oldValueLength;

                // Adjust cursor position
                cursorPosition += diff;

                // Restore the cursor position
                input.setSelectionRange(cursorPosition, cursorPosition);
            });
        }
    </script>
@endpush
