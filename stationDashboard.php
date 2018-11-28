<?php
    session_start();

    $title = 'Home';
    include 'templates/head.php';
   ?>
   <body>

    <?php include 'templates/header.php'; ?>

  <?php 

  
    if (!$_SESSION['loggedin']){
        echo('<meta http-equiv="refresh" content="1;index.php" />');
    }

    if (isset($_POST['sID'])){
        
    }
    
    

  
  
  ?>
		<div class="container">

 <?php       
    if (!($DBCObject-> isStationMaster($_SESSION["djName"]))){
        echo('I am not the master');


    }
    else{ 
        $stationInfo = $DBCObject->getStationInfo($_SESSION["djName"]);
        echo('
        <form id="signupForm" action="signup.php" method="post" onsubmit="return(validateSignupForm());">
            <ul>
            <li><label>Station Name: </label><input type="text" name="sID" placeholder= "'.$stationInfo->sID.'"></li>
            <li><label>Frequency: </label><input type="text" name="frequency"placeholder= "'.$stationInfo->Frequency.'"></li>
            <li><label>City: </label><input type="password" name="city"placeholder= "'.$stationInfo->City.'"></li>
            <li><label>Format: </label><input type="password" name="format"placeholder= "'.$stationInfo->Format.'"></li>
            </ul>
            <input type="submit" name="formSubmit" value="Signup"/>
        </form>');
    }
    
		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>
