<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $membership->title }}</p>
</div>

<!-- Feature List Field -->
<div class="col-sm-12">
    {!! Form::label('feature_list', 'Feature List:') !!}
    <ul>
        @forelse($membership->feature_list as $feature)
            <li>
                <div class="d-flex justify-content-between">
                    <div>{{ $feature['en'] }}</div>
                    <!-- <div>{{ $feature['ar'] }}</div> -->
                </div>
            </li>
        @empty
            <li>
                <div>No Features Available</div>
            </li>
        @endforelse
    </ul>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $membership->status }}</p>
</div>

