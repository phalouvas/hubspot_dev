<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SMSto HubSpot Integration package">
    <meta name="author" content="Intergo Telecom Ltd,">
    <title>SMSto HubSpot Integration - {{ $title ?? '' }}</title>
    <link href="/assets/hubspot/dist/css/bootstrap.min.css" rel="stylesheet" />

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

    <!-- Custom styles for this template -->
    <link href="/assets/hubspot/dist/css/dashboard.min.css" rel="stylesheet" />
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('hubspot.admin.actions.index') }}">SMSto HubSpot Integration</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="w-100"></div>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                @auth
                <a class="nav-link px-3" href="{{ route('hubspot.home') }}">Home</a>
                @endauth
                @guest
                <a class="nav-link px-3" href="{{ route('hubspot.admin.actions.index') }}">Home</a>
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
                            <a class="nav-link {!! request()->route()->getName() == 'hubspot.admin.actions.index' ? 'active' : '' !!}" aria-current="page" href="{{ route('hubspot.admin.actions.index') }}">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Actions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {!! request()->route()->getName() == 'hubspot.admin.settings.index' ? 'active' : '' !!}" href="{{ route('hubspot.admin.settings.index') }}">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Users
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            @endauth

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h2>{{ $title ?? 'SMSto HubSpot Integration' }}</h2>
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>


    <script src="/assets/hubspot/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
        crossorigin="anonymous"></script>
    <script src="/assets/hubspot/dist/js/dashboard.min.js"></script>
</body>

</html>
