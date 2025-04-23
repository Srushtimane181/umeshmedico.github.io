<?php
session_start();
if (isset($_SESSION['admin_session'])) {
    // If already logged in, redirect to the admin dashboard.
    header("Location: mystore.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="admin2.css">
 <style>
  body{
    /* background-color:#16a085; */
    /* background-image:url("bg.jpg"); */
    /* background-image:no-repeat; */
  }
 </style>
</head>
<body>
  
  <div class="overlay"></div>
  <div class="login-form">
      <span onclick="closeLoginForm()">&times;</span>
      <form action="loginver.php" method="post">
          <label for="username">Username:</label><br>
          <input type="text" id="username" name="username" placeholder="Enter Username" required>
          <br><br>
          <label for="userpassword">Password:</label><br>
          <input type="password" id="password" name="userpassword" placeholder="Enter Password" required><br>
          <button type="submit">Login</button>
      </form>
      <a href="index.php" class="btn btn-secondary btn-sm">Back</a>
  </div>
  <script src="adminscript.js"></script>
</body>
</html>
