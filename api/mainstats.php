<?php

require_once('../assets/api.php');

$range = getpost("rango");
authenticate();

//[fecha minima, fecha maxima, fecha minima anterior]
$dates=[
  "hoy"=>["DATE(now())",                         "DATE_ADD(DATE(now()), INTERVAL 1 DAY) ", "DATE_ADD(DATE(NOW()), INTERVAL -1 DAY)"],
  "ayer"=>["DATE_ADD(DATE(now()), INTERVAL -1 DAY)",   "DATE(NOW())",                            "DATE_ADD(DATE(NOW()), INTERVAL -2 DAY)"],
  "semana"=>["DATE_ADD(DATE(now()), INTERVAL -7 DAY)", "NOW()",                                  "DATE_ADD(DATE(NOW()), INTERVAL -14 DAY)"],
  "mes"=>["DATE_ADD(DATE(now()), INTERVAL -30 DAY)",   "NOW()",                                  "DATE_ADD(DATE(NOW()), INTERVAL -60 DAY)"],
  "todo"=>["FROM_UNIXTIME(0)",                       "NOW()",                                  "FROM_UNIXTIME(0)"],
  "rango"=>["TODO",""]
];

//echo "SELECT {$dates[$rango][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$rango][1]} AND fecha_y_hora < {$dates[$rango][2]} GROUP BY fecha_grupo ";

//viejo, nuevo
function percentdiff($n1, $n2){
  return intval($n2) && intval($n1) ? $n2/$n1*100-100 : 999;   //($n1-$n2)/(($n1+$n2)/2)
;}

$totales=[entries(<<<EOL
    SELECT
    SUM(precio) as total, COUNT(precio) as cantidad, 50 as ptables  
    FROM compras 
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]} 
    EOL)[0],entries(<<<EOL
    SELECT
    SUM(precio) as total, COUNT(precio) as cantidad, 50  as ptables
    FROM compras 
    WHERE fecha_y_hora > {$dates[$range][2]} AND fecha_y_hora < {$dates[$range][0]} 
    EOL)[0] ];
$totalesyporentajes=[
  "total"=>[$totales[0]['total'], percentdiff($totales[1]['total'], $totales[0]['total'])],
  "cantidad"=>[$totales[0]['cantidad'], percentdiff($totales[1]['cantidad'], $totales[0]['cantidad'])],
  "ptables"=>[$totales[0]['ptables'], intval($totales[1]['ptables'])- intval($totales[0]['ptables'])],
  "efectivo"=>1,
  "tarjeta"=>1,
  "mercadopago"=>1,
];

echo(json_encode($totalesyporentajes));
return $totalesyporentajes;

