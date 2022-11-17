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




  </body>
</html>