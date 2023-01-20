<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', [ 'class' => 'required' ]) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'required' => 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:', [ 'class' => 'required' ]) !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'required' => 'required']) !!}
</div>

<!-- Email Verified At Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::label('email_verified_at', 'Email Verified At:') !!}
    {!! Form::text('email_verified_at', null, ['class' => 'form-control','id'=>'email_verified_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#email_verified_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush


<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:', [ 'class' => 'required' ]) !!}
    {!! Form::password('password', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'required' => 'required']) !!}
</div>


<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:', [ 'class' => 'required' ] ) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control','maxlength' => 255,'maxlength' => 255, 'required' => 'required']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control','maxlength' => 100,'maxlength' => 100]) !!}
</div>

@role('Super-Admin')
    <div class="col-sm-12">
        {!! Form::label('roles', 'Roles:') !!}
        <div class="form-group">

            @foreach($roles as $role)
                <label class="control-label col-2">
                <input class="checkbox-inline" type="checkbox" name="role[{{$role->id}}]" @if(isset($users) && $users->hasRole($role->name)) checked @endif >
                    {{ \Str::replace('-', ' ',  $role->name) }}</label>
            @endforeach
        </div>
    </div>
@endrole

