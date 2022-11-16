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
//[grupos de fechas, fecha minima, fecha maxima]
$dates=[
  "hoy"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE(now())", "DATE_ADD(DATE(now()), INTERVAL 1 DAY) "],
  "ayer"=>["ROUND(EXTRACT(HOUR FROM fecha_y_hora)*5, -1)/5", "DATE_ADD(DATE(now()), INTERVAL -1 DAY)", "DATE(NOW())"],
  "semana"=>["UNIX_TIMESTAMP(DATE(fecha_y_hora))", "DATE_ADD(DATE(now()), INTERVAL -7 DAY)", "NOW()"],
  "mes"=>["ROUND(EXTRACT(DAY FROM fecha_y_hora)*(10.0/3.0), -1)/(10.0/3.0)", "DATE_ADD(DATE(now()), INTERVAL -30 DAY)", "NOW()"],
  "todo"=>["TODO","2000-01-01 01:00:00","NOW()"],
  "rango"=>["TODO","",""]
];

//echo "SELECT {$dates[$rango][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$rango][1]} AND fecha_y_hora < {$dates[$rango][2]} GROUP BY fecha_grupo ";
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
    case "semana":
      $arrayfechas[$x]["fecha_grupo"]=date('D', $arrayfechas[$x]["fecha_grupo"]);
      break; 
    case "mes":
      $interval=30-intval($arrayfechas[$x]["fecha_grupo"]);
      $cdate = new DateTime();
      $cdate->setTime(0,0,0,0)->sub(new DateInterval("P${interval}D"));
      $arrayfechas[$x]["fecha_grupo"]=date('D', $cdate);
      break; 
  }
}

error_log("SELECT {$dates[$range][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$range][1]} AND fecha_y_hora < {$dates[$range][2]} GROUP BY fecha_grupo ");
echo(json_encode($arrayfechas));
return $arrayfechas;

