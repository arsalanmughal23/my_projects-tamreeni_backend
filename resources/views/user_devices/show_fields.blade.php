<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userDevice->user_id }}</p>
</div>

<!-- Device Type Field -->
<div class="col-sm-12">
    {!! Form::label('device_type', 'Device Type:') !!}
    <p>{{ $userDevice->device_type }}</p>
</div>

<!-- Device Token Field -->
<div class="col-sm-12">
    {!! Form::label('device_token', 'Device Token:') !!}
    <p>{{ $userDevice->device_token }}</p>
</div>
