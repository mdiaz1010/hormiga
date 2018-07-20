<div class="alert alert-danger" role="alert" id="result_errors">
    Seleccionar PROFESOR(*) Obligatorio
</div>
<div class="alert alert-success" role="alert" id="result_success">
    ¡Registro exitoso!
</div>
<form method="post" name="registraraula" id="registraraula">

    <div class="container">
    <label class="control-label col-md-12 col-sm-12 col-xs-12">
        <input name="profesor" id="profesor" placeholder="PROFESOR" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </label>
    </div>


<div class="table-responsive container col-md-12 col-sm-12 col-xs-12">
<table class="table table-bordered table-hover table-striped tablesorter">
    <thead>
        <tr class="headings">
            <th>
                <small>
                    <center>Horas</center>
                </small>
            </th>
            <?php foreach ($bodyData->dias as $dias): ?>
            <th>
                <small>
                    <?=$dias->dias?>
                </small>
            </th>
            <?php endforeach; ?>
        </tr>
    </thead>

    <tbody>
    <?php $i=1;$h=0;
    $turno='Mañana';
    foreach ($bodyData->horas as $horas):


        if((int)$horas->codigo>=8 ){

            $turno='Tarde';

        $h++;
    ?>
        <tr>
            <td>
                <small>
                    <center>
                        <?=$h."'H<br>".$turno;?>
                    </center>
                </small>
            </td>
            <?php $j=1;

        foreach ($bodyData->dias as $dias):?>
            <td >
            <input type='hidden' name="hora_dia[]" id="hora-dia" value="<?=$horas->codigo.'-'.$dias->codigo?>">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
            <select name="gradorol[]" class="form-control" id='gradorol' required>
                <option   selected value="0">GRADO</option>
                <?php foreach ($bodyData->rolesGrado as $rolesTemp):?>
                    <option name='opciones' value="<?=$rolesTemp->id?>">
                        <?=$rolesTemp->nom_grado?>
                    </option>
                <?php endforeach;?>
            </select>
            </label>
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
            <select name="seccionrol[]" class="form-control" id='seccionrol' required>
                <option value="0" selected>SECCION</option>
                <?php foreach ($bodyData->rolesSeccion as $rolesTemp):?>
                    <option name='opciones' value="<?=$rolesTemp->id?>">
                        <?=$rolesTemp->nom_seccion?>
                    </option>
                <?php endforeach;?>
            </select>
            </label>
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
            <select name="cursorol[]" class="form-control" id='cursorol' required>
                <option value="0" selected>CURSO</option>
                <?php foreach ($bodyData->rolesCursos as $rolesTemp) :?>
                    <option name='opciones' value="<?=$rolesTemp->id?>">
                        <?=$rolesTemp->nom_cursos?>
                    </option>
                <?php endforeach;?>
            </select>
            </label>
            </td>
        <?php  endforeach;?>

        </tr>
        <?php } endforeach;?>
    </tbody>
</table>
</div>
</form>
    <?php $i=0;  foreach ($bodyData->profesores as $profesores): ?>
    <input type="hidden" name="profesores[]" id="profesores<?php $i; ?>" value="<?php echo $profesores->ape_pat_per ?>" />
    <?php $i++; endforeach; ?>
<div id='DIVcarga' title="EN PROCESO ... "> Espere mientras se gestiona la informaci&oacute;n.
    <img src="<?= base_url('publico/media/loading.gif')?>" width="20" height="20">
</div>

<script type="text/javascript">
    $("#result_errors").hide();
    $("#result_success").hide();
    //autocompletar profesor
    var profesores = [];

    $("input[name='profesores[]']").each(function () {
        var value = $(this).val();
        profesores.push(value);
    });

    $("#profesor").autocomplete({
        source: profesores,
        minLength: 5
    });

    //HORARIO
    //POP UP CARGA

    $('#DIVcarga').dialog({
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
    $('#DIVcarga').dialog({
        draggable: false
    });
    $('#DIVcarga').dialog({
        resizable: false
    });


</script>