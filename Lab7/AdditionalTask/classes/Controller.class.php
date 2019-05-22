<?php

include 'model/Ingredient.class.php';
include 'model/Pizza.class.php';
include 'model/Size.class.php';
include 'model/Order.class.php';


class Controller {
    private $mysqli;

    function __construct(Database $mysqli) 
    {
        $this->mysqli = $mysqli->getConnection();
    }
    
    
    function LoadData($SQL)
    {
        
        if ($result = $this->mysqli->query($SQL)) {
            $answer = array();
            
            while ($row = $result->fetch_assoc()) {
                $answer[] = $row;
            }
            $result->free();

            return $answer;
        }    
        
    }

    function loadPizzas($id = -1) 
    {
        
        if($id == -1) {
            $data = $this->LoadData("SELECT * FROM pizza");
        } else {
         $data = $this->LoadData("SELECT * FROM pizza WHERE id = $id");
        }
        
        $arr = array();
        foreach($data as $row){
            $arr[] = new Pizza($row['id'], $row['name'], $row['description'], $row['kgprice'], $row['photo']);
        }
        return $arr;
        
   }

    function loadSizes($id = -1)
    {
        if($id == -1) {
            $data = $this->LoadData("SELECT * FROM size");
        } else {
            $data = $this->LoadData("SELECT * FROM size WHERE id = $id");
        }
        
        $arr = array();
        foreach($data as $row){
            $arr[] = new Size($row['id'], $row['type'], $row['size'], $row['kg']);
        }
        return $arr;
        
   }

    function loadIngredients() 
    {
        $data = $this->LoadData("SELECT * FROM ingredient");
        
        $arr = array();
        foreach($data as $row){
            $arr[] = new Ingredient($row['id'], $row['name'], $row['price']);
        }
        return $arr;
        
    }
    
    function LoadToppings($id)
    {
        $query = "SELECT pizza.name as 'name', ingredient.name as 'topping' FROM `order_ingredients` oi INNER JOIN pizza
                    ON oi.pizza_id = pizza.id
                    INNER JOIN ingredient
                    ON oi.ingredient_id = ingredient.id
                    WHERE order_id = $id;";
        $data = $this->LoadData($query);
        return $data;
    }
    
    function loadOrderedPizzas($id) 
    {
        $data = $this->LoadData("SELECT * FROM order_pizzas WHERE order_id = '$id'");
        
        $answer = array();
        foreach($data as $row){
            $answer[] = array(
               'pizza' => $this->loadPizzas($row['pizza_id'])[0],
               'size' => $this->loadSizes($row['size_id'])[0],
               'count' => $row['count']
            );
        }
        return $answer;
        
   }
    
    function loadOrders() 
    {
        
        $data = $this->LoadData("SELECT * FROM pizza_order ORDER BY id DESC");
        
        $arr = array();
        foreach($data as $row){
            $arr[] = new Order($row['id'], $row['self_delivery'], $row['customer_name'], $row['customer_email'],
                     $row['location'], $row['comment'], $row['status'], $this->loadOrderedPizzas($row['id']),
                     $row['price'], $this->loadToppings($row['id']));
        }
        return $arr;
   }

}
