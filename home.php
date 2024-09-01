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
    <section id="Task">
      <?php

      ?>
    </section>
    <section id="addT">
      	<h2>Add new tasks</h2>
	  	<form method="POST" id='taskForm'>
      		<input type="text" placeholder="Enter your task title" name="title">
      		<input type="submit" value="+" name='addtask'><br>
      		<select name='tag'>
        		<option value=1>Work</option>
        		<option value=2>School</option>
        		<option value=3>Home</option>
      		</select>
      		<input type="date" name='date'>
      		<select name='priority'>
        		<option>Very High priority</option>
        		<option>High priority</option>
        		<option>Medium priority</option>
        		<option>Low priority</option>
      		</select>
		</form>
		<?php
			$con=new mysqli('localhost','root','','ToDo');
			if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['addtask'])){
				$id=1; #!!!!?!?!?!?!?!?!?!?!?
				$sql="INSERT INTO TASKS (User_ID,Title,Description,Tag_ID,DateSet,Task_Priority) 
				      VALUES ($id,'$_POST[title]','NULL','$_POST[tag]','$_POST[date]','$_POST[priority]');";
				mysqli_query($con,$sql);

				header('Location: home.php');
			}

			// Obsługa usuwania zadania
			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteTaskId'])) {
    			$taskId = intval($_POST['deleteTaskId']);
    			$sql = "DELETE FROM TASKS WHERE Task_ID = $taskId";
    			if(mysqli_query($con, $sql)){
        			echo "Task deleted successfully";
    			}else{
        			echo "Error deleting task: " . mysqli_error($con);
    			}
    			exit;
			}
		?>
    </section>
    <section id="tasks">
      <h2>Your tasks</h2><hr>
      <?php
		$con=new mysqli('localhost','root','','ToDo');
		$sql="SELECT Title, Description, TAGS.Tag_Name, DateSet, Task_Priority, Task_ID FROM TASKS 
			  INNER JOIN TAGS ON TASKS.Tag_ID=TAGS.Tag_ID 
			  WHERE TASKS.User_ID LIKE (SELECT User_ID FROM Users WHERE UserToken LIKE '$_SESSION[userToken]');";
		$query=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($query)){
			echo "<section id=task>";
			echo "<h5>$row[0]</h5>";
			echo "<input type='checkbox' id='$row[5]' onclick='DeleteT($row[5])'>";
			echo "<span id='prio'>$row[4]</span>";
			echo "<span id='date'>$row[3]</span>";
			echo "<span id='tag'>$row[2]</span>";
			echo "<h6 onclick=ShowTask('$row[5]')>&or;</h6>";
			echo "</section>";
		}
      ?>
    </section>
    <section id="footer">
      <p>Created by Kamil Kula</p>
    </section>
  </body>
  <script src='main.js'></script>
</html>
