@extends('layouts.app')

@section('menu')
<div onclick="javascript:location.href='{{ url()->previous() }}'" aria-expanded="false" role="button" tabindex="0"
     class="mdl-layout__drawer-button">
    <i class="material-icons">close</i>
</div>
@endsection

@section('title', 'Изменение события')

@section('menu-right-button')
<form method="POST" action="{{ action('EventController@destroy', $event) }}" style="display: inline-block">
    {{ csrf_field() }}
    {!! method_field('delete') !!}

    <button type="submit" class="mdl-button mdl-js-button mdl-button--icon">
        <i class="material-icons">delete</i>
    </button>
</form>
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
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                Сохранить
            </button>

            @include('layouts.errors')
        </form>
    </div>
</div>
@endsection
