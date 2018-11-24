<?php  
include('templates/sqllogin.php');  
$state = $_POST['step'];
$name = $_POST['username'];
  
if(0 == $state){                                               //question recovery
		$sql = "SELECT `recoveryQ` FROM `users-h4` WHERE `username` LIKE '".$name."'";
		$_SESSION["username"]=$name;
		$ans = mysql_query($sql);
		print $ans;
		$row = mysql_fetch_array($ans);
		$question = $row["recoveryQ"];
		print $question;
	}
else if(1 == $state){                                          // question test
		$sql = "SELECT recoveryA FROM `users-h4`
		WHERE `username` =".$_SESSION['username'];
		
		$ans = mysql_query($sql);
		$row = mysql_fetch_array($ans);
		if (name == row["recoveryA"]){return true;}
		else{return false;} $question;
	}
else if(2 == $state){                                            //reset call
		$sql = "UPDATE `users-h4`
		SET `password` = `".$name."`
		WHERE `username` =".$_SESSION['username'];
	} 
 
?>