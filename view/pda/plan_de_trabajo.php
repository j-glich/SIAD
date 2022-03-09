<?php
  //include('../config/routes.php');
require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/controller/pda/cAsignacionActividad.php");
require_once($_SERVER['DOCUMENT_ROOT']."/new_ae/controller/cPeriodo.php");
$docentes = listar_docentes();
$periodos = listar_periodos();
?>
<div class="box box-solid">
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Plan de Trabajo</p></h4>
</div>
<!-- /.box-header -->
<div class="box-body" >
    <div class="row">
        <div class="col">
        <select name="cve_docente" id="cve_docente" class="form-control" style="width: 80%; font-size: 20px;" value="">
                <?php 
                foreach( $periodos as $filas_D){ ?>
                    <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                    $filas_D['anio'].'.-'. $filas_D['desc']  ?></option>   
                    <?php } //Fin del Select?>
        </select>
        </div>
        <div class="col">

        </div>
    </div>

    <table class="table table-striped">
    <tbody>
        <tr style="text-align: center; font-size: 20px;">
        <th style="width: 10%;">id_Docente</th>
        <th style="width: 40%;">Nombre</th>
        <th style="width: 10%;">Grado</th>
        <th style="width: 15%;">Acciones</th>
    </tr>
        <?php 
            foreach($docentes as $fila){
        ?>
        <tr style="text-align: center; ">
            <td aling="justify"><?php echo $fila['clave']  ?></td>
            <td aling="justify"><?php echo $fila['nombre1']  ?></td>
            <td aling="justify"><?php echo $fila['grado']  ?></td>
            <td style="text-align: center;">
            <button class="btn" 
            onclick="" id="generarPDF"> <i class="bi bi-filetype-pdf"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
            </svg>
            </button>
            </td>
        </tr>
        <?php } 
        ?>
    </tbody>
    </table>
    </form>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Buscar perido 
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- /.box-body -->
</div>
<script type="text/javascript">

    $(document).on("click", "#generarPDF", function(e){
    e.preventDefault();

  
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    
    var doc = new jsPDF();
    //Logos
    var logo = new Image();
    logo.src = '../public/img/sep.jpg';    
    doc.addImage(logo, 'JPG', 8, 5,25,10);
    logo.src = '../public/img/Tec.png';   
    doc.addImage(logo, 'PNG', 40, 5,40,10);
    logo.src = '../public/img/itsoeh.jpg';    
    doc.addImage(logo, 'JPG', 85,0,40,20);
    logo.src = '../public/img/estado.png';    
    doc.addImage(logo, 'PNG', 130, 5,40,10);
    logo.src = '../public/img/escudo.png';    
    doc.addImage(logo, 'PNG', 180, 5,10,10);
    //Titutlo del documeto
    doc.setFont('Arial','bold');
    doc.setFontSize(15);
    doc.text(34,23,'PLAN DE TRABAJO DE ACTIVIDADES SUSTANTIVAS');

    doc.setDrawColor(0,0,0);
    doc.setLineWidth(.2);
    doc.rect(58.5,22,90,20,"F");

      //linea superior
    doc.save(''+ id +'.pdf');   
    });
</script>


