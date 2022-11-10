<?php

require_once('../assets/api.php');

$recentarr=entries(<<<EOL
    SELECT productos.name, compras.cantidad, compras.precio, fecha_y_hora 
    FROM compras INNER JOIN productos ON productos.id = compras.productoID 
    ORDER BY fecha_y_hora 
    DESC LIMIT 0,10;
    EOL);



echo(json_encode($recentarr));
return $recentarr;
