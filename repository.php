<?php

$wallets = [
    ['client' => 'Bailo Wane', 'telephone' => '771234567', 'code' => '1234', 'solde' => 0],
    ['client' => 'Awa Diop', 'telephone' => '789876543', 'code' => '1234', 'solde' => 0]
];
$transactions = [];

function trouverWalletParTelephone($telephone) {
    global $wallets;
    for ($i = 0; $i < count($wallets); $i++) {
        if ($wallets[$i]['telephone'] === $telephone) {
            return $wallets[$i];
        }
    }
    return null;
}

function mettreAJourSolde($telephone, $nouveauSolde) {
    global $wallets;
    for ($i = 0; $i < count($wallets); $i++) {
        if ($wallets[$i]['telephone'] === $telephone) {
            $wallets[$i]['solde'] = $nouveauSolde;
            return true;
        }
    }
    return false;
}

function enregistrerWallet($client, $telephone, $code, $soldeInitial) {
    global $wallets;
    $wallets[count($wallets)] = [
        'client' => $client,
        'telephone' => $telephone,
        'code' => $code,
        'solde' => $soldeInitial
    ];
}

function enregistrerTransaction($transaction) {
    global $transactions;
    $transactions[count($transactions)] = $transaction;
}

function recupererTransactionsParTelephone($telephone) {
    global $transactions;
    $filtree = [];
    for ($i = 0; $i < count($transactions); $i++) {
        if ($transactions[$i]['telephone'] === $telephone) {
            $filtree[count($filtree)] = $transactions[$i];
        } 
    }
    return $filtree;
}