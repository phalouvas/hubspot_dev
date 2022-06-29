# SMSto HubSpot Integration

## Installation

`composer require smsto/hubspot`

Add in env file the authentication middleware used in project.

e.g. `HUBSPOT_AUTH_MIDDLEWARE=auth.basic`

On a shell command run the follow commands:
* `php artisan hubspot:install`
* `php artisan hubspot:update`
* `php artisan migrate`

Notice: Every time the package is updated should run commands:
* `php artisan hubspot:update`
* `php artisan migrate`

Then navigate to your Laravel project https://your_url/hubspot

