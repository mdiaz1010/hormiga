<?php

function listarEventos($marcas)
{
    foreach ($marcas as $eventoTemp) {
        ?>   
        <tr data-id="<?=$eventoTemp->id ?>">
            <td name="marcasDatetime" ><?=(new DateTime($eventoTemp->eventdatetime))->format('Y-m-d H:i:s ')?></td>
        <!--    <td><?= ''//date('Y-m-d H:i:s ', strtotime(substr($eventoTemp->systemdatetimemilisec,16)))?></td>-->
            <td name="marcasUserId" ><?=$eventoTemp->accessid ?> </td>
            <td name="marcasUserName" ><?=$eventoTemp->user_name ?>  </td>
            <td name="marcasController" ><?=$eventoTemp->controllername ?></td>
            <td name="marcasFunction"  ><?=$eventoTemp->functionkey  ?></td> 
            
        </tr>
    <?php
    }
}
?>



<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-bs/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')?>"  rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')?>" rel="stylesheet">
<link href="<?= base_url('publico/html_libs/dataTables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')?>" rel="stylesheet">





<!-- page content -->
<div class="row">
    
    <div class="panel panel-primary">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h1 class="panel-title">Sistema Control Asistencia - Eventlog </h1>
        </div>
     

        <div class="panel-body">
            <!-- Delimitadores -->
            <div class="row" style="margin-bottom: 5px;">
                <form action="<?= site_url("Evento/eventLog") ?>" method="post">
                    <div class="col-xs-12 col-sm-6 col-md-3">    
                        <div class="row"> 
                          <label >Fecha Inicio</label>
                        </div>
                        <div class="row">
                            <fieldset>
                              <div class="control-group">
                                <div class="controls">
                                  <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                      <input type="text" value="<?=(isset($bodyData->filtros->desde))?$bodyData->filtros->desde :'' ?>" class="form-control has-feedback-left" id="delimitadorFechaDesde" name="delimitadorFechaDesde" placeholder="Fecha" aria-describedby="delimitadorFechaDesdeStatus">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="delimitadorFechaDesdeStatus" class="sr-only">(success)</span>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                            <!--<label  class="fuente_small">(aaaa/mm/dd)</label>-->
                        </div> 
                        <!--
                         <div class=" col-xs-12 " >
                            <div class="checkbox  ">
                                <label> 
                                    <input type="checkbox" name="delimitadorMarcasUnicas" id="delimitadorMarcasUnicas" value="1" <?=($bodyData->filtros->marcasUnicas)? 'checked="checked"' :'' ?>   >
                                  Marcas Unicas (E/S)
                                </label>
                            </div> 
                        </div>
                        -->
                    </div>
 
                    <div class="col-xs-12 col-sm-6 col-md-3">    
                        <div class="row"> 
                          <label >Fecha Hasta</label>
                        </div>
                        <div class="row">
                            <fieldset>
                              <div class="control-group">
                                <div class="controls">
                                  <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                      <input type="text" value="<?=(isset($bodyData->filtros->hasta))?$bodyData->filtros->hasta :'' ?>"  class="form-control has-feedback-left" id="delimitadorFechaHasta" name="delimitadorFechaHasta" placeholder="Fecha" aria-describedby="delimitadorFechaHastaStatus">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="delimitadorFechaHastaStatus" class="sr-only">(success)</span>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                            <!--<label  class="fuente_small">(aaaa/mm/dd)</label>-->
                        </div>  
                    </div>
 <!--
                    <div class="col-xs-12 col-sm-6 col-md-3">    
                        <div class="row"> 
                          <label  >Filtro por Usuario </label>
                        </div>
                        <div class="row">
                            <input class="form-control" style="max-width: 80%;" type="text" id="delimitadorUsuarioId" name="delimitadorUsuarioId" placeholder="Id o Nombre"  value="<?=(isset($bodyData->filtros->usuario))?$bodyData->filtros->usuario :'' ?>" > 
                        </div>  
                    </div>
-->
                    <div class="col-xs-12 col-sm-6 col-md-3">    
                        <div class="row"> 
                          <label >Controladores</label>
                        </div>
                        <div class="row">
                            <select name="delimitadorControladores[]" id="delimitadorControladores" multiple="multiple" class="form-control">
                                <option selected="selected" value="">Todos</option>
                                <?php
                                    foreach ($bodyData->filtros->controllers as $controllersTemp) {
                                        echo '<option value="'.$controllersTemp->rid.'">'.$controllersTemp->controllername.'</option>';
                                    }
                                ?>
                            </select> 
                        </div>  
                    </div> 
                    
                    <div class=" row col-sm-6 col-md-6 ">
                        <div class="col-xs-12 col-sm-6 col-md-6">   
                            <div class="row">
                                <input class="form-control btn btn-info" style="max-width: 80%;" type="submit"  value="Generar Data"  > 
                            </div>  
                        </div>

                         
                    </div>
                   
                    
                    
                </form>
            </div>
    
        </div>
    </div>
</div>
 
    
<script>
$(document).ready(function() {    
    $('#exportarCas').click(function(e){
        var FechaDesde = $('#delimitadorFechaDesde').val();
        var Fechahasta = $('#delimitadorFechaHasta').val();
        var UsuarioId = $('#delimitadorUsuarioId').val();
        var Controladores = $('#delimitadorControladores').val();
        var MarcasUnicas = $('#delimitadorMarcasUnicas').val();
 
        //$(this).attr('href','<?= site_url('Evento/exportarCas')?>' );
        var newForm = $('<form>', {
            'action': "<?= site_url('Evento/exportarCas')?>",
            'method': 'POST',
        //    'target': '_top'
        }).append($('<input>', {
            'name': 'delimitadorFechaDesde',
            'value': FechaDesde.replace( /\//g ,''),
            'type': 'hidden'
        })).append($('<input>', {
            'name': 'delimitadorFechaHasta',
            'value': Fechahasta.replace( /\//g ,'') ,
            'type': 'hidden'
        })).append($('<input>', {
            'name': 'delimitadorUsuarioId',
            'value': UsuarioId,
            'type': 'hidden'
        })).append($('<input>', {
            'name': 'delimitadorControladores',
            'value': Controladores,
            'type': 'hidden'
        })).append($('<input>', {
            'name': 'delimitadorMarcasUnicas',
            'value': MarcasUnicas,
            'type': 'hidden'
        })).appendTo('body');
        $(newForm).submit() ;
        //alert(newForm.serialize()+ newForm);
        //return; 
         
    });
   
});
</script>
    
<!-- bootstrap-daterangepicker -->
<script src="<?= base_url('publico/html_libs/moment/min/moment.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/bootstrap-daterangepicker/daterangepicker.js')?>"></script> 

<script>
$(document).ready(function() {
    var optionSet1 = { 
    endDate: moment(),
    minDate: '01/01/2012',
    maxDate: moment(),
    showDropdowns: false,
    showWeekNumbers: true,// mostrar semanas 
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    singleDatePicker: true,
    singleClasses: "picker_3",

    opens: 'left' ,
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
    
    if(delimitadorFechaDesde.val()== null){
        delimitadorFechaDesde.daterangepicker(optionSet1, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
    }else{
        var temp = delimitadorFechaDesde.val();
        delimitadorFechaDesde.daterangepicker(optionSet1);
        delimitadorFechaDesde.data('daterangepicker').setStartDate(temp);
        delimitadorFechaDesde.data('daterangepicker').setEndDate(temp);
    }
    
    if(delimitadorFechaHasta.val()== null){
        delimitadorFechaHasta.daterangepicker(optionSet1, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        }); 
    }else{
        var temp = delimitadorFechaHasta.val();
        delimitadorFechaHasta.daterangepicker(optionSet1);
        delimitadorFechaHasta.data('daterangepicker').setStartDate(temp);
        delimitadorFechaHasta.data('daterangepicker').setEndDate(temp);
    }
        
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
     
     
 

   <!-- Registros -->
   <div class="row panel panel-primary"  > 
       
       <div class="panel-body"> 
        
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%">
            <thead class="bg-success"   >
                <tr   >
                    <th name="datatableFechaHora" style="border: hidden;color: #3b752e;" >Fecha Controlador</th>
                 <!--   <th style="border: hidden;color: #3b752e;">Fecha Sistema</th> -->
                    <th style="border: hidden;color: #3b752e;">Id Usuario</th>
                    <th style="border: hidden;color: #3b752e;">Nombre de Usuario</th>
                    <th style="border: hidden;color: #3b752e;">Controlador</th>
                    <th style="border: hidden;color: #3b752e;">Evento</th> 
                    
                </tr>
            </thead>
            <tbody> 
            <?php

            
            if (isset($bodyData->eventosOrganizados)) {  // echo '<tr><td>Organizado</td></tr>';
                foreach ($bodyData->eventosOrganizados as $eventosOrganizadosDias) {
                    foreach ($eventosOrganizadosDias as $eventosOrganizadosUsuario) {
                        listarEventos($eventosOrganizadosUsuario);
                    }
                }
            } else {
                listarEventos($bodyData->eventos);
            }
             
            ?> 
            </tbody>
        </table>  
    </div>
</div>

<script>
</script>
   
   
<!-- /page content -->

<script src="<?= base_url('publico/html_libs/dataTables/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons/js/buttons.flash.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-buttons/js/buttons.print.min.js')?>"></script>


<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-keytable/js/dataTables.keyTable.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-responsive-bs/js/responsive.bootstrap.js')?>"></script>
<script src="<?= base_url('publico/html_libs/dataTables/datatables.net-scroller/js/datatables.scroller.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/jszip/dist/jszip.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/pdfmake/build/pdfmake.min.js')?>"></script>
<script src="<?= base_url('publico/html_libs/pdfmake/build/vfs_fonts.js')?>"></script>
 

<script>
    $(document).ready(function() { 
        var handleDataTableButtons = function() {
            var datatableJs = $("#datatable-responsive");
            if (datatableJs.length) {
                var createObject = datatableJs.DataTable({
                    dom: "Bfrtipl",
                    buttons: [ 
                        { extend: "copy", className: "btn-sm" },
                        { extend: "csv", className: "btn-sm" },
                        { extend: "excel", className: "btn-sm" },
                        { extend: "pdfHtml5", className: "btn-sm" },
                        { extend: "print", className: "btn-sm" },
                    ],
                    language: {
                        search: "Buscar:",
                        paginate: {
                            first:      "Primer",
                            previous:   "Anterior",
                            next:       "Siguiente",
                            last:       "Ultimo"
                        }, 
                        sInfo: "Mostrando _START_ a _END_ de _TOTAL_ Registros ",
                        sInfoEmpty:" Sin Registros",
                        sLengthMenu : "Ver  _MENU_ Registros",
                        zeroRecords:  "Se han encontrado cero Registros",
                    },
                    responsive: true,
                //    columnDefs: [ { orderable: true, targets: [0] } ]
                });
                
                createObject.columns('[name="datatableFechaHora"]').order( 'desc' ).draw();

            }
          
                  
                //
        }; 
        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
                handleDataTableButtons(); 
            }
          };
        }(); 
        TableManageButtons.init();
    });
</script>




<div class="row" style="    padding: 40px;"></div>