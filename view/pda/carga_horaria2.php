<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
  //include('../config/routes.php');
  require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/controller/pda/cCargaHoraria.php");

//Este código refleja la solución a que no este definida la variable sp_cargaH, por ello marca un escepción cuando no existe.
//function getIfSet(&$value, $default = null)
//{
//    return isset($value) ? $value : $default;
//}
//$p = getIfSet($_REQUEST['p']);
$datos= listar_subcategoria();
?>
<style>
#cargahoraria{
  width: auto;
  max-width: auto;
  height: auto;
  display:  flex;
  flex-wrap: wrap;
  justify-content: center;
   overflow: hidden;
}

#cargahoraria .card{
width: 160px;
height: auto;
border-radius: 8px;
box-shadow: 0 2px 2px rgba(0, 0,0,0.2);
overflow: hidden;
margin: 6px;
text-align: center;
transition: all 0.25px;
float: left;
}
#cargahoraria .card:hover{
  transform: translate(-5px) ;
  box-shadow: 0 12px 16px rgba(0, 0,0,0.2);
}
#cargahoraria .card h4{
  border-bottom: 4px solid black;
  background-color: black;
}
#cargahoraria .card p{
  font-size: smaller;
}
</style>
<form id="frmCargaHoraria" name="frmCargaHoraria" >
<div id="cargahoraria" class="box box-solid">
  
<?php foreach( $datos as $subs){     ?>
      <div class="card text-white bg-info " id="<?php echo $subs['clave']; ?>-chk"  onclick="card(this)">
      <i class="bi bi-bookmark-plus"></i>
        <h4 >
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"/>
</svg>  
        <?php echo $subs['clave']?> </h4>
        <div class="row" style="height: 20px;">
          <div class="col-1">
          <input name="<?php echo $subs['clave']; ?>" onclick="comprobar(this)" type="checkbox" style=" width: 16px; height: 16px;" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"/>
          </div>
        <div class="col">
         <input maxlength="3"  type="text" style="height: 20px;" required placeholder="Total de horas" onkeypress="return solonumeros(event)" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>
        </div>
        </div>
        <p><?php echo $subs['titulo']?> </p>
      </form>
      </div>
      <?php
          }
      ?>    
     <div style="position: relative; float: left; left: 50px;align-items: center;display: flex;   justify-content: center;">
     <button class="btn text-white " style="height: 50px; width: 150px; background-color: black;" id="btnSiguiente">Siguiente</button>
     </div>
</div>

  <!-- /.box-body -->
</div>
<script>
$(document).ready(function(){
$(document).on("click", "#btnSiguiente", function(e){
    e.preventDefault();     
    var sp_cargaH ='';
    var sp_horas ='';      
  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        if (document.frmCargaHoraria.elements[i].checked){
            var check_obj = document.frmCargaHoraria.elements[i].id;
            var cat = check_obj.substr(0, 3); 
            var valor =  document.getElementById(cat).value;
          
                     if(sp_cargaH === ''){
                        sp_cargaH = cat;
                        if(valor.length == 1){
                          sp_horas = '00'+valor;
                        } 
                        if(valor.length == 2){
                          sp_horas = '0'+valor;
                        } 
                        if(valor.length == 3){
                          sp_horas = valor;
                        }
                      }else{
                        sp_cargaH +='-' + cat; 
                        if(valor.length == 1){
                          sp_horas += '-' +'00'+valor;
                        } 
                        if(valor.length == 2){
                          sp_horas += '-' +'0'+valor;
                        } 
                        if(valor.length == 3){
                          sp_horas += '-' +valor;
                        }

            
            }
          }
        }
      }
      form('pda/asignacion_actividadc.php?sp_Carga_Cat='+sp_cargaH+"&sp_horas="+sp_horas);
      history.pushState(null, "","index.php?sp_Carga_Cat="+sp_cargaH+"&sp_horas="+sp_horas);
    });
  });
  function solonumeros(e) {
    key= e.keyCode || e.which;
    teclado = String.fromCharCode(key);
    numero="0123456789";
    especiales ="8-37-38-46-250"; //array
    teclado_es = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_es = true;
        }
    }
    if(numero.indexOf(teclado) == -1 && !teclado_es){
    return false;
}

}
function card(obj){   
  var objeto = obj.id;
  var scat = objeto.substr(0, 3);  
  con = document.getElementsByName(scat);
  console.log(document.getElementsByName(scat)[0].checked); 
   if(document.getElementsByName(scat)[0].checked ==false){
      document.getElementsByName(scat)[1].readOnly = false;
      document.getElementsByName(scat)[0].checked = true;
    }else if(document.getElementsByName(scat)[0].checked ==true){
      document.getElementsByName(scat)[0].checked = false;
      document.getElementsByName(scat)[1].readOnly = true;
    }

  
  
 
}

</script>