<?php
if (count($bodyData->results)==0 || $bodyData->arrayBusqueda['id_curso']=='Seleccione' || $bodyData->arrayBusqueda['id_bimestre']=='Seleccione') {
    echo "<div class='alert_result'>No se encuentra ningun material registrado.</div>";
} else {
    ?>

<div class="col-md-12">
    <?php foreach ($bodyData->results as $result) {
        if (substr($result['nombre'], -4)=='docx') {
            $resultado=base_url("temp/word.png");
        } elseif (substr($result['nombre'], -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result['nombre'], -3)=='xls') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result['nombre'], -3)=='pdf') {
            $resultado=base_url("temp/pdf.png");
        } elseif (substr($result['nombre'], -4)=='pptx') {
            $resultado=base_url("temp/ppt.png");
        } elseif (substr($result['nombre'], -3)=='txt') {
            $resultado=base_url("temp/txt.png");
        } else {
            $resultado= base_url(trim($result['ruta']));
        } ?>

    <div class="col-md-2 col-sm-6 col-xs-12">
        <div id="centrador" class="thumbnail">
            <a href="<?= base_url(trim($result['ruta']))?>" target="_blank" style=" outline: none;" class="img-rounded">
                <img id="imagen" src="<?= $resultado; ?>" class="img-responsive center-block" align="top" alt="Lights" style="width:100%"
                />
                <div class="caption">
                    <font style="font-style: italic;">
                        <strong>
                            <?=$result['descripcion'].'<br>'.$result['fec_creacion']?>
                        </strong>
                    </font>
                </div>
            </a>
        </div>
    </div>
    <?php
    } ?>
</div>

<?php
}

?>
<style>
    .right {
        float: right;

    }

    .left {
        float: left;

    }

    #centrador {
        text-align: center;
        width: 160px;
        height: 220px;

    }

    #imagen {
        width: 100px;
    }
</style>