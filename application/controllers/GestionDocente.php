<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GestionDocente extends CI_Controller {

    public $htmlData = array(); 
    public function __construct() {
        parent::__construct(); 
        $this->load->library('export_excel');        
        
        $this->htmlData = array(
            "body"=> get_class($this) 
            ,"bodyData"=> (object) array()
            ,"headData"=> (object) array("titulo"=>"Crear Cliente")
            ,"footerData"=> (object) array()
        );               
    }    

    public function index() { 
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//     
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        
        if(count($valores)>0){            
        $this->htmlData['bodyData']->respuesta     = 1 ;   
        $arrayGrado=array_column($valores, 'id_grado');
        $bimestre=$this->Usuarios_model->busquedaBimestre();
        $busqueda= implode(',',$arrayGrado); 

        $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
        $this->htmlData['bodyData']->bimestre     = $bimestre ; 
        $this->htmlData['bodyData']->valores     = $busquedaProf ;      
        }else{
        $this->htmlData['bodyData']->respuesta     = 0 ;     
        }
        $this->htmlData['body']                           .= "/gestionDocente/notas";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET"; 
        $this->load->view('plantillas_base/standar/body',$this->htmlData);
    }
    public function dexcel(){
        $this->load->model("Usuarios_model",'',TRUE);
        $resultado= $this->Usuarios_model->getListPer();
        $this->export_excel->to_excel($resultado, 'ARTE','CTA','COMPORT','COMU','EFIS','ETRA','EREL','FCC','HGE','INGL','MATE','PFRRHH');                
    }
    public function material() { 
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        if(count($valores)>0){        
        $arrayGrado=array_column($valores, 'id_grado');
        
        $bimestre=$this->Usuarios_model->busquedaBimestre();
        $busqueda= implode(',',$arrayGrado); 

        $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
        $this->htmlData['bodyData']->respuesta     = 1 ; 
        $this->htmlData['bodyData']->bimestre     = $bimestre ; 
        $this->htmlData['bodyData']->valores     = $busquedaProf ;      
        }else{
        $this->htmlData['bodyData']->respuesta     = 0 ;     
        }
        $this->htmlData['body']                          .= "/gestionDocente/material";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET"; 
        $this->load->view('plantillas_base/standar/body',$this->htmlData);
    }  
    public function asistencia() { 
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//     
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        $arrayGrado=array_column($valores, 'id_grado');
        if(count($valores)>0){
        $this->htmlData['bodyData']->respuesta     = 1 ;     
        $bimestre=$this->Usuarios_model->busquedaBimestre();
        $busqueda= implode(',',$arrayGrado); 
        
        $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
        $this->htmlData['bodyData']->bimestre     = $bimestre ; 
        $this->htmlData['bodyData']->valores     = $busquedaProf ;         
        }else{
        $this->htmlData['bodyData']->respuesta     = 0 ;       
        }
        $this->htmlData['body']                           .= "/gestionDocente/asistencia";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET"; 
        $this->load->view('plantillas_base/standar/body',$this->htmlData);
    }       
    public function registrarNotas() { 
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//     
        $where= $this->input->post("busqueda");        
        $objetoNotas= $this->input->post("tblExcel");
        
        
       
        switch ($where['id_bimestre']){
        case "1": $array= array('1'=>3,'2'=>6,'3'=>9,'4'=>12,'5'=>15); break;
        case "2": $array= array('1'=>2,'2'=>5,'3'=>8,'4'=>11,'5'=>14); break;
        case "3": $array= array('1'=>1,'2'=>4,'3'=>7,'4'=>10,'5'=>13); break;
        }
        
        
        $j=0;    
        foreach($objetoNotas as $contando){            
            $i=1;
            
            foreach($array as $id_nota){            
              if($contando['C'.$i]!='' ){
                if(is_numeric($contando['C'.$i])==true ){
                if((int)$contando['C'.$i]>=0 && (int)$contando['C'.$i]<=20 ){
                $cambio[$j]=array('nota'=>$contando['C'.$i],'usu_modificacion'=>$this->session->webCasSession->usuario->USUARIO,'fec_modificacion'=>date('Y-m-d'));
                $data[$j]  =array('id'=>$contando['C_'.$i]);                       
                $clausula=$this->Usuarios_model->buscarcodigonotas($data[$j]);
                $this->Usuarios_model->cambioNotas($cambio[$j],$clausula);
                $j++;
                }
                  }
                }
                $i++    ;
            }   
    //    switch ($where['id_bimestre']){
    //    case "1": $array= array('1'=>3,'2'=>6,'3'=>9,'4'=>12,'5'=>15);$id_prom=array('id'=>$contando['P_P']);$this->Usuarios_model->promediar(implode($array,','),$id_prom);  break;
    //    case "2": $array= array('1'=>2,'2'=>5,'3'=>8,'4'=>11,'5'=>14);$id_prom=array('id'=>$contando['P_P']);$this->Usuarios_model->promediar(implode($array,','),$id_prom); break;
    //    case "3": $array= array('1'=>1,'2'=>4,'3'=>7,'4'=>10,'5'=>13);$id_prom=array('id'=>$contando['P_P']);$this->Usuarios_model->promediar(implode($array,','),$id_prom); break;
    //    }                 
        }
   
       // 

        
    } 
    public function reportPrincipal() { 
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);                                                                             
        $profesor= $this->session->webCasSession->usuario->CODIGO;
        $ano     =date('Y');
        $resultado=  $this->Usuarios_model->getBusquedaAulaProf($profesor,$ano);
        
        $i=0;

        
        foreach($resultado as $res){            
            $arrayResultado[$res->horario][$res->dia]=array('materia'=>trim($res->GRADO).'°'.$res->SECCION.' '.$res->descripcion);
            $color[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]='#'.substr(md5(rand(20, 100)), 0, 6);
            $title[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]=$res->CURSOS;
            
            $i++;
        }
    
        $horarioDia= $this->Usuarios_model->getDiass();
        $horarioHor= $this->Usuarios_model->getHorarioss();
        if(count($resultado)!=0){
        $this->htmlData['bodyData']->respuesta       = 0 ;
        $this->htmlData['bodyData']->dias            = $horarioDia ;    
        $this->htmlData['bodyData']->horas           = $horarioHor ;    
        $this->htmlData['bodyData']->results         = $arrayResultado ;    
        $this->htmlData['bodyData']->color           = $color ;    
        $this->htmlData['bodyData']->curso           = $title ;  
        }else{
        $this->htmlData['bodyData']->respuesta       = 1 ;    
        }
        $this->htmlData['body']                  .= "/reportes/reportPrincipal" ;
        $this->htmlData['headData']->titulo       = "GESTION :: INTRANET"       ; 
        $this->load->view('plantillas_base/standar/body',$this->htmlData)       ;
    }    
    public function reportAsistencia() { 
        $this->load->model("Usuarios_model",'',TRUE)                            ;
        $this->load->model("Rol_model",'',TRUE);//     
        $this->htmlData['body']                  .= "/reportes/reportAsistencia";
        $this->htmlData['headData']->titulo       = "GESTION :: INTRANET"; 
        $this->load->view('plantillas_base/standar/body',$this->htmlData);
    }    
    public function reportNotas() { 
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//     
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        if(count($valores)>0){                 
        $this->htmlData['bodyData']->respuesta     = 1 ;     
        $arrayGrado=array_column($valores, 'id_grado');
        $bimestre=$this->Usuarios_model->busquedaBimestre();
        $busqueda= implode(',',$arrayGrado); 

        $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
        $this->htmlData['bodyData']->bimestre     = $bimestre ; 
        $this->htmlData['bodyData']->valores     = $busquedaProf ;       
        }else{
        $this->htmlData['bodyData']->respuesta     = 0 ;         
        }
        $this->htmlData['body']                           .= "/reportes/reportNotas";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET"; 
        $this->load->view('plantillas_base/standar/body',$this->htmlData);
    }        
    public function comboSeccionProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);      
        $id_grado=$this->input->post("grado");
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$id_grado);   
        $busquedaSeccion=$this->Usuarios_model->busquedaSeccionProf($busqueda);
        foreach($busquedaSeccion as $valor){
            $arraySeccion[]=$valor->id_seccion;
        }
        $busquedaGrado= implode(',',$arraySeccion);   
        $busquedaSecc= $this->Usuarios_model->buscarSecciones($busquedaGrado);
		$html="<option value='' selected>Seleccione</option>";
                foreach($busquedaSecc as $bus){
			$html.="<option value='$bus->id'>$bus->nom_seccion</option>";
		}
		
		echo $html;

    }
    public function comboCursoProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);      
        $id_seccion=$this->input->post("seccion");
        $id_grado=$this->input->post("grado");
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$id_grado,'seccion'=>$id_seccion);   
        $busquedaCurso=$this->Usuarios_model->busquedaCursoProf($busqueda);
        foreach($busquedaCurso as $valor){
            $arraySeccion[]=$valor->id_curso;
        }
        $busquedaCursos= implode(',',$arraySeccion);   
        $busquedaSecc= $this->Usuarios_model->buscarCursos($busquedaCursos);
		$html="<option value='' selected>Seleccione</option>";
                foreach($busquedaSecc as $bus){
			$html.="<option value='$bus->id'>$bus->nom_cursos</option>";
		}
		
		echo $html;

    }   
    function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }
    
    public function comboBimeProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);      
        $busquedaBimestre=$this->Usuarios_model->busquedaBimestre();     
		$html="<option value='' selected>Seleccione</option>";
                foreach($busquedaBimestre as $bus){
                    if ($this->check_in_range($bus['fecini_bimestre'], $bus['fecfin_bimestre'], date('Y-m-d'))) {
                         $hidden='';
                    }else {
                        $hidden='disabled="true"';
                        
                    }                      
			$html.="<option ".$hidden." value='".$bus['id']."'>".$bus['nom_bimestre']."</option>";
		}
		echo $html;
    }
    public function comboConfiguracion(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);      
        $grado=$this->input->post('grado');
        $curso=$this->input->post('seccion');
        $cantidad_bimestre=$this->Usuarios_model->getbi();        
        $busquedaBimestre=$this->Usuarios_model->busqueda_notas_config($grado,$curso);     
        $list_notas=array_unique(array_column($busquedaBimestre,'nom_notas'));
        #echo count($list_notas); die();
        $list_keys =array_chunk(array_column($busquedaBimestre,'id'),(int)$cantidad_bimestre);
        $i=0;
		$html="<option value='' selected>Seleccione</option>";
                foreach(array_unique($list_notas) as $bus){  
                $id_notas= implode(',',$list_keys[$i]);                       
            $html.="<option  value='".$id_notas."'>".$bus."</option>";
            $i++;
		}
		echo $html;
    }    
    public function comboBimeProf2(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);      
        $busquedaBimestre=$this->Usuarios_model->busquedaBimestre();  
       
		$html="<option value='' selected>Seleccione</option>";
                foreach($busquedaBimestre as $bus){
			$html.="<option ".$hidden." value='".$bus['id']."'>".$bus['nom_bimestre']."</option>";
		}
                $html.="<option  value='codigo' >TOTAL</option>";
		echo $html;
    }        
    public function comboBandeNotReport(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);    
        $id_grado=$this->input->post('grado');     
        $bimestre=$this->input->post('bimestre');     
        $id_curso=$this->input->post('curso');    
        $id_seccion=$this->input->post('seccion');             
        $busqueda= array('id_bimestre'=>$bimestre,'id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion,'id_bimestre'=>$bimestre);                                             
        if($bimestre=='codigo'){            
        $dotacionPresente =  $this->Usuarios_model->reporteNotasFinal($busqueda);    
        }else{          
        $dotacionPresente =  $this->Usuarios_model->reporteNotas2($busqueda);
        
        }
        
        $a=0;$b=0;$c=0;$d=0;
        foreach ($dotacionPresente as $notas){
        if((int)$notas['notas']>=17.5){
            $a++;
        }else if($notas['notas']>=13.5 && $notas['notas']<17.4){
            $b++;
        }else if($notas['notas']>=10.5 && $notas['notas']<=13.4){
            $c++;
        }else{
            $d++;
        }
        }
        
        $notas = array(
          0=>array('nombre'=>'Satisfactorio'        ,'nota'=>$a,'rango'=>'18,19,20'),
          1=>array('nombre'=>'Proceso'              ,'nota'=>$b,'rango'=>'14,15,16,17'),
          2=>array('nombre'=>'Inicio'               ,'nota'=>$c,'rango'=>'11,12,13'),
          3=>array('nombre'=>'Previo Inicio'        ,'nota'=>$d,'rango'=>'0 a 10'),
        );
        
        $dotacionPresenteUltimaMarca = array(); // solo para identificar si la ultima marca fue entrada o salida
        $dotacionPresenteContador = 0; // cuenta solo las ultimas marcas q fueron entradas
        foreach ($dotacionPresente  as $dotacionPresenteTemp) {
            
            if(!isset($dotacionPresenteUltimaMarca[$dotacionPresenteTemp['id_alumno'] ]) ){ 
                $bool = ($dotacionPresenteTemp['id_alumno'] = 10  )? TRUE :FALSE;
                $dotacionPresenteUltimaMarca[$dotacionPresenteTemp['id_alumno'] ] = $bool;
                
                $dotacionPresenteContador = ($bool)? $dotacionPresenteContador +1: $dotacionPresenteContador ;
            } 
        }
        $this->htmlData['bodyData']->SECCION         = $id_seccion ;    
        $this->htmlData['bodyData']->GRADO           = $id_grado ;    
        $this->htmlData['bodyData']->CURSOS          = $id_curso ;    
        $this->htmlData['bodyData']->BIMESTRE        = $bimestre ;    
        $this->htmlData['bodyData']->notas           = $notas ;    
        $this->htmlData['bodyData']->usuariosTotales = $this->Usuarios_model->reporteCantidad($busqueda);
        if($bimestre=='codigo'){
        $this->htmlData['bodyData']->merito          = $this->Usuarios_model->reporteNotasMerito2($busqueda);
        }else{
        $this->htmlData['bodyData']->merito          = $this->Usuarios_model->reporteNotasMerito($busqueda);
        }
        
        $i=0;
        
        foreach ($this->htmlData['bodyData']->merito as $meri){
            
            $nombre=$this->Usuarios_model->busquedaProfesorN($meri->id_alumno);
            $codiAlumno[$meri->id_alumno]=$nombre[$i]->profesor;
        
        }

        if($codiAlumno!=''){
        $this->htmlData['bodyData']->alumno          = $codiAlumno;
        }
        $this->htmlData['bodyData']->datos =  $busqueda; 
        $this->htmlData['bodyData']->lastEvents =  $this->Usuarios_model->reporteCantidad($busqueda);
        $cantidad= $this->Usuarios_model->cantidadXbimestre($id_curso);        
        $peso=($cantidad[0]->cantidad);              
        $this->htmlData['bodyData']->estadisticasPaeArray =  $this->Usuarios_model->reporteNotas($busqueda,$peso);        
        $this->htmlData['bodyData']->dotacionPresente = $dotacionPresenteContador;        
        $this->load->view('vistasDialog/gestionDocente/bandejaReporteN/bandejaReporteN',$this->htmlData);                     
    }     
    public function comboBandeNotReportG1($grado,$seccion,$curso,$bimestre){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);                 
        $busqueda= array('id_grado'=>$grado,'id_bimestre'=>$bimestre,'id_curso'=>$curso,'id_seccion'=>$seccion);        
        if($bimestre=='codigo'){            
        $meri =  $this->Usuarios_model->reporteNotasFinal10($busqueda);  
      
        $bime="final del semestre escolar";
        }else{
        $cantidad= $this->Usuarios_model->cantidadXbimestre($busqueda['id_curso']);
        $peso=($cantidad[0]->cantidad);              
        $meri =  $this->Usuarios_model->reporteNotasMerito10($busqueda,$peso);
        $nom_bimes=$this->Usuarios_model->buscarBimestre($bimestre);
        $bime=$nom_bimes[0]->nom_bimestre;
        }
        
        
      
        
        $nom_grado=$this->Usuarios_model->buscarGrados($grado);
        $nom_secci=$this->Usuarios_model->buscarSecciones($seccion);
        $nom_curso=$this->Usuarios_model->buscarCursos($curso);
        
                    
        $this->load->library('Pdf');
        $pdf = new Pdf(); 
        $datosHeader="COLEGIO POLITECNICO VILLA LOS REYES";
        $datosBody="Orden de merito del ".$nom_grado[0]->nom_grado.'ro '.$nom_secci[0]->nom_seccion.' de '.strtolower($nom_grado[0]->des_grado).
                " del curso de ".strtoupper($nom_curso[0]->nom_cursos).' en el '.$bime;
        $pdf->SetDatosHeader($datosHeader);
        $pdf->SetDatosBody($datosBody);
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetTitle("Reporte de Notas");
        $pdf->SetLeftMargin(26);
        $pdf->SetRightMargin(40);
        $pdf->SetFillColor(200,200,200);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(15,7,'NRO','TBL',0,'C','1');
        $pdf->Cell(80,7,'APELLIDOS Y NOMBRES','TB',0,'L','1');
        $pdf->Cell(40,7,'ESTADO','TB',0,'L','1');
        $pdf->Cell(22,7,'NOTA FINAL','TBR',0,'C','1');

        $pdf->Ln(7);
        $x = 1;
        
           
        
        foreach ($meri as $alumno){
          $pdf->Cell(15,5,$x++,'BL',0,'C',0);
          $pdf->Cell(80,5,utf8_decode($alumno->ape_pat_per),'B',0,'L',0);
        if($alumno->nota>=17.5){
            $pdf->Cell(40,5,'SATISFACTORIO','B',0,'L',0);
        }else if($alumno->nota>=13.5 && $alumno->nota<17.4){
            $pdf->Cell(40,5,'PROCESO','B',0,'L',0);
        }else if($alumno->nota>=10.5 && $alumno->nota<=13.4){
            $pdf->Cell(40,5,'INICIO','B',0,'L',0);
        }else{
            $pdf->Cell(40,5,'PREVIO INICIO','B',0,'L',0);
        }          
          $pdf->Cell(22,5,utf8_decode($alumno->nota),'BR',0,'C',0);

          $pdf->Ln(5);
        }
        $pdf->Output("doc.pdf",'I');
                
      }
        
        
    
    public function comboBandeNotReportG2(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);                                                                             
        $profesor= $this->session->webCasSession->usuario->CODIGO;
        $ano     =date('Y');
        $resultado=  $this->Usuarios_model->getBusquedaAulaProf($profesor,$ano);
        
        $i=0;

        
        foreach($resultado as $res){            
            $arrayResultado[$res->horario][$res->dia]=array('materia'=>trim(substr($res->GRADO,0,5)).'°'.$res->SECCION.' '.$res->descripcion);
            $color[substr($res->GRADO,0,5).'°'.$res->SECCION.' '.$res->descripcion]='#'.substr(md5(rand(20, 100)), 0, 6);
            $title[substr($res->GRADO,0,5).'°'.$res->SECCION.' '.$res->descripcion]=$res->CURSOS;
            
            $i++;
        }
    
        $horarioDia= $this->Usuarios_model->getDiass();
        $horarioHor= $this->Usuarios_model->getHorarioss();
        $this->htmlData['bodyData']->dias            = $horarioDia ;    
        $this->htmlData['bodyData']->horas           = $horarioHor ;    
        $this->htmlData['bodyData']->results         = $arrayResultado ;    
        $this->htmlData['bodyData']->color           = $color ;    
        $this->htmlData['bodyData']->curso           = $title ;    
        $this->htmlData['body']                  .= "/reportes/reportPrincipal" ;
        $this->htmlData['headData']->titulo       = "GESTION :: INTRANET"       ; 
        $this->load->view('plantillas_base/standar/body',$this->htmlData)       ;
        
    }
    public function comboBandeNotReportG3(){}
    public function comboBandeNotReportG(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);               
        $this->load->view('vistasDialog/gestionDocente/bandejaReporteG/bandejaReporteG',$this->htmlData);                     
    }     
    public function comboBandeProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);  
        $bimestre=$this->input->post("bimestre");
        $curso=$this->input->post("curso");
        $seccion=$this->input->post("seccion");
        $grado=$this->input->post("grado");
        $this->htmlData['bodyData']->GRADO           = $grado ;
        $this->htmlData['bodyData']->SECCION         = $seccion ;
        $this->htmlData['bodyData']->CURSOS          = $curso ;
        $this->htmlData['bodyData']->BIMESTRE        = $bimestre ;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/bandejaMaterial',$this->htmlData);                     
    }       
    public function configuracionNotas(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//     
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        $arrayGrado=array_column($valores, 'id_grado');
        if(count($valores)>0){
        $this->htmlData['bodyData']->respuesta     = 1 ;     
        $bimestre=$this->Usuarios_model->busquedaBimestre();
        $busqueda= implode(',',$arrayGrado); 
        
        $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
        $this->htmlData['bodyData']->bimestre     = $bimestre ; 
        $this->htmlData['bodyData']->valores     = $busquedaProf ;         
        }else{
        $this->htmlData['bodyData']->respuesta     = 0 ;       
        }
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";        
        $this->htmlData['body']                  .= "/configuracion/notas" ;         
        $this->load->view('plantillas_base/standar/body',$this->htmlData);                  
    }
    public function verdetalleAlumno(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);    
        $codigo=$this->input->post("codigo");
        $alumno=$this->input->post("alu2");
        $curso=$this->input->post("curso");
        $resultado= $this->Usuarios_model->buscarAlumnoasi($codigo,$curso);
        $this->htmlData['bodyData']->results         = $resultado ;
        $this->htmlData['bodyData']->alumno         = str_replace("-", " ",$alumno); 
        $this->load->view('vistasDialog/gestionDocente/bandejaAsistencia/verDetalleAlumno',$this->htmlData);              
    }
    public function comboBandeNota(){
        $this->load->model("Docente_model",'',TRUE);
        $id_curso=$this->input->post("curso");
        $id_grado=$this->input->post("grado");
        $id_seccion=$this->input->post("seccion");
        $id_bimestre=$this->input->post("bimestre");        
        if(isset($id_curso)==true && isset($id_grado)==true && isset($id_seccion)==true && isset($id_bimestre)==true){
        $busqueda= array('id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion,'id_bimestre'=>$id_bimestre,'ano'=>date('Y'));
        $respuesta=1;$results=1;        
        }else{
         $respuesta=0;$results=0;   
        }
        $datosTabla = $this->Docente_model->crosstabcantidad($busqueda);
        $cantidad=count($datosTabla);
        $this->htmlData['bodyData']->cantidad                   =$cantidad;        
        $this->htmlData['bodyData']->datos                      =$busqueda;        
        $this->htmlData['bodyData']->tabla                      =$datosTabla;        
        $this->htmlData['bodyData']->respuesta                  =$respuesta;
        $this->htmlData['bodyData']->results                    =$results;            
        $this->load->view('vistasDialog/gestionDocente/bandejaNotas/bandejaNotas',$this->htmlData);                     
    }            
    public function comboConfiguracionNota(){
        $this->load->model("Docente_model",'',TRUE);
        $this->load->model("Usuarios_model",'',TRUE);
        $id_curso=$this->input->post("curso");
        $id_grado=$this->input->post("grado");
        $id_nota=$this->input->post("nota");  
        $id_profesor=$this->session->webCasSession->usuario->CODIGO;      
        
        $suma_nota= $this->Usuarios_model->suma_notas($id_grado,$id_curso,$id_profesor);
        $cantidad_bi= (int)$this->Usuarios_model->getbi(); 
        $cantidad_sec=(int)$this->Usuarios_model->getsec($id_grado,$id_profesor,$id_curso); 
        if(isset($id_curso)==true && isset($id_grado)==true &&  isset($id_nota)==true){
        $busqueda= array('curso'=>$id_curso,'grado'=>$id_grado,'ano'=>date('Y'),'profesor'=>$id_profesor,'nota'=>$id_nota);
        
        $respuesta=1;$results=1;        
        }else{
         $respuesta=0;$results=0;   
        }
        $this->htmlData['bodyData']->datos                    =$busqueda;  
        $this->htmlData['bodyData']->acumulado                =((int)$suma_nota['acumulado']/$cantidad_bi)/$cantidad_sec;
        $this->load->view('vistasDialog/gestionDocente/bandejaNotas/bandejaConfiguracion',$this->htmlData);
    }       
    public function registrar_configuracion_nota(){
        $this->load->model("Docente_model",'',TRUE);
        $this->load->model("Usuarios_model",'',TRUE);
        $grado      =$this->input->post('grado');    
        $curso      =$this->input->post('curso');
        $nota       =$this->input->post('nota');
        $profesor   =$this->input->post('profesor');
        $ano        =$this->input->post('ano');
        $abreviacion=$this->input->post('abreviacion');
        $list_nota= explode(',',$nota);        
        $descripcion=$this->input->post('descripcion');
        $peso       =$this->input->post('peso');        
        $i=0;
        $data= array('profesor'=>$profesor,'curso'=>$curso,'grado'=>$grado);
        $list_seccion = $this->Usuarios_model->busquedaCursoSeccionProf($data);
        #print_r($list_seccion); die();
        foreach($abreviacion as $abreviado){
            foreach($list_nota as $not){
                foreach($list_seccion as $sec){
                    $save_informacion= array(
                        'id_grado'      =>$grado,
                        'id_seccion'    =>$sec['id_seccion'],
                        'id_curso'      =>$curso,
                        'id_nota'       =>$not,
                        'id_profesor'   =>$profesor,
                        'ano'           =>$ano,
                        'abreviacion'   =>strtoupper($abreviado),
                        'descripcion'   =>strtoupper($descripcion[$i]),
                        'peso'          =>$peso[$i],
                        'fec_creacion'  =>date('Y-m-d'),
                        'usu_creacion'  =>$this->session->webCasSession->usuario->USUARIO
                        
                    );
                    if(!$this->Docente_model->registrar_nueva_configuracion($save_informacion)){
                        echo "Sucedió un incoveniente , verifique que cumplió con todo lo solicitado"; die();
                    }                     
                }                         
            }
        $i++;
  
    }

    }
    public function comboCursoGradoProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);      
        $id_grado=$this->input->post("grado");
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$id_grado);
        $busquedaSeccion=$this->Usuarios_model->busquedaCursoGradoProf($busqueda);
        $arraySeccion=array_column($busquedaSeccion,'id_curso');
        $busquedaGrado= implode(',',$arraySeccion);   
        $busquedaSecc= $this->Usuarios_model->buscarCursos($busquedaGrado);
		$html="<option value='' selected>Seleccione</option>";
                foreach($busquedaSecc as $bus){
			$html.="<option value='$bus->id'>$bus->nom_cursos</option>";
		}
		
		echo $html;

    }
    public function cargarConfiguracionNotas(){
        $this->load->model("Docente_model",'',TRUE);
        $grado   =$this->input->post('grado');
        $curso   =$this->input->post('curso');
        $nota    =$this->input->post('nota');
        $profesor=$this->input->post('profesor');
        $ano=$this->input->post('ano');

        $informacion= $this->Docente_model->busqueda_notas_configuradas($grado,$curso,$nota,$profesor,$ano);

        if(isset($informacion)==true){
            $busqueda= array('curso'=>$curso,'grado'=>$grado,'ano'=>$ano,'profesor'=>$profesor,'nota'=>$nota);
            $respuesta=1;$results=1;        
            }else{
             echo "No existe información";die();
        }
              

        $this->htmlData['bodyData']->datos_usuario                    =$busqueda;  
        $this->htmlData['bodyData']->datos                            =$informacion;  
        $this->load->view('vistasDialog/gestionDocente/bandejaNotas/cargarBandejaConfiguracion',$this->htmlData);
    }
    public function comboBandeAsis(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);        
        $id_curso=$this->input->post("curso");
        $id_grado=$this->input->post("grado");
        $id_seccion=$this->input->post("seccion");
        $busqueda= array('id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion);   
        $resultado= $this->Usuarios_model->buscaralumno($busqueda); 
        $validacionA= $this->Usuarios_model->validacionFechaAlumno($busqueda); 

        $contador=0;
        foreach ($validacionA as $vali){
           if(substr($vali->asistencia,0,10)==date('Y-m-d')){
               $contador++;
           }
           
        }
        
        
        $i=0;
        foreach($resultado as $result){
            $alumnos[$i]=$result->id_alumno;
            $i++;
        }
        $resultado2= implode(',',$alumnos);

            $arrayporcentaje = $this->Usuarios_model->busquedaAsistencia($resultado2,$id_curso);
            $arrayporcentajeP= $this->Usuarios_model->busquedaAsistenciaP($resultado2,$id_curso);            


        foreach ($arrayporcentaje as $porcentajet){
             $arrayporcentat[]= array('cantidad'=>$porcentajet->cantidad1,'id'=>$porcentajet->id_alumno);
        }
        foreach ($arrayporcentajeP as $porcentajep){
             $arrayporcentap[]= (int)$porcentajep->asistencia;
        }     

        for($i=0;$i<count($alumnos);$i++){
            if(isset($arrayporcentat[$i]['cantidad'])){  
            if(isset($arrayporcentap[$i])){    
        
            $porcentaje[$arrayporcentat[$i]['id']]=((int)($arrayporcentap[$i])*100)/(int)($arrayporcentat[$i]['cantidad']);                                    
            }else{                
            $porcentaje[$i]=0;    
            }
            }else{
            $porcentaje[$i]=100;        
            }
        }
       
        $arrayalumno= $this->Usuarios_model->busquedaAlumnoN($resultado2);  
        $this->htmlData['bodyData']->results         = $arrayalumno ;   
        $this->htmlData['bodyData']->filtroc          = $busqueda['id_curso'] ;   
        $this->htmlData['bodyData']->filtrog          = $busqueda['id_grado'] ;   
        $this->htmlData['bodyData']->filtros          = $busqueda['id_seccion'] ;   
        $this->htmlData['bodyData']->porcentaje       = $porcentaje ; 
        $this->htmlData['bodyData']->contador       = $contador ; 
        $this->load->view('vistasDialog/gestionDocente/bandejaAsistencia/bandejaAsistencia',$this->htmlData);                     
    }            
    public function consultarDatosProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//
        $alumno=$this->session->webCasSession->usuario->CODIGO;
        $datos=$this->Usuarios_model->busquedaDatos($alumno);  
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $alumnos=array('id_alumno'=>$alu);      
        $valores  = $this->Usuarios_model->busquedaGradoSeccion($alumnos) ;     
        
        if(isset($datos[0]->ruta)==false){$valor='publico/media/user.png';}else{$valor=$datos[0]->ruta;}
        $arrayDatos= array('nombre'=>$datos[0]->nombre,'apepat'=>$datos[0]->apepat,'apemat'=>$datos[0]->apemat,
                           'direcc'=>$datos[0]->direcc,'docume'=>$datos[0]->docume,'claves'=>$datos[0]->claves,
                           'usuari'=>$datos[0]->usuari,'correo'=>$datos[0]->correo,'telefo'=>$datos[0]->telefo,
                           'grados'=>"DOCENTE",'fecha'=>$datos[0]->fecha,'ruta'=>$valor);        
        $this->htmlData['body']                          .= "/miUsuario";
        $this->htmlData['bodyData']->results         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $alumno ;        
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";         
        $this->load->view('plantillas_base/standar/body',$this->htmlData);                 
    }        
    public function editarInfo(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);//              
        $alumno=$this->session->webCasSession->usuario->CODIGO;     
        $fecha  =$this->input->post('fecha');  
        $direc  =$this->input->post('direccion');  
        $clave  =$this->input->post('clave');  
        $dni    =$this->input->post('documento');  
        $email  =$this->input->post('email');  
        $telefono  =$this->input->post('telefono');          
        $data=array('clav_usuario'=>$clave);
        $dato=array('direccion'=>$direc,'fecha_nac'=>$fecha,'documento'=>$dni);
        $datoC=array('des_correo'=>$email,'usu_modificacion'=>$alumno,'fec_modificacion'=>date('Y-m-d'));
        $datoT=array('num_tel'=>$telefono,'usu_modificacion'=>$alumno,'fec_modificacion'=>date('Y-m-d'));        

        foreach($_FILES['images']['error'] as $key => $error){
            if($error == UPLOAD_ERR_OK){
                $name = $_FILES['images']['name'][$key];
                $tipo = $_FILES['images']['type'][$key];
                $namegeneric = $alumno."-".$name;
                $searcharray = array(' ');
                $namegeneric = str_replace($searcharray, '', $namegeneric);
                $ruta = "temp/repositorio/fotos/".$namegeneric;
                if(move_uploaded_file($_FILES['images']['tmp_name'][$key], $ruta)){

                $archivo= array(
                    'nombre'      =>$namegeneric, 
                    'ruta'        =>$ruta,
                    'tipo'        =>$tipo,
                    'usu_modificacion'=>$this->session->webCasSession->usuario->USUARIO            
                        );                    
              
                    $this->Usuarios_model->cambiardat($archivo,$alumno) ;                                
                }else{
                    $errors= error_get_last(); 
                    echo "COPY ERROR: ".$errors['type']; 
                    echo "<br />\n".$errors['message']."<br />\n"; 
                }
            }
        }              
        $this->Usuarios_model->cambiarclave($data,$alumno) ;  
        $this->Usuarios_model->cambiardat($dato,$alumno) ;  
        $this->Usuarios_model->editartelefon($datoT,$alumno) ;
        $this->Usuarios_model->editarcorreos($datoC,$alumno) ;        

    }    
    public function editarMaterial(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);                       
        $id=$this->input->post('id');   
        $grado=$this->input->post('grado');     
        $bimestre=$this->input->post('bimestre');     
        $curso=$this->input->post('curso');    
        $seccion=$this->input->post('seccion'); 
        $arrayEliminar= array('grado'=>$grado,'bimestre'=>$bimestre,'curso'=>$curso,'seccion'=>$seccion);        
        $archi=$this->Usuarios_model->editarMateriales1($id);        
        $nomArchivo=$archi[0]->nom_archivo;
        $this->htmlData['bodyData']->id         = $id ;
        $this->htmlData['bodyData']->arrayEliminar         = $arrayEliminar ;        
        $this->htmlData['bodyData']->nomArchivo         = $nomArchivo ;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/editarMaterial',$this->htmlData);             
    }
    public function eliminarMaterial(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);   
        $id=$this->input->post('id');     
        $grado=$this->input->post('grado');     
        $bimestre=$this->input->post('bimestre');     
        $curso=$this->input->post('curso');    
        $ruta=$this->input->post('ruta');    
        $seccion=$this->input->post('seccion'); 
        $arrayEliminar= array('grado'=>$grado,'bimestre'=>$bimestre,'curso'=>$curso,'seccion'=>$seccion,'ruta'=>$ruta);
        $this->htmlData['bodyData']->id         = $id ;
        $this->htmlData['bodyData']->arrayEliminar         = $arrayEliminar ;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/eliminarMateriales',$this->htmlData);          
    }    
    public function editarMateriales(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);                       
        $id=$this->input->post('id'); 
        $archivo=$this->input->post('archivo'); 
        $data= array('nom_archivo'=>$archivo);
        $this->Usuarios_model->editarMateriales2($id,$data);        
    }
    public function eliminarMateriales(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);    
        $id=$this->input->post('codigo');         
        $ruta=$this->input->post('ruta'); 
        if (!unlink($ruta)){
        echo ("Error deleting $file");die();
        }else{
            $this->Usuarios_model->eliminarMateriales($id);
        }        
    
            
    
    }    
    public function verbandejaprof(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);           
        $id_grado=$this->input->post('grado');     
        $bimestre=$this->input->post('bimestre');     
        $id_curso=$this->input->post('curso');    
        $id_seccion=$this->input->post('seccion');         
        $busqueda= array('id_bimestre'=>$bimestre,'id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion);                                     
        $resultado= $this->Usuarios_model->buscardocumentos($busqueda);     
        $this->htmlData['bodyData']->results         = $resultado ;  
        $this->htmlData['bodyData']->arrayBusqueda         = $busqueda ;  
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/bandejaMaterial2',$this->htmlData); 
    }
    public function subirArchivoProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);        
        $seccion      = $this->input->post('seccion');     
        $grado        = $this->input->post('grado');   
        $curso        = $this->input->post('curso');      
        $bimestre     = $this->input->post('bimestre');      
        $archivo= array('seccion'=>$seccion,'grado'=>$grado,'curso'=>$curso,'bimestre'=>$bimestre);
        
        $this->htmlData['bodyData']->archivos          = $archivo;    
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/subirArchivo',$this->htmlData);                     

    }         
    public function registrarAsitencia(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);         
        $seccion      = $this->input->post('id_seccion');     
        $grado        = $this->input->post('id_grado');       
        $curso        = $this->input->post('id_curso');       
        $arrayAlumno  = $this->input->post('txtcodigo');    
        $arrayMarcad  = $this->input->post('txtmarcado');     
       
        foreach ($arrayAlumno as $array){
            $insercion= array(
              "id_grado"=>$grado,
              "id_seccion"=>$seccion,
              "id_curso"=>$curso,
              "id_alumno"=>$array,
              "ano"=>date('Y'),
              "dia"=>date('d'),
              "mes"=>date('m'),
              "asistencia"=>'f',
              'fecha_val'=>date('Y-m-d'),
              'usu_creacion'=>$this->session->webCasSession->usuario->USUARIO
            );
            
            $this->Usuarios_model->insertAsitencia($insercion);             
            
             
        }
        $asistieronAl= implode(',',$arrayMarcad);
              $marcado= array('asistencia'=>'p');
              $asistieron= array(
              "id_grado"=>$grado,
              "id_seccion"=>$seccion,
              "id_curso"=>$curso,
              "id_alumno"=>$array,
              "ano"=>date('Y'),
              "dia"=>date('d'),
              "mes"=>date('m'),
              "marcado"=>$asistieronAl                  
              ); 
             if(count($arrayMarcad)>0){                  
            $this->Usuarios_model->updateAsitencia($marcado,$asistieron);               
            }

    }
    public function registrarArchivoProf(){
        $this->load->model("Usuarios_model",'',TRUE);
        $this->load->model("Rol_model",'',TRUE);        
        $seccion      = $this->input->post('txtseccion');     
        $grado        = $this->input->post('txtgrado');   
        $curso        = $this->input->post('txtcurso');      
        $bimestre     = $this->input->post('txtbimestre');
        $nomarchi     = $this->input->post('txtarchivo');
        $desarchi     = $this->input->post('txtdescripcion');
        


        $id_grado=$this->Usuarios_model->buscarGrados($grado);
        $id_bimes=$this->Usuarios_model->buscarBimestre($bimestre);


        foreach($_FILES['images']['error'] as $key => $error){
            if($error == UPLOAD_ERR_OK){
                $name = $_FILES['images']['name'][$key];
                $tipo = $_FILES['images']['type'][$key];
                $namegeneric = $id_grado[0]->nom_grado."-".$name;
                $searcharray = array(' ');
                $namegeneric = str_replace($searcharray, '', $namegeneric);
                $ruta = "temp/repositorio/".date('Y')."/".$id_grado[0]->id."/".$id_bimes[0]->id."/".$namegeneric;
                if(move_uploaded_file($_FILES['images']['tmp_name'][$key], $ruta)){

                $archivo= array(
                    'nom_archivo' =>$nomarchi,
                    'nombre'      =>$namegeneric, 
                    'ruta'        =>$ruta,
                    'tipo'        =>$tipo,
                    'descripcion' =>$desarchi,
                    'id_grado'    =>$grado,                    
                    'id_seccion'  =>$seccion,
                    'id_curso'    =>$curso,
                    'id_bimestre' =>$bimestre,
                    'ano'         => date('Y'),
                    'usu_creacion'=>$this->session->webCasSession->usuario->USUARIO,
                    'fec_creacion'=>date('Y-m-d')
                        );                    
              
                    $this->Usuarios_model->GuardarArchivoProf($archivo);                                        
                }else{
                    $errors= error_get_last(); 
                    echo "COPY ERROR: ".$errors['type']; 
                    echo "<br />\n".$errors['message']."<br />\n"; 
                }
            }
        }      
                
        

                
    }

}

?>