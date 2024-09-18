@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Promo Codes</h1>
                </div>
                @can('promo_codes.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                        href="{{ route('promo_codes.create') }}">
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
                @include('promo_codes.table')
            </div>

        </div>
    </div>

@endsection

