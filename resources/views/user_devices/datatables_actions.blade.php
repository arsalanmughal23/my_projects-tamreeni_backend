{!! Form::open(['route' => ['user_devices.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('user_devices.show')
        <a href="{{ route('user_devices.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('user_devices.edit')
        <a href="{{ route('user_devices.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('user_devices.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
