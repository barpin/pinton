<?php
require_once('../assets/api.php');

$range = getpost("rango");
$prodd = getpost("producto");

authenticate();





//[grupos de fechas, fecha minima, fecha maxima]
$dates=[
  "hoy"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE(now())", "DATE_ADD(DATE(now()), INTERVAL 1 DAY) "],
  "ayer"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE_ADD(DATE(now()), INTERVAL -1 DAY)", "DATE(NOW())"],
  "semana"=>["UNIX_TIMESTAMP(DATE(fecha_y_hora))", "DATE_ADD(DATE(now()), INTERVAL -7 DAY)", "NOW()"],
  "mes"=>["ROUND(EXTRACT(DAY FROM fecha_y_hora)*(10.0/3.0), -1)/(10.0/3.0)", "DATE_ADD(DATE(now()), INTERVAL -30 DAY)", "NOW()"],
  "todo"=>["ROUND((UNIX_TIMESTAMP(fecha_y_hora)/60/60/24 - (SELECT UNIQUE UNIX_TIMESTAMP(MIN(fecha_y_hora))/60/60/24  FROM compras))/(SELECT UNIQUE ROUND(UNIX_TIMESTAMP(NOW())/60/60/24-(SELECT UNIQUE UNIX_TIMESTAMP(MIN(fecha_y_hora))/60/60/24  FROM compras) ,0)  FROM compras), 1)*(SELECT UNIQUE ROUND(UNIX_TIMESTAMP(NOW())/60/60/24-(SELECT UNIQUE UNIX_TIMESTAMP(MIN(fecha_y_hora))/60/60/24  FROM compras) ,0)  FROM compras)",
    "FROM_UNIXTIME(0)","NOW()"],
  "rango"=>["TODO","",""]
];

$arrayfechas=entries("SELECT {$dates[$range][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$range][1]} AND fecha_y_hora < {$dates[$range][2]} AND productoID=${prodd} GROUP BY fecha_grupo ");

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







//[fecha minima, fecha maxima, fecha minima anterior]
$dates=[
  "hoy"=>["DATE(now())",                         "DATE_ADD(DATE(now()), INTERVAL 1 DAY) ", "DATE_ADD(DATE(NOW()), INTERVAL -1 DAY)"],
  "ayer"=>["DATE_ADD(DATE(now()), INTERVAL -1 DAY)",   "DATE(NOW())",                            "DATE_ADD(DATE(NOW()), INTERVAL -2 DAY)"],
  "semana"=>["DATE_ADD(DATE(now()), INTERVAL -7 DAY)", "NOW()",                                  "DATE_ADD(DATE(NOW()), INTERVAL -14 DAY)"],
  "mes"=>["DATE_ADD(DATE(now()), INTERVAL -30 DAY)",   "NOW()",                                  "DATE_ADD(DATE(NOW()), INTERVAL -60 DAY)"],
  "todo"=>["FROM_UNIXTIME(0)",                       "NOW()",                                  "FROM_UNIXTIME(0)"],
  "rango"=>["TODO",""]
];


//viejo, nuevo
function percentdiff($n1, $n2){
  return intval($n2) && intval($n1) ? $n2/$n1*100-100 : 999;   //($n1-$n2)/(($n1+$n2)/2)
;}

$totales=[entries(<<<EOL
    SELECT
    SUM(precio) as total, COUNT(precio) as cantidad, 50 as ptables  
    FROM compras 
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]} AND productoid=${prodd}
    EOL)[0],entries(<<<EOL
    SELECT
    SUM(precio) as total, COUNT(precio) as cantidad, 50  as ptables
    FROM compras 
    WHERE fecha_y_hora > {$dates[$range][2]} AND fecha_y_hora < {$dates[$range][0]} AND productoid=${prodd}
    EOL)[0] ];
$totalesyporentajes=[
  "total"=>[$totales[0]['total'], percentdiff($totales[1]['total'], $totales[0]['total'])],
  "cantidad"=>[$totales[0]['cantidad'], percentdiff($totales[1]['cantidad'], $totales[0]['cantidad'])],
  "ptables"=>[$totales[0]['ptables'], intval($totales[1]['ptables'])- intval($totales[0]['ptables'])],
  "efectivo"=>1,
  "tarjeta"=>1,
  "mercadopago"=>1,
];

$parte3=entries("SELECT ingredientes.*, amount FROM ingredientes INNER JOIN receta ON ingredientes.id=receta.ingredientID WHERE productID=${prodd}");
$parte4=entries("SELECT name FROM productos WHERE id = $prodd")[0]["name"];



echo(json_encode([$arrayfechas, $totalesyporentajes, $parte3, $parte4]));
return $arrayfechas;

