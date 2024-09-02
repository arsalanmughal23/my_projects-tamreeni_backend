@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Roles</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($roles, ['route' => ['roles.update', $roles->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('roles.fields')
                </div>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="form-group">
                        @php $moduleNames = []; @endphp
                        @foreach ($permissions as $key => $permission)
                            @php
                                $data = getPermissionModelName($permission->name);
                                $action = explode('.', $permission->name);
                                $action = end($action);
                            @endphp

                            @if(!in_array($data, $moduleNames))

                                @php array_push($moduleNames, $data); @endphp
                                <div class="row"></br></div>

                                <h6>{{ $data }} Permissions </h6>
                                <label class="control-label mt-2 col-md-3" style="font-weight: normal !important;">
                                    <input class="checkbox-inline selectAllPermissions" type="checkbox"
                                    data-module_name="{{ $data }}" value="{{ $data }}">
                                    Select All
                                </label>
                                <div class="row"></div>
                            @endif
                            <label class="control-label mt-2 col-2" style="font-weight: normal !important;">
                                <input class="checkbox-inline permission module-{{ $data }} {{ $data }}-checked"
                                    type="checkbox" name="permission[{{ $permission->id }}]"
                                    id="{{ $data.'.'.$action }}"
                                    @if ($permission_role->getAllPermissions()->contains($permission)) checked @endif>
                                {{ getPermissionName($permission->name) }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@push('third_party_scripts')
@endpush

@push('page_scripts')
<script>
    $('.selectAllPermissions').on('click', function(e) {
        let selectAllPermissionsElement = $(e.target);
        let moduleName = selectAllPermissionsElement.data('module_name');
        let isChecked = selectAllPermissionsElement.prop('checked');

        let modulePermissionsElements = $(`input.module-${moduleName}`);
        modulePermissionsElements.prop('checked', isChecked);
    });

    $('.permission').on('click', function(e) {
        let selectPermissionElement = $(e.target);
        let permissionElementId = selectPermissionElement.attr('id');
        let moduleName = permissionElementId.split('.').shift();

        let isModuleAllPermissionsChecked = $(`input.permission.module-${moduleName}:checked`).length >= $(`input.permission.module-${moduleName}`).length;
        $(`.selectAllPermissions[data-module_name=${moduleName}]`).prop('checked', isModuleAllPermissionsChecked);
    });
</script>
@endpush
