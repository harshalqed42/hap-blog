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
if ($data) {
  header('Location: update.php');        
}
else {
  header('Location: new-config.php');  
}

?>