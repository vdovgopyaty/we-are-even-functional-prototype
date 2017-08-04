@extends('layouts.app')

@section('menu')
<div onclick="javascript:location.href='{{ url()->previous() }}'" aria-expanded="false" role="button" tabindex="0"
     class="mdl-layout__drawer-button">
    <i class="material-icons">keyboard_arrow_left</i>
</div>
@endsection

@section('title', $purchase->name)

@section('menu-right-button')
<button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
    <i class="material-icons">more_vert</i>
</button>
<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-right">
    <li class="mdl-menu__item">Изменить название</li>
</ul>
@endsection

@section('content')
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone text-center">
        <div class="mdl-typography--title">
            Сумма покупки {{ number_format($purchase->amount, 0, ",", "") }} ₽
        </div>
    </div>
</div>
<div class="mdl-list buyer-purchases">
    @foreach ($purchase->event->buyers as $key => $buyer)
    <div class="mdl-list__item">
        <span class="mdl-list__item-primary-content">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--6-col">
                <input class="mdl-textfield__input" type="text" id="name{{ $key }}" value="{{ $buyer->name }}">
                <label class="mdl-textfield__label" for="name{{ $key }}">Имя</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--6-col">
                @if ($buyer->purchases()->first())
                <input class="mdl-textfield__input" type="text" id="amount{{ $key }}" value="{{ number_format($buyer->purchases()->first()->pivot->amount, 0, ',', '') }}">
                @else
                <input class="mdl-textfield__input" type="text" id="amount{{ $key }}" value="">
                @endif
                <label class="mdl-textfield__label" for="amount{{ $key }}">Сумма</label>
            </div>
        </span>
    </div>
    @endforeach
</div>

@endsection
