<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Dob Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dob', 'Dob:') !!}
    {!! Form::text('dob', null, ['class' => 'form-control','id'=>'dob']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#dob').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Age Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age', 'Age:') !!}
    {!! Form::number('age', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:') !!}
    {!! Form::text('language', null, ['class' => 'form-control']) !!}
</div>

<!-- Goal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('goal', 'Goal:') !!}
    {!! Form::text('goal', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Workout Days In A Week Field -->
<div class="form-group col-sm-6">
    {!! Form::label('workout_days_in_a_week', 'Workout Days In A Week:') !!}
    {!! Form::text('workout_days_in_a_week', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- How Long Time To Workout Field -->
<div class="form-group col-sm-6">
    {!! Form::label('how_long_time_to_workout', 'How Long Time To Workout:') !!}
    {!! Form::text('how_long_time_to_workout', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Workout Duration Per Day Field -->
<div class="form-group col-sm-6">
    {!! Form::label('workout_duration_per_day', 'Workout Duration Per Day:') !!}
    {!! Form::text('workout_duration_per_day', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Equipment Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('equipment_type', 'Equipment Type:') !!}
    {!! Form::text('equipment_type', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Height In Cm Field -->
<div class="form-group col-sm-6">
    {!! Form::label('height_in_cm', 'Height In Cm:') !!}
    {!! Form::number('height_in_cm', null, ['class' => 'form-control']) !!}
</div>

<!-- Height Field -->
<div class="form-group col-sm-6">
    {!! Form::label('height', 'Height:') !!}
    {!! Form::number('height', null, ['class' => 'form-control']) !!}
</div>

<!-- Height Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('height_unit', 'Height Unit:') !!}
    {!! Form::text('height_unit', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Current Weight In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_weight_in_kg', 'Current Weight In Kg:') !!}
    {!! Form::number('current_weight_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Current Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_weight', 'Current Weight:') !!}
    {!! Form::number('current_weight', null, ['class' => 'form-control']) !!}
</div>

<!-- Current Weight Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_weight_unit', 'Current Weight Unit:') !!}
    {!! Form::text('current_weight_unit', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Target Weight In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('target_weight_in_kg', 'Target Weight In Kg:') !!}
    {!! Form::number('target_weight_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Target Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('target_weight', 'Target Weight:') !!}
    {!! Form::number('target_weight', null, ['class' => 'form-control']) !!}
</div>

<!-- Target Weight Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('target_weight_unit', 'Target Weight Unit:') !!}
    {!! Form::text('target_weight_unit', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Reach Goal Target Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reach_goal_target_date', 'Reach Goal Target Date:') !!}
    {!! Form::text('reach_goal_target_date', null, ['class' => 'form-control','id'=>'reach_goal_target_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#reach_goal_target_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Body Parts Field -->
<div class="form-group col-sm-6">
    {!! Form::label('body_parts', 'Body Parts:') !!}
    {!! Form::text('body_parts', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Physically Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('physically_active', 'Physically Active:') !!}
    {!! Form::text('physically_active', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::text('level', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Squat  One Rep Max In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('squat__one_rep_max_in_kg', 'Squat  One Rep Max In Kg:') !!}
    {!! Form::number('squat__one_rep_max_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Deadlift  One Rep Max In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deadlift__one_rep_max_in_kg', 'Deadlift  One Rep Max In Kg:') !!}
    {!! Form::number('deadlift__one_rep_max_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Bench  One Rep Max In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bench__one_rep_max_in_kg', 'Bench  One Rep Max In Kg:') !!}
    {!! Form::number('bench__one_rep_max_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Overhead  One Rep Max In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('overhead__one_rep_max_in_kg', 'Overhead  One Rep Max In Kg:') !!}
    {!! Form::number('overhead__one_rep_max_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Health Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('health_status', 'Health Status:') !!}
    {!! Form::text('health_status', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Daily Steps Taken Field -->
<div class="form-group col-sm-6">
    {!! Form::label('daily_steps_taken', 'Daily Steps Taken:') !!}
    {!! Form::text('daily_steps_taken', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    {!! Form::text('diet_type', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Food Preferences Field -->
<div class="form-group col-sm-6">
    {!! Form::label('food_preferences', 'Food Preferences:') !!}
    {!! Form::text('food_preferences', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Calories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('calories', 'Calories:') !!}
    {!! Form::number('calories', null, ['class' => 'form-control']) !!}
</div>

<!-- Algo Required Calories Field -->
<div class="form-group col-sm-6">
    {!! Form::label('algo_required_calories', 'Algo Required Calories:') !!}
    {!! Form::number('algo_required_calories', null, ['class' => 'form-control']) !!}
</div>

<!-- Bmi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bmi', 'Bmi:') !!}
    {!! Form::number('bmi', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control','maxlength' => 191,'maxlength' => 191,'maxlength' => 191]) !!}
</div>

<!-- Workout Plan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('workout_plan_id', 'Workout Plan Id:') !!}
    {!! Form::number('workout_plan_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Nutrition Plan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nutrition_plan_id', 'Nutrition Plan Id:') !!}
    {!! Form::number('nutrition_plan_id', null, ['class' => 'form-control']) !!}
</div>