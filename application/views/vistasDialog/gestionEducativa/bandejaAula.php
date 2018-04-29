            <form  method="post"  name="registraraula" id="registraraula">
                <div class="container" >
          
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Grado:
                    <select name="gradorol"  class="form-control" id='gradorol' required>
                        <option disabled selected></option>
                        <?php
                        foreach ($bodyData->rolesGrado as $rolesTemp) {
                            ?>
                            <option name='opciones' value="<?=$rolesTemp->id?>"><?=$rolesTemp->nom_grado?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Seccion:
                    <select name="seccionrol"  class="form-control" id='seccionrol' required>
                        <option disabled selected></option>
                        <?php
                        foreach ($bodyData->rolesSeccion as $rolesTemp) {
                            ?>
                            <option name='opciones' value="<?=$rolesTemp->id?>"><?=$rolesTemp->nom_seccion?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Curso:
                    <select name="cursorol"  class="form-control" id='cursorol' required>
                        <option disabled selected></option>
                        <?php
                        foreach ($bodyData->rolesCursos as $rolesTemp) {
                            ?>
                            <option name='opciones' value="<?=$rolesTemp->id?>"><?=$rolesTemp->nom_cursos?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>   
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    <br>
                    <textarea class="form-control  col-md-3" name="descripcion" id="descripcion" type="text" placeholder="Breve descripcion..." rows="1" ></textarea>
                </label>  
                </div>  
                <div class="container" >
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    
                    <button type="button" id='btn_horario'   name='btn_horario'   class="btn btn-round btn-danger" >HORARIO   <span class="glyphicon glyphicon-list"></span></button>                                        
                    <button type="button" id='btn_dias'      name='btn_dias'     class="btn btn-round btn-danger" >DIAS      <span class="glyphicon glyphicon-list"></span></button>                                        
                </label>                                                                                                                                                  
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    
                    
                </label>
                <label class="control-label col-md-9 col-sm-9 col-xs-12">
                    Profesor:
                    <input name="profesor" id="profesor" placeholder="PROFESOR"  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required >
                </label>                     
                </div>        
                <input type="hidden" name="horarioArray" id="horarioArray"  value=""    />     
                <input type="hidden" name="diasArray" id="diasArray"  value=""    />     
             <?php $i=0;  foreach ($bodyData->profesores as $profesores): ?>
            <input type="hidden" name="profesores[]" id="profesores<?php $i; ?>"  value="<?php echo $profesores->ape_pat_per ?>"    />
            <?php $i++; endforeach; ?>       
                <label class="col-xs-6 col-md-3">
                <p id="result_errors"></p>
                </label>            
            </form>
<div id='DIVcarga'          title="EN PROCESO ... "> Espere mientras se gestiona la informaci&oacute;n. <img src="<?= base_url('publico/media/loading.gif')?>"  width="20" height="20"></div>
<div id="ContainerHorario"  title="INTRANET EDUCATIVA :: GESTIONAR DE HORARIOS">          <strong>Cargando...</strong></div>
<div id="ContainerDias"     title="INTRANET EDUCATIVA :: GESTIONAR  DIAS">                <strong>Cargando...</strong></div>
<script type="text/javascript">
    
//autocompletar profesor
 	var profesores = [];
        
 		$("input[name='profesores[]']").each(function() {			
			var value = $(this).val();		    		   
		    	profesores.push(value);
		});            
                
    $( "#profesor" ).autocomplete({source:profesores,minLength: 5});

//HORARIO
//POP UP CARGA
 
   $('#DIVcarga').dialog({
        autoOpen: false,
        hide:'drop',
        width: 300,
        height: 150,
        closeOnEscape: false,
        open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
        modal: true,
        buttons: {
	        "CERRAR": function() {
	                $(this).dialog("close");                        
	        }
	    }
	});        
    $('#DIVcarga').dialog({ draggable: false });
    $('#DIVcarga').dialog({ resizable: false });
//POPUP HORARIO
    $('#ContainerDias').dialog({
    autoOpen: false,
    width:  530,
    height: 460,
            modal: true,
    closeOnEscape: false,
            open: function(evnt, ui) { $(".ui-dialog-titlebar-close").hide(); },
            buttons: {
            "ACEPTAR": function() {
        var selected = '';    
        $('#formdias input[type=checkbox]').each(function(){
            if (this.checked) {
                selected += ', '+$(this).val();

            }
        }); 
              var escogidos=  selected.substr(1);
                
                $("#diasArray").val(escogidos);
        if (selected != '') 
        {
           
        }
                        $(this).dialog("close");

                },                
            "CERRAR": function() {

                        $(this).dialog("close");

                }
            }
    });
    $('#ContainerDias').dialog({ draggable: false });
    $('#ContainerDias').dialog({ resizable: false });      
    
    $('#ContainerHorario').dialog({
    autoOpen: false,
    width:  520,
    height: 475,
            modal: true,
    closeOnEscape: false,
            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
            buttons: {
            "ACEPTAR": function() {
        var selected = '';    
        $('#formhorario input[type=checkbox]').each(function(){
            if (this.checked) {
                selected += ', '+$(this).val();

            }
        }); 
              var escogidos=  selected.substr(1);
                
                $("#horarioArray").val(escogidos);
        if (selected != '') 
        {
            
        }
          
                        $(this).dialog("close");

                },                
            "CERRAR": function() {

                        $(this).dialog("close");

                }
            }
    });
    $('#ContainerDias').dialog({ draggable: false });
    $('#ContainerDias').dialog({ resizable: false });      
    
    // boton SECCION
    $("#btn_horario").click(function(){
    $('#ContainerHorario').html('Cargando...');        
        $.ajax({
                        type: "POST",           
                        url: 'mostrarHorario',                                    			
			beforeSend : function(datos){                                     
			    $('#DIVcarga').dialog('open');
			},
			success : function(datos){
			    $('#DIVcarga').dialog('close');
			    $('#ContainerHorario').html(datos);			    			    
			    $('#ContainerHorario').dialog('open');
			    
			    return false;
			}
        });                  
    });
    $("#btn_dias").click(function(){
    $('#ContainerDias').html('Cargando...');        
        $.ajax({
                        type: "POST",           
                        url: 'mostrarDias',                                    			
			beforeSend : function(datos){                                     
			    $('#DIVcarga').dialog('open');
			},
			success : function(datos){
			    $('#DIVcarga').dialog('close');
			    $('#ContainerDias').html(datos);			    			    
			    $('#ContainerDias').dialog('open');
			    
			    return false;
			}
        });                  
    });    
</script>