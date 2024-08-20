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
        	<h2>Sign up</h2>
        	<form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            	<label>Login</label><input type="text" name="login"><br>
                <label>E-mail</label><input type="text" name="email"><br>
            	<label>Password</label><input type="password" name="pass"><br>
                <label>Repeat password</label><input type="password" name="rpass"><br>
            	<input type="submit" value="Sign up"><br>
            	<p>Already have an account? <a href="login.php">Sign In</a></p>
        	</form>
        	<?php
				$con=new mysqli('localhost','root','','ToDo');
				$login=$email=$pass=$rpass="";

          		if ($_SERVER["REQUEST_METHOD"] == "POST"){
					if(empty($_POST['email'])){
						echo "Please enter your e-mail!";
					}else{
						$email=test_input($_POST['email']);
						$sql="SELECT Email FROM USERS WHERE Email LIKE '$email';";
					}
					if($_POST['pass'] & $_POST['pass']==$_POST['rpass']){
						
					}
          
            		$sql="SELECT Login, Password FROM USERS WHERE Login LIKE '$login'";
            		$query=mysqli_query($con,$sql);
          		}
			?>
    	</section>
    	<section id="footer">
    		<p>Created by Kamil Kula</p>
    	</section>
  	</body>
</html>
