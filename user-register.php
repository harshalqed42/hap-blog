<?php
require 'vendor/autoload.php';

use HAPBlog\User\User;
use HAPBlog\EntityManager\EntityManager;
use Pimple\Container;

if (isset($_SESSION['logged_in']['id'])) {
  header('Location: login.php');
}
else {
  if (isset($_POST['register']) && $_POST['register']) {
    if (isset($_FILES['user_profile_photo']['name']) && $_FILES['user_profile_photo']['name']) { 
        $tar_dir     = 'uploads/';  
        $target_file = 'uploads/' . basename($_FILES['user_profile_photo']['name']);
        $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (!in_array($imageType, ['png','jpg','jpeg','gif'])) {
          echo("Image Type should be png or jpg");
        }
        else {
            if (file_exists($target_file)) {
                $i = 1;
                while (file_exists($target_file .'_'.$i)) {
                    $i++;
                }
                $target_file = $target_file . '_' . $i;
                // @add it in the image class as rename_files($_FILES['user_profile_photo']['name'], $target_file);
              //  echo("File Already exists with same name.");    
            }
            if (move_uploaded_file($_FILES['user_profile_photo']['tmp_name'], $target_file)) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                  echo "Please enter correct email address";  
                }
                else {
                  $container = new Container();
                //   require __DIR__ . '/config.php';
                //   require __DIR__ . '/services.php';  
                  $image = new EntityManager($container['connection'], 'image');
                  print_r($_POST);die('ed');
                  //check if user exists
                  $image->create($data);

                }                
              //  echo("File has been uploaded successfully. Kindly submit the registration form.");             
            }
            else {
              echo("does not work");
            }
        }
    }
    else {
        echo("Please upload file.");
    }
  }

}


