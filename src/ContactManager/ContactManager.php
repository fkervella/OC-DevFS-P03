<?php

declare(strict_types = 1);

namespace App\ContactManager;

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], ['src', '/'], $fqcn));
    require_once($path);
});

use App\DB\DBConnect;
use PDOException;
use App\Contact\Contact;

class ContactManager{

    private $dbConnect;

    public function __construct() {
        $this->dbConnect = new DBConnect();
    }

    public function findAll(): ?array {
        try {
            $result = array();
            $db = $this->dbConnect->getPDO();
            $findAllQuery = $db->prepare("SELECT * FROM contact");
            $findAllQuery->execute();
            $results = $findAllQuery->fetchAll();

            foreach ($results as $result) {
                if(array_key_exists('id', $result) 
                    && array_key_exists('name', $result) 
                    && array_key_exists('email', $result) 
                    && array_key_exists('phone_number', $result)) {

                    $contacts[] = new Contact(
                        $result['id'], 
                        $result['name'], 
                        $result['email'], 
                        $result['phone_number']);
                }
            }

        } catch(\PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }

        return $contacts;
    }

    public function find($id): ?Contact {

        $contact = null;

        try {
            $db = $this->dbConnect->getPDO();
            $findAllQuery = $db->prepare("SELECT * FROM contact WHERE id=:id");
            $findAllQuery->execute(['id' => $id]);
            $result = $findAllQuery->fetch(\PDO::FETCH_ASSOC);

            if(is_array($result)
                && array_key_exists('id', $result) 
                && array_key_exists('name', $result) 
                && array_key_exists('email', $result) 
                && array_key_exists('phone_number', $result)) {

                $contact = new Contact(
                    $result['id'], 
                    $result['name'], 
                    $result['email'], 
                    $result['phone_number']);
            }

        } catch(\PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }

        return $contact;
    }    
    
}

?>
