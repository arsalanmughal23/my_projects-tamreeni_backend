<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', null, ['class' => 'form-control', 'accept' => 'image/jpeg,image/png']) !!}

    @if(isset($userDetail))
        <!-- Image Field -->
        <img src="{{ $userDetail->image }}" width="80" onerror="brokenImageHandler(this);">
    @endif
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'maxlength' => 255, 'disabled' => true]) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control', 'maxlength' => 255, 'disabled' => true]) !!}
</div>

<!-- Dob Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dob', 'Dob:') !!}
    {!! Form::date('dob', isset($userDetail) ? $userDetail->dob->format('Y-m-d') : null, ['class' => 'form-control', 'max' => now()->format('Y-m-d'), 'disabled' => true]) !!}
    <!-- {!! Form::text('dob', null, ['class' => 'form-control','id'=>'dob', 'disabled' => true]) !!} -->
</div>

@push('page_scripts')
    <!-- <script type="text/javascript">
        $('#dob').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script> -->
@endpush

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::select('gender', $genders, null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:') !!}
    {!! Form::select('language', $languages, null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Current Weight In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_weight_in_kg', 'Current Weight In Kg:') !!}
    {!! Form::number('current_weight_in_kg', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Target Weight In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('target_weight_in_kg', 'Target Weight In Kg:') !!}
    {!! Form::number('target_weight_in_kg', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Height In CM Field -->
<div class="form-group col-sm-6">
    {!! Form::label('height_in_cm', 'Height In CM:') !!}
    {!! Form::number('height_in_cm', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Is Social Login Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_social_login', 0, ['class' => 'form-check-input', 'disabled' => true]) !!}
        {!! Form::checkbox('is_social_login', '1', null, ['class' => 'form-check-input', 'disabled' => true]) !!}
        {!! Form::label('is_social_login', 'Is Social Login', ['class' => 'form-check-label']) !!}
    </div>

    <!-- Push Notification Field -->
    <div class="form-check">
        {!! Form::hidden('push_notification', 0, ['class' => 'form-check-input', 'disabled' => true]) !!}
        {!! Form::checkbox('push_notification', '1', null, ['class' => 'form-check-input', 'disabled' => true]) !!}
        {!! Form::label('push_notification', 'Push Notification', ['class' => 'form-check-label']) !!}
    </div>
</div>
