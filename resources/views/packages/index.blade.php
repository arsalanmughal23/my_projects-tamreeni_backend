@extends('layouts.app')

@push('third_party_stylesheets')
    <link rel="stylesheet" href="{{ url('/public/js/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Packages</h1>
                </div>
                @can('packages.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                           href="{{ route('packages.create') }}">
                            Add New
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix">

        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            {!! Form::open(['method'=> 'GET']) !!}
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Status :</label>

                                    <select name="status" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="1" {{ isset($_GET['status']) && $_GET['status'] == 1 ? 'selected' : '' }}>
                                            Yes
                                        </option>
                                        <option value="2" {{ isset($_GET['status']) && $_GET['status'] == 2 ? 'selected' : '' }}>
                                            No
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6" style="margin-top: 30px;">
                                    <label></label>
                                    {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                                    <a href="{!! route('packages.index') !!}" class="btn btn-default">Cancel</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('packages.table')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ url('/public/js/moment/min/moment.min.js') }}"></script>
    <script src="{{ url('/public/js/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript">
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        cb(start, end);
    </script>
@endpush
