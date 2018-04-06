   $('#DIVcargas').dialog({
        autoOpen: false,
        hide:'drop',
        width: 300,
        height: 150,
        closeOnEscape: false,
        open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
        modal: true,
        buttons: {
	        "CERRAR": function() {
	                $(this).dialog("close");                        
	        }
	    }
	});        
    $('#DIVcargas').dialog({ draggable: false });
    $('#DIVcargas').dialog({ resizable: false });
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
     	
$(document).ready(function(){

	
	$('#rol_grado').change(function (){    
            
		var grado=$(this).val();		
                if(grado==='Seleccione'){
                $('#rol_seccion').html('');    
                $("#bandejaAsistencia").html("Ingrese el Curso...");
                }else{
		$.post( 'comboSeccionAux',{grado:grado},function (data){
			$('#rol_seccion').html(data);
                        $("#bandejaAsistencia").html("Ingrese el Curso...");                            
			} );                    
                }

	});
	
	
	
	$('#rol_seccion').change(function (){
		var seccion=$(this).val();
		var grado=$('#rol_grado').val();		
                 if(seccion===''){   
                    $("#bandejaAsistencia").html("Ingrese el Curso...");
		
                  }else{
                    $.post( 'comboBandeAsis',{grado:grado,seccion:seccion},function (data){
                    $("#bandejaAsistencia").html(data);                               
                    	});        
                           
                  }                        
	});


    
   
});

