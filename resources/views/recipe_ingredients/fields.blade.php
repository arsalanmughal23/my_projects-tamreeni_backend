<!-- Recipe Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recipe_id', 'Recipe Id:') !!}
    <!-- {!! Form::select('recipe_id', $recipeSelectOptions, null, ['class' => 'form-control', 'required' => true]) !!} -->
    <select name="recipe_id" id="" class="form-control" required=true >
        <option value="">Select Recipe</option>
        @foreach($recipeSelectOptions as $key => $value)
            <option value="{{ $key }}" {{ isset($recipeIngredient) ? ($recipeIngredient->recipe_id == $key ? 'selected' : '') : '' }}>{{ $value['en'] ?? '' }}</option>
        @endforeach
    </select>
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    <!-- {!! Form::select('type', $typeSelectOptions, null, ['class' => 'form-control', 'required' => true]) !!} -->
    <select name="type" id="" class="form-control" required=true >
        <option value="">Select Type</option>
        @foreach($typeSelectOptions as $type)
            <option value="{{ $type }}" {{ isset($recipeIngredient) ? ($recipeIngredient->type == $type ? 'selected' : '') : '' }}>{{ $type ?? '' }}</option>
        @endforeach
    </select>
</div>

<!-- Name (English) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('name', 'Name (English):') !!}
    {!! Form::text('name[en]', null, ['class' => 'form-control', 'required' => true, 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Name (Arabic) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('name', 'Name (Arabic):') !!}
    {!! Form::text('name[ar]', null, ['class' => 'form-control', 'required' => true, 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit', 'Unit:') !!}
    <!-- {!! Form::select('unit', $unitSelectOptions, null, ['class' => 'form-control', 'required' => 'required']) !!} -->
    <select name="unit" id="" class="form-control" required=true >
        <option value="">Select Unit</option>
        @foreach($unitSelectOptions as $unit)
            <option value="{{ $unit }}"  {{ isset($recipeIngredient) ? ($recipeIngredient->unit == $unit ? 'selected' : '') : '' }}>{{ $unit ?? '' }}</option>
        @endforeach
    </select>
</div>