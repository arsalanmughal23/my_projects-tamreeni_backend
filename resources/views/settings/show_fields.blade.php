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

