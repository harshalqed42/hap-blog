<!DOCTYPE html>
<?php
require "vendor/autoload.php";
use HAPBlog\Database\Database;
use Pimple\Container;

$container = new Container();
require __DIR__ . '/config.php'; 
require __DIR__ . '/services.php';

$database = $container['connection'];
$data = $database->selectQuery('setup','*', [
    'field'=>'status',
    'value' => 1,
    'operator' => '='
  ]
);
?>
<html>
<head>
    <h1>
      Login
    </h1>
</head>
    <body>
    <form id="user-login" action="/user-login.php" method="post">
      <input  type="email" name="email"  placeholder="abcde@example.com"/>
      <input  type="password" name="password"  placeholder="*****"/>
      <input  type="submit" name="login" />
    </form>
    </body>
</html>

