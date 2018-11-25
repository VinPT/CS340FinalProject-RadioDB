<?php
  class Dbh{
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbcharset;
    private $dbpass;
    

    protected function connect(){
        $fileh = fopen("./../../../DBP.txt", "r"); //  ./ sql/ cs340/ public
       
        $this->dbhost = 'classmysql.engr.oregonstate.edu';
        $this->dbname = 'cs340_klinglo';
        $this->dbuser = 'cs340_klinglo';
        $this->dbcharset = 'utf8mb4';

        $this->dbpass = rtrim(fgets($fileh), "\n");
        fclose($fileh);

        try {
            $dsn = "mysql:host=".$this->dbhost.";dbname=".$this->dbname.";charset=".$this->dbcharset;
            $pdo = new PDO($dsn, $this->dbuser, $this->dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo"Connection failed: ".$e->getMessage();
        }

        
    }
  }

?>
