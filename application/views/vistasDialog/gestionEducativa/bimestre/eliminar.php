<?php ?>
    <div class="ui-widget">
        <div  style="padding: 0 .7em;" align="center">
                <p>
                    <strong>
                   ¿Seguro que desea eliminar el bimestre con codigo BIM000<?php echo $bodyData->codigo?>?
                   <input  type="hidden"    id='txtcodigo'  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"  name="txtcodigo"    size="20" value="<?php echo $bodyData->codigo ?>" readonly >
                    </strong>
                </p>
        </div>
    </div>