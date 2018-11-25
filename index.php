<?php
	

    $title = 'Home';
    include 'templates/head.php';
   ?>
   <body>

    <?php include 'templates/header.php'; ?>
	<?php include 'templates/sql.php'; ?>

	<?php echo password_hash('rasmuslerdorf', PASSWORD_DEFAULT)."\n"?>
		<div class="container">
    
		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>
