<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Start Date:') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#start_date').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- End Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#end_date').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Project Manager Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('project_manager', 'Project Manager:') !!}
    {!! Form::number('project_manager', null, ['class' => 'form-control']) !!}
</div> --}}

<div class="form-group col-sm-6">
    {!! Form::label('project_manager', 'Project Manager:') !!}
    <select class="form-control" name="project_manager_id" style="width: 100%;" required>
        <option> Select Project Manager</option>
        @foreach($project_managers as $item)
            <option data-icon="fa-{{$item}}"
            value="{{$item->id}}" {{ isset($project) && $project->project_manager_id == $item->id ? 'selected' : '' }} > {{ ucwords($item->name) }}</option>
        @endforeach
    </select>
</div>

<!-- Business Analyst Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('business_analyst_id', 'Business Analyst Id:') !!}
    {!! Form::number('business_analyst_id', null, ['class' => 'form-control']) !!}
</div> --}}

<div class="form-group col-sm-6">
    {!! Form::label('project_manager', 'Business Analyst :') !!}
    <select class="form-control" name="business_analyst_id" style="width: 100%;" required>
        <option> Select Business Analyst </option>
        @foreach($bussiness_analysts as $item)
            <option data-icon="fa-{{$item}}"
            value="{{$item->id}}"  {{ isset($project) && $project->business_analyst_id == $item->id ? 'selected' : '' }}> {{ ucwords($item->name) }}</option>
        @endforeach
    </select>
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('active', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('active', 'Active', ['class' => 'form-check-label']) !!}
    </div>
</div>
