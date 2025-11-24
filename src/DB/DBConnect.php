<?php

namespace App\DB;

require_once('config/mysql.php');

class DBConnect{

    private $dbPDO;

    public function __construct() {
    }

    public function connexion() {
        try {
            c
                sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT), 
                MYSQL_USER, 
                MYSQL_PASSWORD
            );
            $this->dbPDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e) {
            echo 'Erreur : ' . $e->getMessage;
        }
    }

    public function getPDO() : \PDO {
        return $this->dbPDO;
    }
}
?>
