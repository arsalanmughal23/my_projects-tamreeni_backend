{!! Form::open(['route' => ['workout_day_exercises.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('workout_day_exercises.show')
        <a href="{{ route('workout_day_exercises.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('workout_day_exercises.edit')
        <a href="{{ route('workout_day_exercises.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('workout_day_exercises.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
