<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $page->title }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $page->slug }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $page->content }}</p>
</div>

<!-- Active Field -->
<div class="col-sm-12">
    {!! Form::label('active', 'Status:') !!}
    <p>{{ $page->active ? 'Active' : 'In-Active'; }}</p>
</div>

