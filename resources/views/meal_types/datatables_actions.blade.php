{!! Form::open(['route' => ['meal_types.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('meal_types.show')
        <a href="{{ route('meal_types.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('meal_types.edit')
        <a href="{{ route('meal_types.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('meal_types.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
