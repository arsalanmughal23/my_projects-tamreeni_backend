<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $slot->user_id }}</p>
</div>

<!-- Slot Time Field -->
<div class="col-sm-12">
    {!! Form::label('slot_time', 'Slot Time:') !!}
    <p>{{ $slot->slot_time }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $slot->type }}</p>
</div>

