<!-- Goal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('goal', 'Goal:') !!}
    <!-- {!! Form::text('goal', null, ['class' => 'form-control']) !!} -->
    <select name="goal" id="" class="form-control" required=true >
        <option value="">Select Goal</option>
        <option value="lose_weight" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->goal == 'lose_weight' ? 'selected' : '') : '' }}>Lose Weight</option>
        <option value="gain_weight" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->goal == 'gain_weight' ? 'selected' : '') : '' }}>Gain Weight</option>
        <option value="build_muscle" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->goal == 'build_muscle' ? 'selected' : '') : '' }}>Build Muscle</option>
        <option value="get_fit" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->goal == 'get_fit' ? 'selected' : '') : '' }}>Get Fit</option>
    </select>
</div>

<!-- How Long Time To Workout Field -->
<div class="form-group col-sm-6">
    {!! Form::label('how_long_time_to_workout', 'How Long Time To Workout:') !!}
    <!-- {!! Form::text('how_long_time_to_workout', null, ['class' => 'form-control']) !!} -->
    <select name="how_long_time_to_workout" id="" class="form-control" required=true >
        <option value="">Select Long Time to Workout</option>
        <option value="30_mins" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->how_long_time_to_workout == '30_mins' ? 'selected' : '') : '' }}>30 mins</option>
        <option value="45_mins" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->how_long_time_to_workout == '45_mins' ? 'selected' : '') : '' }}>45 mins</option>
        <option value="1_hour" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->how_long_time_to_workout == '1_hour' ? 'selected' : '') : '' }}>1 hour</option>
        <option value="more_than_1_hour" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->how_long_time_to_workout == 'more_than_1_hour' ? 'selected' : '') : '' }}>More than 1 hour</option>
    </select>
</div>

<!-- Exercise Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('exercise_category', 'Exercise Category:') !!}
    <!-- {!! Form::text('exercise_category', null, ['class' => 'form-control']) !!} -->
    <select name="exercise_category" id="" class="form-control" required=true >
        <option value="">Select Exercise Category</option>
        <option value="major_lift" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->exercise_category == 'major_lift' ? 'selected' : '') : '' }}>Major Lift</option>
        <option value="single_joint" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->exercise_category == 'single_joint' ? 'selected' : '') : '' }}>Single Joint</option>
        <option value="multi_joint" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->exercise_category == 'multi_joint' ? 'selected' : '') : '' }}>Multi Joint</option>
        <option value="cardio" {{ isset($exerciseBreakdown) ? ($exerciseBreakdown->exercise_category == 'cardio' ? 'selected' : '') : '' }}>Cardio</option>
    </select>
</div>

<!-- Exercise Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('exercise_count', 'Exercise Count:') !!}
    {!! Form::number('exercise_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Sets Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sets', 'Sets:') !!}
    {!! Form::text('sets', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Reps Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reps', 'Reps:') !!}
    {!! Form::text('reps', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>
