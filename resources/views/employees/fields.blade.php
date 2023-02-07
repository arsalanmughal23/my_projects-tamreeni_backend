<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Level Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
</div> --}}

<div class="form-group col-sm-6">
    {!! Form::label('level', 'Level:') !!}
    <select class="form-control" name="level" style="width: 100%;" required>
        @foreach($levels as $item)
            <option data-icon="fa-{{$item}}"
            value="{{$item->value}}" {{ isset($employee) && $employee->level == $item->id ? 'selected' : '' }}> {{ ucwords($item->text) }}</option>
        @endforeach
    </select>
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::number('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Stack Id Field -->

<div class="form-group col-sm-6">
    {!! Form::label('stack', 'Stack:') !!}
    <select class="form-control" name="stack_id" style="width: 100%;" required>
        @foreach($stacks as $item)
            <option data-icon="fa-{{$item}}"
            value="{{$item->id}}"> {{ ucwords($item->name) }}</option>
        @endforeach
    </select>
</div>
