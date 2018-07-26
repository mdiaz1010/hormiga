<div class="table-responsive">
    <table class="table table-striped  bulk_action">
        <thead style="color: #fff; background-color: #2A3F54;">
            <tr class="headings">
                <th class="column-title">#</th>
                <th class="column-title">Curso</th>
                <th class="column-title">
                    <center> Prom. final </center>
                </th>
                <th class="column-title">
                    <center> Resultado </center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $a=0; foreach ($bodyData->results as $key => $value) :
                            if($value['criterio']=='APROBADO'){
                                $color="#2E9AFE";

                            }else if($value['nota']==''){
                                $color="#FFF";
                                $a++;
                            }else{
                                $color="#FE2E2E";

                            }
                ?>
            <tr>
                <th scope="row">
                    <?=$key+1;?>
                </th>
                <td>
                    <?=$value['nom_cursos'];?>
                </td>
                <td bgcolor=<?=$color?>>
                    <strong>
                        <center>
                            <font color="#ffffff">
                                <?=$value['nota'];?>
                            </font>
                        </center>
                    </strong>
                </td>
                <td>
                    <strong>
                        <center>
                            <?=$value['criterio'];?>
                        </center>
                    </strong>

                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class="container">
<h3>Mensaje:</h3>
<strong><P><?=$bodyData->mensaje?> </P></strong>

</div>