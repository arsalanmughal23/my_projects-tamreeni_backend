<!-- Name En Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (En):') !!}
    <p>{{ $exerciseEquipment->getTranslation('name', 'en') }}</p>
</div>

<!-- Name Ar Field -->
<div class="col-sm-12">
    {!! Form::label('name_en', 'Name (Ar):') !!}
    <p>{{ $exerciseEquipment->getTranslation('name', 'ar') }}</p>
</div>


<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $exerciseEquipment->type }}</p>
</div>


<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('Icon', 'Icon:') !!}
    <p><img src="{{ $exerciseEquipment->icon }}" width="50" height="50" onerror="brokenImageHandler(this);"></p>
</div>

<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $exerciseEquipment->created_at }}</p>
</div>


