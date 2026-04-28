<?php
require_once 'config.php';
require_once 'DBConnect.php';
require_once 'Contact.php';
require_once 'ContactManager.php';
require_once 'Command.php';

$command = new Command();

while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, modify, quit) : ");

    // Commande "help"
    if (strtolower($line) === 'help') {
        $command->help();
        continue;
    }

    // Commande "list"
    if (strtolower($line) === 'list') {
        $command->list();
        continue;
    }

    // Commande "detail". Format : "detail {id}"
    if (preg_match("/^detail (\d+)$/", $line, $matches)) {
        $command->detail($matches[1]);
        continue;
    }

    // Commande "create"
    if (strtolower($line) === 'create') {
        $name = readline("Entrez le nom du contact: ");
        $email = readline("Entrez l'email du contact: ");
        $phoneNumber = readline("Entrez le numéro de téléphone du contact: ");
        $command->create($name, $email, $phoneNumber);
        continue;
    }

    // Commande "delete". Format : "delete {id}"
    if (preg_match("/^delete (\d+)$/", $line, $matches)) {
        $command->delete((int)$matches[1]);
        continue;
    }

    // Commande "modify"
    if (strtolower($line) === 'modify') {
        $id = readline("Entrez l'ID du contact à modifier: ");
        $name = readline("Entrez le nouveau nom du contact: ");
        $email = readline("Entrez le nouvel email du contact: ");
        $phoneNumber = readline("Entrez le nouveau numéro de téléphone du contact: ");
        $command->modify((int)$id, $name, $email, $phoneNumber);
        continue;
    }

    // Commande "quit"
    if (strtolower($line) === 'quit') {
        echo "Au revoir !\n";
        break;
    }

    echo "Commande inconnue : $line\n";
}