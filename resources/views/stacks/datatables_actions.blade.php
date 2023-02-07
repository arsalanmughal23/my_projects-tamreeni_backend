{!! Form::open(['route' => ['stacks.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('stacks.show')
        <a href="{{ route('stacks.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('stacks.edit')
        <a href="{{ route('stacks.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('stacks.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
