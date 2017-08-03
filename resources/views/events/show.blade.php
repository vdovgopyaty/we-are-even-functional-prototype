@extends('layouts.app')

@section('title', $event->name)

@section('menu')
<div onclick="javascript:location.href='{{ url()->previous() }}'" aria-expanded="false" role="button" tabindex="0"
     class="mdl-layout__drawer-button">
    <i class="material-icons">keyboard_arrow_left</i>
</div>
@endsection

@section('content')

<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone text-center">
        <form action="#">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="place" value="{{ $event->place }}">
                <label class="mdl-textfield__label" for="place">Место</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" type="text" rows="3" id="description">{{ $event->description }}</textarea>
                <label class="mdl-textfield__label" for="description">Описание</label>
            </div>
            @if ($event->purchases_count == 0)
            <div class="mdl-typography--title">
                Сделайте новую покупку
            </div>
            @elseif ($event->purchases_count == 1)
            <div class="mdl-typography--title">
                {{ $event->purchases_count }} покупка на сумму {{ number_format($event->amount, 0, ",", "") }} ₽
            </div>
            @elseif ($event->purchases_count < 5)
            <div class="mdl-typography--title">
                {{ $event->purchases_count }} покупки на сумму {{ number_format($event->amount, 0, ",", "") }} ₽
            </div>
            @else
            <div class="mdl-typography--title">
                {{ $event->purchases_count }} покупок на сумму {{ number_format($event->amount, 0, ",", "") }} ₽
            </div>
            @endif
        </form>
    </div>
</div>
<div class="mdl-grid purchases">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone">
        <ul class="mdl-list">

            @foreach ($event->purchases as $purchase)
            <li class="mdl-list__item mdl-list__item--two-line">
                <span class="mdl-list__item-primary-content">
                    @if ($purchase->buyers_count == 1)
                    <i class="material-icons mdl-list__item-avatar">person</i>
                    <span>{{ $purchase->name }}</span>
                    <span class="mdl-list__item-sub-title">
                        Личная покупка ({{ $purchase->buyers[0]->name }}) на сумму
                    </span>
                    @else
                    <i class="material-icons mdl-list__item-avatar">shopping_cart</i>
                    <span>{{ $purchase->name }}</span>
                        @if ($purchase->buyers_count < 5)
                        <span class="mdl-list__item-sub-title">
                            Покупка на сумму {{ number_format($purchase->amount, 0, ",", "") }} ₽, {{ $purchase->buyers_count }} покупателя
                        </span>
                        @else
                        <span class="mdl-list__item-sub-title">
                            Покупка на сумму {{ number_format($purchase->amount, 0, ",", "") }}, {{ $purchase->buyers_count }} покупателей
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
    </div>
</div>
<a href="/events/create" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">add</i>
</a>

@endsection
