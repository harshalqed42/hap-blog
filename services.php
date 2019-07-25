<?php
//@todo : how is $container accessible without defining it.
use HAPBlog\Database\Database;

$container['connection'] = function ($container) {
   return new Database(
     $container['connection.hostname'],
     $container['connection.username'],
     $container['connection.password'],
     $container['connection.database']
   );
};