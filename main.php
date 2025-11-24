<?php

$allowed = ['list'];

while(true) {
    $line = readline("Entrez votre commande : ");

    if(in_array($line, $allowed))
        echo "Affichage de la liste\n";
    else
        echo "Vous avez saisi : $line\n";
}
?>
