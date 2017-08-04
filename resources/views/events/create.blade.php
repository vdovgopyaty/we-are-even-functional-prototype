@extends('layouts.app')

@section('menu')
<div onclick="javascript:location.href='{{ url()->previous() }}'" aria-expanded="false" role="button" tabindex="0"
     class="mdl-layout__drawer-button">
    <i class="material-icons">keyboard_arrow_left</i>
</div>
@endsection

@section('title', 'Новое событие')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Создание события</h1>

            <form method="POST" action="/events">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="inputName">Название</label>
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Название">
                </div>
                <div class="form-group">
                    <label for="inputPlace">Место</label>
                    <input type="text" name="place" class="form-control" id="inputPlace" placeholder="Место">
                </div>
                <div class="form-group">
                    <label for="inputDescription">Описание</label>
                    <textarea name="description" class="form-control" id="inputDescription" placeholder="Описание"
                              rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Создать</button>
                </div>

                @include('layouts.errors')
            </form>
        </div>
    </div>
</div>
@endsection
