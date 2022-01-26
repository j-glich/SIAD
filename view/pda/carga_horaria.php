<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
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
  <div class="box-body "  style="text-align: center;" >
    <form id="frmCargaHoraria" name="frmCargaHoraria" >
      <table class="table table-striped" color="black">
        <tbody>
          <tr>
            <thead class="thead-light">
            <th style="width: 30%;" >
              Clave Docente
            </th>
      
            <th  style="width: 50%;" >
              <select name="cve_docente" id="cve_docente" class="form-control"style="width: 40%;"  value="<?php echo  $cve_docente;?>">
                <?php 
                foreach( $docentes as $filas_D){ ?>
                  <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                  $filas_D['nombre1']. ' ' .$filas_D['nombre2']; ?></option>   

                <?php } //Fin del Select?>
              </select>
              </th>
     
           </tr>
          
            <table class="table table-sm table-striped table-hover" id="cargaSerializada">
            <th style="width: 40%" ></th> 
              <th style="width: 20%;" >Horas al semestre</th>
            </thead>
            <tr>
     
          <?php 
     
          foreach( $datos as $subs){
          ?>
            <td style="width: 80%">
              <input name="<?php echo $subs['clave']; ?>-chk" type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onchange="comprobar(this);"/>
              <label for="<?php echo $subs['clave']; ?>-chk"><?php echo $subs['titulo']; ?></label>
            </td>
            <td style="width: 10%">
              <div class="form-group">
                <input  type="text" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>
              </div>
            </td>
            </tr>
          <?php } 
          ?>
            <input  type="text" name="sp_cargaH" id="sp_cargaH" value="" aling="right"/>  
       </tbody>
      
        </table>
        <br>
       <table class="table table-striped">
        <th style="width: 30%" ></th> 
        <th style="width: 30%" >Total de horas al semestre</th> 
        <td style="width: 30%">
            <div class="form-group">
           
        <input type="text" name="total_hrs" id="total_hrs" class="form-control" aling-text="right">
     
        </div>
      
            </td>
            <td style="width: 10%">
            <button id="addCargaH" name="addCargaH" class="btn btn-dark btn-block">Insertar</button>

            </td>
          </table>
      
      </div>
    </form>
  </div>          

  <!-- /.box-body -->
</div>
<script>
  /*Funcion de los cambios cambia lo que esta en id=area*/
function form(url){
  $.ajax({
        url : url,
        dataType: "text",
        success : function (data) {
            $("#area").html(data);
        }
    });
  // console.log("Hola");

}

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

function preprocesar()
 {  
 
   //Leer todos los objetos que son de tipo checkbox
  //  console.log (document.frmCargaHoraria.elements.length);
  // var scat = objeto.substr(0, 3);  sp_cargaHç
  // ASA80-CGE90-TIA80
   var sp_cargaH ='';
  for (i=0;i<document.frmCargaHoraria.elements.length;i++){


      if(document.frmCargaHoraria.elements[i].type == "checkbox"){

        if (document.frmCargaHoraria.elements[i].checked){

            var check_obj = document.frmCargaHoraria.elements[i].id;
            var scat = check_obj.substr(0, 3);
                    var valor =  document.getElementById(scat).value;
                      if(sp_cargaH === ''){

                        sp_cargaH = scat + valor;
                       
                  
                      }else{

                        sp_cargaH +='-' + scat + valor;
                      }  
          }
        }
      }

      document.getElementById("sp_cargaH").value= sp_cargaH;
      //echo sp_cargaH;
     alert('sp_cargaH '+ sp_cargaH);
     return sp_cargaH;
//      console.log("final del proceso");
      

 //     console.log('../asignacion_actividad.php?sp_cargaH='+document.getElementById("sp_cargaH").value+'&cve_docente='+document.getElementById("cve_docente").value+'#')

}

$(document).ready(function(){
//Evento de Refistro de Carga horaria 
$(document).on("click", "#addCargaH", function(e){
    e.preventDefault();     
    var carga = preprocesar();
    form('pda/asignacion_actividad.php');
    history.pushState(null, "","index.php?carga="+carga);
});
});

</script>
