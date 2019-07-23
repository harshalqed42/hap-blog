<?php

use Pimple\Container;

$container = new Container();

$container['connection.host'] = 'localhost';
$container['connection.database'] = 'harshal_blog';
$container['connection.username'] = 'root';
$container['connection.password'] = 'root';
