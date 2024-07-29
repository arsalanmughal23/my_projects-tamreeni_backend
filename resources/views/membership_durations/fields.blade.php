<!-- Membership Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('membership_id', 'Membership:', ['class'=>'required']) !!}

    <select name="membership_id" class="form-control" required=true>
        <option value="">Select Membership</option>
        @foreach ($memberships as $membership)
            <option value="{{ $membership->id }}"
                @if(old('membership_id') == $membership->id || (isset($membershipDuration) && $membershipDuration->membership_id == $membership->id)) selected @endif>
                {{ $membership->title ?? '#'.$membership->id }}
            </option>
        @endforeach
    </select>
</div>

<!-- Title Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('title', 'Title (English):') !!}
    {!! Form::text('title[en]', isset($membershipDuration) ? $membershipDuration->getTranslation('title', 'en') : null, ['class' => 'form-control', 'maxLength' => 70, 'required' => true, 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('title', 'Title (Arabic):') !!}
    {!! Form::text('title[ar]', isset($membershipDuration) ? $membershipDuration->getTranslation('title', 'ar') : null, ['class' => 'form-control', 'maxLength' => 70, 'required' => true, 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>

<!-- Duration In Month Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration_in_month', 'Duration In Month:') !!}
    {!! Form::number('duration_in_month', null, ['class' => 'form-control', 'min' => 1, 'max' => '24', 'required' => true]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    <!-- <span class="float-right text-gray">max: <span class="maxPrice"></span></span> -->
    <div class="input-group mb-3">
        {!! Form::number('price', null, ['class' => 'form-control', 'min' => 0, 'step' => '0.01', 'required' => true]) !!}
        <div class="input-group-append">
            <span class="input-group-text pricePostFix" id="basic-addon2">SAR</span>
        </div>
    </div>
</div>