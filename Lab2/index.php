<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="Cars testdrives">
        <meta name="keywords" content="cars, reviews">
        <meta name="author" content="Yermolovich">
        <title>AutoCheck | Главная</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="branding">
                    <a href="index.html"><h1>AutoCheck</h1></a>
                </div>
                <?php
                    $navs = array('Главная', 'О нас', 'Регистрация', 'Вход');
                    if(isset($_GET['id']))
                        $id = $_GET['id'];
                    else 
                        $id = 0;
                ?>    
                <nav>
                    <ul>
                        <?php
                            foreach($navs as $key => $nav):
                        ?>        
                            <li <?php if($key == $id) echo 'class="current"'; ?> >
                                <a href="index.php?id=<?=$key?>"><?=$nav?></a>
                            </li>
                        <?        
                            endforeach;
                        ?>
                        <li>
                        	<form>
                				<input type="text" class="input-find" placeholder="Поиск...">
                				<button type="submit" class="button-find">Найти</button>
            				</form>
                        </li>	
                    </ul>
                </nav>
            </div>          
        </header>
        <div class="flex-container">
        	<article class="main">
            	<div class="article-head">
            	    <h2>
                	    <a href="news/volvo-s90.html">Тест-драйв Volvo S90</a>
                	</h2>
                	<div class="article-properties">
                    	<p>Опубликовано: 21.02.2019</p>
                	</div>
            	</div>                        
            	<div class="article-body">
                	<img src="img/volvo-s901.jpg" class="img-preview">
                	<p>
                    Компания Volvo с того момента, как перешла к Geely, неустанно пытается поменять имидж, вернее, ту его часть, которая, по мнению китайских товарищей, не способствовала хорошему уровню продаж. А планы у концерна серьезные – почти в два раза повысить ежегодный уровень реализации. 
                	</p>          
            	</div>
        	</article>
        
        	<article class="main">
            	<div class="article-head">
            	    <h2>
                	    <a href="news/volvo-s90.html">Тест-драйв Volvo S90</a>
                	</h2>
                	<div class="article-properties">
                    	<p>Опубликовано: 21.02.2019</p>
                	</div>
            	</div>                        
            	<div class="article-body">
                	<img src="img/volvo-s901.jpg" class="img-preview">
                	<p>
                    Компания Volvo с того момента, как перешла к Geely, неустанно пытается поменять имидж, вернее, ту его часть, которая, по мнению китайских товарищей, не способствовала хорошему уровню продаж. А планы у концерна серьезные – почти в два раза повысить ежегодный уровень реализации. 
                	</p>          
            	</div>
        	</article>
        	<article class="main">
            	<div class="article-head">
            	    <h2>
                	    <a href="news/volvo-s90.html">Тест-драйв Volvo S90</a>
                	</h2>
                	<div class="article-properties">
                    	<p>Опубликовано: 21.02.2019</p>
                	</div>
            	</div>                        
            	<div class="article-body">
                	<img src="img/volvo-s901.jpg" class="img-preview">
                	<p>
                    Компания Volvo с того момента, как перешла к Geely, неустанно пытается поменять имидж, вернее, ту его часть, которая, по мнению китайских товарищей, не способствовала хорошему уровню продаж. А планы у концерна серьезные – почти в два раза повысить ежегодный уровень реализации. 
                	</p>          
            	</div>
        	</article>
        </div>
        <footer>
            <a href="about.html">AutoCheck, Copyright &copy; 2019</a>
        </footer>
    </body>
</html>
