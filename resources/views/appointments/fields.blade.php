<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User:') !!}
    <select name="user_id" id="" class="form-control" disabled>
        <option value="" selected disabled>Select User</option>
        @foreach($users['users'] as $user)
            <option value="{{ $user->id }}" @if(isset($appointment)) {{ $appointment->user_id == $user->id ? 'selected' : '' }} @endif >{{ $user->name ?? '#'.$user->id }}</option>
            <!-- <option value="{{ $user->id }}">{{ $user?->roles?->first()->name.' | '.$user->name }}</option> -->
        @endforeach
    </select>
</div>

<!-- Customer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer:') !!}
    <select name="customer_id" id="" class="form-control" disabled>
        <option value="" selected disabled>Select Customer</option>
        @foreach($users['customers'] as $customer)
            <option value="{{ $customer->id }}" @if(isset($appointment)) {{ $appointment->customer_id == $customer->id ? 'selected' : '' }} @endif >{{ $customer->name ?? '#'.$customer->id }}</option>
            <!-- <option value="{{ $customer->id }}">{{ $customer?->roles?->first()->name.' | '.$customer->name }}</option> -->
        @endforeach
    </select>
</div>

<!-- Slot Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('slot_id', 'Slot Id:') !!}
    {!! Form::number('slot_id', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div> -->

<!-- Package Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('package_id', 'Package Id:') !!}
    {!! Form::number('package_id', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Transaction Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    {!! Form::number('transaction_id', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div> -->

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control', 'disabled' => true]) !!}
</div>

<!-- Start Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::text('start_time', null, ['class' => 'timeInput form-control', 'disabled' => true]) !!}
</div>

<!-- End Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_time', 'End Time:') !!}
    {!! Form::text('end_time', null, ['class' => 'timeInput form-control', 'disabled' => true]) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    <select name="type" id="" class="form-control" disabled>
        <option value="" selected disabled>Select Type</option>
        @foreach(\App\Models\Appointment::TYPES as $type)
            <option value="{{ $type }}" @if(isset($appointment)) {{ $appointment->type == $type ? 'selected' : '' }} @endif >{{ __('appointment.type.'.$type, [], 'en') }}</option>
            <!-- <option value="{{ $type }}">{{ $type }}</option> -->
        @endforeach
    </select>
</div>

<!-- Profession Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('profession_type', 'Profession Type:') !!}
    <select name="profession_type" id="" class="form-control" disabled>
        <option value="" selected disabled>Select Profession Type</option>
        @foreach(\App\Models\Appointment::PROFESSION_TYPES as $professionType)
            <option value="{{ $professionType }}" @if(isset($appointment)) {{ $appointment->profession_type == $professionType ? 'selected' : '' }} @endif >{{ __('appointment.profession_type.'.$professionType, [], 'en') }}</option>
            <!-- <option value="{{ $professionType }}">{{ $professionType }}</option> -->
        @endforeach
    </select>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" id="" class="form-control">
        <option value="" selected disabled>Select Status</option>
        @foreach(\App\Models\Appointment::STATUSES as $status)
            <option value="{{ $status }}" @if(isset($appointment)) {{ $appointment->status == $status ? 'selected' : '' }} @endif >{{ __('appointment.status.'.$status, [], 'en') }}</option>
            <!-- <option value="{{ $status }}">{{ $status }}</option> -->
        @endforeach
    </select>
</div>

@push('page_scripts')
    <script>
        $('.timeInput').on('change', function() {
            var timeValue = $(this).val();
            
            // Convert time to minutes
            var timeParts = timeValue.split(':');
            var hours = parseInt(timeParts[0], 10);
            var minutes = parseInt(timeParts[1], 10);
            
            // Calculate total minutes
            var totalMinutes = hours * 60 + minutes;
            
            // Round to the nearest 30-minute interval
            var remainder = totalMinutes % 30;
            if (remainder !== 0) {
                if (remainder < 15) {
                    totalMinutes -= remainder; // Round down
                } else {
                    totalMinutes += (30 - remainder); // Round up
                }
            }
            
            // Convert back to hours and minutes
            var newHours = Math.floor(totalMinutes / 60);
            var newMinutes = totalMinutes % 60;
            
            // Format the time with leading zeros if necessary
            var formattedTime = 
                ('0' + newHours).slice(-2) + ':' + ('0' + newMinutes).slice(-2);
            
            // Update the time input with the rounded time
            $(this).val(formattedTime);
        });
    </script>
@endpush