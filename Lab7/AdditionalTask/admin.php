<?php

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}
spl_autoload_register('my_autoloader');


$repo = new Controller( Database::getInstance() );
$mysqli = Database::getInstance()->getConnection();
$sendPost = new SendPost('ilya@holanto.com');

$auth = new auth();
$hash = $_COOKIE['auth_session'] ?? '';
$page = $_GET['page'] ?? '';
$mySQL = mysqli_connect("", "", "", "");
    
if(!$auth->checksession($hash)){
    if(isset($_POST['username']) && isset($_POST['password'])){
        if(!$auth->login($_POST['username'], $_POST['password'])){
            include "login.php";
            exit;
        }
    } else {
        include "login.php";
        exit;
    }    
}

if(isset($_POST['change-new'])) {
   $id = $_POST['id'];
   $email = $_POST['email'];
   $msg = 'Заказ поступил на выполнение и будет доставлен в течении 1 часа.';
   $sendPost->sendEmail($email, 'Заказ принят', $msg);

   $query = "UPDATE pizza_order set status = 'ACCEPTED' WHERE id = '$id'";
   $mysqli->query($query);

}
if(isset($_POST['change-accepted'])) {
   $id = $_POST['id'];
   $query = "UPDATE pizza_order set status = 'DONE' WHERE id = '$id'";
   $mysqli->query($query);
}
$orders = $repo->loadOrders();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Заказы</title>
   <style media="screen">
      td  {
          border: 1px solid #000;
          padding: 3px 5px;
          text-align: center;
      }
      body {
         padding: 0;
         margin: 0;
      }
      table {
          background: #fff;
          color: #000;
          width: 100%;
          border-collapse: collapse;
      }
   </style>
</head>
<body>

<table>
      <tbody>
         <tr>
            <th>Заказ</th>
            <th>Самовывоз</th>
            <th>Пользователь</th>
            <th>Информация</th>
            <th>Цена</th>
            <th>Комментарии</th>
            <th>Статус</th>
         </tr>
         <?php
         foreach ($orders as $order):
         ?>
            <tr>
               <td><?=$order->getId()?></td>
               <td><?php if($order->getDelivery()) echo 'Да'; else echo 'Нет';?> </td>
               <td><?='Имя: '.$order->getCustomerName()."<br>Почта: ".$order->getCustomerEmail().'<br>Адрес: '.$order->getLocation()?></td>
               <td>
                  <?php
                  $orderedPizzas = $order->getPizzas();
                  foreach ( $order->getPizzas() as $orderedPizza) {
                     echo $orderedPizza['pizza']->getName().' ('.$orderedPizza['size']->getName().') x '.$orderedPizza['count'].'<br>';
                  }
                  echo "<br>";
                  foreach ($order->getIngredients() as $topping) {
                    echo $topping['name'].' - '.$topping['topping'].'<br>';
                  }
                  ?>
               </td>
               <td><?=round($order->getPrice() / 10, 2).' руб.'?></td>
               <td><?=$order->getComment()?></td>
               <td>
                   <?=$order->getStatus()?><br>
                   <?php
                    switch ($order->getStatus()):
                        case 'NEW':
                        ?>
                        <form action="" method="post" name="change-new">
                           <input type="text" name="id" value="<?=$order->getId()?>" style="display: none">
                           <input type="text" name="email" value="<?=$order->getCustomerEmail()?>" style="display: none">
                           <input type="submit" name="change-new" value="Принять к выполнению">
                        </form>

                        <?php
                           break;
                        case 'ACCEPTED':
                        ?>
                        <form action="" method="post" name="change-accepted">
                           <input type="text" name="id" value="<?=$order->getId()?>" style="display: none">
                           <input type="submit" name="change-accepted" value="Сделано">
                        </form>

                        <?php
                           break;
                    endswitch;
                  ?>
               
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</table>

</body>
</html>
