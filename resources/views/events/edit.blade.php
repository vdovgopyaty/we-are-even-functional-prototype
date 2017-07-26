@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Изменение записи</h1>
        </div>
        <div class="col-md-6 text-right">
            <form method="POST" action="{{ action('EventController@destroy', $event) }}" style="display: inline-block">
                {{ csrf_field() }}
                {!! method_field('delete') !!}
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ action('EventController@update', $event) }}">
                {{ csrf_field() }}
                {!! method_field('patch') !!}

                <div class="form-group">
                    <label for="inputName">Название</label>
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Название" value="{{ $event->name }}">
                </div>
                <div class="form-group">
                    <label for="inputPlace">Место</label>
                    <input type="text" name="place" class="form-control" id="inputPlace" placeholder="Место" value="{{ $event->place }}">
                </div>
                <div class="form-group">
                    <label for="inputDescription">Описание</label>
                    <textarea name="description" class="form-control" id="inputDescription" placeholder="Описание" rows="3">{{ $event->description }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

                @include('layouts.errors')
            </form>
        </div>
    </div>
</div>
@endsection
