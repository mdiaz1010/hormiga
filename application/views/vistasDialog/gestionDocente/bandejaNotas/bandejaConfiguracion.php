<div class="row"  >

          <div class="control-label col-md-6 col-sm-6 col-xs-12">

            <div class="x_panel">

              <div class="x_content">
                   <br />
                      <form id="configuracion_nota" name="configuracion_nota" data-parsley-validate class="form-horizontal form-label-left">
                          <input type="hidden" name="acumulado" id="acumulado" value="<?=$bodyData->acumulado?>">
                          <input type="hidden" name="grado" id="grado" value="<?=$bodyData->datos['grado']?>">
                          <input type="hidden" name="curso" id="curso" value="<?=$bodyData->datos['curso']?>">
                          <input type="hidden" name="nota" id="nota" value="<?=$bodyData->datos['nota']?>">
                          <input type="hidden" name="profesor" id="profesor" value="<?=$bodyData->datos['profesor']?>">
                          <input type="hidden" name="ano" id="ano" value="<?=$bodyData->datos['ano']?>">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Abreviacion <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input minlength="1" maxlength='3' type="text" id="abreviacion" name="abreviacion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ejemplo: PC1">
                              </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Descripcion <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="descripcion" name="descripcion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Ejemplo: practica calificada 1">
                              </div>
                          </div>

                          <div class="form-group">
                            <label  for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Peso<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <input minlength="1" maxlength='3' id="peso"  class="input-number form-control col-md-7 col-xs-12" type="text" name="peso" placeholder="Ejemplo: 25">
                              </div>
                          </div>


                          <div class="ln_solid"></div>

                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button class="btn btn-primary" id="btnLimpiar" name="btnLimpiar" type="reset">Limpiar </button>
                              <button type="button" id="btnRegistrar" name="btnRegistrar" class="btn btn-success">Registrar <span class="fa fa-arrow-circle-right"></span></button>
                            </div>

                          </div>

                      </form>
                      <p id="result_error"></p>
              </div>

            </div>

          </div>


          <div class="control-label col-md-6 col-sm-6 col-xs-12">

            <div class="x_panel">

              <div class="x_content" id="divGrilla">

              </div>

            </div>

          </div>

                            <div class="form-group">

                              <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-3"></div>

                              <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-3">
                                <button class="btn btn-danger" id="btnRegistroFin" name="btnRegistroFin" type="reset">Finalizar <span class="fa fa-save"></span> </button>
                              </div>

                          </div>
</div>
<script>
    var grado   = $("#grado").val();
    var curso   = $("#curso").val();
    var nota    = $("#nota").val();
    var profesor= $("#profesor").val();
    var ano     = $("#ano").val();
    var abreviacion= $("#abreviacion").val();
    var descripcion= $("#descripcion").val();
    var peso      = $("#peso").val();
    var contador=0;
    var acumulado = $("#acumulado").val();
$.ajax({
    type : "POST",
    url : "cargarConfiguracionNotas",
    data: {grado:grado,curso:curso,nota:nota,profesor:profesor,ano:ano},
     success : function(datos){
        $('#divGrilla').html(datos);
                return false;
            }
  });
$("body").delegate(".eliminar", "click", function(){
var cant = $(this).data("codigo");
$("#contFilas"+cant).remove();
});
$('.input-number').on('input', function () {
this.value = this.value.replace(/[^0-9]/g,'');
});
$("#btnLimpiar").click(function(){
$("#configuracion_nota")[0].reset();  //Limpiar caracteres de cajas de texto
});
$("#btnRegistrar").click(function(){
contador++  ;
var abreviacion= $("#abreviacion").val();
var descripcion= $("#descripcion").val();
var peso      = $("#peso").val();
var abreviacion_ = $('input[name="abreviacion[]"]').map(function(){
                return this.value;
            }).get();

var index= abreviacion_.indexOf(abreviacion);
if(index!==-1){
alert('No se permite ingresar la misma abreviacion'); return true;
}
if(abreviacion==='' || descripcion==='' || peso===''){
alert('Rellenar los campos obligatorios *'); return true;
}
$.post('valido_abreviacion_notas',{grado:grado,curso:curso,abreviacion:abreviacion,profesor:profesor,ano:ano,nota:nota},function(datos){
if(datos==="1"){
alert("Esta abreviación ya se encuentra registrada, por favor cambiar el nombre");
}else{
var concatenarFilas='';
    concatenarFilas+='<tr id="contFilas'+contador+'">';
    concatenarFilas+='<td><CENTER>'+abreviacion.toUpperCase()+ '<input type="hidden" name="abreviacion[]"   data-cantdet="'+contador+'" id="abreviacion'+contador+'"     value="'+abreviacion+'" ></CENTER></td>';
    concatenarFilas+='<td><CENTER>'+descripcion.toUpperCase()+ '<input type="hidden" name="descripcion[]"   data-cantdet="'+contador+'" id="descripcion'+contador+'"     value="'+descripcion+'" ></CENTER></td>';
    concatenarFilas+='<td><CENTER>'+peso+ '%<input type="hidden" name="peso[]"   data-cantdet="'+contador+'" id="peso'+contador+'"     value="'+(peso/100)+'" ></CENTER></td>';
    concatenarFilas+='<td><CENTER><a href="javascript:" title="Anular" class="fa fa-remove eliminar" data-codigo="'+contador+'"></a></CENTER></td>';
    concatenarFilas+='</tr>';
    $("#configuracion_nota")[0].reset();
    $("#configuracion").append(concatenarFilas);
}
});
/*
$.ajax({
            type : "POST",
            url : "registrar_configuracion_nota",
            data: $("#configuracion_nota").serialize(),
            success : function(){
                $("result_error").html("<font color ='green'>REGISTRO CORRECTO</font>");
                $("#divGrilla").load("cargarConfiguracionNotas",{ grado:grado,seccion:seccion,curso:curso,nota:nota,profesor:profesor,ano:ano });
                $("#configuracion_nota")[0].reset();
                $('#result_error').html("");


            }
        });
*/
});
</script>
<script>
$("#btnRegistroFin").click(function(){
var eliminar= $("#not").val();

var peso        = $('input[name="peso[]"]').map(function(){
                return this.value;
            }).get();
var descontar=0;
descontar   = $("#descontar").val();


    var abreviacion= $("#abreviacion").val();
    var grado   = $("#grado").val();
    var curso   = $("#curso").val();
    var nota    = $("#nota").val();
    var profesor= $("#profesor").val();
    var ano     = $("#ano").val();
                              $.ajax({
                                        type : "POST",
                                        url : "registrar_configuracion_nota",
                                        data : $("#registrarNotasConf").serialize(),
                                        success : function(datos){
                                          if(datos==1){
                                              $.post('cambiar_estado_configuracion',{grado:grado,curso:curso,nota:nota,profesor:profesor,abreviacion:eliminar,nota:nota,descontar:descontar});
                                              $("#divGrilla").load("cargarConfiguracionNotas",{ grado:grado,curso:curso,nota:nota,profesor:profesor,ano:ano });
                                              $("#configuracion_nota")[0].reset();
                                              $('#result_error').html("");
                                          }else{
                                              $("#configuracion_nota")[0].reset();
                                              $('#result_error').html("");
                                              alert(datos); return true;
                                          }

                                                                             }

                                });



});
</script>