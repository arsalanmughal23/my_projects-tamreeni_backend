<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User:') !!}
    <p>{{ $transaction->user->name }}</p>
</div>

<!-- Package Id Field -->
<div class="col-sm-12">
    {!! Form::label('package_id', 'Package:') !!}
    <p>{{ ($transaction->package)?$transaction->package->name:"1-1 Session" }}</p>
</div>


<!-- Data Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $transaction->description }}</p>
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
    {!! Form::label('method', 'Method:') !!}
    <p>{{ $transaction->method }}</p>
</div>

