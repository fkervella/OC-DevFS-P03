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

//La classe ContactManager est l'interface avec la base de données. Elle exécute les commandes passées en les transformant en ordre vers la base de données
class ContactManager{

    private $dbConnect;

    //Création du lien avec la base de données
    public function __construct() {
        $this->dbConnect = new DBConnect();
    }

    //Recherche des informations de tous les contacts
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

    //Recherche des informations d'un seul contact
    public function find($id): ?Contact {

        $contact = null;

        try {
            $db = $this->dbConnect->getPDO();
            $findQuery = $db->prepare("SELECT * FROM contact WHERE id=:id");
            $findQuery->execute(['id' => $id]);
            $result = $findQuery->fetch(\PDO::FETCH_ASSOC);

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

    //suppression d'un contact
    public function delete($id): void {
        try{
            $db = $this->dbConnect->getPDO();
            $deleteQuery = $db->prepare("DELETE FROM contact WHERE id=:id");
            $deleteQuery->execute(['id' => $id]);
        } catch(\PDOException $e) {
            echo 'Erreur : ' . e->getMessage();
        }
    }    

    //création d'un contact
    public function create($name, $mail, $phoneNumber) {
        try{
            $db = $this->dbConnect->getPDO();
            $createQuery = $db->prepare('INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phoneNumber)');
            $createQuery->execute([
                    'name' => $name,
                    'email' => $mail,
                    'phoneNumber' => $phoneNumber,
                ]);
        } catch(\PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    //Modification d'un contact
    public function update($id, $name, $mail, $phoneNumber) {
        try{
            $db = $this->dbConnect->getPDO();
            $updateQuery = $db->prepare('UPDATE contact SET name=:name, email=:email, phone_number=:phoneNumber WHERE id=:id');
            $updateQuery->execute([
                'id' => $id,
                'name' => $name,
                'email' => $mail,
                'phoneNumber' => $phoneNumber,
            ]);
        } catch(\PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

}

?>
