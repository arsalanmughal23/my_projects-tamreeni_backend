@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages</h1>
                </div>

                @if(Route::has('pages.create'))
                    @can('pages.create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                            href="{{ route('pages.create') }}">
                                Add New
                            </a>
                        </div>
                    @endcan
                @endcan

            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @include('pages.table')
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
