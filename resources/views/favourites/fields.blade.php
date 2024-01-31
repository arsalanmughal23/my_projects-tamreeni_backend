<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Instance Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('instance_id', 'Instance Id:') !!}
    {!! Form::number('instance_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Instance Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('instance_type', 'Instance Type:') !!}
    {!! Form::text('instance_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>