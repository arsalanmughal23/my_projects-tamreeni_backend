<!-- Title En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (English):', ['class'=>'required']) !!}
    {!! Form::text('title[en]', isset($question)?$question->getTranslation('title', 'en'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Title Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (Arabic):', ['class'=>'required']) !!}
    {!! Form::text('title[ar]', isset($question)?$question->getTranslation('title', 'ar'):null, ['class' => 'form-control','maxlength' => 70, 'required', 'dir'=>'rtl', 'pattern'=>'[ا-ي0-9_.\s+-]{0,70}']) !!}
</div>


<!-- Cover Image Field -->
{{--<div class="form-group col-sm-12 col-lg-6">--}}
{{--{!! Form::label('cover_image', 'Cover Image:') !!}--}}
{{--{!! Form::textarea('cover_image', null, ['class' => 'form-control']) !!}--}}
{{--@if(isset($question))--}}
{{--<!-- Image Field -->--}}
{{--<img src="{{ $question->cover_image}}" width="100" onerror="brokenImageHandler(this);">--}}
{{--@endif--}}
{{--</div>--}}


<!-- Cover Image Field -->
<div class="form-group col-sm-12 col-lg-6">
    {!! Form::label('cover_image', 'Cover Image:', ['class'=>'required']) !!}
    {!! Form::file('cover_image', ['class' => 'form-control', (isset($question)) ? '' : 'required' => 'required', 'accept' => 'image/jpeg,image/png']) !!}
</div>

@if(isset($question))

    <div class="form-group col-sm-6">

        <!-- Cover Image Field -->
        <img src="{{ $question->cover_image}}" width="100" onerror="brokenImageHandler(this);">

    </div>
@endif

<!-- Answer Mode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('answer_mode', 'Answer Mode:') !!}
    {!! Form::text('answer_mode', null, ['class' => 'form-control','maxlength' => 191, 'readonly']) !!}
</div>

<!-- Question Variable Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_variable_name', 'Question Variable Name:') !!}
    {!! Form::text('question_variable_name', null, ['class' => 'form-control','maxlength' => 191, 'readonly']) !!}
</div>

<!-- Question Secondary Variable Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_secondary_variable_name', 'Question Secondary Variable Name:') !!}
    {!! Form::text('question_secondary_variable_name', null, ['class' => 'form-control','maxlength' => 191,'readonly']) !!}
</div>