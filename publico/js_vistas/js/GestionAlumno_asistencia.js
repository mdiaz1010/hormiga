           var url = $("#url").val();
           $('#DIVcargas').dialog({
               autoOpen: false,
               hide: 'drop',
               width: 360,
               height: 80,
               closeOnEscape: false,
               open: function (event, ui) {
                   $(".ui-dialog-titlebar-close").hide();
               },
               modal: true
           });
           $('#DIVcargas').dialog({
               draggable: false
           });
           $('#DIVcargas').dialog({
               resizable: false
           });

           $.post(url + 'GestionAlumno/bandejaAsistenciaAlu/' + "total", {}, function (data) {

               $("#bandejaAsistenciaAlu").html(data);


           });
           $(document).ready(function () {
               $('#rol_curso').change(function () {
                   var curso = $(this).val();
                   $("#DIVcargas").dialog('open');
                   $.post(url + 'GestionAlumno/bandejaAsistenciaAlu/' + curso, {}, function (data) {
                       if (curso.length > 0) {
                           $("#DIVcargas").dialog('close');
                           $("#bandejaAsistenciaAlu").html(data);

                       } else {
                           $("#bandejaAsistenciaAlu").html("Ingrese el Curso...");

                       }
                   });

               });
           });