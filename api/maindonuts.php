<?php
//https://www.chartjs.org/docs/latest/
//https://gionkunz.github.io/chartist-js/
//https://dygraphs.com/gallery/
//https://www.sigmajs.org/
require_once('../assets/api.php');

$range = getpost("rango");
$divider = getpost("divisor");

authenticate();

//[fecha minima, fecha maxima]
$dates=[
  "hoy"=>["DATE(now())", "DATE_ADD(DATE(now()), INTERVAL 1 DAY) "],
  "ayer"=>["DATE_ADD(DATE(now()), INTERVAL -1 DAY)", "DATE(NOW())"],
  "semana"=>["DATE_ADD(DATE(now()), INTERVAL -7 DAY)", "NOW()"],
  "mes"=>["DATE_ADD(DATE(now()), INTERVAL -30 DAY)", "NOW()"],
  "todo"=>["FROM_UNIXTIME(0)","NOW()"],
  "rango"=>["TODO",""]
];

//echo "SELECT {$dates[$rango][0]} AS fecha_grupo , precio*cantidad AS preciofinal FROM compras WHERE fecha_y_hora > {$dates[$rango][1]} AND fecha_y_hora < {$dates[$rango][2]} GROUP BY fecha_grupo ";

//vantas x categoria
$arraydonuts=[entries(<<<EOL
    (
      SELECT max(categorias_productos.ID) as id, categorias_productos.name, count(categorias_productos.name) as count FROM compras 
      INNER JOIN productos ON compras.productoID=productos.ID 
      INNER JOIN categorias_productos ON productos.categoryID=categorias_productos.ID
      WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]} 
      GROUP BY categorias_productos.name
      ORDER BY count DESC
      LIMIT 0,5
    ) UNION (
      SELECT 999 as id, "Otras" as name, count(categorias_productos.name) as count FROM compras 
      INNER JOIN productos ON compras.productoID=productos.ID 
      INNER JOIN categorias_productos ON productos.categoryID=categorias_productos.ID
      WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]} 
      AND NOT categorias_productos.ID IN 
        (
          SELECT id FROM(
            SELECT max(categorias_productos.ID) as id, categorias_productos.name, count(categorias_productos.name) as count FROM compras 
            INNER JOIN productos ON compras.productoID=productos.ID 
            INNER JOIN categorias_productos ON productos.categoryID=categorias_productos.ID
            WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]} 
            GROUP BY categorias_productos.name
            ORDER BY count DESC
            LIMIT 0,5
          ) AS lim 
        )
    )
    EOL)];

//ventas x producto
$arraydonuts[]=entries(<<<EOL
  (
    SELECT productoID, max(productos.name) as name, count(productos.name) as count FROM compras 
    INNER JOIN productos ON productos.ID = productoID  
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
    GROUP BY productoID
    ORDER BY count DESC
    LIMIT 0,5
  ) UNION (
    SELECT 999 AS productoID, "Otras" as name, count(productos.name) as count FROM compras 
    INNER JOIN productos ON productos.ID = productoID  
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
    AND NOT productoID IN 
      (
        SELECT productoID FROM(
          SELECT productoID, max(productos.name) as name, count(productos.name) as count FROM compras 
          INNER JOIN productos ON productos.ID = productoID  
          WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
          GROUP BY productoID
          ORDER BY count DESC
          LIMIT 0,5
        ) AS lim 
      )
  )
  EOL);

//productos x cat mas popular
if (isset($arraydonuts[0][0])){
$arraydonuts[]=entries(<<<EOL
  (
    SELECT productoID, max(productos.name) as name, count(productos.name) as count FROM compras 
    INNER JOIN productos ON productos.ID = productoID  
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
    AND categoryID={$arraydonuts[0][0]['id']}
    GROUP BY productoID
    ORDER BY count DESC
    LIMIT 0,5
  ) UNION (
    SELECT 999 as productoID, "Otros" as name, count(productos.name) as count FROM compras 
    INNER JOIN productos ON productos.ID = productoID  
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
    AND categoryID={$arraydonuts[0][0]['id']}
    AND NOT productoID IN 
      (
        SELECT productoID FROM(
        SELECT productoID, max(productos.name) as name, count(productos.name) as count FROM compras 
        INNER JOIN productos ON productos.ID = productoID  
        WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
        AND categoryID={$arraydonuts[0][0]['id']}
        GROUP BY productoID
        ORDER BY count DESC
        LIMIT 0,5
        ) AS lim 
      )
  )
  EOL);
} else {
  $arraydonuts[]=[];
}

//bebidas
$arraydonuts[]=entries(<<<EOL
  (
    SELECT productoID, max(productos.name) as name, count(productos.name) as count FROM compras 
    INNER JOIN productos ON productos.ID = productoID  
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
    AND categoryID>3
    GROUP BY productoID
    ORDER BY count DESC
    LIMIT 0,5
  ) UNION (
    SELECT 999 as productoID, "Otros" as name, count(productos.name) as count FROM compras 
    INNER JOIN productos ON productos.ID = productoID  
    WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
    AND categoryID>3
    AND NOT productoID IN 
      (
        SELECT productoID FROM(
          SELECT productoID, max(productos.name) as name, count(productos.name) as count FROM compras 
          INNER JOIN productos ON productos.ID = productoID  
          WHERE fecha_y_hora > {$dates[$range][0]} AND fecha_y_hora < {$dates[$range][1]}  
          AND categoryID>3
          GROUP BY productoID
          ORDER BY count DESC
          LIMIT 0,5
        ) AS lim 
      ) 
  )
  EOL);

echo(json_encode($arraydonuts));

return $arraydonuts;

