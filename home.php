<?php
	#session validation
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
	<section id='bl'>
			<a href="home.php"><h2>T0D0</h2></a>
	</section>

	<section id='bp'>
		<?php
			#display user name 

			$token=$_SESSION['userToken'];
			$con=new mysqli('localhost','root','','ToDo');
			$sql="SELECT Login FROM USERS WHERE UserToken LIKE '$token';";
			$query=mysqli_query($con,$sql);
			if($row=mysqli_fetch_array($query)){
				echo '<h5>'.$row[0].'</h5>';
			}
			mysqli_close($con);
    	?>
		<h5 id='menu'>&or;</h5>
		<section id='menucontent'>
			<form method="POST">
				<input type="submit" name="logout" value="Log out">
				<br>
				<a href="settings.php"><input type="button" value="Settings"></a>
			</form>
		</section>
	</section>
    
    <section id="taskmore">
		<input type="button" id='Ddone'>
		<h2 id='Dtitle'></h2>
		<input type="button" onclick='deleteT(1)' value='Del'> <!-- delete task -->
		<input type="checkbox" onclick='doneT(1)'> <!-- close window/section -->
		<span id='Dtag'></span>
		<span id='Ddate'></span>
		<span id='Dpriority'></span>
		<p id='Ddesc'></p>
    </section>

    <section id="addt">
      	<h2>Add new tasks</h2>
	  	<form method="POST" id='taskForm'>
      		<input type="text" placeholder="Enter your task title" name="title">
      		<input type="submit" value="+" name='addtask'><br>
      		<select name='tag'>
        		<?php
					$con= new mysqli('localhost','root','','ToDo');
					$sql="SELECT Tag_Name, Tag_ID, Tag_Color FROM tags WHERE User_ID LIKE (SELECT User_ID FROM users WHERE UserToken LIKE '$_SESSION[userToken]');";
					$query=mysqli_query($con,$sql);
					while($row=mysqli_fetch_array($query)){
						echo "<option value=$row[1] style='background-color: $row[2]'>$row[0]</option>";
					}
				?>
      		</select>
      		<input type="date" name='date'>
      		<select name='priority'>
        		<option>Very High priority</option>
        		<option>High priority</option>
        		<option>Medium priority</option>
        		<option>Low priority</option>
      		</select>
		</form>
    </section>

    <section id="tasks">
      <h2>Your tasks</h2>
      <?php
	  		#generate tasks on site

		$con=new mysqli('localhost','root','','ToDo');
		$sql="SELECT Title, Description, TAGS.Tag_Name, DateSet, Task_Priority, Task_ID, Done FROM TASKS 
			  INNER JOIN TAGS ON TASKS.Tag_ID=TAGS.Tag_ID 
			  WHERE TASKS.User_ID LIKE (SELECT User_ID FROM Users WHERE UserToken LIKE '$_SESSION[userToken]')
			  ORDER BY Done;";
		$query=mysqli_query($con,$sql);
		while($row=mysqli_fetch_array($query)){
			echo "<section id=task>";
			if($row[6]==0){
				echo "<input type='checkbox' id='$row[5]' onclick='doneT($row[5])'>";
			}elseif($row[6]==1){
				echo "<input type='checkbox' id='$row[5]' checked onclick='undoneT($row[5])'>";
			}
			echo "<p>$row[0]</p>";
			echo "<span id='prio'>$row[4]</span>";
			echo "<span id='date'>$row[3]</span>";
			echo "<span id='tag'>$row[2]</span>";
			echo "<h6 onclick=details($row[5])>&or;</h6>";
			echo "<p onclick='deleteT($row[5])'>Del</p>";
			echo "</section>";
		}
      ?>
    </section>
    <footer>
      <p>Created by Kamil Kula</p>
    </footer>

	<?php
			#All the scripts from site - except displaying smth
		
		
		$con=new mysqli('localhost','root','','ToDo');

		#log out
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])){
			$_SESSION['userToken']=NULL;
			$sql="UPDATE USERS set Expiry=NOW();";
			mysqli_query($con,$sql);

			header("Location: login.php");
		}

		#creating task
		if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['addtask'])){
			$query=mysqli_query($con,"SELECT User_ID FROM users WHERE UserToken LIKE '$_SESSION[userToken]';");
			$id=mysqli_fetch_array($query);
			$sql="INSERT INTO TASKS (User_ID,Title,Description,Tag_ID,DateSet,Task_Priority) 
				  VALUES ($id[0],'$_POST[title]','NULL','$_POST[tag]','$_POST[date]','$_POST[priority]');";
			mysqli_query($con,$sql);

			header('Location: home.php');
		}

		#deleting task
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteTaskId'])) {
    		$taskID = intval($_POST['deleteTaskId']);
    		$sql = "DELETE FROM TASKS WHERE Task_ID = $taskID;";
    		mysqli_query($con, $sql);
		}

		#done task
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['doneTaskId'])) {
			$taskId = intval($_POST['doneTaskId']);
			$sql="UPDATE TASKS SET Done = 1 WHERE Task_ID = $taksID;";
			mysqli_query($con, $sql);
		}
	?>
  </body>
  <script src='main.js'></script>
</html>
