{!! Form::open(['route' => ['used_promo_codes.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('used_promo_codes.show')
        <a href="{{ route('used_promo_codes.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan
    @if(false)
        @can('used_promo_codes.edit')
            <a href="{{ route('used_promo_codes.edit', $id) }}" class='btn btn-default btn-xs'>
                <i class="fa fa-edit"></i>
            </a>
        @endcan
    @endif
    @can('used_promo_codes.destroy')
        {!! Form::button('<i class="fa fa-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return submitForm(this.form);"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
