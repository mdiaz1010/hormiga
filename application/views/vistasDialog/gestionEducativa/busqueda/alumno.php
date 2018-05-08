<?php if ($bodyData->respuesta>0) {
    ?>

<div class="row">
<div class="container col-lg-12"   >
   
<div class="panel panel-primary">
       
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h1 class="panel-title"><span class="fa fa-search"></span> INTRANET EDUCATIVO - Consultar Informacion </h1>
        </div>
        <div class="panel-body">
            <div class="col-xs-10">   
            <form  method="post"  name="crearusuario" id="crearusuario">
                <div class="container" >

                <label class="col-xs-6 col-md-9">
                    Apellidos y Nombres:
                    <input name="apepat"  id="apepat" placeholder="Apellido paterno"  class="form-control"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"     value="<?=$bodyData->results1['apepat']?>" readonly >
                </label>                                   
                <label class="col-xs-6 col-md-3">
                    Rol:
                    <input name="rol"   id="rol" placeholder="Rol"  class="form-control"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"                       value="<?=$bodyData->results1['usuari']?>"     readonly >
                </label>                
                <label class="col-xs-6 col-md-3">
                    Telefono: 
                    <input name="telefono"  id="telefono" placeholder="Telefono" type="text"  class="form-control" value="<?=$bodyData->results1['telefo']?>" readonly>
                </label>                  
                <label class="col-xs-6 col-md-3">
                    Dni:
                    <input name="documento" id="documento" placeholder="documento" type="text" class="form-control" required value="<?=$bodyData->results1['docume']?>" readonly>
                </label>        
                <label class="col-xs-6 col-md-3">
                    email:
                    <input name="email" id="email"  placeholder="email" type="email " class="form-control" required value="<?=$bodyData->results1['correo']?>" readonly>
                </label>                 
                <label class="col-xs-6 col-md-3">
                    Grado y Seccion:
                    <input name="grado" id="grado"  placeholder="email" type="email " class="form-control" required value="<?=$bodyData->results1['grados']?>" readonly>
                </label>                          
                </div>
                <div class="container">
                <label class="col-xs-6 col-md-3">
                    Fecha de Nacimiento:
                    <input name="fecha" id="fecha" type="date"  placeholder="fecha"  class="form-control" required value="<?=$bodyData->results1['fecha']?>" >
                </label>      
                <label class="col-xs-6 col-md-9">
                    Direccion: 
                    <textarea name="direccion" id="direccion" placeholder="Direccion "  class="form-control" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="1"  ><?=$bodyData->results1['direcc']?></textarea>
                </label>                                                                    
                </div>                          

            </form>               
        </div>
            
            <div class="col-xs-2">
                    <div id="centrador" class="thumbnail">         
                                <a  href="#"  style=" outline: none;"   class="img-rounded">
                                <img id="imagen" src="<?= base_url($bodyData->results1['ruta'])?>" class="img-responsive center-block" align="top" alt="Lights" style="width:100%" />
                                </a>                
                    </div>                                   
            
            </div>
    </div>

</div>   

              <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
              <div class="x_title">
              <div id="horarios">
              <center> <i id="horarios-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>
              </div>
              </div>
              </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-graduation-cap"></i> Orden de merito</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                  <div class="clearfix"></div>
                  </div>
                        <div id="puestos">
                        <center> <i id="puestos-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>
                        </div>
                </div>
              </div>     
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2><i class="fa fa-line-chart"></i> Rendimiento academico</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    <div id="rendimiento">
                    <center> <i id="rendimiento-load" class="fa fa-circle-o-notch fa-spin" style="font-size:24px;color:#ec7063"></i></center>

                    </div>
                </div>
              </div>      
     <div class="clearfix"></div>
                 
    
 </div>
<input type="hidden" name="codigo" id="codigo" value="<?=$bodyData->codigo?>"> 
<script>
    var codigo= $("#codigo").val();
    $.post( '<?=base_url('GestionEducativa/horario')?>',{codigo:codigo},function (data){                
    $("#horarios").html(data);
     } );
     $.post( '<?=base_url('GestionEducativa/puestos')?>',{codigo:codigo},function (data){                
    $("#puestos").html(data);
     } );
     $.post( '<?=base_url('GestionEducativa/rendimiento')?>',{codigo:codigo},function (data){                
    $("#rendimiento").html(data);
     } );          
</script>
<?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>