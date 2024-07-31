<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $userMembership->title }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userMembership->user_id }}</p>
</div>

<!-- Membership Id Field -->
<div class="col-sm-12">
    {!! Form::label('membership_id', 'Membership Id:') !!}
    <p>{{ $userMembership->membership_id }}</p>
</div>

<!-- Membership Duration Id Field -->
<div class="col-sm-12">
    {!! Form::label('membership_duration_id', 'Membership Duration Id:') !!}
    <p>{{ $userMembership->membership_duration_id }}</p>
</div>

<!-- Duration In Month Field -->
<div class="col-sm-12">
    {!! Form::label('duration_in_month', 'Duration In Month:') !!}
    <p>{{ $userMembership->duration_in_month }}</p>
</div>

<!-- Expire At Field -->
<div class="col-sm-12">
    {!! Form::label('expire_at', 'Expire At:') !!}
    <p>{{ $userMembership->expire_at }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $userMembership->status }}</p>
</div>

