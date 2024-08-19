<?php
  include('api/start.php');
?>
<!DOCTYPE html>
<html lang='pl'>
  <head>
    <meta charset="utf-8">
    <title>T0_D0</title>
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
    <section id="menu">
      <h1>To-Do</h1>
    </section>
    <section id="mainA">
        <h2>Sign in</h2>
        <form id="form" action="api/login.php" method="POST">
            <label>Login</label><input type="text" name="login"><br>
            <label>Password</label><input type="password" name="pass"><br>
            <input type="submit" value="Sign in"><br>
            <p>Already have an account yet? <a href="login.php">Sign In</a></p>
        </form>
    </section>
    <section id="footer">
      <p>Created by Kamil Kula</p>
    </section>
  </body>
</html>