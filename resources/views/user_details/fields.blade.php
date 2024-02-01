<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Dob Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dob', 'Dob:') !!}
    {!! Form::text('dob', null, ['class' => 'form-control','id'=>'dob']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#dob').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Is Social Login Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_social_login', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_social_login', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_social_login', 'Is Social Login', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:') !!}
    {!! Form::text('language', null, ['class' => 'form-control']) !!}
</div>

<!-- Current Weight In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_weight_in_kg', 'Current Weight In Kg:') !!}
    {!! Form::number('current_weight_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Target Weight In Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('target_weight_in_kg', 'Target Weight In Kg:') !!}
    {!! Form::number('target_weight_in_kg', null, ['class' => 'form-control']) !!}
</div>

<!-- Height In M Field -->
<div class="form-group col-sm-6">
    {!! Form::label('height_in_m', 'Height In M:') !!}
    {!! Form::number('height_in_m', null, ['class' => 'form-control']) !!}
</div>

<!-- Goal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('goal', 'Goal:') !!}
    {!! Form::text('goal', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Diet Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diet_type', 'Diet Type:') !!}
    {!! Form::text('diet_type', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Current Weight Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_weight_unit', 'Current Weight Unit:') !!}
    {!! Form::text('current_weight_unit', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Target Weight Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('target_weight_unit', 'Target Weight Unit:') !!}
    {!! Form::text('target_weight_unit', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Height Unit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('height_unit', 'Height Unit:') !!}
    {!! Form::text('height_unit', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>