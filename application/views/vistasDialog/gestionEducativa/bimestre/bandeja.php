<?php ?>                                                                                        
                                <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" >
                                    <thead class="bg-success" >
                                                  <tr>
                                                     <th style="border: hidden;color: #3b752e;"><center>CODIGO      </center></th>
                                                     <th style="border: hidden;color: #3b752e;"><center>NOMBRE      </center></th>                                               
                                                     <th style="border: hidden;color: #3b752e;"><center>DESDE </center></th> 
                                                     <th style="border: hidden;color: #3b752e;"><center>HASTA    </center></th> 
                                                     <th style="border: hidden;color: #3b752e;"><center>OPCIONES    </center></th> 
                                                  </tr>
                                    </thead>                                   
                                    <tbody>                                               
                                            <?php  $i=0; foreach ($bodyData->bimestre as $bimestre) { ?>
                                                  <tr>  
                                                      <td><CENTER>BIM000<?=$bimestre->id  ?></CENTER></td>
                                                      <td><CENTER><?=$bimestre->nom_bimestre  ?></CENTER></td>
                                                      <td><CENTER><?=$bimestre->fecini_bimestre  ?></CENTER></td>
                                                      <td><CENTER><?=$bimestre->fecfin_bimestre  ?></CENTER></td>
                                                      <td><CENTER><a href="javascript:" class="btnEdicionB"   data-id ="<?=$bimestre->id?>">Editar</a> 
                                                                  <a href="javascript:" class="btnEliminarB"  data-ide="<?=$bimestre->id?>">Eliminar</a></CENTER></td>
                                                  </tr>
                                            <?php  $i++;                                       } ?>                                                                                  
                                    </tbody>
                                </table>

                        
                        
<div id="DIVELIMINARBIMESTRE" title="INTRANET EDUCATIVA :: ELIMINAR SEMESTRE"></div>
<div id="DIVEDITARBIMESTRE"   title="INTRANET EDUCATIVA :: EDITAR   SEMESTRE"></div>
<script type="text/javascript">
        
	$(".btnEdicionB").click(function(){        
                var id = $(this).data("id"); 
                $.ajax({
                    type: 'POST',
                    url: "editarBimestre",
                    data: {id:id},
                    success: function (datos) {
                        if(datos.length>0){
                        $('#DIVEDITARBIMESTRE').html(datos);  
                        $('#DIVEDITARBIMESTRE').dialog('open');                            
                        }
                        return false;
                    }                    
                });    
        });

        $(".btnEliminarB").click(function(){ 
		var ide = $(this).data("ide");                             
                $.ajax({
                    type: 'POST',
                    url: "eliminarBimestre",
                    data:{ide:ide},
                    success: function (datos) {
                        if(datos.length>0){
                        $('#DIVELIMINARBIMESTRE').html(datos);  
                        $('#DIVELIMINARBIMESTRE').dialog('open');                            
                        }
                        return false;
                    }                    
                });    
        });            
              
                
                $("#DIVELIMINARBIMESTRE").dialog({
                    autoOpen: false,
                    hide:"drop",
                    width: 350,
                    height: 150,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                    $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();  },
                    modal: true,
                    buttons: {
                        "SI": function() {
                            var ide= $("#txtcodigo").val();
                                $.ajax({
                                    type: 'POST',
                                    url:   "eliminarBimestres",
                                    data: {ide:ide},
                                    success: function(){
                                    $("#DIVBIMESTRE").load("<?= site_url('GestionEducativa/bandejaBimestre/') ?>");    
                                    //$("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                                                            
                                    }
                                    });

                                $(this).dialog("close");
                                    },

                        "NO": function() {                                
                                $(this).dialog("close"); //Se cancela operación
                              
                        }
                    }
                });                    
                
                $("#DIVELIMINARBIMESTRE").dialog({ draggable: false });
                $("#DIVELIMINARBIMESTRE").dialog({ resizable: false });                       
	
		
                $("#DIVEDITARBIMESTRE").dialog({
                    autoOpen: false,
                    hide:"drop",
                    width: 350,
                    height: 240,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                    $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();  },
                    modal: true,
                    buttons: {
                        "SI": function() {
                                $.ajax({
                                    type: 'POST',
                                    url:   "editarBimestres",
                                    data: $("#editarbimestresal").serialize(),
                                    success: function(){
                                    $("#DIVBIMESTRE").load("<?= site_url('GestionEducativa/bandejaBimestre/') ?>");                                    
                                    //$("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                                                            
                                    }
                                    });                                            
                                    $(this).dialog("close");                                    
                                    },
                        "NO": function() {                                
                                $(this).dialog("close"); //Se cancela operación                              
                        }
                    }
                });                                    
                $("#DIVEDITARBIMESTRE").dialog({ draggable: false });
                $("#DIVEDITARBIMESTRE").dialog({ resizable: false });                                 
</script>