<?php
require "vendor/autoload.php";

use HAPBlog\Database\Database;
use HAPBlog\UserAuthenticate\UserAuthenticate;

session_start();
if (filter_input(INPUT_POST, 'email')) {
  $user_authenticate = new UserAuthenticate();
  $user_authenticate->user_login($_POST['email'], $_POST['password']);
}
else {
  header('Locations: login.php');
}
?>