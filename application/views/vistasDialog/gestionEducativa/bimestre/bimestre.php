<?php ?>
<div class="row">


    <div class="panel-heading">
        <h1 class="panel-title">
            <strong>
                <center>GESTION DE SEMESTRES</center>
            </strong>
        </h1>
    </div>
    <form action="" method="post" name="bimestre" id="bimestre">
        <table class="col-lg-12">
            <tr>
                <td class="col-lg-3">
                    <input type="date" class="form-control" placeholder="Desde" id='desde' name='desde' size="10">
                </td>
                <td class="col-lg-3">
                    <input type="date" class="form-control" placeholder="Hasta" id='hasta' name='hasta' size="10">
                </td>
            </tr>
            <tr>
                <td class="col-lg-3">
                    <input type="text" class="form-control" placeholder="Nombre" id='txtbimestre' style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" name="txtcurso" size="15">
                </td>
                <td class="col-lg-3">
                    <input type="button" id='btnBimestre' name='btnBimestre' class="form-control btn-danger" value="Registrar Semestre"
                        width="80" height="80">
                </td>

            </tr>
        </table>
    </form>



</div>
<br>
<div id="DIVBIMESTRE">Cargando...</div>
<script type="text/javascript">
    //carga en la primera vista
    $.ajax({
        type: "GET",
        url: "<?=site_url('GestionEducativa/bandejaBimestre/')?>",
        success: function (datos) {
            $('#DIVBIMESTRE').html(datos);
            return false;
        }
    });
    $("#btnBimestre").click(function () {
        var bimestre = $("#txtbimestre").val();
        var desde = $("#desde").val();
        var hasta = $("#hasta").val();
        if (bimestre === "") {
            alert("Ingresar Bimestre:");
            return true;
        } else if (desde === '') {
            alert("Ingresar Fecha de inicio");
            return true;
        } else if (hasta === '') {
            alert("Ingresar Fecha de fin");
            return true;

        } else {
            $.ajax({
                type: "POST",
                url: "insertarBimestre",
                data: $("#bimestre").serialize(),
                success: function () {
                    $("#DIVBIMESTRE").load("<?= site_url('GestionEducativa/bandejaBimestre/') ?>");
                    //$("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");                                    
                    $("#txtbimestre").val('');
                    $("#desde").val('');
                    $("#hasta").val('');
                    return false;
                }
            });
        }
    });
</script>