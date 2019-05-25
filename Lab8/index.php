<?php
    $mysqli = new mysqli("",  "", "",  "");
    
    $timestamp =  date("Y-m-d H:i:s", $_SERVER['REQUEST_TIME']);
    $SQL = "INSERT INTO visits (timestamp) VALUES ('".$timestamp."')";
    $mysqli->query($SQL);
    
    $period = $_GET['period'] ?? 'day';
    
    switch($period){
        case 'day':
            $SQL = "SELECT COUNT(*) as count, timestamp
                    FROM visits 
                    WHERE DATE(timestamp) = CURDATE()
                    GROUP BY UNIX_TIMESTAMP(timestamp) DIV 300";
            $timestr = 'D M d Y H:i:s';         
            $name = 'День';        
            $interval = 30;
            $intervalType = 'minute';
            $format = "hh:mm tt";
            break;
        case 'week':
            $SQL = "SELECT COUNT(*) as count, timestamp
                    FROM visits 
                    WHERE YEARWEEK(timestamp)=YEARWEEK(NOW())
                    GROUP BY UNIX_TIMESTAMP(timestamp) DIV 21600";
            $timestr = 'D M d Y H:i:s';         
            $name = 'Неделя';        
            $interval = 6;        
            $intervalType = 'hour';
            $format = "D MMMM hh:mm tt";
            break;
        case 'month':
            $SQL = "SELECT COUNT(*) as count, timestamp
                    FROM visits 
                    WHERE MONTH(timestamp)=MONTH(NOW())
                    GROUP BY DAY(timestamp)";
            $timestr = 'D M d Y ';        
            $name = 'Месяц';           
            $interval = 3;        
            $intervalType = 'day'; 
            $format = "DD MMM";
            break;
        case 'year':
            $SQL = "SELECT COUNT(*) as count, timestamp
                    FROM visits 
                    WHERE YEAR(timestamp)=YEAR(NOW())
                    GROUP BY MONTH(timestamp)";
            $timestr = 'M 01 Y ';         
            $name = 'Год';        
            $interval = 3;        
            $intervalType = 'month';
            $format = "DD MMM";
            break;    
    }
    
?>
<!DOCTYPE HTML>
<html>
<head>  
  <script type="text/javascript">
  window.onload = function () {
      var chart = new CanvasJS.Chart("chartContainer",
      {
          title:{
              text: "График посещаемости (<?=$name?>)"
          },
          axisX:{
            interval: <?=$interval?>,
            intervalType: "<?=$intervalType?>",
            valueFormatString: "<?=$format?>"
          },
          data: [{
            type: "spline",
            dataPoints: [   
            <?php
                $result = $mysqli->query($SQL);
                while ($row = $result->fetch_assoc()):
                    $currentDate = date($timestr, (strtotime($row['timestamp'])) );
            ?>  
                { x: new Date('<?=$currentDate?>'), y : <?=$row['count']?>, label: '<?=$currentDate?>' },
            <?php endwhile; ?>   
            ]
         }]
    });
    chart.render();
    
  }
  </script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
  <a href="url/index.php?period=day">День</a>
  <a href="url/index.php?period=week">Неделя</a>
  <a href="url/index.php?period=month">Месяц</a>
  <a href="url/index.php?period=year">Год</a>
  <div id="chartContainer" style="height: 300px; width: 100%;">
  </div>
</body>
</html>