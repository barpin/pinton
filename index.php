<?php
exit;
define('p', './');
require_once p.'assets/session_start.php';

require_once p.'assets/database.php';

if (!loggedin){
    
}


?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="./css2/styles.css">
    <link rel="icon" href="./img/juan.png">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet"> 
<script src="js/main.js"></script>
<script src="https://unpkg.com/react/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/prop-types/prop-types.min.js"></script>
<script src="https://unpkg.com/recharts/umd/Recharts.js"></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

<body>

    <style>
    .menu{
    /*background-image: url("./img/mantel.png");*/
    background-color: #111;
    height:50px;

    min-height: 50px;
    max-height: 100%;
    height: auto;



    background-repeat: no-repeat;
    background-size: cover;


    position: relative;
    }
    .nav-item{
    color: #BBB;
    font-family: 'Open Sans', sans-serif;
    border-right: #BBB 1px solid;
    margin: auto;

    }
    </style>
  </head>
    
  
    <div class="menu navbar ">  
        <a class="nav-item" href="#" style="float: left;"><img src="./img/bar logo.png" width="50" height="50"></a>
        <a class="nav-item" href="#" >Vista</a>
        <a class="nav-item" href="#" >General </a>
        <a class="nav-item" href="#" >Productos</a>
        <a class="nav-item" href="#" >Ventas</a>
        <a class="nav-item" href="#" >Stock</a>
        <a class="nav-item" href="#" >Clientes  </a> 
        <a class="nav-item" href="#" ><div class="w3-right-align">User</div></a>
        <a class="nav-item" href="#" style="float: right;"><img src="./img/u.png" width="50" height="50"></a>
    </div>  
    <div class="" id='content' onload="getpage('vista_general')">
aaaaaaaaaaaaaaaaaaaaaaaa
    </div>
    <div id="footer">

    </div>

  </body>
</html>