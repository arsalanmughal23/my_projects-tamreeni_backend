<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $mealType->name }}</p>
</div>

<!-- Status Field -->
<!-- <div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>
        <span class="label label-{{ \App\Helper\Util::getBoolCss($mealType->status) }}">{{ \App\Helper\Util::getBoolText($mealType->status) }}</span>
    </p>
</div> -->

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $mealType->created_at }}</p>
</div>

