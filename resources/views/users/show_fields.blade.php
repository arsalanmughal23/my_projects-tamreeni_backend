<!-- Name Field -->
<div class="col-sm-12">
    <p>
    @if(isset($users))
        <!-- Image Field -->
            <img class="user-image"
                 src="{{ isset($users?->details)? $users?->details->image : asset('public/image/user.png') }}"
                 width="100" onerror="brokenImageHandler(this);">
        @endif
    </p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $users->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $users->email }}</p>
</div>

<!-- Roles Field -->
<div class="col-sm-12">
    {!! Form::label('role', 'Roles:') !!}
    <p>{{ (count($users->roles)>0)?$users->rolesCsv:"N/A" }}</p>
</div>

<!-- Phone Number Field -->
<div class="col-sm-12">
    {!! Form::label('phone', 'Phone Number:') !!}
    <p>{{ $users->details?->phone_number ? $users->details?->phone_number: 'N/A' }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $users->created_at }}</p>
</div>

@if(auth()->user()->hasRole('Super-Admin'))
    <!-- User Details Field -->
    <div class="col-sm-12">
        {!! Form::label('user_details', 'User Details:') !!}
        <p>{{ $users->details }}</p>
    </div>
@endif