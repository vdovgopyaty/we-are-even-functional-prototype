@extends('layouts.app')

@section('menu')
<div onclick="javascript:location.href='/events'" aria-expanded="false" role="button" tabindex="0"
     class="mdl-layout__drawer-button">
    <i class="material-icons">keyboard_arrow_left</i>
</div>
@endsection

@section('title', $event->name)

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
@endsection

@section('fab')
<a href="/events/{{ $event->id }}/purchases/create" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">add</i>
</a>
@endsection
