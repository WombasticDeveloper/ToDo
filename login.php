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
        	<form id="form" method="POST">
            	<label>Login</label><input type="text" name="login"><br>
            	<label>Password</label><input type="password" name="pass"><br>
            	<input type="submit" value="Sign in"><br>
            	<p>Don't have an account yet? <a href="register.php">Sign Up</a></p>
        	</form>
        	<?php
        		$con=new mysqli('localhost','root','','ToDo');
          		if(isset($_POST['login']) & isset($_POST['pass'])){
            		$login=$_POST['login'];
            		$pass=$_POST['pass'];
          
            		$sql="SELECT Login, Password FROM USERS WHERE Login LIKE '$login'";
            		$query=mysqli_query($con,$sql);

					if($row=mysqli_fetch_array($query)){
						if($row[1]==$pass){
							echo "<p>Logged in</p>";
							header("Location: home.php");
						}
						else{
							echo "<p>Wrong Login or password</p>";
						}
					}
          		}
			?>
    	</section>
    	<section id="footer">
    		<p>Created by Kamil Kula</p>
    	</section>
  	</body>
</html>
