@extends('layouts.app')

@section('menu')
<div onclick="javascript:location.href='{{ url()->previous() }}'" aria-expanded="false" role="button" tabindex="0"
     class="mdl-layout__drawer-button">
    <i class="material-icons">close</i>
</div>
@endsection

@section('title', 'Изменение события')

@section('menu-right-button')
<button type="submit" id="delete-event-button" class="mdl-button mdl-js-button mdl-button--icon">
    <i class="material-icons">delete</i>
</button>
@endsection

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone text-center">
        <form method="POST" action="{{ action('EventController@update', $event) }}">
            {{ csrf_field() }}
            {!! method_field('patch') !!}

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="name" value="{{ $event->name }}">
                <label class="mdl-textfield__label" for="name">Название</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="place" value="{{ $event->place }}">
                <label class="mdl-textfield__label" for="place">Место</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" type="text" rows="5"
                          id="description">{{ $event->description }}</textarea>
                <label class="mdl-textfield__label" for="description">Описание</label>
            </div>
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Сохранить
                    </button>
                </div>
            </div>

            @include('layouts.errors')
        </form>
    </div>
</div>
<div id="delete-event-snackbar" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action mdl-button--primary" type="button"></button>
</div>
<form id="delete-event" method="POST" action="{{ action('EventController@destroy', $event) }}" style="display: none;">
    {{ csrf_field() }}
    {!! method_field('delete') !!}
</form>
@endsection

@section('footer-scripts')
<script>
    (function () {
        'use strict';
        var snackbarContainer = document.querySelector('#delete-event-snackbar');
        var showSnackbarButton = document.querySelector('#delete-event-button');
        var handler = function (event) {
            document.querySelector('#delete-event').submit();
        };
        showSnackbarButton.addEventListener('click', function () {
            'use strict';
            var data = {
                message: 'Удалить событие?',
                timeout: 3000,
                actionHandler: handler,
                actionText: 'Да'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
        });
    }());
</script>
@endsection
