<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', [ 'class' => 'required' ]) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'required' => 'required', 'disabled' => isset($roles)]) !!}
</div>
