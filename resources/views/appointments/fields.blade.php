<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    {!! Form::number('customer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Slot Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slot_id', 'Slot Id:') !!}
    {!! Form::number('slot_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Package Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('package_id', 'Package Id:') !!}
    {!! Form::number('package_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Transaction Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    {!! Form::number('transaction_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Profession Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('profession_type', 'Profession Type:') !!}
    {!! Form::number('profession_type', null, ['class' => 'form-control']) !!}
</div>