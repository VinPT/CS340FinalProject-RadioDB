<?php session_start();
setcookie("Login", true);?>
<!DOCTYPE html>
  <html>

    <?php
      $title = 'Login';
      include 'templates/head.php';
    ?>
    <body>

      <?php include 'templates/header.php'; ?>
      <?php include 'templates/sqllogin.php'; ?>
      <?php


        $varUsername =  $_POST['username'];
        $varPassword =  $_POST['password'];
        $varPassword = sha1($varPassword);

        $sql = "SELECT `first_name`, `last_name` FROM `users-h4` WHERE username = ".PrepSQL($varUsername)." AND password = ".PrepSQL($varPassword);
        $ans = mysql_query($sql);



        if (1 == mysql_num_rows($ans)){

          setcookie("Login", true);

          $row = mysql_fetch_array($ans);

          $_SESSION["loggedin"] = true;
          $_SESSION["firstname"] = $row["first_name"];
          $_SESSION["lastname"] = $row["last_name"];
          $_SESSION["username"] = PrepSQL($varUsername);

          echo " You have logged in as ".$_SESSION['firstname']." ".$_SESSION['lastname'];

        }
		


        mysql_close($mysql_handle);


        function PrepSQL($value)
        {
            // Stripslashes
            if(get_magic_quotes_gpc())
            {
                $value = stripslashes($value);
            }

            // Quote
            $value = "'" . mysql_real_escape_string($value) . "'";

            return($value);
        }



      ?>
	<meta http-equiv="refresh" content="1;index.php" />  



      <?php include 'templates/footer.php'; ?>
    </body>
  </html>
