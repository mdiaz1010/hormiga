<?php ?>
<div class="row">


    <div class="panel-heading">
        <h1 class="panel-title">
            <strong>
                <center>GESTION DE SECCIONES</center>
            </strong>
        </h1>
    </div>
    <form action="" method="post" name="seccion" id="seccion">
        <table class="col-lg-12">
            <tr>

                <td class="col-lg-2">
                    <input type="text" placeholder="Seccion..." class="form-control" id='txtseccion' style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" name="txtseccion" size="2">
                </td>
                <td class="col-lg-3">
                    <input type="text" placeholder="Descripcion..." class="form-control" id='txtdescrs' style="text-transform:uppercase;"
                        onkeyup="javascript:this.value=this.value.toUpperCase();" name='txtdescrs' size="10">
                </td>
                <td class="col-lg-3">
                    <input type="button" id='btnSeccion' name='btnSeccion' class="form-control btn-danger" value="Registrar Seccion"
                        width="80" height="80">
                </td>
            </tr>
        </table>
    </form>



</div>
<br>
<div id="DIVSECCION">Cargando...</div>
<script type="text/javascript">
    //carga en la primera vista
    $.ajax({
        type: "GET",
        url: "<?=site_url('GestionEducativa/bandejaSeccion/')?>",
        success: function (datos) {
            $('#DIVSECCION').html(datos);
            return false;
        }
    });
    $("#btnSeccion").click(function () {
        var seccion = $("#txtseccion").val();
        if (seccion === "") {
            alert("Ingresar Seccion:");
        } else {
            $.ajax({
                type: "POST",
                url: "<?=site_url('GestionEducativa/insertarSeccion')?>",
                data: $("#seccion").serialize(),
                success: function (datos) {

                    $("#DIVSECCION").load("<?= site_url('GestionEducativa/bandejaSeccion/') ?>");
                    $("#bandejaAula").load("<?= site_url('GestionEducativa/vistabandejaaula/') ?>");
                    $("#txtdescrs").val('');
                    $("#txtseccion").val('');
                    return false;

                }
            });
        }
    });
</script>