<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', [ 'class' => 'required' ]) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255, 'required' => 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:', [ 'class' => 'required' ]) !!}
    {!! Form::email('email', null, ['class' => 'form-control', isset($users)?'readonly':'', !isset($users)?'required':'']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:', ['class'=>'required']) !!}
    {!! Form::file('image', ['class' => 'form-control', (isset($users)) ? '' : 'required' => 'required', 'accept' => 'image/jpeg,image/png']) !!}
</div>

@if(isset($users))

    <div class="form-group col-sm-6">

        <!-- Image Field -->
        <img class="user-image img-circle imag-placeholder"
             src="{{ isset($users?->details)? $users?->details->image : asset('public/image/user.png') }}" width="100"
             onerror="brokenImageHandler(this);">
    </div>
@endif

@role(\App\Models\Role::SUPER_ADMIN)
@if(!isset($users))
    {{--<div class="col-sm-12">--}}
    {{--{!! Form::label('roles', 'Roles:') !!}--}}
    {{--<div class="form-group">--}}

    {{--@foreach($roles as $role)--}}
    {{--<label class="control-label col-2">--}}
    {{--<input class="checkbox-inline" type="checkbox" name="role[{{$role->id}}]"--}}
    {{--@if(isset($users) && $users->hasRole($role->name)) checked @endif >--}}
    {{--{{ \Str::replace('-', ' ',  $role->name) }}</label>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--</div>--}}

    <div class="form-group col-md-6">
        {!! Form::label('roles', 'Roles:') !!}
        <select name="role" class="form-control select2" required>
            <option></option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}"
                        @if(isset($users) && $users->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
@endif
@endrole

<hr>
<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:', [ 'class' => !isset($users)?'required':'']) !!}
    <div class="input-group">
        {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'maxlength' => 255, !isset($users)?'required':'']) !!}
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="togglePasswordVisibility">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
            </button>
        </div>
    </div>
</div>


<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:', [ 'class' => !isset($users)?'required':'']) !!}
    <div class="input-group">
        {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'maxlength' => 255, !isset($users)?'required':'']) !!}
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPasswordVisibility">
                <i class="fas fa-eye" id="toggleConfirmPasswordIcon"></i>
            </button>
        </div>
    </div>
    <span class="text-danger" id="password-error" style="display: none;">
        <strong>Passwords do not match.</strong>
    </span>
</div>


@push('page_scripts')
    <script>

        $(document).ready(function () {
            $('input').attr('autocomplete', 'off');
        });

        // Function to toggle password visibility
        function togglePasswordVisibility(fieldId, iconId) {
            var field = document.getElementById(fieldId);
            var icon = document.getElementById(iconId);

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }

            // Trigger input event to validate passwords after toggling visibility
            checkPasswords();
        }

        // Function to check if passwords match and enable/disable submit button
        function checkPasswords() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('password_confirmation').value;
            var submitButton = document.getElementById('submitButton');

            if (password !== confirmPassword) {
                // If passwords don't match, show error message and disable submit button
                document.getElementById('password-error').style.display = 'block';
                submitButton.disabled = true;
            } else {
                // If passwords match, hide error message and enable submit button
                document.getElementById('password-error').style.display = 'none';
                submitButton.disabled = false;
            }
        }

        // Event listeners to toggle password visibility
        document.getElementById('togglePasswordVisibility').addEventListener('click', function () {
            togglePasswordVisibility('password', 'togglePasswordIcon');
        });

        document.getElementById('toggleConfirmPasswordVisibility').addEventListener('click', function () {
            togglePasswordVisibility('password_confirmation', 'toggleConfirmPasswordIcon');
        });

        // Event listener to trigger password check when either password field changes
        document.getElementById('password').addEventListener('input', checkPasswords);
        document.getElementById('password_confirmation').addEventListener('input', checkPasswords);

        // Initial password check
        checkPasswords();
    </script>
@endpush
