<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $usedPromoCode->user_id }}</p>
</div>

<!-- Morphable Type Field -->
<div class="col-sm-12">
    {!! Form::label('morphable_type', 'Morphable Type:') !!}
    <p>{{ $usedPromoCode->morphable_type }}</p>
</div>

<!-- Morphable Id Field -->
<div class="col-sm-12">
    {!! Form::label('morphable_id', 'Morphable Id:') !!}
    <p>{{ $usedPromoCode->morphable_id }}</p>
</div>

<!-- Reference Item -->
<div class="col-sm-12">
    {!! Form::label('reference_item', 'Reference Item:') !!}
    <p><span class="btn btn-sm bg-gray py-0 px-1">{{ $usedPromoCode->reference_module_name }}</span> <a href="{{ $usedPromoCode->reference_item_link }}">{{ $usedPromoCode->reference_item_title }}</a></p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $usedPromoCode->code }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $usedPromoCode->value }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $usedPromoCode->type }}</p>
</div>

