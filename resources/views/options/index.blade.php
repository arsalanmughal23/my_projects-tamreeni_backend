@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Options</h1>
                </div>
                @can('options.create')
                    @if(Route::has('options.create'))
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                            href="{{ route('options.create') }}">
                                Add New
                            </a>
                        </div>
                    @endif
                @endcan
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @include('options.table')
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
