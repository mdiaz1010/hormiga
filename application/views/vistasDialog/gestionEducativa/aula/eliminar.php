<?php ?>
<div class="ui-widget">
    <div style="padding: 0 .7em;" align="center">
        <p>
            <strong>
                ¿Seguro que desea Anular este registro?
                <input type="hidden" id='txtcursoa' name="txtcursoa" size="20" value="<?php echo $bodyData->aula['curso'] ?>" readonly>
                <input type="hidden" id='txtgradoa' name="txtgradoa" size="20" value="<?php echo $bodyData->aula['grado'] ?>" readonly>
                <input type="hidden" id='txtsecciona' name="txtsecciona" size="20" value="<?php echo $bodyData->aula['seccion'] ?>" readonly>
            </strong>
        </p>
    </div>
</div>