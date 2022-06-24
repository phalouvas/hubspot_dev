<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'SMSto HubSpot Integration' }}</title>

    <!-- Bootstrap -->
    <link href="/assets/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css" rel="stylesheet" />
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
    <script src="/assets/bootstrap-5.2.0-beta1-dist/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <main class="col">
                <h2>SMSto HubSpot integration</h2>
                <form action="/hubspot/settings/store" method="POST">
                    @csrf

                    <input id="code" name="code" type="hidden" value="{{ $code }}" />

                    <div class="mb-3">
                        <label for="api_key" class="form-label">API Key</label>
                        <input type="password" class="form-control" id="api_key" name="api_key" aria-describedby="api_keyHelp" class="@error('api_key') is-invalid @enderror" required />
                        <div id="api_keyHelp" class="form-text">
                            To send successful SMS, you need a <a href="https://support.sms.to/en/support/solutions/articles/43000571250-account-creation-verification" target="_blank">verified account on SMS.to</a> and to authorize the API calls using your api key.<br>You can generate, retrieve and manage your <em>API keys</em> or <em>Client IDs &amp; Secrets</em> in your <a href="https://sms.to/app" target="_blank">SMS.to dashboard</a> under the <a href="https://sms.to/app#/api/client" target="_blank" >API Clients</a> section.
                        </div>
                        @error('api_key')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sender_id" class="form-label">Sender ID</label>
                        <input type="text" class="form-control" id="sender_id" name="sender_id" aria-describedby="sender_idHelp" class="@error('sender_id') is-invalid @enderror">
                        <div id="sender_idHelp" class="form-text">
                            The displayed value of who sent the message <a href="https://intergo.freshdesk.com/a/solutions/articles/43000513909" target="_blank">More info</a>
                        </div>
                        @error('sender_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </main>
        </div>
    </div>
</body>

