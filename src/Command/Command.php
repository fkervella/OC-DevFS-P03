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

    public static function detail($id) {
        $CM = new ContactManager;
        $result = $CM->find($id);

        if (!is_null($result))
            echo $result->toString() . PHP_EOL;
    }

    public static function create() {

    }

    public static function delete($id) {
        $CM = new ContactManager;
        $CM->delete($id);
    }

    public static function modify() {

    }

    public static function quit() {
        echo "Fin du programme\n";
        exit(0);
    }

    public static function help() {
        echo "Help : affiche cette aide\n\n";
        echo "detail [id] : affiche le détail du contact\n\n";
        echo "list : liste les contacts\n\n";
        echo "create [name], [email], [phone number] : crée un contact\n\n";
        echo "delete [id] : supprime le contact\n\n";
        echo "modify [id] [name], [email], [phone number] : modifie le contact\n\n";
        echo "quit : quitte le programme\n\n";
        echo "Attention à la syntaxte des commandes, les espaces et les virgules sont importants.\n\n";
    }
}
?>
