<script type="text/javascript" src="<?= base_url('publico/js/bootstrap-filestyle.min.js')?>"> </script> 
<div class="container"  id="materialDocentesubir" style="display:none;">  
                            <div class="list-group right" >
                                <a class="btn btn-danger btnArchivo" href="javascript:" data-grado="<?php echo $bodyData->GRADO?>" data-seccion="<?php echo $bodyData->SECCION?>"  data-curso ="<?php echo $bodyData->CURSOS?>" data-bimestre="<?php echo $bodyData->BIMESTRE?>" aria-label="Archivo" style="clear: right;">
                                  <i class="fa fa-pencil" aria-hidden="true" style="clear: right;" ></i>
                                </a>                       
                            </div>                                                
 <div id="bandejaMaterial2"></div>
 </div>  
<div id="DIVSUBIDA"   title="INTRANET EDUCATIVA :: SUBIR ARCHIVOS "></div>
 <div id="DIVcarga" title="EN PROCESO">
     <center><strong>Espere estamos cargando la informacion...</strong>
<span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
     </center>
 </div>
<script type="text/javascript">
$('#DIVcarga').dialog({
        autoOpen: false,
        hide:'drop',
        width: 360,
        height: 80,
        closeOnEscape: false,
        open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
        modal: true
	});        
    $('#DIVcarga').dialog({ draggable: false });
    $('#DIVcarga').dialog({ resizable: false });               
                                        
                $("#DIVSUBIDA").dialog({           
                    autoOpen: false,
                    hide:"drop",
                    width: 420,
                    height: 290,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                    $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();  },
                    modal: true,
                    buttons: {
                        "CARGAR ARCHIVO": function() {
                            var DocAdj = $("#docAdj").val();
                            if(DocAdj.length > 0){   
                                 var inputimage = document.getElementById('docAdj'),
                                
                                formdata = new FormData();   
                                var i = 0, len = inputimage.files.length, img, reader, file;
                                document.getElementById('response').innerHTML = 'Subiendo...';
                                for( ; i < len; i++){
                                file = inputimage.files[i];
                                if(formdata)
                                formdata.append('images[]', file);   
                                }
                                var seccion     =$("#txtseccion").val();                                
                                var grado       =$("#txtgrado").val();
                                var curso       =$("#txtcurso").val();
                                var bimestre    =$("#txtbimestre").val();
                                var descripcion =$("#txtdescripcion").val();
                                var txtarchivo  =$("#txtarchivo").val();
                                 formdata.append('txtseccion',seccion);
                                 formdata.append('txtgrado',grado);
                                 formdata.append('txtcurso',curso);
                                 formdata.append('txtbimestre',bimestre);
                                 formdata.append('txtdescripcion',descripcion);
                                 formdata.append('txtarchivo',txtarchivo);
                                $.ajax({
                                    type: 'POST',
                                    url:   "registrarArchivoProf",
                                    data: formdata,
                                    processData : false                         , 
                                    contentType : false                         ,                                     
                                    beforeSend: function(){     
                                    $("#DIVcarga").dialog("open");    
                                    },
                                    success: function () {
                                    $("#DIVcarga").dialog("close");
                                    $("#bandejaMaterial2").load("<?= base_url('GestionDocente/verbandejaprof') ?>",{curso:curso,grado:grado,seccion:seccion,bimestre:bimestre});                        
                                    }
                                    });
                                    }
                                    $(this).dialog("close");
                                    },
                        "CANCELAR": function() {                                
                                $(this).dialog("close"); //Se cancela operación                              
                        }
                    }
                });                                    
                $("#DIVSUBIDA").dialog({ draggable: false });
                $("#DIVSUBIDA").dialog({ resizable: false });  
                
	$(".btnArchivo").click(function(){            
            
		var curso   = $(this).data("curso");                             
                var grado   = $(this).data("grado");                             
                var seccion = $(this).data("seccion");   
                var bimestre = $(this).data("bimestre");   
                $.ajax({
                    type: 'POST',
                    url: "subirArchivoProf",
                    data: {curso:curso,grado:grado,seccion:seccion,bimestre:bimestre},
                    beforeSend: function () {
                    $("#DIVcarga").dialog("open");
                    },
                    success: function(datos){
                    $("#DIVcarga").dialog("close");    
                        if(datos.length>0){
                        $('#DIVSUBIDA').html(datos);  
                        $('#DIVSUBIDA').dialog('open');                            
                        }
                        return false;                        
                    }
                });
                                        });       
$(":file").filestyle({buttonName: "btn-primary"});
</script>
<style>
.right{
    float: right;
    
}    
.left{
    float: left;
    
}    
#centrador{
  text-align: center;
  width: 160px;
  height: 280px;
  
}

#imagen{
    width: 100px;
}    
</style>