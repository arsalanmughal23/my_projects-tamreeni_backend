@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Membership Durations</h1>
                </div>
                @can('membership_durations.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                        href="{{ route('membership_durations.create') }}">
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
                @include('membership_durations.table')
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
