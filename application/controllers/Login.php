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
            ,"headData"=> (object) array("titulo"=>"EDUMPRO - SISTEMA EDUCATIVO")
            ,"footerData"=> (object) array()
        );
    }

    public function index()
    {
        $this->load->view('plantillas_base/login/body');
    }
    public function enviar_correo_clave()
    {
        $this->load->model("Usuarios_model", '', true);
        $dni =  $this->input->post('users')       ;
        if(empty($dni)){
            echo json_encode(array('correcto'=>0));die();
        }
        $correo=$this->Usuarios_model->user_correo($dni);

        if(isset($correo)){
            $correo_usuario=$correo['des_correo'];
            $nombre=$correo['usuario'];



            $mensaje="Su  contraseña es: ".$correo['clav_usuario'];
/*
            $this->load->library('email');
            $asunto= "Clave nueva";
            $this->email->from($correo_usuario,$nombre);
            $list= array('marcodiazzavala@gmail.com');
            $this->email->to($correo_usuario);
            $this->email->cc($list);
            $this->email->subject('Intranet');
            $this->email->message($asunto);
            if($this->email->send()){
                echo json_encode(array('correcto'=>1));die();
            }else{
                echo json_encode(array('correcto'=>0));die();
            }
            */
            echo json_encode(array('correcto'=>1));die();
        }else{
            echo json_encode(array('correcto'=>0));die();

        }







    }
    public function recuperar_contrasena()
    {

        $this->load->view('plantillas_base/login/recuperar_contrasena');
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
                echo json_encode(array('error'=>1,'vista'=>'index'));die();
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
                            'session_user_usuario'    => $usuario->USUARIO              ,
                            'session_user_email'      => $usuario->CORREO               ,
                            'session_user_img'        => $usuario->RUTA                 ,
                            'session_user_nom'        => $usuario->NOMBRE               ,
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
                    case 1: $vista= array('vista'=>'gestionEducativa'); break;
                    case 2: $vista= array('vista'=>'vistaDirector'); break;
                    case 3: $vista= array('vista'=>'vistaSubDirector'); break;
                    case 4: $vista= array('vista'=>'gestionDocente'); break;
                    case 5: $vista= array('vista'=>'gestionAuxiliar'); break;
                    case 6: $vista= array('vista'=>'gestionAlumno');break;
                    case 7: $vista= array('vista'=>'gestionPadre');break;
                    }


                echo json_encode($vista);
            } else {
                echo json_encode(array('error'=>1,'vista'=>'index'));die();

            }
        } catch (Exception $exc) {
            $this->session->sess_destroy();
            echo json_encode(array('error'=>1,'vista'=>'index'));die();
        }
    }
    public function gestionPadre()
    {

        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Padre_model", '', true);
        $cod_apoderado=$this->session->webCasSession->usuario->DOCUMENTO;
        $list_hijos = $this->Padre_model->consultar_hijos($cod_apoderado);
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";
        $this->htmlData['body'] .= "/gestionPadre";
        $this->htmlData['bodyData']->list_hijos     = $list_hijos ;
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function asistencia()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//

        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $ano= date('Y');
        $valores= $this->Usuarios_model->buscargradosAno($ano);
        $this->htmlData['bodyData']->valores     = $valores ;
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";


            $this->htmlData['body'] .= "/asistencia";
            $this->load->view('plantillas_base/standar/body', $this->htmlData);


    }
    public function gestionEducativa()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $valores                                 = $this->Usuarios_model->getClientes() ;
        $this->htmlData['bodyData']->valores     = $valores ;
        $this->htmlData['body']                          .= "/index";
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function vistaDirector()
    {

   //     $merito_alumno =  $this->Usuarios_model->reporteNotasFinal_dir();

        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $dotacionPresente =  $this->Usuarios_model->busquedaTotal();



        $notas = array(
          0=>array('DIRECTOR',(int)$dotacionPresente[1]['cantidad'],true,true),
          1=>array('PROFESOR',(int)$dotacionPresente[2]['cantidad'],false),
          2=>array('ALUMNO'  ,(int)$dotacionPresente[4]['cantidad'],false),
          3=>array('AUXILIAR',(int)$dotacionPresente[3]['cantidad'],true)
        );





        $this->htmlData['bodyData']->usuariosTotales =  $this->Usuarios_model->reporteCantidadToral();
        $this->htmlData['bodyData']->notas =  json_encode($notas);
        $this->htmlData['bodyData']->total =  array_sum(array_column($dotacionPresente,'cantidad'));
        $this->htmlData['body'] .= "/index";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function estadistica()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $dotacionPresente =  $this->Usuarios_model->busquedaTotal();

        if($dotacionPresente[0]['cantidad']=='1'){
            echo "No existe información registrada"; die();
        }
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
        $this->htmlData['bodyData']->merito          =  $this->Usuarios_model->reporteNotasFinal_dir();


        $this->load->view('vistasDialog/login/director/merito', $this->htmlData);
    }
    public function registrarObservacion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $grado   =$this->input->post('grado');
        $seccion =$this->input->post('seccion');
        $curso   =$this->input->post('curso');
        $alumno  =$this->input->post('alumno');
        $fecha  =$this->input->post('fecha');


        $tipo         =$this->input->post('tipo');
        $codigo       =$this->input->post('codigo');
        $cambio= array('tipo_obs'=>trim($tipo));
        if ($tipo==1) {
            $observacion="El alumno no ingresó al salon de clases";
        } else {
            $observacion="El alumno justifico su inasistencia";
        }
        $cambio2= array('mensaje'=>$observacion);

        $this->Usuarios_model->cambiarObservacion($cambio, $codigo);
        $fecha= substr($fecha, 0, 10);

        $this->Usuarios_model->cambiarObservacionProf($cambio2, $grado, $seccion, $curso, $alumno, trim($fecha));
    }
    public function verdetalleAlumnoDir()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $codigo=$this->input->post("codigo");
        $ano=date('Y');
        if ($codigo==false || $ano==false) {
            echo "Ingrese el curso";
            return true;
        }
        $data=array(
                    'id_alumno'=>$codigo,
                    'ano'=>$ano,
                   );


        $arrayNotasTotal= $this->Usuarios_model->reporteNotasAluCurTol($data);
        if(empty($arrayNotasTotal)){ echo "No existe información registrada"; die();}
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

        $bimestre= $this->Usuarios_model->busquedaBimestre();
        $bimestre= array_column($bimestre,'nom_bimestre');

        $this->htmlData['bodyData']->bimestre                   = json_encode($bimestre) ;
        $this->htmlData['bodyData']->haber                   = $haber1 ;
        $this->htmlData['bodyData']->ano                     = $ano ;


        $this->htmlData['bodyData']->resultadoTot            = $arrayConocerTot ;
        $this->load->view('vistasDialog/gestionEducativa/notaGeneral/reporteNotas', $this->htmlData);
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
            redirect('login/');
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
        $this->htmlData['headData']->titulo       = "EDUMPRO - SISTEMA EDUCATIVO"       ;
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
        $this->htmlData['headData']->titulo                  = "EDUMPRO - SISTEMA EDUCATIVO";
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
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";
        $this->load->view('vistasDialog/gestionEducativa/busqueda/alumno', $this->htmlData);
    }
    public function gestionAlumno()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        SessionSeguridad::tiempo_maximo($this->session->webCasSession);
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $ano     = $this->Usuarios_model->busquedaAno($alu);

        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
            $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores['id_grado'], $valores['id_seccion'], $ano[0]->ano);
            $valores['ano']= $ano[0]->ano;
            $cantidad_cursos=$this->Usuarios_model->busquedaCurso($valores);
            $nota_vacia = array_column($this->Usuarios_model->nota_vacia($alu),'id_curso');
        }

        if (isset($resultado)==true) {
            $this->htmlData['bodyData']->respuesta           = 1 ;
        } else {
            $this->htmlData['bodyData']->respuesta           = 0 ;
        }
        $emergente['promedio']=count($cantidad_cursos)-count($nota_vacia);
        if(empty($this->Usuarios_model->validar_registro($alu)))
        {
             $emergente['promedio']=0;
        }
        if($emergente['promedio']==0){
            $disabled='display: none;';
        }else{
            $disabled='';
        }
        $emergente['repositorio']= $this->Usuarios_model->notificacion_repositorio($valores)['cantidad'];
        $this->htmlData['bodyData']->disabled         = $disabled ;
        $this->htmlData['bodyData']->emergente         = $emergente ;
        $this->htmlData['body']                          .= "/gestionAlumno";
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";
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
        $turnohor= $this->Usuarios_model->busquedaHorarios($data['id_seccion'],$data['id_grado']);

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
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
        }


        if($this->Usuarios_model->puestoSalon($valores['id_grado'], $valores['id_seccion'])){
            // ESTRAIGO EL PUESTO Y LA NOTA DEL SALON
            $puesto_salon=$this->Usuarios_model->puestoSalon($valores['id_grado'], $valores['id_seccion']);
            $indice_alumno_salon=array_search($alu,array_column($puesto_salon,'id_alumno'));
            $arraysalon=array('puesto'=>$indice_alumno_salon+1,'nota'=>$puesto_salon[$indice_alumno_salon]['nota']);
            $cantidad_salon=$puesto_salon[$indice_alumno_salon]['cantidad'];

            $puesto_grado=$this->Usuarios_model->puestoGrado($valores['id_grado']);
            $indice_alumno_grado=array_search($alu,array_column($puesto_grado,'id_alumno'));
                // EXTRAIGO EL PUESTO Y LA NOTA DEL GRADO
            $arraygrado=array('puesto'=>$indice_alumno_grado+1,'nota'=>$puesto_grado[$indice_alumno_grado]['nota']);
            $cantidad_grado=$puesto_grado[$indice_alumno_grado]['cantidad'];
            $puesto_colegio=$this->Usuarios_model->puestoColegio();
            $indice_alumno_colegio=array_search($alu,array_column($puesto_colegio,'id_alumno'));
                // EXTRAIGO EL PUESTO Y LA NOTA DEL COLEGIO
            $arraycolegio=array('puesto'=>$indice_alumno_colegio+1,'nota'=>$puesto_colegio[$indice_alumno_colegio]['nota']);
            $cantidad_colegio=$puesto_colegio[$indice_alumno_colegio]['cantidad'];
        }else{
            $arraysalon=array('puesto'=>'ND','nota'=>'ND');
            $cantidad_salon='ND';
            $arraygrado=array('puesto'=>'ND','nota'=>'ND');
            $cantidad_grado='ND';
            $arraycolegio=array('puesto'=>'ND','nota'=>'ND');
            $cantidad_colegio='ND';
        }





        $totales= array('salon'=>$cantidad_salon,'grado'=>$cantidad_grado,'colegio'=>$cantidad_colegio);
        $this->htmlData['bodyData']->colegio         = $arraycolegio ;
        $this->htmlData['bodyData']->salon           = $arraysalon ;
        $this->htmlData['bodyData']->grado           = $arraygrado ;
        $this->htmlData['bodyData']->total           = $totales ;
        $this->htmlData['bodyData']->codigo           = $alu ;
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
            //$cantidadCur  =$this->Usuarios_model->reporteCantidadCur($data);

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
    public function notificacion_general()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        SessionSeguridad::tiempo_maximo($this->session->webCasSession);
        $alu= $this->session->webCasSession->usuario->CODIGO;
        $ano     = $this->Usuarios_model->busquedaAno($alu);

        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
            $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores['id_grado'], $valores['id_seccion'], $ano[0]->ano);
            $valores['ano']= $ano[0]->ano;
            $cantidad_cursos=$this->Usuarios_model->busquedaCurso($valores);
            $nota_vacia = array_column($this->Usuarios_model->nota_vacia($alu),'id_curso');
        }

        if (isset($resultado)==true) {
            $this->htmlData['bodyData']->respuesta           = 1 ;
        } else {
            $this->htmlData['bodyData']->respuesta           = 0 ;
        }
        $emergente['promedio']=count($cantidad_cursos)-count($nota_vacia);
        if(empty($this->Usuarios_model->validar_registro($alu)))
        {
             $emergente['promedio']=0;
        }
        if($emergente['promedio']==0){
            $disabled='display: none;';
        }else{
            $disabled='';
        }
        $emergente['repositorio']= $this->Usuarios_model->notificacion_repositorio($valores)['cantidad'];

        $this->htmlData['bodyData']->disabled         = $disabled ;
        $this->htmlData['bodyData']->emergente         = $emergente ;
        $this->load->view('vistasDialog/gestionAlumno/bandejaMaterial/notificaciones', $this->htmlData);
    }
    public function repositorio_bandeja()
    {
        $this->load->model("Usuarios_model", '', true);
        $codigo = $this->session->webCasSession->usuario->CODIGO;
        $data_salon = $this->Usuarios_model->consultarano($codigo);
        $list_salon = array('id_alumno'=>$codigo,'id_grado'=>$data_salon[0]->id_grado,'id_seccion'=>$data_salon[0]->id_seccion,'ano'=>$data_salon[0]->ano);
        $list_bandeja = $this->Usuarios_model->buscardocumentos_bandeja($list_salon);
        $this->Usuarios_model->editar_notificacion_bandeja();
        if(count($list_bandeja)==0){ echo "No se ha registrado nueva información. Cabe resaltar que todo material subido por el docente se encuentra dentro de su repositorio."; die();}
        $this->htmlData['bodyData']->result=$list_bandeja;
        $this->load->view('vistasDialog/gestionAlumno/bandejaMaterial/repositorio_bandeja', $this->htmlData);
    }
    public function promedio_final()
    {
        $this->load->model("Usuarios_model", '', true);
        $codigo = $this->session->webCasSession->usuario->CODIGO;
        $data_salon = $this->Usuarios_model->consultarano($codigo);
        $list_salon = array('id_alumno'=>$codigo,'id_grado'=>$data_salon[0]->id_grado,'id_seccion'=>$data_salon[0]->id_seccion,'ano'=>$data_salon[0]->ano);
        $nota_vacia = implode(',',array_column($this->Usuarios_model->nota_vacia($codigo),'id_curso'));
        if(empty($this->Usuarios_model->validar_registro($codigo)))
        {
            echo "No existe información registrada"; die();
        }
        if(empty($nota_vacia))
        {$nota_vacia=0;}
        $notas_finales_cursos = $this->Usuarios_model->reporteNotasFinal_alumno($list_salon,$nota_vacia);

        $list_criterio=array_column($notas_finales_cursos,'criterio');
        $arreglo=[];
        foreach($list_criterio as $key => $desaprobado){
                if($desaprobado=='DESAPROBADO')
                {
                    $arreglo[]=$key;
                }
        }

        if(count($this->Usuarios_model->nota_vacia($codigo))>=1){
            $mensaje= "Si no visualiza algun curso es debido a que aún el docente no ha registrado las notas en su totalidad.";
        }else{
        if(count($arreglo)==0){
            $mensaje= "Usted ha pasado el presente año satisfactoriamente";
        }else if(count($arreglo)>=4){
            $mensaje= "Usted ha repetido el presente año escolar";
        }else{
            $mensaje= "Debe de acercarse a la institución para subsanar los cursos desaprobados.";
        }
    }
        $this->htmlData['bodyData']->mensaje=$mensaje;
        $this->htmlData['bodyData']->results=$notas_finales_cursos;
        $this->load->view('vistasDialog/gestionAlumno/bandejaNota/notas_finales', $this->htmlData);


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
        $data= array('respuesta'=>trim($id));

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
        $this->htmlData['headData']->titulo                = "EDUMPRO - SISTEMA EDUCATIVO";
        $this->load->view('vistasDialog/gestionAuxiliar/bandejaConsulta/index', $this->htmlData);
    }
    public function verAsistenciaAl()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id  =$this->input->post('id');
        $mensaje =$this->input->post('mensaje');
        $this->htmlData['bodyData']->codigo        = $id ;
        $resultado= $this->Usuarios_model->buscardocumentosasistencia($id);
        $this->htmlData['bodyData']->results         = $resultado ;
        $this->htmlData['bodyData']->mensaje         = $mensaje ;
        $this->load->view('vistasDialog/gestionAuxiliar/inasistencia/verArchivo', $this->htmlData);
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

}
