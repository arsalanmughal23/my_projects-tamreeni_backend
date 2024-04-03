<!-- Nutrition Plan Id Field -->
<div class="col-sm-12">
    {!! Form::label('nutrition_plan_id', 'Nutrition Plan Id:') !!}
    <p>{{ $nutritionPlanDay->nutrition_plan_id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $nutritionPlanDay->name }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $nutritionPlanDay->status }}</p>
</div>

