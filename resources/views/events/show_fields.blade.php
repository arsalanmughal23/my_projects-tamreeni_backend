<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $event->title }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $event->date }}</p>
</div>

<!-- Start Time Field -->
<div class="col-sm-12">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{{ $event->start_time }}</p>
</div>

<!-- End Time Field -->
<div class="col-sm-12">
    {!! Form::label('end_time', 'End Time:') !!}
    <p>{{ $event->end_time }}</p>
</div>

<!-- Duration Field -->
<div class="col-sm-12">
    {!! Form::label('duration', 'Duration:') !!}
    <p>{{ ($event->duration ?? 0) . ' m' }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $event->description }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>
        <img class="event-image"
            src="{{ isset($event)? $event?->image : asset('public/image/user.png') }}"
            width="100" onerror="brokenImageHandler(this);">
    </p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $event->user?->name ?? 'N/A' }}</p>
</div>

<!-- Body Part Id Field -->
<div class="col-sm-12">
    {!! Form::label('body_part_id', 'Body Part Id:') !!}
    <p>{{ $event->bodyPart?->name ?? 'N/A' }}</p>
</div>

<!-- Equipment Id Field -->
<div class="col-sm-12">
    {!! Form::label('equipment_id', 'Equipment Id:') !!}
    <p>{{ $event->equipment?->name ?? 'N/A' }}</p>
</div>

