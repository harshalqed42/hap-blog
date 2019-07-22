<?php

namespace User_App\UserAuthenticate;

use User_App\Database\Database;
use User_App\User\User;

Class UserAuthenticate {
  public function __construct() {
    $this->database = new Database(
     'localhost',// $settings['host'],
     'root', //$settings['user'],
     'root', //$settings['pass'],
     'harshal_blog'// $settings['db']
    );
  }
  public  function logout() {
    session_destroy();
    header('location: login.php');
  }
  
  
  public function user_login($email, $password) {
    $rows = $this->database->selectQuery('users', '*', [
      [ 
        'field' => 'email',
        'operator' => '=',
        'value'=> $email
      ]
     ]
    );

    if (!$rows) {
      echo "Username or Password does not exists/match.";  
    }
    else {
      if (!password_verify($password, $rows[0]['password'])) {
        echo "Username or Password does not exists/match.";
      }
      $this->setLoggedInSession($username);
      $user_obj = new User();
      $user = $user_obj->load($_POST['username']);
      setcookie('first_name', $user['first_name']);
      header("location: welcome.php");
    }
  }
  /**
   * Builds a listing of aggregator feed items.
   *
   * @param 
   *   Reset Password
   * @param $text
   *   Email or Username.
   *
   */
  public function reset($text) {
    $email_flag = filter_var($text, FILTER_VALIDATE_EMAIL) ? TRUE : FALSE;
    if ($email_flag) {
      return $this->reset_mail($text);
    }
    else {
      $user_obj = new User();
      if ($user_obj->user_exists($text)) {
        $user = $user_obj->load($text);
        $email = $user['email'];
        return $this->reset_mail($email);
      }
      else {
        //@todo how to give field level errors instead of echoing. 
        echo "User Does Not Exists Please try with different username.";
      }
    }
  }
  
  /**
   * Builds a listing of aggregator feed items.
   *
   * @param 
   *   Select Query.
   * @param $table
   *   name of the table
   *
   * @return boolean
   *   true if mail sent and password modified.
   */
  public function reset_mail($email) {
      //@todo to prevent multiple emails in the User Tables
      //@todo to work on one time login link
      $random_pass = mt_rand();
      $new_pass = password_hash($random_pass, PASSWORD_BCRYPT);
      $headers = "Content-Type: text/html; charset:UTF-8; \r\n";
      $message = "<html><body>Your requested for a new password and it is $random_pass . $new_pass </body></html>";
      if (mail($email, 'Password reset for User App', $message, $headers)) {

        $this->database->updateQuery(
          'users', [
            [
              'password' => $new_pass
            ]
          ],
          [
            'value'=> $email,
            'operator'=> '=',
            'field' => 'email'
          ]
        );
      }
      else {
        return false;
      }
      return true;
  }

  
  protected function setLoggedInSession($username) {
    $_SESSION['logged_in']['username'] = $username;
  }
  protected function setRegisterSuccess() {
    $_SESSION['reg_success'] = 1;
  }
}

?>
