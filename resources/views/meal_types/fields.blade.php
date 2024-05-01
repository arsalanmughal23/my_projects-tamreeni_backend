<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (En):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($mealType)?$mealType->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 50, 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Ar):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($mealType)?$mealType->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 50, 'required', 'dir'=>'rtl']) !!}
</div>

@if(isset($mealType))
    <!-- Status Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('status', 'Status:') !!}
        <select name="status" class="form-control" required>
            <option value="1" @if($mealType->status == 1) selected @endif>Yes</option>
            <option value="0" @if($mealType->status == 0) selected @endif>No</option>
        </select>
    </div>
@endif