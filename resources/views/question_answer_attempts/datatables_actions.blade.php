{!! Form::open(['route' => ['question_answer_attempts.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('question_answer_attempts.show')
        <a href="{{ route('question_answer_attempts.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @can('question_answer_attempts.edit')
        <a href="{{ route('question_answer_attempts.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan
    @can('question_answer_attempts.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
