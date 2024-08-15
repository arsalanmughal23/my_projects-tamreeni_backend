<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (English):') !!}
    {!! Form::text('title[en]', isset($event) ? $event->getTranslation('title', 'en') : null, ['class' => 'form-control', 'maxlength' => 255, 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (Arabic):') !!}
    {!! Form::text('title[ar]', isset($event) ? $event->getTranslation('title', 'ar') : null, ['class' => 'form-control', 'maxlength' => 255, 'dir'=>'rtl', 'pattern'=>'[ا-ي0-9_.\s+\-]{0,70}']) !!}
</div>

@if(false)
    <!-- Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('date', 'Date:') !!}
        {!! Form::text('date', null, ['class' => 'form-control', 'id'=>'date']) !!}
    </div>

    @push('page_scripts')
        <script type="text/javascript">
            $('#date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                useCurrent: true,
                sideBySide: true
            })
        </script>
    @endpush
@endif

<!-- Date Field -->
<div class="form-group col-sm-4">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control', 'min' => now()->format('Y-m-d')]) !!}
</div>

<!-- Start Time Field -->
<div class="form-group col-sm-4">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::time('start_time', null, ['class' => 'form-control']) !!}
</div>

<!-- End Time Field -->
<div class="form-group col-sm-4">
    {!! Form::label('end_time', 'End Time:') !!}
    {!! Form::time('end_time', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('user_id', 'User:') !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
</div>

<!-- Body Part Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('body_part_id', 'Body Part:') !!}
    {!! Form::select('body_part_id', $bodyParts, null, ['class' => 'form-control']) !!}
</div>

<!-- Equipment Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('equipment_id', 'Equipment:') !!}
    {!! Form::select('equipment_id', $exerciseEquipments, null, ['class' => 'form-control']) !!}
</div>

<!-- Duration Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::number('duration', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', null, ['class' => 'form-control', 'accept' => 'image/jpeg,image/png']) !!}

    @if(isset($event))
        <!-- Image Field -->
        <img src="{{ $event->image }}" width="80" onerror="brokenImageHandler(this);">
    @endif
</div>

<!-- Description (English) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (English):') !!}
    {!! Form::textarea('description[en]', isset($event) ? $event->getTranslation('description', 'en') : null, ['class' => 'form-control']) !!}
</div>

<!-- Description (Arabic) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('description', 'Description (Arabic):') !!}
    {!! Form::textarea('description[ar]', isset($event) ? $event->getTranslation('description', 'ar') : null, ['class' => 'form-control', 'dir'=>'rtl', 'pattern'=>'[ا-ي0-9_.\s+\-]{0,70}']) !!}
</div>
