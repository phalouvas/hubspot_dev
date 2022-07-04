# SMSto HubSpot Integration

This is the SMSto integration package for HubSpot. It can be installed in any Laravel site.
In order to work succesfully with HubSpot the follow are required:
* setup correctly HubSpot application values in file stubs/config/hubspot.php
* The Laravel app must be accessible from web e.g. https://your_url/hubspot

## Installation

`composer require intergo/hubspot`

Add in env file the authentication middleware used in project.

e.g. `HUBSPOT_AUTH_MIDDLEWARE=auth.basic`

On a shell command run the follow commands:
* `php artisan hubspot:install`
* `php artisan hubspot:update`
* `php artisan migrate`

Notice: Every time the package is updated should run commands:
* `php artisan hubspot:update`
* `php artisan migrate`

## Configuration

Because this application appears in iframes, you need to allow iframes in the webserver.
Also in file config/session.php need to have variables

```
'secure' => env('SESSION_SECURE_COOKIE', true),
'same_site' => 'none',
```

## Development
To develop this package you need to do the follow instead of composer require.
* clone this repository in Laravel folder app/Providers/Hubspot
* Edit Larvel composer.json and add entry
```
"autoload": {
        "psr-4": {
            "Smsto\\Hubspot\\": "app/Providers/Hubspot/src/",
            ...
        }
    },
```
* Edit file config/app.php and add in section Application Service Providers... entry:
`\Smsto\Hubspot\HubspotServiceProvider::class,`

Then navigate to your Laravel project https://your_url/hubspot

