<div class='btn-group'>
    @can('meal_categories.show')
    <a href="{{ route('meal_categories.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan
    @can('meal_categories.edit')
    <a href="{{ route('meal_categories.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan

    @if(Route::has('meal_categories.destroy'))
        {!! Form::open(['route' => ['meal_categories.destroy', $id], 'method' => 'delete']) !!}
            @can('meal_categories.destroy')
                {!! Form::button('<i class="fa fa-trash"></i>', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'onclick' => "return submitForm(this.form);"
                ]) !!}
            @endcan
        {!! Form::close() !!}
    @endif
</div>
