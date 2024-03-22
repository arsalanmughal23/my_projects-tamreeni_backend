{!! Form::open(['route' => ['transactions.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('transactions.show')
        <a href="{{ route('transactions.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('transactions.edit')
        <a href="{{ route('transactions.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('transactions.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}