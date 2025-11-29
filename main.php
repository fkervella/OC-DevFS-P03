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
    elseif(preg_match('/^delete (\d+)$/', $line, $command)) {
        if(count($command) >= 2) {
            Command::delete($command[1]);
        }
        else
            echo "delete non compris.\n\n";
    }
    elseif(preg_match('/^create ([a-zA-Z]+), ([a-zA-Z]+@[a-zA-Z]+.[a-zA-Z]+), (\d+)$/', $line, $command)) {
        if(count($command) >= 3) {
            Command::create($command[1], $command[2], $command[3]);
        }
        else
            echo "create non compris.\n\n";
    }
    elseif(preg_match('/^modify (\d+), ([a-zA-Z]+), ([a-zA-Z]+@[a-zA-Z]+.[a-zA-Z]+), (\d+)$/', $line, $command)) {
        if(count($command) >= 4) {
            Command::update($command[1], $command[2], $command[3], $command[4]);
        }
        else
            echo "modify non compris.\n\n";
    }
    else
        echo "Vous avez saisi : $line\n";
}
?>
