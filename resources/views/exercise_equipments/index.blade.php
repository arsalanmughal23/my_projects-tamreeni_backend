@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Exercise Equipments</h1>
                </div>
                @can('exercise_equipments.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                        href="{{ route('exercise_equipments.create') }}">
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

        <div class="card">
            <div class="card-body">
                @include('exercise_equipments.table')
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
