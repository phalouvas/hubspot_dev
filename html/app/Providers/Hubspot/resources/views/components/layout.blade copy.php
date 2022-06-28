<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'SMSto HubSpot Integration' }}</title>

    <!-- Bootstrap -->
    <link href="/assets/hubspot/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <script src="/assets/hubspot/js/bootstrap.min.js"></script>

</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('hubspot.admin.actions.index') }}">SMSto
            HubSpot
            Integration</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                @auth
                <a class="nav-link px-3" href="{{ route('hubspot.home') }}">Home</a>
                @endauth
                @guest
                <a class="nav-link px-3" href="{{ route('hubspot.admin.actions.index') }}">Admin</a>
                @endguest
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            @auth
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('hubspot.admin.actions.index') }}">
                                Actions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('hubspot.admin.settings.index') }}">
                                Settings
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            @endauth

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>{{ $title ?? 'SMSto HubSpot Integration' }}</h2>
                {{ $slot }}
            </main>
        </div>
    </div>

    <footer class="navbar navbar-light sticky-bottom bg-light flex-md-nowrap p-6 shadow">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="https://sms.to">SMSto - All rights reserved</a>
            </div>
        </div>
    </footer>

</body>

</html>
