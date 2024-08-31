<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:',[ 'class' => 'required' ]) !!}
    <select name="name" id="" required="required" class="form-control">
        <option value="" selected disabled>Select Module</option>
        @foreach($modules as $module)
            <option value="{{ $module }}" {{ $moduleName == $module ? "selected" : ($moduleName ? "disabled" : "") }} >{{ $module }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-12">
    @foreach(\App\Models\Permission::ROUTES as $eachPermission)
        @if($loop->first)
            <label class="control-label mt-2 col-2" style="font-weight: normal !important;">
                <input class="checkbox-inline selectAllPermissions" data-module_name="{{ $moduleName }}" type="checkbox" {{ $permissions->count() >= count(\App\Models\Permission::ROUTES) ? "checked" : "" }} >
                Select All
            </label>
            <br>
        @endif
        <label class="control-label mt-2 col-2" style="font-weight: normal !important;">
            <input class="checkbox-inline permission module-{{ $moduleName }}" id="{{ $moduleName.'.'.$eachPermission }}" type="checkbox" name="permissions[{{ $moduleName }}][{{ $eachPermission }}]" value="{{ $moduleName.'.'.$eachPermission }}" {{ $permissions->contains("$moduleName.$eachPermission") ? "checked" : "" }} >
            {{ $eachPermission }}
        </label>
    @endforeach
</div>

@push('page_scripts')
<script>
    let previousSelectedModuleName = $('select[name=name]').val() ?? '';
    $('select[name=name]').on('change', function(e) {
        let selectedModuleName = $(e.target).val();
        $('.selectAllPermissions').attr('data-module_name', selectedModuleName);
        $(`.permission.module-${previousSelectedModuleName ?? ''}`)
            .removeClass(`module-${previousSelectedModuleName ?? ''}`)
            .addClass(`module-${selectedModuleName ?? ''}`)

        $(`.permission.module-${selectedModuleName ?? ''}`).map(function(index, eachPermissionElem) {
            let currentPermissionElem = $(eachPermissionElem);
            let currentPermissionId = currentPermissionElem.attr('id');
            let currentPermissionSplitedId = currentPermissionId.split('.');
            let currentPermissionModuleName = currentPermissionSplitedId.shift();
            let currentPermissionName = currentPermissionSplitedId.pop();


            let newPermissionId = currentPermissionId.replace(currentPermissionModuleName, selectedModuleName ?? '');
            currentPermissionElem.attr('name', `permissions[${selectedModuleName ?? ''}][${currentPermissionName ?? ''}]`)
            currentPermissionElem.attr('value', `${selectedModuleName ?? ''}.${currentPermissionName ?? ''}`)
            currentPermissionElem.attr('id', newPermissionId ?? '');
        })
        previousSelectedModuleName = selectedModuleName;
    })

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
        $('.selectAllPermissions').prop('checked', isModuleAllPermissionsChecked);
    });
</script>
@endpush
