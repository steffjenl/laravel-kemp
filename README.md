# laravel-kemp
[![Build Status](https://travis-ci.org/steffjenl/laravel-kemp.svg?branch=master)](https://travis-ci.org/steffjenl/laravel-kemp)

Laravel package for Kemp Loadmaster

# Installation

Install the package using composer:

```bash
composer require steffjenl/laravel-kemp
```

On Laravel versions before 5.5 you also need to add the service provider to `config/app.php` manually:

```php
    SteffjeNL\LaravelKemp\LaravelKempServiceProvider::class,
```

Then add this in `config/services.php`:

```php
        'kemp' => [
            'ipAddress'      => env('KEMP_IPADDRESS'),
            'username'       => env('KEMP_USERNAME'),
            'password'       => env('KEMP_PASSWORD'),
            'certificate'    => env('KEMP_CERTIFICATE', null),
        ],
```

Finally, add the fields `AZURE_STORAGE_NAME`, `AZURE_STORAGE_KEY` and `AZURE_STORAGE_CONTAINER` to your `.env` file with the appropriate credentials. Then you can set the `azure` driver as either your default or cloud driver and use it to fetch and retrieve files as usual.

# Configuration
