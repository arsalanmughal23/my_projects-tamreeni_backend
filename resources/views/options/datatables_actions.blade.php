<div class='btn-group'>
    @can('options.show')
        <a href="{{ route('options.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('options.edit')
        <a href="{{ route('options.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('options.destroy')
        @if(Route::has('options.destroy'))
            {!! Form::open(['route' => ['options.destroy', $id], 'method' => 'delete']) !!}
                {!! Form::button('<i class="fa fa-trash"></i>', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'onclick' => "return submitForm(this.form);"
                ]) !!}
            {!! Form::close() !!}
        @endif
    @endcan
</div>
