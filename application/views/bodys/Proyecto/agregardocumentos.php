<?php
?>
<div class="container">
    <form name="form_1" id="form_1"  method="POST"  enctype="multipart/form-data">
<a href="#"><strong>VER FICHA INFORMATIVA*</strong> </a>
<input name="proyecto_id" id="proyecto_id" type="hidden" value="<?=$bodyData->valoresSueltos["id"] ?>" >
<br>
<h4><strong>Documentos de Cobranza</strong></h4>
<table>
  
<tr>
<td>Liquidacion: </td>
<td><input name="solicitud" type="file" ></td>
</tr>
<tr>
  <td>Fac:</td>
  <td><input name="informeprevio" type="file" ></td>
</tr>
<tr>
  <td>Solicitudes:</td>
  <td><input name="documentoadicion" type="file" ></td>  
</tr>
<tr>
  <td>Aprobaciones:</td>
  <td><input name="aprobaciones" type="file" ></td>  
</tr>
<tr>
  <td>Factura:</td>
  <td><input name="ordendecompra" type="file" ></td>  
</tr>

 


</table>
<button type="button" name="btn_docpre" id="btn_docpre" class="btn btn-primary">Guardar</button>
  </form>

       <p id='result_clave' class="help-block"></p>



    <form  action="<?= site_url('Upload/documentosEjecucion')?>"   method="POST"  enctype="multipart/form-data">
   
 <input name="proyecto_id1" id="proyecto_id1" type="hidden" value="<?=$bodyData->valoresSueltos["id"] ?>" >
  
<h4><strong>Documentos de Control</strong></h4>
<table>
<tr>
<td>FCI: </td>
<td><input name="solicitudingreso" type="file" ></td>
</tr>
<tr>
  <td>Eval.Satisfaccion:</td>
  <td><input name="sctr" type="file" ></td>
</tr>

</table>
  <button type="button"  name="btn_docpre1" id="btn_docpre1" class="btn btn-primary">Guardar</button>

    </form>
       <p id='result_clave1' class="help-block"></p>    

 
              <p id='result_clave2' class="help-block"></p>
  </div>
<div class="container">
    <form name="form_1" id="form_1"  method="POST"  enctype="multipart/form-data">
<a href="#"><strong>VER FICHA INFORMATIVA*</strong> </a>
<input name="proyecto_id" id="proyecto_id" type="hidden" value="<?=$bodyData->valoresSueltos["id"] ?>" >
<br>
<h4><strong>Documentos Previos</strong></h4>
<table>
  
<tr>
<td>Solicitud: </td>
<td><input name="solicitud" type="file" ></td>
</tr>
<tr>
  <td>Informe previo:</td>
  <td><input name="informeprevio" type="file" ></td>
</tr>
<tr>
  <td>Documentos Adicion:</td>
  <td><input name="documentoadicion" type="file" ></td>  
</tr>
<tr>
  <td>Aprobaciones:</td>
  <td><input name="aprobaciones" type="file" ></td>  
</tr>
<tr>
  <td>Orden de Compra:</td>
  <td><input name="ordendecompra" type="file" ></td>  
</tr>
<tr>
  <td> N°Orden de Compra:</td>
  <td><input name="numOrden" type="text" placeholder="N° orden" ></td>  
</tr>
<tr>
  <td> Monto Cotizacion:</td>
  <td><input name="monto" type="text" placeholder="Monto cotizacion" ></td>  
</tr>

 


</table>
<button type="button" name="btn_docpre" id="btn_docpre" class="btn btn-primary">Guardar</button>
  </form>

       <p id='result_clave' class="help-block"></p>



    <form  action="<?= site_url('Upload/documentosEjecucion')?>"   method="POST"  enctype="multipart/form-data">
   
 <input name="proyecto_id1" id="proyecto_id1" type="hidden" value="<?=$bodyData->valoresSueltos["id"] ?>" >
  
<h4><strong>Documentos de ejecucion</strong></h4>
<table>
<tr>
<td>Solicitud de ingreso: </td>
<td><input name="solicitudingreso" type="file" ></td>
</tr>
<tr>
  <td>SCTR:</td>
  <td><input name="sctr" type="file" ></td>
</tr>
<tr>
  <td>Cronograma:</td>
  <td><input name="cronograma" type="file" ></td>  
</tr>
<tr>
  <td>Solicitud de logística:</td>
  <td><input name="solicitdlogistica" type="file" ></td>  
</tr>
</table>
  <button type="button"  name="btn_docpre1" id="btn_docpre1" class="btn btn-primary">Guardar</button>

    </form>
       <p id='result_clave1' class="help-block"></p>    

 <form   name="form_2" id="form_2"   method="POST"  enctype="multipart/form-data">
   
 
<input name="proyecto_id2" id="proyecto_id2" type="hidden" value="<?=$bodyData->valoresSueltos["id"] ?>" >      
<h4><strong>Documentos de informacion</strong></h4>
<table>
<tr>
<td>Informe final: </td>
<td><input name="informefinal" type="file" ></td>
</tr>
<tr>
  <td>Actas aceptacion:</td>
  <td><input name="actasaceptacion" type="file" ></td>
</tr>
<tr>
  <td>Planos actualizados:</td>
  <td><input name="planosactualizados" type="file" ></td>  
</tr>
</table>

  <button type="button"  name="btn_docpre2" id="btn_docpre2" class="btn btn-primary">Guardar</button>

  </form>
<table>
<tr>
<td style="text-align:right"><button type="button"  name="btn_docpre2" id="btn_docpre2" class="btn btn-danger">StandBy</button></td>
<td style="text-align:right"><button type="button"  name="btn_docpre2" id="btn_docpre2" class="btn btn-danger">Finalizar</button></td>
</tr>


</table>

  </div>

<script>
    
            $("#btn_docpre").click(function(){
            var proyecto_id = $("#proyecto_id").val();

            
            $.ajax({
                url : "<?= site_url('Upload/subirArchivo/') ?>"+proyecto_id,                
                type: "POST",
                data: $("#form_1").serialize()
            }).success(function(){
 $('#result_clave').html("<font color='blue'>Registrado Correctamente</font>");
                        });                                                                                                                                                                                          
                      
        });;
</script>    
<script>
    
            $("#btn_docpre1").click(function(){
            var proyecto_id = $("#proyecto_id1").val();

            
            $.ajax({
                url : "<?= site_url('Upload/documentosEjecucion/') ?>"+proyecto_id,                
                type: "POST",
                data: $("#form_1").serialize()
            }).success(function(){
 $('#result_clave1').html("<font color='blue'>Registrado Correctamente</font>");
                        });                                                                                                                                                                                          
                      
        });;
</script>   
<script>
    
            $("#btn_docpre2").click(function(){
            var proyecto_id = $("#proyecto_id2").val();

            
            $.ajax({
                url : "<?= site_url('Upload/documentosInformacion/') ?>"+proyecto_id,                
                type: "POST",
                data: $("#form_2").serialize()
            }).success(function(){
 $('#result_clave2').html("<font color='blue'>Registrado Correctamente</font>");
                        });                                                                                                                                                                                          
                      
        });;
</script>    