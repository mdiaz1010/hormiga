<?php ?>
                        <div class="panel-heading">
                            <h1 class="panel-title"><strong><center>EDICION DE NOTAS</center></strong></h1>
                        </div>
        <form action="" method="post" name="editarnotasal" id="editarnotasal" >        
            <table class="col-lg-12">
                
            <tr>
                <td class="col-lg-3"><label>Codigo:</label></td>
                <td class="col-lg-3"><input  type="text"     id='txtcodigos' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcodigos"   size="20" value="NOT000<?php echo $bodyData->datos["id"]?>" readonly ></td></tr>
                                    <input  type="hidden"    id='txtcodigo'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcodigo"    size="20" value="<?php echo $bodyData->datos["id"]?>" readonly >
            <tr>
                <td class="col-lg-3"><label>Nombre:</label></td>
                <td class="col-lg-3"><input  type="text"     id='txtnotas'   name="txtnotas"   size="20"    value="<?php echo $bodyData->datos["nom_notas"]?>" ></td>
            <tr>
            <tr> 
                <td class="col-lg-3"><label>Descripcion:</label></td>
                <td class="col-lg-3"><input type="text"      id='txtdesn'   name='txtdesn'    size="20"   value="<?php echo $bodyData->datos["des_notas"]?>"></td>                                
            </tr>
            <tr> 
                <td class="col-lg-3"><label>Peso:</label></td>
                <td class="col-lg-3"><input type="text"      id='txtpes'   name='txtpes'    size="20"   value="<?php echo $bodyData->datos["pes_notas"]?>"></td>                                
            </tr>
            </table>
        </form>