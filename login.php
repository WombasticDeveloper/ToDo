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
			$errormsg='';
        	$con=new mysqli('localhost','root','','ToDo');
          	if($_SERVER["REQUEST_METHOD"] == "POST"){
				$login=$_POST['login'];
           		$pass=$_POST['pass']; #szyfrowanie

				if(empty($login) & empty($pass)){
					$errormsg='Please enter login and password';
				}elseif(empty($login)){
					$errormsg='Please enter login';
				}elseif(empty($pass)){
					$errormsg='Please enter password';
				}else{

					$sql="SELECT User_ID, Login, Password, UserToken FROM USERS WHERE Login LIKE '$login';";
            		$query=mysqli_query($con,$sql);
					if($row=mysqli_fetch_array($query)){

						if(password_verify($pass,$row[2])){
							if(isset($_POST['remember'])){
								$expireTime=strtotime('+ 3 Months');
							}else{
								$expireTime=strtotime('+ 1 Hour');
							}
							
							$expireTime=date("Y-m-d G:i:s", $expireTime);
							$_SESSION['userToken']=$row[3];
							$sql="UPDATE USERS SET Expiry='$expireTime' WHERE Login LIKE '$login';";
							$query=mysqli_query($con,$sql);

							header("Location: home.php");
						}
						else{
							$errormsg='Wrong login or password';
						}
					}
					else{
						$errormsg='Wrong login or password';
					}
          		}
			}
			mysqli_close($con);
		?>
    	<section id="mainA">
        	<h2>Sign in</h2>
        	<form id="form" method="POST">
				<span class="errormsg"><?php echo $errormsg; ?></span><br>
            	<label>Login</label><input type="text" name="login"><br>
            	<label>Password</label><input type="password" name="pass"><br>
				<label>Remember me</label><input type="checkbox" name="remember"><br>
            	<input type="submit" value="Sign in"><br>
            	<p>Don't have an account yet? <a href="register.php">Sign Up</a></p>
        	</form>
    	</section>
    	<section id="footer">
    		<p>Created by Kamil Kula</p>
    	</section>
  	</body>
</html>