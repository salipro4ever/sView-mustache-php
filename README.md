## sView-mustache-php

A template engine build from Mustache PHP, add more documents...

## Installation

```php
reqiure 'View.php';
```

## Usage

```php
$view = View::register();

# full
$view->display('layout','page',$data);
# only page not layout
$view->display('layout',$data);
```
