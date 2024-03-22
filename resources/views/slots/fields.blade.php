<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Slot Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slot_time', 'Slot Time:') !!}
    {!! Form::text('slot_time', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::number('type', null, ['class' => 'form-control']) !!}
</div>