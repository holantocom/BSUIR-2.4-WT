<?php

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}
spl_autoload_register('my_autoloader');


$repo = new Controller( Database::getInstance() );

$pizzas = $repo->loadPizzas();
$sizes = $repo->loadSizes();
$ingredients = $repo->loadIngredients();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="keywords" content="pizza">
        <meta name="author" content="Ermolovich">
        <title>Доставка пиццы</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="order.php" class="out-pizza flex-container" name="pizza-form" method="post" id="pizza-form">
            <?php
                foreach ($pizzas as $pizza):
            ?>
            <article class="main">
                <div class="article-head">
                    <img src="<?=$pizza->getPhoto();?>" alt="<?=$pizza->getName();?>" class="img-preview">
                </div>
                <div class="article-body">
                    <h2>
                        <a><?=$pizza->getName();?></a>
                    </h2>
                    <p><?=$pizza->getDescription();?></p>
                </div>
                <div class="article-properties">
                    <?php
                        foreach ($sizes as $size):
                            $size_price = $pizza->getPrice() * $size->getWeight();
                    ?>
                    <div class="pizza__order__size">
                        <div class="pizza__order__size__desciption">
                                <div><?=$size->getName()?>(<?=$size->getSize()?> см, <?=$size->getWeight()?> кг)</div>
                        </div>
                        <div class="pizza__order__size__count">
                            <span> <?=$size_price?> руб. | </span>
                           <input type="number" price="<?=$size_price?>" name="order[<?=$pizza->getName();?>][<?=$size->getName()?>]" min="0" max="30" value="0">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <select multiple size="4" name="indigridients[<?=$pizza->getName()?>][]" class="pizza__order__indigridients">
                        <?php
                           foreach ($ingredients as $ingredient):
                        ?>
                            <option value="<?=$ingredient->getName()?>" price="<?=$ingredient->getPrice()?>">
                                <?=$ingredient->getName()?> (<?=$ingredient->getPrice()?> руб.)
                            </option>
                        <?php endforeach; ?>
                </select>
            </article>
            <?php endforeach; ?>
            <div class='all-totals'>
                  <h3 class="total-price">Итог: <span id="total-price-value">0</span> руб</h3>
                  <input type="text" class="order-input" name="name" placeholder="Имя" required><br>
                  <input type="email" class="order-input" name="email" placeholder="Почта" required><br>
                  <input type="text" class="order-input" name="location" placeholder="Адрес" required><br>
                  <textarea name="comment" class="order-input" rows="7" cols="30" placeholder="Комментарии"></textarea><br>
                  <label for="self-delivery" style="display: inline;">Самовывоз: </label><input type="checkbox" id="self-delivery" name="self-delivery"><br>
                  <input type="submit" class="btn" value="Заказать">
            </div>    
                
        </form>    
        <script>
           HTMLCollection.prototype.toArray = function() {
              return Array.prototype.slice.call(this )
           }
           
           let form = document.getElementById('pizza-form')
           form.onchange = function(e) {
              let inputs =  form.getElementsByTagName("input")
                 .toArray()
              inputs.splice(-5,5);
        
        
        
              let options = form.getElementsByTagName("select")
                 .toArray()
                 .flatMap(a => a.selectedOptions.toArray())
        
        
              var sumOptions = options.reduce(function(sum, value) {
                return sum += parseInt(value.getAttribute('price'))
              }, 0);
        
              var sumInputs = inputs.reduce(function(sum, value) {
                return sum += value.getAttribute('price') * value.value
              }, 0);
        
              let priceEl = document.getElementById('total-price-value')
              priceEl.innerText = (sumOptions + sumInputs).toFixed(2);
           }
        </script>
    </body>
</html>
