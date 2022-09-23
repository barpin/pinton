<?php
define('p', '../');
require p.'assets/session_start.php';
require_once p.'assets/database.php';


if (isset($_SESSION["id"]) ){
	$_SESSION["msg"]="Ya estas logeado!";
	$_SESSION["icon"]="info";

		header("Location: ".p);

	exit;
}



if (isset($_POST['login'])){
	if(!empty($_POST['email']) && !empty($_POST['pass'])){
        $parr = [
            "email"=>sanitize($_POST['email']),
            "pass"=>sanitize($_POST['pass']),
        ];
		$sqlquery= "select * from users where users.email = '${parr['email']}' ";
		$result=qq($sqlquery);
		
		if (mysqli_num_rows($result) == 0) { 
			$_SESSION["msg"]="El nombre de usuario o contraseña es incorrecto";
			$_SESSION["icon"]="error";
		} else { 
			if  (md5($_POST['pass']) == ($assoc= mysqli_fetch_assoc($result))["password"]){
			//   echo("logged in");
			   session_unset();
			   session_destroy();
			   session_start();
			   $_SESSION["user"]= $assoc['nick'] ?? $assoc['name'];
			   $_SESSION["msg"]="Te logueaste correctamente!";
			   $_SESSION["icon"]="success";
			   $_SESSION["id"]=$assoc["id"];
			   $_SESSION["perms"]=$assoc["perms"];
				if (isset($url)){
					header('Location: '.$url);
				} else {
					header('Location: '.p);

				}

				exit;
		   } else {
				$_SESSION["msg"]="El nombre de usuario o contraseña es incorrecto!"; // El usuario y/o contraseña esta mal
				$_SESSION["icon"]="error";
			}
		}  
			
		
		
	} else {
		$_SESSION["msg"]="Rellena todos los campos";
		$_SESSION["icon"]="error";
	}
}
require p.'assets/session_start.php';



?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Pinton</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/juan.png">

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
        <a class="nav-item" href="#" style="float: left;"><img src="../img/bar logo.png" width="50" height="50"></a>
        <a class="nav-item" href="#" ><div class="w3-right-align">User</div></a>
        <a class="nav-item" href="#" style="float: right;"><img src="../img/u.png" width="50" height="50"></a>
    </div>  
    <div class="container">
    <div class="cont-login bg-red-100 mt-56 rounded-lg p-1 shadow-2xl">
      <div class="login-window rounded-lg bg-white p-2">
        <div class="espaciado p-8">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Inicia sesion</h2>
        <div class="form-login">
          <form action="" method="POST">
            <div class="mt-3">
              <label for="email" class="block mb-1 font-bold text-gray-500">Direccion de Correo</label><br>
              <input name="email" type="email" maxlength="320" placeholder="presi@corrupto.ar" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
            </div>
            <div class="mt-3">
              <label for="pass" class="block mb-1 font-bold text-gray-500">Contraseña</label><br>
              <input name="pass" type="password" maxlength="64" placeholder="•••••••••••" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
            </div>
            <div>
              <label class="espaciado block mb-1 font-bold text-gray-500" onmousedown='return false;' onselectstart='return false;'>⠀⠀⠀⠀</label>
              <input name="login" value="login" type="submit" class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300"></input>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  

  </body>
</html>