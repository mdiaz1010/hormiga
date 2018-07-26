<table class="table table-bordered" cellspacing="0" width="100%" id="dataTables-material">
    <thead style="color: #fff;background-color: #2A3F54;">
        <tr>
            <th>
                <center>NRO</center>
            </th>
            <th>
                <center>CURSO</center>
            </th>
            <th>
                <center>DESCRIPCION</center>
            </th>
            <th>
                <center>FEC. CREACION</center>
            </th>
            <th>
                <center>DOC</center>
            </th>

        </tr>
    </thead>
    <tbody>
        <?php foreach($bodyData->result as $key =>$value):?>
        <tr>

            <td>
                <center>
                    <?=$key+1?>
                </center>

            </td>

            <td>
                <center>
                    <?=$value['nom_cursos']?>
                </center>
            </td>
            <td>
                <p align="justify">
                    <?=$value['descripcion']?>
                </p>
            </td>
            <td>
                <p align="justify">
                    <?=$value['fec_creacion']?>
                </p>
            </td>
            <td>
                <center>
                    <a href="<?= base_url(trim($value['ruta']))?>" target="_blank" style=" outline: none;" class="img-rounded">
                    <?=$value['nom_archivo']?>
                    </a>
                </center>
            </td>


        </tr>

        <?php endforeach;?>
    </tbody>
</table>




<script type="text/javascript">

    $("#dataTables-material").dataTable();
</script>