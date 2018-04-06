<?php ?>
        <div class="panel-heading">
                            <h1 class="panel-title"><strong><center>EDICION DE GRADOS DE GRADOS</center></strong></h1>
        </div>
        <form action="" method="post" name="editargradosa1" id="editargradosa1" >        
            <table class="col-lg-12">                
            <tr>
                <td class="col-lg-3"><label>Codigo:</label></td>
                <td class="col-lg-3"><input  type="text"     id='txtcodigos'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcodigos"   size="20"    value="GRAD000<?php echo $bodyData->datos["id"]?>" readonly ></td></tr>
                                     <input   type="hidden"  id='txtcodigogrado'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcodigogrado"   size="20"      value="<?php echo $bodyData->datos["id"]?>" readonly >
            
            <tr>
                <td class="col-lg-3"><label>Grado:</label></td>
                <td class="col-lg-3"><input  type="text"     id='txtgrado'   style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtgrado"    size="20"    value="<?php echo $bodyData->datos["nom_grado"]?>" ></td>
            <tr>
            <tr> 
                <td class="col-lg-3"><label>Descripcion:</label></td>
                <td class="col-lg-3"><input type="text"      id='txtdescr'   style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name='txtdescr'    size="20"    value="<?php echo $bodyData->datos["des_grado"]?>"></td>                                
            </tr>
            </table>
        </form>