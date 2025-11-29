<?php

namespace App\Command;

use App\ContactManager\ContactManager;

//Cette classe passe les commandes utilsateurs au gestionnaire de contact
class Command{

    //list affiche la liste des contacts du ContactManager
    public static function list() {
        $CM = new ContactManager;
        $results = $CM->findAll();
    
        foreach ($results as $result) {
            echo $result . PHP_EOL;
        }
    }

    //detail affiche les informations du contact dont l'id est passé en paramètre en passant par le ContactManager
    public static function detail($id) {
        $CM = new ContactManager;
        $result = $CM->find($id);

        if (!is_null($result))
            echo $result . PHP_EOL;
    }

    //create créé un contact dans le ContactManager
    public static function create($name, $mail, $phoneNumber) {
        $CM = new ContactManager;
        $CM->create($name, $mail, $phoneNumber);
    }

    //delete supprime un contact dans le ContactManager
    public static function delete($id) {
        $CM = new ContactManager;
        $CM->delete($id);
    }

    //update met à jour le contact indiqué, dans le ContactManager, selon les informations passées en paramètre
    public static function update($id, $name, $mail, $phoneNumber) {
        $CM = new ContactManager;
        $CM->update($id, $name, $mail, $phoneNumber);
    }

    //quit ferme le programme
    public static function quit() {
        echo "Fin du programme\n";
        exit(0);
    }

    //help affiche l'aide du programme
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
