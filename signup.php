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

      		if(empty($_POST['djName']))
              {
      			$errorMessage = "<li>You forgot to enter a username!</li>";
      		}
      		if(empty($_POST['legalName']))
              {
      			$errorMessage .= "<li>You forgot to enter a first name!</li>";
      		}
      		if(empty($_POST['password']))
              {
      			$errorMessage .= "<li>You forgot to select your last name!</li>";
      		}
          if(empty($_POST['password2']))
              {
                if(password != password2)
                    {
                  $errorMessage .= "<li>Your passwords don't match.</li>";
                }
            $errorMessage = "<li>You forgot to reenter your password!</li>";
          }
          if(empty($_POST['recoveryQ']))
              {
      			$errorMessage .= "<li>You forgot to enter your recovery Question!</li>";
          }
          if(empty($_POST['recoveryA']))
              {
      			$errorMessage .= "<li>You forgot to enter your recovery Answer!</li>";
      		}

          $djName = $_POST['djName'];
      		$legalName = $_POST['legalName'];
          $pass = $_POST['password'];
      		$city = $_POST['city'];
          $recoveryQ = $_POST['recoveryQ'];
          $recoveryA = $_POST['recoveryA'];
      		if(empty($errorMessage))
              {
                
                exit();
              }
          echo $errorMessage;

          
      ?>

	<meta http-equiv="refresh" content="1;index.php" />


      <?php include 'templates/footer.php'; ?>
    </body>
  </html>
