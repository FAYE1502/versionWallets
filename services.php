<?php

function traiterCreationWallet($client, $telephone, $code, $soldeInitial) {
    if (trouverWalletParTelephone($telephone) !== null) {
        return "Erreur : Un wallet avec ce numéro existe déjà.";
    }
    enregistrerWallet($client, $telephone, $code, $soldeInitial);
    return "Succès : Wallet créé pour le client $client.";
}

function traiterDepot($telephone, $montant) {
    $wallet = trouverWalletParTelephone($telephone);
    if ($wallet === null) {
        return "Erreur : Le wallet n'existe pas.";
    }

    $nouveauSolde = $wallet['solde'] + $montant;
    mettreAJourSolde($telephone, $nouveauSolde);

    $nouvelleTx = [
        'telephone' => $telephone,
        'type' => 'depot',
        'montant' => $montant,
        'frais' => 0,
        'date' => date('Y-m-d H:i:s')
    ];
    enregistrerTransaction($nouvelleTx);

    return "Succès : Dépôt effectué. Nouveau solde : $nouveauSolde FCFA.";
}

function traiterRetrait($telephone, $codeSaisi, $montant) {
    if (!validerCodeSecret($telephone, $codeSaisi)) {
        return "Erreur : Code secret incorrect.";
    }

    $frais = $montant * 0.01;
    if ($frais > 5000) {
        $frais = 5000;
    }
    $totalADeduire = $montant + $frais;

    if (!validerSoldeDisponible($telephone, $totalADeduire)) {
        return "Erreur : Solde insuffisant (Frais requis : $frais FCFA).";
    }

    $wallet = trouverWalletParTelephone($telephone);
    $nouveauSolde = $wallet['solde'] - $totalADeduire;
    mettreAJourSolde($telephone, $nouveauSolde);

    $nouvelleTx = [
        'telephone' => $telephone,
        'type' => 'retrait',
        'montant' => $montant,
        'frais' => $frais,
        'date' => date('Y-m-d H:i:s')
    ];
    enregistrerTransaction($nouvelleTx);

    return "Succès : Retrait effectué. Frais : $frais FCFA. Nouveau solde : $nouveauSolde FCFA.";
}
