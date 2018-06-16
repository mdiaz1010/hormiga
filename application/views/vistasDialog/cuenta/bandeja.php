<?php
?>
<table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-usuario">
    <thead class="bg-success">
        <tr>
            <th style="border: hidden;color: #3b752e;">
                <center>NOMBRES</center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>USUARIO</center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>TELEFONO</center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>CORREO</center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center> CARGO</center>
            </th>
            <th style="border: hidden;color: #3b752e;">
                <center>OPCIONES</center>
            </th>
        </tr>
    </thead>

    <tbody>

        <?php


                                            foreach ($bodyData->cuentas as $cuentasTemp) {
                                                ?>
            <tr>
                <td>
                    <?=$cuentasTemp->PROFESOR  ?>
                </td>
                <td>
                    <CENTER>
                        <?=$cuentasTemp->USUARIO   ?>
                    </CENTER>
                </td>
                <td>
                    <CENTER>
                        <?=$cuentasTemp->TELEFONO  ?>
                    </CENTER>
                </td>
                <td>
                    <CENTER>
                        <?=$cuentasTemp->CORREO    ?>
                    </CENTER>
                </td>
                <td>
                    <CENTER>
                        <?=$cuentasTemp->CARGO     ?>
                    </CENTER>
                </td>
                <td>
                    <label style="margin-right: 7px;">
                        <i class="fa fa-edit"></i>
                        <a href="javascript:" data-id="<?=$cuentasTemp->CODIGO?>" class="Editar">Cuenta</a>
                    </label>


                    <label style=" ">
                        <i class="fa fa-lock"></i>
                        <a data-id="<?=$cuentasTemp->CODIGO?>" name="permisosTrigger" href="javascript:">Permisos</a>
                    </label>
                </td>
            </tr>
            <?php
                                            }
                                            ?>

    </tbody>
</table>


<!--  MODAL DE LISTA DE REGISTROS -->
<div class="modal   fade" id="permisosModal" tabindex="-1" role="dialog" aria-labelledby="permisosModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="permisosModalLabel">Gestion de Permisos</h4>
            </div>
            <div class="modal-body" style="overflow-y: auto;">
                <center>
                    <img src="<?= base_url('publico/media/ajax-loader2.gif')?>" width="80" height="80">
                </center>'
                <!-- ACA es la Zona de Contenido... SI solo tuviera algo que colocar T.T -->hola
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-9 nombre" style="text-align: left;">
                    </div>
                    <div class="col-sm-3">
                        <form>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--  MODAL DE LISTA DE Areas -->


<script type="text/javascript">
    $("#DIVEDITARCUENTA").dialog({
        autoOpen: false,
        hide: "drop",
        modal: true,
        width: 420,
        height: 780,
        fluid: true,
        closeOnEscape: true,
        draggable: true,
        responsive: true,
        open: function (event, ui) {
            $(this).closest(".ui-dialog").find(".ui-dialog-titlebar-close").hide();
        },
        buttons: {
            "EDITAR CUENTA": function () {

                var nombre = $("#txtnombrecuenta").val();

                var apepat = $("#txtapepatcuenta").val();
                var apemat = $("#txtapematcuenta").val();
                var usuari = $("#txtusuaricuenta").val();
                var claves = $("#txtclavescuenta").val();
                var telefo = $("#txttelefocuenta").val();
                var docume = $("#txtdocumecuenta").val();
                var emails = $("#txtemailscuenta").val();
                if (nombre == '') {
                    $('#result_nombre').html("<font color='red'>Campo Nombre (*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_nombre').html("");
                }
                if (apepat === '') {
                    $('#result_apepat').html("<font color='red'>Campo  (*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_apepat').html("");
                }
                if (apemat === '') {
                    $('#result_apemat').html("<font color='red'>Campo  (*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_apemat').html("");
                }
                if (usuari === '') {
                    $('#result_usuario').html("<font color='red'>Campo (*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_usuario').html("");
                }
                if (claves === '') {
                    $('#result_clave').html("<font color='red'>Campo   (*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_clave').html("");
                }
                if (telefo === '') {
                    $('#result_telefono').html("<font color='red'>Campo(*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_telefono').html("");
                }
                if (docume === '') {
                    $('#result_dni').html("<font color='red'>Campo     (*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_dni').html("");
                }
                if (emails === '') {
                    $('#result_email').html("<font color='red'>Campo   (*) Obligatorio</font>");
                    return true;
                } else {
                    $('#result_email').html("");
                }

                $.ajax({
                    data: $("#edicioncuenta").serialize(),
                    type: 'POST',
                    url: "editarcuenta",
                    beforeSend: function () {
                        $('#DIVcargas').dialog('open');
                    },
                    success: function () {
                        $('#DIVcargas').dialog('close');
                        $("#bandejaprincipal").load("vistabandeja");
                    }
                });
                $(this).dialog("close");
            },
            "CANCELAR": function () {
                $(this).dialog("close"); //Se cancela operación
            }
        }
    });
    $("#DIVEDITARCUENTA").dialog({
        draggable: true
    });
    $("#DIVEDITARCUENTA").dialog({
        resizable: true
    });
    $(".Editar").click(function () {
        var codigo = $(this).data("id");
        $.ajax({
            type: 'POST',
            url: "vereditarcuenta",
            data: {
                codigo: codigo
            },
            beforeSend: function () {
                $('#DIVcargas').dialog('open');
            },
            success: function (datos) {
                if (datos.length > 0) {
                    $('#DIVcargas').dialog('close');
                    $('#DIVEDITARCUENTA').html(datos);
                    $('#DIVEDITARCUENTA').dialog('open');
                }
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('[name="permisosTrigger"]').click(function ($element) {
            var id = $(this).attr("data-id");
            $("#permisosModal").modal("show");
            cargarData(id);
        });

        function cargarData(id) {
            $.ajax({
                url: "<?= site_url('cuenta/permisos') ?>",
                method: "POST",
                data: {
                    id: id
                },
                dataType: "html"
            }).done(function (msg) { //alert("bien");
                var height = $(window).height() * 0.75;
                var width = $(window).width() * 0.90;
                var modal = $("#permisosModal");
                modal.find('.modal-body').html(msg);
                modal.find(".modal-dialog").css("width", "90%");
                modal.find('.modal-body').css({
                    "max-height": height
                });
                var htmlHead = modal.find('.modal-body .nombreUsuario').html();

            }).fail(function (jqXHR, textStatus) {
                var msj = "Error de Conexion";
                if (jqXHR.status === 401) {
                    msj = "Acceso Denegado";
                }
                var modal = $("#permisosModal");
                modal.find('.modal-body').html("<p> " + msj + " </p>");
            });
        }
    });
</script>

<script>
    /*LIMPIEZA */
    $(document).ready(function () {
        $('#permisosModal').on('hidden.bs.modal', function (e) {
            /*LIMPIAR DISPARADORES */
            $(this).find('button').unbind();
            $(this).find('.modal-body').html('<center><img src="<?= base_url('
                publico / media / ajax - loader2.gif ')?>" width="80" height="80" ></center>');
            $(this).find('.modal-footer .nombre').html('');
        });
    });
</script>
<script>
    $("#dataTables-usuario").dataTable();
</script>