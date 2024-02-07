{!! Form::open(['route' => ['user_events.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('user_events.show')
        <a href="{{ route('user_events.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('user_events.edit')
        <a href="{{ route('user_events.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('user_events.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
