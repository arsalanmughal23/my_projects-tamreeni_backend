<!-- Title (English): Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('title', 'Title (English):') !!}
    {!! Form::text('title[en]', isset($membership) ? $membership->getTranslation('title', 'en') : null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true, 'pattern'=>'[a-zA-Z0-9_.\s+\-]{0,70}']) !!}
</div>

<!-- Title (Arabic): Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('title', 'Title (Arabic):') !!}
    {!! Form::text('title[ar]', isset($membership) ? $membership->getTranslation('title', 'ar') : null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true, 'pattern' => '[ا-ي0-9_.\s+\-]{0,70}', 'dir' => 'rtl']) !!}
</div>

<!-- Feature List Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('feature_list', 'Feature List:') !!}<br/>
    <span class="form-control h-auto">
        <div class="d-flex">
            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature1', 'Feature 1 (English):') !!}
                {!! Form::text('feature_list[0][en]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true]) !!}
            </div>
            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature1', 'Feature 1 (Arabic):') !!}
                {!! Form::text('feature_list[0][ar]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true, 'dir' => 'rtl']) !!}
            </div>
        </div>
        <div class="d-flex">
            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature2', 'Feature 2 (English):') !!}
                {!! Form::text('feature_list[1][en]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true]) !!}
            </div>
            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature2', 'Feature 2 (Arabic):') !!}
                {!! Form::text('feature_list[1][ar]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true, 'dir' => 'rtl']) !!}
            </div>
        </div>
        <div class="d-flex">
            
            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature3', 'Feature 3 (English):') !!}
                {!! Form::text('feature_list[2][en]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true]) !!}
            </div>
            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature3', 'Feature 3 (Arabic):') !!}
                {!! Form::text('feature_list[2][ar]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true, 'dir' => 'rtl']) !!}
            </div>
        </div>
        <div class="d-flex">

            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature4', 'Feature 4 (English):') !!}
                {!! Form::text('feature_list[3][en]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true]) !!}
            </div>
            <div class="col-sm-6 col-lg-6">
                {!! Form::label('feature4', 'Feature 4 (Arabic):') !!}
                {!! Form::text('feature_list[3][ar]', null, ['class' => 'form-control', 'maxlength' => 70, 'required' => true, 'dir' => 'rtl']) !!}
            </div>
        </div>
    </span>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <select name="status" id="" class="form-control select2" required=true >
        <option value="">Select Status</option>
        @foreach(App\Models\Membership::CONST_STATUSES as $status)
            <option value="{{ $status }}" {{ isset($membership) ? ($status == $membership->status ? 'selected' : '') : '' }}>{{ $status }}</option>
        @endforeach
    </select>
</div>
