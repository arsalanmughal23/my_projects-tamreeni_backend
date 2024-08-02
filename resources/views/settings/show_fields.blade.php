@if(false)
    <!-- Title Field -->
    <div class="col-sm-12">
        {!! Form::label('title', 'Title:') !!}
        <p>{{ $setting->title }}</p>
    </div>

    <!-- Welcome Title Field -->
    <div class="col-sm-12">
        {!! Form::label('welcome_title', 'Welcome Title:') !!}
        <p>{{ $setting->welcome_title }}</p>
    </div>

    <!-- Url Field -->
    <div class="col-sm-12">
        {!! Form::label('url', 'Url:') !!}
        <p>{{ $setting->url }}</p>
    </div>

    <!-- Logo Field -->
    <div class="col-sm-12">
        {!! Form::label('logo', 'Logo:') !!}
        <p>{{ $setting->logo }}</p>
    </div>

    <!-- Email Field -->
    <div class="col-sm-12">
        {!! Form::label('email', 'Email:') !!}
        <p>{{ $setting->email }}</p>
    </div>

    <!-- Contact Number Field -->
    <div class="col-sm-12">
        {!! Form::label('contact_number', 'Contact Number:') !!}
        <p>{{ $setting->contact_number }}</p>
    </div>

    <!-- Language Field -->
    <div class="col-sm-12">
        {!! Form::label('language', 'Language:') !!}
        <p>{{ $setting->language }}</p>
    </div>
@endif


<!-- Service Fee Field -->
<div class="col-sm-12">
    {!! Form::label('service_fee', 'Service Fee:') !!}
    <p>{{ ($setting->service_fee ?? 0) . ' SAR' }}</p>
</div>

<!-- Coach Fee Field -->
<div class="col-sm-12">
    {!! Form::label('coach_fee', 'Coach Fee:') !!}
    <p>{{ ($setting->coach_fee ?? 0) . ' SAR' }}</p>
</div>

<!-- Dietitian Fee Field -->
<div class="col-sm-12">
    {!! Form::label('dietitian_fee', 'Dietitian Fee:') !!}
    <p>{{ ($setting->dietitian_fee ?? 0) . ' SAR' }}</p>
</div>

<!-- Therapist Fee Field -->
<div class="col-sm-12">
    {!! Form::label('therapist_fee', 'Therapist Fee:') !!}
    <p>{{ ($setting->therapist_fee ?? 0) . ' SAR' }}</p>
</div>