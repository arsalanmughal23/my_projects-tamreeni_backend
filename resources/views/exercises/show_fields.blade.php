<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user', 'User:') !!}
    <p>{{ $exercise->user->name }}</p>
</div>

<!-- Body Part Id Field -->
<div class="col-sm-12">
    {!! Form::label('body_part_id', 'Body Part:') !!}
    <p>{{ $exercise->bodyPart->name }}</p>
</div>

<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (English):') !!}
    <p>{{ $exercise->getTranslation('name', 'en') }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (Arabic):') !!}
    <p>{{ $exercise->getTranslation('name', 'ar') }}</p>
</div>

<!-- Description En Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description (English):') !!}
    <p>{{ $exercise->getTranslation('description', 'en')}}</p>
</div>

<!-- Description Ar Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description (Arabic):') !!}
    <p>{{ $exercise->getTranslation('description', 'ar')}}</p>
</div>

<!-- Duration In M Field -->
<div class="col-sm-12">
    {!! Form::label('duration_in_m', 'Duration In Min:') !!}
    <p>{{ $exercise->duration_in_m }}</p>
</div>

<!-- Sets Field -->
<div class="col-sm-12">
    {!! Form::label('sets', 'Sets:') !!}
    <p>{{ $exercise->sets }}</p>
</div>

<!-- Reps Field -->
<div class="col-sm-12">
    {!! Form::label('reps', 'Reps:') !!}
    <p>{{ $exercise->reps }}</p>
</div>

<!-- Burn Calories Field -->
<div class="col-sm-12">
    {!! Form::label('burn_calories', 'Burn Calories:') !!}
    <p>{{ $exercise->burn_calories }}</p>
</div>

<!-- Equipment Field -->
<div class="col-sm-12">
    {!! Form::label('equipment', 'Equipment:') !!}
    <p>{{ $exercise->equipmentCsv }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>
        <img src="{{ $exercise->image}}" width="360" onerror="brokenImageHandler(this);">
    </p>
</div>

<!-- Video Field -->
<div class="col-sm-12">
    {!! Form::label('video', 'Video:') !!}
    <p>
        <video width="360" controls>
            <source src="{{ $exercise->video}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </p>
</div>

