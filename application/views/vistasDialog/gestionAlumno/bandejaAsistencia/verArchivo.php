 <?php 
if (count($bodyData->results)==0 || $bodyData->results==0) {
    echo "<div class='alert_result'>No se encontro ningun material registrado.</div>";
} else {
    ?>
    <div class="col-md-12">
 <?php foreach ($bodyData->results as $result) {
        if (substr($result->nombre, -4)=='docx') {
            $resultado=base_url("temp/word.png");
        } elseif (substr($result->nombre, -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -3)=='xls') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -3)=='pdf') {
            $resultado=base_url("temp/pdf.png");
        } elseif (substr($result->nombre, -4)=='pptx') {
            $resultado=base_url("temp/ppt.png");
        } elseif (substr($result->nombre, -3)=='txt') {
            $resultado=base_url("temp/txt.png");
        } else {
            $resultado= base_url(trim($result->ruta));
        } ?>
  <div class="col-md-4">
    <div id="centrador" class="thumbnail"> 
    <div class="list-group right">                                  
                  <a href="javascript:" data-id="<?=$result->id?>"  data-ruta="<?=$result->ruta?>" data-fec="<?=$result->fecha_jus?>"  class="btn btn-danger  eliminarMaterial"  style='width:30px; height:30px' class="img-responsive center-block"><span class="fa fa-trash-o"></span></a>                
    </div>              
                <a  href="<?= base_url(trim($result->ruta))?>"  target="_blank" style=" outline: none;"   class="img-rounded">
		<img id="imagen" src="<?= $resultado; ?>" class="img-responsive center-block" align="top" alt="Lights" style="width:100%" />
                    <div class="caption">
                        <font style="font-style: italic;"><strong><?=$result->nombre.'<br>'.$result->fec_creacion?></strong></font>
                    </div>
                </a>                
    </div>    
  </div>


	

<?php
    } ?>
    </div>
<?php
}
?>
<div id="DIVELIMINARMATERIAL1" title="INTRANET EDUCATIVA :: ELIMINAR MATERIAL"></div>
<style>
.right{
    float: right;    
}    
.left{
    float: left;    
}    
#centrador{
  text-align: center;
  width: 150px;
  height: 280px;  
}
#imagen{
    width: 100px;
}    
</style>  
<script type="text/javascript">
                $("#DIVELIMINARMATERIAL1").dialog({
                    autoOpen: false,
                    hide:"drop",
                    width: 340,
                    height: 130,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                    $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();  },
                    modal: true,
                    buttons: {
                        "SI": function() {
                                var ide= $("#codigo").val();                               
                                var fecha= $("#fecha").val();                               
                                var ruta= $("#ruta").val();        
                                $.ajax({
                                    type: 'POST',
                                    url:   "eliminarMaterialesAs",
                                    data: {codigo:ide,ruta:ruta},
                                    success: function(){
                                    $("#DIVVERASISTENCIA").load("verAsistenciaAl", $.param({ id: ide,fecha:fecha }));
                                    }
                                    });
                                $(this).dialog("close");
                                    },
                        "NO": function() {                                
                                $(this).dialog("close"); //Se cancela operación                              
                        }
                    }
                }); 
                
                $("#DIVELIMINARMATERIAL1").dialog({ draggable: false });
                $("#DIVELIMINARMATERIAL1").dialog({ resizable: false });                       	                
	$(".eliminarMaterial").click(function(){        
                var id   = $(this).data("id"); 
                var fec  = $(this).data("fec");
                var ruta = $(this).data("ruta");
                $.ajax({
                    type: 'POST',
                    url: "eliminarMaterialAs",
                    data:{id:id,fecha:fec,ruta:ruta},
                    success: function (datos) {
                        if(datos.length>0){
                        $('#DIVELIMINARMATERIAL1').html(datos);  
                        $('#DIVELIMINARMATERIAL1').dialog('open');                            
                        }
                        return false;
                    }                    
                });    
        });        
</script>