# Mediumart Intercom

[![Build Status](https://travis-ci.org/mediumart/intercom.svg?branch=master)](https://travis-ci.org/mediumart/intercom)
[![Latest Stable Version](https://poser.pugx.org/mediumart/intercom/v/stable)](https://packagist.org/packages/mediumart/intercom)
[![License](https://poser.pugx.org/mediumart/intercom/license)](https://packagist.org/packages/mediumart/intercom)
[![Total Downloads](https://poser.pugx.org/mediumart/intercom/downloads)](https://packagist.org/packages/mediumart/intercom)

> Laravel Intercom Client is now macroable !

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
        'access_token' => '<your_access_token>'
    ]


The package will automatically pick out the token to authenticate any api request to your own intercom data.

## Usage

You can resolve the intercom `Client` in many ways:

```php
use Mediumart\Intercom\Client;

/** 
* Manually resolving from the container 
* */
$intercom = app('intercom');
// or
$intercom = app(Client::class);


/** 
* using type hinting and laravel's automatic resolution
* */
public function index(Client $intercom) 
{
    /.../
}


/**
* Simply leverage the facade
* */
$intercomUsers = Intercom::users();
```

Using the `intance` or the `facade`, any resource type is mirrored as a method on the `Client`, that can be used to gain the corresponding resource object :
```php
// facade
$leads = Intercom::leads();

// instance
$intercom = app('intercom');
$conversations = $intercom->conversations();
```
Using the `intance` approach you can also resolve the resource instance as a property of the `Client`:
```php
$conversations = $intercom->conversations;
```

Here is the list of all the Intercom resources types :

 - `users`
 - `events`
 - `companies`
 - `messages`
 - `conversations`
 - `leads`
 - `visitors`
 - `admins`
 - `tags`
 - `segments`
 - `counts`
 - `bulk`
 - `notes`
 
You can find related informations on their [official documentation page](https://developers.intercom.com/v2.0/reference#api-summary).

In addition, you can also set the token in a fluent way, after the `Client` has been resolved, using the `setToken` method:

    $intercom->setToken($token)->users->getUser($id);

 
## Defining Macros

To create a macro function, you can use the `macro` method on either the `facade` or the `instance`, this function accepts a `name` as its first argument, and a `callable` as its second.

```php
// facade
Intercom::macro('usersEmails', function () {
   return // your logic here ... 
});

// instance
$intercom->macro('usersEmails', function () use ($intercom) {
   return // your logic here ... 
});
```

Your `macro` can now be call as a regular method on intercom facade or instance

```php
// facade
$userEmails = Intercom::usersEmails();

// instance
$userEmails = $intercom->usersEmails();
```

## License

Mediumart Intercom is an open-sourced software licensed under the [MIT license](https://github.com/mediumart/intercom/blob/master/LICENSE.txt).
