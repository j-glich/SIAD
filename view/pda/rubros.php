<?php
  //include('../config/routes.php');
  require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cRubro.php");
if(isset($_REQUEST['d']))
{
  del_rubro($_REQUEST['d']);   
}
$datos = listar_rubros();
?>
<div class="box box-solid">
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Listado de Rubros</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body" >
    <table class="table table-striped table-hover">
      <tbody>
        <tr>
          <th style="width: 10%;">Identificador</th>
          <th style="width: 30%;">Titulo del Rubro</th>
          <th style="width: 30%;">Descripción del Rubro</th>
          <th>Acciones</th>
        </tr>
        <?php 
          foreach( $datos as $fila){
        ?>
          <tr>
            <td><?php echo $fila['clave']; ?></td>
            <td aling="justify"><?php echo $fila['titulo']; ?></td>
            <td aling="justify"><?php echo $fila['desc']; ?></td>
            <td>
              <button class="btn btn-xs btn btn-dark"
              onclick="accion_rubro('C','<?php echo $fila['clave']?>')">Modificar</button>
              <button class=" btn btn-xs btn btn-dark"
              onclick="accion_rubro('U','<?php echo $fila['clave']?>')">Desactivar</button>
              
            </td>

          </tr>
        <?php } 
        ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<script type="text/javascript">
function accion_rubro(tipo, codigo){
  if(tipo=='U'){    
    confirmar("¿Confirmar desactivar Rubro?",'../view/pda/rubros.php?d='+codigo);
    //C = a modificar 
  }else if (tipo=='C') {
    form('../view/pda/frm_rubro.php?u='+codigo);
  //A es desactivas rubro
  }else if(tipo=='A'){
    form('../view/pda/frm_rubro.php');
  }
}
</script>


