<?php
require "vendor/autoload.php";
use HAPBlog\Database\Database;
use HAPBlog\UserAuthenticate\UserAuthenticate;
use Pimple\Container;


$container = new Container();
require __DIR__ . '/config.php'; 
require __DIR__ . '/services.php';
$database = $container['connection'];


session_start();
if (filter_input(INPUT_POST, 'email')) {
  $user_authenticate = new UserAuthenticate($database);
  $user_authenticate->userLogin($_POST['email'], $_POST['password']);
}
else {
  header('Locations: login.php');
}
?>