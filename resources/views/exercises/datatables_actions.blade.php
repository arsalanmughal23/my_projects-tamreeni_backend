{!! Form::open(['route' => ['exercises.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('exercises.show')
        <a href="{{ route('exercises.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('exercises.edit')
        <a href="{{ route('exercises.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('exercises.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
