@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exercises</h1>
                </div>
                @can('exercises.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                           href="{{ route('exercises.create') }}">
                            Add New
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-body">
                            {!! Form::open(['method'=> 'GET']) !!}
                            <div class="row justify-content-end">

                                <div class="form-group col-md-4">
                                    <label>Equipment:</label>

                                    <select name="equipment" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($exercise_equipments as $exercise_equipment)
                                            <option value="{{ $exercise_equipment->id }}" {{ isset($_GET['equipment']) && $_GET['equipment'] == $exercise_equipment->id ? 'selected' : '' }}>{{ $exercise_equipment->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Body Part :</label>

                                    <select name="body_part" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($bodyParts as $bodyPart)
                                            <option value="{{ $bodyPart->id }}" {{ isset($_GET['body_part']) && $_GET['body_part'] == $bodyPart->id ? 'selected' : '' }}>{{ $bodyPart->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4" style="margin-top: 30px;">
                                    <label></label>
                                    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                                    <a href="{!! route('exercises.index') !!}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        <div class="card">
            <div class="card-body">
                @include('exercises.table')
            </div>

        </div>
    </div>

@endsection


@push('page_scripts')
    <script>
        $(function(){
            $('input[type=search]').val('');
        })
    </script>
@endpush
