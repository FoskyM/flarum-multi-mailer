# Multi SMTP Mailer

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/foskym/flarum-multi-mailer.svg)](https://packagist.org/packages/foskym/flarum-multi-mailer) [![Total Downloads](https://img.shields.io/packagist/dt/foskym/flarum-multi-mailer.svg)](https://packagist.org/packages/foskym/flarum-multi-mailer)

A [Flarum](http://flarum.org) extension. Allow you to use different smtp configs determined by user email domain suffix.

## Development Reason
We found that some post offices are unable to receive emails from current sending post office, \
After changing the sending post office, we found that some normal would be unable to receive the email. \
So that we need a custom `driver` to determine the sending post office based on the receiving address (email domain suffix).

## Usage
Turn on it after installation, set the smtp configs, and switch `mail driver` to `multi-smtp`.
![QQ_1721363842605](https://github.com/user-attachments/assets/b53ee3c9-0a36-4085-ba50-93ff88f0678b)
![QQ_1721364283298](https://github.com/user-attachments/assets/80ef8f30-c772-456a-883b-112f7aaec786)


## Installation

Install with composer:

```sh
composer require foskym/flarum-multi-mailer:"*"
```

## Updating

```sh
composer update foskym/flarum-multi-mailer:"*"
php flarum migrate
php flarum cache:clear
```

## Links

- [Packagist](https://packagist.org/packages/foskym/flarum-multi-mailer)
- [GitHub](https://github.com/foskym/flarum-multi-mailer)
- [Discuss](https://discuss.flarum.org/d/PUT_DISCUSS_SLUG_HERE)
