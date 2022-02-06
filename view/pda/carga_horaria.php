<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
  //include('../config/routes.php');
  require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cCargaHoraria.php");

//Este código refleja la solución a que no este definida la variable sp_cargaH, por ello marca un escepción cuando no existe.
//function getIfSet(&$value, $default = null)
//{
//    return isset($value) ? $value : $default;
//}

//$p = getIfSet($_REQUEST['p']);
$docentes = listar_docentes();
$datos= listar_subcategoria();
?>
<div id="cargahoraria" class="box box-solid">
  <div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Carga Horaria</p></h4>
  </div>
  <!-- /.box-header -->
  <div>
    <div style="background-color: none; width: 50%; float: left;"> 
      <label for="lbl" style="font-size: 25px;"> Clave Docente</label>
    <select name="cve_docente" id="cve_docente" class="form-control"style="width: 80%;"  value="<?php echo  $cve_docente;?>">
                <?php 
                foreach( $docentes as $filas_D){ ?> 
                  <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                  $filas_D['nombre1']. ' ' .$filas_D['nombre2']; ?></option>   
                <?php } //Fin del Select?>
              </select> 
              
              <input type="text" name="carga" id="carga" placeholder="SubCategorias" class="form-control" style="width: 50%;">
            </div>
    <div style="background-color: none; width: 50%; float: left;"> 
      <label for="lbl"  style="font-size: 25px;"> Total de horas al semestre</label> 
        <input type="text" name="total_hrs" id="total_hrs" class="form-control" aling-text="right" style="width: 50%;">
        <br>
      
        <button id="addCargaH" name="addCargaH" class="btn btn-dark btn-block">Insertar</button> 
      
      </div>
        
  </div>
  <div class="row">
    <div class="col-lg-12" style="background-color: none;">
    <div class="box-body "  style="text-align: center;" >
    <form id="frmCargaHoraria" name="frmCargaHoraria" >
    <table id="tablaSubcatgorias" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Opciones</th>
                                <th>SubCategoria</th>
                                <th>Horas al semestre</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                             foreach( $datos as $subs){                                                       
                            ?>
                            <tr>
                                <td><input name="<?php echo $subs['clave']; ?>-chk" type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onchange="comprobar(this);"/></td>
                                <td><label for="<?php echo $subs['clave']; ?>-chk"><?php echo  $subs['clave'],".-" ,$subs['titulo']; ?></label></td>
                                <td><input  type="text" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                    </table>        
    </div>
      </div>
    </form>
  </div>          

  <!-- /.box-body -->
</div>
<script>
  
 function comprobar(obj)
 {   
   //console.log(obj.id);
   var objeto = obj.id;
   var scat = objeto.substr(0, 3);
   
   //console.log(scat);  
    if (obj.checked)
      document.getElementById(scat).readOnly = false;
     
    else
      document.getElementById(scat).readOnly = true;  
}
</script>
<script type="text/javascript">

</script>


<script type="text/javascript">

$(document).ready(function(){
tablaPersonas = $("#tablaSubcatgorias").DataTable({   
"language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast":"Último",
            "sNext":"Siguiente",
            "sPrevious": "Anterior"
        },
        "sProcessing":"Procesando...",
    }
});
var cantidad = 0; 
$(document).on("click", "#addCargaH", function(e){
    e.preventDefault();     
    var sp_cargaH ='';
    var sp_horas ='';
  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        if (document.frmCargaHoraria.elements[i].checked){
            var check_obj = document.frmCargaHoraria.elements[i].id;
            var scat = check_obj.substr(0, 3);
                    var valor =  document.getElementById(scat).value;
                    cantidad+= parseInt(valor);
                      if(sp_cargaH === ''){
                        sp_cargaH = scat;
                        sp_horas =  valor;
                      }else{
                        sp_cargaH +='-' + scat;
                        sp_horas +='-' + valor;
                  
              }  
          }
        }
      }
      document.getElementById('total_hrs').value = cantidad;
      document.getElementById('carga').value = sp_cargaH;
      clave_docente = document.getElementById('cve_docente').value; 
      form('pda/asignacion_actividad.php?cve_docente='+clave_docente+'&sp_cargaH='+sp_cargaH+ '&sp_horas='+sp_horas);

      history.pushState(null, "","index.php?cve_docente="+clave_docente+'&sp_cargaH='+sp_cargaH+'&sp_horas='+sp_horas);
      alert(cantidad);
      cantidad=0;
   // var carga = preprocesar();
   // form('pda/asignacion_actividad.php');
    //history.pushState(null, "","index.php?carga="+carga);
});
document.getElementById('total_hrs').value = 0;
});

</script>
