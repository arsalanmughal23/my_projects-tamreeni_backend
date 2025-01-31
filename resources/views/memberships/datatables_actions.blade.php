<div class='btn-group'>
    @can('memberships.show')
        <a href="{{ route('memberships.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('memberships.edit')
        @if(Route::has('memberships.edit'))
            <a href="{{ route('memberships.edit', $id) }}" class='btn btn-default btn-xs'>
                <i class="fa fa-edit"></i>
            </a>
        @endif
    @endcan
    @can('memberships.destroy')
        @if(Route::has('memberships.destroy'))
            {!! Form::open(['route' => ['memberships.destroy', $id], 'method' => 'delete']) !!}
            {!! Form::button('<i class="fa fa-trash"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'onclick' => "return submitForm(this.form);"
            ]) !!}
            {!! Form::close() !!}
        @endif
    @endcan
</div>
