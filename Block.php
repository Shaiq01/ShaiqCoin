<?php

class Block {
    private $index;
    private $timestamp;
    public $data;
    public $previous_hash;
    public $hash;

    public function __construct($index, $timestamp, $data, $previous_hash = '') {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previous_hash = $previous_hash;
        $this->hash = $this->calculateHash();
    }

    public function calculateHash()
    {
        return hash('SHA256', $this->index . $this->timestamp. json_encode($this->data) . $this->previous_hash);
    }
}