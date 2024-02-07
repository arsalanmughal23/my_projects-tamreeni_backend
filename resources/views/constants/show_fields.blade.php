<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $constant->name }}</p>
</div>

<!-- Group Field -->
<div class="col-sm-12">
    {!! Form::label('group', 'Group:') !!}
    <p>{{ $constant->group }}</p>
</div>

<!-- Key Field -->
<div class="col-sm-12">
    {!! Form::label('key', 'Key:') !!}
    <p>{{ $constant->key }}</p>
</div>
