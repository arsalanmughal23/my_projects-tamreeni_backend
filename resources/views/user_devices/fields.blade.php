<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Device Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_type', 'Device Type:') !!}
    {!! Form::text('device_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Device Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_token', 'Device Token:') !!}
    {!! Form::text('device_token', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>
