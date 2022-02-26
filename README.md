# Wordpress hooks

Wordpress library that makes it easier to manage actions and filters.

[![Latest Stable Version](https://img.shields.io/packagist/v/dbout/wp-hooks?style=flat-square)](https://packagist.org/packages/dbout/wp-hooks) ![PHP Version](https://img.shields.io/packagist/php-v/dbout/wp-hooks)

## Requirements

The server requirements are basically the same as for WordPress with the addition of a few ones :

- PHP >= 7.4
- [Composer](https://getcomposer.org/) ❤️

> To simplify the integration of this library, we recommend using Wordpress with one of the following tools: [Bedrock](https://roots.io/bedrock/), [Themosis](https://framework.themosis.com/) or [Wordplate](https://github.com/wordplate/wordplate#readme).

## Installation

Install with composer, in the root of the Wordpress project run:

```bash
composer require dbout/wp-hooks
```

## Usage

### Via classes

The default use is via classes, the idea of creating a class per hook:

```php
class InitHook extends \Dbout\WpHooks\Hookable\Hookable {

    protected string $hook = 'init';

    public function execute(): void 
    {
        // Do something
    }
}
```

In the `function.php` file of your theme, you must now load the hook: 

```php
$loader = new \Dbout\WpHooks\HooksLoader();
$loader->add(InitHook::class);

$loader->register();
```

If you want, you can record several hooks with the loader:

```php
$loader = new \Dbout\WpHooks\HooksLoader();
$loader
    ->add(InitHook::class)
    ->add(RegisterMenus::class)
    ->add(RegisterAssets::class);

$loader->register();
```

### Second methods

Without instance :
```php
\Dbout\WpHooks\Facade\Action::add('init', 'InitHooks@callback');
```

With custom instance :
```php
\Dbout\WpHooks\Facade\Action::add('init', [new InitHooks(), 'callback']);
```
