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
    if (isset($_POST['songTitle'])){
        $showtitle = $_POST['showTitle'];
        $title = $_POST['songTitle'];
        $artist = $_POST['Artist'];
        $startTime = $_POST['StartTime'];
        
       
            $DBCObject->newSong($showtitle, $title, $artist, $startTime);
            unset($_POST);
            echo('<meta http-equiv="refresh" content="1;showDashboard.php" />') ;

    }
    
    
  
  
  ?>
		<div class="container">

 <?php      
    
        echo('
        <form id="stationDash" action="songlistadd.php" method="post" >
            <ul>
            <li><label>ShowTitle: </label>');
		getShowTitle($djname);
		echo('</li>
            <li><label>SongTitle: </label><input type="text" name="songTitle"placeholder= ""required></li>
            <li><label>Artist: </label><input type="text" name="Artist"placeholder= ""required></li>
            <li><label>StartTime: </label><input type="datetime-local" name="StartTime"placeholder= ""required></li>
            </ul>
            <input type="submit" name="formSubmit" value="Create Show"/>
            
        </form>');
    
        echo('<hr>');
        echo('<form id="stationDash" action="delsong.php" method="post" >
        <ul>
        <li><label>Title </label>');
		getSongTitle($djname);
		echo('</li>
        </ul>
        <input type="submit" name="formSubmit" value="Del Show"/>');
 ?>
    
		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>