{!! Form::open(['route' => ['membership_durations.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('membership_durations.show')
        <a href="{{ route('membership_durations.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('membership_durations.edit')
        <a href="{{ route('membership_durations.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('membership_durations.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
