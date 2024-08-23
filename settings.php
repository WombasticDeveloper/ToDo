<?php
	session_start();
  	if(empty($_SESSION['userToken'])){
      	header("Location: login.php");
  	}else{
		$con=new mysqli('localhost','root','','ToDo');
		$sql="SELECT Expiry FROM USERS WHERE UserToken LIKE '$_SESSION[userToken]';";
		$query=mysqli_query($con,$sql);
		if($row=mysqli_fetch_array($query)){
			if($row[0]<date("Y-m-d G:i:s", strtotime("now"))){
				$_SESSION['userToken']=NULL;
				header("Location: login.php");
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
    	<a href="home.php"><h1>To-Do</h1></a>
		<?php
			$token=$_SESSION['userToken'];
			$con=new mysqli('localhost','root','','ToDo');
			$sql="SELECT Login FROM USERS WHERE UserToken LIKE '$token';";
			$query=mysqli_query($con,$sql);
			if($row=mysqli_fetch_array($query)){
				echo '<h4>'.$row[0].' &or;</h4>';
			}
			mysqli_close($con);
      	?>
		<form method="POST">
			<input type="submit" name="logout" value="Log out">
			<a href="settings.php"><input type="button" value="Settings"></a>
	  	</form>
		<?php
			$con=new mysqli('localhost','root','','ToDo');
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])){
				$_SESSION['userToken']=NULL;
				$sql="UPDATE USERS set Expiry=NOW();";
				mysqli_query($con,$sql);

				header("Location: home.php");
			}
			mysqli_close($con);
		?>
    </section>
</body>
</html>