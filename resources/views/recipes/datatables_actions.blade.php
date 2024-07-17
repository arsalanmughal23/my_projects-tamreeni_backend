{!! Form::open(['route' => ['recipes.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('recipes.show')
        <a href="{{ route('recipes.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('recipes.edit')
        <a href="{{ route('recipes.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('recipes.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
