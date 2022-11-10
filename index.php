<?php
define('p', './');
require_once p.'assets/session_start.php';

require_once p.'assets/database.php';

if (!isset($_SESSION["id"])){
  header('Location: ./controllers/login.php');
  exit;
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Pinton</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="icon" href="./img/juan.png">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet"> 
    

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>    <script src="https://unpkg.com/prop-types/prop-types.min.js"></script>
    <script src="https://unpkg.com/recharts/umd/Recharts.js"></script>
    <script src="js/apexcharts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.3/apexcharts.min.css" integrity="sha512-tJYqW5NWrT0JEkWYxrI4IK2jvT7PAiOwElIGTjALSyr8ZrilUQf+gjw2z6woWGSZqeXASyBXUr+WbtqiQgxUYg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    
    <script> var exports = {}; </script>


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
        <a class="nav-item" href="#" >Vista General</a>
        <a class="nav-item" href="#" >Productos</a>
        <!--<a class="nav-item" href="#" >Ventas</a>
        <a class="nav-item" href="#" >Stock</a>
        <a class="nav-item" href="#" >Clientes  </a> -->
        <a class="nav-item" href="#" ><div class="w3-right-align">User</div></a>
        <a class="nav-item" href="#" style="float: right;"><img src="./img/u.png" width="50" height="50"></a>
    </div>  
    <div class="" id='content' onload="getpage('vista_general')">
aaaaaaaaaaaaaaaaaaaaaaaa
    </div>
    <div id="footer">

    </div>
    <script src="js/main.js"></script>

  </body>
</html>