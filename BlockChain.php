<?php

include 'Block.php';
include 'Transaction.php';

class BlockChain {
    public $chain;
    public $difficulty = 1;
    public $pending_transactions = [];
    public $mining_reward = 100;

    public function __construct() {
        $this->chain = [
            $this->createGenesisBlock()
        ];
    }

    /**
     * Genesis Block is the first block in the block chain
     */
    public function createGenesisBlock()
    {
        return new Block(date('d/m/y'), "{Genesis Block}", "0");
    }

    public function getLatestBlock()
    {
        return $this->chain[count($this->chain) - 1];
    }
    
    public function minePendingTransactions($mining_reward_address)
    {
        $block = new Block(date('d/m/y'), $this->pending_transactions);
        $block->mineBlock($this->difficulty);

        echo 'Block Successfully Mined';
        array_push($this->chain, $block);

        $this->pending_transactions = [
            new Transaction(null, $mining_reward_address, $this->mining_reward )
        ];
    }

    public function addTransaction(Transaction $transaction)
    {
        if(!$transaction->from_address || !$transaction->to_address){
            throw new Error('Transaction must include a from and to address');
        }

        if(!$transaction->isValid()){
            throw new Error('Cannot add Invalid Transaction to chain');
        }

        array_push($this->pending_transactions, $transaction);
    }

    public function getBalanceOfAddress($address)
    {
        $balance = 0;

        foreach ($this->chain as $block){
            if(gettype($block->transactions) == 'string'){
                continue;
            }
            foreach($block->transactions as $transaction){
                if($transaction->from_address === $address){
                    $balance -= $transaction->amount;
                }

                if($transaction->to_address === $address){
                    $balance += $transaction->amount;
                }
            }
        }

        return $balance;
    }

    public function isChainValid()
    {
        for($i = 1; $i < count($this->chain); $i++){
            $current_block = $this->chain[$i];
            $previous_block = $this->chain[$i - 1];

            if(!$current_block->hasValidTransaction()){
                return false;
            }

            if($current_block->hash !== $current_block->calculateHash()){
                return false;
            }

            if($current_block->previous_hash !== $previous_block->hash){
                return false;
            }
        }

        return true;
    }
}