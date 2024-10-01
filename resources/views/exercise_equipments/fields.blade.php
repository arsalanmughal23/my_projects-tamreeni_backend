<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (English):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($exerciseEquipment)?$exerciseEquipment->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Arabic):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($exerciseEquipment)?$exerciseEquipment->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'dir'=>'rtl', 'pattern'=>'[ا-ي0-9_.\s+-]{0,70}']) !!}
</div>

<!-- Body Part Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}

    <select name="type_slug" class="form-control">
        <option value="">Select</option>
        <option value="machines"
                @if(isset($exerciseEquipment) && $exerciseEquipment->type_slug == "machines") selected @endif>Machines
        </option>
        <option value="free_weight"
                @if(isset($exerciseEquipment) && $exerciseEquipment->type_slug == "free_weight") selected @endif>Free
            Weights
        </option>
    </select>
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', 'Icon:', ['class'=>'required']) !!}
    {!! Form::file('image', ['class' => 'form-control', (isset($exerciseEquipment)) ? '' : 'required' => 'required', 'accept' => 'image/jpeg,image/png']) !!}
    <br>
    <br>
    @if(isset($exerciseEquipment))
    <!-- Image Field -->
        <img src="{{ $exerciseEquipment->icon}}" width="100" onerror="brokenImageHandler(this);">
    @endif
</div>
