@if(false)
    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
    </div>

    <!-- Welcome Title Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('welcome_title', 'Welcome Title:') !!}
        {!! Form::text('welcome_title', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
    </div>

    <!-- Url Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('url', 'Url:') !!}
        {!! Form::text('url', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
    </div>

    <!-- Logo Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('logo', 'Logo:') !!}
        <input type="file" id="logo" name="logo" class="form-control">
    </div>

    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
    </div>

    <!-- Contact Number Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('contact_number', 'Contact Number:') !!}
        {!! Form::text('contact_number', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
    </div>

    <!-- Language Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('language', 'Language:') !!}
        <select class="form-control" name="language" style="width: 100%;" maxlength="255">
            <option value=""> Select Language </option>
            <option value="english"> English </option>
        </select>
    </div>
@endif

<!-- Service Fee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_fee', 'Service Fee:') !!}
    <div class="input-group mb-3">
        {!! Form::number('service_fee', null, ['class' => 'form-control', 'min' => 0, 'step' => '0.01', 'required' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text pricePostFix" id="basic-addon2">SAR</span>
        </div>
    </div>
</div>

<!-- Coach Fee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coach_fee', 'Coach Fee:') !!}
    <div class="input-group mb-3">
        {!! Form::number('coach_fee', null, ['class' => 'form-control', 'min' => 0, 'step' => '0.01', 'required' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text pricePostFix" id="basic-addon2">SAR</span>
        </div>
    </div>
</div>

<!-- Dietitian Fee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dietitian_fee', 'Dietitian Fee:') !!}
    <div class="input-group mb-3">
        {!! Form::number('dietitian_fee', null, ['class' => 'form-control', 'min' => 0, 'step' => '0.01', 'required' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text pricePostFix" id="basic-addon2">SAR</span>
        </div>
    </div>
</div>

<!-- Therapist Fee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('therapist_fee', 'Therapist Fee:') !!}
    <div class="input-group mb-3">
        {!! Form::number('therapist_fee', null, ['class' => 'form-control', 'min' => 0, 'step' => '0.01', 'required' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text pricePostFix" id="basic-addon2">SAR</span>
        </div>
    </div>
</div>