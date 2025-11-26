<?php

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], ['src', '/'], $fqcn));
    require_once($path);
});

$allowed = ['list'];

use App\DB\DBConnect;

$DB = new DBConnect;
var_dump($DB->getPDO());

use App\ContactManager\ContactManager;
use App\Contact\Contact;

while(true) {
    $line = readline("Entrez votre commande : ");

    if(in_array($line, $allowed)) {
    
        $CM = new ContactManager;
        $results = $CM->findAll();
    
        foreach ($results as $result) {
            echo $result->toString() . PHP_EOL;
        }
    }
    else
        echo "Vous avez saisi : $line\n";
}
?>
