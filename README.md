## sView-mustache-php

A template engine build from Mustache PHP, simple and lightweight...

## Installation

```php
require 'View.php';
```

## Usage

```php
$view = View::register();

# full
$view->display('layout','page',$data);
# only page not layout
$view->display('layout',$data);
```
