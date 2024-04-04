{!! Form::open(['route' => ['nutrition_plans.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('nutrition_plans.show')
        <a href="{{ route('nutrition_plans.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('nutrition_plans.edit')
        <a href="{{ route('nutrition_plans.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('nutrition_plans.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
