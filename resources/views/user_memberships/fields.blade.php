<!-- Title Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Membership Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('membership_id', 'Membership Id:') !!}
    {!! Form::number('membership_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Membership Duration Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('membership_duration_id', 'Membership Duration Id:') !!}
    {!! Form::number('membership_duration_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Duration In Month Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration_in_month', 'Duration In Month:') !!}
    {!! Form::number('duration_in_month', null, ['class' => 'form-control']) !!}
</div>

<!-- Expire At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expire_at', 'Expire At:') !!}
    {!! Form::text('expire_at', null, ['class' => 'form-control','id'=>'expire_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#expire_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>