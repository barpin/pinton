<?php
//recibe en get o post a "category". Esto es una, o una lista, de numeros o categorias. "," representa un or, "." un and, "!" un not, y "(", y ")". 
//ejemplo ..../api/v1/feed?Voto.noche   devuelve la lista de todos los votos de la secretaria de turno noche
//ejemplo ..../api/v1/feed?category=2,!(3.Comision.genero).!7  devuelve la lista de todos los posts de categoria 1 (2^1=2), y los que o no son de ni la categoria 3, ni de alguna comisio, ni de de la secretaria de genero  o no son de las categorias 0, 1, o 2 (2^7= 2^0 | 2^1 | 2^2)


require_once('../assets/api.php');

$rango = getpost("rango");
authenticate();

$dates=[
  "hoy"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE(fecha_y_hora)", "DATE_ADD(fecha_y_hora, INTERVAL 1 DAY) "],
  "ayer"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE_ADD(fecha_y_hora, INTERVAL -1 DAY)", "DATE(fecha_y_hora)"],
  "semana"=>["EXTRACT(DAY FROM fecha_y_hora)", "DATE_ADD(fecha_y_hora, INTERVAL -7 DAY)", "DATE(fecha_y_hora)"],
  "mes"=>["ROUND(EXTRACT(DAY FROM fecha_y_hora)*(10.0/3.0)), -1)/(10.0/3.0)", "DATE_ADD(fecha_y_hora, INTERVAL -30 DAY)", "DATE(fecha_y_hora)"],
  "todo"=>["TODO","2000-01-01 01:00:00","DATE(fecha_y_hora)"],
  "rango"=>["TODO","",""]
];


$arrayfechas=entries("SELECT ${dates[$rango[0]]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > ${dates[$rango[1]]} AND fecha_y_hora < ${dates[$rango[2]]} GROUP BY fecha_grupo ");
echo(json_encode($arrayfechas));


exit;