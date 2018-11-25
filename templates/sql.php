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
        $success = false;
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
