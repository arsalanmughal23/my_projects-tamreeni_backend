{!! Form::open(['route' => ['favourites.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('favourites.show')
        <a href="{{ route('favourites.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('favourites.edit')
        <a href="{{ route('favourites.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('favourites.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
