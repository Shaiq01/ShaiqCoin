<?php

class Transaction {

    public $from_address;
    public $to_address;
    public $amount;
    public $signature;

    function __construct($from_address, $to_address, $amount) {
        $this->from_address = $from_address;
        $this->to_address = $to_address;
        $this->amount = $amount;
    }

    public function calculateHash()
    {
        return hash('SHA256', $this->from_address . $this->to_address. $this->amount);
    }

    public function signTransaction($public_key, $private_key)
    {
        if($public_key !== $this->from_address){
            throw new Error('You cannot sign transactions for other wallets');
        }
        $hash_tx = $this->calculateHash();
        openssl_sign($hash_tx, $this->signature, $private_key, OPENSSL_ALGO_SHA256);
    }

    public function isValid()
    {
        if($this->from_address === null) return true;

        if(!$this->signature || strlen($this->signature) == 0){
            throw new Error('No Signature in the transaction');
        }

        return openssl_verify($this->calculateHash(), $this->signature, $this->from_address, "sha256WithRSAEncryption");
    }
}