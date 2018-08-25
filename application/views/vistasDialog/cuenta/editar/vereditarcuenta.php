<?php
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_content">
        <form  method="post" name="edicioncuenta" id="edicioncuenta">
            <div class="form-group">

                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Apellidos y nombres:
                    <input type="hidden" id='txtid' name="txtid" value="<?php echo $bodyData->datoscuenta[0]->CODIGO; ?>">
                    <input type="text" class="form-control" id='txtapepatcuenta' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        name="txtapepatcuenta" size="35" value="<?php echo $bodyData->datoscuenta[0]->APEPAT; ?>" required>
                    </td>
                </label>
                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Telefono:
                    <input type="text" class="form-control" id='txttelefocuenta' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        name="txttelefocuenta" size="35" value="<?php echo $bodyData->datoscuenta[0]->TELEFO; ?>" required>
                </label>
                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Dni:
                    <input type="text" class="form-control" id='txtdocumecuenta' style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"
                        name="txtdocumecuenta" size="35" value="<?php echo $bodyData->datoscuenta[0]->DOCUME; ?>" required>
                </label>
                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Email:
                    <input type="email" class="form-control" id='txtemailscuenta' name="txtemailscuenta" size="35" value="<?php echo $bodyData->datoscuenta[0]->CORREO; ?>" required>
                </label>
                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Usuario:
                    <input type="text" class="form-control" id='txtusuaricuenta' name="txtusuaricuenta" size="35" value="<?php echo $bodyData->datoscuenta[0]->USUARI; ?>" required>
                </label>
                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Clave:
                    <input type="password" class="form-control" id='txtclavescuenta' name="txtclavescuenta" size="35" value="<?php echo $bodyData->datoscuenta[0]->CLAVES; ?>" required>
                </label>
                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Repetir clave:
                    <input type="password" class="form-control" id='pass_repetida' name="pass_repetida" size="35" value="<?php echo $bodyData->datoscuenta[0]->CLAVES; ?>" required>
                </label>
            </div>
            <div class="form-group">

                <label class="control-label col-md-12 col-sm-12 col-xs-12">
                    Direccion:
                    <input type="text" class="form-control" id='txtdirecccuenta' name="txtdirecccuenta" size="35" value="<?php echo $bodyData->datoscuenta[0]->DIRECC; ?>" required>
                </label>
            </div>
        </form>
    </div>
</div>
<script>
$.validator.methods.email = function (value, element) {
    return this.optional(element) || /[a-zA-Z0-9_.+-]+@[a-z]+\.[a-z]+/.test(value);
}
$.validator.methods.documento = function (value, element) {
    $.post(url + "GestionEducativa/validar_documento", {
        documento: value
    }, function (data) {
        valor = data;
    });
    if (valor == "true")
        return false;
    return true;
}
$.validator.addMethod("valueNotEquals", function (value, element, arg) {
    return arg !== value;
}, "Value must not equal arg.");
$.validator.addMethod("maxDate", function (value, element) {
    var curDate = new Date();
    var inputDate = new Date(value);
    if (inputDate < curDate)
        return true;
    return false;
});
jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
});
$("#edicioncuenta").validate({

    rules: {
        txtapepatcuenta: {
            required: true,
            minlength: 6,
            maxlength: 60
        },
        txtusuaricuenta: {
            required: true,
            minlength: 6,
            maxlength: 60
        },
        txtclavescuenta: {
            required: true,
            minlength: 6
        },
        pass_repetida: {
            equalTo: "#txtclavescuenta"
        },
        txttelefocuenta: {
            required: true,
            minlength: 7,
            maxlength: 9,
            number: true
        },
        txtdocumecuenta: {
            required: true,
            number: true,
            minlength: 8,
            maxlength: 12
        },
        email: {
            required: true,
            email: true
        },
        txtdirecccuenta: {
            required: true,
            maxlength: 220
        },


    },
    messages: {
        txtapepatcuenta: {
            required: "Este campo es obligatorio",
            minlength: "Ingresar apellidos y nombres completos",
            maxlength: "Se ha excedido de la capacidad permitida"
        },
        txtusuaricuenta: {
            required: "Este campo es obligatorio",
            minlength: "Ingresar un mínimo de 6 caracteres",
            maxlength: "Se ha excedido de la capacidad permitida"
        },
        txtclavescuenta: {
            required: " Este campo es obligatorio",
            minlength: " La contraseña debe de tener como mínimo 6  dígitos"
        },
        pass_repetida: {
            equalTo: "Las contraseñas no coinciden"
        },
        txttelefocuenta: {
            required: " Este campo es obligatorio",
            minlength: " El telefóno a ingresar debe de contar como mínimo con 7 dígitos",
            maxlength: " El telefóno a ingresar debe de contar como máximo con 9 dígitos",
            number: " Por favor ingresar solo números"
        },
        txtdocumecuenta: {
            required: " Este campo es obligatorio",
            minlength: " El documento a ingresar debe de tener como mínimo 8  dígitos",
            maxlength: " El documento a ingresar debe de tener como máximo 12 dígitos",
            number: "Debe ingresar un valor numérico"
        },
        email: {
            required: " Este campo es obligatorio",
            email: " El correo a ingresar debe de tener el siguiente formato name@dominio.com"
        },
        txtdirecccuenta: {
            required: " Este campo es obligatorio",
            maxlength: "Solo puede ingresar un máximo de 220 caracteres."
        }
    }

});
</script>