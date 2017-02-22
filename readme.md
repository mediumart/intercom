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

## License

Mediumart Intercom is an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)