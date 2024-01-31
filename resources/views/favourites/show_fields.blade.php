<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $favourite->user_id }}</p>
</div>

<!-- Instance Id Field -->
<div class="col-sm-12">
    {!! Form::label('instance_id', 'Instance Id:') !!}
    <p>{{ $favourite->instance_id }}</p>
</div>

<!-- Instance Type Field -->
<div class="col-sm-12">
    {!! Form::label('instance_type', 'Instance Type:') !!}
    <p>{{ $favourite->instance_type }}</p>
</div>

