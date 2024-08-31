@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permissions</h1>
                </div>
                @if(Route::has('permissions.create'))
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                        href="{{ route('permissions.create') }}">
                            Add New
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body">
                @include('permissions.table')

            </div>

        </div>
    </div>

@endsection

