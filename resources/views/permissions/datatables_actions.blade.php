<div class='btn-group'>

    @if(Route::has('permissions.show'))
        <a href="{{ route('permissions.show', $module_name) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endif

    <a href="{{ route('permissions.edit', $module_name) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>

    @if(Route::has('permissions.destroy'))
        {!! Form::open(['route' => ['permissions.destroy', $module_name], 'method' => 'delete']) !!}
            {!! Form::button('<i class="fa fa-trash"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'onclick' => "return submitForm(this.form);"
            ]) !!}
        {!! Form::close() !!}
    @endif
</div>
