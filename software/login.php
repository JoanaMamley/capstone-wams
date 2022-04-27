<?php
   include("db.php");
   session_start();
   
   if(isset($_POST['submit'])) {
      //email and password sent from form 
      
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $password = mysqli_real_escape_string($con,$_POST['password']);
      $password=md5($password); 
      
      $sql = "SELECT id FROM admin WHERE email = '$email' and password = '$password'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $email and $password, table row must be 1 row
		
      if($count == 1) {
        //  session_register("email");
         $_SESSION['email'] = $email;
         
         header("location: dailyLog.php");
      }else {
         $error = "Your Email or Password is invalid";
      }
   }
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Workplace Attendance Management System</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
<form class="login-box" id="form" method="POST">
  <h1>Login</h1>
  <div class="textbox form-control" id="email">
    <i class="fas fa-user"></i>
    <input type="text" placeholder="Email" name="email" required>
    <small id='emailError'></small>
  </div>

  <div class="textbox form-control" id="password">
    <i class="fas fa-lock"></i>
    <input type="password" placeholder="Password" name="password" required>
    <small id='passwordError'></small>
  </div>
  <div>
  <small id='success'></small>
  <input type="submit" class="btn" value="Sign in" id='submitBtn' name="submit">
  </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  </body>
</html>
