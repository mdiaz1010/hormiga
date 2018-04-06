$('#rol').change(function() {
    
     var seleccion = document.getElementById('rol');
     var valor = seleccion.options[seleccion.selectedIndex].value;//coges el valor
     var texto = seleccion.options[seleccion.selectedIndex].text;
        if(valor==6){

document.getElementById('SoloCliente').style.display='block';
//por el contrario, si no esta seleccionada
} else {
//oculta el div con id 'desdeotro'
document.getElementById('SoloCliente').style.display='none';
}
     
    });


//actualizar bandeja
            $.ajax({
                type : "POST",
                url : "vistabandeja",
                success : function(datos){                    
                    $('#bandejaprincipal').html(datos);
                    return false;
                }
            });    
//HORARIO CARGA
   $('#DIVcargas').dialog({
        autoOpen: false,
        hide:'drop',
        width: 360,
        height: 80,
        closeOnEscape: false,
        open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
        modal: true
	});        
    $('#DIVcargas').dialog({ draggable: false });
    $('#DIVcargas').dialog({ resizable: false });

$("#btnregistrar").click(function(){
var nombre=$("#nombre").val();
var apepat=$("#apepat").val();
var apemat=$("#apemat").val();
var roless=$("#rol").val();
var nomusu=$("#usuario").val();
var clavus=$("#pass").val();
var telefo=$("#telefono").val();
var dni   =$("#documento").val();
var emails=$("#email").val();
var direcc=$("#direccion").val();
if(nombre===''){
    $('#result_error').html("<font color='red'>Campo Nombre (*) Obligatorio</font>");              return true;
}else if(apemat===''){
    $('#result_error').html("<font color='red'>Campo Apellido Materno (*) Obligatorio</font>");    return true;
}else if(apepat===''){
    $('#result_error').html("<font color='red'>Campo Apellido Paterno (*) Obligatorio</font>");    return true;
}else if(roless===''){
    $('#result_error').html("<font color='red'>Campo Rol              (*) Obligatorio</font>");    return true;
}else if(nomusu===''){
    $('#result_error').html("<font color='red'>Campo Usuario          (*) Obligatorio</font>");    return true;        
}else if(clavus===''){
    $('#result_error').html("<font color='red'>Campo Clave            (*) Obligatorio</font>");    return true;        
}else if(telefo===''){
    $('#result_error').html("<font color='red'>Campo Telefono         (*) Obligatorio</font>");    return true;            
}else if(dni===''){
    $('#result_error').html("<font color='red'>Campo dni              (*) Obligatorio</font>");    return true;                
}else if(emails===''){
    $('#result_error').html("<font color='red'>Campo Email            (*) Obligatorio</font>");    return true;                    
}else if(direcc===''){
    $('#result_error').html("<font color='red'>Campo Direccion        (*) Obligatorio</font>");    return true;                        
}else{
             $.ajax({
                type : "POST",
                url : "crear",
                data: $("#crearusuario").serialize(),
                success : function(){             
                    $("result_error").html("<font color ='green'>REGISTRO CORRECTO</font>");                    
                    $("#bandejaprincipal").load("vistabandeja");                     
                    $("#crearusuario")[0].reset();
                    $('#result_error').html("");
                    return false;
                    
                }
            });      
            }
   }); 
    

$("#btnMasivo").click(function(){
                                var inputimage = document.getElementById('archiMas'),                                
                                formdata = new FormData();   
                                var i = 0, len = inputimage.files.length, img, reader, file;                              
                                for( ; i < len; i++){
                                file = inputimage.files[i];
                                if(formdata)
                                formdata.append('images[]', file);   
                                }
                                $.ajax({
                                    type: 'POST',
                                    url:   "import_data",
                                    data: formdata,
                                    processData : false                         , 
                                    contentType : false                         ,                                     
                                    beforeSend: function(){     
                                        $("#DIVcargas").dialog("open");
                                    },
                                    success: function () {
                                        $("#DIVcargas").dialog("close");
                                        $("#bandejaprincipal").load("vistabandeja"); 
                                        //location.reload();
                                    }
                                    }); 
    
});


$("#btnMasivoalu").click(function(){
                                var inputimage = document.getElementById('archiMasAlu'),                                
                                formdata = new FormData();   
                                var i = 0, len = inputimage.files.length, img, reader, file;                              
                                for( ; i < len; i++){
                                file = inputimage.files[i];
                                if(formdata)
                                formdata.append('images[]', file);   
                                }
                                $.ajax({
                                    type: 'POST',
                                    url:   "import_data_alumnos",
                                    data: formdata,
                                    processData : false                         , 
                                    contentType : false                         ,                                     
                                    beforeSend: function(){     
                                        $("#DIVcargas").dialog("open");
                                    },
                                    success: function () {
                                        $("#DIVcargas").dialog("close");
                                        $("#bandejaprincipal").load("vistabandeja"); 
                                        //location.reload();
                                    }
                                    }); 
    
});



$(document).ready(function() {    
    $('[name="permisosTrigger"]').click(function($element){
        var id = $(this).attr("data-id"); 
        $( "#permisosModal" ).modal("show"); 
        cargarData(id);
    });
               
    function cargarData (id){

        $.ajax({
            url: "permisos",
            method: "POST",
            data: { id : id },
            dataType: "html"
        }).done(function( msg ) { //alert("bien");
            var height = $(window).height() * 0.75 ;
            var width = $(window).width()  * 0.90 ;
            var modal = $( "#permisosModal" );
            modal.find('.modal-body') .html( msg );
            modal.find(".modal-dialog").css("width","90%");
            modal.find('.modal-body').css({"max-height":height   } );             
            var htmlHead = modal.find('.modal-body .nombreUsuario').html(); 
            modal.find('.modal-footer .nombre').prepend(''+htmlHead+'');
        }).fail(function( jqXHR, textStatus ) {
            var msj ="Error de Conexion";
            if(jqXHR.status===401){
                msj ="Acceso Denegado";
            }
            var modal = $( "#permisosModal" );
            modal.find('.modal-body') .html( "<p> "+msj+" </p>" );
        });        
    }
});

    /*LIMPIEZA */
$(document).ready(function() {
    
    $('#permisosModal').on('hidden.bs.modal', function (e) {
        /*LIMPIAR DISPARADORES */
        $(this).find('button').unbind(); 
        $(this).find('.modal-body').html('<center><img src="publico/media/ajax-loader2.gif" width="80" height="80" ></center>'); 
        $(this).find('.modal-footer .nombre').html('');
    });
});


 



    
 
var f=new Date();
var ano = f.getFullYear();
var mes = f.getMonth();
var dia = f.getDate();
var estiloDia;
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var diasMes = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
var diaMaximo = diasMes[mes];
if (mes == 1 && (((ano % 4 == 0) && (ano % 100 != 0)) || (ano % 400 == 0)))
   diaMaximo = 29;

        

function show(){
var Digital=new Date();
var hours=Digital.getHours();
var minutes=Digital.getMinutes();
var seconds=Digital.getSeconds();
var dn="AM" ;
if (hours>12){
dn="PM";
hours=hours-12;
}
if (hours==0){
hours=12;
}
if (minutes<=9){
minutes="0"+minutes;}
if (seconds<=9){
seconds="0"+seconds;}
    $('#hora').val(hours+":"+minutes+":"+seconds+" "+dn);// IMPRIMO LA HORA
setTimeout("show()",1000);
}
show();
        
 
            


     
    fechaImprimible =diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] ;
   
        
    $("#fecha").val(fechaImprimible); //IMPRIMO LA FECHA
     






         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
$(":file").filestyle({buttonName: "btn-primary"});