<!-- Question (English) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('question', 'Question (English):') !!}
    {!! Form::textarea('question[en]', isset($faq) ? $faq->getTranslation('question', 'en') ?? null : null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Question (Arabic) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question (Arabic):') !!}
    {!! Form::textarea('question[ar]', isset($faq) ? $faq->getTranslation('question', 'ar') ?? null : null, ['class' => 'form-control', 'required' => true, 'dir' => 'rtl']) !!}
</div>

<!-- Answer (English) Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('answer', 'Answer (English):') !!}
    {!! Form::textarea('answer[en]', isset($faq) ? $faq->getTranslation('answer', 'en') ?? null : null, ['class' => 'form-control', 'required' => true]) !!}
</div>

<!-- Answer (Arabic) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('answer', 'Answer (Arabic):') !!}
    {!! Form::textarea('answer[ar]', isset($faq) ? $faq->getTranslation('answer', 'ar') ?? null : null, ['class' => 'form-control', 'required' => true, 'dir' => 'rtl']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" id="" class="form-control select2" required=true >
        <option value="">Select Status</option>
        <option value="0"
            @if(old('status') == '0' || (isset($faq) && $faq->status == '0')) selected @endif>
            In-Active
        </option>
        <option value="1"
            @if(old('status') == '1' || (isset($faq) && $faq->status == '1')) selected @endif>
            Active
        </option>
    </select>
</div>
