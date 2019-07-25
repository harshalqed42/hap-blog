<?php
require 'vendor/autoload.php';

use Pimple\Container;

$container = new Container();
require __DIR__ .'/config.php';
require __DIR__ .'/services.php';
$database = $container['connection'];
$database->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql_image = 'CREATE TABLE IF NOT EXISTS image (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    entity_type VARCHAR(32) NOT NULL,
    url VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)';

if ($database->createTable($sql_image)) {
  echo "Image Table Created Successfully<br><br>";
}

$sql_category = 'CREATE TABLE IF NOT EXISTS category (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  entity_type VARCHAR(32) NOT NULL,
  PRIMARY KEY (id)
);';

if ($database->createTable($sql_category)) {
  echo "Category Table Created Successfully<br><br>";
}

$sql_user = 'CREATE TABLE IF NOT EXISTS user(
  id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  first_name varchar(255),
  last_name varchar(255),
  email varchar(255),
  category int(10) UNSIGNED NOT NULL,
  status boolean,
  user_profile_photo int(10) UNSIGNED NOT NULL,
  FOREIGN KEY (user_profile_photo) references image(id),
  FOREIGN KEY (category) references category(id)
);';

if ($database->createTable($sql_user)) {
    echo "User Table Created Successfully<br><br>";
}

$sql_blog = 'CREATE TABLE IF NOT EXISTS blog (
    id int (10) NOT NULL AUTO_INCREMENT PRIMARY KEY,                               
    description longtext,
    title varchar(255),
    image int(10) UNSIGNED NOT NULL,
    reading_time varchar(32),
    category int(10) UNSIGNED NOT NULL,
    author int (10),
    status boolean,
    FOREIGN KEY (image) references image(id),
    FOREIGN KEY (category) references category(id)
  );';
  
  if ($database->createTable($sql_blog)) {
      echo "Blog Table Created Successfully<br><br>";
  }


