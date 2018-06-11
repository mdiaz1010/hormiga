<form name="registrarNotasConf" id="registrarNotasConf" method='POST' >
                          <input type="hidden" name="grado" id="grado" value="<?=$bodyData->datos_usuario['grado']?>">

                          <input type="hidden" name="curso" id="curso" value="<?=$bodyData->datos_usuario['curso']?>">
                          <input type="hidden" name="nota" id="nota" value="<?=$bodyData->datos_usuario['nota']?>">
                          <input type="hidden" name="profesor" id="profesor" value="<?=$bodyData->datos_usuario['profesor']?>">
                          <input type="hidden" name="ano" id="ano" value="<?=$bodyData->datos_usuario['ano']?>">
<table class="table table-bordered" border="1" cellspacing="0" width="80%" id="configuracion" name="configuracion">
                                <thead style="color: #fff;background-color: #2A3F54;" >
                                    <tr>
                                            <th ><center>Abreviacion</center>          </th>
                                            <th  ><center>Descripcion</center>        </th>
                                            <th  ><center>Peso</center>   </th>
                                            <th  ><center>Opciones</center>   </th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $i=0; foreach($bodyData->datos as $dato): ?>
                                              <tr id="<?=$dato['abreviacion']?>" bgcolor="#E0ECF8">
                                                    <td><CENTER><?=$dato['abreviacion'];?> </CENTER></td>
                                                    <td><CENTER><?=$dato['descripcion'];?> </CENTER></td>
                                                    <td><CENTER><?=$dato['peso']*100;?>% </CENTER></td>
                                                    <td >
                                                        <CENTER>
                                                            <input name="txtmarcado[]" id="txtmarcado" data-codigo='<?=$dato['abreviacion'];?>' data-peso='<?=$dato['peso']*100?>' class='eliminarPeso' type="checkbox">
                                                            <input type="hidden" name="abre[]" id="abre" value="<?=$dato['abreviacion'];?>">
                                                        </CENTER>
                                                    </td>
                                              </tr>
                                     <?php endforeach; ?>
                                </tbody>
                                <input type="hidden" name="not" id="not" >
                                <input type="hidden" name="descontar" id="descontar" >

</table>
</form>
<div class="container">
    <center>
        <strong>
            <h5><?=$bodyData->formula?></h5>
        </strong>
    </center>
</div>
<script>
$(".eliminarPeso").click(function(){
var arrayMarcado=[];
var arrayPeso=0;
var arrayTotal=[];
$("input[name='abre[]']").each(function() {
        var value       = $(this).val();
        arrayTotal.push(value);

    });

//nuevo
$("input[name='txtmarcado[]']:checked").each(function() {
        var value       = $(this).val();
        var codigo      = $(this).data('codigo');
        var peso        = $(this).data('peso');
                        arrayPeso=parseInt(arrayPeso)+parseInt(peso);
          var color=              arrayMarcado.push(codigo);

    });
for(var i=0; i<arrayMarcado.length;i++){
    $("#"+arrayMarcado[i]).attr("bgcolor","#F8E0E0");
}
var difference = [];


jQuery.grep(arrayTotal, function(el) {
    if (jQuery.inArray(el, arrayMarcado) == -1) difference.push(el);
});

for(var j=0; j<difference.length;j++){
    $("#"+difference[j]).attr("bgcolor","#E0ECF8");
}
list_final= arrayMarcado.join();
var grado=$("#grado").val();
var curso=$("#curso").val();
var nota=$("#nota").val();
var codigo = $(this).data('codigo');
cod='';
$("#not").val(list_final);
$("#descontar").val(parseInt(arrayPeso));

$("#not").val();
var profesor=$("#profesor").val();

});
</script>
