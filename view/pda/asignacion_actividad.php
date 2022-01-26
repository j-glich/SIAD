<?php
  require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");
  $cve_docente = $_REQUEST['cve_docente'];
  //echo $cve_docente;
  $datos= listar_producto();
?>
<div class="box box-solid">
  <div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Asignacion Actividades</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body "  style="aling: center;" >
  <form name="frmAsignacionActividad">
    <table class="table table-striped" color="black">
      <tbody>
        <tr>
        <thead class="thead-light">
        <th style="width: 30%;" >
         Clave Producto
        </th>

      </tr>
        <table class="table table-sm table-striped table-hover" id="cargaSerializada">
        
          <th style="width: 30%;" ></th>    <!-- Un campo -->
          </thead>
          <tr>
        <?php 
     
          foreach( $datos as $subs){
        ?>
          <td style="width: 30%">
          <input name="<?php echo $subs['clave']; ?>-chk" type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onchange="comprobar(this);"/>
          <label for="<?php echo $subs['clave']; ?>-chk"><?php echo $subs['titulo']; ?></label>
          </td>
           
          </tr>
        <?php } 
        ?>

         
      </tbody>
      
        </table>
        <br>
    <table class="table table-striped">
      <thead style="width: 100%">
        <th>Asignacion de actividad particular a docente                                         </th>
          </thead>
    
        <td style="width: 50%"><p>Clave del Producto</p>
        <select name="cve_producto" id="cve_producto" class="form-control" style="width: 80%;"  value="<?php echo  $datos;?>">
        <?php 
          foreach( $datos as $filas_D){  
        ?>
         <option value="<?php echo $filas_D['clave']; ?>"></option>   

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
         <option value="<?php echo $filas_D['clave']; ?>"></option>   

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
