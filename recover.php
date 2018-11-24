<?php
	session_start();
	echo "<!DOCTYPE html>";
	echo " <html>";


    $title = 'Home';
    include 'templates/head.php';
   ?>
   <body>
	<script src="ss.js" type="text/javascript"></script>
    <?php include 'templates/header.php'; ?>
	<?php include 'templates/sqllogin.php'; ?>
	<article>
	<p>Our password recovery system works in a three step process. 
	First you enter your username which will get your security question. 
	Step two answer the question. Step three implement a new password. 
	Once you enter your new password you may login with it.
	All passwords must start with a capitol and end with two digits.</p>
	
	<form class="" action="" method="post" onsubmit="">
          <ul>
            <li><p id = "label">enter your user name: </p><input type="text" id="field"></li>
          </ul>
          <input type="button" id="button" onclick="AJAXrecover();" value="enter">
	</form>
	
	<p id = "message"></p>
	</article>
     <?php include 'templates/footer.php'; ?>
   </body>
 </html>