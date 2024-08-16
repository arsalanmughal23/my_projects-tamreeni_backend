<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">

                <!-- User Id Field -->
                {!! Form::label('user_id', 'User Id:') !!}
                <p>{{ $userDetail->user_id }}</p>

                <!-- First Name Field -->
                {!! Form::label('first_name', 'First Name:') !!}
                <p>{{ $userDetail->first_name }}</p>

                <!-- Last Name Field -->
                {!! Form::label('last_name', 'Last Name:') !!}
                <p>{{ $userDetail->last_name }}</p>

                <!-- Address Field -->
                {!! Form::label('address', 'Address:') !!}
                <p>{{ $userDetail->address }}</p>

                <!-- Phone Number Field -->
                {!! Form::label('phone_number', 'Phone Number:') !!}
                <!-- $userDetail->phone_number_country_code -->
                <p>{{ $userDetail->phone_number }}</p>

                <!-- Dob Field -->
                {!! Form::label('dob', 'Dob:') !!}
                <p>{{ $userDetail->dob?->format('Y-m-d') }}</p>

                <!-- Image Field -->
                {!! Form::label('image', 'Image:') !!}
                <p><img src="{{ $userDetail->image }}" alt=""></p>

                <!-- Is Social Login Field -->
                {!! Form::label('is_social_login', 'Is Social Login:') !!}
                <p>{{ $userDetail->is_social_login }}</p>

                <!-- Language Field -->
                <!-- {!! Form::label('language', 'Language:') !!}
                <p>{{ $userDetail->language }}</p> -->

                <!-- Current Weight Field -->
                {!! Form::label('current_weight', 'Current Weight:') !!}
                <p>{{ $userDetail->current_weight . ' ' . $userDetail->current_weight_unit }}</p>

                <!-- Target Weight Field -->
                {!! Form::label('target_weight', 'Target Weight:') !!}
                <p>{{ $userDetail->target_weight . ' ' . $userDetail->target_weight_unit }}</p>

                <!-- Height Field -->
                {!! Form::label('height', 'Height:') !!}
                <p>{{ $userDetail->height . ' ' . $userDetail->height_unit }}</p>

            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">

                <!-- Gender Field -->
                {!! Form::label('gender', 'Gender:') !!}
                <p>{{ __('options.'.$userDetail->gender, [], 'en') }}</p>

                <!-- Current Weight In Kg Field -->
                {!! Form::label('current_weight_in_kg', 'Current Weight In Kg:') !!}
                <p>{{ $userDetail->current_weight_in_kg . ' Kg' }}</p>

                <!-- Target Weight In Kg Field -->
                {!! Form::label('target_weight_in_kg', 'Target Weight In Kg:') !!}
                <p>{{ $userDetail->target_weight_in_kg . ' Kg' }}</p>

                <!-- Height In CM Field -->
                {!! Form::label('height_in_cm', 'Height In CM:') !!}
                <p>{{ $userDetail->height_in_cm . ' Cm' }}</p>

                <!-- Age Field -->
                {!! Form::label('age', 'Age:') !!}
                <p>{{ $userDetail->age }} yr</p>


                <!-- Goal Field -->
                {!! Form::label('goal', 'Goal:') !!}
                <p>{{ __('options.'.$userDetail->goal, [], 'en') }}</p>

                <!-- Equipment Type Field -->
                {!! Form::label('equipment_type', 'Equipment Type:') !!}
                <p>{{ __('options.'.$userDetail->equipment_type, [], 'en') }}</p>

                <!-- Body Parts Field -->
                {!! Form::label('body_parts', 'Body Parts:') !!}
                <p>{{ implode(', ', getOptionsLanguage($userDetail->body_parts)) }}</p>

                <!-- Diet Type Field -->
                {!! Form::label('diet_type', 'Diet Type:') !!}
                <p>{{ __('options.'.$userDetail->diet_type, [], 'en') }}</p>

                <!-- Food Preferences Field -->
                {!! Form::label('food_preferences', 'Food Preferences:') !!}
                <p>{{ implode(', ', getOptionsLanguage($userDetail->food_preferences)) }}</p>

            </div>
        </div>
    </div>
</div>
