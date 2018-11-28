<?php
      $title = 'Delete Station';
      include 'templates/head.php';
    ?>

    <body>

      <?php include 'templates/header.php'; ?>
      <?php

           $DBCObject->deleteRadioStation($_POST['Title'] );

      ?>
        <meta http-equiv="refresh" content="1;index.php" /> 

      <?php include 'templates/footer.php'; ?>

    </body>

  </html>