@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Option Details</h1>
                </div>
                <div class="col-sm-4">
                </div>
                {{--<div class="col-sm-2">--}}
                {{--<a class="btn btn-default float-right"--}}
                {{--href="{{ route('questions.show', $option->question_id) }}">--}}
                {{--href="{{ route('options.index') }}">--}}
                {{--Back--}}
                {{--</a>--}}
                {{--</div>--}}
                <div class="col-sm-2">
                    <a class="btn btn-default float-right"
                       href="{{ route('questions.show', $option->question_id) }}">
                        {{--href="{{ route('options.index') }}">--}}
                        Back
                    </a>
                    &nbsp;
                    &nbsp;
                    <a class="btn btn-default float-right"
                       href="{{ route('options.edit', $option->id) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('options.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
