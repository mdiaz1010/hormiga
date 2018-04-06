<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-bs/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')?>"  rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')?>" rel="stylesheet">



<!-- page content -->
<div class="row"   >
    
    
    
 
 
    
    
    
    
    
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h1 class="panel-title">Sistema Control Asistencia:  Procesar Data Individual </h1>
        </div>
     

        <div class="panel-body"> 
            
 
    
  <!-- Delimitadores -->
    
    <div class="row" style="margin-bottom: 40px;">
        <form action="<?= site_url("Evento/asistencia") ?>" method="post">


            <div class="col-xs-12 col-sm-6 col-md-3">    
                <div class="row"> 
                  <label  >Filtro por Usuario (ID)</label>
                </div>
                <div class="row">
                    <input class="form-control" style="max-width: 80%;" type="text" id="delimitadorUsuarioId" name="delimitadorUsuarioId" placeholder="Id del Usuario"> 
                </div>  
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">    
                <div class="row"> 
                  <label >Locacion</label>
                </div>
                <div class="row">
                    <select name="delimitadorLocacion[]" multiple="multiple" class="form-control">
                        <!--<option selected="selected" value="">Todos</option> -->
                        <?php
                            foreach ($bodyData->locations as $locationsTemp) {
                                echo '<option value="'.$locationsTemp->cplt_id.'">'.$locationsTemp->cplt_name.'</option>';
                            }
                        ?>

                    </select> 
                </div>  
            </div> 
            
            <div class="col-xs-12 col-sm-6 col-md-3">    
                <div class="row"> 
                  <label >Seccion</label>
                </div>
                <div class="row">
                    <select name="delimitadorDivision[]" multiple="multiple" class="form-control"> 
                        <?php
                            foreach ($bodyData->Division as $cDivisionTemp) {
                                echo '<option value="'.$cDivisionTemp->cpds_id.'">'.$cDivisionTemp->cpds_name.'</option>';
                            }
                        ?>
                    </select> 
                </div>  
            </div> 
            
            <div class="col-xs-12 col-sm-6 col-md-3">    
                <div class="row"> 
                  <label >Departamento</label>
                </div>
                <div class="row">
                    <select name="delimitadorDepartament[]" multiple="multiple" class="form-control"> 
                        <?php
                            foreach ($bodyData->departament as $departamentTemp) {
                                echo '<option value="'.$departamentTemp->cpdt_id.'">'.$departamentTemp->cpdt_name.'</option>';
                            }
                        ?>
                    </select> 
                </div>  
            </div> 
            
            <div class="col-xs-12 col-sm-6 col-md-3">    
                <div class="row"> 
                  <label >Ordenar Por</label>
                </div>
                <div class="row">
                    <select name="delimitadorOrden"  class="form-control"> 
                        <option value="">Ordenar Por</option>
                        <option value="1">ID</option>
                        <option value="2">Nombre</option>
                       <!-- <option value="3">Apellido</option>-->
                    </select> 
                </div>  
            </div> 

            <div class="col-xs-12 col-sm-3 col-md-3" style="margin: 15px">   
                <div class="row">
                    <input class="form-control btn btn-info" style="max-width: 80%;" type="submit"  value="Buscar"  > 
                </div>  
            </div>

        </form>
    </div>
  
        </div>
    </div>
</div> 

    
    
   <!-- Registros -->
   <div class="row"  > 
        <div class="panel panel-success">
            <!-- Default panel contents -->
            <div class="panel-heading">Lista de Usuarios Delimitada</div>
            <div class="panel-body">
                
                <center>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                          <?= $bodyData->paginador ?>
                        </ul>
                    </nav>
                </center>
 
                
                <!-- Table -->
                <table class="table   table-striped table-responsive" style="font-size: 0.9em;">
                    <thead >
                        <tr> 
                            <th>Id Usuario</th>
                            <th>Nombre de Usuario</th>
                            <th>Locacion</th>
                            <th>Seccion</th>
                            <th>Departamento</th>
                            <th>Horario</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody> 
                    <?php
                    foreach ($bodyData->user as $usuarioTemp) {   ?>   
                        <tr    > 
                            <td  ><?=$usuarioTemp->user_id  ?> </td>
                            <td><?=$usuarioTemp->user_name ?> </td>
                            <td><?=$usuarioTemp->cplt_name ?> </td>
                            <td><?=$usuarioTemp->cpds_name ?> </td>
                            <td><?=$usuarioTemp->cpdt_name ?> </td>
                            <td><?=$usuarioTemp->user_name ?> </td>
                            <td><a style="color:#00aeef " name="revisionClick" href="javascript:void(0)" data-id="<?=$usuarioTemp->user_id?>" >Procesar</a></td>
                        </tr>
                    <?php } ?> 
                    </tbody>
                </table>

                <center>
                    <nav aria-label="Page navigation">
                        <ul class="pagination  ">
                            <?= $bodyData->paginador ?>
                        </ul>
                    </nav>
                </center>
            </div>
        </div>
       
        
    </div>
 
<!-- /page content -->
 

<!-- MODALS --> 

<!--  MODAL DE DELIMITADOR DE FECHAS -->
<div class="modal fade" id="delimitadorFechaModal" tabindex="-1" role="dialog" aria-labelledby="delimitadorFechaModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="delimitadorFechaModalLabel">Seleccion de Fecha</h4>
      </div>
      <div class="modal-body">
        
          
          
        <div class="row">  
            <div class="col-xs-12 col-sm-6 ">    
                <div class="row"> 
                    <label >Fecha Inicio</label>
                </div>
                <div class="row">
                    <fieldset>
                      <div class="control-group">
                        <div class="controls">
                          <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="delimitadorFechaDesde" name="delimitadorFechaDesde" placeholder="Fecha" aria-describedby="delimitadorFechaDesdeStatus">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="delimitadorFechaDesdeStatus" class="sr-only">(success)</span>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                    <!--<label  class="fuente_small">(aaaa/mm/dd)</label>-->
                </div>  
            </div>


            <div class="col-xs-12 col-sm-6 ">    
                <div class="row"> 
                  <label >Fecha Hasta</label>
                </div>
                <div class="row">
                    <fieldset>
                      <div class="control-group">
                        <div class="controls">
                          <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="delimitadorFechaHasta" name="delimitadorFechaHasta" placeholder="Fecha" aria-describedby="delimitadorFechaHastaStatus">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="delimitadorFechaHastaStatus" class="sr-only">(success)</span>
                          </div>
                        </div>
                      </div>
                    </fieldset>
                    <!--<label  class="fuente_small">(aaaa/mm/dd)</label>-->
                </div>  
            </div>
        </div>
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="delimitadorFechaModalProcesar" type="button" class="btn btn-primary">Procesar</button>
      </div>
    </div>
  </div>
</div>

<!--  MODAL DE LISTA DE REGISTROS -->
<div class="modal   fade" id="RegistrosModal" tabindex="-1" role="dialog" aria-labelledby="RegistrosModalLabel" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--<div class="modal-header ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="RegistrosModalLabel">Registros</h4>
      </div>-->
        <div class="modal-body"  style="overflow-y: auto;">
            <center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'
          <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->
      </div>
      <div class="modal-footer">
          <div class="row">
              <div class="col-sm-9 nombre" style="text-align: left;">
                  
              </div>
                <div class="col-sm-3">
                    <form  >
                        <input type="hidden" name="desde">
                        <input type="hidden" name="hasta">
                        <input type="hidden" name="id">
                        <select name="minFormat"   > 
                            <option value="0">Minutos</option>
                            <option value="1">Horas</option>
                        </select>
                         
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <a id="RegistrosModalImprimir" href="" target="_blank" type="button" class="btn btn-primary">Imprimir</a>
                    </form>
                </div>
        </div>
      </div>
    </div>
  </div>
</div>
  

 
<script>
    /*formato de minutos */    
$(document).ready(function() {
    var checbox = $('#RegistrosModal .modal-footer [name="minFormat"]'); 
    
    checbox.change(function(){
        var camposMinutos =  $('#RegistrosModal [data-type="min"]'); 
        if(checbox.val()==1){
            $( camposMinutos ).each(function( index ) {
                if(parseInt( $( this ).text()) === 'NaN' ){
                    return;
                }
                var valor = parseInt( $( this ).text() );
                var hora = Math.trunc( valor/60 );
                var minutos = valor%60;
                var segundos = "00" ;
                var pad = "00" ;
                minutos  = pad.substring(0, pad.length - minutos.length) + minutos ;
                hora     = pad.substring(0, pad.length - hora.length) + hora ; 
                var text = hora+":"+minutos+":"+segundos; 
                $( this ).text(text);
            });
        }else if(checbox.val()==0){
            $( camposMinutos ).each(function( index ) {                 
                var valor = $( this ).text() ;
                valor = valor.split(":");
                if(  $( this ).text().search(":")   === -1 ){ 
                    return;
                } 
                var hora = Math.trunc( valor[0]*60 );
                var text = parseInt(hora)+parseInt(valor[1]) ; 
                $( this ).text(text); 
                
            });
        }
    });
}); 
</script>

<script>
    /*LIMPIEZA */
$(document).ready(function() {
    $('#delimitadorFechaModal').on('hidden.bs.modal', function (e) {
        /*LIMPIAR DISPARADORES */
        $(this).find('button').unbind(); 
    });
    $('#RegistrosModal').on('hidden.bs.modal', function (e) {
        /*LIMPIAR DISPARADORES */
        $(this).find('button').unbind(); 
        $(this).find('.modal-body').html('<center><img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80" ></center>'); 
        $(this).find('.modal-footer .nombre').html('');
    });
});
</script>

<!-- /MODALS -->

<script>
$(document).ready(function() {
    
    $('tr').find('[name="revisionClick"]').click(function($element){
        var id = $(this).attr("data-id");
        var desde ;
        var hasta ;
        $('#delimitadorFechaModal').modal('show');
        $('#delimitadorFechaModalProcesar').click(function(){
            $('#delimitadorFechaModal').modal('hide');
            hasta = $('#delimitadorFechaHasta').val();
            desde = $('#delimitadorFechaDesde').val();
            
            $( "#RegistrosModal" ).modal('show'); 
            cargarData(desde,hasta,id);
        });
    });
               
    function cargarData (desde,hasta,id){
        $.ajax({
            url: "<?= site_url('evento/MakeAsistencia') ?>",
            method: "POST",
            data: { id : id,desde: desde,hasta:hasta },
            dataType: "html"
        }).done(function( msg ) {
            var height = $(window).height() * 0.65 ;
            //alert(height+" "+$(window).height() );
            var width = $(window).width()  * 0.80 ;
            var modal = $( "#RegistrosModal" );
            modal.find('.modal-body') .html( msg );
            modal.find(".modal-dialog").css("width","90%");
            modal.find('.modal-dialog').css({"max-height":height   } );
            modal.find('.modal-body').css({"max-height":height*0.8   } );
            
           // desde.replace('/','')
            $('#RegistrosModalImprimir').attr('href','<?= site_url('reporte/libroAsistencia')?>/'+desde.replace( /\//g ,'')+'/'+hasta.replace(/\//g,'')+'/'+id );
            
            
            modal.modal('handleUpdate');
            
            var htmlHead = modal.find('.modal-body .panel-heading').html(); 
            modal.find('.modal-footer .nombre').prepend(''+htmlHead+'');
            
            
        }).fail(function( jqXHR, textStatus ) {
            //alert(jqXHR.responseText );
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            } 
            var modal = $( "#RegistrosModal" );
            modal.find('.modal-body') .html( "<p>"+msj+" </p>" );
        });
        
        
        //alert(desde+hasta+id);
    }
    

    
});
</script>



<!-- bootstrap-daterangepicker Modal -->
<script src="<?= base_url('publico/html_libs/moment/min/moment.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/bootstrap-daterangepicker/daterangepicker.js')?>"></script> 
<script>
$(document).ready(function() {
    var optionSet1 = { 
    endDate: moment(),
    minDate: '01/01/2012',
    maxDate: '12/31/2055',
    showDropdowns: false,
    showWeekNumbers: false,// mostrar semanas 
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    singleDatePicker: true,
    singleClasses: "picker_3",

    opens: 'left',
    buttonClasses: ['btn btn-default'],
    applyClass: 'btn-small btn-primary',
    cancelClass: 'btn-small',
    format: 'YYYY/MM/DD', 
    separator: ' Al ',
    locale: {
        applyLabel: 'Enviar',
        cancelLabel: 'Limpiar',
        fromLabel: 'Desde ',
        toLabel: 'Al',
        customRangeLabel: 'Custom',
        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Augosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        firstDay: 1,
        weekLabel: 'S',
        format: 'YYYY/MM/DD', 
        startDate: moment().subtract(29, 'days'),
        }         
    }; 

    var delimitadorFechaDesde = $('#delimitadorFechaDesde');
    var delimitadorFechaHasta = $('#delimitadorFechaHasta');

    delimitadorFechaDesde.daterangepicker(optionSet1, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
    });
    delimitadorFechaHasta.daterangepicker(optionSet1, function(start, end, label) {
      console.log(start.toISOString(), end.toISOString(), label);
    }); 

    delimitadorFechaDesde.change(function(){
        var hasta = new Date(delimitadorFechaHasta.val()).getTime() / 1000 ;
        var desde = new Date(delimitadorFechaDesde.val()).getTime() / 1000 ;
        if(hasta < desde){ 
            var fecha = delimitadorFechaDesde.val();
            delimitadorFechaHasta.val(fecha);
            delimitadorFechaHasta.data('daterangepicker').setStartDate(fecha);
            delimitadorFechaHasta.data('daterangepicker').setEndDate(fecha); 
        }
    });
    delimitadorFechaHasta.change(function(){
        var hasta = new Date(delimitadorFechaHasta.val()).getTime() / 1000 ;
        var desde = new Date(delimitadorFechaDesde.val()).getTime() / 1000 ;
        if(hasta < desde){
            var fecha = delimitadorFechaHasta.val();
            delimitadorFechaDesde.val(fecha);
            delimitadorFechaDesde.data('daterangepicker').setStartDate(fecha);
            delimitadorFechaDesde.data('daterangepicker').setEndDate(fecha);  
        }
     
    });

  }); 
</script>
<!-- /bootstrap-daterangepicker Modal -->


<div class="row" style="    padding: 40px;"></div>