<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);

  require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cCategoria.php");

  

 if(isset($_REQUEST['d']))
{
  del_categoria($_REQUEST['d']);   
}


$datos = listar_categorias();

 
?>
<div class="box box-solid">
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Listado de Categorias</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body" >
    <table class="table table-striped table-hover">
      <tbody>
        <tr>
          <th style="width: 10%;">Identificador</th>
          <th style="width: 30%;">Titulo de la categoria</th>
          <th style="width: 30%;">Descripción de la categoria</th>
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
              onclick="acc_categoria('C','<?php echo $fila['clave']?>')">Modificar</button>
              <button class="btn btn-dark "
              onclick="acc_categoria('U','<?php echo $fila['clave']?>')">Desactivar</button>
              
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
function acc_categoria(tipo, codigo){
  if(tipo=='U'){    
    confirmar("¿Confirmar desactivar Categoria?",'../view/pda/categoria.php?d='+codigo);
  }else if (tipo=='C') {
    form('../view/pda/frm_categoria.php?u='+codigo);
  }else if(tipo=='A'){
    form('../view/pda/frm_categoria.php');
  }
}
</script>

