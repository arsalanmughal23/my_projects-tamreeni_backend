<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Part Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('body_part_id', 'Body Part Id:') !!}
    {!! Form::number('body_part_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Duration In M Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration_in_m', 'Duration In M:') !!}
    {!! Form::number('duration_in_m', null, ['class' => 'form-control']) !!}
</div>

<!-- Sets Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sets', 'Sets:') !!}
    {!! Form::number('sets', null, ['class' => 'form-control']) !!}
</div>

<!-- Reps Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reps', 'Reps:') !!}
    {!! Form::number('reps', null, ['class' => 'form-control']) !!}
</div>

<!-- Burn Calories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('burn_calories', 'Burn Calories:') !!}
    {!! Form::number('burn_calories', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::textarea('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Video Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('video', 'Video:') !!}
    {!! Form::textarea('video', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>