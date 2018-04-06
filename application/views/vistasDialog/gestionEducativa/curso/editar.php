<?php ?>
                        <div class="panel-heading">
                            <h1 class="panel-title"><strong><center>EDICION DE CURSOS</center></strong></h1>
                        </div>
        <form action="" method="post" name="editarcursosal" id="editarcursosal" >        
            <table class="col-lg-12">
                
            <tr>
                <td class="col-lg-3"><label>Codigo:</label></td>
                <td class="col-lg-3"><input  type="text"     id='txtcodigos' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcodigos"   size="20" value="CURS000<?php echo $bodyData->datos["id"]?>" readonly ></td></tr>
                                    <input  type="hidden"    id='txtcodigo'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcodigo"    size="20" value="<?php echo $bodyData->datos["id"]?>" readonly >
            <tr>
                <td class="col-lg-3"><label>Grado:</label></td>
                <td class="col-lg-3"><input  type="text"     id='txtcursos'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcursos"   size="20"    value="<?php echo $bodyData->datos["nom_cursos"]?>" ></td>
            <tr>
            <tr> 
                <td class="col-lg-3"><label>Descripcion:</label></td>
                <td class="col-lg-3"><input type="text"      id='txtdescr'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name='txtdescr'    size="20"   value="<?php echo $bodyData->datos["des_cursos"]?>"></td>                                
            </tr>

            </table>
        </form>