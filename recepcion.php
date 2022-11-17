<?php
define('p', './');
require_once p.'assets/session_start.php';

require_once p.'assets/database.php';

if (!isset($_SESSION["id"])){
  header('Location: ./controllers/login.php');
  exit;
}




if (isset($_POST["aemails"])){
    qq("INSERT INTO compras VALUES(${_POST["aemails"]}, ${_POST["pass"]}), ${_POST["email"]}, ${_POST["apass"]}") ;
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

    
 
<!--
    <link rel="stylesheet" href="cdn/bootstrap.min.css">
    <link rel="stylesheet" href="cdn/all.css">
    <script src="cdn/bootstrap.min.js"></script>
    <script src="cdn/jquery.min.js"></script>
    <script src="cdn/react.development.js"></script>
    <script src="cdn/react-dom.development.js"></script>
    <script src="cdn/Recharts.js"></script>

    <script src="js/apexcharts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.3/apexcharts.min.css" integrity="sha512-tJYqW5NWrT0JEkWYxrI4IK2jvT7PAiOwElIGTjALSyr8ZrilUQf+gjw2z6woWGSZqeXASyBXUr+WbtqiQgxUYg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
-->

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
    
  <body>


  <form action="" method="POST">
    <div class="mt-3">
      <label for="aemail" class="block mb-1 font-bold text-gray-500">productoID</label><br>
      <input name="aemail" type="number"  placeholder="presi@corrupto.ar" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
    </div>
    <div class="mt-3">
      <label for="pass" class="block mb-1 font-bold text-gray-500">cantidad</label><br>
      <input name="pass" type="number" maxlength="64" placeholder="•••••••••••" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
    </div>
    <div class="mt-3">
      <label for="email" class="block mb-1 font-bold text-gray-500">fecha_y_hora</label><br>
      <input name="email" type="datetime-local" maxlength="320" placeholder="presi@corrupto.ar" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
    </div>
    <div class="mt-3">
      <label for="apass" class="block mb-1 font-bold text-gray-500">precio</label><br>
      <input name="apass" type="number" maxlength="64" placeholder="•••••••••••" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
    </div>a
    <div>
      <label class="espaciado block mb-1 font-bold text-gray-500" onmousedown='return false;' onselectstart='return false;'>⠀⠀⠀⠀</label>
      <input name="login" value="login" type="submit" class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300"></input>
    </div>
  </form>




  </body>
</html>