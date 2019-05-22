<?php


class Order {
   private $id;
   private $self_delivery;
   private $customer_name;
   private $customer_email;
   private $location;
   private $comment;
   private $status;
   private $pizzas;
   private $ingredients;
   private $price;
   
   function __construct($id, $self_delivery, $customer_name, $customer_email,
            $location, $comment, $status, $pizzas, $price, $ingredients) {
      $this->id = $id;
      $this->self_delivery = $self_delivery;
      $this->customer_name = $customer_name;
      $this->customer_email = $customer_email;
      $this->location = $location;
      $this->comment = $comment;
      $this->status = $status;
      $this->pizzas = $pizzas;
      $this->ingredients = $ingredients;
      $this->price = $price;
   }

    function getId(){
        return $this->id;
    }
    
    function getDelivery(){
        return $this->self_delivery;
    }
    
    function getCustomerName(){
        return $this->customer_name;
    }
    
    function getCustomerEmail(){
        return $this->customer_email;
    }
    
    function getLocation(){
        return $this->location;
    }
    
    function getComment(){
        return $this->comment;
    }
    
    function getStatus(){
        return $this->status;
    }
    
    function getPizzas(){
        return $this->pizzas;
    }
    
    function getPrice(){
        return $this->price;
    }
    
    function getIngredients(){
        return $this->ingredients;
    }
   
}
