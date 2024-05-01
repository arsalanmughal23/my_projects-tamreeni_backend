<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (En):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($bodyPart)?$bodyPart->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 50, 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Ar):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($bodyPart)?$bodyPart->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 50, 'required', 'dir'=>'rtl']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:', ['class'=>'required']) !!}
    {!! Form::file('image', ['class' => 'form-control', (isset($bodyPart)) ? '' : 'required' => 'required', 'accept' => 'image/jpeg,image/png']) !!}

    <br>
    <br>

    @if(isset($bodyPart))
    <!-- Image Field -->
        <img src="{{ $bodyPart->image}}" width="100" onerror="brokenImageHandler(this);">
    @endif
</div>