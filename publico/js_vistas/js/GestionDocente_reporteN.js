$(document).ready(function(){
	
	
	$('#rol_grado').change(function (){           
		var grado=$(this).val();
                if(grado==='Seleccione'){
                            $("#bandejaReportN").html("Ingrese el bimestre...");    
                            $('#rol_curso').html('');
                            $('#rol_seccion').html('');
                            $('#rol_bimestre').html('');
                }else{
                                              
		$.post( 'comboSeccionProf',{grado:grado},function (data){
			$('#rol_seccion').html(data);
                            $("#bandejaReportN").html("Ingrese el bimestre...");    
                            $('#rol_curso').html('');
                            $('#rol_bimestre').html('');                          
			} );                    
                }

	});
	
	
	
	$('#rol_seccion').change(function (){
		var seccion=$(this).val();
		var grado=$('#rol_grado').val();		
                if(seccion===''){                            
                            $("#bandejaReportN").html("Ingrese el bimestre...");    
                            $('#rol_bimestre').html('');
                            $('#rol_curso').html('');                            
                }else{
                 
		$.post( 'comboCursoProf',{seccion:seccion,grado:grado},function (data){
			$('#rol_curso').html(data);
                            $("#bandejaReportN").html("Ingrese el bimestre...");                                                          
                            $('#rol_bimestre').html('');                           
			} );                    
                }

	});

    	$('#rol_curso').change(function (){
		var curso=$(this).val();	
                
                if(curso===''){                                
                 $("#bandejaReportN").html("Ingrese el bimestre...");    
                 $('#rol_bimestre').html("");	
                 
                } else {                

                $.post( 'comboBimeProf2',{},function (data){								
                        $('#rol_bimestre').html(data);	
                        $("#bandejaReportN").html("Ingrese el bimestre...");                                
                        } );                                       
                        }                		                        
	});

    	$('#rol_bimestre').change(function (){
		var bimestre=$(this).val();      
                var curso=$('#rol_curso').val();
		var grado=$('#rol_grado').val();
                var seccion=$('#rol_seccion').val();                
                if(bimestre===''){
                $("#bandejaReportN").html("Ingrese el bimestre...");    
                }else{
                $("#bandejaReportN").html('<center> <i id="estadistica-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>');                            
		$.post( 'comboBandeNotReport',{bimestre:bimestre,curso:curso,grado:grado,seccion:seccion},function (data){                
                            $("#bandejaReportN").html(data);
                	} );                    
                }
         
	});
    
   
});