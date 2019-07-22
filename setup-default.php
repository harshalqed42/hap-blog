<?php
require 'vendor/autoload.php';

use HAPBlog\Connection\Connection;

$db = new Connection();
$db->database->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql_image = 'CREATE TABLE IF NOT EXISTS image (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    entity_type VARCHAR(32) NOT NULL,
    PRIMARY KEY (id)
)';

if ($db->database->createTable($sql_image)) {
  echo "Image Table Created Successfully<br><br>";
}

$sql_category = 'CREATE TABLE IF NOT EXISTS category (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  entity_type VARCHAR(32) NOT NULL,
  PRIMARY KEY (id)
);';

if ($db->database->createTable($sql_category)) {
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

if ($db->database->createTable($sql_user)) {
    echo "User Table Created Successfully<br><br>";
}
