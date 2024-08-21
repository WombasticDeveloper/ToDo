<?php
  require('api/start.php')
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
        $user="Admin1";
        echo "<h4>$user</h4>";
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
