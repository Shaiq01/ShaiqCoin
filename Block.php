<?php

class Block {
    private $timestamp;
    public $transactions;
    public $previous_hash;
    public $hash;
    public $nonce;

    public function __construct($timestamp, $transactions, $previous_hash = '') {
        $this->timestamp = $timestamp;
        $this->transactions = $transactions;
        $this->previous_hash = $previous_hash;
        $this->hash = $this->calculateHash();
        $this->nonce = 0;
    }

    public function calculateHash()
    {
        return hash('SHA256',$this->timestamp. json_encode($this->transactions) . $this->previous_hash . $this->nonce);
    }

    public function mineBlock($difficulty)
    {
        while(strcmp(substr($this->hash, 0, $difficulty), str_repeat("0", $difficulty))){
            $this->hash = $this->calculateHash();
            $this->nonce = $this->nonce + 1;
        }

        echo "Block Mined: " . $this->hash;
    }
}