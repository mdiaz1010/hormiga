<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GestionAlumno extends CI_Controller
{
    public $htmlData = array();
    public function __construct()
    {
        parent::__construct();
        SessionSeguridad::tiempo_maximo($this->session->webCasSession);
        $this->htmlData = array(
            "body"=> get_class($this)
            ,"bodyData"=> (object) array()
            ,"headData"=> (object) array("titulo"=>"Gestion Alumno")
            ,"footerData"=> (object) array()
        );
    }

    public function index()
    {
    }
    public function consultarNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $valores  = $this->Usuarios_model->consultarano($alu) ;
        $i=0;
        foreach ($valores as $var) {
            $curso    = $this->Usuarios_model->buscarGrados($var->id_grado) ;
            $seccion  = $this->Usuarios_model->buscarSecciones($var->id_seccion) ;
            $arrayvalores[]=array('grado'=>$curso[$i]->nom_grado,'seccion'=>$seccion[$i]->nom_seccion,'ano'=>$var->ano);
            $i++;
        }
        $this->htmlData['bodyData']->valores           = $arrayvalores ;
        $this->htmlData['body']                          .= "/notas";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";

        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function bandejaNota()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->load->model("Docente_model", '', true);
        $ano=$this->input->post("ano");
        $formula='';
        $id_bimestre=$this->input->post("id_bimestre");

        if($id_bimestre==''){
            echo "Ingresar bimestre"; die();
        }
        $alumnos=$this->session->webCasSession->usuario->CODIGO;
        $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alumnos, $ano) ;
        $datos= array('id_alumno'=>$alumnos,'grado'=>$valores['id_grado'],'seccion'=>$valores['id_seccion'],'ano'=>$ano);
        $cursos = $this->Usuarios_model->busquedaCursoAlu2($datos);
        if (count($cursos)>0) {
            $this->htmlData['bodyData']->respuesta             = 1 ;
            foreach ($cursos as $cur) {
                $arrayCursos[]=$cur->id_curso;
                $list_notas_cursos[$cur->id_curso]=$this->Usuarios_model->mostrar_notas_alumnos(array('id_alumno'=>$alumnos,'ano'=>$ano,'id_curso'=>$cur->id_curso,'id_bimestre'=>$id_bimestre));

                $id_profesor=$this->Usuarios_model->busqueda_profesor(array('ano'=>$ano,'id_curso'=>$cur->id_curso,'id_grado'=>$valores['id_grado'],'id_seccion'=>$valores['id_seccion']));

                foreach($list_notas_cursos[$cur->id_curso] as $key => $detalle)
                {

                    $formula=$this->Docente_model->formulario_capacidades_alumno($valores['id_grado'],$id_profesor['id_profesor'],$ano,$cur->id_curso);
                    if(count(array_column($formula,'form'))>0){
                        $capacidad=array_column($list_notas_cursos[$cur->id_curso],'Capacidad');
                        $ultima_capacidad=end($capacidad);
                        $promedio=$this->Usuarios_model->reporteNotasAluCur_bimestre(array('id_alumno'=>$alumnos,'ano'=>$ano,'id_curso'=>$cur->id_curso,'id_bimestre'=>$id_bimestre));
                        $array_formula[$cur->id_curso]= '('.implode(' + ',array_column($formula,'form')).')<strong>/'.substr($ultima_capacidad,-1).'</strong>';
                        $array_promedio[$cur->id_curso]= $promedio['nota'];

                    }else{
                        $array_formula[$cur->id_curso]= 'Fórmula no definida';
                    }

                }


            }


            $curso= implode(',', $arrayCursos);
            $arrCursos = $this->Usuarios_model->buscarCursos($curso);



            $arrayalumno= $this->Usuarios_model->busquedaAlumnoN($alumnos);
            $arraybimest= $this->Usuarios_model->busquedaBimestre2($ano);
            $arraynotas =$this->Usuarios_model->busquedaNotas6($ano);

            $notas      =$this->Usuarios_model->busquedaNotas5($alumnos, $ano);

            $cantidad=  $this->Usuarios_model->cantidadXbimestre15();
            $this->htmlData['bodyData']->codigo             = $alumnos ;
            $this->htmlData['bodyData']->results            = $arrCursos ;
            $this->htmlData['bodyData']->cantidad           = $cantidad[0]->cantidad ;
            $this->htmlData['bodyData']->bimestre           = $arraybimest ;
            $this->htmlData['bodyData']->notas              = $arraynotas ;
            $this->htmlData['bodyData']->arrayAlumnos       = $alumnos ;
            $this->htmlData['bodyData']->arrayNote          = $notas ;
            $this->htmlData['bodyData']->array_result_alumno          = $list_notas_cursos ;
            $this->htmlData['bodyData']->formula              = $array_formula ;
            $this->htmlData['bodyData']->promedio             = $array_promedio ;
        } else {
            $this->htmlData['bodyData']->respuesta             = 0 ;
        }
        $this->load->view('vistasDialog/gestionAlumno/bandejaNota/bandejaNota', $this->htmlData);
    }
    public function comboBimeProf()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $busquedaBimestre=$this->Usuarios_model->busquedaBimestre();
        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaBimestre as $bus) {

            $html.="<option value='".$bus['id']."'>".$bus['nom_bimestre']."</option>";
        }
        echo $html;
    }
    public function consultarHorario()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $ano     = $this->Usuarios_model->busquedaAno($alu);
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
            $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores['id_grado'], $valores['id_seccion'], $ano[0]->ano);
        }
        $sump=1;
        $sums=1;
        $sumc=1;
        $p=0;
        $c=0;
        $s=0;
        if (isset($resultado)==true) {
            $this->htmlData['bodyData']->respuesta           = 1 ;
            $puesto_grado=$this->Usuarios_model->puestoGrado($valores['id_grado']);
            foreach ($puesto_grado as $grados) {// EXTRAIGO EL PUESTO Y LA NOTA DEL GRADO SECCION
                if ($alu==$grados->id_alumno) {
                    $arraygrado=array('puesto'=>$sump,'nota'=>(int)$grados->nota);
                }
                $sump++;
                $p++;
            }
            $puesto_salon=$this->Usuarios_model->puestoSalon($valores['id_grado'], $valores['id_seccion']);
            foreach ($puesto_salon as $salon) { // ESTRAIGO EL PUESTO Y LA NOTA DEL GRADO
                if ($alu==$salon->id_alumno) {
                    $arraysalon=array('puesto'=>$sums,'nota'=>(int)$salon->nota);
                }
                $sums++;
                $s++;
            }
            $puesto_colegio=$this->Usuarios_model->puestoColegio();

            foreach ($puesto_colegio as $colegio) { // EXTRAIGO EL PUESTO Y LA NOTA DEL COLEGIO
                if ($alu==$colegio->id_alumno) {
                    $arraycolegio=array('puesto'=>$sumc,'nota'=>round($colegio->nota, 2));
                }
                $sumc++;
                $c++;
            }
            $i=1;
            $totales= array('salon'=>$s,'grado'=>$p,'colegio'=>$c);
            $data= array('id_alumno'=>$alu,'id_grado'=>$valores['id_grado'],'id_seccion'=>$valores['id_seccion']);
            $trayecto=$this->Usuarios_model->reporteNotasAlu($data);
            $trayectoSalon=$this->Usuarios_model->reporteNotasAluSal($data);
            $trayectoGrado=$this->Usuarios_model->reporteNotasAluGra($data);
            $trayectoColeg=$this->Usuarios_model->reporteNotasAluCol();
            $cantidadCur  =$this->Usuarios_model->reporteCantidadCur($data);
            $sum=0;
            foreach ($resultado as $res) {
                $arrayResultado[$res->horario][$res->dia]=array('materia'=>trim($res->GRADO).'°'.$res->SECCION.' '.$res->descripcion);
                $color[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]='#'.substr(md5(rand(20, 100)), 0, 6);
                $title[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]=$res->CURSOS;
                $i++;
            }

            $turnohor= $this->Usuarios_model->busquedaHorario($data['id_seccion']);
            $horarioDia= $this->Usuarios_model->getDiass();
            $horarioHor= $this->Usuarios_model->getHorarioss();
            $horarioHori= $this->Usuarios_model->getHorariossid($turnohor[0]->horario);
            $this->htmlData['bodyData']->dias            = $horarioDia ;
            $this->htmlData['bodyData']->horas           = $horarioHor ;
            $this->htmlData['bodyData']->idHor           = $horarioHori ;
            $this->htmlData['bodyData']->trayecto        = $trayecto ;
            $this->htmlData['bodyData']->trayectoSal     = $trayectoSalon ;
            $this->htmlData['bodyData']->trayectoGra     = $trayectoGrado ;
            $this->htmlData['bodyData']->trayectoCol     = $trayectoColeg ;
            $this->htmlData['bodyData']->results         = $arrayResultado ;
            $this->htmlData['bodyData']->colegio         = $arraycolegio ;
            $this->htmlData['bodyData']->salon           = $arraysalon ;
            $this->htmlData['bodyData']->grado           = $arraygrado ;
            $this->htmlData['bodyData']->total           = $totales ;
            $this->htmlData['bodyData']->color           = $color ;
            $this->htmlData['bodyData']->curso           = $title ;
        } else {
            $this->htmlData['bodyData']->respuesta           = 0 ;
        }
        $this->htmlData['body']                          .= "/horario";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function consultarAsistencia()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $alumno=array('id_alumno'=>$this->session->webCasSession->usuario->CODIGO);
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
            foreach ($resultadoCurs as $curso) {
                $arrayCurso[]=$curso->id_curso;
            }
            $cursos= implode(',', $arrayCurso);
            $maecursos=$this->Usuarios_model->buscarCursos($cursos);
            $this->htmlData['bodyData']->results         = $resultado ;
            $this->htmlData['bodyData']->cursos         = $maecursos ;
        } else {
            $this->htmlData['bodyData']->respuesta         = 0 ;
        }
        $this->htmlData['body']                          .= "/asistencia";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function editarInfo()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alumno=$this->session->webCasSession->usuario->CODIGO;
        $fecha  =$this->input->post('fecha');
        $direc  =$this->input->post('direccion');
        $clave  =$this->input->post('clave');
        $email  =$this->input->post('email');
        $telefono  =$this->input->post('telefono');
        $data=array('clav_usuario'=>$clave);
        $dato=array('direccion'=>$direc,'fecha_nac'=>$fecha);
        $datoC=array('des_correo'=>$email,'usu_modificacion'=>$alumno,'fec_modificacion'=>date('Y-m-d'));
        $datoT=array('num_tel'=>$telefono,'usu_modificacion'=>$alumno,'fec_modificacion'=>date('Y-m-d'));

        foreach ($_FILES['images']['error'] as $key => $error) {
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
                } else {
                    $errors= error_get_last();
                    echo "COPY ERROR: ".$errors['type'];
                    echo "<br />\n".$errors['message']."<br />\n";
                }
            }
        }
        $this->Usuarios_model->cambiarclave($data, $alumno) ;
        $this->Usuarios_model->cambiardat($dato, $alumno) ;
        $this->Usuarios_model->editartelefon($datoT, $alumno) ;
        $this->Usuarios_model->editarcorreos($datoC, $alumno) ;
    }

    public function consultarDatos()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alumno=$this->session->webCasSession->usuario->CODIGO;
        $datos=$this->Usuarios_model->busquedaDatos($alumno);
        $alu= $this->session->webCasSession->usuario->CODIGO;

        $ano= $this->Usuarios_model->busquedaAno($alu);
        $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;

        $grado  =$this->Usuarios_model->buscarGrados($valores['id_grado']) ;

        $seccion=$this->Usuarios_model->buscarSecciones($valores['id_seccion']) ;
        $gradoSecc=$grado[0]->nom_grado.'°'.$seccion[0]->nom_seccion;
        if (isset($datos[0]->ruta)==false) {
            $valor='publico/media/user.png';
        } else {
            $valor=$datos[0]->ruta;
        }
        $arrayDatos= array('nombre'=>$datos[0]->nombre,'apepat'=>$datos[0]->apepat,'apemat'=>$datos[0]->apemat,
                           'direcc'=>$datos[0]->direcc,'docume'=>$datos[0]->docume,'claves'=>$datos[0]->claves,
                           'usuari'=>$datos[0]->usuari,'correo'=>$datos[0]->correo,'telefo'=>$datos[0]->telefo,
                           'grados'=>$gradoSecc,'fecha'=>$datos[0]->fecha,'ruta'=>$valor);
        $this->htmlData['body']                          .= "/miUsuario";
        $this->htmlData['bodyData']->results         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $alumno ;
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }

    public function bandejaAsistenciaAlu($curso=false)
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        if ($curso=='total') {
            $resultado=$this->Usuarios_model->buscarAlumnoasiAux($this->session->webCasSession->usuario->CODIGO);
        } else {
            $resultado=$this->Usuarios_model->buscarAlumnoasi($this->session->webCasSession->usuario->CODIGO, $curso);
        }
        $this->htmlData['bodyData']->curso         = $curso ;
        $this->htmlData['bodyData']->results         = $resultado ;
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        if ($curso=='total') {
            $this->load->view('vistasDialog/gestionAlumno/bandejaAsistencia/asistenciaTotal', $this->htmlData);
        } else {
            $this->load->view('vistasDialog/gestionAlumno/bandejaAsistencia/asistenciaCurso', $this->htmlData);
        }
    }
    public function guardarmensajeAs()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id     =$this->session->webCasSession->usuario->CODIGO;
        $fecha  =$this->input->post('fecha');
        $mensaje  =$this->input->post('mensaje');

        $data= array('id_alumno'=>$id,'fecha_val'=>$fecha);
        $dato= array('mensaje'=>$mensaje);
        $this->Usuarios_model->guardarMensajeAl($data, $dato);
    }
    public function editarAsistenciaAl()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id     =$this->input->post('id');
        $fecha  =$this->input->post('fecha');
        $buscar =$this->Usuarios_model->buscarmensaje($id);
        $resultado= $this->Usuarios_model->buscardocumentosasistencia($id);
        if (isset($buscar)==true) {
            $this->htmlData['bodyData']->mensaje       = $buscar[0]->mensaje ;
        } else {
            $mensaje= trim("El mensaje ha sido eliminado");
            $this->htmlData['bodyData']->mensaje       = $mensaje ;
        }
        $this->htmlData['bodyData']->codigo        = $id ;
        $this->htmlData['bodyData']->fecha         = $fecha ;
        $this->htmlData['bodyData']->results         = $resultado ;
        $this->load->view('vistasDialog/gestionAlumno/bandejaAsistencia/bandejaAsistencia', $this->htmlData);
    }
    public function editarAsistenciasAl()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo      = $this->input->post('txtid');
        $nomarchi     = $this->input->post('txtarchivo');
        $desarchi     = $this->input->post('txtfec');
        $mensaje     = $this->input->post('mensaje');
        $i=0;
        $id     =$this->session->webCasSession->usuario->CODIGO;
        $data= array('id_alumno'=>$id,'fecha_val'=>$desarchi);
        $dato= array('mensaje'=>$mensaje);
        $this->Usuarios_model->guardarMensajeAl($data, $dato);
        $this->Usuarios_model->guardarMensajeAlAux($data, $dato);
        foreach ($_FILES['images']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $name = $_FILES['images']['name'][$key];
                $tipo = $_FILES['images']['type'][$key];
                $namegeneric = trim($i.$codigo)."-".$name.time();
                $i++;
                $searcharray = array(' ');
                $namegeneric = str_replace($searcharray, '', $namegeneric);
                $ruta = "temp/justificar/".$namegeneric;
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $ruta)) {
                    $archivo= array(
                    'id_asistencia'=>$codigo,
                    'fecha_jus'   =>$desarchi,
                    'nombre'       =>$namegeneric,
                    'ruta'         =>$ruta,
                    'ano'          => date('Y'),
                    'usu_creacion' =>$this->session->webCasSession->usuario->USUARIO ,
                    'fec_creacion' =>date('Y-m-d')
                        );

                    $this->Usuarios_model->GuardarArchivoAsis($archivo);
                } else {
                    $errors= error_get_last();
                    echo "COPY ERROR: ".$errors['type'];
                    echo "<br />\n".$errors['message']."<br />\n";
                }
            }
        }
    }
    public function eliminarMaterialAs()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id=$this->input->post('id');
        $fec=$this->input->post('fecha');
        $ruta=$this->input->post('ruta');
        $this->htmlData['bodyData']->id         = $id ;
        $this->htmlData['bodyData']->fecha      = $fec ;
        $this->htmlData['bodyData']->ruta      = $ruta ;
        $this->load->view('vistasDialog/gestionAlumno/bandejaMaterial/eliminarMaterial', $this->htmlData);
    }
    public function eliminarMaterialesAs()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id=$this->input->post('codigo');
        $ruta=$this->input->post('ruta');
        if (!unlink($ruta)) {
            echo("Error deleting $file");
            die();
        } else {
            $this->Usuarios_model->eliminarMaterialesAs($id);
        }
    }
    public function verAsistenciaAl()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id  =$this->input->post('id');

        $this->htmlData['bodyData']->codigo        = $id ;
        if (isset($id)==true) {
            $resultado= $this->Usuarios_model->buscardocumentosasistencia($id);
            $this->htmlData['bodyData']->results         = $resultado ;
        } else {
            $this->htmlData['bodyData']->results         = 0 ;
        }


        $this->load->view('vistasDialog/gestionAlumno/bandejaAsistencia/verArchivo', $this->htmlData);
    }
    public function consultarRepositorio()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $alumno  = array('id_alumno'=>$this->session->webCasSession->usuario->CODIGO);

        $ano=$this->Usuarios_model->busquedaAno($alumno['id_alumno']);
        if ($ano[0]->ano==date('Y')) {
            $valores = $this->Usuarios_model->busquedaGradoSeccion($alumno) ;
        }

        if (isset($valores)==true) {
            $data    = array('grado'=>$valores['id_grado'],'seccion'=>$valores['id_seccion']);
            $curso   = $this->Usuarios_model->busquedaCursoAlu($data) ;
            if(isset($curso)==false){
                echo "No existe cursos registrados";die();
            }
        }
        if (isset($curso)==true) {
            $this->htmlData['bodyData']->respuesta                 = 1 ;
            foreach ($curso as $cur) {
                $cursos[]=$cur->id_curso;
            }
            $cursos  = implode(',', $cursos);
            $bimestre=$this->Usuarios_model->busquedaBimestre();
            $grado=$this->Usuarios_model->buscarGrados($data['grado']);
            $seccion=$this->Usuarios_model->buscarSecciones($data['seccion']);
            $arrayCursos = $this->Usuarios_model->buscarCursos($cursos) ;
            $this->htmlData['body']                          .= "/repositorio";
            $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
            $this->htmlData['bodyData']->curso                = $arrayCursos ;
            $this->htmlData['bodyData']->grado                = $grado ;
            $this->htmlData['bodyData']->seccion              = $seccion ;
            $this->htmlData['bodyData']->bimestre             = $bimestre ;
            $this->htmlData['bodyData']->data                 = $data ;
        } else {
            $this->htmlData['bodyData']->respuesta                 = 0 ;
            $this->htmlData['body']                          .= "/repositorio";
        }
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function comboBandeMate()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $curso=$this->input->post("curso");
        $grado=$this->input->post("grado");
        $seccion=$this->input->post("seccion");
        $bimestre=$this->input->post("bimestre");
        if ($curso=='Seleccione' || $bimestre=='Seleccione') {
            $busqueda= array('id_bimestre'=>$bimestre,'id_curso'=>$curso,'id_grado'=>$grado,'id_seccion'=>$seccion);
            $this->htmlData['bodyData']->results         = '' ;
            $this->htmlData['bodyData']->arrayBusqueda   = $busqueda ;
        } else {
            $busqueda= array('id_bimestre'=>$bimestre,'id_curso'=>$curso,'id_grado'=>$grado,'id_seccion'=>$seccion);
            $resultado= $this->Usuarios_model->buscardocumentos($busqueda);
            $this->htmlData['bodyData']->results         = $resultado ;
            $this->htmlData['bodyData']->arrayBusqueda         = $busqueda ;
        }
        $this->load->view('vistasDialog/gestionAlumno/bandejaMaterial/bandejaMaterial', $this->htmlData);
    }
    public function comboBimeAlu()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $busquedaBimestre=$this->Usuarios_model->busquedaBimestre();
        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaBimestre as $bus) {
            $html.="<option value='".$bus['id']."'>".$bus['nom_bimestre']."</option>";
        }
        echo $html;
    }
    public function consultarRecordAcade()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $valores  = $this->Usuarios_model->consultarano($alu) ;
        $i=0;
        foreach ($valores as $var) {
            $curso    = $this->Usuarios_model->buscarGrados($var->id_grado) ;
            $seccion  = $this->Usuarios_model->buscarSecciones($var->id_seccion) ;
            $arrayvalores[]=array('grado'=>$curso[$i]->nom_grado,'seccion'=>$seccion[$i]->nom_seccion,'ano'=>$var->ano);
            $i++;
        }
        $this->htmlData['bodyData']->valores           = $arrayvalores ;
        $this->htmlData['body']                          .= "/record";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function comboCursoRecord()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $comboCursoRecord=$this->input->post("ano");
        $alumno=$this->session->webCasSession->usuario->CODIGO;
        $resultado= $this->Usuarios_model->busquedaGradoSeccion2($alumno, $comboCursoRecord);


        // $gradosec= array('grado'=>$resultado[0]->id_grado,'seccion'=>$resultado[0]->id_seccion);
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$resultado['id_grado'],'seccion'=>$resultado['id_seccion'],'ano'=>$comboCursoRecord);
        $busquedaCurso=$this->Usuarios_model->busquedaCursoAlu2($busqueda);
        if (count($busquedaCurso)>0) {
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
        } else {
            echo "Sin informacion";
        }
    }
    public function bandejaNotaRecod()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $curso=$this->input->post("curso");
        $ano=$this->input->post("ano");
        if ($curso==false || $ano==false) {
            echo "Ingrese el curso";
            return true;
        }
        $data=array('id_alumno'=>$this->session->webCasSession->usuario->CODIGO,
                    'ano'=>$ano,
                    'id_curso'=>$curso);
        $arraybimest= $this->Usuarios_model->reporteNotasAluCur($data);
        if(count($arraybimest)==0){
            echo "No existen notas registradas."; die();
        }
        $arrayNotasTotal= $this->Usuarios_model->reporteNotasAluCurTol($data);

        foreach ($arrayNotasTotal as $conocer2) {
            $i=0;
            foreach ($arrayNotasTotal as $conocer3) {
                if ($conocer2->nombre==$conocer3->nombre) {
                    $arrayConocerTot[$conocer2->nombre][$i]=$conocer3->nota;
                    $i++;
                }
            }
        }
        $j=0;
        $haber="";

        foreach ($arrayConocerTot as $mostrar) {
            $data[$j]=implode(',', $arrayConocerTot[$arrayNotasTotal[$j]->nombre]);
            $haber.="{
                       name: '".$arrayNotasTotal[$j]->nombre."',
                       data: [".$data[$j]."]
                             },";
            $j++;
        }
        $haber1=  substr($haber, 0, -1);

        foreach ($arraybimest as $conocer) {
            if ($conocer->nota>17) {
                $resultado='Su nivel de rendimiento es considerado<strong> SATISFACTORIO</strong>';
            } elseif ($conocer->nota>13) {
                $resultado='Su nivel de rendimiento es considerado en<strong> PROCESO</strong>';
            } elseif ($conocer->nota>10) {
                $resultado='Su nivel de rendimiento es considerado en <strong>INICIO</strong>';
            } else {
                $resultado='Su nivel de rendimiento es considerado PREVIO <strong>INICIO</strong>';
            }
            $arrayConocer[]=array('curso'=>$conocer->nombre,'nota'=>$conocer->nota,'bimestre'=>$conocer->nombi,'resultado'=>$resultado);
        }

        $this->htmlData['bodyData']->haber                   = $haber1 ;
        $this->htmlData['bodyData']->ano                     = $ano ;
        $this->htmlData['bodyData']->info                    = $arraybimest ;
        $this->htmlData['bodyData']->resultado               = $arrayConocer ;
        $this->htmlData['bodyData']->resultadoTot            = $arrayConocerTot ;
        $this->load->view('vistasDialog/gestionAlumno/bandejaRecord/bandejaRecord', $this->htmlData);
    }
}
