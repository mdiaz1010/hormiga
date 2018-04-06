<?php
    header('Content-type:text/plain');
    header('Content-Disposition:attachment;filename="Registro-'.date('Y.m.d').'.txt"');

    function listarEventos ($marcas){
        foreach ($marcas as $bodyDataIndividual) {
            $datetime;
            try{
                $datetime = new DateTime($bodyDataIndividual->eventdatetime);
            }catch(Exception $e){
                continue;
            }

            $accessId = substr("0000000000000000".((strlen($bodyDataIndividual->accessid)>=5)?substr($bodyDataIndividual->accessid, -6):"0")  , -16,16);

            $functionKey = (!empty($bodyDataIndividual->functionkey ))? (string)$bodyDataIndividual->functionkey : "255";
            $readerAddr = ((int)$bodyDataIndividual->readeraddr != 0 )? (int)$bodyDataIndividual->readeraddr : 0 ;


            $entradaSalida = (  $functionKey == "10"   or    $readerAddr==1 )? "010" : "011" ;
            echo "$entradaSalida ".$datetime->format('d/m/y H:i')." $accessId $bodyDataIndividual->controllerid\r\n";
           // echo "1";
        }
    }

    if(isset($bodyData->eventosOrganizados)){           //     echo '<tr><td>Organizado</td></tr>';
        foreach ($bodyData->eventosOrganizados as $eventosOrganizadosDias) {
            foreach ($eventosOrganizadosDias as $eventosOrganizadosUsuario) {
                listarEventos($eventosOrganizadosUsuario);
            }
        } 
    }else{
       // echo 'Normal ';
        listarEventos($bodyData->eventos);
    }
    
   // echo '1';
 
 