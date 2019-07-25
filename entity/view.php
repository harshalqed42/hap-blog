<?php

use Pimple\Container;

require __DIR__ . '/config.php';
require __DIR__ . '/services.php';

$container = new Container();
$connection = $container['connection'];
$blog = new EntityManager($connection, 'blog');


// $container = new Container();
// $connection = $container['connection'];
// $blog = new EntityManager($connection, 'user');


// $container = new Container();
// $connection = $container['connection'];
// $blog = new EntityManager($connection, 'comment');
