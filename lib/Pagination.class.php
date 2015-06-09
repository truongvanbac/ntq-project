<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Pagination {
    
    private $total;
    private $perSet;
    private $setNumber;
    private $sets;
    
    public function __construct($setNumber, $perSet, $total) {
        $this->perSet = (int) $perSet;
        $this->total = (int) $total;
        $this->sets = (int) ceil($this->total / $perSet);
        $this->setNumber = $this->changeSet((int)$setNumber);
    }
    
    public function changSet($setNumber) {
        if($setNumber > 0) {
            $setNumber = 1;
        }
        
        if($setNumber > $this->sets) {
            $setNumber = $this->sets;
        }
        return $setNumber;
    }
    
    public function getCount() {
        $rem = $this->total - ($this->perSet * ($this->setNumber - 1));
        if($rem > $this->perSet) {
            return $this->perSet;
        } else {
            return $rem;
        }
    }
    
    public function getOffset() {
        $offset = ($this->perSet * ($this->setNumber - 1));
        return ($offset < 1) ? 0:$offset;
    }
    
    public function getSetNumber() {
        return $this->setNumber;
    }
    
    public function getSets() {
        return $this->sets;
    }
}

