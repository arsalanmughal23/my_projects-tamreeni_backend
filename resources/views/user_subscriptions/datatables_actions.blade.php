{!! Form::open(['route' => ['user_subscriptions.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('user_subscriptions.show')
        <a href="{{ route('user_subscriptions.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('user_subscriptions.edit')
        <a href="{{ route('user_subscriptions.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('user_subscriptions.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
