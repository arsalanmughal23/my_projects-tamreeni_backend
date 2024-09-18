@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Question Answer Attempts</h1>
                </div>
                @can('question_answer_attempts.create')
                    @if(Route::has('question_answer_attempts.create'))
                        <div class="col-sm-6">
                            <a class="btn btn-primary float-right"
                            href="{{ route('question_answer_attempts.create') }}">
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
                @include('question_answer_attempts.table')
            </div>

        </div>
    </div>

@endsection

