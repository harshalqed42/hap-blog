<!DOCTYPE html>
<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  </head>
  <body>
<div>
   <h2>User Registration</h2>
   <form id='user-register' action='/user-register.php' method='post' enctype="multipart/form-data">
     <input  type='text' name='first_name' required placeholder='Harshal'/><br><br>
     <input  type='text' name='last_name'  required placeholder='Pradhan'/><br><br>
     <input  type='email' pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required name='email' placeholder='harshal.pradhan@qed42.com'/><br><br>
     <label>Profile Photo<br></label>
     <input  type="file" required id="user_profile_photo" name="user_profile_photo" accept="image/png, image/jpeg, image/jpg"><br><br>
     <input  required type='password' name='password' placeholder='*****'/><br><br>
     <input  required type='password' name='confirm_password' placeholder='*****'/><br><br>
     <input  type='submit' name='register'/><br><br>
   </form>
 </div>
   </body>
 </html>