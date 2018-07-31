<?php ?>
<div class="panel-heading">
    <h1 class="panel-title">
        <strong>
            <center>EDICION DE AULAS</center>
        </strong>
    </h1>
</div>
<form action="" method="post" name="editaraulasa1a" id="editaraulasa1a">
    <table class="col-lg-12">
        <tr>
            <td colspan="4" class="col-lg-3">
                <font style="font-style: italic;">
                    <?php echo substr($bodyData->aula["grado"], 0, 1).'°'.$bodyData->aula["seccion"].' de secundaria, Curso:'. $bodyData->aula["curso"].'<br>'?>
                </font>
            </td>
        </tr>
        <br>
        <tr>
            <td class="col-lg-3">
                <input type="hidden" id='txtgrado' class="form-control" name="txtgrado" size="20" value="<?php echo $bodyData->aulas["
                    grado "]?>" readonly>
            </td>
        </tr>
        <tr>
            <td class="col-lg-3">
                <input type="hidden" id='txtseccion' class="form-control" name="txtseccion" size="20" value="<?php echo $bodyData->aulas["
                    seccion "]?>" readonly>
            </td>
            <tr>
                <tr>
                    <td colspan="4" class="col-lg-3">
                        <input type="hidden" id='txtcurso' class="form-control" name='txtcurso' size="20" value="<?php echo $bodyData->aulas["
                            curso "]?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="col-lg-3">
                        <textarea placeholder="DESCRIPCION..." class="form-control" name="txtdescripcion" id="txtdescripcion" style="text-align:left; width: 321px; height: 47px;"><?php echo $bodyData->descripcion;?></textarea>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="col-lg-3">
                        <input type="text" placeholder="PROFESOR" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                            id='txtprofesor' class="form-control" name='txtprofesor' size="20" value="<?php echo $bodyData->profesor; ?>"
                            style="text-align:left; width: 299px; height: 47px;">
                    </td>
                    <?php $i=0;  foreach ($bodyData->profesores1 as $profesoresw): ?>
                    <input type="hidden" name="profesoresw[]" id="profesoresw<?php $i; ?>" value="<?php echo $profesoresw->ape_pat_per ?>" />
                    <?php $i++; endforeach; ?>
                </tr>
                <tr>
                    <td colspan="2" class="col-lg-3">
                        <label style="width: 150px;height: 75px;">
                            <br>
                            <button type="button" id='btn_horarios' name='btn_horarios' class="form-control submit btn-success " btn-sm>HORARIO
                                <span class="glyphicon glyphicon-list"></span>
                            </button>
                        </label>
                    </td>
                    <td colspan="2" class="col-lg-3">
                        <label style="width: 150px;height: 75px;">
                            <br>
                            <button type="button" id='btn_diass' name='btn_diass' class="form-control submit btn-success " btn-sm>DIAS
                                <span class="glyphicon glyphicon-list"></span>
                            </button>
                        </label>
                    </td>
                    <input type="hidden" name="horariosArray" id="horariosArray" value="" />
                    <input type="hidden" name="diassArray" id="diassArray" value="" />
                </tr>
    </table>
</form>
<div id='DIVcargass' title="EN PROCESO ... "> Espere mientras se gestiona la informaci&oacute;n.
    <img src="<?= base_url('publico/media/loading.gif')?>" width="20" height="20">
</div>
<div id="ContainerHorarioss" title="INTRANET EDUCATIVA :: GESTIONAR DE HORARIOS">
    <strong>Cargando...</strong>
</div>
<div id="ContainerDiass" title="INTRANET EDUCATIVA :: GESTIONAR  DIAS">
    <strong>Cargando...</strong>
</div>
<script type="text/javascript">
    var profesoresw = [];

    $("input[name='profesoresw[]']").each(function () {
        var value = $(this).val();
        profesoresw.push(value);
    });

    $("#txtprofesor").autocomplete({
        source: profesoresw,
        minLength: 5
    });

    $('#DIVcargass').dialog({
        autoOpen: false,
        hide: 'drop',
        width: 300,
        height: 150,
        closeOnEscape: false,
        open: function (event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        modal: true,
        buttons: {
            "CERRAR": function () {
                $(this).dialog("close");
            }
        }
    });
    $('#DIVcargass').dialog({
        draggable: false
    });
    $('#DIVcargass').dialog({
        resizable: false
    });
    //POPUP HORARIO
    $('#ContainerDiass').dialog({
        autoOpen: false,
        width: 530,
        height: 460,
        modal: true,
        closeOnEscape: false,
        open: function (event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons: {
            "ACEPTAR": function () {
                var selected = '';
                $('#formdias input[type=checkbox]').each(function () {
                    if (this.checked) {
                        selected += ', ' + $(this).val();

                    }
                });
                var escogidos = selected.substr(1);

                $("#diassArray").val(escogidos);
                if (selected != '') {

                }
                $(this).dialog("close");

            },
            "CERRAR": function () {

                $(this).dialog("close");

            }
        }
    });
    $('#ContainerDiass').dialog({
        draggable: false
    });
    $('#ContainerDiass').dialog({
        resizable: false
    });

    $('#ContainerHorarioss').dialog({
        autoOpen: false,
        width: 520,
        height: 475,
        modal: true,
        closeOnEscape: false,
        open: function (event, ui) {
            $(".ui-dialog-titlebar-close").hide();
        },
        buttons: {
            "ACEPTAR": function () {
                var selected = '';
                $('#formhorario input[type=checkbox]').each(function () {
                    if (this.checked) {
                        selected += ', ' + $(this).val();

                    }
                });
                var escogidos = selected.substr(1);

                $("#horariosArray").val(escogidos);
                if (selected != '') {

                }

                $(this).dialog("close");

            },
            "CERRAR": function () {

                $(this).dialog("close");

            }
        }
    });
    $('#ContainerDiass').dialog({
        draggable: false
    });
    $('#ContainerDiass').dialog({
        resizable: false
    });

    // boton SECCION
    $("#btn_horarios").click(function () {
        $('#ContainerHorarioss').html('Cargando...');
        $.ajax({
            type: "POST",
            url: 'mostrarHorario',
            data: {
                horario: <?php echo $bodyData->secciones?>
            },
            beforeSend: function (datos) {
                $('#DIVcargass').dialog('open');
            },
            success: function (datos) {
                $('#DIVcargass').dialog('close');
                $('#ContainerHorarioss').html(datos);
                $('#ContainerHorarioss').dialog('open');

                return false;
            }
        });
    });
    $("#btn_diass").click(function () {
        $('#ContainerDiass').html('Cargando...');
        $.ajax({
            type: "POST",
            url: 'mostrarDias',
            data: {
                dias: <?php echo $bodyData->dias?>
            },
            beforeSend: function (datos) {
                $('#DIVcargass').dialog('open');
            },
            success: function (datos) {
                $('#DIVcargass').dialog('close');
                $('#ContainerDiass').html(datos);
                $('#ContainerDiass').dialog('open');

                return false;
            }
        });
    });
</script>