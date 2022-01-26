<?php
define('ruta',$_SERVER['DOCUMENT_ROOT']);
require_once(ruta."/ae/controller/pda/cRubro.php");
$data= array('clave'=>'','titulo'=>'','desc'=>'');
if(isset($_REQUEST['u'])){
  $data=listar_rubro($_REQUEST['u']);
  print_r($data);
} ?>
<div class="">
  <form  id="frmrubro">
    <div class="box-body">
      <div class="form-group">
        <label>Acrónimo de atributo de egreso (Completa con el número de atributo siguiente. Ver ejemplo) : </label>
        <input type="text" name="rb_clave" id="rb_clave" class="form-control"  value="<?php echo $data['clave']; ?>" placeholder="Rubro" readonly>
        <p class="help-block">ej. ISC_AE1, ISC_AE2, ISC_AE3... </p>
      </div>
      <div class="form-group">
        <label>Título del atributo </label>
        <textarea name="titulo" id="titulo" class="form-control"  rows="2" placeholder="Titulo del rubro ..." ><?php echo $data['titulo']; ?></textarea>
      </div>
      <div class="form-group">
        <label>Descripción del rubro (Grupo de actividades a desempeñar) </label>
        <textarea name="desc" id="desc" class="form-control" rows="3" placeholder="Descripción ..." ><?php echo $data['desc']; ?></textarea>
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <?php if(isset($_REQUEST['u'])){ ?>
      <button id="update" class="btn btn-primary btn-block">Actualizar Rubro</button>
    <?php }else{
     ?> 
      <input type="hidden" name="alta" class="form-control" id="alta" value="1" placeholder="Atributo de egreso">
      <button data-toggle="modal" data-target="#myModal" id="add" class="btn btn-primary btn-block">Registrar Atributo</button>
      
    <?php } ?>
    </div>
  </form>
</div>  
  <script type="text/javascript">
    $(document).ready(function(){
//Evento de Refistro de Carga horaria 

$(document).on("click", "#update", function(e){
    e.preventDefault();  
    var opcion = 1;
    let rb_clave = document.getElementById('rb_clave').value;   
    let titulo = document.getElementById("titulo").value;
    let desc =  document.getElementById("desc").value;
    alert(titulo+rb_clave+desc);
    $.ajax({
        type : 'POST',
        url:'../controller/pda/pdacRubro.php',
        data: {
            rb_clave : rb_clave,
            titulo:titulo,
            desc:desc,
            opcion: opcion
        },
        dataType: 'JSON',
        success: function(data){
            console.log(data);
        },
        error: function(error){
          console.log(error);
        }
        
    });
});
});
  </script>
<!--<script type="text/javascript">

  $("#update").click(function(){
    $.ajax({
          method: "POST",
          dataType : "text",
          url :"../../ae/controller/pda/cRubro.php" ,
          data: $("#frmrubro").serialize(),
          success : function (data) {
            alert('Datos serializados: '+data);
              alertaCorrecto("Se actulizó correctamente el atributo");
              if(data=='ok'){
                alertaCorrecto("Se actulizó correctamente el atributo");
                $('#myModal').modal('toggle');
              }else{
                alertaError("Error al actualizar el atributo"+data)
                $('#myModal').modal('toggle');
              }
          },     error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            console.log("err");
                        }
      });
  });

	$("#add").click(function(){
    $.ajax({
          method: "POST",
          dataType : "text",
          url :" /ae/controller/AtributosController.php" ,
          data: $("#frmatr").serialize(),
          success : function (data){
              alert(data);
              if(data=='ok'){
                alertaCorrecto("Se agrego correctamente el atributo, vaya a listar atributos para ver los cambios");
                $('#myModal').modal('toggle');

               // $('#frmatr').empty()
              }else{
                alertaError("Error al crear el atributo") 
                $('#myModal').modal('toggle');
              }
          }
     });
	});

-->


</script>
