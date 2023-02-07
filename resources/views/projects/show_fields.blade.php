<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $project->name }}</p>
</div>

<!-- Start Date Field -->
<div class="col-sm-12">
    {!! Form::label('start_date', 'Start Date:') !!}
    <p>{{ $project->start_date }}</p>
</div>

<!-- End Date Field -->
<div class="col-sm-12">
    {!! Form::label('end_date', 'End Date:') !!}
    <p>{{ $project->end_date }}</p>
</div>

<!-- Project Manager Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_manager_id', 'Project Manager Id:') !!}
    <p>{{ $project->project_manager_id }}</p>
</div>

<!-- Business Analyst Id Field -->
<div class="col-sm-12">
    {!! Form::label('business_analyst_id', 'Business Analyst Id:') !!}
    <p>{{ $project->business_analyst_id }}</p>
</div>

<!-- Active Field -->
<div class="col-sm-12">
    {!! Form::label('active', 'Active:') !!}
    <p>{{ $project->active }}</p>
</div>

