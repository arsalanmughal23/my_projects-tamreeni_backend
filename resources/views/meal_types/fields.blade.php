<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (English):', ['class'=>'required']) !!}
    {!! Form::text('name[en]', isset($mealType)?$mealType->getTranslation('name', 'en'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern'=>'[a-zA-Z0-9_.\s]{0,70}']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name (Arabic):', ['class'=>'required']) !!}
    {!! Form::text('name[ar]', isset($mealType)?$mealType->getTranslation('name', 'ar'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'dir'=>'rtl', 'pattern'=>'[a-zA-Z0-9_.\s]{0,70}']) !!}
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