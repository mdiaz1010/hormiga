<?php
if (count($bodyData->results)==0 || $bodyData->results==0) {
    echo "<div class='alert_result'>No se encontro ningun material registrado.</div>";
} else {
    ?>
    <div class="col-md-12">
        <div class="form-group">
            <hr>
            <?=$bodyData->mensaje?>
            <hr>
        </div>
        <?php foreach ($bodyData->results as $key => $result) {
        if (substr($result->nombre, -4)=='docx') {
            $resultado=base_url("temp/word.png");
        } elseif (substr($result->nombre, -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -4)=='xlsx') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -3)=='xls') {
            $resultado=base_url("temp/excel.png");
        } elseif (substr($result->nombre, -3)=='pdf') {
            $resultado=base_url("temp/pdf.png");
        } elseif (substr($result->nombre, -4)=='pptx') {
            $resultado=base_url("temp/ppt.png");
        } elseif (substr($result->nombre, -3)=='txt') {
            $resultado=base_url("temp/txt.png");
        } else {
            $resultado= base_url(trim($result->ruta));
        } ?>
        <div class="col-md-55 form-group">
        <label for="exampleFormControlTextarea2">Documento adjunto:<?=$key+1?></label>
            <div class="thumbnail">
                <div class="image view view-first">
                    <img id="imagen" src="<?= $resultado; ?>" class="img-responsive center-block" align="top" alt="Lights" style="width:100%" />
                    <div class="mask">
                        <p>Evidencia</p>
                        <div class="tools tools-bottom">
                            <a href="<?= base_url(trim($result->ruta))?>" target="_blank" style=" outline: none;">
                                <i class="fa fa-link"></i>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="caption">
                    <p><?=$result->nombre.'<br>'.$result->fec_creacion?></p>
                </div>
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
            width: 150px;
            height: 280px;
        }

        #imagen {
            width: 100px;
        }
    </style>
