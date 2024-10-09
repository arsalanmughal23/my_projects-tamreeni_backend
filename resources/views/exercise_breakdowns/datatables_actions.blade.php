{!! Form::open(['route' => ['exercise_breakdowns.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('exercise_breakdowns.show')
        <a href="{{ route('exercise_breakdowns.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('exercise_breakdowns.edit')
        <a href="{{ route('exercise_breakdowns.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('exercise_breakdowns.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
