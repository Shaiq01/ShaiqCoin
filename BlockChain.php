<?php
include 'Block.php';

class BlockChain {
    public $chain;

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
        return new Block(0, date('d/m/y'), 'Genesis Block', "0");
    }

    public function getLatestBlock()
    {
        return $this->chain[count($this->chain) - 1];
    }

    public function addBlock(Block $new_block)
    {
        $new_block->previous_hash = $this->getLatestBlock()->hash;
        $new_block->hash = $new_block->calculateHash();
        array_push($this->chain, $new_block);
    }

    public function isChainValid()
    {
        for($i = 1; $i < count($this->chain); $i++){
            $current_block = $this->chain[$i];
            $previous_block = $this->chain[$i - 1];

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