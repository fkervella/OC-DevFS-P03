<?php

spl_autoload_register(static function ($fqcn): void {
    $path = sprintf('%s.php', str_replace(['App', '\\'], ['src', '/'], $fqcn));
    require_once($path);
});

use App\ContactManager\ContactManager;
use App\Command\Command;

while(true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, modify, quit) : ");

    if ('list' === $line) {
        Command::list();
    }
    elseif ('help' === $line) {
        Command::help();
    }
    elseif ('quit' === $line) {
        Command::quit();
    }
    elseif(preg_match('/^detail (\d+)$/', $line, $command)) {
        if(count($command) >= 2) {
            Command::detail($command[1]);
        }
        else
            echo "detail non compris.\n";
    }
    else
        echo "Vous avez saisi : $line\n";
}
?>
