{!! Form::open(['route' => ['nutrition_plan_days.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('nutrition_plan_days.show')
        <a href="{{ route('nutrition_plan_days.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('nutrition_plan_days.edit')
        <a href="{{ route('nutrition_plan_days.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('nutrition_plan_days.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
