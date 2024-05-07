<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (English):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($exerciseEquipment)?$exerciseEquipment->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern'=>'[a-zA-Z0-9_.\s]{0,70}']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Arabic):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($exerciseEquipment)?$exerciseEquipment->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'dir'=>'rtl', 'pattern'=>'[a-zA-Z0-9_.\s]{0,70}']) !!}
</div>

<!-- Body Part Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:', ['class'=>'required']) !!}

    <select name="type" class="form-control" required>
        <option value="">Select</option>
        <option value="All Equipments"
                @if(isset($exerciseEquipment) && $exerciseEquipment->type == "All Equipments") selected @endif>All
            Equipments
        </option>
        <option value="Machines"
                @if(isset($exerciseEquipment) && $exerciseEquipment->type == "Machines") selected @endif>Machines
        </option>
        <option value="Free Weights"
                @if(isset($exerciseEquipment) && $exerciseEquipment->type == "Free Weights") selected @endif>Free
            Weights
        </option>
        <option value="No Equipment At All"
                @if(isset($exerciseEquipment) && $exerciseEquipment->type == "No Equipment At All") selected @endif>No
            Equipment At All
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