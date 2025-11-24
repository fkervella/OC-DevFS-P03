<?php

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], ['src', '/'], $fqcn));
    require_once($path);
});

$allowed = ['list'];

use App\DB\DBConnect;

$DB = new DBConnect;
$DB->connexion();
var_dump($DB->getPDO());

while(true) {
    $line = readline("Entrez votre commande : ");

    if(in_array($line, $allowed))
        echo "Affichage de la liste\n";
    else
        echo "Vous avez saisi : $line\n";
}
?>
