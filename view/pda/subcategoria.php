<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
  //include('../config/routes.php');
  require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cSubcategoria.php");
  //include_once '../includes/session.php';
  //include_once '../includes/functions.php';
  //var_dump($rubros);
  //print_r($datos);

//  while($rubros = $rubro) {
    # code..
 
//   echo $rubro[0];
   // echo $rubro[0].'-'.$rubro[1].'-'.$rubro[2];
 // }

  

 if(isset($_REQUEST['d']))
{
  del_subcategoria($_REQUEST['d']);   
}


$datos = listar_subcategorias();

 
?>
<div class="box box-solid">
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Listado de Subcategorias</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body" >
    <table class="table table-striped table-hover">
      <tbody>
        <tr>
          <th style="width: 10%;">Identificador</th>
          <th style="width: 30%;">Titulo de la subcategoria</th>
          <th style="width: 30%;">Descripción de la subcategoria</th>
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
              <button class="btn btn-dark "
              onclick="acc_subcategoria('C','<?php echo $fila['clave']?>')">Modificar</button>
              <button class="btn btn-dark "
              onclick="acc_subcategoria('U','<?php echo $fila['clave']?>')">Desactivar</button>
              
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
function acc_subcategoria(tipo, codigo){
  if(tipo=='U'){    
    confirmar("¿Confirmar desactivar Subcategoria?",'../view/pda/subcategoria.php?d='+codigo);
  }else if (tipo=='C') {
    form('../view/pda/frm_subcategoria.php?u='+codigo);
  }else if(tipo=='A'){
    form('../view/pda/frm_subcategoria.php');
  }
}
</script>

