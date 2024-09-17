<!-- Title (English) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (English):') !!}
    {!! Form::textarea('title[en]', isset($wellnessTip) ? $wellnessTip->getTranslation('title', 'en') ?? null : null, ['class' => 'form-control']) !!}
</div>

<!-- Title (Arabic) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (Arabic):') !!}
    {!! Form::textarea('title[ar]', isset($wellnessTip) ? $wellnessTip->getTranslation('title', 'ar') ?? null : null, ['class' => 'form-control', 'required' => true, 'dir' => 'rtl']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content[en]', isset($wellnessTip) ? $wellnessTip->getTranslation('title', 'en') ?? null : null, ['class' => 'form-control']) !!}
</div>

<!-- Content (Arabic) Field -->
<div class="form-group col-sm-6">
    {!! Form::label('content', 'Content (Arabic):') !!}
    {!! Form::textarea('content[ar]', isset($wellnessTip) ? $wellnessTip->getTranslation('content', 'ar') ?? null : null, ['class' => 'form-control', 'required' => true, 'dir' => 'rtl']) !!}
</div>

<!-- Cover Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cover', 'Cover:') !!}
    <div class="d-flex justify-content-between">
        {!! Form::file('cover', null, ['class' => 'form-control', 'required' => true]) !!}
        @if(isset($wellnessTip) && $wellnessTip?->cover)
            <img src="{{ $wellnessTip->cover }}" alt="" height="80">
        @endif
    </div>
</div>
