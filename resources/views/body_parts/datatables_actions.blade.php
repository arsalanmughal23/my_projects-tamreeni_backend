{!! Form::open(['route' => ['body_parts.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('body_parts.show')
        <a href="{{ route('body_parts.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('body_parts.edit')
        <a href="{{ route('body_parts.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('body_parts.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
