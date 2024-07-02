<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $questionAnswerAttempt->user_id }}</p>
</div>

<!-- Dob Field -->
<div class="col-sm-12">
    {!! Form::label('dob', 'Dob:') !!}
    <p>{{ $questionAnswerAttempt->dob }}</p>
</div>

<!-- Age Field -->
<div class="col-sm-12">
    {!! Form::label('age', 'Age:') !!}
    <p>{{ $questionAnswerAttempt->age }}</p>
</div>

<!-- Gender Field -->
<div class="col-sm-12">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{{ $questionAnswerAttempt->gender }}</p>
</div>

<!-- Language Field -->
<div class="col-sm-12">
    {!! Form::label('language', 'Language:') !!}
    <p>{{ $questionAnswerAttempt->language }}</p>
</div>

<!-- Goal Field -->
<div class="col-sm-12">
    {!! Form::label('goal', 'Goal:') !!}
    <p>{{ $questionAnswerAttempt->goal }}</p>
</div>

<!-- Workout Days In A Week Field -->
<div class="col-sm-12">
    {!! Form::label('workout_days_in_a_week', 'Workout Days In A Week:') !!}
    <p>{{ $questionAnswerAttempt->workout_days_in_a_week }}</p>
</div>

<!-- How Long Time To Workout Field -->
<div class="col-sm-12">
    {!! Form::label('how_long_time_to_workout', 'How Long Time To Workout:') !!}
    <p>{{ $questionAnswerAttempt->how_long_time_to_workout }}</p>
</div>

<!-- Workout Duration Per Day Field -->
<div class="col-sm-12">
    {!! Form::label('workout_duration_per_day', 'Workout Duration Per Day:') !!}
    <p>{{ $questionAnswerAttempt->workout_duration_per_day }}</p>
</div>

<!-- Equipment Type Field -->
<div class="col-sm-12">
    {!! Form::label('equipment_type', 'Equipment Type:') !!}
    <p>{{ $questionAnswerAttempt->equipment_type }}</p>
</div>

<!-- Height In Cm Field -->
<div class="col-sm-12">
    {!! Form::label('height_in_cm', 'Height In Cm:') !!}
    <p>{{ $questionAnswerAttempt->height_in_cm }}</p>
</div>

<!-- Height Field -->
<div class="col-sm-12">
    {!! Form::label('height', 'Height:') !!}
    <p>{{ $questionAnswerAttempt->height }}</p>
</div>

<!-- Height Unit Field -->
<div class="col-sm-12">
    {!! Form::label('height_unit', 'Height Unit:') !!}
    <p>{{ $questionAnswerAttempt->height_unit }}</p>
</div>

<!-- Current Weight In Kg Field -->
<div class="col-sm-12">
    {!! Form::label('current_weight_in_kg', 'Current Weight In Kg:') !!}
    <p>{{ $questionAnswerAttempt->current_weight_in_kg }}</p>
</div>

<!-- Current Weight Field -->
<div class="col-sm-12">
    {!! Form::label('current_weight', 'Current Weight:') !!}
    <p>{{ $questionAnswerAttempt->current_weight }}</p>
</div>

<!-- Current Weight Unit Field -->
<div class="col-sm-12">
    {!! Form::label('current_weight_unit', 'Current Weight Unit:') !!}
    <p>{{ $questionAnswerAttempt->current_weight_unit }}</p>
</div>

<!-- Target Weight In Kg Field -->
<div class="col-sm-12">
    {!! Form::label('target_weight_in_kg', 'Target Weight In Kg:') !!}
    <p>{{ $questionAnswerAttempt->target_weight_in_kg }}</p>
</div>

<!-- Target Weight Field -->
<div class="col-sm-12">
    {!! Form::label('target_weight', 'Target Weight:') !!}
    <p>{{ $questionAnswerAttempt->target_weight }}</p>
</div>

<!-- Target Weight Unit Field -->
<div class="col-sm-12">
    {!! Form::label('target_weight_unit', 'Target Weight Unit:') !!}
    <p>{{ $questionAnswerAttempt->target_weight_unit }}</p>
</div>

<!-- Reach Goal Target Date Field -->
<div class="col-sm-12">
    {!! Form::label('reach_goal_target_date', 'Reach Goal Target Date:') !!}
    <p>{{ $questionAnswerAttempt->reach_goal_target_date }}</p>
</div>

<!-- Body Parts Field -->
<div class="col-sm-12">
    {!! Form::label('body_parts', 'Body Parts:') !!}
    <p>{{ implode(', ', $questionAnswerAttempt->body_parts) }}</p>
</div>

<!-- Physically Active Field -->
<div class="col-sm-12">
    {!! Form::label('physically_active', 'Physically Active:') !!}
    <p>{{ $questionAnswerAttempt->physically_active }}</p>
</div>

<!-- Level Field -->
<div class="col-sm-12">
    {!! Form::label('level', 'Level:') !!}
    <p>{{ $questionAnswerAttempt->level }}</p>
</div>

<!-- Squat  One Rep Max In Kg Field -->
<div class="col-sm-12">
    {!! Form::label('squat__one_rep_max_in_kg', 'Squat  One Rep Max In Kg:') !!}
    <p>{{ $questionAnswerAttempt->squat__one_rep_max_in_kg }}</p>
</div>

<!-- Deadlift  One Rep Max In Kg Field -->
<div class="col-sm-12">
    {!! Form::label('deadlift__one_rep_max_in_kg', 'Deadlift  One Rep Max In Kg:') !!}
    <p>{{ $questionAnswerAttempt->deadlift__one_rep_max_in_kg }}</p>
</div>

<!-- Bench  One Rep Max In Kg Field -->
<div class="col-sm-12">
    {!! Form::label('bench__one_rep_max_in_kg', 'Bench  One Rep Max In Kg:') !!}
    <p>{{ $questionAnswerAttempt->bench__one_rep_max_in_kg }}</p>
</div>

<!-- Overhead  One Rep Max In Kg Field -->
<div class="col-sm-12">
    {!! Form::label('overhead__one_rep_max_in_kg', 'Overhead  One Rep Max In Kg:') !!}
    <p>{{ $questionAnswerAttempt->overhead__one_rep_max_in_kg }}</p>
</div>

<!-- Health Status Field -->
<div class="col-sm-12">
    {!! Form::label('health_status', 'Health Status:') !!}
    <p>{{ $questionAnswerAttempt->health_status }}</p>
</div>

<!-- Daily Steps Taken Field -->
<div class="col-sm-12">
    {!! Form::label('daily_steps_taken', 'Daily Steps Taken:') !!}
    <p>{{ $questionAnswerAttempt->daily_steps_taken }}</p>
</div>

<!-- Diet Type Field -->
<div class="col-sm-12">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    <p>{{ $questionAnswerAttempt->diet_type }}</p>
</div>

<!-- Food Preferences Field -->
<div class="col-sm-12">
    {!! Form::label('food_preferences', 'Food Preferences:') !!}
    <p>{{ implode(', ', $questionAnswerAttempt->food_preferences) }}</p>
</div>

<!-- Calories Field -->
<div class="col-sm-12">
    {!! Form::label('calories', 'Calories:') !!}
    <p>{{ $questionAnswerAttempt->calories }}</p>
</div>

<!-- Algo Required Calories Field -->
<div class="col-sm-12">
    {!! Form::label('algo_required_calories', 'Algo Required Calories:') !!}
    <p>{{ $questionAnswerAttempt->algo_required_calories }}</p>
</div>

<!-- Bmi Field -->
<div class="col-sm-12">
    {!! Form::label('bmi', 'Bmi:') !!}
    <p>{{ $questionAnswerAttempt->bmi }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <div class="btn btn-sm btn-{{ $questionAnswerAttempt->status_class }}">{{ $questionAnswerAttempt->status }}</div>
</div>

<!-- Workout Plan Id Field -->
<div class="col-sm-12">
    {!! Form::label('workout_plan_id', 'Workout Plan Id:') !!}
    <p>{{ $questionAnswerAttempt->workout_plan_id }}</p>
</div>

<!-- Nutrition Plan Id Field -->
<div class="col-sm-12">
    {!! Form::label('nutrition_plan_id', 'Nutrition Plan Id:') !!}
    <p>{{ $questionAnswerAttempt->nutrition_plan_id }}</p>
</div>

