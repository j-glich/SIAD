<?php
define('ruta',$_SERVER['DOCUMENT_ROOT']);
require_once(ruta."/ae/config/conexion.php");
//include_once 'includes/load.php';
include_once 'includes/session.php';
include_once 'includes/functions.php';
// include_once 'php/db/database.php';
global $db;

if(!session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE){
    session_start();
}

if (isset($_POST['nombreUsuario'])&&isset($_POST['contrasenaUsuario'])) {
  $nombre=$_POST['nombreUsuario'];
  $contrasena=$_POST['contrasenaUsuario'];
}else{
  return;
}
//try{
//    $sql = "CALL `sp_login_usuario`('{$nombre}','{$contrasena}',@valido,@tipo)";
//    $result=execQuery($sql);
  //  var_dump($result);
//    foreach ($result as $key) {
//      if ($key['valido']!=NULL) {
        $session->login('Javier Pérez');
        $session->usuarioLogeado();
        $session->tipoUsuario($key['1']);

        //Registrar el periodo
        /*
        Este código se tiene que reemplazar con la llamada al procedimiento almacenado. 
        */
        $session->periodo('20213');
        redirect("index.php",false);
   //   }else{
   //     $session->msg("w", "Nombre de usuario y/o contraseña incorrecto.");
    //    redirect("login.php",false);
    //  }
    //}
//}
//catch(Exception $e){
//    $session->msg("d", "Algo salio mal intentalo de nuevo");
//}



// var_dump($_SESSION);

 ?>
