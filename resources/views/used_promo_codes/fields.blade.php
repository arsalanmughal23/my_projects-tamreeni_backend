<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control', 'readonly' => true, 'disabled' => true]) !!}
</div>

<!-- Morphable Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('morphable_type', 'Morphable Type:') !!}
    {!! Form::text('morphable_type', null, ['class' => 'form-control','maxlength' => 191, 'readonly' => true, 'disabled' => true]) !!}
</div>

<!-- Morphable Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('morphable_id', 'Morphable Id:') !!}
    {!! Form::number('morphable_id', null, ['class' => 'form-control', 'readonly' => true, 'disabled' => true]) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::number('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>