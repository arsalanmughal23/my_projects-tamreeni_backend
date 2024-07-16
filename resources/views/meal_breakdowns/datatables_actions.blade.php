{!! Form::open(['route' => ['meal_breakdowns.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('meal_breakdowns.show')
        <a href="{{ route('meal_breakdowns.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('meal_breakdowns.edit')
        <a href="{{ route('meal_breakdowns.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('meal_breakdowns.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
