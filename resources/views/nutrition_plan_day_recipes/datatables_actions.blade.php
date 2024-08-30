<div class='btn-group'>
    @can('nutrition_plan_day_recipes.show')
    <a href="{{ route('nutrition_plan_day_recipes.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('nutrition_plan_day_recipes.edit')
    <a href="{{ route('nutrition_plan_day_recipes.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan

    @if(false)
        {!! Form::open(['route' => ['nutrition_plan_day_recipes.destroy', $id], 'method' => 'delete']) !!}
            @can('nutrition_plan_day_recipes.destroy')
                {!! Form::button('<i class="fa fa-trash"></i>', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'onclick' => "return submitForm(this.form);"
                ]) !!}
            @endcan
        {!! Form::close() !!}
    @endif

</div>
