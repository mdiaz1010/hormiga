<?php if ($bodyData->respuesta>0) {
    ?>
<?php if (count($bodyData->results)>0) {
        ?>

<link type="text/css" rel="stylesheet" href="<?= base_url(); ?>publico/handsontable/css/handsontable.full.css">
<script type="text/javascript" src="<?= base_url(); ?>publico/handsontable/js/handsontable.full.min.js"></script>

<div class="list-group right">

    <button class="btn btn-danger " title="Registrar Notas" type="button" name="btnNotas" id="btnNotas">
        <i class="fa fa-floppy-o"></i>
    </button>
    <strong>Una vez terminado de ingresar las notas no te olvides de presionar el boton rojo para registrarlas (*)</strong>
</div>

<div class="x_content bs-example-popovers">
    <div id="exito" class="alert alert-success alert-dismissible fade in" role="alert" hidden="true">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>!REGISTRO EXITOSO!</strong> Las notas han sido guardadas satisfactoriamente.
    </div>

    <div id="error" class="alert alert-danger alert-dismissible fade in" role="alert" hidden="true">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>!CORREGIR INFORMACION INGRESADA!</strong> Solo se permite el ingreso de valores numéricos entre cero y veinte, corregir
        las celdas Rojas.
    </div>

</div>
<div class="x_content">
    <div id="ResultadoTabla"></div>
</div>


<?php
    } else {
        echo "<div class='alert_result'>No se encuentra ningun alumno registrado.</div>";
    } ?>

    <script type="text/javascript">
        var busqueda = <?=json_encode($bodyData->datos) ?>;
        var data1 = <?= json_encode($bodyData->tabla) ?>;
        var bool = '';
        var cabeceras = <?= $bodyData->marcados?>;

        configuraciones = {

            data: data1,
            colHeaders: true,
            rowHeaders: false,
            //yellowRenderer,
            fixedRowsTop: 0,
            nestedHeaders: [
                <?=$bodyData->head_primera?>, //comentado , se está prefiriendo optimización antes de estética
                <?=$bodyData->head?>
            ],
            stretchH: 'all',
            sortIndicator: true,
            columns: <?=$bodyData->column?>,
            afterValidate: function (isValid) {
                bool = isValid;
            },
            formulas: true,
            columnSorting : true,
            afterCreateRow: function (index, numberOfRows) {
                data1.splice(index, numberOfRows); //limita crecimiento de la tabla
            },
            afterRender: function () {
                render_color(this);
            }
        };

        function render_color(ht) {
            var valor;
            for (var i = 0; i < ht.countRows(); i++) {
                for (var p = 0; p < ht.countCols(); p++) {

                    var ide = ht.getDataAtCell(i, p);

                        var cell_color = $.map(cabeceras, function (value, key) {
                            if (p == value) {
                                return "#fcf3cf";
                            }

                        });
                            if (p == 0) {
                                font_color = "#070719";
                            } else {
                                if (ide <= 10 && ide>=0) {
                                    font_color = "#E74C3C";
                                } else if(ide>=11 && ide <=20 ) {
                                    font_color = "#2874A6";
                                }else{
                                    font_color = "#fff";
                                    cell_color[0]='#f5415a';
                                }

                            }


                    $(ht.getCell(i, p)).css({
                        "color": font_color,
                        "background-color": cell_color[0]
                    });
                }

            }
        }

        tblExcel = new Handsontable(document.getElementById('ResultadoTabla'), configuraciones);
        tblExcel.render();

        $("#btnNotas").click(function () {


            var h = 1;
            var contador = 0;
            if (contador === 0) {
                $.ajax({
                    type: 'POST',
                    url: 'registrarNotas',
                    data: {
                        'tblExcel'  : data1,
                        'grado'     : $('#rol_grado').val(),
                        'seccion'   : $('#rol_seccion').val(),
                        'curso'     : $('#rol_curso').val(),
                        'bimestre'  : $('#rol_bimestre').val()
                    },
                    beforeSend: function (dato) {
                        $('#exampleModalCenter').modal("show");
                    },
                    success: function (dato) {
                        $('#exampleModalCenter').modal("toggle");

                        if(dato.split(',').indexOf("0")!=-1){
                            $('#exito').hide();
                            $('#error').show();

                        }else{

                            $('#exito').show();
                            $('#error').hide();
                        }
                    },
                    failure: function (respuesta) {
                        $('#error').show();
                        console.log("Error intentando registrar" + respuesta);
                    }

                });
            } else {

                $('#error').show();
            }
        });
    </script>


    <?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>