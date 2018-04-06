<?php




?>

 
    
    <center class="nombreUsuario" style=" ">
        <h3 class=" text-success" >Datos del Proyecto</h3>
    
        <form action="<?= site_url('Proyecto/editTareaPerfil')?>" method="post">
             <td><input type="hidden" name="id"  style='width:285px; height:35px' value="<?=$bodyData->valoresSueltos["id"]?>"  class="form-control" placeholder="Nombre y Apellido" required onkeyup="javascript:this.value=this.value.toUpperCase();"> </td>
            <table class="table-striped">
                <tr>
                    <td>Nombre de Tarea</td>
                   
                    <td><input type="text" name="nombreTarea" style='width:375px; height:35px' value="<?=$bodyData->valoresSueltos["nombreTarea"]?>"  class="form-control" placeholder="Nombre y Apellido" required onkeyup="javascript:this.value=this.value.toUpperCase();"> </td>
                </tr>

                    <td>Descripcion</td>
                    <td><input type="text" name="descripcion" style='width:375px; height:35px' value="<?=$bodyData->valoresSueltos["descripcion"]?>"  class="form-control" required  onkeyup="javascript:this.value=this.value.toUpperCase();"> </td>
                </tr>
                <tr>
                
                <tr></tr>
            
                <tr>
                    <td colspan="2" >
                        
                        <input type="submit" class="form-control submit btn-primary" value="Guardar"  >
                    </td>
                </tr>


            </table>

<br>


  



        </form>
             
    </center>
 <script>

 </script>