<?php
define('ruta',$_SERVER['DOCUMENT_ROOT']);
require_once(ruta."/new_ae/config/conexion.php");
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
  $sql = "call sp_validar_usuario('$nombre','$contrasena') ";
  $result=execQuery($sql);
  echo $result;
  foreach( $result as $row){
   if($row['US_R_ROL'] == '1'){
      $session->login($row['US_NOMBRE']);
      $session->usuarioLogeado();
      $session->tipoUsuario($row['US_R_ROL']);
      $session->periodo($row['PE_ACTIVO']);
      $session->area('ISC');
    }else if($row['US_R_ROL'] == '2'){
      $session->login($row['DO_NOMBRE_1']);
      $session->usuarioLogeado();
      $session->tipoUsuario($row['US_R_ROL']);
      $session->periodo($row['PE_ACTIVO']);
      $session->area('DOC');
    }
  }
        //Registrar el periodo
        /*
        Este código se tiene que reemplazar con la llamada al procedimiento almacenado. 
        */
  redirect("index.php",false);
}else{
  $session->msg("w", "Nombre de usuario y/o contraseña incorrecto.");
  redirect("login.php",false);
}
//    $sql = "CALL `sp_login_usuario`('{$nombre}','{$contrasena}',@valido,@tipo)";
//    $result=execQuery($sql);
  //  var_dump($result);
//    foreach ($result as $key) {
//      if ($key['valido']!=NULL) {


  //Usuario
 
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
