<div class='btn-group'>
    @can('questions.show')
    <a href="{{ route('questions.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan

    @can('questions.edit')
    <a href="{{ route('questions.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan

    @can('questions.destroy')
        @if(Route::has('questions.destroy'))
            {!! Form::open(['route' => ['questions.destroy', $id], 'method' => 'delete']) !!}
                {!! Form::button('<i class="fa fa-trash"></i>', [
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'onclick' => "return submitForm(this.form);"
                ]) !!}
            {!! Form::close() !!}
        @endif
    @endcan
</div>
