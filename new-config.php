<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
      Select the Parts which you would like to customize.
    <form action="/setup.php" method="POST">
        <br>
            <div><input type="text" name="title" placeholder="Title"><br></div><br>
            <div><input type="checkbox" name="user" value="user"><span>User</span><br></div>
            <div><input type="checkbox" name="blog" value="blog"><span>Blog</span><br></div>
            <div><input type="checkbox" name="comment" value="comment"><span>Comment</span><br></div>
            <div><input type="checkbox" name="user_roles" value="user_roles"><span>User Roles</span><br></div>
            <div><input type="checkbox" name="role" value="role"><span>Role</span><br></div>
            <div><input type="checkbox" name="subscriber" value="subscriber"><span>Subscriber</span><br></div>
            <div><input type="checkbox" name="category" value="category"><span>Category</span><br></div>
            <div><input type="checkbox" name="image" value="image"><span>Image<br></span></div>
        <br>
            <div><input type="submit" name="submit" value="Submit"><br></div>
    </form>  
  </body>
</html>