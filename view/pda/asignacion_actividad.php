<?php
  //require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");
  //echo $cve_docente;
  //$datos= listar_producto();
  try {
    require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/config/newcnx.php");
  } catch (\Exception $e) {
    require_once("../config/newcnx.php");
  }
  $cla_docente = $_GET["cve_docente"];
  $sp_cargaH = $_GET["sp_cargaH"];
  $sub =explode('-', $sp_cargaH);
  $num_productos = sizeof($sub);
  for ($i=0; $i < $num_productos; $i++) { 
     print_r($sub[$i]);
  }
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$sql = "call sp_li_producto();";
$result=$conexion->query($sql);
while($row = $result->fetch_assoc()){
  $new_array[] = $row; // Inside while loop
}
 print_r($new_array);     
  ?>
<div class="box box-solid">
  <div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Asignacion Actividades</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body "  style="aling: center;" >
    <table class="table table-striped">
      <thead style="width: 100%">
        <th>Asignacion de actividad particular a docente                                         </th>
          </thead>
    
        <td style="width: 50%"><p>Clave del Producto</p>
        <select name="cve_producto" id="cve_producto" class="form-control" style="width: 80%;"  value="<?php echo  $datos;?>">
        <?php 
          foreach( $datos as $filas_D){  
        ?>
         <option value="<?php echo $filas_D['subclave']; ?>"><?php echo $filas_D['subclave']; ?></option>   

        <?php } 
        ?>
        </select>
        <br>
        <p>Evidencia a entregar: </p><input type="text" style="width: 80%;"></input>
        <br>
        <p>Fecha de entrega: </p><input type="date" style="width: 60%;"></input>
        </td> 


        <td style="width: 50%">
        <p>Descripcion del producto: </p><textarea type="textarea" style="width: 80%;"></textarea>
        <br>
        <p>Selecciona la subcategoria: </p>
        <select name="cve_producto" id="cve_producto" class="form-control" style="width: 80%;"  value="Subcategoria">
        <?php 
          foreach( $datos as $filas_D){  
        ?>
         <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave']; ?></option>   

        <?php } 
        ?>
        </select>
        
        <div class="card-body d-flex">
                    <a href="#" style="width: 50%;" class="btn btn-dark btn-block ml-auto">Cargar producto a docente</a>
                </div>
        </td>

          </table>
         
      
  </div>
  </form>
  <!-- /.box-body -->
</div>
