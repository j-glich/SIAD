<?php
  //require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");
  //echo $cve_docente;
  //$datos= listar_producto();
  try {
    require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/config/newcnx.php");
  } catch (\Exception $e) {
    require_once("../config/newcnx.php");
  }
  //obtenemos las variables que se mandand des de carga horaria
  $cla_docente = $_GET["cve_docente"];
  $sp_cargaH = $_GET["sp_cargaH"];
  $sp_horas = $_GET["sp_horas"];
  //convertir String en un arreglo que lo separa por '-'
  $sub =explode('-', $sp_cargaH);
  //Obtenemos el tamanio del arreglo 
  $num_productos = sizeof($sub);
// creamos la conexion a la base de datos 
$objeto = new Conexion();
//ejecutamos con el objeto el metodo conectar
$conexion = $objeto->Conectar();
$sql = "call sp_li_producto();";
//obtemos los resultados de la base
$result=$conexion->query($sql);
//asociamos y recoremos el resultado y generamos un arreglod para guardar los resultado
while($row = $result->fetch_assoc()){
  $new_array[] = $row; // Inside while loop
}
//generamos un nuevo arreglo asignado las claves por las que podemos listar desde html
$productos = array();
//recorremos el arreglo anterior  mediante un foreach y lo almacenamos en la variable productos 
foreach( $new_array as $row){
  $productos[]=array('PR_CVE'=>$row["PR_CVE"],'PR_SCAT_CVE'=>$row["PR_SCAT_CVE"],'PR_TITULO'=>$row["PR_TITULO"]);
}
  ?>
<div class="box box-solid">
  <div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Asignacion Actividades</p></h4>
  </div>
  <!-- /.box-header -->
  <div class="box-body" >
  <div class="row">
    <div class="col" style="background-color: none;" >
    <table class="table table-striped" color="black">
      <tbody>
        <tr>
        <thead class="thead-light">
        <th style="width: 10%;" >Opcion</th>
        <th style="width: 30%;" >Clave Producto</th>
        </tr>
        <tr>
            <?php 
            //obetemos la longitud del arreglo mediante el metodo sizeof() el cual resive el arreglo productos 
            $t_productos = sizeof($productos);
            //Areglo que recorre por completo la tabla de productos 
            for ($i=0; $i < $t_productos ; $i++) { 
               //Areglo que recorre por completo el arreglo que subActividades  
              for ($j=0; $j < $num_productos ; $j++) { 
                //compara los dos arreglos
                if($productos[$i]['PR_SCAT_CVE'] == $sub[$j]){
                  // 
            ?>
                <td><input type="checkbox" id="<?php echo $productos[$i]['PR_CVE']; ?>-chk" value="<?php echo $productos[$i]['PR_CVE']; ?>"  onclick="verificar(this);"/></td>
                <td> <label id="lb<?php echo $productos[$i]['PR_CVE'];?>" name="<?php echo $productos[$i]['PR_CVE']; ?>" for="<?php echo $productos[$i]['PR_CVE']; ?>-chk"><?php echo $productos[$i]['PR_TITULO'];?></label></td>
          </tr> 
  <?php  
      }
    }
  }  
  ?>
      </tbody>
      </table>
  </div>
    <div class="col" style="background-color:none;">  
    <h4>Asignacion de actividad particular a docente </h4>
    <p>Clave docente</p>
    <input type="text" id="cv_docente" style="width: 80%;"></input>  
    <p>Clave del Producto</p>
        <input type="text" id="cv_producto" style="width: 80%;"></input>
        <p>Horas del Producto</p>
        <input type="text" id="hr_producto" style="width: 80%;"></input>
        <p>Evidencia a entregar: </p><input type="text" id="evidencia" style="width: 80%;"></input>
        <p>Fecha de entrega: </p><input type="date" id='fecha' style="width: 80%;"></input>
        <p>Descripcion del producto: </p><textarea id="desc" type="textarea" style="width: 80%;"></textarea>        
        <div class="card-body d-flex">
          <button class="btn btn-success" id="cargarA">cargar actividad</button>
        </div>
  </div>
  </div>
  </div>
  </form>
  <!-- /.box-body -->
</div>
<script>
function verificar(obj){
  //console.log(obj.id);
  var arrayhoras= <?php echo json_encode($sp_horas);?>;
  var clv_docente  = <?php echo $cla_docente ?>;
  var objeto = obj.id;
  var product = objeto.substr(0, 4);
  var descrepcion = document.getElementById('lb'+product).innerHTML;
  var opcion=3;
  if (obj.checked){ 
    document.getElementById('cv_producto').value = product;
    $.ajax({
        type : 'POST',
        url:'../controller/pda/coProducto.php',
        data: {
            product : product,
            opcion: opcion
        },
        success:function (data){
          fecha = data.substr(10,10);
          document.getElementById("fecha").value = fecha;
        }
      });
    document.getElementById('cv_docente').value = clv_docente;
    document.getElementById('evidencia').value = descrepcion;
    obj.checked = false;
  }else{
    document.getElementById('cv_producto').value = '';
  }
}
$(document).ready(function(){
$(document).on("click", "#cargarA", function(e){
    e.preventDefault();    
    opcion = 4;
    clv_docente = document.getElementById('cv_docente').value;
    clv_producto = document.getElementById('cv_producto').value;
    hr_producto = document.getElementById('hr_producto').value;
    evidencia = document.getElementById('evidencia').value;
    fecha = document.getElementById('fecha').value;
    desc = document.getElementById('desc').value;
    if(clv_docente !="" && clv_producto != ""  && hr_producto !=""   && evidencia != "" && fecha !="" && desc != "" ){
      $.ajax({
        type : 'POST',
        url:'../controller/pda/coProducto.php',
        data: {
            clv_docente : clv_docente ,
            clv_producto : clv_producto ,
            evidencia : evidencia,
            fecha: fecha,
            opcion: opcion
        },
        success:function (){
  
        }
      });
    }else{
      toastr["error"]("Favor de insertar todos los campos ", "Campos vacíos ")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
    }

});
});



</script>