{!! Form::open(['route' => ['nplan_day_recipe_ingredients.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('nplan_day_recipe_ingredients.show')
        <a href="{{ route('nplan_day_recipe_ingredients.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('nplan_day_recipe_ingredients.edit')
        <a href="{{ route('nplan_day_recipe_ingredients.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('nplan_day_recipe_ingredients.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
