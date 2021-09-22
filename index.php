<?php

include 'BlockChain.php';

$shaiq_coin = new BlockChain;

$shaiq_coin->createTransaction(new Transaction('address1', 'address2', 100));
$shaiq_coin->createTransaction(new Transaction('address2', 'address1', 50));

var_dump('mining transactions');
$shaiq_coin->minePendingTransactions('shaiq-address');
var_dump('balance of Shaiq is: ' . $shaiq_coin->getBalanceOfAddress('shaiq-address'));


var_dump('mining transactions again');
$shaiq_coin->minePendingTransactions('shaiq-address');
var_dump('balance of Shaiq is: ' . $shaiq_coin->getBalanceOfAddress('shaiq-address'));