<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-6">
    {!! Form::label('name', 'Name:', ['class'=>'required']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 20, 'required', 'pattern'=>'[a-zA-Z0-9_.\s]{0,30}']) !!}
</div>

<!-- Currency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency', 'Currency:', ['class'=>'required']) !!}
    <select name="currency" class="form-control" required>
        <option value="SAR" @if(isset($package) && $package->currency == "SAR") selected @endif>SAR</option>
    </select>
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:',  ['class'=>'required']) !!}
    {!! Form::text('amount', null, ['class' => 'form-control', 'required', 'min'=>0, 'max'=>1000, 'oninput' => 'allowOnlyNumbers(this, 6, true)']) !!}
</div>

<!-- Sessions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sessions', 'Sessions:',  ['class'=>'required']) !!}
    {!! Form::text('sessions', null, ['class' => 'form-control', 'required', 'min'=>0, 'max'=>1000, 'oninput' => 'allowOnlyNumbers(this, 3)']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:', ['class'=>'required']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows'=>3, 'cols'=>3, 'required']) !!}
</div>

@if(isset($package))
    <!-- Status Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('status', 'Status:',  ['class'=>'required']) !!}
        <select name="status" class="form-control" required>
            <option value="1" @if($package->status == 1) selected @endif>Yes</option>
            <option value="2" @if($package->status == 2) selected @endif>No</option>
        </select>
    </div>
@endif

@push('page_scripts')
    <script>
        function allowOnlyNumbers(input, maxLength, allowDecimal) {
            input.addEventListener('input', function() {
                // Store the current cursor position and value length
                var cursorPosition = input.selectionStart;
                var oldValueLength = this.value.length;

                // Remove non-numeric characters from the input value
                let sanitizedValue = this.value.replace(/[^\d.]/g, '');

                // If decimal point is allowed, ensure only one decimal point exists
                if (allowDecimal) {
                    sanitizedValue = sanitizedValue.replace(/(\.[^.]*)\./g, '$1');
                }

                // If maxLength is provided, truncate input if necessary
                if (maxLength && sanitizedValue.length > maxLength) {
                    sanitizedValue = sanitizedValue.slice(0, maxLength);
                }

                // Update input value
                this.value = sanitizedValue;

                // Calculate the difference in value length
                var diff = this.value.length - oldValueLength;

                // Adjust cursor position
                cursorPosition += diff;

                // Restore the cursor position
                input.setSelectionRange(cursorPosition, cursorPosition);
            });
        }
    </script>
@endpush