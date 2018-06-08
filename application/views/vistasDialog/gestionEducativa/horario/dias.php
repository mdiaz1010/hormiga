<?php ?>

<form action="" name="formdias" id="formdias">

    <table class="table table-striped table-bordered dt-responsive nowrap  " cellspacing="0" width="100%" id="dataTables-cursos">
        <thead class="bg-success">
            <tr>
                <th style="border: hidden;color: #3b752e;">
                    <center>ELEGIR </center>
                </th>
                <th style="border: hidden;color: #3b752e;">
                    <center>DIA </center>
                </th>

            </tr>
        </thead>
        <tbody>
            <?php  foreach ($bodyData->dias as $dias):
                                            for ($i=0;$i<count($bodyData->dia);$i++) {
                                                if ($bodyData->dia[$i]==$dias->codigo) {
                                                    $checked='checked';
                                                    break;
                                                } else {
                                                    $checked='';
                                                }
                                            }

                                                ?>

            <tr>
                <td>
                    <CENTER>
                        <input type="checkbox" size="5" onkeyup="aMays(event, this)" <?=$checked;?> id="elegir" name="elegir[]" class="texto10negro" maxlength="50" value="
                        <?= $dias->codigo;?>" /></CENTER>
                </td>
                <td>
                    <CENTER>
                        <?= $dias->dias; ?>
                    </CENTER>
                </td>

            </tr>
            <?php
                                            endforeach; ?>
        </tbody>
    </table>


</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#enviar').click(function () {

        });
    });
</script>