<style>
    .font{
        font-size: 20px;
    }
</style>
<div class="">
    <div class="row"style="text-align: center;" >
    <div class="col" style="background-color: white;">
    <form>
        <div class="box-body" style="text-align: center;">
        <div class="box-header with-border">
            <h4 class="box-header with-border"><p style="text-align:center; font-size: 40px;">NUEVO RUBRO</p></h4>
        </div>
        <div class="form-group">
            <label class="font">Acrónimo del nuevo rubro (Ver ejemplo) : DOCENCIA_DOC, FORMACIÓN PROFESIONAL_FOP ...</label>
            <input maxlength="3" type="text" name="rb_clave" id="rb_clave" class="form-control" required placeholder="Nombre del rubro">
        </div>
        <div class="form-group">
            <label class="font">Título del rubro </label>
            <input name="titulo" id="titulo" class="form-control"  placeholder="Titulo del rubro ..." >
        <div class="form-group">
            <label class="font">Descripción del rubro (Grupo de actividades a desempeñar) </label>
            <textarea name="desc" maxlength="50" id="desc" class="form-control" rows="4" placeholder="Descripción ..." required></textarea>
        </div>
    </div>
    <div class="box-footer">
    <button id="btnNuevo" class="btn btn-primary btn-block" style="width: 50%; float: right;"> Registrar</button>
    </div>
</form>
    </div>
</div>  
<script type="text/javascript">
$(document).ready(function(){
//Evento de Refistro de Carga horaria 
$(document).on("click", "#btnNuevo", function(e){
  //prevenir que el evento se lanse solo
e.preventDefault(); 
//Variable que se preparan para ser insertadas en la base de datos
    let opcion = 2;
    let rb_clave = document.getElementById('rb_clave').value;   
    let titulo = document.getElementById("titulo").value;
    let desc =  document.getElementById("desc").value;
    //Validacion de campos en caso del que require no funcione
    if(rb_clave != "" && titulo !="" && desc != "" ){
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
        toastr["success"]("¡Exito!","Rubro registrado");
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
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
            setTimeout(() => {
              form('pda/rubros.php');
            }, 4000);
            
        },
        error: function(error){
          console.log(error);
          toastr["warning"]("Usar otro nombre de acrónimo", "Acrónimo duplicado")
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
    }else{
        toastr["error"]("¡Error campos vacios!","Rubro no registrado");
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
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