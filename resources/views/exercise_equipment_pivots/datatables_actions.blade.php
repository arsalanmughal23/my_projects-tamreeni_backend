{!! Form::open(['route' => ['exercise_equipment_pivots.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('exercise_equipment_pivots.show')
        <a href="{{ route('exercise_equipment_pivots.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('exercise_equipment_pivots.edit')
        <a href="{{ route('exercise_equipment_pivots.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('exercise_equipment_pivots.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
