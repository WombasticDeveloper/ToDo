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
    	<h1>To-Do</h1>
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
			<input type="submit" value="Log out">
	  	</form>
		<?php
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$_SESSION['userToken']=NULL;
				$sql="UPDATE USERS set Expiry=NOW();";
				$query=mysqli_query($con,$sql);

				header("Location: home.php");
			}
			mysqli_close($con);
		?>
    </section>
    <section id="Task">
      <?php
      
      ?>
    </section>
    <section id="addT">
      <h2>Add new tasks</h2>
      <input type="text" placeholder="Enter your task" value="Name">
      <input type="button" value="+">
      <br>
      <select id="tag">
        <option>Work</option>
        <option>School</option>
        <option>Home</option>
      </select>
      <input type="date">
      <select id="priority">
        <option>Very High priority</option>
        <option>High priority</option>
        <option>Medium priority</option>
        <option>Low priority</option>
      </select>
    </section>
    <section id="tasks">
      <h2>Your tasks</h2><hr>
      <?php
      
      ?>
    </section>
    <section id="footer">
      <p>Created by Kamil Kula</p>
    </section>
  </body>
</html>
