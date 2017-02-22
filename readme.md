# Mediumart Intercom

[![Build Status](https://travis-ci.org/mediumart/intercom.svg?branch=master)](https://travis-ci.org/mediumart/intercom)

## Installation

To install, first require the package via composer:

```
$ composer require mediumart/intercom
```

Next add the following to your `config/app.php` inside the `'providers'` array:

```php
Mediumart\Intercom\IntercomServiceProvider::class
```

and the facade reference inside the `'aliases'` array:

```php
'Intercom' => Mediumart\Intercom\Intercom::class
```

## Configuration

You need to create an `app` with an associated `access_token` from your [intercom.io](https://app.intercom.io/admins/sign_in) account. You can find informations on how to do that [here](https://developers.intercom.com/docs/personal-access-tokens).

Once you got your access token, open the `config/services.php` in your laravel project and add a key for the `intercom` service like this:

    'intercom' => [
        'token' => '<your_access_token>'
    ]


The package will automatically pick out the token to authenticate any Api call to your own intercom data.

## License

Mediumart Intercom is an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).