<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $membership->title }}</p>
</div>

<!-- Feature List Field -->
<div class="col-sm-12">
    {!! Form::label('feature_list', 'Feature List:') !!}
    <p>{{ $membership->feature_list }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $membership->status }}</p>
</div>

