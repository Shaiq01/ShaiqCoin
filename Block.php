<?php

class Block {
    private $index;
    private $timestamp;
    public $data;
    public $previous_hash;
    public $hash;
    public $nonce;

    public function __construct($index, $timestamp, $data, $previous_hash = '') {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previous_hash = $previous_hash;
        $this->hash = $this->calculateHash();
        $this->nonce = 0;
    }

    public function calculateHash()
    {
        return hash('SHA256',$this->index . $this->timestamp. json_encode($this->data) . $this->previous_hash . $this->nonce);
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