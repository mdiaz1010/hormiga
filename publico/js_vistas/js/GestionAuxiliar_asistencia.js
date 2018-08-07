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
               $('#rol_seccion').html('');
               $("#bandejaAsistencia").html("Ingrese el Curso...");
           } else {
               $.post(url + 'GestionAuxiliar/comboSeccionAux', {
                   grado: grado
               }, function (data) {
                   $('#rol_seccion').html(data);
                   $("#bandejaAsistencia").html("Ingrese el Curso...");
               });
           }

       });



       $('#rol_seccion').change(function () {
           var seccion = $(this).val();
           var grado = $('#rol_grado').val();
           if (seccion === '') {
               $("#bandejaAsistencia").html("Ingrese el Curso...");

           } else {
               $("#DIVcargas").dialog('open');
               $.post(url + 'GestionAuxiliar/comboBandeAsis', {
                   grado: grado,
                   seccion: seccion
               }, function (data) {
                   $("#DIVcargas").dialog('close');
                   $("#bandejaAsistencia").html(data);
               });

           }
       });




   });