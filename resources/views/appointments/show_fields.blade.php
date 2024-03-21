<!-- Customer Id Field -->
<div class="col-sm-12">
    {!! Form::label('customer_id', 'Customer Id:') !!}
    <p>{{ $appointment->customer_id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $appointment->user_id }}</p>
</div>

<!-- Slot Id Field -->
<div class="col-sm-12">
    {!! Form::label('slot_id', 'Slot Id:') !!}
    <p>{{ $appointment->slot_id }}</p>
</div>

<!-- Package Id Field -->
<div class="col-sm-12">
    {!! Form::label('package_id', 'Package Id:') !!}
    <p>{{ $appointment->package_id }}</p>
</div>

<!-- Transaction Id Field -->
<div class="col-sm-12">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $appointment->transaction_id }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $appointment->date }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $appointment->type }}</p>
</div>

<!-- Profession Type Field -->
<div class="col-sm-12">
    {!! Form::label('profession_type', 'Profession Type:') !!}
    <p>{{ $appointment->profession_type }}</p>
</div>

