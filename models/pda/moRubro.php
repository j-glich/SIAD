<?php 
//Establecer Conexion con validacion de rutas utilizando la variable global $_SERVER['DOCUMENT_ROOT'] y con un path relativo
try {
  require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/config/newcnx.php");
} catch (\Exception $e) {
  require_once("../config/newcnx.php");
}
//Switch sirve para poder ejecutar diferentes procesos en un solo menu.
  switch ($opcion) {
    //Primer caso de consulta sera actulizar los rubros ya que no realizaba la inserccion de datos
    case '1':
      //Variable ip del usuario obtenida con la variable global 
      $ip_adress= $_SERVER['REMOTE_ADDR'];
      if($ip_adress=='::1'){
        //Validacion de ip
        $ip_adress="127.0.0.1";
      }
      //Actualizar el valor del usuario tomando el valor de la sesión
      //usuario 
        $user=200;
        //Conforme ala codifo de mRubro.php el campo de UP_ACTIVO de ser = "";
        $activo = "";
        //Creamos  una varivale sql que contiene el String que ejecutara la llamada al procedimiento alamacenado de la update
        $sql = "call sp_up_rubro('$rb_clave','$titulo','$desc','$activo','$ip_adress','$user');";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        //Listando  la actulizacion del todos los rubros con actulizacion al id que seleccion anteriormente
        $sql2 = 'call sp_li_rubros();';
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->execute();
        //Recoleccion de datos para crear un JSON con el contenido de la tabla seleccionada
        $data=$stmt2->fetchAll(PDO::FETCH_ASSOC);
    break;
}
//Cerramos la conexion
$conexion = null;
//y imprime el JSON en coonsola pra resivir en el frm_Rubro
print json_encode($data, JSON_UNESCAPED_UNICODE);
?>