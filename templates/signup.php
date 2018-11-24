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

      		if(empty($_POST['username']))
              {
      			$errorMessage = "<li>You forgot to enter a username!</li>";
      		}
      		if(empty($_POST['firstname']))
              {
      			$errorMessage .= "<li>You forgot to enter a first name!</li>";
      		}
      		if(empty($_POST['lastname']))
              {
      			$errorMessage .= "<li>You forgot to select your last name!</li>";
      		}
          if(empty($_POST['password']))
              {
                if(password != password2)
                    {
                  $errorMessage .= "<li>Your passwords don't match.</li>";
                }
            $errorMessage = "<li>You forgot to enter a password!</li>";
          }

          $varUsername = $_POST['username'];
      		$varFirstname = $_POST['firstname'];
          $varLastname = $_POST['lastname'];
      		$varPassword = $_POST['password'];
          $varPassword = sha1($varPassword);
      		if(empty($errorMessage))
              {



      			$sql = "INSERT INTO `2008597_thompvin`.`users-h4` (username, first_name, last_name, password, recoveryQ, recoveryA) VALUES (".
      							PrepSQL($varUsername) . ", " .
      							PrepSQL($varFirstname) . ", " .
								PrepSQL($varLastname) . ", " .
								PrepSQL($varPassword) . ", " .
								PrepSQL($ansQ) . ", " .
      							PrepSQL($anaA) . ")";

            mysql_query($sql);

      			exit();
      		}
          echo $errorMessage;

          // function: PrepSQL()
          // use stripslashes and mysql_real_escape_string PHP functions
          // to sanitize a string for use in an SQL query
          //
          // also puts single quotes around the string
          //
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
