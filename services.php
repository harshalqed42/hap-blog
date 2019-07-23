<?php

use Pimple\Container;


$container = new Container();

$container['connection'] = function ($container) { 
   return new Database(
        $conn['connection.hostname'],
        $conn['connection.username'],
        $conn['connection.password'],
        $conn['connection.database']
   );
}