<?php
    session_start();

    $title = 'Home';
    include 'templates/head.php';
   ?>
   <body>
   <?php
			include 'templates/header.php';
	?>


  
		<div class="container">
		<?php
			ini_set('display_errors', 'On');
			error_reporting(E_ALL | E_STRICT);
			$myPostArgs = filter_input_array(INPUT_POST);
			$host = 'classmysql.engr.oregonstate.edu';
			$db = 'cs340_klinglo';
			$user = 'cs340_klinglo';
			$charset = 'utf8mb4';
			$pass = 'EnThelatIGnAcKToRDOVEiekeSpECtIo';
			
			// define database source name for accessing MariaDB
			$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
			$opt = array(
				//if there is a MariaDB error, generate a PHP exception
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				
				/*returns an array indexed by column name
				as returned in your result set:*/
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				
				/*if the database driver can't do a prepend statement, don't
				fake it (shouldn't be an issue for MariaDB driver):*/
				PDO::ATTR_EMULATE_PREPARES => false,
			);
			echo "<select id = \"Station\" name = \"Station\">\n<option value = \"Station\">Station</option>\n";
			
			try {
				$pdo = new PDO($dsn, $user, $pass, $opt);
				$sql= 'SELECT sID FROM RadioStation';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				
				while($res = $stmt->fetch(PDO::FETCH_OBJ)->sID){
					$selectout = $res;
					echo "<option value = \"", $selectout, "\">", $selectout, "</option>\n";
				}
				echo "</select>";
				}
			catch (PDOException $e) {
				$error_message = $e->getMessage();
				echo $error_message;
			}
			
			echo "<select id = \"Artist\" name=\"Artist\">\n<option value = \"Artist\">Artist</option>\n";
			try {
				$pdo = new PDO($dsn, $user, $pass, $opt);
				$sql= 'SELECT Artist FROM Song GROUP BY Artist';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				
				while($res = $stmt->fetch(PDO::FETCH_OBJ)->Artist){
					$selectout = $res;
					echo "<option value = \"", $selectout, "\">", $selectout, "</option>\n";
				}
				echo "</select>";
				}
			catch (PDOException $e) {
				$error_message = $e->getMessage();
				echo $error_message;
			}
			
			echo "<select id = \"DJ\" name=\"DJ\">\n<option value = \"DJ\">DJ</option>\n";
			try {
				$pdo = new PDO($dsn, $user, $pass, $opt);
				$sql= 'SELECT DJName FROM DJ';
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				
				while($res = $stmt->fetch(PDO::FETCH_OBJ)->DJName){
					$selectout = $res;
					echo "<option value = \"", $selectout, "\">", $selectout, "</option>\n";
				}
				echo "</select>";
			}
			catch (PDOException $e) {
				$error_message = $e->getMessage();
				echo $error_message;
			}
			?>
			<input type="submit" name="Submit" value="Submit"/>
		</form>
	
		<table>
			<?php
			//echo "<form method="post" action="list-users.php">\n\t\t\t<table>";
			try{
				echo "\t\t<table>\n\t\t\t<tr><td> Song Title    </td> <td> Artist Name    </td> <td> Station ID    </td> <td> DJ Name   </td> <td> Time    </td></tr>\n";
				$pdo = new PDO($dsn, $user, $pass, $opt);
				$sql = "SELECT Song.Title, Song.Artist, `Show`.sID, DJ.DJName, Song.StartTime FROM Song, DJ, `Show` WHERE Song.ShowTitle = `Show`.Title AND `Show`.`DJName` = DJ.DJName";
				if(isset($_POST["Submit"])){
					if($_POST["Station"] != "Station"){
						$template = $sql . " AND `Show`.sID LIKE \"%s\"";
						$sql = sprintf($template, $_POST["Station"]);
					}
					if($_POST["Artist"] != "Artist"){
						$template = $sql . " AND Song.Artist LIKE \"%s\"";
						$sql = sprintf($template, $_POST["Artist"]);
					}
					if($_POST["DJ"] != "DJ"){
						$template = $sql . " AND DJ.DJName LIKE \"%s\"";
						$sql = sprintf($template, $_POST["DJ"]);
					}
				}
				
				$stmt = $pdo->prepare($sql);
				
				//$res = $stmt->fetchObject()
				
				$stmt->execute();
				
				while($res = $stmt->fetchObject()){
					echo "<tr>";
					foreach ($res as $row) {
						echo "<td>", $row, "</td> ";
					}
					echo "</tr>\n";
				}
				
				
			}/**/
			catch (PDOException $e) {
				$error_message = $e->getMessage();
				echo $error_message;
			}
			?>
		</table>
	
		</div>

     <?php include 'templates/footer.php'; ?>
   </body>
 </html>
