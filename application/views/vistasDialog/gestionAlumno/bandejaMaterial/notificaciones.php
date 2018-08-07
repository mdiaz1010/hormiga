<a style="<?= $bodyData->disabled?>" class="btn btn-app Detalle_final" data-toggle="modal" data-target=".bs-example_final-modal-lg"
    href="javascript:void(0)">
    <span class="badge bg-red">
        <?=$bodyData->emergente['promedio']?>
    </span>
    <i class="fa fa-edit"></i> Prom. finales
</a>
<!--
        <a class="btn btn-app">
          <span class="badge bg-red">6</span>
          <i class="fa fa-comments"></i> Inbox
        </a>
-->
<a class="btn btn-app Repositorio_bandeja" data-toggle="modal" data-target=".bs-example2_final-modal-lg" href="javascript:void(0)">
    <?php if($bodyData->emergente['repositorio']!=0){ ?>
    <span class="badge bg-red">
        <?=$bodyData->emergente['repositorio']?>
    </span>
    <?php } ?>
    <i class="fa fa-folder-open"></i> Repositorio
</a>
<!--
<a class="btn btn-app">
    <span class="badge bg-orange">12</span>
    <i class="fa fa-calendar"></i> Inasistencias
</a>

        <a class="btn btn-app">
          <span class="badge bg-orange">12</span>
          <i class="fa fa-calendar-o"></i> Eventos
        </a>
        <a class="btn btn-app">
          <span class="badge bg-orange">12</span>
          <i class="fa fa-graduation-cap"></i> Becas
        </a>
-->
<script>
    $(".Repositorio_bandeja").click(function () {
        $.post('repositorio_bandeja', function (data) {
            $("#DIVVERDETALLE_REPOSITORIO").html(data);
        });
        $("#notificacion_general").load("notificacion_general");
    });
    $(".Detalle_final").click(function () {

        $.post('promedio_final', function (data) {
            $("#DIVVERDETALLE_FINAL").html(data);
        });

    });
$(".ver_merito").click(function(){
    $('#puestos').show();
    $('#meri').hide();
    $.post('puestos', function (data) {
        $("#puestos").html(data);
    });

});
$(".ver_rendimiento").click(function(){
    $('#rendimiento').show();
    $('#rendi').hide();
    $.post('rendimiento', function (data) {
        $("#rendimiento").html(data);
    });

});
    $.post('horario', function (data) {
        $("#horarios").html(data);
    });

</script>