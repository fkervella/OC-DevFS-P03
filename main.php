<?php

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], ['src', '/'], $fqcn));
    require_once($path);
});

$allowed = ['list', 'help', 'quit'];

use App\DB\DBConnect;

$DB = new DBConnect;
var_dump($DB->getPDO());

use App\ContactManager\ContactManager;
use App\Command\Command;

while(true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, modify, quit) : ");

    if(in_array($line, $allowed)) {

        if ('list' === $line) {
            Command::list();
        }
        elseif ('help' === $line) {
            Command::help();
        }
        elseif ('quit' === $line) {
            Command::quit();
        }
    }
    else
        echo "Vous avez saisi : $line\n";
}
?>
