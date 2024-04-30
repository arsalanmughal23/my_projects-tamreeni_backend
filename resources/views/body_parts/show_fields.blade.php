<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (En):') !!}
    <p>{{ $bodyPart->getTranslation('name', 'en') }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (Ar):') !!}
    <p>{{ $bodyPart->getTranslation('name', 'ar') }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p><img src="{{ $bodyPart->image }}" width="50" height="50" onerror="brokenImageHandler(this);"></p>
</div>

<!-- Meal created_at Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bodyPart->created_at }}</p>
</div>

