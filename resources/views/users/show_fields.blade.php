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

<!-- Email Verified At Field -->
<div class="col-sm-12">
    {!! Form::label('role', 'Roles:') !!}
    <p>{{ $users->rolesCsv }}</p>
</div>

<!-- Push Notification Field -->
<div class="col-sm-12">
    {!! Form::label('tel', 'Tel:') !!}
    <p>{{ $users->details?->phone_number ? $users->details?->phone_number: 'N/A' }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $users->created_at }}</p>
</div>
