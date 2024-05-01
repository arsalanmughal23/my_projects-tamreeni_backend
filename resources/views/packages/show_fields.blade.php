<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $package->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $package->description }}</p>
</div>

<!-- Currency Field -->
<div class="col-sm-12">
    {!! Form::label('currency', 'Currency:') !!}
    <p>{{ $package->currency }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $package->amount }}</p>
</div>

<!-- Sessions Field -->
<div class="col-sm-12">
    {!! Form::label('sessions', 'Sessions:') !!}
    <p>{{ $package->sessions }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{  \App\Helper\Util::getStatusText($package->status) }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $package->created_at }}</p>
</div>

