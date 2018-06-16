<?php ?>
<div class="row">


    <div class="panel-heading">
        <h1 class="panel-title">
            <strong>
                <center>GESTION DE CURSOS</center>
            </strong>
        </h1>
    </div>
    <form action="" method="post" name="curso" id="curso">
        <table class="col-lg-12">
            <tr>

                <td class="col-lg-3">
                    <input type="text" placeholder="Curso..." class="form-control" id='txtcurso' style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" name="txtcurso" size="15">
                </td>

                <td class="col-lg-3">
                    <input type="text" placeholder="Descripcion..." class="form-control" id='txtdescr' style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" name='txtdescr' size="10">
                </td>
                <td class="col-lg-3">
                    <input type="text" id='txtcanthoras' name='txtcanthoras' class="form-control" placeholder="horas..."
                        width="80" height="80">
                </td>
                <td class="col-lg-3">
                    <input type="text" id='txtcantcapacidades' name='txtcantcapacidades' class="form-control" placeholder="capacidades..."
                        width="80" height="80">
                </td>
                <td class="col-lg-3">
                    <input type="button" id='btnCurso' name='btnCurso' class="form-control btn-danger" value="Registrar Curso"
                        width="80" height="80">
                </td>

            </tr>
        </table>
    </form>



</div>
<br>
<div id="DIVCURSO">Cargando...</div>
<script type="text/javascript">
    //carga en la primera vista
    $.ajax({
        type: "GET",
        url: "<?=site_url('GestionEducativa/bandejaCurso/')?>",
        success: function (datos) {
            $('#DIVCURSO').html(datos);
            return false;
        }
    });
    $("#btnCurso").click(function () {
        var curso = $("#txtcurso").val();
        if (curso === "") {
            alert("Ingresar Curso:");
        } else {
            $.ajax({
                type: "POST",
                url: "<?=site_url('GestionEducativa/insertarCurso')?>",
                data: $("#curso").serialize(),
                success: function (datos) {

                    $("#DIVCURSO").load("<?= site_url('GestionEducativa/bandejaCurso/') ?>");
                    $("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");
                    $("#txtdescr").val('');
                    $("#txtcurso").val('');
                    $("#txtcanthoras").val('');
                    $("#txtcantcapacidades").val('');
                    return false;
                }
            });
        }
    });
</script>