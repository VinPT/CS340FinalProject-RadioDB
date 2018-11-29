<?php
    session_start();

    $title = 'Home';
    include 'templates/head.php';
   ?>
   <body>

    <?php include 'templates/header.php'; ?>

  <?php 
    $isMaster = $DBCObject-> isStationMaster($_SESSION["djName"]);
    $djname = $_SESSION["djName"];

    if (!$_SESSION['loggedin']){
        echo('<meta http-equiv="refresh" content="1;index.php" />');
    }

    if (isset($_POST['sID'])){
        $sID = $_POST['sID'];
        $frequency = $_POST['frequency'];
        $city = $_POST['city'];
        $format = $_POST['format'];
        
        if ($isMaster){
            $DBCObject->updateRadioStation($djname, $sID, $frequency, $city, $format);
            unset($_POST);
            echo('<meta http-equiv="refresh" content="1;stationDashboard.php" /> ');
        }
        else{
            $DBCObject->newRadioStation($djname, $sID, $frequency, $city, $format);
            unset($_POST);
            echo('<meta http-equiv="refresh" content="1;stationDashboard.php" />') ;
        }

    }
    
    

  
  
  ?>
		<div class="container">

 <?php      
    if (!($isMaster)){
        echo('
        <form id="stationDash" action="stationDashboard.php" method="post" >
            <ul>
            <li><label>Station Name: </label><input type="text" name="sID" placeholder= ""required></li>
            <li><label>Frequency: </label><input type="text" name="frequency"placeholder= ""required></li>
            <li><label>City: </label><input type="text" name="city"placeholder= ""required></li>
            <li><label>Format: </label><input type="text" name="format"placeholder= ""required></li>
            </ul>
            <input type="submit" name="formSubmit" value="Create Radio Station"/>
        </form>');


    }
    else{ 
        $stationInfo = $DBCObject->getStationInfo($djname);
        echo('
        <form id="stationDash" action="stationDashboard.php" method="post" >
            <ul>

            <li><label>Station Name: </label><input type="text" name="sID" placeholder= "'.$stationInfo->sID.'" required ></li>
            <li><label>Frequency: </label><input type="text" name="frequency"placeholder= "'.$stationInfo->Frequency.'" required ></li>
            <li><label>City: </label><input type="password" name="city"placeholder= "'.$stationInfo->City.'" required ></li>
            <li><label>Format: </label><input type="password" name="format"placeholder= "'.$stationInfo->Format.'"></li>
            </ul>
            <input type="submit" name="formSubmit" value="Update Radio Station"/>
            <a href="delRadioStation.php">Delete Radio Station</a>
        </form>');
    }

    
 ?>
    
		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>
