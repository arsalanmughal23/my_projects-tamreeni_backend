{!! Form::open(['route' => ['contact_requests.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('contact_requests.show')
        <a href="{{ route('contact_requests.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('contact_requests.edit')
        <a href="{{ route('contact_requests.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('contact_requests.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
