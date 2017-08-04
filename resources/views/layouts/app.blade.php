<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') — {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,light,medium&lang=ru"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-indigo.min.css">

    <style>
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mdl-card {
            width: 100%;
            min-height: 180px;
        }

        .mdl-card .mdl-card__title {
            background: url("https://getmdl.io/assets/demos/welcome_card.jpg") center center / cover;
            color: #fff;
            height: 126px;
        }

        .mdl-card .mdl-card__menu {
            color: #fff;
        }

        .mdl-list .mdl-list__item-avatar {
            font-size: 28px;
            text-align: center;
            padding-top: 7px;
        }

        .mdl-list .mdl-list__item-secondary-action .material-icons {
            font-size: 38px;
        }

        .purchases {
            margin-top: -35px;
        }

        @media screen and (max-width: 1024px) {
            .mdl-layout__drawer-button {
                color: rgb(255, 255, 255);
            }
        }

        .mdl-button.mdl-button--fab {
            position: absolute;
            bottom: 25px;
            right: 15px;
            z-index: 1;
        }

        .mdl-navigation__link--full-bleed-divider {
            border-bottom: 1px solid rgba(0, 0, 0, .12);
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header" id="app">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">@yield('title')</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                @include('layouts.nav')
            </nav>
            <div class="mdl-layout-spacer"></div>
            @yield('menu-right-button')
        </div>
    </header>

    @section('menu')
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Меню</span>
        <nav class="mdl-navigation">
            @include('layouts.nav')
        </nav>
    </div>
    @show

    <main class="mdl-layout__content">
        <div class="page-content">
            @yield('content')
        </div>
    </main>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
        crossorigin="anonymous"></script>
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
