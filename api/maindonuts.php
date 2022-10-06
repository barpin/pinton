<?php

require_once('../assets/api.php');

$range = getpost("rango");
$divider = getpost("divisor");

authenticate();

$dates=[
  "hoy"=>["DATE(fecha_y_hora)", "DATE_ADD(DATE(now()), INTERVAL 1 DAY) "],
  "ayer"=>["DATE_ADD(fecha_y_hora, INTERVAL -1 DAY)", "DATE(NOW())"],
  "semana"=>["DATE_ADD(fecha_y_hora, INTERVAL -7 DAY)", "NOW()"],
  "mes"=>["DATE_ADD(fecha_y_hora, INTERVAL -30 DAY)", "NOW()"],
  "todo"=>["2000-01-01 01:00:00","NOW()"],
  "rango"=>["TODO",""]
];

//echo "SELECT {$dates[$rango][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$rango][1]} AND fecha_y_hora < {$dates[$rango][2]} GROUP BY fecha_grupo ";

$arraydonuts=[entries(<<<EOL
    SELECT max(categorias_productos.ID) as id, categorias_productos.name, count(categorias_productos.name) as count FROM compras 
    INNER JOIN productos ON compras.productoID=productos.ID 
    INNER JOIN categorias_productos ON productos.categoryID=categorias_productos.ID
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]} 
    GROUP BY categorias_productos.name
    ORDER BY count DESC
    EOL)];


for ($i=0;$i< min(3, count($arraydonuts[0])) ;$i++){
    array_push($arraydonuts, entries(<<<EOL
        SELECT productoID, max(productos.name), count(productos.name) as count FROM compras 
        INNER JOIN productos ON productos.ID = productoID  
        WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$rango][1]}  
        AND categoryID={$arraydonuts[0][$i]['id']}
        GROUP BY productoID
        ORDER BY count DESC
        EOL) );

}

echo(json_encode($arraydonuts));

return $arraydonuts;

