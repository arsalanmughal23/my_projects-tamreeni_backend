@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                @can('users.create')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                           href="{{ route('users.create') }}">
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

        <div class="mb-3">
            {!! Form::open(['method'=> 'GET', 'class' => 'row d-flex align-items-end']) !!}
            <div class="col-4">
                <label>User Role:</label>

                <select name="userRole" class="select2 form-control">
                    <option value="">Select</option>
                    <option value="User" {{ request()->get('userRole') == 'User' ? 'selected' : '' }}>User</option>
                    <option value="Mentor" {{ request()->get('userRole') == 'Mentor' ? 'selected' : '' }}>Mentor</option>
                    <option value="Coach" {{ request()->get('userRole') == 'Coach' ? 'selected' : '' }}>Coach</option>
                    <option value="Dietitian" {{ request()->get('userRole') == 'Dietitian' ? 'selected' : '' }}>Dietitian</option>
                    <option value="Therapist" {{ request()->get('userRole') == 'Therapist' ? 'selected' : '' }}>Therapist</option>
                </select>
            </div>
            <div class="col-8">
                <label></label>
                {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('users.index') !!}" class="btn btn-default">Reset</a>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="card">
            <div class="card-body">
                @include('users.table')
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
