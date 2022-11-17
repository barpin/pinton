<?php
//recibe en get o post a "rango". 
//devuelve una lista de puntos de valor y eso
// UPDATE compras set fecha_y_hora=DATE_ADD(now(), INTERVAL -(ROUND(RAND()*12)) HOUR)
//UPDATE compras set fecha_y_hora=DATE_ADD(now(), INTERVAL -((RAND()*8766)) HOUR);
//insert into compras (productoID, cantidad,	fecha_y_hora,	precio	) SELECT productoID	,cantidad,	fecha_y_hora,	precio FROM compras	
//UPDATE compras set precio=RAND()*3000

//SELECT ingredientes.id as ingid, max(ingredientes.name), SUM(amount*cantidad) as stock FROM ingredientes INNER JOIN receta ON receta.ingredientID = ingredientes.id INNER JOIN compras ON compras.productoID = receta.productID GROUP BY ingredientes.id;

require_once('../assets/api.php');

$range = getpost("rango");
authenticate();

/* mejor manera de todos
SET @unixstartday := (SELECT UNIQUE UNIX_TIMESTAMP(MIN(fecha_y_hora))/60/60/24  FROM compras);
SET @dias_desde_comienzo := (SELECT UNIQUE UNIX_TIMESTAMP(NOW())/60/60/24-@unixstartday  FROM compras);
SELECT UNIQUE ROUND((UNIX_TIMESTAMP(fecha_y_hora)/60/60/24 - @unixstartday)/@dias_desde_comienzo, 1)*@dias_desde_comienzo FROM compras


*/


//[grupos de fechas, fecha minima, fecha maxima]
$dates=[
  "hoy"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE(now())", "DATE_ADD(DATE(now()), INTERVAL 1 DAY) "],
  "ayer"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE_ADD(DATE(now()), INTERVAL -1 DAY)", "DATE(NOW())"],
  "semana"=>["UNIX_TIMESTAMP(DATE(fecha_y_hora))", "DATE_ADD(DATE(now()), INTERVAL -7 DAY)", "NOW()"],
  "mes"=>["ROUND(EXTRACT(DAY FROM fecha_y_hora)*(10.0/3.0), -1)/(10.0/3.0)", "DATE_ADD(DATE(now()), INTERVAL -30 DAY)", "NOW()"],
  "todo"=>["ROUND((UNIX_TIMESTAMP(fecha_y_hora)/60/60/24 - (SELECT UNIX_TIMESTAMP(MIN(fecha_y_hora))/60/60/24  FROM compras))/(SELECT ROUND(UNIX_TIMESTAMP(NOW())/60/60/24-(SELECT UNIX_TIMESTAMP(MIN(fecha_y_hora))/60/60/24  FROM compras) ,0) as aaa  FROM compras group by aaa), 1)*(SELECT ROUND(UNIX_TIMESTAMP(NOW())/60/60/24-(SELECT UNIX_TIMESTAMP(MIN(fecha_y_hora))/60/60/24  FROM compras) ,0) as aaa  FROM compras group by aaa)",
    "FROM_UNIXTIME(0)","NOW()"],
  "rango"=>["TODO","",""]
];

//echo "SELECT {$dates[$rango][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$rango][1]} AND fecha_y_hora < {$dates[$rango][2]} GROUP BY fecha_grupo ";
error_log("SELECT {$dates[$range][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$range][1]} AND fecha_y_hora < {$dates[$range][2]} GROUP BY fecha_grupo ");
$arrayfechas=entries("SELECT {$dates[$range][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$range][1]} AND fecha_y_hora < {$dates[$range][2]} GROUP BY fecha_grupo ");

for ($x=0;$x<count($arrayfechas);$x++){
  switch ($range){
    case "hoy":
    case "ayer":
      if ($arrayfechas[$x]["fecha_grupo"]==$x*2){
        $arrayfechas[$x]["fecha_grupo"]=intval($arrayfechas[$x]["fecha_grupo"]).":00";
      } else {
        array_splice($arrayfechas, $x, 0, [["fecha_grupo"=>intval($x*2).":00", "preciofinal"=>0]]);
        //$x++;
      }
      break;
    case "semana": ///TODO add better interpolation here, month, and in products
      $arrayfechas[$x]["fecha_grupo"]=date('D', $arrayfechas[$x]["fecha_grupo"]);
      break; 
    case "mes":
      $interval=30-intval($arrayfechas[$x]["fecha_grupo"]);
      $cdate = new DateTime();
      $cdate->setTime(0,0,0,0)->sub(new DateInterval("P${interval}D"));
      $arrayfechas[$x]["fecha_grupo"]=$cdate->format('d/m');
      break; 
  }
}

error_log("SELECT {$dates[$range][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$range][1]} AND fecha_y_hora < {$dates[$range][2]} GROUP BY fecha_grupo ");
echo(json_encode($arrayfechas));
return $arrayfechas;

