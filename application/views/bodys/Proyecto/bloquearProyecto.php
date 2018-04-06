<?php
?>
<!-- Trigger the modal with a button -->


<!-- Modal -->

    <!-- Modal content-->
      <form action="<?= site_url('Proyecto/BloquearProyecto')?>" method="post">
   <input type="hidden" name="id"   value="<?=$bodyData->valoresSueltos["id"]?>"
<center>
      <div class="modal-body" align="center">
        <p><strong><h3>¿DESEA DESACTIVAR ESTE PROYECTO?</h3></strong></p><BR>
<input type="submit" class="btn  btn-danger" style='width: 50px; height:45px'  data-toggle="modal" data-target="#myModal" value="SI">
&nbsp;&nbsp;&nbsp;

<input type="button"  class="btn btn-danger" style='width: 50px; height:45px' data-dismiss="modal" value="NO" />
      </div>
</center>

    
</form>