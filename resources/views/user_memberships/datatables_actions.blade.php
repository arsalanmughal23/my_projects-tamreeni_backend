{!! Form::open(['route' => ['user_memberships.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('user_memberships.show')
        <a href="{{ route('user_memberships.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('user_memberships.edit')
        @if(Route::has('user_memberships.edit'))
            <a href="{{ route('user_memberships.edit', $id) }}" class='btn btn-default btn-xs'>
                <i class="fa fa-edit"></i>
            </a>
        @endif
    @endcan
    @can('user_memberships.destroy')
        @if(Route::has('user_memberships.destroy'))
            {!! Form::button('<i class="fa fa-trash"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'onclick' => "return submitForm(this.form);"
            ]) !!}
        @endif
    @endcan

</div>
{!! Form::close() !!}
