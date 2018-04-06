<?php ?>
<div class="table-responsive">                                          
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>PROYECTO</th>
                                            <th>TAREA</th>
                                            <th>DESCRIPCION</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                            
                                               
                                            <?php  
                                            foreach ($bodyData->valor as $value) { 
                                              
                                                ?>
                                                <tr>
                                                    
                                                    <td>
                                                    <?= $value->proyecto_id?>                             
                                                    </td>
                                                    <td>
                                                    <?= $value->nombreTarea?>                 
                                                    </td>                                                
                                                    <td>
                                                    <?= $value->descripcion?>                
                                                    </td>


 
                                           
                                                </tr> 
                                            <?php 
                                          
                                            }
                                            ?>
                                           
                                    </tbody>
                                </table>
                               </div>                            