<!-- Question Id Field -->
{{--<div class="form-group col-sm-6">--}}
{{--{!! Form::label('question_id', 'Question:', ['class'=>'required']) !!}--}}
{{--<select name="question_id" class="form-control select2" required disabled="true">--}}
{{--<option></option>--}}
{{--@foreach ($questions as $question)--}}
{{--<option value="{{ $question->id }}"--}}
{{--@if(isset($option) && $option->question_id == $question->id) selected @endif>{{ $question->getTranslation('title', 'en')}}</option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}

<input type="hidden" name="question_id" value="{{$option->question_id}}">

<!-- Title En Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (En):', ['class'=>'required']) !!}
    {!! Form::text('title[en]', isset($option)?$option->getTranslation('title', 'en'):null, ['class' => 'form-control','maxlength' => 255, 'required']) !!}
</div>

<!-- Title Ar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title (Ar):', ['class'=>'required']) !!}
    {!! Form::text('title[ar]', isset($option)?$option->getTranslation('title', 'ar'):null, ['class' => 'form-control','maxlength' => 255, 'required', 'dir'=>'rtl']) !!}
</div>


<!-- Image Field -->
{{--<div class="form-group col-sm-12 col-lg-12">--}}
{{--{!! Form::label('image', 'Image:') !!}--}}
{{--{!! Form::textarea('image', null, ['class' => 'form-control']) !!}--}}
{{--@if(isset($option))--}}
{{--<!-- Image Field -->--}}
{{--<img src="{{ $option->image}}" width="100" onerror="brokenImageHandler(this);">--}}
{{--@endif--}}
{{--</div>--}}

<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-6">
    {!! Form::label('image', 'Image:', ['class'=>'required']) !!}
    {!! Form::file('image', ['class' => 'form-control', (isset($option)) ? '' : 'required' => 'required', 'accept' => 'image/jpeg,image/png']) !!}
</div>

@if(isset($option))

    <div class="form-group col-sm-6">

        <!-- Image Field -->
        <img src="{{ $option->image}}" width="100" onerror="brokenImageHandler(this);">

    </div>
@endif


<!-- Question Variable Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_variable_name', 'Question Variable Name:') !!}
    {!! Form::text('question_variable_name', null, ['class' => 'form-control','maxlength' => 191,'readonly']) !!}
</div>

<!-- Option Variable Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('option_variable_name', 'Option Variable Name:') !!}
    {!! Form::text('option_variable_name', null, ['class' => 'form-control','maxlength' => 191, 'readonly']) !!}
</div>