@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Question Details</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('questions.index') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('questions.show_fields')
                </div>
            </div>
        </div>
    </div>

    <div class="content px-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>Options</strong>
                </h3>
            </div>
            <div class="card-body">
                @include('options.table')
            </div>
        </div>
    </div>

@endsection
