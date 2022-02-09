<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
  //include('../config/routes.php');
  require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/controller/pda/cCargaHoraria.php");

//Este código refleja la solución a que no este definida la variable sp_cargaH, por ello marca un escepción cuando no existe.
//function getIfSet(&$value, $default = null)
//{
//    return isset($value) ? $value : $default;
//}

//$p = getIfSet($_REQUEST['p']);

///

  
if($_REQUEST['sp_cargaH']===null){
$docentes = listar_docentes();
$datos= listar_subcategoria();
?>


<div class="box box-solid">
  <div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Carga Horaria</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body "  style="aling: center;" >
    <form id="frmCargaHoraria" name="frmCargaHoraria" action="" method="post" >
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
            <input  type="hidden" name="sp_cargaH" id="sp_cargaH" value="" aling="right"/>  
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
            <button data-toggle="modal" data-target="#myModal" id="addCargaH" name="addCargaH" class="btn btn-dark btn-block"
            >Insertar</button>

            </td>
          </table>
      
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

/*$("#addCargaH").click(function(){
  preprocesar();
  

    });*/



$("#addCargaH").click(function(){
    preprocesar();
        //   alertaCorrecto('sp_cargaH '+  document.getElementById("sp_cargaH").value);
           
    $.ajax({
          method: "POST",
          dataType : "text",
          url:'../../ae/view/pda/carga_horaria.php?sp_cargaH='+sp_cargaH+'&cve_docente='+document.getElementById("cve_docente").value,
          //data: $("#frmCargaHoraria").serialize(),
          success : function (data){
              alert(data + "hola");
              console.log(data);
              if(data=='ok'){
             //   window.location=window.location-"?cve_docente="+ document.getElementById("cve_docente").value"sp_cargaH="+document.getElementById("sp_cargaH").value;
                alertaCorrecto("Se agrego correctamente el atributo, vaya a listar atributos para ver los cambios");
                $('#myModal').modal('toggle');
                //window.location.replace = "../../ae/view/pda/asignacion_actividad.php";
               // $('#frmatr').empty()
              //window.location.href = '../../ae/view/pda/asignacion_actividad.php?cve_docente='+ document.getElementById("cve_docente").value;
              //form('pda/frm_rubro.php');
              }else{
                alertaError("Error al procesar la carga horaria") 
                $('#myModal').modal('toggle');
               // window.location=window.location+"?cve_docente="+ document.getElementById("cve_docente").value"sp_cargaH="+document.getElementById("sp_cargaH").value;
               //form('pda/frm_producto.php');
              }

          }
          //console.log("si da");
          //window.location.href = '../../ae/view/pda/asignacion_actividad.php?cve_docente='+ document.getElementById("cve_docente").value;
          ,     error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            console.log(err);
                        }
     });
	});
</script>


<script type="text/javascript">

function preprocesar()
 {  
 console.log("hola1"); 
   //Leer todos los objetos que son de tipo checkbox
console.log ( document.frmCargaHoraria.elements.length);
  // var scat = objeto.substr(0, 3);  sp_cargaHç
  // ASA80-CGE90-TIA80
   var sp_cargaH ='';
  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
 console.log("hola2"); 

      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        console.log("hola3"); 
        if (document.frmCargaHoraria.elements[i].checked){
          console.log("hola4"); 
            var check_obj = document.frmCargaHoraria.elements[i].id;
            var scat = check_obj.substr(0, 3);
                    var valor =  document.getElementById(scat).value;
                      if(sp_cargaH === ''){
                        console.log("hola5"); 
                        sp_cargaH = scat + valor;
                       
                  
                      }else{
                        console.log("hola6"); 
                        sp_cargaH +='-' + scat + valor;
                      }  
          }
        }
      }

      document.getElementById("sp_cargaH").value= sp_cargaH;
      //echo sp_cargaH;
      console.log("hola7"); 
           alert('sp_cargaH '+ sp_cargaH);
      console.log("final del proceso");

}

</script>
<?php
////////////////
// Termina elproceso de carga horaria y empieza la del proceso de carga de actividad

   } else {  
    //require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");


///////////////

///Empeiza proceso para la carga en la base de datos antes de mostrar los elementos

echo "Ya llegue aki";
echo $_REQUEST['sp_cargaH'];
$res_call=add_carga($_REQUEST['cve_docente'], $_REQUEST['sp_cargaH']);
if($res_call='OK') 
  echo "Si llegamos";
 // up_categoria($_REQUEST['cat_clave'], $_REQUEST['titulo'], $_REQUEST['desc']);



/////// Proceso de asignación

$cve_docente = $_REQUEST['cve_docente'];
echo $cve_docente;
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
<?php
        }

?>


