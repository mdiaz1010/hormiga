<?php ?>
<div class="panel-heading">
    <h1 class="panel-title">
        <strong>
            <center>EDICION DE SEMESTRE</center>
        </strong>
    </h1>
</div>
<form action="" method="post" name="editarbimestresal" id="editarbimestresal">
    <table class="col-lg-12">

        <tr>
            <td class="col-lg-3">
                <label>Codigo:</label>
            </td>
            <td class="col-lg-3">
                <input type="text" id='txtcodigos' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                    name="txtcodigos" size="20" value="CURS000<?php echo $bodyData->datos["id"]?>" readonly>
            </td>
        </tr>
        <input type="hidden" id='txtcodigo' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
            name="txtcodigo" size="20" value="<?php echo $bodyData->datos["id"]?>" readonly>
        <tr>
            <td class="col-lg-3">
                <label>Bimestre:</label>
            </td>
            <td class="col-lg-3">
                <input type="text" id='txtbimestres' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                    name="txtbimestres" size="20" value="<?php echo $bodyData->datos["nom_bimestre"]?>">
            </td>
            <tr>
                <tr>
                    <td class="col-lg-3">
                        <label>Desde:</label>
                    </td>
                    <td class="col-lg-3">
                        <input type="date" id='desdes' name='desdes' size="20" value="<?php echo $bodyData->datos["desde"]?>">
                    </td>
                </tr>
                <tr>
                    <td class="col-lg-3">
                        <label>Hasta:</label>
                    </td>
                    <td class="col-lg-3">
                        <input type="date" id='hastas' name='hastas' size="20" value="<?php echo $bodyData->datos["hasta"]?>">
                    </td>
                </tr>
    </table>
</form>