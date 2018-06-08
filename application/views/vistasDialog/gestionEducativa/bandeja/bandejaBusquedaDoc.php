<?php ?>
<link href="<?= base_url('publico/js_vistas/css/password.css') ?>" rel="stylesheet">
<script src="<?= base_url('publico/js/strength.js')?>"></script>
<div class="row">
</div>
<div class="container col-lg-12">

    <div class="panel panel-primary">

        <!-- Default panel contents -->
        <div class="panel-heading">
            <h1 class="panel-title">
                <span class="fa fa-search"></span> INTRANET EDUCATIVO - Consultar Informacion </h1>
        </div>
        <div class="panel-body">
            <div class="col-xs-10">
                <form method="post" name="crearusuario" id="crearusuario">
                    <div class="container">
                        <label class="col-xs-6 col-md-3">
                            Nombre
                            <input name="nombre" id="nombre" placeholder="Nombres" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                value="<?=$bodyData->results1['nombre']?>" readonly>
                        </label>
                        <label class="col-xs-6 col-md-3">
                            Apellido Paterno
                            <input name="apepat" id="apepat" placeholder="Apellido paterno" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                value="<?=$bodyData->results1['apepat']?>" readonly>
                        </label>
                        <label class="col-xs-6 col-md-3">
                            Apellido Materno
                            <input name="apemat" id="apemat" placeholder="Apellido materno" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                value="<?=$bodyData->results1['apemat']?>" readonly>
                        </label>
                        <label class="col-xs-6 col-md-3">
                            Rol:
                            <input name="rol" id="rol" placeholder="Rol" class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                value="<?=$bodyData->results1['usuari']?>" readonly>
                        </label>
                        <label class="col-xs-6 col-md-3">
                            Telefono:
                            <input name="telefono" id="telefono" placeholder="Telefono" type="text" class="form-control" value="<?=$bodyData->results1['telefo']?>"
                                readonly>
                        </label>
                        <label class="col-xs-6 col-md-3">
                            Dni:
                            <input name="documento" id="documento" placeholder="documento" type="text" class="form-control" required value="<?=$bodyData->results1['docume']?>"
                                readonly>
                        </label>
                        <label class="col-xs-6 col-md-3">
                            email:
                            <input name="email" id="email" placeholder="email" type="email " class="form-control" required value="<?=$bodyData->results1['correo']?>"
                                readonly>
                        </label>
                        <label class="col-xs-6 col-md-3">
                            Grado y Seccion:
                            <input name="grado" id="grado" placeholder="email" type="email " class="form-control" required value="<?=$bodyData->results1['grados']?>"
                                readonly>
                        </label>
                    </div>
                    <div class="container">
                        <label class="col-xs-6 col-md-3">
                            Fecha de Nacimiento:
                            <input name="fecha" id="fecha" type="date" placeholder="fecha" class="form-control" required value="<?=$bodyData->results1['fecha']?>">
                        </label>
                        <label class="col-xs-6 col-md-9">
                            Direccion:
                            <textarea name="direccion" id="direccion" placeholder="Direccion " class="form-control" style="text-transform:uppercase;"
                                onkeyup="javascript:this.value=this.value.toUpperCase();" rows="1">
                                <?=$bodyData->results1['direcc']?>
                            </textarea>
                        </label>
                    </div>

                </form>
            </div>
            <div class="table-responsive">
                <div class="col-xs-2">
                    <div id="centrador" class="thumbnail">
                        <a href="#" style=" outline: none;" class="img-rounded">
                            <img id="imagen" src="<?= base_url($bodyData->results1['ruta'])?>" class="img-responsive center-block" align="top" alt="Lights"
                                style="width:100%" />
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="col-xs-12">
        <div class="col-xs-6">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title">
                            TURNO MAÑANA
                        </h1>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
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
                                        <?php endforeach;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;  foreach ($bodyData->horas as $horas):?>
                                    <?php  if ($horas->turnos=='mañana') {
    ?>
                                    <tr>
                                        <td>
                                            <small>
                                                <center>
                                                    <?=$horas->horarios?>
                                                </center>
                                            </small>
                                        </td>
                                        <?php $j=1;
    foreach ($bodyData->dias as $dias):
                        if (isset($bodyData->results[$i][$j])==false) {
                            $valor[$i][$j]='';
                            $color='';
                            $curso='';
                        } else {
                            $valor[$i][$j]=$bodyData->results[$i][$j]['materia'];
                            $color=$bodyData->color[$bodyData->results[$i][$j]['materia']];
                            $curso=$bodyData->curso[$bodyData->results[$i][$j]['materia']];
                        } ?>
                                        <td title="<?=$curso; ?>" bgcolor="<?=$color?>">
                                            <small>
                                                <font style="font-style: italic;" COLOR="#fdfefe">
                                                    <?=$valor[$i][$j]; ?>
                                                </font>
                                            </small>
                                        </td>
                                        <?php $j++;
    endforeach; ?>
                                    </tr>
                                    <?php
}?>
                                    <?php $i++; endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title">
                            TURNO TARDE
                        </h1>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped tablesorter">
                                <thead>
                                    <tr>
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
                                        <?php endforeach;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;  foreach ($bodyData->horas as $horas):?>
                                    <?php  if ($horas->turnos=='tarde') {
        ?>
                                    <tr>
                                        <td>
                                            <center>
                                                <small>
                                                    <?=$horas->horarios?>
                                                </small>
                                            </center>
                                        </td>
                                        <?php $j=1;
        foreach ($bodyData->dias as $dias):
                        if (isset($bodyData->results[$i][$j])==false) {
                            $valor[$i][$j]='';
                            $color="";
                            $curso='';
                        } else {
                            $valor[$i][$j]=$bodyData->results[$i][$j]['materia'];
                            $color=$bodyData->color[$bodyData->results[$i][$j]['materia']];
                            $curso=$bodyData->curso[$bodyData->results[$i][$j]['materia']];
                        } ?>
                                        <td title="<?=$curso; ?>" bgcolor="<?=$color; ?>">
                                            <small>
                                                <font style="font-style: italic;" COLOR="#fdfefe">
                                                    <?=$valor[$i][$j]; ?>
                                                </font>
                                            </small>
                                        </td>
                                        <?php $j++;
        endforeach; ?>
                                    </tr>
                                    <?php
    }?>
                                        <?php $i++; endforeach;?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .right {
        float: right;

    }

    .left {
        float: left;

    }

    #centrador {
        text-align: center;
        width: 150px;
        height: 180px;

    }

    #imagen {
        width: 100px;
    }
</style>
<script type="text/javascript">
    $("#btneditar").click(function () {
        var fecha = $("#fecha").val();
        var direccion = $("#direccion").val();
        var clave = $("#myPassword").val();
        var clave2 = $("#clave").val();
        if (clave === clave2) {
            var fecha = $("#fecha").val();
            var direccion = $("#direccion").val();
            var clave = $("#myPassword").val();
            var DocAdj = $("#docAdj").val();

            var inputimage = document.getElementById('docAdj'),

                formdata = new FormData();
            var i = 0,
                len = inputimage.files.length,
                img, reader, file;
            for (; i < len; i++) {
                file = inputimage.files[i];
                if (formdata)
                    formdata.append('images[]', file);
            }

            formdata.append('fecha', fecha);
            formdata.append('direccion', direccion);
            formdata.append('clave', clave);
            $.ajax({
                type: 'POST',
                url: "editarInfo",
                data: formdata,
                processData: false,
                contentType: false,
                success: function () {
                    location.reload();
                }
            });

        } else {
            $('#result_error').html("<font color='red'>Las claves no coinciden</font>");
        }


    });
    $(document).ready(function ($) {
        $("#myPassword").strength();
    });
</script>