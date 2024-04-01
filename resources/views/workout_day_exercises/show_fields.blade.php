<!-- Workout Day Id Field -->
<div class="col-sm-12">
    {!! Form::label('workout_day_id', 'Workout Day Id:') !!}
    <p>{{ $workoutDayExercise->workout_day_id }}</p>
</div>

<!-- Exercise Id Field -->
<div class="col-sm-12">
    {!! Form::label('exercise_id', 'Exercise Id:') !!}
    <p>{{ $workoutDayExercise->exercise_id }}</p>
</div>

<!-- Duration Field -->
<div class="col-sm-12">
    {!! Form::label('duration', 'Duration:') !!}
    <p>{{ $workoutDayExercise->duration }}</p>
</div>

<!-- Sets Field -->
<div class="col-sm-12">
    {!! Form::label('sets', 'Sets:') !!}
    <p>{{ $workoutDayExercise->sets }}</p>
</div>

<!-- Reps Field -->
<div class="col-sm-12">
    {!! Form::label('reps', 'Reps:') !!}
    <p>{{ $workoutDayExercise->reps }}</p>
</div>

<!-- Burn Calories Field -->
<div class="col-sm-12">
    {!! Form::label('burn_calories', 'Burn Calories:') !!}
    <p>{{ $workoutDayExercise->burn_calories }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $workoutDayExercise->status }}</p>
</div>

