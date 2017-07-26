@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Событие</h1>

            <div class="row">
                @foreach($events as $event)
                <div class="col-md-3">
                    <h2>{{ $event->name }}</h2>
                    <p>{{ $event->description }}</p>
                    <p><a href="/events/{{ $event->id }}" class="btn btn-default">Перейти</a></p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
