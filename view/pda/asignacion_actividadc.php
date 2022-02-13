<?php
  //include('../config/routes.php');
require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/controller/pda/cAsignacionActividad.php");
  //echo $cve_docente;
$sp_Carga_Cat = $_GET["sp_Carga_Cat"];
$sub =explode('-', $sp_Carga_Cat);
  //Obtenemos el tamanio del arreglo 
$num_productos = sizeof($sub);
$docentes = listar_docentes();
?>


<div id="cargahoraria" class="box box-solid">
  <div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Carga Horaria</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body "  >
    <form id="frmCargaHoraria" name="frmCargaHoraria" >
      <div class="row">
        <div class="col-8">
        <table class="table table-sm table-striped table-hover table-bordered border-primary" id="cargaSerializada">
            
            <tbody>
        <tr>
        <thead class="thead-dark" style="text-align: center;">
        <th style="width: 10%;" >id_Categoria</th>
        <th style="width: 50%;" >Nombre del producto</th>
        <th style="width: 20%;" >Activar producto</th>
        <th style="width: 20%;" >Horas del producto</th>
        </thead>
        </tr>
        <?php 
    for ($i=0; $i < $num_productos ; $i++) { 
            $datos = listar_producto($sub[$i]);
            //obetemos la longitud del arreglo mediante el metodo sizeof() el cual resive el arreglo productos 
            foreach( $datos as $subs){     
            ?>
            <tr style="text-align: center;">
            <td> <label  for=""><?php echo $subs['categoría'];?></label></td>
                <td> <label id="lb<?php echo $subs['clave'];?>" name="<?php echo $subs['clave']; ?>" for="<?php echo $subs['clave']; ?>-chk"><?php echo $subs['titulo'];?></label></td>
                <td><input  type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onclick="verificar(this);"/></td>
                <td><input  type="text" onkeypress="return solonumeros(event)" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/></td>     
            </tr> 
<?php  
            }
        }
?>
</tbody>      
            </table>
        </div>
        <div class="col">
        <table class="table table-striped" color="black">
        <tbody>
          <tr>
            <thead class="thead-light">
            <th style="width: 50%;" >
              Clave Docente
            </th>
            <th style="width: 50%" >Total de horas al semestre</th> 
            </thead>
          </tr>
          <tr>
            <th  style="width: 50%;" >
              <select name="cve_docente" id="cve_docente" class="form-control"  value="<?php echo  $cve_docente;?>">
                <?php 
                foreach( $docentes as $filas_D){ ?>
                  <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                  $filas_D['nombre1']. ' ' .$filas_D['nombre2']; ?></option>   

                <?php } //Fin del Select?>
              </select>
              </th>
              <th>
              <input type="text" name="total_hrs" id="total_hrs" class="form-control" aling-text="right">  
            </th>
           </tr>
        </tbody>
      </table>
      <button data-toggle="modal" data-target="#myModal" id="addCargaH" name="addCargaH" class="btn btn-dark btn-block">Insertar</button>
        </div>
      </div>
    
     
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
function verificar(obj)
 {   
   //console.log(obj.id);
   var objeto = obj.id;
   var scat = objeto.substr(0, 3);
   //console.log(scat);  
    if (obj.checked){
      document.getElementById(scat).readOnly = false;
      document.getElementById(scat).value = 0;
    }else{
      document.getElementById(scat).readOnly = true;  
      document.getElementById(scat).value = "";
}   
 }
function verificar2(obj)
 {   
   //console.log(obj.id);
   var objeto = obj.id;
   var scat = objeto.substr(0, 3);
   //console.log(scat);  
    if (obj.checked){
      document.getElementById(scat).readOnly = false;
      document.getElementById(scat).value = 0;
    }else
      document.getElementById(scat).readOnly = true;  
}
$(document).ready(function(){   

  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        document.frmCargaHoraria.elements[i].checked = true;
        if( document.frmCargaHoraria.elements[i].checked){
            verificar2(document.frmCargaHoraria.elements[i]);
        }
        }
      }
    });
</script>