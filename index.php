<?php

include 'BlockChain.php';

$shaiqCoin = new BlockChain;
$shaiqCoin->addBlock(new Block(1, date('d/m/y'), "{amount:400}"));
$shaiqCoin->addBlock(new Block(2, date('d/m/y'), "{amount:100}"));

var_dump($shaiqCoin);

echo "is Chain Valid? <br>";
echo $shaiqCoin->isChainValid();

$shaiqCoin->chain[1]->data = "{amount:10}";

echo "is Chain Valid? <br>";
echo $shaiqCoin->isChainValid();