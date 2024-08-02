<!-- Customer Field -->
<div class="col-sm-12">
    {!! Form::label('customer_id', 'Customer:') !!}
    <p>
        <a href="{{ route('users.show', $appointment->customer_id) }}">{{ $appointment->customer?->name ?? '#'.$appointment->customer_id }}</a>
    </p>
</div>

<!-- User Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User:') !!}
    <p>
        <a href="{{ route('users.show', $appointment->user_id) }}">{{ $appointment->user?->name ?? '#'.$appointment->user_id }}</a>
    </p>
</div>

<!-- Slot Id Field -->
<div class="col-sm-12">
    {!! Form::label('slot_id', 'Slot Id:') !!}
    <p>
        <a href="{{ route('slots.show', $appointment->slot_id) }}">{{ '#'.$appointment->slot_id }}</a>
    </p>
</div>

<!-- Package Id Field -->
<div class="col-sm-12">
    {!! Form::label('package_id', 'Package Id:') !!}
    <p>
        <a href="{{ route('packages.show', $appointment->package_id) }}">{{ '#'.$appointment->package_id }}</a>
    </p>
</div>

<!-- Transaction Id Field -->
<div class="col-sm-12">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>
        <a href="{{ route('transactions.show', $appointment->transaction_id) }}">{{ '#'.$appointment->transaction_id }}</a>
    </p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $appointment->date }}</p>
</div>

<!-- Start Time Field -->
<div class="col-sm-12">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{{ $appointment->start_time }}</p>
</div>

<!-- End Time Field -->
<div class="col-sm-12">
    {!! Form::label('end_time', 'End Time:') !!}
    <p>{{ $appointment->end_time }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $appointment->type_label }}</p>
</div>

<!-- Profession Type Field -->
<div class="col-sm-12">
    {!! Form::label('profession_type', 'Profession Type:') !!}
    <p>{{ $appointment->profession_type_label }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $appointment->status_label }}</p>
</div>

