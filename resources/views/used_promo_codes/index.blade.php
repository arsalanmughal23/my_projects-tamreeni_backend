@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Used Promo Codes</h1>
                </div>
                @if(false)
                    @can('used_promo_codes.create')
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                            href="{{ route('used_promo_codes.create') }}">
                                Add New
                            </a>
                        </div>
                    @endcan
                @endif
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('used_promo_codes.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

