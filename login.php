
    <?php
      $title = 'Login';
      include 'templates/head.php';
    ?>
    <body>

      <?php include 'templates/header.php'; ?>
      <?php

        if(empty($_POST['djname']))
              {
      			$errorMessage .= "<li>You must enter a username!</li>";
          }
          if(empty($_POST['password']))
              {
      			$errorMessage .= "<li>You must enter a password to login!</li>";
      		}

        $vardjName =  $_POST['djname'];
        $varPassword =  $_POST['password'];

        if(empty($errorMessage))
          {
            $DBCObject = new Dbh();

            $success = $DBCObject->loginUser($vardjName, $varPassword);

            if ($success == TRUE){
    
              $_SESSION['loggedin'] = TRUE;
              $_SESSION['djName'] = $_POST['djname'];
    
             // echo ("<li> You have logged in as ".$_SESSION['djName'].".</li>"]);
    
            }
            else{
             // echo ("<li>Password was not correct. We ask that you try again or use the password recovery tool.</li>");
            }
             
        }


      ?>
	    <meta http-equiv="refresh" content="1;index.php" />  



      <?php include 'templates/footer.php'; ?>
    </body>
  </html>
