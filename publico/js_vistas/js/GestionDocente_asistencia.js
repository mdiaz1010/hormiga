   $('#DIVcargas').dialog({
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
   $('#DIVcargas').dialog({
           draggable: false
   });
   $('#DIVcargas').dialog({
           resizable: false
   });


   $(document).ready(function () {

           var url = $("#url").val();
           $('#rol_grado').change(function () {
                   var grado = $(this).val();
                   if (grado === 'Seleccione') {
                           $("#bandejaAsistencia").html("Ingrese el Curso...");
                           $("#rol_seccion").html('');
                           $("#rol_curso").html('');
                   } else {
                           $.post(url + 'GestionDocente/comboSeccionProf', {
                                   grado: grado
                           }, function (data) {
                                   $('#rol_seccion').html(data);
                                   $("#rol_curso").html('');
                                   $("#bandejaAsistencia").html("Ingrese el Curso...");
                           });
                   }

           });



           $('#rol_seccion').change(function () {
                   var seccion = $(this).val();
                   var grado = $('#rol_grado').val();
                   if (seccion === '') {
                           $("#bandejaAsistencia").html("Ingrese el Curso...");
                           $("#rol_curso").html('');
                   } else {
                           $.post(url + 'GestionDocente/comboCursoProf', {
                                   seccion: seccion,
                                   grado: grado
                           }, function (data) {
                                   $('#rol_curso').html(data);
                                   $("#bandejaAsistencia").html("Ingrese el Curso...");
                           });
                   }
           });

           $('#rol_curso').change(function () {
                   var curso = $(this).val();
                   var grado = $('#rol_grado').val();
                   var seccion = $('#rol_seccion').val();
                   if (curso === '') {
                           $("#bandejaAsistencia").html("Ingrese el Curso...");

                   } else {
                           $("#DIVcargas").dialog('open');

                           $.post(url + 'GestionDocente/comboBandeAsis', {
                                   curso: curso,
                                   grado: grado,
                                   seccion: seccion
                           }, function (data) {
                                   $("#DIVcargas").dialog('close');
                                   $("#bandejaAsistencia").html(data);
                           });
                   }


           });




   });