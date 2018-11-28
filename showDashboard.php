<?php
    session_start();
    $title = 'ShowDashboard';
    include 'templates/head.php';
   ?>
   <body>

    <?php include 'templates/header.php'; ?>

  <?php 
    
    $djname = $_SESSION["djName"];

    if (!$_SESSION['loggedin']){
        echo('<meta http-equiv="refresh" content="1;index.php" />');
    }
    if (isset($_POST['sID'])){
        $sID = $_POST['sid'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        
 
            $DBCObject->newShow($djname, $title, $sID, $start, $end);
            unset($_POST);
            echo('<meta http-equiv="refresh" content="1;stationDashboard.php" />') ;

    }
    
    
  
  
  ?>
		<div class="container">

 <?php      
    
        echo('
        <form id="stationDash" action="stationDashboard.php" method="post" >
            <ul>
            <li><label>Title: </label><input type="text" name="title" placeholder= ""required></li>
            <li><label>sID: </label><input type="text" name="sid"placeholder= ""required></li>
            <li><label>startTime: </label><input type="datetime-local" name="start"placeholder= ""required></li>
            <li><label>endTime: </label><input type="datetime-local" name="end"placeholder= ""required></li>
            </ul>
            <input type="submit" name="formSubmit" value="Create Radio Station"/>
            <a href="delshowStation.php">Delete Radio Station</a>
        </form>');
    }
    
 ?>
    
		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>