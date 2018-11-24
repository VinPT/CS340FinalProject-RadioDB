<?php
	session_start();
	
	include 'templates/sqllogin.php'; 
		$user = $_SESSION['username'];
        $sql = "INSERT INTO `2008597_thompvin`.`events` (`eventid`, `username`, `eventname`, `eventDescription`, `eventDT`, `eventEndTime`) VALUES (NULL, ".$user.", '".$_POST['eventTitle']."', '".$_POST['description']."', '".$_POST['startday']."-".$_POST['startmonth']."-".$_POST['startyear']." ".$_POST['starthour'].":".$_POST['startmin'].":".$_POST['startsecond']."', '".$_POST['endday']."-".$_POST['endmonth']."-".$_POST['endyear']." ".$_POST['endhour'].":".$_POST['endmin'].":".$_POST['endsecond']."')";
		
		$ans = mysql_query($sql);

		echo "The event has been created."
	?>
	