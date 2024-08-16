
<h2>Personal Statistics</h2>
<!-- Goal Field -->
<div class="col-sm-12" id="target_weight">
    {!! Form::label('target_weight', 'Goal:') !!}
    <p>{{ $userDetail->target_weight . ' ' . $userDetail->target_weight_unit }}</p>
</div>

<!-- Current Weight Field -->
<div class="col-sm-12" id="current_weight">
    {!! Form::label('current_weight', 'Current Weight:') !!}
    <p>{{ $userDetail->current_weight . ' ' . $userDetail->current_weight_unit }}</p>
</div>

<!-- Calories Field -->
<div class="col-sm-12" id="calories">
    {!! Form::label('calories', 'Calories:') !!}
    <p>{{ $userDetail->calories }}</p>
</div>

<!-- Algo Required Calories Field -->
<div class="col-sm-12" id="algo_required_calories">
    {!! Form::label('algo_required_calories', 'Algo Required Calories:') !!}
    <p>{{ $userDetail->algo_required_calories }}</p>
</div>

@if(isset($personalStatistics))

    <!-- Current Calories Field -->
    <div class="col-sm-12" id="calories">
        {!! Form::label('calories', 'Current Calories:') !!}
        <p>{{ $userDetail->calories }}</p>
    </div>

    <!-- Required Calories Field -->
    <div class="col-sm-12" id="current_day_required_calories">
        {!! Form::label('current_day_required_calories', 'Required Calories:') !!}
        <p>{{ $personalStatistics['current_day_required_calories'] }}</p>
    </div>

    <!-- Time Required Field -->
    <div class="col-sm-12" id="workout_week_count">
        {!! Form::label('workout_week_count', 'Time Required:') !!}
        <p>{{ $personalStatistics['workout_week_count'] ?? 0 }}</p>
    </div>

    <!-- Total Calories Target Field -->
    <div class="col-sm-12" id="current_week_target_calroies">
        {!! Form::label('current_week_target_calroies', 'Total Calories Target:') !!}
        <p>{{ $personalStatistics['current_week_target_calroies'] ?? 0 }}</p>
    </div>

    <!-- Consumed Each Week Calories Field -->
    <div class="col-sm-12" id="current_week_consumed_calroies">
        {!! Form::label('current_week_consumed_calroies', 'Consumed Each Week Calories:') !!}
        <p>{{ $personalStatistics['current_week_consumed_calroies'] ?? 0 }}</p>
    </div>
@endif

<!-- BMI Field -->
<div class="col-sm-12">
    {!! Form::label('bmi', 'BMI:') !!}
    <p>{{ $userDetail->bmi }}</p>
</div>
