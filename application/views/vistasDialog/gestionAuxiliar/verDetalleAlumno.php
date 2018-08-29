


            <font style="font-style: italic;">
                <?=$bodyData->alumno;?>
            </font>




        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap " cellspacing="0" width="100%" id="dataTables-asistedet">
                <thead style="color: #fff;background-color: #2A3F54;">
                    <tr>
                        <th>
                            <center>NRO</center>
                        </th>
                        <th>
                            <center>FECHA</center>
                        </th>
                        <th>
                            <center>ASISTENCIA</center>
                        </th>
                        <th>
                            <center>MOTIVO</center>
                        </th>
                        <th>
                            <center>JUSTIFICADO</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                                            $i=1;
                                            $j=0;
                                            $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                                            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                            foreach ($bodyData->results as $cuentasTemp) {
                                                if (trim($cuentasTemp->asistencia)=='f') {
                                                    $color='bgcolor="#F8E0E0"';
                                                    //$color='bgcolor="#F7819F"';
                                                } else {
                                                    $color='';
                                                } ?>
                        <tr id="<?=$i?>">
                            <input type="hidden" name="ano[]" id="ano" value="<?=$cuentasTemp->ano?>">
                            <input type="hidden" name="mes[]" id="mes" value="<?=$cuentasTemp->mes?>">
                            <input type="hidden" name="dia[]" id="dia" value="<?=$cuentasTemp->dia?>">
                            <td <?=$color; ?>>
                                <CENTER>
                                    <?= $i; ?>
                                </CENTER>
                            </td>
                            <td <?=$color; ?>>
                                <CENTER>
                                    <?= $cuentasTemp->dia." de ".$meses[$cuentasTemp->mes-1]; ?>
                                </CENTER>
                            </td>
                            <td <?=$color; ?>>
                                <CENTER>
                                    <strong>
                                        <?=strtoupper($cuentasTemp->asistencia); ?>
                                    </strong>
                                </CENTER>
                            </td>
                            <td <?=$color; ?>>
                            <?php if(empty($cuentasTemp->mensaje)){ ?>
                            <CENTER></CENTER>
                            <?php }else{?>
                                <CENTER>
                                    <textarea style="border: none;" rows="2" readonly class="form-control"><?=$cuentasTemp->mensaje?></textarea>
                                </CENTER>
                            <?php }?>

                            </td>
                            <?php if ($cuentasTemp->respuesta=='1') {
                                                    $mensaje='SI';
                                                } elseif ($cuentasTemp->respuesta=='2') {
                                                    $mensaje='NO';
                                                } else {
                                                    $mensaje='';
                                                } ?>
                            <td <?=$color; ?>>
                                <CENTER>
                                    <?=$mensaje; ?>
                                </CENTER>
                            </td>
                        </tr>
                        <?php
                                               $i++;
                                                $j++;
                                            }
                                            ?>

                </tbody>
            </table>
        </div>





<script>
</script>
<script type="text/javascript">
    $("#dataTables-asistedet").dataTable();
</script>
<script>//tinymce.init({ selector:'textarea' });</script>