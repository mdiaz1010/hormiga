<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GestionDocente extends CI_Controller
{
    public $htmlData = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->library('export_excel');
        SessionSeguridad::tiempo_maximo($this->session->webCasSession);
        $this->htmlData = array(
            "body"=> get_class($this)
            ,"bodyData"=> (object) array()
            ,"headData"=> (object) array("titulo"=>"Crear Cliente")
            ,"footerData"=> (object) array()
        );
    }

    public function index()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;

        if (count($valores)>0) {
            $this->htmlData['bodyData']->respuesta     = 1 ;
            $arrayGrado=array_column($valores, 'id_grado');
            $bimestre=$this->Usuarios_model->busquedaBimestre();
            $busqueda= implode(',', $arrayGrado);

            $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
            $this->htmlData['bodyData']->bimestre     = $bimestre ;
            $this->htmlData['bodyData']->valores     = $busquedaProf ;
        } else {
            $this->htmlData['bodyData']->respuesta     = 0 ;
        }

        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionDocente/gestionDocente/notas', $this->htmlData);
    }
    public function dexcel($grado,$seccion,$bimestre,$curso)
    {
        $this->load->model("Usuarios_model", '', true);
        /*$grado= $this->input->post('grado');
        $seccion= $this->input->post('seccion');
        $curso= $this->input->post('curso');
        $bimestre= $this->input->post('bimestre');*/
        $datos = array('id_grado'=>$grado,'id_seccion'=>$seccion,'id_curso'=>$curso,'id_bimestre'=>$bimestre,'ano'=>date('Y'));

        $resultado= $this->Usuarios_model->reporteNotasMerito101($datos,false);
        $list_nombre = array_values(array_unique(array_column($resultado,'nombre')));
        $i=0;
        foreach($list_nombre as $clave => $valor):
            foreach($resultado as $key => $value)
            {
                if($valor==$value['nombre']){
                        $i++;
                        $list_fintal[$clave]['Apellidos y nombres']=$value['nombre'];
                        $list_fintal[$clave]['C'.$i]=$value['nota'];
                }else{
                        $i=0;
                }
            }
        endforeach;

        $this->export_excel->to_excel($list_fintal, 'Reporte de notas');
    }
    public function material()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        if (count($valores)>0) {
            $arrayGrado=array_column($valores, 'id_grado');

            $bimestre=$this->Usuarios_model->busquedaBimestre();
            $busqueda= implode(',', $arrayGrado);

            $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
            $this->htmlData['bodyData']->respuesta     = 1 ;
            $this->htmlData['bodyData']->bimestre     = $bimestre ;
            $this->htmlData['bodyData']->valores     = $busquedaProf ;
        } else {
            $this->htmlData['bodyData']->respuesta     = 0 ;
        }

        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionDocente/gestionDocente/material', $this->htmlData);
    }
    public function asistencia()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        $arrayGrado=array_column($valores, 'id_grado');
        if (count($valores)>0) {
            $this->htmlData['bodyData']->respuesta     = 1 ;
            $bimestre=$this->Usuarios_model->busquedaBimestre();
            $busqueda= implode(',', $arrayGrado);

            $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
            $this->htmlData['bodyData']->bimestre     = $bimestre ;
            $this->htmlData['bodyData']->valores     = $busquedaProf ;
        } else {
            $this->htmlData['bodyData']->respuesta     = 0 ;
        }

        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionDocente/gestionDocente/asistencia', $this->htmlData);
    }
    public function registrarNotas()
    {
        $this->load->model("Docente_model", '', true);
        $this->load->model("Rol_model", '', true);
        $objetoNotas= $this->input->post("tblExcel");

        $grado      = $this->input->post("grado");
        $seccion    = $this->input->post("seccion");
        $curso      = $this->input->post("curso");
        $bimestre   = $this->input->post("bimestre");
        $ano        = date('Y');
        $profesor   = $this->session->webCasSession->usuario->CODIGO;
        $list_notas= array('ano'=>$ano,'id_grado'=>$grado,'id_curso'=>$curso,'id_bimestre'=>$bimestre,'id_profesor'=>$profesor);
        $codigo_nota = $this->Docente_model->busqueda_id_notas($list_notas);
        $abreviacion_notas = array_column($codigo_nota,'abreviacion');
        $codigo_nota=array_column($codigo_nota,'id');




        foreach ( $objetoNotas as $i =>$filas )
        {

            $abreviacion_notas=array_pad($abreviacion_notas, count($filas),'XX');
            $list_keys=array_values(array_keys($filas));

            $i=0;

            foreach ( $filas as $key => $codigo  )
            {

                $keys= array_keys($list_keys,$abreviacion_notas[$i]);
                if(count($keys)>1)
                {
                    $notas =array_values($filas);


                     $id_nota= $this->Docente_model->busqueda_id_nota($filas['codigo'],$codigo_nota[$i],1,date('Y'));
                     if($notas[$keys[1]]=='' || is_numeric($notas[$keys[1]]) && $notas[$keys[1]]>=0 && $notas[$keys[1]]<=20){
                         $this->Docente_model->cambiar_nota($id_nota[0]['id'],array('nota'=>$notas[$keys[1]]));
                         echo "1,";
                     }else{
                         echo "0,";
                     }



                }
                    $i++;

            }


        }


    }
    public function verificar_abreviacion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Docente_model", '', true);
        $grado      = $this->input->post("grado");
        $curso      = $this->input->post("curso");
        $profesor   = $this->input->post("profesor");
        $ano    = $this->input->post("ano");
        $abreviacion   = strtoupper($this->input->post("abreviacion"));
        $list_abreviacion= $this->Docente_model->busqueda_notas_configuradas_abreviacion($grado, $curso, $abreviacion, $profesor, $ano);

        if(count($list_abreviacion)!=0){

            if($abreviacion==$list_abreviacion[0]['abreviacion'])
            {
                echo  json_encode(array('result'=>1,'capacidad'=>$list_abreviacion[0]['nom_notas']));
            }
        }else{
                echo json_encode(array('result'=>0));
        }
    }
    public function reportPrincipal()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $profesor= $this->session->webCasSession->usuario->CODIGO;
        $ano     =date('Y');
        $resultado=  $this->Usuarios_model->getBusquedaAulaProf($profesor, $ano);

        $i=0;


        foreach ($resultado as $res) {
            $arrayResultado[$res->horario][$res->dia]=array('materia'=>trim($res->GRADO).'°'.$res->SECCION.' '.$res->descripcion);
            $color[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]='#'.substr(md5(rand(20, 100)), 0, 6);
            $title[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]=$res->CURSOS;

            $i++;
        }

        $horarioDia= $this->Usuarios_model->getDiass();
        $horarioHor= $this->Usuarios_model->getHorarioss();
        if (count($resultado)!=0) {
            $this->htmlData['bodyData']->respuesta       = 0 ;
            $this->htmlData['bodyData']->dias            = $horarioDia ;
            $this->htmlData['bodyData']->horas           = $horarioHor ;
            $this->htmlData['bodyData']->results         = $arrayResultado ;
            $this->htmlData['bodyData']->color           = $color ;
            $this->htmlData['bodyData']->curso           = $title ;
        } else {
            $this->htmlData['bodyData']->respuesta       = 1 ;
        }
        $this->htmlData['headData']->titulo       = "GESTION :: INTRANET"       ;
        $this->load->view('bodys/GestionDocente/reportes/reportPrincipal', $this->htmlData)       ;
    }
    public function reportAsistencia()
    {
        $this->load->model("Usuarios_model", '', true)                            ;
        $this->load->model("Rol_model", '', true);//
        $this->htmlData['body']                  .= "/reportes/reportAsistencia";
        $this->htmlData['headData']->titulo       = "GESTION :: INTRANET";
        $this->load->view('bodys', $this->htmlData);
    }
    public function reportNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        if (count($valores)>0) {
            $this->htmlData['bodyData']->respuesta     = 1 ;
            $arrayGrado=array_column($valores, 'id_grado');
            $bimestre=$this->Usuarios_model->busquedaBimestre();
            $busqueda= implode(',', $arrayGrado);

            $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
            $this->htmlData['bodyData']->bimestre     = $bimestre ;
            $this->htmlData['bodyData']->valores     = $busquedaProf ;
        } else {
            $this->htmlData['bodyData']->respuesta     = 0 ;
        }

        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionDocente/reportes/reportNotas', $this->htmlData);
    }
    public function bandeja()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionDocente/bandeja/index', $this->htmlData);
    }
    public function comboSeccionProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_grado=$this->input->post("grado");
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$id_grado);
        $busquedaSeccion=$this->Usuarios_model->busquedaSeccionProf($busqueda);
        foreach ($busquedaSeccion as $valor) {
            $arraySeccion[]=$valor->id_seccion;
        }
        $busquedaGrado= implode(',', $arraySeccion);
        $busquedaSecc= $this->Usuarios_model->buscarSecciones($busquedaGrado);
        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaSecc as $bus) {
            $html.="<option value='$bus->id'>$bus->nom_seccion</option>";
        }

        echo $html;
    }
    public function comboCursoProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_seccion=$this->input->post("seccion");
        $id_grado=$this->input->post("grado");
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$id_grado,'seccion'=>$id_seccion);
        $busquedaCurso=$this->Usuarios_model->busquedaCursoProf($busqueda);
        foreach ($busquedaCurso as $valor) {
            $arraySeccion[]=$valor->id_curso;
        }
        $busquedaCursos= implode(',', $arraySeccion);
        $busquedaSecc= $this->Usuarios_model->buscarCursos($busquedaCursos);
        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaSecc as $bus) {
            $html.="<option value='$bus->id'>$bus->nom_cursos</option>";
        }

        echo $html;
    }
    public function check_in_range($start_date, $end_date, $evaluame)
    {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    public function comboBimeProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $busquedaBimestre=$this->Usuarios_model->busquedaBimestre();
        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaBimestre as $bus) {
            if ($this->check_in_range($bus['fecini_bimestre'], $bus['fecfin_bimestre'], date('Y-m-d'))) {
                $hidden='';
            } else {
                $hidden='disabled="true"';
            }
            $html.="<option ".$hidden." value='".$bus['id']."'>".$bus['nom_bimestre']."</option>";
        }
        echo $html;
    }
    public function comboConfiguracion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $grado=$this->input->post('grado');
        $curso=$this->input->post('seccion');
        $cantidad_bimestre=$this->Usuarios_model->getbi();
        $busquedaBimestre=$this->Usuarios_model->busqueda_notas_config($curso);
        $list_notas=array_unique(array_column($busquedaBimestre, 'nom_notas'));
        #echo count($list_notas); die();
        $list_keys =array_chunk(array_column($busquedaBimestre, 'id'), (int)$cantidad_bimestre);
        $i=0;
        $html="<option value='' selected>Seleccione</option>";
        foreach (array_unique($list_notas) as $bus) {
            $id_notas= implode(',', $list_keys[$i]);
            $html.="<option  value='".$id_notas."'>".$bus."</option>";
            $i++;
        }
        echo $html;
    }
    public function comboBimeProf2()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $busquedaBimestre=$this->Usuarios_model->busquedaBimestre();

        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaBimestre as $bus) {
            $html.="<option ".$hidden." value='".$bus['id']."'>".$bus['nom_bimestre']."</option>";
        }
        $html.="<option  value='codigo' >TOTAL</option>";
        echo $html;
    }
    public function comboBandeNotReport()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_grado=$this->input->post('grado');
        $bimestre=$this->input->post('bimestre');
        $id_curso=$this->input->post('curso');
        $id_seccion=$this->input->post('seccion');
        $busqueda= array('id_bimestre'=>$bimestre,'id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion);
        if ($bimestre=='codigo') {
            $dotacionPresente =  $this->Usuarios_model->reporteNotasFinal($busqueda,false);
        } else {
            $dotacionPresente =  $this->Usuarios_model->reporteNotasMerito10($busqueda,false);
        }
        if(count($dotacionPresente)==0){
            echo "No existe información registrada"; die();
        }
        $a=0;
        $b=0;
        $c=0;
        $d=0;
        foreach ($dotacionPresente as $notas) {
            if (trim($notas['nota'])>=17.5) {
                $a++;
            } else if (trim($notas['nota'])>=13.5) {
                $b++;
            } else if (trim($notas['nota'])>=10.5 ) {
                $c++;
            } else if (trim($notas['nota'])<=10){
                $d++;
            }
        }

        $notas = array(
          0=>array('nombre'=>'Satisfactorio (18,19,20)'        ,'nota'=>$a,'rango'=>'18,19,20'),
          1=>array('nombre'=>'Proceso (14,15,16,17)'              ,'nota'=>$b,'rango'=>'14,15,16,17'),
          2=>array('nombre'=>'Inicio (11,12,13)'               ,'nota'=>$c,'rango'=>'11,12,13'),
          3=>array('nombre'=>'Previo Inicio (<=10)'        ,'nota'=>$d,'rango'=>'0 a 10'),
        );
        $list_pastel = array(
          0=>array('name'=>'Satisfactorio (18,19,20)'        ,'y'=>$a),
          1=>array('name'=>'Proceso (14,15,16,17)'              ,'y'=>$b),
          2=>array('name'=>'Inicio (11,12,13)'               ,'y'=>$c),
          3=>array('name'=>'Previo Inicio (<=10)'        ,'y'=>$d),
        );

        $dotacionPresenteUltimaMarca = array(); // solo para identificar si la ultima marca fue entrada o salida
        $dotacionPresenteContador = 0; // cuenta solo las ultimas marcas q fueron entradas
        foreach ($dotacionPresente  as $dotacionPresenteTemp) {
            if (!isset($dotacionPresenteUltimaMarca[$dotacionPresenteTemp['id_alumno'] ])) {
                $bool = ($dotacionPresenteTemp['id_alumno'] = 10)? true :false;
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
        if ($bimestre=='codigo') {
            $this->htmlData['bodyData']->merito          = $this->Usuarios_model->reporteNotasFinal($busqueda,true);
        } else {
            $this->htmlData['bodyData']->merito          = $this->Usuarios_model->reporteNotasMerito10($busqueda,true);
        }

        $i=0;

        foreach ($this->htmlData['bodyData']->merito as $meri) {
            $nombre=$this->Usuarios_model->busquedaProfesorN($meri['id_alumno']);
            $codiAlumno[$meri['id_alumno']]=$nombre[$i]->profesor;
        }

        if ($codiAlumno!='') {
            $this->htmlData['bodyData']->alumno          = $codiAlumno;
        }
#echo json_encode($list_pastel); die();
        $this->htmlData['bodyData']->list_pastel =  json_encode($list_pastel);
        $this->htmlData['bodyData']->datos =  $busqueda;
        $this->htmlData['bodyData']->lastEvents =  $this->Usuarios_model->reporteCantidad($busqueda);
        $this->htmlData['bodyData']->estadisticasPaeArray =  $this->Usuarios_model->reporteNotasMerito10($busqueda, false);
        $this->htmlData['bodyData']->dotacionPresente = $dotacionPresenteContador;
        $this->load->view('vistasDialog/gestionDocente/bandejaReporteN/bandejaReporteN', $this->htmlData);
    }
    public function comboBandeNotReportG1()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_grado=$this->input->post('grado');
        $bimestre=$this->input->post('bimestre');
        $id_curso=$this->input->post('curso');
        $id_seccion=$this->input->post('seccion');
        $busqueda= array('id_grado'=>$id_grado,'id_bimestre'=>$bimestre,'id_curso'=>$id_curso,'id_seccion'=>$id_seccion);

        if ($bimestre=='codigo') {
            $meri =  $this->Usuarios_model->reporteNotasFinal($busqueda,false);

            $bime="final del semestre escolar";
        } else {
            $meri =  $this->Usuarios_model->reporteNotasMerito10($busqueda, false);
            $nom_bimes=$this->Usuarios_model->buscarBimestre($bimestre);
            $bime=$nom_bimes[0]->nom_bimestre;
        }




        $nom_grado=$this->Usuarios_model->buscarGrados($id_grado);
        $nom_secci=$this->Usuarios_model->buscarSecciones($id_seccion);
        $nom_curso=$this->Usuarios_model->buscarCursos($id_curso);


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
        $pdf->SetFillColor(200, 200, 200);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(15, 7, 'NRO', 'TBL', 0, 'C', '1');
        $pdf->Cell(80, 7, 'APELLIDOS Y NOMBRES', 'TB', 0, 'L', '1');
        $pdf->Cell(40, 7, 'ESTADO', 'TB', 0, 'L', '1');
        $pdf->Cell(22, 7, 'NOTA FINAL', 'TBR', 0, 'C', '1');

        $pdf->Ln(7);
        $x = 1;
        $a=0;$b=0;$c=0;$d=0;

        foreach ($meri as $alumno) {
            $pdf->Cell(15, 5, $x++, 'BL', 0, 'C', 0);
            $pdf->Cell(80, 5, utf8_decode($alumno['ape_pat_per']), 'B', 0, 'L', 0);
            if (trim($alumno['nota'])>=17.5) {
                $pdf->Cell(40, 5, 'SATISFACTORIO', 'B', 0, 'L', 0);
                $a++;
            } else if (trim($alumno['nota'])>=13.5) {
                $pdf->Cell(40, 5, 'PROCESO', 'B', 0, 'L', 0);
                $b++;
            } else if (trim($alumno['nota'])>=10.5) {
                $pdf->Cell(40, 5, 'INICIO', 'B', 0, 'L', 0);
                $c++;
            } else if (trim($alumno['nota'])<=10){
                $pdf->Cell(40, 5, 'PREVIO INICIO', 'B', 0, 'L', 0);
                $d++;
            }
            $pdf->Cell(22, 5, utf8_decode($alumno['nota']), 'BR', 0, 'C', 0);

            $pdf->Ln(5);
        }
        $porcentaje=$a+$b+$c+$d;

            $aa=($a==0)?0:round(($a*100)/$porcentaje,2);
            $bb=($b==0)?0:round(($b*100)/$porcentaje,2);
            $cc=($c==0)?0:round(($c*100)/$porcentaje,2);
            $dd=($d==0)?0:round(($d*100)/$porcentaje,2);
            $pdf->Ln(7);
            $pdf->Cell(40, 7, 'Estado', 'TBL', 0, 'L', '1');
            $pdf->Cell(20, 7, 'Cantidad', 'TB', 0, 'L', '1');
            $pdf->Cell(20, 7, 'Porcentaje', 'TBR', 0, 'c', '1');
            $pdf->Ln(7);
            $pdf->Cell(40, 7, 'Satisfatorio', 'TBL', 0, 'L', 0);
            $pdf->Cell(20, 7, $a, 'TB', 0, 'L', 0);
            $pdf->Cell(20, 7, $aa.'%', 'TBR', 0, 'BR', 0);
            $pdf->Ln(7);
            $pdf->Cell(40, 7, 'Proceso', 'TBL', 0, 'L', 0);
            $pdf->Cell(20, 7, $b, 'TB', 0, 'L', 0);
            $pdf->Cell(20, 7, $bb.'%', 'TBR', 0, 'BR', 0);
            $pdf->Ln(7);
            $pdf->Cell(40, 7, 'Inicio', 'TBL', 0, 'L', 0);
            $pdf->Cell(20, 7, $c, 'TB', 0, 'L', 0);
            $pdf->Cell(20, 7, $cc.'%', 'TBR', 0, 'BR', 0);
            $pdf->Ln(7);
            $pdf->Cell(40, 7, 'Previo inicio', 'TBL', 0, 'L', 0);
            $pdf->Cell(20, 7, $d, 'TB', 0, 'L', 0);
            $pdf->Cell(20, 7, $dd.'%', 'TBR', 0, 'BR', 0);
            $pdf->Ln(7);
        $pdf->Output("doc.pdf", 'I');
    }



    public function comboBandeNotReportG2()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $profesor= $this->session->webCasSession->usuario->CODIGO;
        $ano     =date('Y');
        $resultado=  $this->Usuarios_model->getBusquedaAulaProf($profesor, $ano);

        $i=0;


        foreach ($resultado as $res) {
            $arrayResultado[$res->horario][$res->dia]=array('materia'=>trim(substr($res->GRADO, 0, 5)).'°'.$res->SECCION.' '.$res->descripcion);
            $color[substr($res->GRADO, 0, 5).'°'.$res->SECCION.' '.$res->descripcion]='#'.substr(md5(rand(20, 100)), 0, 6);
            $title[substr($res->GRADO, 0, 5).'°'.$res->SECCION.' '.$res->descripcion]=$res->CURSOS;

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
        $this->load->view('bodys', $this->htmlData)       ;
    }
    public function comboBandeNotReportG3()
    {
    }
    public function comboBandeNotReportG()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->load->view('vistasDialog/gestionDocente/bandejaReporteG/bandejaReporteG', $this->htmlData);
    }
    public function comboBandeProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $bimestre=$this->input->post("bimestre");
        $curso=$this->input->post("curso");
        $seccion=$this->input->post("seccion");
        $grado=$this->input->post("grado");
        $this->htmlData['bodyData']->GRADO           = $grado ;
        $this->htmlData['bodyData']->SECCION         = $seccion ;
        $this->htmlData['bodyData']->CURSOS          = $curso ;
        $this->htmlData['bodyData']->BIMESTRE        = $bimestre ;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/bandejaMaterial', $this->htmlData);
    }
    public function configuracionNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $valores                                 = $this->Usuarios_model->busquedaGradoProf($profesor) ;
        $arrayGrado=array_column($valores, 'id_grado');
        if (count($valores)>0) {
            $this->htmlData['bodyData']->respuesta     = 1 ;
            $bimestre=$this->Usuarios_model->busquedaBimestre();
            $busqueda= implode(',', $arrayGrado);

            $busquedaProf= $this->Usuarios_model->buscarGrados($busqueda);
            $this->htmlData['bodyData']->bimestre     = $bimestre ;
            $this->htmlData['bodyData']->valores     = $busquedaProf ;
        } else {
            $this->htmlData['bodyData']->respuesta     = 0 ;
        }
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";

        $this->load->view('bodys/GestionDocente/configuracion/notas', $this->htmlData);
    }
    public function verdetalleAlumno()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $alumno=array('id_alumno'=>$this->input->post('codigo'));
        $nom_alu=$this->input->post("alu2");


        $alumno_evasion = $this->Usuarios_model->evasion_alumno($alumno['id_alumno']);
        $alumno_inasistencia = $this->Usuarios_model->inasistencia_alumno($alumno['id_alumno'],'f');
        $alumno_asistencia=  $this->Usuarios_model->inasistencia_alumno($alumno['id_alumno'],'p');

        $list_historial = array(array('Evasion',count($alumno_evasion),false),
                                array('Inasistencia',(int)$alumno_inasistencia['asistencia'],false),
                                array('Asistencia',(int)$alumno_asistencia['asistencia'],false));

        $nom_historial = array('Asistencia','Inasistencia','Evasiones');

        $resultado= $this->Usuarios_model->busquedaGradoSeccion($alumno);
        $ano=$this->Usuarios_model->busquedaAno($alumno['id_alumno']);
        if ($ano[0]->ano==date('Y')) {
            $gradosec= array('grado'=>$resultado['id_grado'],'seccion'=>$resultado['id_seccion']);
            $resultadoCurs= $this->Usuarios_model->busquedaCursoAlu($gradosec);
            if(isset($resultadoCurs)==false){
                echo "No existe cursos registrados";die();
            }
        }



        if (isset($resultadoCurs)==true) {
            $this->htmlData['bodyData']->respuesta         = 1 ;
            $this->htmlData['bodyData']->nom_historial         = json_encode($nom_historial) ;
            $this->htmlData['bodyData']->list_historial         = json_encode($list_historial) ;
            $this->htmlData['bodyData']->results         = $resultado ;
        } else {
            $this->htmlData['bodyData']->respuesta         = 0 ;
        }

        $this->htmlData['bodyData']->alumno         = str_replace("-", " ", $nom_alu);
        $this->htmlData['bodyData']->codigo         =$alumno['id_alumno'];
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('vistasDialog/gestionDocente/bandejaAsistencia/verDetalleAlumno', $this->htmlData);
    }
    public function bandejaAsistenciaAlu($curso=false)
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo= $this->input->post('codigo');
        $resultado=$this->Usuarios_model->buscarAlumnoasiAux($codigo);

        $this->htmlData['bodyData']->curso         = $curso ;
        $this->htmlData['bodyData']->results       = $resultado ;
        $this->htmlData['headData']->titulo        = "GESTION :: INTRANET";

        $this->load->view('vistasDialog/gestionDocente/bandejaAsistencia/asistenciaTotal', $this->htmlData);

    }
    public function consultarEvasion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo= $this->input->post('codigo');

            $datos= $this->Usuarios_model->evasion_alumno($codigo);



        $respuesta= $this->Usuarios_model->busquedaRespuesta();
        $i=0;
        foreach ($datos as $dato) {
            $datosNombre= $this->Usuarios_model->busquedaDatos($dato->id_alumno);
            $datosGrados= $this->Usuarios_model->buscarGrados($dato->id_grado);
            $datosSeccio= $this->Usuarios_model->buscarSecciones($dato->id_seccion);
            $datosCurso = $this->Usuarios_model->buscarCursos($dato->id_curso);
            if (isset($datosNombre[$i]->apepat)==true) {
                $arrayDato[]=array('id'=>$dato->id,
                       'nombre'=>$datosNombre[$i]->apepat.' '.$datosNombre[$i]->apemat.' '.$datosNombre[$i]->nombre,
                       'grados'=>$datosGrados[$i]->nom_grado.'° '.$datosSeccio[$i]->nom_seccion,
                       'cursos'=>$datosCurso[$i]->nom_cursos,
                       'fechas'=>$dato->fec_creacion,
                       'id_alumno'=>$dato->id_alumno,
                       'id_grado'=>$dato->id_grado,
                       'id_seccion'=>$dato->id_seccion,
                       'id_curso'=>$dato->id_curso,
                       'respuesta'=>$dato->tipo_obs

                       );
            }
        }
        if (isset($dato)==true) {
            $this->htmlData['bodyData']->results=$arrayDato;
            $this->htmlData['bodyData']->resultado=$respuesta;
        } else {
            $this->htmlData['bodyData']->results=0;
        }

        $this->load->view('vistasDialog/gestionAlumno/bandejaAsistencia/evasion', $this->htmlData);
    }
    public function comboBandeNota()
    {
        $this->load->model("Docente_model", '', true);
        $this->load->model("Usuarios_model", '', true);
        $id_curso=$this->input->post("curso");
        $id_grado=$this->input->post("grado");
        $id_seccion=$this->input->post("seccion");
        $id_bimestre=$this->input->post("bimestre");
        $id_profesor=$this->session->webCasSession->usuario->CODIGO;
        if (isset($id_curso)==true && isset($id_grado)==true && isset($id_seccion)==true && isset($id_bimestre)==true) {
            $busqueda= array('id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion,'id_bimestre'=>$id_bimestre,'ano'=>date('Y'),'id_profesor'=>$id_profesor);
            $respuesta=1;
            $results=1;
        } else {
            $respuesta=0;
            $results=0;
        }
        $validacion_head=$this->Docente_model->head_validacion($busqueda);
        $head_notas=$this->Docente_model->head($busqueda);
        $busquedaBimestre=$this->Usuarios_model->busqueda_notas_config($id_curso);
        $header_notas =array_unique(array_column($head_notas, 'nom_notas'));
        $cant_notas=array_unique(array_column($busquedaBimestre, 'nom_notas'));
        if (count($header_notas)!=count($cant_notas)) {
            if (count($header_notas)!=0) {
                echo "<center><strong style='color:red'>Falta configurar las siguientes capacidades: ".implode(',', array_diff(array_values($cant_notas), array_values($header_notas)))."</strong></center>";
                die();
            } else {
                echo "<center><strong style='color:red'>Por favor , configurar todas las capacidades.</strong></center>";
                die();
            }
        }


        $cantidad_cap=array('label'=>'','colspan'=>1,'rowspan'=>2);
        $cantidad_capacidad= $this->Docente_model->busqueda_notas_cantidad($busqueda);
        array_unshift($cantidad_capacidad,$cantidad_cap);


        $column_i=
            array(
                                        'data'=>"Apellidos y nombres",
                                        'type'=>'text',
                                        'readOnly'=>true
              )  ;
        $head_not[]=  array("Apellidos y nombres",'on');
        foreach ($head_notas as $clave=> $columns) {
            $readOnly=false;
            $className='htLeft';
            $validator=false;
            $head_not[]=array($columns['abreviacion'],'off');
            $column[]=
                array(
                    'data'=>$columns['abreviacion'],
                    'type'=>'numeric',
                    'readOnly'=>$readOnly,
                    'className'=>$className,
                    'validator'=>str_replace("\'", " ", $validator)
                     );

            if ((int)$clave!=(int)(count($head_notas)-1)) {
                if ($head_notas[$clave]['nom_notas']!=$head_notas[$clave+1]['nom_notas']) {
                    $head_not[]=array($columns['nom_notas'],'on');
                    $column[]=
                array(
                    'data'=>$columns['nom_notas'],
                    'type'=>'text',
                    'readOnly'=>true,
                    'className'=>$className,
                    'validator'=>str_replace("\'", " ", $validator)
                     );
                }
            } else {
                if ((int)$clave==(int)(count($head_notas)-1)) {
                    $head_not[]=array($columns['nom_notas'],'on');
                } else {
                    $head_not[]=array($columns['nom_notas'],'off');
                }

                $column[]=
                array(
                    'data'=>$columns['nom_notas'],
                    'type'=>'text',
                    'readOnly'=>true,
                    'className'=>$className,
                    'validator'=>str_replace("\'", " ", $validator)
                     );
            }
        }
        array_unshift($column, $column_i);
        $head=array_keys(array_diff(array_column($head_not, 1), array('off')));
        $cabecera=array_column($head_not, 0);
        if(empty($this->Docente_model->detalle_alumno($busqueda,false))==true){
            echo "<strong>No se han registrado alumnos</strong>";die();
        }
        $notas_detalle= $this->Docente_model->detalle_alumno($busqueda,false);

        $pesos= $this->Docente_model->detalle_alumno_peso($busqueda,$notas_detalle[0]['id_alumno']);



        $canti=$this->Docente_model->detalle_alumno_cantidad($busqueda);
        $deta_alumnos= array_map(
            function($person)
            {
                $det=$this->Docente_model->detalle_alumno($person,true);
                $cabecera_notas= array_column($det,'abreviacion');
                $detalles_notas= array_column($det,'nota');
                $persona= array('ape_pat_per'=>$person['ape_pat_per'],'id_alumno'=>$person['id_alumno']);


                //$notas  =
                return array_combine($cabecera_notas,$detalles_notas);
                    // array_merge($notas,$persona);
            }
            ,$notas_detalle);
            $a=1;
            $con=0;
            $contador=0;
            $cadena='';
            $list=array();

            foreach($deta_alumnos as $clave => $not){
                $letra='B';
                $con=0;
                $i=0;
                $ini=0;
            foreach($canti as $key =>$notas){
                $fin=(int)$notas['cantidad'];

                $cantidad=count($not);
                $notas_capacidades=array_slice($not,$ini,$fin);
                $ini=$ini+$fin;
                $cantidad_notas_capacidades=count($notas_capacidades);
                $array_letra='';
                $i=0;

                while($i<$cantidad_notas_capacidades){

                    $array_letra[]="IF(COUNTBLANK(".$letra.$a.")=0;(".$letra.$a.");0)"."*".$pesos[$con]['peso'];
                    $letra++;
                    $i++;
                    $con++;

                }

                $letra++;

                $list[$clave][$key]=implode(',,',array_merge($notas_capacidades,array($notas['nom_notas']=>"=ROUND((".implode('+',$array_letra)."),2)")));

            }
            $a++;
            $list[$clave]=$notas_detalle[$clave]['ape_pat_per'].',,'.implode(',,',$list[$clave]).',,'.$notas_detalle[$clave]['id_alumno'];
              # $list[$clave]["ape_pat_per"]=$notas_detalle[$clave]['ape_pat_per'];
              # $list[$clave]["id_alumno"]  =$notas_detalle[$clave]['id_alumno'];


              $list_final_notas[] = explode(',,',$list[$clave]);
            }


            array_push($cabecera,'codigo');
            foreach($list_final_notas as $fin){
          //      $fin==''?$value=0:$value=$fin;
        #  var_dump($cabecera);var_dump($fin);
                $deta_alumnos_fin[]=array_combine($cabecera,$fin);
            }

            #var_dump($deta_alumnos_fin); die();
            #var_dump($deta_alumnos_fin); die();
            #regla de negocio , nombre de abreviaciones deben de ser distintos

        $cantidad=count($deta_alumnos);
        $this->htmlData['bodyData']->cantidad                   =$cantidad;
        $this->htmlData['bodyData']->datos                      =$busqueda;
        $this->htmlData['bodyData']->tabla                      =$deta_alumnos_fin;
        $this->htmlData['bodyData']->respuesta                  =$respuesta;
        $this->htmlData['bodyData']->results                    =$results;
        $this->htmlData['bodyData']->head                       =json_encode($cabecera);
        $this->htmlData['bodyData']->column                     =json_encode($column);
        $this->htmlData['bodyData']->marcados                   =json_encode($head);
        $this->htmlData['bodyData']->head_primera               =json_encode($cantidad_capacidad);
        $this->load->view('vistasDialog/gestionDocente/bandejaNotas/bandejaNotas', $this->htmlData);
    }
    public function detalle_notas($list_alumno){
        $this->load->model("Docente_model", '', true);
        $this->load->model("Usuarios_model", '', true);

        return $list_alumno;
    }
    public function comboConfiguracionNota()
    {
        $this->load->model("Docente_model", '', true);
        $this->load->model("Usuarios_model", '', true);
        $id_curso=$this->input->post("curso");
        $id_grado=$this->input->post("grado");
        $id_nota=$this->input->post("nota");
        $id_profesor=$this->session->webCasSession->usuario->CODIGO;

        $suma_nota= $this->Usuarios_model->suma_notas($id_grado, $id_curso, $id_profesor, $id_nota);
        $cantidad_bi= (int)$this->Usuarios_model->getbi();
        $cantidad_sec=(int)$this->Usuarios_model->getsec($id_grado, $id_profesor, $id_curso);
        if (isset($id_curso)==true && isset($id_grado)==true &&  isset($id_nota)==true) {
            $busqueda= array('curso'=>$id_curso,'grado'=>$id_grado,'ano'=>date('Y'),'profesor'=>$id_profesor,'nota'=>$id_nota);

            $respuesta=1;
            $results=1;
        } else {
            $respuesta=0;
            $results=0;
        }
        $this->htmlData['bodyData']->datos                    =$busqueda;
        $this->htmlData['bodyData']->acumulado                =(((int)$suma_nota['acumulado']/$cantidad_bi)/$cantidad_sec)*100;
        $this->load->view('vistasDialog/gestionDocente/bandejaNotas/bandejaConfiguracion', $this->htmlData);
    }
    public function cambiar_estado_configuracion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Docente_model", '', true);
        $grado       =$this->input->post('grado');
        $nota       =$this->input->post('nota');
        $profesor   =$this->input->post('profesor');
        $curso        =$this->input->post('curso');
        $abreviacion        =$this->input->post('abreviacion');
        $cadena='';
        $descontar        =$this->input->post('descontar');
        $data= array('profesor'=>$profesor,'curso'=>$curso,'grado'=>$grado);
        $list_seccion = $this->Usuarios_model->busquedaCursoSeccionProf($data);
        $i=0;
        foreach(explode(',',$abreviacion) as $list_abreviacion){
            $id_rel_notas_detalle[]= $this->Docente_model->busqueda_notas_configuradas_id($grado, $curso, $list_abreviacion, $profesor, date('Y'));

            $j=0;
            foreach($id_rel_notas_detalle[$i] as $cadena_notas_id){
                $cadena.=','.implode(',',$id_rel_notas_detalle[$i][$j]);
                $j++;
            }
           $i++;
        }

        foreach($list_seccion as $seccion){
            $cadena_seccion[]=$seccion['id_seccion'];
        }


        $list_cambio=array('estado'=>0,'usu_modificacion'=>$this->session->webCasSession->usuario->USUARIO,'fec_modificacion'=>date('Y-m-d'));
        $list_datos=array('id_grado'=>$grado,'id_profesor'=>$profesor,'id_curso'=>$curso,'ano'=>date('Y'));
        $list_datos_alumno=array('id_grado'=>$grado,'id_curso'=>$curso,'ano'=>date('Y'));

        if($descontar>0){
                if ($this->Usuarios_model->editar_configuracion_nota($list_cambio, $list_datos,substr($cadena,1))) {
                        if($this->Usuarios_model->editar_configuracion_nota_alumno($list_cambio,$list_datos_alumno,implode(',',$cadena_seccion),substr($cadena,1))){
                            echo "edicion exitosa";
                        }else{
                            echo "fallo en la eliminacion alumno";
                        }
                } else {
                    echo "fallo en la eliminacion";
                }
         }
    }
    public function valido_abreviacion_notas()
    {
        $this->load->model("Usuarios_model", '', true);
        $grado      =$this->input->post('grado');
        $curso      =$this->input->post('curso');
        $nota       =$this->input->post('nota');
        $profesor   =$this->input->post('profesor');
        $ano        =$this->input->post('ano');
        $abreviacion= strtoupper($this->input->post('abreviacion'));
        $respuesta  = $this->Usuarios_model->validar_abreviacion($grado, $curso, $nota, $profesor, $ano, $abreviacion);
        if (empty($respuesta)) {
            $mensaje=0;
            echo  json_encode($mensaje);
        } else {
            $mensaje=1;
            echo json_encode($mensaje);
        }
    }
    public function registrar_configuracion_nota()
    {
        $this->load->model("Docente_model", '', true);
        $this->load->model("Usuarios_model", '', true);
        $grado      =$this->input->post('grado');
        $curso      =$this->input->post('curso');
        $nota       =$this->input->post('nota');
        $profesor   =$this->input->post('profesor');
        $ano        =$this->input->post('ano');
        $abreviacion=$this->input->post('abreviacion');
        $list_nota= explode(',', $nota);
        $descripcion=$this->input->post('descripcion');
        $peso       =$this->input->post('peso');
        $descontar  =$this->input->post('descontar');
        if (empty($abreviacion) || empty($peso) || empty($descripcion) || array_search('0',$peso)!='' || array_search(0,$peso)!='' || array_search('',$peso)!=''  ) {
            $mensaje="No se ha ingresado informacion nueva";
            echo json_encode($mensaje);
            die();
        }
        if (is_null($peso)) {
            $sum_peso=0;
        } else {
            $sum_peso=array_sum($peso);
        }
        foreach($abreviacion as $list_abre){
            $det=$this->Docente_model->busqueda_notas_configuradas_abreviacion($grado, $curso, strtoupper($list_abre), $profesor, $ano);
            if(count($det)!=0){
                $mensaje='Ya ses registró esta abreviación por favor ingresar una abreviación que no se haya registrado aún.';
                echo json_encode($mensaje);
                die();
            }
        }

        ## validacion
        $cantidad_bi= (int)$this->Usuarios_model->getbi();
        $cantidad_sec=(int)$this->Usuarios_model->getsec($grado, $profesor, $curso);
        $suma_nota= $this->Usuarios_model->suma_notas($grado, $curso, $profesor, $nota);
        $suma_bd=(($suma_nota['acumulado']/$cantidad_bi))*100;


        $sum_final= $suma_bd+(array_sum($peso))-(int)$descontar;


        if ((int)$sum_final!=100) {
            $mensaje="La suma total debe ser igual a 100";
            echo json_encode($mensaje);
            die();
        }
        $mensaje=1;
        $i=0;
        $data= array('profesor'=>$profesor,'curso'=>$curso,'grado'=>$grado);
        $list_seccion = $this->Usuarios_model->busquedaCursoSeccionProf($data);
        $bimestre= $this->Usuarios_model->buscarBimestres(date('Y'));
        $secciones= implode(',',array_column($list_seccion,'id_seccion'));

        foreach ($abreviacion as  $abreviado) {
            foreach ($list_nota as $not) {

                    $save_informacion= array(
                        'id_grado'      =>$grado,
                        'id_curso'      =>$curso,
                        'id_nota'       =>$not,
                        'id_profesor'   =>$profesor,
                        'ano'           =>$ano,
                        'abreviacion'   =>strtoupper($abreviado),
                        'descripcion'   =>strtoupper($descripcion[$i]),
                        'peso'          =>$peso[$i]/100,
                        'estado'        =>1,
                        'fec_creacion'  =>date('Y-m-d h:m:s'),
                        'usu_creacion'  =>$this->session->webCasSession->usuario->USUARIO

                    );
                    var_dump($save_informacion); die();
                    $ultimo_id=$this->Docente_model->registrar_nueva_configuracion($save_informacion);

                    if ((int)$ultimo_id==0 || $ultimo_id=='') {
                        echo "Sucedió un incoveniente , verifique que cumplió con todo lo solicitado";
                        die();
                    }else{
                        $datos= array('id_grado'=>$grado,'id_profesor'=>$profesor,'id_curso'=>$curso,'id_seccion'=>$secciones);

                        $list_alumnos=$this->Usuarios_model->list_alumno_capacidad($datos);
                        foreach($list_alumnos as $key=>$lista){

                                $insertRelAula= array(  'id_grado'=>$grado              ,
                                                        'id_seccion'=>$lista['id_seccion'],
                                                        'id_curso'=>(int)$curso              ,
                                                        'id_nota'=>(int)$ultimo_id           ,
                                                        'id_alumno'=>(int)$lista['id_alumno']             ,
                                                        'ano'=>(int)date('Y')           ,
                                                        'usu_creacion'=> $this->session->webCasSession->usuario->USUARIO,
                                                        'estado'=>1,
                                                        'fec_creacion'=>date('Y-m-d'));
                                $this->Docente_model->registrar_nuevo_regstro_notas($insertRelAula);

                    }
            }

        }
        $i++;
    }
        echo json_encode($mensaje);
    }
    public function comboCursoGradoProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_grado=$this->input->post("grado");
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$id_grado);
        $busquedaSeccion=$this->Usuarios_model->busquedaCursoGradoProf($busqueda);
        $arraySeccion=array_column($busquedaSeccion, 'id_curso');
        $busquedaGrado= implode(',', $arraySeccion);
        $busquedaSecc= $this->Usuarios_model->buscarCursos($busquedaGrado);
        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaSecc as $bus) {
            $html.="<option value='$bus->id'>$bus->nom_cursos</option>";
        }

        echo $html;
    }
    public function cargarConfiguracionNotas()
    {
        $this->load->model("Docente_model",'',TRUE);
        $grado   =$this->input->post('grado');
        $curso   =$this->input->post('curso');
        $nota    =$this->input->post('nota');
        $profesor=$this->input->post('profesor');
        $ano=$this->input->post('ano');
        $informacion= $this->Docente_model->busqueda_notas_configuradas($grado,$curso,$nota,$profesor,$ano);
        $formulas   = $this->Docente_model->formulario_capacidades($grado,$nota,$profesor,$ano,$curso);

        if(!empty($formulas)){
        $form_nombre= implode('+',array_column($formulas,'form'));
        $formula_final= $formulas[0]['des_notas'].'='.$form_nombre;
        }


        if(isset($informacion)==true){
            $busqueda= array('curso'=>$curso,'grado'=>$grado,'ano'=>$ano,'profesor'=>$profesor,'nota'=>$nota);
            $respuesta=1;$results=1;
            }else{
             echo "No existe información";die();
        }
        if(empty($formula_final)){
        $this->htmlData['bodyData']->formula                          ='';
        }else{
        $this->htmlData['bodyData']->formula                          =$formula_final;
        }
        $this->htmlData['bodyData']->datos_usuario                    =$busqueda;
        $this->htmlData['bodyData']->datos                            =$informacion;
        $this->load->view('vistasDialog/gestionDocente/bandejaNotas/cargarBandejaConfiguracion',$this->htmlData);
    }
    public function comboBandeAsis()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_curso=$this->input->post("curso");
        $id_grado=$this->input->post("grado");
        $id_seccion=$this->input->post("seccion");
        $busqueda= array('id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion);
        $resultado= $this->Usuarios_model->buscaralumno($busqueda);
        $validacionA= $this->Usuarios_model->validacionFechaAlumno($busqueda);

        $contador=0;
        foreach ($validacionA as $vali) {
            if (substr($vali->asistencia, 0, 10)==date('Y-m-d')) {
                $contador++;
            }
        }


        $i=0;
        foreach ($resultado as $result) {
            $alumnos[$i]=$result->id_alumno;
            $i++;
        }
        $resultado2= implode(',', $alumnos);

        $arrayporcentaje = $this->Usuarios_model->busquedaAsistencia($resultado2, $id_curso);
        $arrayporcentajeP= $this->Usuarios_model->busquedaAsistenciaP($resultado2, $id_curso);


        foreach ($arrayporcentaje as $porcentajet) {
            $arrayporcentat[]= array('cantidad'=>$porcentajet->cantidad1,'id'=>$porcentajet->id_alumno);
        }
        foreach ($arrayporcentajeP as $porcentajep) {
            $arrayporcentap[]= (int)$porcentajep->asistencia;
        }

        for ($i=0;$i<count($alumnos);$i++) {
            if (isset($arrayporcentat[$i]['cantidad'])) {
                if (isset($arrayporcentap[$i])) {
                    $porcentaje[$arrayporcentat[$i]['id']]=((int)($arrayporcentap[$i])*100)/(int)($arrayporcentat[$i]['cantidad']);
                } else {
                    $porcentaje[$i]=0;
                }
            } else {
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
        $this->load->view('vistasDialog/gestionDocente/bandejaAsistencia/bandejaAsistencia', $this->htmlData);
    }
    public function consultarDatosProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alumno=$this->session->webCasSession->usuario->CODIGO;
        $datos=$this->Usuarios_model->busquedaDatos($alumno);
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $alumnos=array('id_alumno'=>$alu);
        $valores  = $this->Usuarios_model->busquedaGradoSeccion($alumnos) ;

        if (isset($datos[0]->ruta)==false) {
            $valor='publico/media/user.png';
        } else {
            $valor=$datos[0]->ruta;
        }
        $arrayDatos= array('nombre'=>$datos[0]->nombre,'apepat'=>$datos[0]->apepat,'apemat'=>$datos[0]->apemat,
                           'direcc'=>$datos[0]->direcc,'docume'=>$datos[0]->docume,'claves'=>$datos[0]->claves,
                           'usuari'=>$datos[0]->usuari,'correo'=>$datos[0]->correo,'telefo'=>$datos[0]->telefo,
                           'grados'=>"DOCENTE",'fecha'=>$datos[0]->fecha,'ruta'=>$valor);

        $this->htmlData['bodyData']->results         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $alumno ;
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionDocente/miUsuario', $this->htmlData);
    }
    public function editarInfo()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
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
        $extensiones_permitidas = array('png','jpg','jpeg');
        if(isset($_FILES['images']['name'][0])){
        foreach ($_FILES['images']['error'] as $key => $error) {
            if($_FILES['images']['size'][$key]==0){
                    echo "x"; die();
            }
            if ($error == UPLOAD_ERR_OK) {

                $extension = explode('/',strtolower($_FILES['images']['type'][$key]));

                if($extension[1]!=$extensiones_permitidas[array_search($extension[1],$extensiones_permitidas)]){
                    echo "n"; die();
                }
            }
            if ($error == UPLOAD_ERR_OK) {
                $name = $_FILES['images']['name'][$key];
                $tipo = $_FILES['images']['type'][$key];
                $namegeneric = $alumno."-".time().$name;
                $searcharray = array(' ');
                $namegeneric = str_replace($searcharray, '', $namegeneric);
                $ruta = "temp/repositorio/fotos/".$namegeneric;
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $ruta)) {
                    $archivo= array(
                    'nombre'      =>$namegeneric,
                    'ruta'        =>$ruta,
                    'tipo'        =>$tipo,
                    'usu_modificacion'=>$this->session->webCasSession->usuario->USUARIO
                        );

                    $this->Usuarios_model->cambiardat($archivo, $alumno) ;
                    echo "1";
                } else {
                    $errors= error_get_last();
                    echo "COPY ERROR: ".$errors['type'];
                    echo "<br />\n".$errors['message']."<br />\n";
                }
            }
        }
    }
        $this->Usuarios_model->cambiarclave($data, $alumno) ;
        $this->Usuarios_model->cambiardat($dato, $alumno) ;
        $this->Usuarios_model->editartelefon($datoT, $alumno) ;
        $this->Usuarios_model->editarcorreos($datoC, $alumno) ;
    }

    public function editarMaterial()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id=$this->input->post('id');
        $grado=$this->input->post('grado');
        $bimestre=$this->input->post('bimestre');
        $curso=$this->input->post('curso');
        $seccion=$this->input->post('seccion');
        $arrayEliminar= array('grado'=>$grado,'bimestre'=>$bimestre,'curso'=>$curso,'seccion'=>$seccion);
        $archi=$this->Usuarios_model->editarMateriales1($id);
        $nomArchivo=array('archivo'=>$archi[0]->nom_archivo,'descripcion'=>$archi[0]->descripcion);
        $this->htmlData['bodyData']->id         = $id ;
        $this->htmlData['bodyData']->arrayEliminar         = $arrayEliminar ;
        $this->htmlData['bodyData']->nomArchivo         = $nomArchivo ;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/editarMaterial', $this->htmlData);
    }
    public function eliminarMaterial()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id=$this->input->post('id');
        $grado=$this->input->post('grado');
        $bimestre=$this->input->post('bimestre');
        $curso=$this->input->post('curso');
        $ruta=$this->input->post('ruta');
        $seccion=$this->input->post('seccion');
        $arrayEliminar= array('grado'=>$grado,'bimestre'=>$bimestre,'curso'=>$curso,'seccion'=>$seccion,'ruta'=>$ruta);
        $this->htmlData['bodyData']->id         = $id ;
        $this->htmlData['bodyData']->arrayEliminar         = $arrayEliminar ;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/eliminarMateriales', $this->htmlData);
    }
    public function editarMateriales()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id=$this->input->post('id');
        $archivo=$this->input->post('archivo');
        $descrip=$this->input->post('editor');
        $data= array('nom_archivo'=>$archivo,'descripcion'=>$descrip);
        if($archivo=='' || $descrip==''){
            echo "0";
            die();
        }

        $this->Usuarios_model->editarMateriales2($id, $data);
    }
    public function eliminarMateriales()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id=$this->input->post('codigo');
        $ruta=$this->input->post('ruta');
        if (!unlink($ruta)) {
            echo("Error deleting $file");
            die();
        } else {
            $this->Usuarios_model->eliminarMateriales($id);
        }
    }
    public function verbandejaprof()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_grado=$this->input->post('grado');
        $bimestre=$this->input->post('bimestre');
        $id_curso=$this->input->post('curso');
        $id_seccion=$this->input->post('seccion');
        $busqueda= array('id_bimestre'=>$bimestre,'id_curso'=>$id_curso,'id_grado'=>$id_grado,'id_seccion'=>$id_seccion);
        $resultado= $this->Usuarios_model->buscardocumentos($busqueda);
        $this->htmlData['bodyData']->results         = $resultado ;
        $this->htmlData['bodyData']->arrayBusqueda         = $busqueda ;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/bandejaMaterial2', $this->htmlData);
    }
    public function subirArchivoProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $seccion      = $this->input->post('seccion');
        $grado        = $this->input->post('grado');
        $curso        = $this->input->post('curso');
        $bimestre     = $this->input->post('bimestre');
        $archivo= array('seccion'=>$seccion,'grado'=>$grado,'curso'=>$curso,'bimestre'=>$bimestre);

        $this->htmlData['bodyData']->archivos          = $archivo;
        $this->load->view('vistasDialog/gestionDocente/bandejaMaterial/subirArchivo', $this->htmlData);
    }
    public function registrarAsitencia()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $seccion      = $this->input->post('id_seccion');
        $grado        = $this->input->post('id_grado');
        $curso        = $this->input->post('id_curso');
        $arrayAlumno  = $this->input->post('txtcodigo');
        $arrayMarcad  = $this->input->post('txtmarcado');

        foreach ($arrayAlumno as $array) {
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
        $asistieronAl= implode(',', $arrayMarcad);
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
        if (count($arrayMarcad)>0) {
            $this->Usuarios_model->updateAsitencia($marcado, $asistieron);
        }
    }
    public function registrarArchivoProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $seccion      = $this->input->post('txtseccion');
        $grado        = $this->input->post('txtgrado');
        $curso        = $this->input->post('txtcurso');
        $bimestre     = $this->input->post('txtbimestre');
        $nomarchi     = $this->input->post('txtarchivo');
        $desarchi     = $this->input->post('txtdescripcion');
        $extensiones_permitidas = array('pdf','docx','png','jpg','jpeg','pptx','txt');



        if(isset($_FILES['images']['name'][0])){
        foreach ($_FILES['images']['error'] as $key => $error) {

            if($_FILES['images']['size'][$key]==0){
                    echo "x"; die();
            }
            if ($error == UPLOAD_ERR_OK) {

                $extension = explode('/',strtolower($_FILES['images']['type'][$key]));

                if($extension[1]!=$extensiones_permitidas[array_search($extension[1],$extensiones_permitidas)]){
                    echo "n"; die();
                }


                $name = $_FILES['images']['name'][$key];
                $tipo = $_FILES['images']['type'][$key];
                $namegeneric = $curso.time().$name;
                $searcharray = array(' ');
                $namegeneric = str_replace($searcharray, '', $namegeneric);
                $ruta = "temp/repositorio/".date('Y')."/".$grado."/".$seccion."/".$bimestre."/".$namegeneric;
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $ruta)) {
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
                    'fec_creacion'=>date('Y-m-d H:i:s'),
                    'notificacion'=>0
                        );

                    if($this->Usuarios_model->GuardarArchivoProf($archivo))
                        echo "1";
                } else {
                    $errors= error_get_last();
                    echo "COPY ERROR: ".$errors['type'];
                    echo "<br />\n".$errors['message']."<br />\n";
                }
            }
        }
    }
    }
}
