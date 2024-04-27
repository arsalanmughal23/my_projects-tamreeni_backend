<!-- Title En Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title (En):') !!}
    <p>{{ $question->getTranslation('title', 'en') }}</p>
</div>

<!-- Title Ar Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title (Ar):') !!}
    <p>{{ $question->getTranslation('title', 'ar') }}</p>
</div>

<!-- Cover Image Field -->
<div class="col-sm-12">
    {!! Form::label('cover_image', 'Cover Image:') !!}
    <p><img src="{{ $question->cover_image }}" width="50" height="50" onerror="brokenImageHandler(this);"></p>
</div>


<!-- Answer Mode Field -->
<div class="col-sm-12">
    {!! Form::label('answer_mode', 'Answer Mode:') !!}
    <p>{{ $question->answer_mode??"N/A" }}</p>
</div>

<!-- Question Variable Name Field -->
<div class="col-sm-12">
    {!! Form::label('question_variable_name', 'Question Variable Name:') !!}
    <p>{{ $question->question_variable_name ??"N/A"}}</p>
</div>

<!-- Question Secondary Variable Name Field -->
<div class="col-sm-12">
    {!! Form::label('question_secondary_variable_name', 'Question Secondary Variable Name:') !!}
    <p>{{ $question->question_secondary_variable_name??"N/A" }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $question->created_at }}</p>
</div>

