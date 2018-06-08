<?php ?>
<div class="row">



    <form action="" method="post" name="nota" id="nota">
        <div class="panel-heading">
            <h1 class="panel-title">
                <strong>
                    <center>GESTION DE NOTAS</center>
                </strong>
            </h1>
            <input type="checkbox" placeholder="Peso..." class="form-control" id='pe' name='pe' size="10">

        </div>
        <table class="col-lg-12">
            <tr>

                <td class="col-lg-3">
                    <input type="text" placeholder="Nombre..." class="form-control" id='txtnotasn' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        name="txtnotasn" size="15">
                </td>

                <td class="col-lg-3">
                    <input type="text" placeholder="Descripcion..." class="form-control" id='txtdescrn' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        name='txtdescrn' size="10">
                </td>
            </tr>
            <tr>


                <td class="col-lg-3">
                    <input type="text" placeholder="Peso..." class="form-control" id='txtPeso' name='txtPeso' size="10">
                </td>

                <td class="col-lg-3">
                    <input type="button" id='btnNotas' name='btnNotas' class="form-control btn-danger" value="Registrar Curso" width="80" height="80">
                </td>
            </tr>
            <br>
            <tr>
                <td colspan="2" class="col-lg-6">

                </td>
            </tr>

        </table>


    </form>



</div>
<br>
<div id="DIVNOTAS">Cargando...</div>
<font style="font-style: italic;">
    <strong>Seleccionar una sola vez para la generacion de la nota final:</strong>
</font>
<button name="notafinal" id="notafinal" class="btn-danger">
    <span class="fa fa-save"></span>
</button>
<script type="text/javascript">
    //carga en la primera vista
    $.ajax({
        type: "GET",
        url: "<?=site_url('GestionEducativa/bandejaNotas/')?>",
        success: function (datos) {
            $('#DIVNOTAS').html(datos);
            return false;
        }
    });
    $("#notafinal").click(function () {
        var valido = "notafinal";
        $.ajax({
            type: "POST",
            url: "<?=site_url('GestionEducativa/insertarNotas')?>",
            data: {
                valido: valido
            },
            success: function () {

                $("#DIVNOTAS").load("<?= site_url('GestionEducativa/bandejaNotas/') ?>");
                //  $("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                    
                $("#txtnotasn").val('');
                $("#txtdescrn").val('');
                $("#txtPeso").val('');
                return false;
            }
        });


    });
    $("#btnNotas").click(function () {

        var curso = $("#txtnotasn").val();
        if (curso === "") {
            alert("Ingresar Notas:");
        } else {
            $.ajax({
                type: "POST",
                url: "<?=site_url('GestionEducativa/insertarNotas')?>",
                data: $("#nota").serialize(),
                success: function () {

                    $("#DIVNOTAS").load("<?= site_url('GestionEducativa/bandejaNotas/') ?>");
                    //  $("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                    
                    $("#txtnotasn").val('');
                    $("#txtdescrn").val('');
                    $("#txtPeso").val('');
                    return false;
                }
            });
        }
    });
</script>