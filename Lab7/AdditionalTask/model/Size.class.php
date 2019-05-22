<?php

class Size {
    private $id;
    private $name;
    private $size;
    private $weight;
   
    function __construct($id, $name, $size, $weight) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->weight = $weight;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getSize() {
        return $this->size;
    }
    
    public function getWeight() {
        return $this->weight;
    }

}
