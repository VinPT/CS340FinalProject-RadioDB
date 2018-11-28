<?php
    session_start();

    $title = 'Home';
    include 'templates/head.php';
   ?>
   <body>

    <?php include 'templates/header.php'; ?>

  <?php 

  
  $pass = 'rasmuslerdorf';
  $notPass = 'lama';
  $hash = password_hash($pass, PASSWORD_DEFAULT);
  if (password_verify($notPass, $hash)) {
    echo('True \n');
  } else {
    echo('False \n');
  }
  
  ?>
		<div class="container">
    
		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>
