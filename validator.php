<?php

function validerMontantPositif($montant) {
    return $montant > 0;
}

function validerSoldeDisponible($telephone, $montant) {
    $wallet = trouverWalletParTelephone($telephone);
    if ($wallet === null) {
        return false;
    }
    return $wallet['solde'] >= $montant;
}

function validerCodeSecret($telephone, $codeSaisi) {
    $wallet = trouverWalletParTelephone($telephone);
    if ($wallet === null) {
        return false;
    }
    return $wallet['code'] === $codeSaisi;
}

function validerFormatTelephone($telephone) {
    if (strlen($telephone) !== 9) {
        return false;
    }
    
    for ($i = 0; $i < strlen($telephone); $i++) {
        if ($telephone[$i] < '0' || $telephone[$i] > '9') {
            return false;
        }
    }
    return true;
}
