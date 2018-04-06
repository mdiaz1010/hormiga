$(document).ready(function() {

  
  $('#DIVcargando').dialog({
          autoOpen: false,
          hide:'drop',
          width: 360,
          height: 80,
          closeOnEscape: true,
          open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
          modal: true
    });        
      $('#DIVcargando').dialog({ draggable: false });
      $('#DIVcargando').dialog({ resizable: false });   

$("#btnIngresar").click(function(){
 var usuario=$("#user").val(); 
 
 var clave=$("#pass").val();
 if(usuario.length!==0 || clave.length!==0 ){
  $.ajax({
    data: $("#loginf").serialize(),
    type: "POST",
    dataType: 'json',
    url: "login/login",
    beforeSend: function(data){
                                    
                                    $("#DIVcargando").dialog("open");    
    },success : function(data){
        
                                    $("#DIVcargando").dialog("close");  
                                    location.href=data.vista;
                                    

    }
  });
}else{
 alert("No se permiten campos vacios"); return true;
}
});
});

