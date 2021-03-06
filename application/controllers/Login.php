<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->htmlData = array(
            "body"=> get_class($this)
            ,"bodyData"=> (object) array()
            ,"headData"=> (object) array("titulo"=>"Crear Cliente")
            ,"footerData"=> (object) array()
        );
    }

    public function index()
    {
        $this->load->view('plantillas_base/login/body');
    }

    public function login()
    {
        try {
            $propiedades = new stdClass()                   ;
            $propiedades->webCasSession = new stdClass()    ;
            $this->session->unset_userdata('webCasSession') ;
            $this->load->library('encryption')              ;
            $user =  $this->input->post('user')             ;
            $pass =  $this->input->post('pass')             ;
            if (empty($user) || empty($pass)) {
                $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.');
                redirect('login');
            }
            $this->load->model("Usuarios_model", '', true)    ;
            $this->load->model("Modulos_model", '', true)     ;

            $usuario = $this->Usuarios_model->login($user, $pass);

            if (count($usuario)>0) {
                $usuario = $usuario[0];
                $newdata = array(
                            'session_user_id'         => $usuario->CODIGO               ,
                            'session_user_acces_rol'  => $usuario->ROLES                ,
                            'session_user_nombre'     => $usuario->USUARIO              ,
                            'session_user_documento'  => $usuario->DOCUMENTO            ,
                            'session_user_usuario'    => $usuario->USUARIO             ,
                            'session_user_email'      => $usuario->CORREO               ,
                            'session_user_img'        => $usuario->RUTA               ,
                            'session_user_logged_in'  => true                           ,
                        );
                //print_r($newdata); die();
                $propiedades->webCasSession->usuario = (object) $usuario  ;
                $propiedades->webCasSession->usuario->logged_in = true    ;
                $modulos = ($usuario->ROLES == 1)? $this->Modulos_model->GetModulosTotales(): $this->Modulos_model->GetModulosDisponibles($usuario->CODIGO, $usuario->ROLES)    ;
                $newdata = array('session_modulos' => array( ) );
                $propiedades->webCasSession->modulos = array();
                if ($usuario->ROLES == 1) {
                    for ($i=0;$i<count($modulos);$i++) {
                        $modulo =& $modulos[$i];

                        $newdata['session_modulos'][$i] =
                            array(
                                'id'                            => $modulo->id                          ,
                                'self_WebModulos_id_parent'     => $modulo->self_WebModulos_id_parent   ,
                                'WebModulosGrupos_id'           => $modulo->WebModulosGrupos_id         ,
                                'WebUsuariosRol_id'             => $modulo->WebUsuariosRol_id           ,
                                'titulo'                        => $modulo->titulo                      ,
                                'descripcion'                   => $modulo->descripcion                 ,
                                'esPanelInicial'                => $modulo->esPanelInicial              ,
                                'uri'                           => $modulo->uri                         ,
                                'html_clases'                   => $modulo->html_clases                 ,
                                'status'                        => $modulo->status                      ,
                                'isVisible'                     => $modulo->isVisible                   ,
                                'modus'                         => $modulo->modus
                            );

                        $propiedades->webCasSession->modulos[$i] = $modulo;
                    }
                } else {
                    for ($i=0;$i<count($modulos);$i++) {
                        $modulo =& $modulos[$i];

                        $newdata['session_modulos'][$i] =
                            array(
                                'id'                            => $modulo->id                          ,
                                'self_WebModulos_id_parent'     => $modulo->self_WebModulos_id_parent   ,
                                'WebModulosGrupos_id'           => $modulo->WebModulosGrupos_id         ,
                                'WebUsuariosRol_id'             => $modulo->WebUsuariosRol_id           ,
                                'titulo'                        => $modulo->titulo                      ,
                                'descripcion'                   => $modulo->descripcion                 ,
                                'esPanelInicial'                => $modulo->esPanelInicial              ,
                                'uri'                           => $modulo->uri                         ,
                                'html_clases'                   => $modulo->html_clases                 ,
                                'status'                        => $modulo->status                      ,
                                'isVisible'                     => $modulo->isVisible                   ,
                                'modus'                         => $modulo->modus                       ,
                                'permiso'                       => $modulo->permiso
                            );

                        $propiedades->webCasSession->modulos[$i] = $modulo;
                    }
                }
                //    print_r($newdata); die();

                $modulosGrupos = $this->Modulos_model->GetModulosGrupos($usuario->ROLES)    ;
                $newdata = array('session_modulosGrupos' => array());
                $propiedades->webCasSession->modulosGrupos = array();
                for ($i=0;$i<count($modulosGrupos);$i++) {
                    $modulosGrupo =& $modulosGrupos[$i];
                    $newdata['session_modulosGrupos'][$i] =
                            array(
                                'id'                    => $modulosGrupo->id                ,
                                'titulo'                => $modulosGrupo->titulo            ,
                                'descripcion'           => $modulosGrupo->descripcion       ,
                                'WebUsuariosRol_id'     => $modulosGrupo->WebUsuariosRol_id ,
                            );
                    $propiedades->webCasSession->modulosGrupos[$i] = $modulosGrupo;
                }

                $this->session->set_userdata((array) $propiedades);


                switch ($usuario->ROLES) {
                    case 1: $vista= array('vista'=>'GestionEducativa'); break;
                    case 2: $vista= array('vista'=>'vistaDirector'); break;
                    case 3: $vista= array('vista'=>'vistaSubDirector'); break;
                    case 4: $vista= array('vista'=>'GestionDocente'); break;
                    case 5: $vista= array('vista'=>'GestionAuxiliar'); break;
                    case 6: $vista= array('vista'=>'GestionAlumno');break;
                    }
                echo json_encode($vista);
            } else {
                redirect('login');
            }
        } catch (Exception $exc) {
            $this->session->sess_destroy();
            redirect('login');
        }
    }
    public function gestionEducativa()
    {
    }
    public function vistaDirector()
    {
        $this->htmlData['body'] .= "/index";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function estadistica()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $dotacionPresente =  $this->Usuarios_model->busquedaTotal();
        $notas = array(
          0=>array('nombre'=>'DIRECTOR'                 ,'nota'=>$dotacionPresente[1]['cantidad'],'rango'=>'18,19,20'),
          1=>array('nombre'=>'PROFESOR'                 ,'nota'=>$dotacionPresente[2]['cantidad'],'rango'=>'14,15,16,17'),
          2=>array('nombre'=>'ALUMNO'                   ,'nota'=>$dotacionPresente[3]['cantidad'],'rango'=>'11,12,13'),
          3=>array('nombre'=>'AUXILIAR   '              ,'nota'=>$dotacionPresente[0]['cantidad'],'rango'=>'0 a 10'),
        );
        $this->htmlData['bodyData']->usuariosTotales =  $this->Usuarios_model->reporteCantidadToral();
        $this->htmlData['bodyData']->notas =  $notas;
        $this->load->view('vistasDialog/login/director/estadistica', $this->htmlData);
    }
    public function merito()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->htmlData['bodyData']->merito          =  $this->Usuarios_model->puestoSalonTotal();


        $this->load->view('vistasDialog/login/director/merito', $this->htmlData);
    }
    public function vistaSubDirector()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $dotacionPresente =  $this->Usuarios_model->busquedaTotal();
        $notas = array(
          0=>array('nombre'=>'DIRECTOR'                 ,'nota'=>$dotacionPresente[1]['cantidad'],'rango'=>'18,19,20'),
          1=>array('nombre'=>'PROFESOR'                 ,'nota'=>$dotacionPresente[2]['cantidad'],'rango'=>'14,15,16,17'),
          2=>array('nombre'=>'ALUMNO'                   ,'nota'=>$dotacionPresente[3]['cantidad'],'rango'=>'11,12,13'),
          3=>array('nombre'=>'AUXILIAR   '              ,'nota'=>$dotacionPresente[0]['cantidad'],'rango'=>'0 a 10'),
        );
        $this->htmlData['bodyData']->merito          =  $this->Usuarios_model->puestoSalonTotal();
        $this->htmlData['bodyData']->usuariosTotales =  $this->Usuarios_model->reporteCantidadToral();
        $this->htmlData['bodyData']->notas =  $notas;
        $this->htmlData['body'] .= "/index";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function gestionDocente()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        if(empty($this->session->webCasSession->usuario->CODIGO)){
            redirect('login');
        }
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
        $this->htmlData['body']                  .= "/gestionDocente" ;
        $this->htmlData['headData']->titulo       = "GESTION :: INTRANET"       ;
        $this->load->view('plantillas_base/standar/body', $this->htmlData)       ;
    }
    public function gestionAuxiliar()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $cantidad   = $this->Usuarios_model->buscarInfoCantidad();
        $cantidadR   = $this->Usuarios_model->buscarInfoCantidadRes();
        $cantidad2   = $this->Usuarios_model->comparacionAsistenciaCant();
        $cantidad2azul   = $this->Usuarios_model->comparacionAsistenciaCantAzul();
        $busquedaAsis= $this->Usuarios_model->cantidadAsistenciaFalt();
        if (isset($cantidad2)==true) {
            $cantidad2[0]->cantidad=$cantidad2[0]->cantidad;
        } else {
            $cantidad2[0]->cantidad=0;
        }
        if (isset($cantidad)==true) {
            $cantidad[0]->cantidad=$cantidad[0]->cantidad;
        } else {
            $cantidad[0]->cantidad=0;
        }

        $this->htmlData['bodyData']->usuarios                = $this->Rol_model->getUsuario();
        $this->htmlData['bodyData']->cantidad                = $cantidad[0]->cantidad;
        $this->htmlData['bodyData']->cantidadR                = $cantidadR[0]->cantidad;
        $this->htmlData['bodyData']->cantidad2               = $cantidad2[0]->cantidad;
        $this->htmlData['bodyData']->cantidad2Azul               = $cantidad2azul[0]->cantidad;
        $this->htmlData['bodyData']->asistencia              = $busquedaAsis[0]->resultado;
        $this->htmlData['body']                             .= "/gestionAuxiliar";
        $this->htmlData['headData']->titulo                  = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function gestionAlumnoDir($alu)
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//

        $ano     = $this->Usuarios_model->busquedaAno($alu);
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
            $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores['id_grado'], $valores['id_seccion'], $ano[0]->ano);
        }
        $datos=$this->Usuarios_model->busquedaDatos($alu);
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
        if (isset($resultado)==true) {
            $this->htmlData['bodyData']->respuesta           = 1 ;
        } else {
            $this->htmlData['bodyData']->respuesta           = 0 ;
        }
        $this->htmlData['bodyData']->results1         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo           = $alu ;
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('vistasDialog/gestionEducativa/busqueda/alumno', $this->htmlData);
    }
    public function gestionAlumno()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $ano     = $this->Usuarios_model->busquedaAno($alu);
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
            $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores['id_grado'], $valores['id_seccion'], $ano[0]->ano);
        }
        if (isset($resultado)==true) {
            $this->htmlData['bodyData']->respuesta           = 1 ;
        } else {
            $this->htmlData['bodyData']->respuesta           = 0 ;
        }
        $this->htmlData['body']                          .= "/gestionAlumno";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function horario()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $ano     = $this->Usuarios_model->busquedaAno($alu);
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
            $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores['id_grado'], $valores['id_seccion'], $ano[0]->ano);
        }
        if (isset($resultado)==true) {
            $i=1;
            foreach ($resultado as $res) {
                $arrayResultado[$res->horario][$res->dia]=array('materia'=>trim($res->GRADO).'°'.$res->SECCION.' '.$res->descripcion);
                $color[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]='#'.substr(md5(rand(20, 100)), 0, 6);
                $title[$res->GRADO.'°'.$res->SECCION.' '.$res->descripcion]=$res->CURSOS;
                $i++;
            }
            $this->htmlData['bodyData']->results         = $arrayResultado ;
            $this->htmlData['bodyData']->color           = $color ;
            $this->htmlData['bodyData']->curso           = $title ;
        } else {
            $this->htmlData['bodyData']->respuesta           = 0 ;
        }
        $data= array('id_alumno'=>$alu,'id_grado'=>$valores['id_grado'],'id_seccion'=>$valores['id_seccion']);
        $turnohor= $this->Usuarios_model->busquedaHorario($data['id_seccion']);
        $horarioHor= $this->Usuarios_model->getHorarioss();
        $horarioHori= $this->Usuarios_model->getHorariossid($turnohor[0]->horario);
        $horarioDia= $this->Usuarios_model->getDiass();
        $this->htmlData['bodyData']->dias            = $horarioDia ;
        $this->htmlData['bodyData']->horas           = $horarioHor ;
        $this->htmlData['bodyData']->idHor           = $horarioHori ;
        $this->load->view('vistasDialog/login/alumno/horarios', $this->htmlData);
    }
    public function puestos()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $ano     = $this->Usuarios_model->busquedaAno($alu);
        $sump=1;
        $sums=1;
        $sumc=1;
        $p=0;
        $c=0;
        $s=0;
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
        }
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
        $totales= array('salon'=>$s,'grado'=>$p,'colegio'=>$c);
        $this->htmlData['bodyData']->colegio         = $arraycolegio ;
        $this->htmlData['bodyData']->salon           = $arraysalon ;
        $this->htmlData['bodyData']->grado           = $arraygrado ;
        $this->htmlData['bodyData']->total           = $totales ;
        $this->load->view('vistasDialog/login/alumno/puestos', $this->htmlData);
    }
    public function rendimiento()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $ano     = $this->Usuarios_model->busquedaAno($alu);
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
            $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores['id_grado'], $valores['id_seccion'], $ano[0]->ano);
        }

        if (isset($resultado)==true) {
            $this->htmlData['bodyData']->respuesta           = 1 ;




            $data= array('id_alumno'=>$alu,'id_grado'=>$valores['id_grado'],'id_seccion'=>$valores['id_seccion']);
            $trayecto=$this->Usuarios_model->reporteNotasAlu($data);
            $trayectoSalon=$this->Usuarios_model->reporteNotasAluSal($data);
            $trayectoGrado=$this->Usuarios_model->reporteNotasAluGra($data);
            $trayectoColeg=$this->Usuarios_model->reporteNotasAluCol();
            $cantidadCur  =$this->Usuarios_model->reporteCantidadCur($data);
            $sum=0;


            $this->htmlData['bodyData']->trayecto        = $trayecto ;
            $this->htmlData['bodyData']->trayectoSal     = $trayectoSalon ;
            $this->htmlData['bodyData']->trayectoGra     = $trayectoGrado ;
            $this->htmlData['bodyData']->trayectoCol     = $trayectoColeg ;
            $this->load->view('vistasDialog/login/alumno/rendimiento', $this->htmlData);
        }
    }
    public function inasistencia()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo=$this->input->post("codigo");
        if ($codigo==1) {
            $datos      = $this->Usuarios_model->buscarInfo();
        } else {
            $datos      = $this->Usuarios_model->buscarInfoG();
        }

        $i=0;
        foreach ($datos as $dato) {
            $datosNombre= $this->Usuarios_model->busquedaDatos($dato->id_alumno);
            $datosGrados= $this->Usuarios_model->buscarGrados($dato->id_grado);
            $datosSeccio= $this->Usuarios_model->buscarSecciones($dato->id_seccion);

            $respuesta  = $this->Usuarios_model->busquedaRespuesta();
            if (isset($datosNombre[0]->apepat)==true) {
                $arrayDato[]=array('id'=>$dato->id,
                       'codigo'=>$datosNombre[$i]->codigo,
                       'nombre'=>$datosNombre[$i]->apepat.' '.$datosNombre[$i]->apemat.' '.$datosNombre[$i]->nombre,
                       'grados'=>$datosGrados[$i]->nom_grado,
                       'seccio'=>$datosSeccio[$i]->nom_seccion,
                       'mensaj'=>$dato->mensaje,
                       'respuesta'=>$dato->respuesta,
                       'id_alumno'=>$dato->id_alumno,
                       'id_grado'=>$dato->id_grado,
                       'id_seccion'=>$dato->id_seccion,
                       'fecha'=>$dato->fec_creacion);
            }
        }
        if (isset($arrayDato)==true) {
            $this->htmlData['bodyData']->results         = $arrayDato ;
            $this->htmlData['bodyData']->resultado       = $respuesta;
        } else {
            $this->htmlData['bodyData']->results=0;
        }
        $this->load->view('vistasDialog/gestionAuxiliar/inasistencia/index', $this->htmlData);
    }
    public function registrarRespuesta()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id  =$this->input->post('respuesta');
        $codigo  =$this->input->post('codigo');
        $grado   =$this->input->post('grado');
        $seccion =$this->input->post('seccion');
        $alumno  =$this->input->post('alumno');
        $usu     =$this->input->post('usu');
        $fecha  =$this->input->post('fecha');
        $data= array('respuesta'=>$id);
        $fecha= substr($fecha, 0, 10);
        $array=array('fecha_val'=>$fecha.' 00:00:00','codigo'=>$usu);
        $this->Usuarios_model->cambiarRespuestaA($data, $codigo);
        $this->Usuarios_model->cambiarRespuestaAux($array, $data);
    }
    public function consultarGeneralAux()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $nombre= $this->input->post("nombre");
        $arrayDatos = $this->Rol_model->busquedaDatosGeneral($nombre);
        $this->htmlData['bodyData']->datos                 =$arrayDatos;
        $this->htmlData['headData']->titulo                = "GESTION :: INTRANET";
        $this->load->view('vistasDialog/gestionAuxiliar/bandejaConsulta/index', $this->htmlData);
    }
    public function verAsistenciaAl()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id  =$this->input->post('id');

        $this->htmlData['bodyData']->codigo        = $id ;
        $resultado= $this->Usuarios_model->buscardocumentosasistencia($id);
        $this->htmlData['bodyData']->results         = $resultado ;
        $this->load->view('vistasDialog/gestionAlumno/bandejaAsistencia/verArchivo', $this->htmlData);
    }
    public function evasion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo=$this->input->post("codigo");
        if ($codigo==1) {
            $datos= $this->Usuarios_model->comparacionAsistenciaF();
        } else {
            $datos= $this->Usuarios_model->comparacionAsistencia();
        }


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

        $this->load->view('vistasDialog/gestionAuxiliar/evasion/index', $this->htmlData);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        $this->index();
    }
    public function standar()
    {
        $this->load->model("Permisos_model", '', true);
        $data = $this->Permisos_model->GetModulosDisponibles() ;
        var_dump($data);
    }

    public function autoconsulta()
    {
        $this->load->model("Test_model", '', true);
        var_dump($this->Test_model->Get());
        $this->load->view('welcome_message');
    }
}
