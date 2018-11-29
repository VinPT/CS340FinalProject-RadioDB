<?php
  class Dbh{
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbcharset;
    private $dbpass;
    

    protected function connect(){
        $fileh = fopen("./../../DBP.txt", "r"); //  ./ sql/ cs340/ public
       
        $this->dbhost = 'classmysql.engr.oregonstate.edu';
        $this->dbname = 'cs340_klinglo';
        $this->dbuser = 'cs340_klinglo';
        $this->dbcharset = 'utf8mb4';

        $this->dbpass = rtrim(fgets($fileh), "\n");
        fclose($fileh);

        try {
            $dsn = "mysql:host=".$this->dbhost.";dbname=".$this->dbname.";charset=".$this->dbcharset;
            $DBH = new PDO($dsn, $this->dbuser, $this->dbpass);
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $DBH;
        } catch (PDOException $error) {
            echo"Connection failed: ".$error->getMessage();
        }

        
    }

    public function createUser($djname, $legalName, $password, $city, $recoveryQuestion, $recoveryAnswer){
        $success = TRUE;
        $DBH = $this->connect();
        $stmt = $DBH->prepare("INSERT INTO DJ (DJName, LegalName, Password_hash, City, RecoveryQ, RecoveryA_hash) VALUES (:djName, :legalName, :password_hash, :city, :recoveryQ, :recoveryA_hash)");
        
        $stmt->bindParam(':djName', $djname);
        $stmt->bindParam(':legalName', $legalName);
        $password_h = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password_hash', $password_h);
        $stmt->bindParam(':city', $city);
        //$stmt->bindParam(':sID', $stationID); // may need to be done later
        $stmt->bindParam(':recoveryQ', $recoveryQuestion);
        $recoveryA_h = password_hash($recoveryAnswer, PASSWORD_DEFAULT);
        $stmt->bindParam(':recoveryA_hash', $recoveryA_h);

        $stmt->execute();
        
        return $success;

    }

    public function loginUser($djname, $password){
        $success = false;
        $DBH = $this->connect();
        $stmt = $DBH->prepare('SELECT Password_hash FROM `DJ` WHERE DJName = ? LIMIT 1');
        
        $stmt->bindParam(1, $djname);

        $stmt->execute();

        $dbPass_hash = $stmt->fetchColumn();#not to be used with numbers /\/\/\/\ only one elemet returned so this works

        if (password_verify($password, $dbPass_hash)) {
            $success = true;
        }
        
        return $success;

    }

    public function newRadioStation($djname, $stationID, $frequency, $city, $format){
    
        $success = TRUE;
        $DBH = $this->connect();
        $stmt = $DBH->prepare("INSERT INTO RadioStation (sID, Frequency, City, Format, StationManager) VALUES (:sID, :frequency, :city, :format, :stationManager)");
        
        $stmt->bindParam(':sID', $stationID);
        $stmt->bindParam(':frequency', $frequency);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':format', $format);
        $stmt->bindParam(':stationManager', $djname);

        $stmt->execute();
        return $success;

    }
    public function updateRadioStation($djname, $stationID, $frequency, $city, $format){

        $result = False;
        $DBH = $this->connect();
        $stmt = $DBH->prepare('UPDATE RadioStation SET sID = ?, Frequency = ?, City = ?, Format = ? WHERE StationManager = ?');
        
        $stmt->bindParam(1, $stationID);
        $stmt->bindParam(2, $frequency);
        $stmt->bindParam(3, $city);
        $stmt->bindParam(4, $format);
        $stmt->bindParam(5, $djname);

        $stmt->execute();

        return $result;
    }

    public function getStationInfo($djname){
    
        $success = TRUE;
        $DBH = $this->connect();
        $stmt = $DBH->prepare('SELECT * FROM RadioStation WHERE StationManager = ?');

        $stmt->bindParam(1, $djname);

        $stmt->execute();

        $dbo = $stmt->fetchObject();
        //echo ($dbo->Frequency);
        return  $dbo;

    }
	
	public function getStationID($djname){
		echo "<form method=\"post\" action=\"index.php\">\n<select id = \"Station\" name = \"Station\">\n";
        
        $DBH = $this->connect();
        $stmt = $DBH->prepare('SELECT sID FROM RadioStation WHERE StationManager = ?');

        $stmt->bindParam(1, $djname);

        $stmt->execute();
		
		while($res = $stmt->fetch(PDO::FETCH_OBJ)->sID){
			$selectout = $res;
			echo "<option value = \"", $selectout, "\">", $selectout, "</option>\n";
		}
		echo "</select>";
        return  TRUE;

    }

    public function deleteRadioStation($djname){
        $DBH = $this->connect();
        $stmt = $DBH->prepare('DELETE FROM RadioStation WHERE StationManager = ?');
        
        $stmt->bindParam(1, $djname);

        $stmt->execute();

        return TRUE;
    }

    public function isStationMaster($djname){
        $result = False;
        $DBH = $this->connect();
        $stmt = $DBH->prepare('SELECT COUNT(*) FROM `RadioStation` WHERE StationManager = ?');
        
        $stmt->bindParam(1, $djname);

        $stmt->execute();

        $result = $stmt->fetchColumn();
        
        return $result;
    }
	
	public function getShowTitle($djname){
		echo "<form method=\"post\" action=\"index.php\">\n<select id = \"Station\" name = \"Station\">\n";
        
        $DBH = $this->connect();
        $stmt = $DBH->prepare('SELECT Title FROM Show WHERE StationManager = ?');

        $stmt->bindParam(1, $djname);

        $stmt->execute();
		
		while($res = $stmt->fetch(PDO::FETCH_OBJ)->sID){
			$selectout = $res;
			echo "<option value = \"", $selectout, "\">", $selectout, "</option>\n";
		}
		echo "</select>";
        return  TRUE;

    }

	public function newShow($djname, $title, $stationID, $startTime, $endTime){
    
        $success = TRUE;
        $DBH = $this->connect();
        $stmt = $DBH->prepare('INSERT INTO `Show` (`DJName`, `Title`, `sID`, `StartTime`, `EndTime`) VALUES (:djname, :title, :sID, :staTime,:enTime )');
        
        $stmt->bindParam(':djname', $djname);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':sID', $stationID);
        $stmt->bindParam(':staTime', $startTime);
        $stmt->bindParam(':enTime', $endTime);
        $stmt->execute();
        return $success;
    }

    public function getShowFromDJ($djname){
    
        $success = TRUE;
        $DBH = $this->connect();
        $stmt = $DBH->prepare("SELECT * FROM `Show` WHERE DJName = :djname");
        
        $stmt->bindParam(':djname', $djname);
        $stmt->execute();
        return $success;
    }
	
	public function deleteShow($title){
        $DBH = $this->connect();
        $stmt = $DBH->prepare('DELETE FROM `Show` WHERE `Show`.`Title` = :title');
        
        $stmt->bindParam(":title", $title);
        $stmt->execute();
        return TRUE;
    }
    
	public function getSongTitle($djname){
		echo "<form method=\"post\" action=\"index.php\">\n<select id = \"Station\" name = \"Station\">\n";
        
        $DBH = $this->connect();
        $stmt = $DBH->prepare('SELECT Title FROM Song WHERE StationManager = ?');

        $stmt->bindParam(1, $djname);

        $stmt->execute();
		
		while($res = $stmt->fetch(PDO::FETCH_OBJ)->sID){
			$selectout = $res;
			echo "<option value = \"", $selectout, "\">", $selectout, "</option>\n";
		}
		echo "</select>";
        return  TRUE;

    }
	
    public function newSong($showtitle, $title, $artist, $startTime){
    
        $success = TRUE;
        $DBH = $this->connect();
        $stmt = $DBH->prepare("INSERT INTO `Song` (`ShowTitle`, `Title`, `Artist`, `StartTime`) VALUES (:showtitle, :title, :artist, :startTime);");
        
        $stmt->bindParam(':showtitle', $showtitle);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':artist', $artist);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->execute();
        return $success;
    }
	
	public function deleteSong($title){
        $DBH = $this->connect();
        $stmt = $DBH->prepare('DELETE FROM `Song` WHERE Title = :title');
        
        $stmt->bindParam(":title", $title);
        $stmt->execute();
        return TRUE;
    }
    

    

  }

/*
class newUser{
    public $djname;
    public $legalName;
    public $password
    public $city;
    public $recoveryQuestion;
    Public $recoveryAnswer;

}*/
  ?>
