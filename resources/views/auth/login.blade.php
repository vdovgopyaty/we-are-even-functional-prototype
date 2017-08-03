@extends('layouts.app')

@section('content')

<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="mdl-typography--display-2">
                <h2>Please sign in</h2>
            </div>

            <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input{{ $errors->has('email') ? ' has-error' : '' }}" type="email"
                       id="email"
                       name="email" value="{{ old('email') }}" required autofocus>
                <label class="mdl-textfield__label" for="email">Email-адрес</label>
            </div>

            <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input{{ $errors->has('password') ? ' has-error' : '' }}" type="password"
                       id="password" name="password" required>
                <label class="mdl-textfield__label" for="password">Пароль</label>
            </div>

            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox">
                <input type="checkbox" id="checkbox" class="mdl-checkbox__input" value="remember-me"
                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="mdl-checkbox__label">Запомнить меня</span>
            </label>

            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">Войти</button>

            <p class="cta-links">
                <a href="{{ route('register') }}">Зарегистрироваться</a>
                <span class="divider">|</span>
                <a href="{{ route('password.request') }}">Забыли пароль?</a>
            </p>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </form>
    </div>
</div>

@endsection
