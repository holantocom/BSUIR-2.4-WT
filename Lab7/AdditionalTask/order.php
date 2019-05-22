<?php

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}
spl_autoload_register('my_autoloader');

$repo = new Controller( Database::getInstance() );
$mysqli = Database::getInstance()->getConnection();

$pizzas = $repo->loadPizzas();
$sizes = $repo->loadSizes();
$ingredients = $repo->loadIngredients();

if(isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $self_delivery = (isset($_POST['self-delivery']) and $_POST['self-delivery'] == 'no') ? 1 : 0;
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
} else {
    exit('Error with sended data');
}    



$query = "INSERT INTO pizza_order
        (self_delivery, customer_name, customer_email, location, comment, status)
        VALUES ('$self_delivery', '$name', '$email', '$location', '$comment', 'NEW')";
$mysqli->query($query);
$order_id =  $mysqli->insert_id;

$tablePizzas = '<table border="1" style="border-collapse: collapse;">
   <tr>
    <th>Пицца</th>
    <th>Размер</th>
    <th>Количество</th>
    <th>Цена</th>
   </tr>';

$tableIngredients = '<table border="1" style="border-collapse: collapse;">
   <tr>
    <th>Пицца</th>
    <th>Топпинг</th>
    <th>Цена</th>
   </tr>';
   
$totalPrice = 0;   

foreach ($pizzas as $pizza) {
    
    $currPizza = $_POST['order'][$pizza->getName()];
   
    foreach ($sizes as $size) {
        $currCount = $currPizza[$size->getName()];
        if($currCount != 0) {
            $pizza_id = $pizza->getId();
            $size_id = $size->getId();
            $query = "INSERT INTO order_pizzas(order_id, pizza_id, size_id, count)
                VALUES ('$order_id', '$pizza_id', '$size_id', '$currCount')";
            $mysqli->query($query);

            $tablePizzas = $tablePizzas.'<tr><td>'.$pizza->getName().'</td>
                              <td>'.$size->getName().'</td>
                              <td>'.$currCount.'</td>
                              <td>'.$currCount*$pizza->getPrice()*$size->getWeight().'</td>
                          </tr>';
                          
            $totalPrice += $currCount*$pizza->getPrice()*$size->getWeight();      
      }
   }

   if(isset($_POST['indigridients'])) {
      if(array_key_exists($pizza->getName(), $_POST['indigridients'])) {
         $arr = $_POST['indigridients'][$pizza->getName()];
         foreach ($ingredients as $ingredient) {
            for($i = 0; $i < count($arr); $i++) {
                if($arr[$i] == $ingredient->getName()) {
                    $pizza_id = $pizza->getId();
                    $ing_id = $ingredient->getId();
                    $query = "INSERT INTO order_ingredients(order_id, pizza_id, ingredient_id)
                        VALUES ('$order_id', '$pizza_id', '$ing_id')";
                    $mysqli->query($query);

                    $tableIngredients = $tableIngredients.'<tr><td>'.$pizza->getName().'</td>
                                       <td>'.$ingredient->getName().'</td>
                                       <td>'.$ingredient->getPrice().'</td>
                                   </tr>';
                                   
                    $totalPrice += $ingredient->getPrice();              
                                   
               }
            }
         }
      }

   }
   
}

$mysqli->query("UPDATE pizza_order set price = '".($totalPrice * 10)."' WHERE id = $order_id");

$tablePizzas = $tablePizzas.'</table><br>';
$tableIngredients = $tableIngredients.'</table><br>';

$email_content = '<h4>Детали: </h4>';
$email_content = $email_content.'<b>Имя</b>: '.$name.'<br>';
$email_content = $email_content.'<b>Адрес</b>: '.$location.'<br>';
$email_content = $email_content.'<b>Итог</b>: '.$totalPrice.'<br>';
$email_content = $email_content.'<b>Заказ</b>: '.$order_id.'<br>';
$email_content = $email_content.'<b>Комментарии</b>: '.$comment.'<br><br>';

$email_content = $email_content.$tablePizzas;
$email_content = $email_content.$tableIngredients;

$user_email_content = '<h3>Вы сделали заказ в БГУИРПицца. Спасибо за заказ!</h3>'.$email_content;

$sendPost = new SendPost('ilya@holanto.com');

$sendPost->sendEmail($email, 'Заказ - БГУИРПицца', $user_email_content);
$sendPost->sendEmail($sendPost->manager_email, 'Заказ - БГУИРПицца', $email_content);

echo '<script type="text/javascript">
    window.location = "https://holanto.com/projects/WT/7lab/add/"
</script>';
