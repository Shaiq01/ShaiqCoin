<?php

include 'BlockChain.php';

$shaiqCoin = new BlockChain;

// echo "Mining Block 1";
$shaiqCoin->addBlock(new Block(1, date('d/m/y'), "{amount:400}"));
// echo "Mining Block 2";
$shaiqCoin->addBlock(new Block(2, date('d/m/y'), "{amount:100}"));
