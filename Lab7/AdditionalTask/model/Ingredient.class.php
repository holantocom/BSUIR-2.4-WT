<?php

class Ingredient {
    private $id;
    private $name;
    private $price;
   
    function __construct($id, $name, $price) 
    {
          $this->id = $id;
          $this->name = $name;
          $this->price = $price;
    }

    public function getId() 
    {
        return $this->id;
    }
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function getPrice() 
    {
        return $this->price;
    }

}
