<?php

function executerAction($choix) {
    switch ($choix) {
        case 1:
            echo "\n--- Menu Distributeur ---\n";
            echo "Nom du client : "; $client = trim(fgets(STDIN));
            echo "Numéro de téléphone : "; $tel = trim(fgets(STDIN));
            echo "Code secret (4 chiffres) : "; $code = trim(fgets(STDIN));
            echo "Dépôt initial : "; $montant = floatval(trim(fgets(STDIN)));

            if (empty($client) || !validerFormatTelephone($tel) || empty($code) || $montant < 0) {
                echo "Erreur : Informations saisies invalides.\n";
                break;
            }
            echo traiterCreationWallet($client, $tel, $code, $montant) . "\n";
            break;

        case 2:
            echo "\n--- Faire un Dépot ---\n";
            echo "Numéro de téléphone : "; $tel = trim(fgets(STDIN));
            echo "Montant du dépôt : "; $montant = floatval(trim(fgets(STDIN)));

            if (!validerFormatTelephone($tel) || !validerMontantPositif($montant)) {
                echo "Erreur : Saisie incorrecte.\n";
                break;
            }
            echo traiterDepot($tel, $montant) . "\n";
            break;

        case 3:
            echo "\n--- Faire un retrait ---\n";
            echo "Numéro de téléphone : "; $tel = trim(fgets(STDIN));
            echo "Code secret : "; $code = trim(fgets(STDIN));
            echo "Montant du retrait : "; $montant = floatval(trim(fgets(STDIN)));

            if (!validerFormatTelephone($tel) || empty($code) || !validerMontantPositif($montant)) {
                echo "Erreur : Saisie incorrecte.\n";
                break;
            }
            echo traiterRetrait($tel, $code, $montant) . "\n";
            break;

        case 4:
            echo "\n--- Historique des tranctions ---\n";
            echo "Numéro de téléphone : "; $tel = trim(fgets(STDIN));

            if (!validerFormatTelephone($tel)) {
                echo "Erreur : Format de téléphone invalide.\n";
                break;
            }

            $liste = recupererTransactionsParTelephone($tel);
            if (count($liste) === 0) {
                echo "Aucune transaction pour ce numéro.\n";
            } else {
                echo "\nDate                | Type    | Montant   | Frais\n";
                echo "--------------------------------------------------\n";
                
                for ($i = 0; $i < count($liste); $i++) {
                    printf("%s | %-7s | %-9d | %-5d\n", 
                        $liste[$i]['date'], 
                        $liste[$i]['type'], 
                        $liste[$i]['montant'], 
                        $liste[$i]['frais']
                    );
                }
            }
            break;
    }
}
