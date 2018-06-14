$(document).ready(function () {
  $("#errors").hide();
  $("#exitos").hide();
  $(window).load(function () {
    $(':input:visible:enabled:first').focus();
  });
  $('#DIVcargando').dialog({
    autoOpen: false,
    hide: 'drop',
    width: 360,
    height: 80,
    closeOnEscape: true,
    open: function (event, ui) {
      $(".ui-dialog-titlebar-close").hide();
    },
    modal: true
  });
  $('#DIVcargando').dialog({
    draggable: false
  });
  $('#DIVcargando').dialog({
    resizable: false
  });

  $("#btnIngresar").click(function () {
    var usuario = $("#user").val();
    var clave = $("#pass").val();

    $.ajax({
      data: $("#loginf").serialize(),
      type: "POST",
      dataType: 'json',
      url: "login",
      beforeSend: function (datos) {
        $("#DIVcargando").dialog("open");
      },
      success: function (datos) {
        if (datos.error == 1) {
          $("#errors").show();
          $("#DIVcargando").dialog("close");
          return true;
        }
        $("#exitos").show();
        $("#errors").hide();
        $("#DIVcargando").dialog("close");
        location.href = datos.vista;
      }
    });

  });

  $(document).keypress(function (e) {
    if (e.which == 13) {
      var usuario = $("#user").val();
      var clave = $("#pass").val();

      $.ajax({
        data: $("#loginf").serialize(),
        type: "POST",
        dataType: 'json',
        url: "login",
        beforeSend: function (datos) {
          $("#DIVcargando").dialog("open");
        },
        success: function (datos) {

          if (datos.error == 1) {
            $("#errors").show();
            $("#DIVcargando").dialog("close");
            return true;
          }
          $("#exitos").show();
          $("#errors").hide();
          $("#DIVcargando").dialog("close");
          location.href = datos.vista;


        }
      });


    }
  });

  $(".recuperar_contrasena").click(function () {
    location.href = 'recuperar_contrasena';
  });
});