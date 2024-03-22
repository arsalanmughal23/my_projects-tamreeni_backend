{!! Form::open(['route' => ['appointments.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('appointments.show')
        <a href="{{ route('appointments.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('appointments.edit')
        <a href="{{ route('appointments.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('appointments.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
