<div class="container">
    <div class="row col-lg-12">
        <div class="col-lg-4"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="form-group">
                <?php $i=0;  foreach ($bodyData->usuarios as $profesores): ?>
                <input type="hidden" name="profesores[]" id="profesores<?= $i; ?>" value="<?= $profesores->ape_pat_per?>" />
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="row">


    <div class="page-title">

        <div class="title_left">
            <h3>Contactos</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" name="buscarUsuario" id="buscarUsuario" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <button class="btn btn-default busqueda1" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>

    </div>

<div class="">

    <div class="" id="bandejaprincipal"></div>


</div>






</div>
<div id="DIVcargas_general" title="EN PROCESO">
    <center>
        <strong>Espere estamos cargando la informacion...</strong>
        <span class="fa fa-spinner fa-pulse fa-2x fa-fw"></span>
    </center>
</div>
<script type="text/javascript" src="<?= base_url('publico/js_vistas/js/cargar_data.js')?>"></script>
<script type="text/javascript">
    var nombre1 = $("#buscarUsuario").val();
    $.ajax({
        type: 'POST',
        url: 'consultaGeneralDir',
        data: {
            nombre: nombre1,
            boolean: "true"
        },
        beforeSend: function (data) {
            $('#DIVcargas_general').dialog('open');
        },
        success: function (data) {
            $('#DIVcargas_general').dialog('close');
            $("#bandejaprincipal").html(data);
            return false;
        }

    });
    $(".busqueda1").click(function () {
        var nombre = $("#buscarUsuario").val();
        $.ajax({
            type: 'POST',
            url: 'consultaGeneralDir',
            data: {
                nombre: nombre,
                boolean: "false"
            },
            beforeSend: function (data) {
                $('#DIVcargas_general').dialog('open');
            },
            success: function (data) {
                $('#DIVcargas_general').dialog('close');
                $("#bandejaprincipal").html(data);
                return false;
            }

        });
    });



    $(".busqueda").click(function () {
        var nombre = $(this).data("nombre");

        $.ajax({
            type: 'POST',
            url: 'buscarUser',
            data: {
                nombre: nombre,
                boolean: "false"
            },
            beforeSend: function (data) {
                $('#DIVcargas_general').dialog('open');
            },
            success: function (data) {
                $('#DIVcargas_general').dialog('close');
                $("#bandejaprincipal").html(data);
                return false;
            }
        });

    });
    var profesores = [];

    $("input[name='profesores[]']").each(function () {
        var value = $(this).val();
        profesores.push(value);
    });

    $("#buscarUsuario").autocomplete({
        source: profesores,
        minLength: 5
    });
</script>