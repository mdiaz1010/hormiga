<?php ?>   
    <div class="row">
      
        
                        <div class="panel-heading">
                            <h1 class="panel-title"><strong><center>GESTION DE GRADOS</center></strong></h1>
                        </div>
        <form action="" method="post" name="grado" id="grado" >        
            <table class="col-lg-12">
            <tr>
                <td class="col-lg-3"><label>Grado:</label></td><td></td>
                <td class="col-lg-3"><input  type="text"   class="form-control"  id='txtgrado'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtgrado"   size="2" required  ></td>
                <td class="col-lg-3"><label>Descripcion:</label></td>
                <td class="col-lg-3"><input type="text"    class="form-control"  id='txtdescr'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name='txtdescr'    size="10" required></td>                
                <td class="col-lg-3"><input type="button"    id='btnGrado'   name='btnGrado'   class="form-control btn-danger" value="Registrar Grado" width="80" height="80" ></td>                                                        
            </tr>
            </table>
        </form>                                                                             
   </div>
<br>
                        <div id="DIVGRADO">Cargando...</div>
<script type="text/javascript">
    //carga en la primera vista
             $.ajax({
                type : "GET",
                url : "<?=site_url('GestionEducativa/bandejaGrado/')?>",
                success : function(datos){                    
                    $('#DIVGRADO').html(datos);
                    return false;
                }
            });         
$("#btnGrado").click(function(){
var grado= $("#txtgrado").val();
if(grado===''){
    alert("Ingresar Grado:"); 
}else{
             $.ajax({
                type : "POST",
                url : "<?=site_url('GestionEducativa/insertarGrado')?>",
                data: $("#grado").serialize(),
                success : function(datos){        
                    
                    $("#DIVGRADO").load("<?= site_url('GestionEducativa/bandejaGrado/') ?>");     
                    $("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                                        
                    $("#txtdescr").val('');
                    $("#txtgrado").val('');
                    return false;
                }
            });        
            }        
});



</script>