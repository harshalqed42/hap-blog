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

$setup_table = "create TABLE IF NOT EXISTS setup(
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      user boolean,
      blog boolean,
      comment boolean,
      user_roles boolean,
      role boolean,
      subscriber boolean,
      category boolean,
      image boolean,
      title VARCHAR(255) NOT NULL,
      status boolean 
    );";    
$setup_exec = $database->conn->exec($setup_table);


if (isset($_POST['submit'])) {
    $fields = [
        'user',
        'blog',
        'comment',
        'user_roles',
        'role',
        'subscriber',
        'category',
        'image',
        'title',
        'status'
    ];
    
    $values = [
        isset($_POST['user'])  ? 1 : 0,
        isset($_POST['blog'])  ? 1 : 0,
        isset($_POST['comment']) ? 1 : 0 ,
        isset($_POST['user_roles'])  ? 1 : 0,
        isset($_POST['role'])  ? 1 : 0,
        isset($_POST['subscriber']) ? 1 : 0,
        isset($_POST['category']) ? 1 : 0,
        isset($_POST['image']) ? 1 : 0,
        isset($_POST['title']) ? $_POST['title'] : '',
        1,
    ];

    $database->insertQuery('setup', $fields, $values);
}

echo "Setup Initiated Successfully.";  

// CREATE TABLE user(  
//    id INT NOT NULL AUTO_INCREMENT,  
//    first_name VARCHAR(255) NOT NULL,  
//    last_name VARCHAR(255) NOT NULL,
//    email VARCHAR(255) NOT NULL,
//    category INT(10),
//    PRIMARY KEY ( id )  
// ); 