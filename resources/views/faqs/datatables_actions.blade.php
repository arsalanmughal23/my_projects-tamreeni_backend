{!! Form::open(['route' => ['faqs.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('faqs.show')
        <a href="{{ route('faqs.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('faqs.edit')
        <a href="{{ route('faqs.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('faqs.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
