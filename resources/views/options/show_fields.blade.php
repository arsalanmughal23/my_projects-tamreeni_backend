<!-- Question Id Field -->
<div class="col-sm-12">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $option->question->title }}</p>
</div>

<!-- Title En Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title (English):') !!}
    <p>{{ $option->getTranslation('title', 'en') }}</p>
</div>

<!-- Title Ar Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title (Arabic):') !!}
    <p>{{ $option->getTranslation('title', 'ar') }}</p>
</div>


<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p><img src="{{ $option->image }}" width="50" height="50" onerror="brokenImageHandler(this);"></p>
</div>

<!-- Question Variable Name Field -->
<div class="col-sm-12">
    {!! Form::label('question_variable_name', 'Question Variable Name:') !!}
    <p>{{ $option->question_variable_name }}</p>
</div>

<!-- Option Variable Name Field -->
<div class="col-sm-12">
    {!! Form::label('option_variable_name', 'Option Variable Name:') !!}
    <p>{{ $option->option_variable_name }}</p>
</div>

