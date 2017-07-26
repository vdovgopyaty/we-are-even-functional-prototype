@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-right">
            @if (Auth::check())
            <a href="{{ url('/events/' . $event->id . '/edit') }}" class="btn btn-default">Редактировать</a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $event->name }}</h2>

                <p>{{ $event->place }}</p>
                <p>{{ $event->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
