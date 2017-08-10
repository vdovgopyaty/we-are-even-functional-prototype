@if (Auth::guest())
<a class="mdl-navigation__link" href="{{ route('login') }}">Войти</a>
<a class="mdl-navigation__link" href="{{ route('register') }}">Зарегистрироваться</a>
@else
<a class="mdl-navigation__link" href="{{ route('events') }}">События</a>
<a class="mdl-navigation__link" href="#">Отчеты</a>
<a class="mdl-navigation__link" href="{{ route('logout') }}"
   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
    Выход
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
@endif
