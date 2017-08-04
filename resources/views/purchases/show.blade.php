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
<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
    <li class="mdl-menu__item">Переименовать</li>
    <li id="delete-purchase-button" class="mdl-menu__item">Удалить</li>
</ul>
@endsection

@section('content')
<ul class="mdl-list">
    <li class="mdl-list__item">
        <span class="mdl-list__item-primary-content">
            Общая стоимость {{ number_format($purchase->amount, 0, ",", "") }} ₽
        </span>
    </li>
</ul>
<hr>
<div class="mdl-grid">
    <div id="amounts" class="mdl-cell mdl-cell--12-col text-center">
        @foreach ($purchase->event->buyers as $key => $buyer)
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            @if ($buyer->purchases->first())
            <input class="mdl-textfield__input" type="text" id="amount{{ $key }}"
                   value="{{ number_format($buyer->purchases[0]->pivot->amount, 0, ',', '') }}">
            @else
            <input class="mdl-textfield__input" type="text" id="amount{{ $key }}">
            @endif
            <label class="mdl-textfield__label" for="amount{{ $key }}">{{ $buyer->name }}</label>
        </div>
        @endforeach
    </div>
</div>
<dialog class="mdl-dialog">
    <h4 class="mdl-dialog__title">Добавление нового покупателя</h4>
    <div class="mdl-dialog__content">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="newBuyerName">
            <label class="mdl-textfield__label" for="newBuyerName">Имя</label>
        </div>
    </div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button create">Создать</button>
        <button type="button" class="mdl-button close">Отмена</button>
    </div>
</dialog>
<div id="delete-purchase-snackbar" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action mdl-button--primary" type="button"></button>
</div>
<form id="delete-purchase" method="POST"
      action="{{ action('PurchaseController@destroy', [$purchase->event, $purchase]) }}" style="display: none;">
    {{ csrf_field() }}
    {!! method_field('delete') !!}
</form>
@endsection

@section('fab')
<button id="create-buyer-button" type="button"
        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">add</i>
</button>
@endsection

@section('footer-scripts')
<script>
    (function () {
        'use strict';
        var dialog = document.querySelector('dialog');
        var showDialogButton = document.querySelector('#create-buyer-button');
        if (!dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }
        showDialogButton.addEventListener('click', function () {
            dialog.showModal();
        });
        dialog.querySelector('.close').addEventListener('click', function () {
            dialog.close();
        });
        dialog.querySelector('.create').addEventListener('click', function () {
            var amounts = document.querySelector('#amounts');
            var name = document.querySelector('#newBuyerName');
            var count = amounts.childElementCount;
            amounts.insertAdjacentHTML('beforeend', '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' +
                '<input class="mdl-textfield__input" type="text" id="amount' + (count + 1) + '">' +
                '<label class="mdl-textfield__label" for="amount' + (count + 1) + '">' + name.value + '</label>' +
                '</div>');
            componentHandler.upgradeDom();
            dialog.close();
            name.value = '';
        });
    }());
</script>
<script>
    (function () {
        'use strict';
        var snackbarContainer = document.querySelector('#delete-purchase-snackbar');
        var showSnackbarButton = document.querySelector('#delete-purchase-button');
        var handler = function (event) {
            document.querySelector('#delete-purchase').submit();
        };
        showSnackbarButton.addEventListener('click', function () {
            'use strict';
            var data = {
                message: 'Удалить покупку?',
                timeout: 3000,
                actionHandler: handler,
                actionText: 'Да'
            };
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
        });
    }());
</script>
@endsection
