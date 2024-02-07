{!! Form::open(['route' => ['user_details.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('user_details.show')
        <a href="{{ route('user_details.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('user_details.edit')
        <a href="{{ route('user_details.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('user_details.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
