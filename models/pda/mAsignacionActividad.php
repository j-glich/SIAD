<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }
  switch ($opcion) {
    case '1':
      $ip_adress= $_SERVER['REMOTE_ADDR'];
      if($ip_adress=='::1')
        $ip_adress="127.0.0.1";
      //Actualizar el valor del usuario tomando el valor de la sesión
        $user=200;
        $periodo='20221';
      $stmt= "call sp_in_carga_actividad_x_scat('$carga', '$clave_docente', '$periodo',$user,'$ip_adress')";
     //echo $stmt;
      execQuery($stmt);
    break;
  }
  function mAddActividad($cve_docente, $cve_pr){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    //$stmt= "call sp_in_actividad('$cve_docente', '$cve_pr', '$periodo', '$hrs_pr', '$fec_prog' '$ip_adress',$user)";
   // 
 //   $result = ejecutarConsulta($stmt);
   // echo " Se ha actualizado";

  }

  function li_productos(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
      $stmt= "CALL sp_li_producto()";
  $result = execQuery($stmt);
  //echo '***'.$result -> num_rows;
  $productos = array();
  //$rubros= array('clave'=>'','titulo'=>'','desc'=>'');
  foreach( $result as $row){
    $productos=array('clave'=>$row["PR_CVE"],'subclave'=>$row['PR_SCAT_CVE'],'titulo'=>$row["PR_TITULO"],'desc'=>$row["PR_DESCRIPCION"]);
  }
  return $productos;
  }

  function mDelProducto($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_producto('$clave', '', '','I','$ip_adress',$user)";
    //echo $stmt;
    $result = ejecutarConsulta($stmt);
    echo " Se ha borrado";


  }


  function mUpProducto($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_producto('$clave', '$titulo', '$desc','','$ip_adress',$user)";
    //echo $stmt;
    $result = ejecutarConsulta($stmt);
   // echo " Se ha actualizado";


  }

function liProductoXClave($clave){
    $stmt= "call sp_li_pr_x_cve('$clave')";
   // echo $stmt;
    $result = execQuery($stmt);
    $productos = array();
    foreach( $result as $row){
       $productos[]=array('categoría'=>$row['CAT_CVE'],'clave'=>$row["SCAT_CVE"],'titulo'=>$row["PR_TITULO"],'desc'=>$row["PR_DESCRIPCION"]);
    }
    return $productos;
  }
?>