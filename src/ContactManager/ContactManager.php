<?php

declare(strict_types = 1);

namespace App\ContactManager;

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], ['src', '/'], $fqcn));
    require_once($path);
});

use App\DB\DBConnect;
use PDOException;

class ContactManager{

    private $dbConnect;

    public function __construct() {
        $this->dbConnect = new DBConnect();
    }

    public function findAll():array {
        try {
            $result = array();
            $db = $this->dbConnect->getPDO();
            $findAllQuery = $db->prepare("SELECT * FROM contact");
            $findAllQuery->execute();
            $result = $findAllQuery->fetchAll();
        } catch(\PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }

        return $result;
    }    
}

?>
