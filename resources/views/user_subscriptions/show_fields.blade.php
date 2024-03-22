<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userSubscription->user_id }}</p>
</div>

<!-- Package Id Field -->
<div class="col-sm-12">
    {!! Form::label('package_id', 'Package Id:') !!}
    <p>{{ $userSubscription->package_id }}</p>
</div>

<!-- Transaction Id Field -->
<div class="col-sm-12">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $userSubscription->transaction_id }}</p>
</div>

<!-- Sessions Field -->
<div class="col-sm-12">
    {!! Form::label('sessions', 'Sessions:') !!}
    <p>{{ $userSubscription->sessions }}</p>
</div>

<!-- Remaining Sessions Field -->
<div class="col-sm-12">
    {!! Form::label('remaining_sessions', 'Remaining Sessions:') !!}
    <p>{{ $userSubscription->remaining_sessions }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $userSubscription->status }}</p>
</div>

