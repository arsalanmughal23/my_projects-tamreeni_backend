<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (English):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($exercise)?$exercise->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Arabic):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($exercise)?$exercise->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'dir'=>'rtl', 'pattern'=>'[ا-ي0-9_.\s+-]{0,70}']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (English):', ['class'=>'required']) !!}
    {!! Form::textarea('description[en]', isset($exercise)?$exercise->getTranslation('description', 'en'):null, ['class' => 'form-control', 'rows'=>3, 'cols'=>3, 'required', 'maxlength' => 100]) !!}
</div>


<!-- Description Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (Arabic):', ['class'=>'required']) !!}
    {!! Form::textarea('description[ar]', isset($exercise)?$exercise->getTranslation('description', 'ar'):null, ['class' => 'form-control', 'rows'=>3, 'cols'=>3, 'required', 'dir'=>'rtl', 'maxlength' => 100]) !!}
</div>

<!-- Exercise Category Field -->
<div class="form-group col-sm-3">
    {!! Form::label('exercise_category_name', 'Exercise Category:', ['class'=>'required']) !!}

    <select name="exercise_category_name" class="form-control" required>
        <option></option>
        @foreach ($exerciseCategories as $exerciseCategory)
            <option value="{{ $exerciseCategory }}"
                    @if(old('exercise_category_name') == $exerciseCategory || (isset($exercise) && $exercise->exercise_category_name == $exerciseCategory)) selected @endif>{{ __('general.'.$exerciseCategory, [], 'en') }}</option>
        @endforeach
    </select>
</div>

<!-- Exercise Type Field -->
<div class="form-group col-sm-3">
    {!! Form::label('exercise_type_name', 'Exercise Type:', ['class'=>'required']) !!}

    <select name="exercise_type_name" class="form-control" required>
        <option></option>
        @foreach ($exerciseTypes as $exerciseType)
            <option value="{{ $exerciseType }}"
                    @if(old('exercise_type_name') == $exerciseType || (isset($exercise) && $exercise->exercise_type_name == $exerciseType)) selected @endif>{{ __('general.'.$exerciseType, [], 'en') }}</option>
        @endforeach
    </select>
</div>

<!-- Body Part Id Field -->
<div class="form-group col-sm-3">
    {!! Form::label('body_part_id', 'Body Part:', ['class'=>'required']) !!}

    <select name="body_part_id" class="form-control select2" required>
        <option></option>
        @foreach ($bodyParts as $bodyPart)
            <option value="{{ $bodyPart->id }}"
                    @if(old('body_part_id') == $bodyPart->id || (isset($exercise) && $exercise->body_part_id == $bodyPart->id)) selected @endif>{{ $bodyPart->name }}</option>
        @endforeach
    </select>
</div>


<!-- Exercise Equipment Field -->
<div class="form-group col-sm-3">
    {!! Form::label('exercise_equipments', 'Equipments:', ['class'=>'']) !!}
    {!! Form::select('exercise_equipments[]',$exercise_equipments, isset($exercise) ?$selectedEquipments : [],['class' => 'form-control select2', 'multiple'=>'multiple']) !!}

</div>


<!-- Duration In M Field -->
<div class="form-group col-sm-3">
    {!! Form::label('duration_in_m', 'Duration In M:', ['class' => 'required']) !!}
    {!! Form::number('duration_in_m', null, ['class' => 'form-control',  'required'=>'required','oninput' => 'allowOnlyNumbers(this, 4)']) !!}
</div>

<!-- Sets Field -->
<div class="form-group col-sm-3">
    {!! Form::label('sets', 'Sets:', ['class' => 'required']) !!}
    {!! Form::number('sets', null, ['class' => 'form-control',  'required'=>'required','oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>

<!-- Reps Field -->
<div class="form-group col-sm-3">
    {!! Form::label('reps', 'Reps:', ['class' => 'required']) !!}
    {!! Form::number('reps', null, ['class' => 'form-control',  'required'=>'required','oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>

<!-- Burn Calories Field -->
<div class="form-group col-sm-3">
    {!! Form::label('burn_calories', 'Burn Calories:', ['class'=>'required']) !!}
    {!! Form::number('burn_calories', null, ['class' => 'form-control',  'required'=>'required', 'oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6 col-lg-3">
    {!! Form::label('image', 'Image:', ['class'=>'required']) !!}
    {!! Form::file('image', ['class' => 'form-control', (isset($exercise)) ? '' : 'required' => 'required', 'accept' => 'image/jpeg,image/png']) !!}
    <p class="text-muted">Max File Size 5MB</p>

</div>


<!-- Video Field -->
<div class="form-group col-sm-6 col-lg-3">
    {!! Form::label('video', 'Video:', ['class'=>'required']) !!}
    {!! Form::file('video', ['class' => 'form-control', (isset($exercise)) ? '' : 'required' => 'required', 'accept' => 'video/mp4']) !!}
    <p class="text-muted">Max File Size 20MB</p>

</div>

<div class="offset-6"></div>

<!-- video Field -->
@if(isset($exercise))
    <div class="form-group col-sm-6 col-lg-6">
        <img src="{{ $exercise->image}}" width="360" onerror="brokenImageHandler(this);">
    </div>
@endif

<!-- video Field -->
@if(isset($exercise))

    <div class="form-group col-sm-6 col-lg-6">
        <video width="360" height="315" controls>
            <source src="{{ $exercise->video}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
@endif


@push('page_scripts')
    <script>

        let exerciseTypeLabel = $('label[for=exercise_type_name]');
        let selectedExerciseCategoryElement = $('select[name=exercise_category_name]');

        let selectedExerciseTypeElement = {
            elem: $('select[name=exercise_type_name]'),
            toggleDisable(status = false) {
                this.elem.prop('disabled', status);
                status == true && this.elem.val(null);
                return this;
            },
            toggleRequired(status = true) {
                this.elem.prop('required', status);
                status == true ? exerciseTypeLabel.addClass('required') : exerciseTypeLabel.removeClass('required');
                return this;
            }
        };

        selectedExerciseCategoryElement.on('change', function (e) {
            e.preventDefault();
            let selectedExerciseCategory = $(e.target).val();

            selectedExerciseCategory == 'major_lift'
                ? selectedExerciseTypeElement.toggleRequired(true).toggleDisable(false)
                : selectedExerciseTypeElement.toggleRequired(false).toggleDisable(true);
        });

        selectedExerciseCategoryElement.change();

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
