<?php if ($bodyData->respuesta>0) {
    ?>
<?php if (count($bodyData->results)>0) {
        ?>

<link type="text/css" rel="stylesheet" href="<?= base_url(); ?>publico/handsontable/css/handsontable.full.css">
<script type="text/javascript" src="<?= base_url(); ?>publico/handsontable/js/handsontable.full.min.js"></script>
<!--
                                        <div class="list-group right" >

                                            <button class="btn btn-danger " title="Registrar Notas" type="button" name="btnNotas" id="btnNotas">
                                                 <i class="fa fa-floppy-o"  ></i>
                                           </button>
                                            <strong>Una vez terminado de ingresar las notas no te olvides de presionar el boton rojo para registrarlas (*)</strong>
                                        </div>
                                           -->
                                        <div class="x_content bs-example-popovers">

                                            <div   id="exito" class="alert alert-success alert-dismissible fade in" role="alert" hidden="true">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            <strong>REGISTRO EXITOSO!</strong> Las notas han sido guardadas satisfactoriamente.
                                            </div>

                                            <div id="error" class="alert alert-danger alert-dismissible fade in" role="alert"  hidden="true">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                            <strong>CORREGIR INFORMACION INGRESADA!</strong> Solo se permite el ingreso de valores numéricos entre  cero y veinte, corregir las celdas Rojas.
                                          </div>

                                        </div>
                                        <div class="x_content">
                                        <div  id="ResultadoTabla"></div>
                                        </div>


<?php
    } else {
        echo "<div class='alert_result'>No se encuentra ningun alumno registrado.</div>";
    } ?>

<script type="text/javascript">

busqueda=<?=json_encode($bodyData->datos) ?>;
data1= <?= json_encode($bodyData->tabla) ?>;
var bool ='';
var cabeceras =<?= $bodyData->marcados?>;
  yellowRenderer = function(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    td.style.backgroundColor = 'yellow';

  };
  greenRenderer = function(instance, td, row, col, prop, value, cellProperties) {
    Handsontable.renderers.TextRenderer.apply(this, arguments);
    td.style.backgroundColor = 'green';

  };
configuraciones={

    data:data1,
    colHeaders:true,
    rowHeaders:false,
    yellowRenderer,
    fixedRowsTop: 0,
    nestedHeaders: [
        <?=$bodyData->head_primera?>,//comentado , se está prefiriendo optimización antes de estética
        <?=$bodyData->head?>
    ],
    stretchH: 'all',
    columns:<?=$bodyData->column?>,
    afterValidate: function(isValid){bool=isValid;},
    formulas:true,
    afterCreateRow:function(index,numberOfRows){
                data1.splice(index,numberOfRows);//limita crecimiento de la tabla
            },
    cell: [
                {row: 0, col: 0, renderer: greenRenderer}
    ],
   /*         ,
    afterChange: function(registroModificados,accionesHandsontable){
        if(accionesHandsontable!='loadData'){
            registroModificados.forEach(function(elemento){
            var fila= tblExcel.getData()[elemento[0]];
                            });
                            $('#exito').hide();
                            $('#error').hide();
        }
    },
            afterRender: function(){
                render_color(this);
            }*/
    };

function render_color(ht){
  var valor;
  for(var i=0;i<ht.countRows();i++){
    for(var p=0;p<ht.countCols();p++){

 var ide=ht.getDataAtCell(i,p);


if(p==0){
  font_color = "#070719";
}else{
  if(ide<=10.4){
  font_color = "#E74C3C";
  }else{
  font_color = "#000";
  }
}



      $(ht.getCell(i,p)).css({"color": font_color});
    }

  }
}

tblExcel=new Handsontable(document.getElementById('ResultadoTabla'),configuraciones);
tblExcel.render();

$("#btnNotas").click(function(){
   var h=1;
   var contador=0;
  for(i=0;i<data1.length;i++){h=1;

      for(j=0;j<5;j++){
          if(parseInt(data1[i]['C'+h])<0 ) {contador++;}
          if(parseInt(data1[i]['C'+h])>20){contador++;}
          if(isNaN(data1[i]['C'+h])){contador++;}
       h++;
            }
      }

      if(contador===0){
                                $.ajax({
                                    type: 'POST',
                                    url : 'registrarNotas',
                                    data: {'tblExcel':data1,'busqueda':busqueda},
                                    beforeSend: function(){
                                        $('#DIVcargando').dialog('open');
                                    },
                                    success: function(){
                                            $('#DIVcargando').dialog('close');
                                            $('#exito').show();
                                            $('#error').hide();
                                    },
                                    failure:function(respuesta){
                                        $('#error').show();
                                        console.log("Error intentando registrar"+respuesta );}

                                   });
                    }else{

                                   $('#error').show();
                    }
});
</script>

<?php
} else {
        echo "No cuenta con la información necesaria para mostrar esta interfaz.";
    }
?>