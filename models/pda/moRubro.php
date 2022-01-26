<?php 
//Establecer Conexion con validacion de rutas utilizando la variable global $_SERVER['DOCUMENT_ROOT'] y con un path relativo
try {
  require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/config/newcnx.php");
} catch (\Exception $e) {
  require_once("../config/newcnx.php");
}
//Switch sirve para poder ejecutar diferentes procesos en un solo menu.
  switch ($opcion) {
    //Primer caso de consulta 
    case '1':
      $ip_adress= $_SERVER['REMOTE_ADDR'];
      if($ip_adress=='::1'){
        $ip_adress="127.0.0.1";
      }
      //Actualizar el valor del usuario tomando el valor de la sesión
        $user=200;
        $activo = "";
        $sql = "call sp_up_rubro('$rb_clave','$titulo','$desc','$activo','$ip_adress','$user');";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        
        $sql2 = 'call sp_li_rubros();';
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->execute();
        $data=$stmt2->fetchAll(PDO::FETCH_ASSOC);
    break;
}
$conexion = null;
print json_encode($data, JSON_UNESCAPED_UNICODE);
?>