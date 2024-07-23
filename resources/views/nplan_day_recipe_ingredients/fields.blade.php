<!-- Recipe Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recipe_id', 'Recipe Id:') !!}
    {!! Form::number('recipe_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::textarea('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit', 'Unit:') !!}
    {!! Form::text('unit', null, ['class' => 'form-control']) !!}
</div>

<!-- Scaled Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scaled_quantity', 'Scaled Quantity:') !!}
    {!! Form::number('scaled_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Scaled Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scaled_unit', 'Scaled Unit:') !!}
    {!! Form::text('scaled_unit', null, ['class' => 'form-control']) !!}
</div>