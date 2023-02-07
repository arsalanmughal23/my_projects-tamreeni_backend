{!! Form::open(['route' => ['projects.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('projects.show')
        <a href="{{ route('projects.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('projects.edit')
        <a href="{{ route('projects.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('projects.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
