<!-- Title En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (En):', ['class'=>'required']) !!}
    {!! Form::text('title[en]', isset($question)?$question->getTranslation('title', 'en'):null, ['class' => 'form-control','maxlength' => 191, 'required']) !!}
</div>

<!-- Title Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (Ar):', ['class'=>'required']) !!}
    {!! Form::text('title[ar]', isset($question)?$question->getTranslation('title', 'ar'):null, ['class' => 'form-control','maxlength' => 191, 'required']) !!}
</div>


<!-- Cover Image Field -->
<div class="form-group col-sm-12 col-lg-6">
    {!! Form::label('cover_image', 'Cover Image:') !!}
    {{--{!! Form::textarea('cover_image', null, ['class' => 'form-control']) !!}--}}
    @if(isset($question))
        <!-- Image Field -->
            <img src="{{ $question->cover_image}}" width="100" onerror="brokenImageHandler(this);">
        @endif
</div>

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