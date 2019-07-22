<DOCTYPE html>
<?php
require "vendor/autoload.php";
use HAPBlog\Database\Database;

$database = new Database('localhost', 'root', 'root', 'harshal_blog');
$data = $database->selectQuery('setup','*', [
    'field'=>'status',
    'value' => 1,
    'operator' => '='
  ]
);
// if ($data) {
//   header('Location: update.php');        
// }
// else {
//   header('Location: new-config.php');  
// }

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

