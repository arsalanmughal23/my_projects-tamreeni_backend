<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $favourite->user_id }}</p>
</div>

<!-- Favouritable Id Field -->
<div class="col-sm-12">
    {!! Form::label('favouritable_id', 'Favouritable Id:') !!}
    <p>{{ $favourite->favouritable_id }}</p>
</div>

<!-- Favouritable Type Field -->
<div class="col-sm-12">
    {!! Form::label('favouritable_type', 'Favouritable Type:') !!}
    <p>{{ $favourite->favouritable_type }}</p>
</div>
