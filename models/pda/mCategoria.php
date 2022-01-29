<?php
/*
try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }
  function li_categorias(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";

      $stmt= "CALL sp_li_categoria()";
  $result = execQuery($stmt);
  //echo '***'.$result -> num_rows;
  $categorias = array();
  //$rubros= array('clave'=>'','titulo'=>'','desc'=>'');
  foreach( $result as $row){
    $categorias[]=array('clave'=>$row["CAT_CVE"],'titulo'=>$row["CAT_TITULO"],'desc'=>$row["CAT_DESCRIPCION"]);
  }
  return $categorias;
  }
  function mDelCategoria($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_categoria('$clave', '', '','I','$ip_adress',$user)";
  //  echo $stmt;
    $result = ejecutarConsulta($stmt);
    echo " Se ha borrado";
  }
  function mUpCategoria($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_categoria('$clave', '$titulo', '$desc','','$ip_adress',$user)";
   // echo $stmt;
    $result = ejecutarConsulta($stmt);
   // echo " Se ha actualizado";
  }
function liCategoriaXClave($clave){
    $stmt= "call sp_li_cat_x_cve('$clave')";
   // echo $stmt;
    $result = execQuery($stmt);
    foreach( $result as $row){
       $categorias=array('clave'=>$row["CAT_CVE"],'titulo'=>$row["CAT_TITULO"],'desc'=>$row["CAT_DESCRIPCION"]);
    }
    print_r($categorias);
    return $categorias;

  }
*/
  //Establecer Conexion con objeto de la clases Conexion y ejecutando el metodo Conectar conexion de rutas utilizando la variable global $_SERVER['DOCUMENT_ROOT'] y con un path relativo
try {
  require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/config/newcnx.php");
} catch (\Exception $e) {
  require_once("../config/newcnx.php");
}
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$ip_adress= $_SERVER['REMOTE_ADDR'];
if($ip_adress=='::1'){
  //Validacion de ip
  $ip_adress="127.0.0.1";
}
//Actualizar el valor del usuario tomando el valor de la sesión
//usuario 
$user=200;
//Switch sirve para poder ejecutar diferentes procesos en un solo menu.
  switch ($opcion) {
    //Primer caso de consulta sera actulizar los rubros ya que no realizaba la inserccion de datos
    case '1':
      //Variable ip del usuario obtenida con la variable global 
        //Conforme ala codigo de mRubro.php el campo de UP_ACTIVO de ser = "";
        $activo = "";
        //Creamos  una varivale sql que contiene el String que ejecutara la llamada al procedimiento alamacenado de la update
        $sql = "call sp_up_categoria('$cat_clave', '$titulo', '$desc',$activo,'$ip_adress',$user)";
        $stmt = $conexion->query($sql);
        //Listando  la actulizacion del todos los rubros con actulizacion al id que seleccion anteriormente
        $sql2 = 'call sp_li_categoria();';
        $stmt2 = $conexion->query($sql2);
        //Recoleccion de datos para crear un JSON con el contenido de la tabla seleccionada
        while($row = $stmt2->fetch_assoc()){
          $data[] = $row; // Inside while loop
        }
    break;
   /* case '2':
      $sql = "call sp_in_rubro('$rb_clave','$titulo','$desc','$ip_adress','$user');";
      $stmt = $conexion->query($sql);
      //Listando  la actulizacion del todos los rubros con actulizacion al id que seleccion anteriormente
      $sql2 = 'call sp_li_rubros();';
      $stmt2 = $conexion->query($sql2);
      //Recoleccion de datos para crear un JSON con el contenido de la tabla seleccionada
      while($row = $stmt2->fetch_assoc()){
        $data[] = $row; // Inside while loop
      }


    break;
    */
}
//Cerramos la conexion
$conexion = null;
//y imprime el JSON en coonsola pra resivir en el frm_Rubro
print json_encode($data, JSON_UNESCAPED_UNICODE);

?>