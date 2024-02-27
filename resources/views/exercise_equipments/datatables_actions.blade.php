{!! Form::open(['route' => ['exercise_equipments.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('exercise_equipments.show')
        <a href="{{ route('exercise_equipments.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('exercise_equipments.edit')
        <a href="{{ route('exercise_equipments.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('exercise_equipments.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
