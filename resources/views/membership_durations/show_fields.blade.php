<!-- Membership Id Field -->
<div class="col-sm-12">
    {!! Form::label('membership_id', 'Membership Id:') !!}
    <p>{{ $membershipDuration->membership_id }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $membershipDuration->title['en'] ?? '' }}</p>
</div>

<!-- Duration In Month Field -->
<div class="col-sm-12">
    {!! Form::label('duration_in_month', 'Duration In Month:') !!}
    <p>{{ $membershipDuration->duration_in_month }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $membershipDuration->price }} SAR</p>
</div>

