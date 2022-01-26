<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }

  function li_rubros(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
      $stmt= "CALL sp_li_rubros()";
  $result = execQuery($stmt);
  //echo '***'.$result -> num_rows;
  $rubros = array();
  //$rubros= array('clave'=>'','titulo'=>'','desc'=>'');
  foreach( $result as $row){
    $rubros[]=array('clave'=>$row["RB_CVE"],'titulo'=>$row["RB_TITULO"],'desc'=>$row["RB_DESCRIPCION"]);
  }
  //$result->free();
  return $rubros;
  }

  function mDelRubro($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_rubro('$clave', '', '','I','$ip_adress',$user)";
    //echo $stmt;
    $result = ejecutarConsulta($stmt);
    echo " Se ha borrado";
  }

  function mUpRubro($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_rubro('$clave', '$titulo', '$desc','','$ip_adress',$user)";
    //echo $stmt;
    $result = ejecutarConsulta($stmt);
    echo " Se ha actualizado";
}
//Esta funcion sirve para listar los rubros por su clave
function liRubroXClave($clave){
    $stmt= "call sp_li_rubro_x_cve('$clave')";
   // echo $stmt;
    $result = execQuery($stmt);
    foreach( $result as $row){
       $rubro=array('clave'=>$row["RB_CVE"],'titulo'=>$row["RB_TITULO"],'desc'=>$row["RB_DESCRIPCION"]);
    }
    print_r($rubro);
    return $rubro;

  }
?>