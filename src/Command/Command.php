<?php

namespace App\Command;

use App\ContactManager\ContactManager;

class Command{

    public static function list() {
        $CM = new ContactManager;
        $results = $CM->findAll();
    
        foreach ($results as $result) {
            echo $result->toString() . PHP_EOL;
        }
    }

    public static function detail() {

    }

    public static function create() {

    }

    public static function delete() {
    
    }

    public static function modify() {

    }

    public static function quit() {
        echo "Fin du programme\n";
        exit(0);
    }

    public static function help() {
        echo "Help : affiche cette aide\n\n";
        echo "list : liste les contacts\n\n";
        echo "create [name], [email], [phone number] : crée un contact\n\n";
        echo "delete [id] : supprime un contact\n\n";
        echo "quit : quitte le programme\n\n";
        echo "Attention à la syntaxte des commandes, les espaces et les virgules sont importants.\n\n";
    }
}
?>
