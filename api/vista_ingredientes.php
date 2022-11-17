<?php
require_once('../assets/api.php');

$recentarr=entries(<<<EOL
    SELECT 
    ingredientes.id, 
    MAX(ingredientes.name)  AS name, 
    MAX(ingredientes.unit) AS unit, 
    MAX(ingredientes.stock) AS stock, 
    COUNT(ingredientes.id) as totalunidades
    FROM ingredientes 
    LEFT JOIN receta ON ingredientes.id = receta.ingredientID 
    GROUP BY ingredientes.id
    EOL);


echo(json_encode($recentarr));
return $recentarr;
