<?php

namespace App\DB;

require_once('config/mysql.php');

use PDO;
use PDOException;

class DBConnect{

    private $dbPDO;

    public function __construct() {
    }

    public function getPDO() : PDO {

        if($this->dbPDO === null)
        {
            try {
                $this->dbPDO = new PDO(
                    sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT), 
                    MYSQL_USER, 
                    MYSQL_PASSWORD
                );
                $this->dbPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
        }
        return $this->dbPDO;
    }
}
?>
