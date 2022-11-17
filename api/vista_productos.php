<?php
require_once('../assets/api.php');

$recentarr=entries(<<<EOL
    SELECT 
    productos.id, MAX(price) AS price, 
    MAX(categorias_productos.name)  AS cat, 
    MAX(productos.name) AS name, 
    SUM(compras.cantidad) as totalunidades, 
    SUM(compras.cantidad*compras.precio)  as totalprecio
    FROM productos 
    LEFT JOIN compras ON productos.id = compras.productoID 
    INNER JOIN categorias_productos ON categoryID=categorias_productos.id 
    GROUP BY productos.id
    EOL);

$secondarr=[];

foreach ($recentarr as $prod){
    $temparr=entries(
        <<<EOL
        SELECT ROUND(EXTRACT(DAY FROM fecha_y_hora)*(10.0/3.0), -1)/(10.0/3.0) AS fecha_grupo , cantidad AS totalunidades 
        FROM compras 
        WHERE fecha_y_hora > DATE_ADD(DATE(now()), INTERVAL -30 DAY) AND fecha_y_hora < NOW() AND productoid=${prod["id"]}
        GROUP BY fecha_grupo
        EOL);
        $secondarr[]= array_map(function($earr){
            $interval=30-intval($earr["fecha_grupo"]);
            $cdate = new DateTime();
            $cdate->setTime(0,0,0,0)->sub(new DateInterval("P${interval}D"));
            $earr["fecha_grupo"]=$cdate->format('d/m');
            return $earr;
            
        }, $temparr);

}

echo(json_encode([$recentarr, $secondarr]));
return $recentarr;
