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
    if (isset($_POST['sid'])){
        $sID = $_POST['sid'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        
 
            $DBCObject->newShow($djname, $title, $sID, $start, $end);
            unset($_POST);
            echo('<meta http-equiv="refresh" content="1;showDashboard.php" />') ;

    }
    
    
  
  
  ?>
		<div class="container">

 <?php      
    
        echo('
        <form id="stationDash" action="showDashboard.php" method="post" >
            <ul>
            <li><label>Title: </label><input type="text" name="title" placeholder= ""required></li>
            <li><label>sID: </label>');
            $DBCObject->getStationID($djname);
		echo('</li>
            <li><label>startTime: </label><input type="datetime-local" name="start"placeholder= ""required></li>
            <li><label>endTime: </label><input type="datetime-local" name="end"placeholder= ""required></li>
            </ul>
            <input type="submit" name="formSubmit" value="Create Show"/>
            
        </form>');
    
        echo('<hr>');
        echo('<form id="stationDash" action="delshow.php" method="post" >
        <ul>
        <li><label>Title </label>');
		$DBCObject->getShowTitle($djname);
		echo('</li>
        </ul>
        <input type="submit" name="formSubmit" value="Del Show"/>');
 

        $shows = $DBCObject->getShowFromDJ($djname);
        //$numShows = $DBCObject->numShows($djname);
        //while($shows = $DBCObject->getShowFromDJ($djname)){
        //    echo "<tr>";
        //    foreach ($shows as $row) {
        //        echo "<td>", $row, "</td> ";
        //    }
        //    echo "</tr>\n";
        //}
    ?>

		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>