<?php
  session_start();
  if(!empty($_SESSION['userToken'])){

	$con=new mysqli('localhost','root','','ToDo');
	$sql="SELECT Expiry FROM USERS WHERE UserToken LIKE '$_SESSION[userToken]';";
	$query=mysqli_query($con,$sql);
	if($row=mysqli_fetch_array($query)){
		if($row[0]>date("Y-m-d G:i:s", strtotime("now"))){
			header("Location: home.php");
		}
	  }
	  mysqli_close($con);
}
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
		<?php
			$con=new mysqli('localhost','root','','ToDo');
			$login=$email=$pass="";
			$errorL=$errorE=$errorP=$errorR="";
  				
          	if($_SERVER["REQUEST_METHOD"]=="POST"){
				$login=filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
				$email=filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
				$pass=filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

				if(empty($login)){
					$errorL="Login is required";
				}elseif(strlen($login)<4){
					$errorL="Login must have 4 or more characters";
				}elseif(!preg_match('/[a-zA-Z0-9]+$/', $login)){
					$errorL="Login can only contain letters and numbers";
				}else{
					$sql="SELECT Login FROM USERS 
					      WHERE Login LIKE '$login';";
			  		$query=mysqli_query($con,$sql);
			  		if(mysqli_fetch_array($query)){
				  		$errorL="This login is already taken";
					}
				}

				if(empty($email)){
					$errorE="E-mail is required";
				}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$errorE="Invalid e-mail format (e.x.: adress@domain.com)";
				}else{
					$sql="SELECT Email FROM USERS 
						  WHERE Email LIKE '$email';";
					$query=mysqli_query($con,$sql);
					if(mysqli_fetch_array($query)){
						$errorE="This E-mail is already taken";
					}
				}

				if(empty($pass)){
					$errorP="Password is required";
				}elseif(strlen($pass)<8){
					$errorP="Password must be at least 8 characters long";
				}elseif(!preg_match('/[A-Z]/',$pass) || !preg_match('/[a-z]/',$pass) || !preg_match('/[0-9]/',$pass) || !preg_match('/[!@#$%^&*()_]/',$pass)){
					$errorP="Your password need to have at least capital letter, lowercase letter, number and special character";
				}

				if($pass!=trim($_POST['rpass'])){
					$errorR="Passwords do not match";
				}

				if(empty($errorE) && empty($errorL) && empty($errorP) && empty($errorR)){
					$pass=password_hash($pass,PASSWORD_DEFAULT);
					$token=bin2hex(random_bytes(20));
					$sql="INSERT INTO USERS (Login,Email,Password,UserToken,Expiry)
						  VALUES ('$login','$email','$pass','$token',NOW());";
					mysqli_query($con,$sql);

					$_SESSION['userToken']=$token;
					header("Location: home.php");
				}
          	}
			mysqli_close($con);
		?>
    	<section id="mainA">
        	<h2>Sign up</h2>
        	<form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<span class="errorL"><?php echo $errorL; ?></span><br>
            	<label>Login*</label><input type="text" name="login" onblur="Vali('l')" ><br>
				<span class="errorE"><?php echo $errorE; ?></span><br>
                <label>E-mail*</label><input type="text" name="email" onblur="Vali('e')"><br>
				<span class="errorP"><?php echo $errorP; ?></span><br>
            	<label>Password*</label><input type="password" name="pass"><br>
				<span class="errorR"><?php echo $errorR; ?></span><br>
                <label>Confirm password*</label><input type="password" name="rpass"><br>
            	<input type="submit" value="Sign up"><br>
            	<p>Already have an account? <a href="login.php">Sign In</a></p>
        	</form>
    	</section>
    	<section id="footer">
    		<p>Created by Kamil Kula</p>
    	</section>
  	</body>
</html>
