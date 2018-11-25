<!DOCTYPE html>
  <html>

    <?php
      $title = 'Login';
      include 'templates/head.php';
    ?>
    <body>
      <?php include 'templates/header.php'; ?>

      <?php
      session_unset();
      session_destroy();
      ?>
      <h5>you are now logged out</h5>
	      <meta http-equiv="refresh" content="1;index.php" />
        <?php include 'templates/footer.php'; ?>
      </body>
    </html>
