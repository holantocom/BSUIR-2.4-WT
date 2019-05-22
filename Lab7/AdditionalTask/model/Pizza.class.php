<?php

class Pizza {
    private $id;
    private $name;
    private $description;
    private $price;
    private $photo;
   
    function __construct($id, $name, $description, $price, $photo)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = round($price / 10, 2);
        $this->photo = $photo;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return nl2br($this->description);
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getPrice() {
        return $this->price;
    }
    
}
