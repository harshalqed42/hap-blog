<?php
<?php

namespace HAPBlog\User;
use HAPBlog\Database\Database;

Class User {

  public function __construct(){
    //new class
    $this->database = new Database('localhost', 'root', 'root', 'user_ap');
    $this->conn = $this->database;
  }
  
  public function load($username) {
    $rows = $this->database->selectQuery('users',
      [
       'username',
       'first_name',
       'last_name',
       'email'
      ],
      [ 
        [
         'field' => 'username',
         'operator' => '=',
         'value' => $username
        ]
      ]
    );
    return (isset($rows[0])) ? $rows[0] : [];
  }

  public function user_exists($username) {
    if ($this->load($username)) {
      return true;  
    }
    return false;
  }
  
  public function create($username, $pass, $user_details) {
    if (!$this->user_exists($username)) {
      $table = 'users';
      $fields_arr = [
        'username' => $username,
        'password' => password_hash($pass, PASSWORD_BCRYPT)
      ];
      $fields_arr += $user_details;
      $fields = array_keys($fields_arr);
      $values = array_values($fields_arr);     
      return $this->database->insertQuery($table, $fields, $values);
    }
    return [];
  }
  
  public function delete($username) {      
    $query = $this->database->deleteQuery('users',[
        [
          'field' => 'username',
          'operator' => '=',
          'value' => $username
        ]
    ]);
  }

  public function update() {

  }

}