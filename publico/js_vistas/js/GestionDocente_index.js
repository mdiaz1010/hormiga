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
                           $("#bandejaMaterial").html("");
                           $("#rol_curso").html("");
                           $("#rol_seccion").html("");
                           $('#rol_bimestre').html("");

                   } else {
                           $.post(url + 'GestionDocente/comboSeccionProf', {
                                   grado: grado
                           }, function (data) {
                                   $('#rol_seccion').html(data);
                                   $("#bandejaMaterial").html("");
                                   $("#rol_curso").html("");
                                   $('#rol_bimestre').html("");
                           });
                   }

           });



           $('#rol_seccion').change(function () {
                   var seccion = $(this).val();
                   var grado = $('#rol_grado').val();
                   if (seccion === '') {
                           $("#bandejaMaterial").html("");
                           $("#rol_curso").html("");
                           $('#rol_bimestre').html("");

                   } else {
                           $.post(url + 'GestionDocente/comboCursoProf', {
                                   seccion: seccion,
                                   grado: grado
                           }, function (data) {
                                   $('#rol_curso').html(data);
                                   $('#rol_bimestre').html("");
                                   $("#bandejaMaterial").html("");
                           });
                   }

           });

           $('#rol_curso').change(function () {
                   var curso = $(this).val();

                   if (curso === '') {
                           $("#bandejaMaterial").html("Ingrese el bimestre...");
                           $('#rol_bimestre').html("");
                   } else {
                           $.post(url + 'GestionDocente/comboBimeProf', {}, function (data) {
                                   $('#rol_bimestre').html(data);
                                   $("#bandejaMaterial").html("Ingrese el bimestre...");
                           });
                   }
           });

           $('#rol_bimestre').change(function () {
                   var bimestre = $(this).val();
                   var curso = $('#rol_curso').val();
                   var grado = $('#rol_grado').val();
                   var seccion = $('#rol_seccion').val();
                   $("#DIVcargas").dialog('open');
                   $.post(url + 'GestionDocente/comboBandeProf', {
                           curso: curso,
                           grado: grado,
                           seccion: seccion,
                           bimestre: bimestre
                   }, function (data) {
                           $("#DIVcargas").dialog('close');
                           if (bimestre.length > 0) {
                                   $("#bandejaMaterial").html(data);
                                   document.getElementById('materialDocentesubir').style.display = 'block';
                           } else {
                                   $("#bandejaMaterial").html("Ingrese el bimestre...");
                                   document.getElementById('materialDocentesubir').style.display = 'none';
                           }
                   });

                   $.ajax({
                           type: "POST",
                           url: url + 'GestionDocente/verbandejaprof',
                           data: {
                                   curso: curso,
                                   grado: grado,
                                   seccion: seccion,
                                   bimestre: bimestre
                           },
                           success: function (datos) {

                                   $('#bandejaMaterial2').html(datos);
                                   return false;
                           }
                   });

           });


   });