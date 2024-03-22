<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $transaction->user_id }}</p>
</div>

<!-- Package Id Field -->
<div class="col-sm-12">
    {!! Form::label('package_id', 'Package Id:') !!}
    <p>{{ $transaction->package_id }}</p>
</div>

<!-- Transaction Id Field -->
<div class="col-sm-12">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $transaction->transaction_id }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-12">
    {!! Form::label('data', 'Data:') !!}
    <p>{{ $transaction->data }}</p>
</div>

<!-- Currency Field -->
<div class="col-sm-12">
    {!! Form::label('currency', 'Currency:') !!}
    <p>{{ $transaction->currency }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $transaction->amount }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $transaction->status }}</p>
</div>

