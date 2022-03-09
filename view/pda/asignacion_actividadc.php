<?php
  require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/controller/pda/cCargaHoraria.php");

  //Este código refleja la solución a que no este definida la variable sp_cargaH, por ello marca un escepción cuando no existe.
  //function getIfSet(&$value, $default = null)
  //{
  //    return isset($value) ? $value : $default;
  //}
  //$p = getIfSet($_REQUEST['p']);
  $categorias= listar_subcategoria();
require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/controller/pda/cAsignacionActividad.php");
  //echo $cve_docente;
$sp_Carga_Cat = $_GET["sp_Carga_Cat"];
$sub =explode('-', $sp_Carga_Cat);
  //Obtenemos el tamanio del arreglo 
$sp_horas = $_GET["sp_horas"];
$num_productos = sizeof($sub);
$sub_horas =explode('-', $sp_horas);
$hr = sizeof($sub_horas);
$docentes = listar_docentes();
$aux =0;
?>
<div id="cargahoraria" class="box box-solid">
  <!-- /.box-header -->
  <div class="box-body "  >
  <style>
      .thead-green {
      background-color: rgb(171, 71, 188);
      color: white;
    
    }

    .redondo{

  width: 40px;
  height: 40px;
  border-radius: 50%;
}
  </style>
  <div class="row">
    <div class="col-6" style="text-align: center;">
    <label for="" style="font-size: x-large; "> Clave docente</label>
  <select name="cve_docente" id="cve_docente" class="form-control" style="width: 80%; font-size: 20px;"   value="<?php echo  $cve_docente;?>">
                <?php 
                foreach( $docentes as $filas_D){ ?>
                  <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                  $filas_D['nombre1'] ?></option>   

                <?php } //Fin del Select?>
              </select>
    </div>
    <div class="col">
      <label for=""> Total de horas al semestre</label>
    <input type="text" name="total_hrs" id="total_hrs" class="form-control" aling-text="right">  
              
    </div>
    <div class="col">
    <button data-toggle="tooltip" data-placement="top" title="Agregar" id="addCargaH" name="addCargaH" class="redondo"> <i class="bi bi-cloud-upload"></i> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
  <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg></button>
<button
 data-toggle="tooltip" data-placement="top" title="Regresar" id="regresar" name="regresar" class="redondo"> <i class="bi bi-box-arrow-in-left"></i><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
  <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
</svg></button>
    </div>
  </div>
  <form id="frmCargaHoraria" name="frmCargaHoraria" >
        <div style="float: left;" >
        <?php $count =0;  for ($i=0; $i < $num_productos ; $i++) { 
          $count++;
            $datos = listar_producto($sub[$i]);
            $productos_t = sizeof($datos);
            ?>
        <table style="float: left;" class="table table-sm table-striped table-hover table-bordered " id="<?php echo $sub[$i] ?>">
          
        <tr>
        <thead class="thead-green" style="text-align: center;">
        <td  valign="middle"  style="width: 30%;" >Nombre Categoria</td>
        <td style="width: 50%;" >Nombre del producto</td>
        <td style="width: 10%;" >Activar producto</td>
        <td style="width: 10%;" >Horas del producto</td>
        </thead>
        </tr>
        <tbody id='pruebatabla' >
        <?php 
            //obetemos la longitud del arreglo mediante el metodo sizeof() el cual resive el arreglo productos 
            foreach( $datos as $subs){     
            ?>
      
            <tr style="text-align: center;">
            <?php   if($aux < 1 ){  $aux++;?>
                <td valign="middle" rowspan="<?php echo $productos_t ?>" id="menu<?php echo $count ?>"> <label style="position:relative; top: 80px;" for=""><?php echo $subs['categoría'];?></label></td>
                <?php }
                if($subs['default'] != 'E' ){
                ?>
                <td> <label id="lb<?php echo $subs['clave'];?>" name="<?php echo $subs['clave']; ?>" for="<?php echo $subs['clave']; ?>-chk"><?php echo $subs['titulo'];?></label></td>
                <td><input  type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onclick="verificar(this);"/></td>
                <td>
                <?php  if($subs['default'] === 'S' ) { ?>
                  <input  type="text" value="000" onkeypress="return solonumeros(event)" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>  
              <?php  }else if($subs['default'] === 'N' ) {?>
                <input  type="text"  value="<?php echo $sub_horas[$i]; ?>" onkeypress="return solonumeros(event)" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave'];  ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>  

             <?php }
            } ?>
              
              </td>   
               
            </tr> 
<?php  
            }
            $aux =0;
        }
?>
</tbody>      
</table>
        </div>
      </div>
    </form>

  </div>       
  <p>
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  <i class="bi bi-folder-plus"></i>
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
  <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
  <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
</svg>
  </button>
</p>
<div class="collapsing" id="collapseExample">
  <div class="card card-body">
  <div class="form-check">
  <input onclick="habilitar('cve_subcat','evidencia','desc_producto','hrs_producto','dias_entrega','pr_especifico')" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Crear producto especifico
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" onclick="deshabilitar('cve_subcat','evidencia','desc_producto','hrs_producto','dias_entrega','pr_especifico')" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
   Seleccionar producto existente 
  </label>
</div>
    <table class="table table-striped">
      <thead style="width: 100%">
        <th>Asignacion de actividad particular a docente </th>

        <th>
          <div class="row">
            <dvi class="col">
            <label>Seleccionar producto especifico</label>  
        <select name="pr_especifico" id="pr_especifico" disabled class="form-control" style="width: 80%;"  value="<?php echo  $datos;?>">
        <?php   for ($i=0; $i < $num_productos ; $i++) { 
            $datos = listar_producto($sub[$i]);
            $productos_t = sizeof($datos);
            foreach( $datos as $filas_D){  
              if($filas_D['default'] == 'E' ){
        ?>
            <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'-'.$filas_D['titulo'];?></option>   
        <?php } } }
        ?>
        </select>
      
            </dvi>
            <div class="col">
              <button>Agregar</button>
            </div>
          </div>
       
      </th>
          </thead>
        <td style="width: 50%"><p>Selecciona la categoria:</p>
        <select name="cve_subcat" id="cve_subcat" disabled class="form-control" style="width: 80%;"  value="<?php echo  $datos;?>">
        <?php   for ($i=0; $i < $num_productos ; $i++) {
            foreach ($categorias as $fila) {
            if($fila['clave'] ==$sub[$i]){
        ?>
            <option value="<?php echo $sub[$i]; ?>"><?php echo $sub[$i].'.-'. $fila['titulo'] ?></option>   
        <?php }}} 
        ?>
        </select>
        <br>
        <p>Evidencia a entregar: </p><input disabled id="evidencia" type="text" style="width: 80%;"></input>
        <p>Horas del producto independiente: </p><input disabled id="hrs_producto" type="text" style="width: 80%;"></input>
        </td> 
        <td style="width: 50%">
        <p>Descripcion del producto: </p><textarea disabled id="desc_producto" type="textarea" style="width: 80%;"></textarea>
        <br>
        <p>Dias de entrega: </p><input disabled id="dias_entrega" type="text" style="width: 80%;"></input>
        
        <div class="card-body d-flex">
                    <a href="#" style="width: 50%;" id="cargar_producto_esp" class="btn btn-dark btn-block ml-auto">Cargar producto a docente</a>
                </div> 
        </td>

          </table>
  </div>
</div>
  <!-- /.box-body -->
</div>
<script>
  /*Funcion de los cambios cambia lo que esta en id=area*/

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
function habilitar(id_cate,id_evidencia,id_desc,id_horas,id_diasE,id_especifico) {
  document.getElementById(id_cate).disabled = false;
  document.getElementById(id_evidencia).disabled = false;
  document.getElementById(id_desc).disabled = false;
  document.getElementById(id_horas).disabled = false;
  document.getElementById(id_diasE).disabled = false;
  document.getElementById(id_especifico).disabled = true;
}
function deshabilitar(id_cate,id_evidencia,id_desc,id_horas,id_diasE,id_especifico){
  document.getElementById(id_cate).disabled = true;
  document.getElementById(id_evidencia).disabled = true;
  document.getElementById(id_desc).disabled = true;
  document.getElementById(id_horas).disabled = true;
  document.getElementById(id_diasE).disabled = true;
  document.getElementById(id_especifico).disabled = false;
}
function getCategorias(){
  return carga_cat = "<?php echo $sp_Carga_Cat; ?>" ;
}

function gethoras(){
  return carga_hr = "<?php echo $sp_horas; ?>" ;
}

function verificar(obj)
 {   
   //console.log(obj.id);
   var objeto = obj.id;
   var scat = objeto.substr(0, 3);
   //console.log(scat);  
    if (obj.checked){
      document.getElementById(scat).readOnly = false;
      document.getElementById(scat).value = '000';
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
    }else
      document.getElementById(scat).readOnly = true;  
}
cantidad = 0;
$(document).ready(function(){   
  var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
var collapseList = collapseElementList.map(function (collapseEl) {
  return new bootstrap.Collapse(collapseEl)
})

  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        document.frmCargaHoraria.elements[i].checked = true;
        if( document.frmCargaHoraria.elements[i].checked){
            verificar2(document.frmCargaHoraria.elements[i]);
            var check_obj = document.frmCargaHoraria.elements[i].id;
            var scat = check_obj.substr(0, 3);
            var valor =  document.getElementById(scat).value;
            cantidad+= parseInt(valor);
        }
        }
      }
document.getElementById('total_hrs').value = cantidad;
    
$(document).on("click","#regresar" , function(e){
  e.preventDefault();  
  history.pushState(null, "","index.php");
  window.location.href = window.location.href + "?sp_registro=2";
});

$(document).on("click","#cargar_producto_esp", function(e){
  e.preventDefault();
  opcion = 2;
 
 var evidencia = document.getElementById('evidencia').value;
 var hrs_producto = document.getElementById('hrs_producto').value;
 var desc_producto = document.getElementById('desc_producto').value;
 var dias_entrega = document.getElementById('dias_entrega').value;

 
 if(evidencia !='' && cve_subcat !='' && hrs_producto !='' && desc_producto !='' && dias_entrega != ''){
 

  $.ajax({
        type : 'POST',
        url:'../controller/pda/cAsignacionActividad.php',
        dataType: "JSON",
        data: {
            cve_subcat: cve_subcat,
            id_producto :id_producto,
            hrs_producto : hrs_producto,
            desc_producto : desc_producto,
            dias_entrega :dias_entrega,
            evidencia,evidencia,
            opcion: opcion
        },
        success:function (data){

          console.log(data);          
        
        },
        error : function(error){
          console.error(error);
        }
      });

 }else{
   alert('Campos vacios');
 }
 

});
$(document).on("click", "#addCargaH", function(e){
    e.preventDefault();  
    cat = getCategorias();  
    clv_docente = document.getElementById('cve_docente').value;
    hr_producto = document.getElementById('total_hrs').value;
    opcion =  1;
    sp_cargaH  =  preprocesar();
    console.log(sp_cargaH);
    return false;
    aux =0;
    cat = getCategorias();
    hr = gethoras();
    if(aux < 1){
      aux++;
     $.ajax({
        type : 'POST',
        url:'../controller/pda/cAsignacionActividad.php',
        data: {
            clv_docente : clv_docente ,
            sp_cargaH :sp_cargaH,
            opcion: opcion
        },
        success:function (){
            history.pushState(null, "","index.php");
            window.location.href = window.location.href + "?sp_registro=1&sp_ex_cat=" + cat +"&sp_carga_horas=" + hr;   
        
        }
        
      });
    }
  
    });



    });
</script>