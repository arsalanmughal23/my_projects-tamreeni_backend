<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $exercise->user_id }}</p>
</div>

<!-- Body Part Id Field -->
<div class="col-sm-12">
    {!! Form::label('body_part_id', 'Body Part Id:') !!}
    <p>{{ $exercise->body_part_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $exercise->name }}</p>
</div>

<!-- Duration In M Field -->
<div class="col-sm-12">
    {!! Form::label('duration_in_m', 'Duration In M:') !!}
    <p>{{ $exercise->duration_in_m }}</p>
</div>

<!-- Sets Field -->
<div class="col-sm-12">
    {!! Form::label('sets', 'Sets:') !!}
    <p>{{ $exercise->sets }}</p>
</div>

<!-- Reps Field -->
<div class="col-sm-12">
    {!! Form::label('reps', 'Reps:') !!}
    <p>{{ $exercise->reps }}</p>
</div>

<!-- Burn Calories Field -->
<div class="col-sm-12">
    {!! Form::label('burn_calories', 'Burn Calories:') !!}
    <p>{{ $exercise->burn_calories }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $exercise->image }}</p>
</div>

<!-- Video Field -->
<div class="col-sm-12">
    {!! Form::label('video', 'Video:') !!}
    <p>{{ $exercise->video }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $exercise->description }}</p>
</div>

