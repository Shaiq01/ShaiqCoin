<?php

class Transaction {

    public $from_address;
    public $to_address;
    public $amount;

    function __construct($from_address, $to_address, $amount) {
        $this->from_address = $from_address;
        $this->to_address = $to_address;
        $this->amount = $amount;
    }
}