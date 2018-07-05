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
            'ipAddress'         => env('KEMP_IPADDRESS'),
            'username'          => env('KEMP_USERNAME'),
            'password'          => env('KEMP_PASSWORD'),
            'certificate'       => env('KEMP_CERTIFICATE', null),
            'verifyCertificate' => env('KEMP_VERIFYSSL', true),
        ],
```

Finally, add the fields `KEMP_IPADDRESS`, `KEMP_USERNAME` and `KEMP_PASSWORD` to your `.env` file with the appropriate credentials.

Note: Certificate is not used yet!

# Configuration
