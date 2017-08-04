@extends('layouts.app')

@section('title', 'События')

@section('content')
<div class="mdl-grid">
    @foreach($events as $event)
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">{{ $event->name }}</h2>
            </div>
            <div class="mdl-card__supporting-text">
                {{ $event->description }}
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="/events/{{ $event->id }}"
                   class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Перейти
                </a>
            </div>
            <div class="mdl-card__menu">
                <a href="/events/{{ $event->id }}/edit"
                   class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                    <i class="material-icons">edit</i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<a href="/events/create" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">add</i>
</a>
@endsection
