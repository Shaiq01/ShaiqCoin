<?php

include 'BlockChain.php';

$my_private_key = file_get_contents('private_key.pem');
$my_address = file_get_contents('public_key.pem');

$shaiq_coin = new BlockChain;

$transaction = new Transaction($my_address, 'public_key_for_reciever', 10);
$transaction->signTransaction($my_address, $my_private_key);

$shaiq_coin->addTransaction($transaction);

var_dump('mining transactions');
$shaiq_coin->minePendingTransactions($my_address);
$shaiq_coin->minePendingTransactions($my_address);
var_dump('balance of Shaiq is: ' . $shaiq_coin->getBalanceOfAddress($my_address));