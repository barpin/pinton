<?php
define('p', '../');
require 'assets/session_start.php';
require_once 'assets/database.php';


if (isset($_SESSION["id"])){
	$_SESSION["msg"]="Ya estas logeado!";
	$_SESSION["icon"]="info";

		header('Location: /');

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
					header('Location: /');

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
require 'assets/session_start.php';



?>


<div class="container">
    <div class="cont-login bg-red-100 mt-56 rounded-lg p-1 shadow-2xl">
      <div class="login-window rounded-lg bg-white p-2">
        <div class="espaciado p-8">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Inicia sesion</h2>
        <div class="form-login">
          <form action="" method="POST">
            <div class="mt-3">
              <label for="email" class="block mb-1 font-bold text-gray-500">Direccion de Correo</label>
              <input name="email" type="email" maxlength="320" placeholder="presi@corrupto.ar" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
            </div>
            <div class="mt-3">
              <label for="pass" class="block mb-1 font-bold text-gray-500">Contraseña</label>
              <input name="pass" type="password" maxlength="64" placeholder="•••••••••••" required class="w-full border-2 border-gray-200 p-3 rounded outline-none focus:border-red-100">
            </div>
            <div>
              <label class="espaciado block mb-1 font-bold text-gray-500" onmousedown='return false;' onselectstart='return false;'>⠀⠀⠀⠀</label>
              <input name="login" value="login" type="submit" class="block w-full bg-yellow-400 hover:bg-yellow-300 p-4 rounded text-yellow-900 hover:text-yellow-800 transition duration-300">Loguearse</input>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  

