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
}
?>
