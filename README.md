# Wordpress hooks

Librairie Wordpress permettant de gérer les actions et filtres.

### Configuration minimale

- PHP >= 7.2
- Wordpress >= 3.2
- [Composer](https://getcomposer.org/)

### Installation

```bash
composer require dbout/wp-hooks
```


### Utilisation 

##### Utilisation stantard

```php
class MyAction {

    public function doSomething() {
    
        // Do something here
    }

}

// Without instance
\Dbout\WpHooks\Facade\Action::add('my_custom_action', 'MyAction@doSomething');

// With custom instance
\Dbout\WpHooks\Facade\Action::add('my_custom_action', [new MyAction(), 'doSomething']);
```

##### Utilisation avec le loader

```php
class MyAction extends \Dbout\WpHooks\Hookable\Hookable {

    protected $hook = 'my_custom_action';

    public function execute(): void {
    
        // Do something
    }

}

$loader = new \Dbout\WpHooks\HooksLoader();
$loader->add(MyAction::class);

$loader->register();
```