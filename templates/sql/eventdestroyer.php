
	<?php include 'templates/sqllogin.php'; 
	
	$sql = "DELETE FROM `2008597_thompvin`.`events` WHERE `events`.`eventid` = " .$_POST["Eventid"];
        $ans = mysql_query($sql);
		print "Event Deleted";
		?>