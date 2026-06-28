<?php

require_once 'repository.php';
require_once 'validator.php';
require_once 'services.php';
require_once 'controller.php';

$continuer = true;

do {
    echo "\n** Menu Distributeur **\n";
    echo "1 - Créer Wallet\n";
    echo "2 - Faire Dépôt\n";
    echo "3 - Faire Retrait\n";
    echo "4 - Lister les Transactions\n";
    echo "0 - Quitter\n";
    echo "Votre choix : ";
    
    $saisie = trim(fgets(STDIN));
    if ($saisie === "") {
        continue;
    }
    $choix = intval($saisie);

    if ($choix === 0) {
        $continuer = false;
        echo "Au revoir !\n";
    } else {
        executerAction($choix);
    }

} while ($continuer);
