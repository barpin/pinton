<?php
//recibe en get o post a "rango". 
//devuelve una lista de puntos de valor y eso
// UPDATE compras set fecha_y_hora=DATE_ADD(now(), INTERVAL -(ROUND(RAND()*12)) HOUR)

require_once('../assets/api.php');

$range = getpost("rango");
authenticate();

$dates=[
  "hoy"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE(fecha_y_hora)", "DATE_ADD(DATE(now()), INTERVAL 1 DAY) "],
  "ayer"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE_ADD(fecha_y_hora, INTERVAL -1 DAY)", "DATE(NOW())"],
  "semana"=>["EXTRACT(DAY FROM fecha_y_hora)", "DATE_ADD(fecha_y_hora, INTERVAL -7 DAY)", "NOW()"],
  "mes"=>["ROUND(EXTRACT(DAY FROM fecha_y_hora)*(10.0/3.0), -1)/(10.0/3.0)", "DATE_ADD(fecha_y_hora, INTERVAL -30 DAY)", "NOW()"],
  "todo"=>["TODO","2000-01-01 01:00:00","NOW()"],
  "rango"=>["TODO","",""]
];

//echo "SELECT {$dates[$rango][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$rango][1]} AND fecha_y_hora < {$dates[$rango][2]} GROUP BY fecha_grupo ";
$arrayfechas=entries("SELECT {$dates[$range][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$range][1]} AND fecha_y_hora < {$dates[$range][2]} GROUP BY fecha_grupo ");
echo(json_encode($arrayfechas));
return $arrayfechas;

