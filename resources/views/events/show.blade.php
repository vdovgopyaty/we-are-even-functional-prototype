@extends('layouts.app')

@section('menu')
<div onclick="javascript:location.href='/events'" aria-expanded="false" role="button" tabindex="0"
     class="mdl-layout__drawer-button">
    <i class="material-icons">chevron_left</i>
</div>
@endsection

@section('title', $event->name)

@section('menu-right-button')
<button id="menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
    <i class="material-icons">more_vert</i>
</button>
<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-lower-right">
    <li><a class="mdl-menu__item" href="/events/{{ $event->id }}/edit">Редактировать</a></li>
    <li class="mdl-menu__item" id="calculateDebtsButton">Расчитать долги</li>
</ul>
@endsection

@section('content')
<ul class="mdl-list">
    <li class="mdl-list__item">
        <span class="mdl-list__item-primary-content">
        @if ($event->purchases_count == 0)
            Здесь ещё нет ни одной покупки
        @elseif ($event->purchases_count == 1)
            {{ $event->purchases_count }} покупка на сумму {{ number_format($event->amount, 0, ",", "") }} ₽
        @elseif ($event->purchases_count < 5)
            {{ $event->purchases_count }} покупки на сумму {{ number_format($event->amount, 0, ",", "") }} ₽
        @else
            {{ $event->purchases_count }} покупок на сумму {{ number_format($event->amount, 0, ",", "") }} ₽
        @endif
        </span>
    </li>
</ul>
<hr>
<ul class="mdl-list">
    @foreach ($event->purchases as $purchase)
    <li class="mdl-list__item mdl-list__item--two-line">
        <span class="mdl-list__item-primary-content">
            @if ($purchase->buyers_count == 1)
            <i class="material-icons mdl-list__item-avatar">person</i>
            <span>{{ $purchase->name }}</span>
            <span class="mdl-list__item-sub-title">
                {{ number_format($purchase->amount, 0, ",", "") }} ₽, {{ $purchase->buyers[0]->name }}
            </span>
            @elseif ($purchase->buyers_count == 0)
            <i class="material-icons mdl-list__item-avatar">remove_shopping_cart</i>
            <span>{{ $purchase->name }}</span>
            <span class="mdl-list__item-sub-title">
                {{ number_format($purchase->amount, 0, ",", "") }} ₽
            </span>
            @else
            <i class="material-icons mdl-list__item-avatar">shopping_cart</i>
            <span>{{ $purchase->name }}</span>
                @if ($purchase->buyers_count < 5)
                <span class="mdl-list__item-sub-title">
                    {{ number_format($purchase->amount, 0, ",", "") }} ₽, {{ $purchase->buyers_count }} покупателя
                </span>
                @else
                <span class="mdl-list__item-sub-title">
                    {{ number_format($purchase->amount, 0, ",", "") }} ₽, {{ $purchase->buyers_count }} покупателей
                </span>
                @endif
            @endif
        </span>
        <span class="mdl-list__item-secondary-content">
            <a href="/events/{{ $event->id }}/purchases/{{ $purchase->id }}"
               class="mdl-list__item-secondary-action">
                <i class="material-icons">keyboard_arrow_right</i>
            </a>
        </span>
    </li>
    @endforeach
</ul>
<dialog id="showDebtsDialog" class="mdl-dialog">
    <h4 class="mdl-dialog__title">Долги</h4>
    <div class="mdl-dialog__content">
        @foreach ($debts as $debt)
        <p>
            <span class="mdl-chip__around-text">{{ $debt['from'] }}</span>
            <span class="mdl-chip mdl-chip--deletable">
                <span class="mdl-chip__text">{{ number_format($debt['amount'], 0, ",", "") }} ₽</span>
                <button type="button" class="mdl-chip__action"><i class="material-icons">arrow_forward</i></button>
            </span>
            <span class="mdl-chip__around-text">{{ $debt['to'] }}</span>
        </p>
        @endforeach
    </div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button close">Закрыть</button>
    </div>
</dialog>
@endsection

@section('fab')
<a href="/events/{{ $event->id }}/purchases/create" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">add</i>
</a>
@endsection

@section('footer-scripts')
<script>
    (function () {
        'use strict';
        var dialog = document.querySelector('#showDebtsDialog');
        var showDialogButton = document.querySelector('#calculateDebtsButton');
        if (!dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }
        showDialogButton.addEventListener('click', function () {
            dialog.showModal();
        });
        dialog.querySelector('.close').addEventListener('click', function () {
            dialog.close();
        });
    }());
</script>
@endsection
