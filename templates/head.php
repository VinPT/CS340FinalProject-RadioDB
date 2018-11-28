<!DOCTYPE html>
	<html>
    <head>

      <?php session_start();
        
        
        ini_set('display_errors', 'On');

        include 'templates/sql.php';
        $DBCObject = new Dbh();
      ?>

      <meta charset="UTF-8">


      <title><?php echo $title; ?> | CS-340</title>

      <link rel="stylesheet" type="text/css" href="css/main.css"/>
      <link rel="stylesheet" type="text/css" href="css/menu.css"/>
      <link rel="stylesheet" type="text/css" href="css/signup-in.css"/>
      <link rel="stylesheet" type="text/css" href="css/footer.css"/>

      <script src="javascript/signup-in.js" type="text/javascript"></script>
 
    </head>
