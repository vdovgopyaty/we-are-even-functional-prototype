@extends('layouts.app')

@section('menu')
<div onclick="javascript:location.href='/events/{{ $purchase->event->id }}'" aria-expanded="false" role="button"
     tabindex="0" class="mdl-layout__drawer-button">
    <i class="material-icons">keyboard_arrow_left</i>
</div>
@endsection

@section('title', $purchase->name)

@section('menu-right-button')
<button id="menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
    <i class="material-icons">more_vert</i>
</button>
<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="menu-lower-right">
    <li class="mdl-menu__item">Переименовать</li>
    <li id="deletePurchaseButton" class="mdl-menu__item">Удалить</li>
</ul>
@endsection

@section('content')
<ul class="mdl-list">
    <li class="mdl-list__item">
        <span class="mdl-list__item-primary-content">
            Общая стоимость&nbsp;<span data-amount>{{ number_format($purchase->amount, 0, ",", "") }}</span>&nbsp;₽
        </span>
    </li>
</ul>
<hr>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col text-center">
        <form id="saveAmounts" method="POST"
              action="{{ action('BuyerController@saveAmounts', [$purchase->event, $purchase]) }}">
            {{ csrf_field() }}

            @foreach ($purchase->event->buyers as $key => $buyer)
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                @if ($buyer->purchases->first())
                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?"
                       id="buyer{{ $buyer->id }}" name="buyer{{ $buyer->id }}"
                       value="{{ number_format($buyer->purchases[0]->pivot->amount, 0, ',', '') }}">
                @else
                <input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?"
                       id="buyer{{ $buyer->id }}" name="buyer{{ $buyer->id }}">
                @endif
                <label class="mdl-textfield__label" for="buyer{{ $buyer->id }}">{{ $buyer->name }}</label>
            </div>
            @endforeach
        </form>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                        id="saveAmountsButton">Сохранить
                </button>
            </div>
        </div>
    </div>
</div>
<dialog class="mdl-dialog">
    <h4 class="mdl-dialog__title">Добавление нового покупателя</h4>
    <div class="mdl-dialog__content">
        <form id="createBuyer" method="POST" action="{{ action('BuyerController@store', $purchase->event) }}">
            {{ csrf_field() }}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="createBuyerName" name="name">
                <label class="mdl-textfield__label" for="createBuyerName">Имя</label>
            </div>
        </form>
    </div>
    <div class="mdl-dialog__actions">
        <button type="button" class="mdl-button mdl-js-button mdl-button--primary create">Создать</button>
        <button type="button" class="mdl-button close">Отмена</button>
    </div>
</dialog>
<div id="saveAmountsSnackbar" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action mdl-button--primary" type="button"></button>
</div>
<div id="deletePurchaseSnackbar" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action mdl-button--primary" type="button"></button>
</div>
<form id="deletePurchase" method="POST"
      action="{{ action('PurchaseController@destroy', [$purchase->event, $purchase]) }}" style="display: none;">
    {{ csrf_field() }}
    {!! method_field('delete') !!}
</form>
@endsection

@section('fab')
<button id="createBuyerButton" type="button"
        class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons">add</i>
</button>
@endsection

@section('footer-scripts')
<script>
    (function () {
        'use strict';
        $('#saveAmountsButton').on('click', function (event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var form = $('#saveAmounts');
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function () {
                    var snackbarContainer = document.querySelector('#saveAmountsSnackbar');
                    var data = {
                        message: 'Суммы сохранены',
                        timeout: 1500
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                },
                error: function () {
                    var snackbarContainer = document.querySelector('#saveAmountsSnackbar');
                    var data = {
                        message: 'Ошибка при сохранении сумм',
                        timeout: 1500
                    };
                    snackbarContainer.MaterialSnackbar.showSnackbar(data);
                }
            });
        });
    }());
</script>
<script>
    (function () {
        'use strict';
        var dialog = document.querySelector('dialog');
        var showDialogButton = document.querySelector('#createBuyerButton');
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var form = $('#createBuyer');
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    var container = $('#saveAmounts');
                    container.append('<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">' +
                        '<input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" ' +
                        'id="buyer' + data.id + '" name="buyer' + data.id + '">' +
                        '<label class="mdl-textfield__label" for="buyer' + data.id + '">' + data.name + '</label>' +
                        '</div>');
                    componentHandler.upgradeDom();
                    form.find('input[name="name"]').val('');
                    dialog.close();
                }
            });
        });
    }());
</script>
<script>
    (function () {
        'use strict';
        var snackbarContainer = document.querySelector('#deletePurchaseSnackbar');
        var showSnackbarButton = document.querySelector('#deletePurchaseButton');
        var handler = function (event) {
            document.querySelector('#deletePurchase').submit();
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
