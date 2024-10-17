<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'maxlength' => 191, 'required' => true, 'pattern' => '^\S+$']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    <span class="float-right text-gray">max: <span class="maxValue"></span></span>
    <div class="input-group mb-3">
        {!! Form::number('value', null, ['class' => 'form-control', 'required' => true, 'min' => 1]) !!}
        <div class="input-group-append">
            <span class="input-group-text discountTypeValuePostFix" id="basic-addon2"></span>
        </div>
    </div>
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    <select name="type" id="" class="form-control select2" required=true >
        <option value="">Select Type</option>
        @foreach(App\Models\PromoCode::CONST_TYPE as $type)
            <option value="{{ $type }}"
                @if(old('type') == $type || (isset($promoCode) && $promoCode->type == $type)) selected @endif>
                {{ $type }}
            </option>
        @endforeach
    </select>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" id="" class="form-control select2" required=true >
        <option value="">Select Status</option>
        @foreach(App\Models\PromoCode::CONST_STATUS as $status)
            <option value="{{ $status }}"
                @if(old('status') == $status || (isset($promoCode) && $promoCode->status == $status)) selected @endif>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>

@push('page_scripts')
    <script>
        let inputValueElement = {
            elem: $('input[name=value]'),
            postFixElem: $('.discountTypeValuePostFix'),
            maxValueElem: $('.maxValue'),
            maxPercentageDiscount: 100,
            maxFlatDiscount: 1000,
            makeValidation(discountInPercentage = true) {
                if (discountInPercentage) {
                    this.elem.prop('max', this.maxPercentageDiscount)
                    this.postFixElem.html('%');
                    this.maxValueElem.html(this.maxPercentageDiscount)
                    this.elem.val() > this.maxPercentageDiscount && this.elem.val(null);
                } else {
                    this.elem.prop('max', this.maxFlatDiscount)
                    this.postFixElem.html('SAR');
                    this.maxValueElem.html(this.maxFlatDiscount)
                    this.elem.val() > this.maxFlatDiscount && this.elem.val(null);
                }
                return this;
            }
        };

        let selectedTypeElement = $('select[name=type]');

        selectedTypeElement.on('change', function (e) {
            e.preventDefault();
            let selectedType = $(e.target).val();
            inputValueElement.makeValidation(selectedType == 'percent')
        });

        selectedTypeElement.change();
    </script>
@endpush
