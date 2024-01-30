{!! Form::open(['route' => ['wellness_tips.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('wellness_tips.show')
        <a href="{{ route('wellness_tips.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('wellness_tips.edit')
        <a href="{{ route('wellness_tips.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('wellness_tips.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
