<?php
defined('BASEPATH') or exit('No direct script access allowed');
class GestionEducativa extends CI_Controller
{
    private $login;
    public $htmlData = array();
    public function __construct()
    {
        parent::__construct();
        $this->htmlData = array(
            "body"=> get_class($this)
            ,"bodyData"=> (object) array()
            ,"headData"=> (object) array("titulo"=>"Crear Cliente")
            ,"footerData"=> (object) array()
        );
        SessionSeguridad::tiempo_maximo($this->session->webCasSession);
    }
    public function index()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $valores                                 = $this->Usuarios_model->getClientes() ;
        $this->htmlData['bodyData']->valores     = $valores ;
        $this->htmlData['body']                          .= "/index";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function vistabandejaaula()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $this->htmlData['bodyData']->rolesCursos        = $this->Rol_model->getCursos();
        $this->htmlData['bodyData']->rolesSeccion       = $this->Rol_model->getSeccion();
        $this->htmlData['bodyData']->rolesGrado         = $this->Rol_model->getGrados();
        $this->htmlData['bodyData']->profesores         = $this->Rol_model->getProfesores();
        $this->htmlData['bodyData']->horas              = $this->Usuarios_model->getHorarioss();
        $this->htmlData['bodyData']->dias               = $this->Usuarios_model->getDiass();
        $this->htmlData['headData']->titulo             = "GestionEducativa";
        $this->load->view('vistasDialog/gestionEducativa/bandejaAula', $this->htmlData);
    }
    public function vistabandejaaulas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->htmlData['bodyData']->vista        = $this->Usuarios_model->getBandeja();
        $this->htmlData['headData']->titulo             = "GestionEducativa";
        $this->load->view('vistasDialog/gestionEducativa/aula/bandejaAulas', $this->htmlData);
    }
    public function listadoClientes()
    {
        $this->load->model("Usuarios_model", '', true);//
        $valores                                 = $this->Usuarios_model->getClientes() ;
        $this->htmlData['bodyData']->valores     = $valores ;
        $this->htmlData['body']                          .= "/listadoClientes";
        $this->htmlData['headData']->titulo               = "GestionEducativa";
        if ($this->session->webCasSession->usuario->ROLES==1) {
            $this->load->view('plantillas_base/standar2/body', $this->htmlData);
        } else {
            $this->load->view('plantillas_base/standar/body', $this->htmlData);
        }
    }


    public function crear()
    {
        $nombre      = Utilitario::limpiarCaracteresEspeciales($this->input->post('nombre'));
        $rol         = (int)"6";
        $usuario     = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('usuario')));
        $pass        = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('pass')));
        $email       = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('email')));
        $documento   = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('documento')));
        $direccion   = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('direccion')));
        $descripcion = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('descripcion')));
        $contacto    = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('contacto')));
        $contactoAdmin    = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('contactoAdmi')));
        //   $contrato    = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('contrato')));

        if ((empty($nombre) and strlen($nombre)<2) or empty($rol) or (empty($usuario) and strlen($usuario)<2)  or (empty($pass) and strlen($pass)<2)) {
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.1');
        } elseif (($rol >= $this->session->webCasSession->usuario->ROLES)) {
            $this->load->model("Usuarios_model", '', true);
            $this->load->model("Rol_model", '', true);

            $existeRol = $this->Rol_model->getList($rol);

            //var_dump($existeRol,$nombre,$usuario ,$pass,$rol);exit();
            if (count($existeRol)<1) {
                $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.2');
            } else {
                if (count($this->Usuarios_model->CheckList(array('usuario'   => $usuario))) >0) {
                    $usuario = $usuario.rand(1, 1000);
                }
                $mime="";
                if (isset($_FILES['contrato'])) {
                    $data= basename($_FILES['contrato']['name']);
                    $destino_archivo = "temp/".$data ;
                    if (move_uploaded_file($_FILES['contrato']['tmp_name'], $destino_archivo)) {
                        $mime = $_FILES['contrato']['type'];
                    }
                }
                $insert = array(
                    'WebUsuariosRol_id' => $rol,
                    'WebUsuarios_parentId' => $this->session->webCasSession->usuario->CODIGO ,
                    'nombre'         => $nombre     ,
                    'usuario'        => $usuario    ,
                    'pass'           => $pass       ,
                    'email'          => $email      ,
                    'documento'      => $documento  ,
                    'direccion'      => $direccion  ,
                    'descripcion'    => $descripcion,
                    'contacto'       => $contacto,
                    'contactoadmin'  => $contactoAdmin,
                    'usuarioCreacion'=> $this->session->webCasSession->usuario->USUARIO,
                    'webusuariohijo' => $rol,
                    'nombrerol'      => "PLATAFORMA CLIENTE",
                    'mime'           => $mime,
                    'data'           => $data
                );
                $permisos= array(
                                    67    ,
                                    68    ,
                                    69    );
                $ultimo="";
                $ultimo= $this->Usuarios_model->ultimoregistro();
                $ultimo=$ultimo[0];
                $ultimo= $ultimo->ultimo;
                if (!$this->Usuarios_model->set($insert, $permisos, $ultimo)) {
                    $this->session->set_flashdata('flashdata_respuesta', 'Registro correcto');
                }
            }
        }
        redirect('GestionEducativa');
    }




    public function bandeja($idusuario)
    {
        $this->load->model("Usuarios_model", '', true);
        if ($idusuario==null or (int)$idusuario == 0) {
            echo " <p>Datos No Encontrados</p>";
            return;
        }
        $empresa     = $this->Usuarios_model->getEmpresas($idusuario);
        $this->load->library('encryption');
        $this->htmlData['bodyData']->empresa =   $empresa;
        $this->load->view('vistasDialog/bandeja', $this->htmlData);
    }



    //FUNCIONES GRADO
    public function mostrarHorario()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $bandeja     = $this->Usuarios_model->getHorarioss();
        $horario=$this->input->post('horario') ;
        $horario1= explode(',', $horario);



        $this->load->library('encryption');
        $this->htmlData['bodyData']->horario =   $bandeja;
        $this->htmlData['bodyData']->horarios =  $horario1;
        $this->load->view('vistasDialog/gestionEducativa/horario/horario', $this->htmlData);
    }
    public function mostrarDias()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $bandeja     = $this->Usuarios_model->getDiass();
        $dia=$this->input->post('dias') ;
        $dia1= explode(',', $dia);
        $this->load->library('encryption');
        $this->htmlData['bodyData']->dias =   $bandeja;
        $this->htmlData['bodyData']->dia =   $dia1;
        $this->load->view('vistasDialog/gestionEducativa/horario/dias', $this->htmlData);
    }

    public function mostrarGrado()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/grado/grado', $this->htmlData);
    }
    public function mostrarSeccion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/seccion/seccion', $this->htmlData);
    }
    public function mostrarCurso()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/curso/curso', $this->htmlData);
    }
    public function mostrarBimestre()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/bimestre/bimestre', $this->htmlData);
    }
    public function mostrarNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/notas/notas', $this->htmlData);
    }
    public function registrarGrado()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/grado/grado', $this->htmlData);
    }
    public function registrarSeccion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/seccion/seccion', $this->htmlData);
    }
    public function registrarCurso()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $this->load->view('vistasDialog/gestionEducativa/seccion/seccion', $this->htmlData);
    }
    public function registrarAula()
    {
        $profesor              = $this->input->post('profesor')          ;
        $curso                 = $this->input->post('cursorol')          ;
        $seccion               = $this->input->post('seccionrol')        ;
        $grado                 = $this->input->post('gradorol')          ;
        $hora_dia              = $this->input->post('hora_dia')          ;
        $i=0;
        $this->load->model("Usuarios_model", '', true)             ;
        $this->load->library('encryption')                       ;
        $prof= $this->Usuarios_model->busquedaProfesor($profesor);
        $idprof= $prof[0]->id;
        foreach($hora_dia as $key =>$array_salon)
        {
            if($curso[$key]!='0' || $grado[$key]!='0' || $seccion[$key]!='0')
            {
            $list_salon= array('id_profesor'  =>(int)$idprof,
                                 'id_curso'     =>(int)$curso[$key],
                                 'id_grado'     =>(int)$grado[$key],
                                 'id_seccion'   =>(int)$seccion[$key],
                                 'horario'      =>(int)explode('-',$array_salon)[0],
                                 'dia'          =>(int)explode('-',$array_salon)[1],
                                 'ano'         =>(int)date('Y')          ,
                                 'estado'      =>1                  ,
                                 'usu_creacion'=> $this->session->webCasSession->usuario->USUARIO,
                                 'fec_creacion'=>date('Y-m-d')
                                );



            if(!$this->Usuarios_model->registrarAula($list_salon))
            {
                $msj = $this->db->error();
            }else{
                $msj ='success';
            }
            }
        }

        echo json_encode($msj);


    }
    public function editarGrado()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("id");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $busqueda=$this->Usuarios_model->buscarGrados($codigo);
        $nombre= $busqueda[0]->nom_grado;
        $descri= $busqueda[0]->des_grado;
        $datos= array(
            'id'       =>$codigo,
            'nom_grado'=>$nombre,
            'des_grado'=>$descri
        );
        $this->htmlData['bodyData']->datos =   $datos;
        $this->load->view('vistasDialog/gestionEducativa/grado/editar', $this->htmlData);
    }
    public function editarAula()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->load->library('encryption');
        $grados     = $this->input->post('grado');
        $seccion   = $this->input->post('seccion');
        $secciona=$this->Usuarios_model->busquedaSecc($seccion);
        $grado     = substr($this->input->post('grado'), 0, 1);
        $gradosas=$this->Usuarios_model->busquedaGrado($grado);
        $curso     = $this->input->post('curso');
        $cursosas=$this->Usuarios_model->busquedaCurs($curso);
        $aula= array('seccion'=>$seccion,'grado'=>$grados,'curso'=>$curso);
        $aulas= array('seccion'=>$secciona[0]->id,'grado'=>$gradosas[0]->id,'curso'=>$cursosas[0]->id);
        $descripcion=$this->Usuarios_model->busquedaAulas($aulas);
        $profesor=$this->Usuarios_model->busquedaProfesorN($descripcion[0]->id_profesor);
        $aulass=$this->Usuarios_model->busquedaAulasS($aulas);
        $dias=$this->Usuarios_model->busquedaAulasD($aulas);
        $i=0;
        $j=0;
        foreach ($aulass as $h) {
            $vectorhor[$i]=$h->horario;
            $i++;
        }
        foreach ($dias as $d) {
            $vectordia[$j]=$d->dia;
            $j++;
        }

        $vectordia1= implode(',', $vectordia);
        $vectorhor1= implode(',', $vectorhor);
        $this->htmlData['bodyData']->aula                =    $aula;
        $this->htmlData['bodyData']->aulas                =    $aulas;
        $this->htmlData['bodyData']->descripcion         =    $descripcion[0]->des_aula;
        $this->htmlData['bodyData']->profesor            =    $profesor[0]->profesor;
        $this->htmlData['bodyData']->profesores1         =    $this->Rol_model->getProfesores();
        $this->htmlData['bodyData']->dias                =    $vectordia1;
        $this->htmlData['bodyData']->secciones           =    $vectorhor1;
        $this->load->view('vistasDialog/gestionEducativa/aula/editar', $this->htmlData);
    }
    public function editarAulas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->load->library('encryption');
        $grados       = $this->input->post('txtgrado');
        $seccion      = $this->input->post('txtseccion');
        $curso        = $this->input->post('txtcurso');
        $prof         = $this->input->post('txtprofesor');
        $descripcion  = trim($this->input->post('txtdescripcion'));
        $horari                =                                              $this->input->post('horariosArray')       ;
        $diasri                =                                              $this->input->post('diassArray')          ;
        $horario= explode(',', $horari);
        $dias   = explode(',', $diasri);
        $profesor= $this->Usuarios_model->busquedaProfesor($prof);

        $filtro= array('grados'=>$grados,'seccion'=>$seccion,'curso'=>$curso,'descripcion'=>$descripcion,'profesor'=>$profesor[0]->id);
        // print_r($dias);
        // print_r($horario);
        // die();
        $this->Usuarios_model->eliminarAulass($filtro);


        $i=0;
        $j=0;
        foreach ($dias as $dia) {
            for ($i=0;$i<count($horario);$i++) {
                $data= array(
            'id_curso'    =>        $curso             ,
            'id_profesor' =>        $profesor[0]->id   ,
            'id_seccion'  =>        $seccion           ,
            'id_grado'    =>        $grados            ,
            'des_aula'    =>        $descripcion       ,
            'dia'         =>        $dia               ,
            'horario'     =>        $horario[$i]       ,
            'ano'         =>        date('Y')          ,
            'estado'      =>        1                  ,
            'usu_creacion'=> $this->session->webCasSession->usuario->USUARIO ,
            'usu_modificacion'=>$this->session->webCasSession->usuario->USUARIO
        );
                $this->Usuarios_model->registrarAula($data);
            }
        }
    }
    public function editarSeccion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("id");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $busqueda=$this->Usuarios_model->buscarSecciones($codigo);
        $nombre= $busqueda[0]->nom_seccion;
        $descri= $busqueda[0]->des_seccion;
        $datos= array(
            'id'       =>$codigo,
            'nom_grado'=>$nombre,
            'des_grado'=>$descri
        );
        $this->htmlData['bodyData']->datos =   $datos;
        $this->load->view('vistasDialog/gestionEducativa/seccion/editar', $this->htmlData);
    }
    public function editarCurso()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("id");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $busqueda=$this->Usuarios_model->buscarCursos($codigo);
        $nombre= $busqueda[0]->nom_cursos;
        $descri= $busqueda[0]->des_cursos;
        $cant_horas= $busqueda[0]->cant_horas;
        $cant_capacidades= $busqueda[0]->cant_capacidades;
        $datos= array(
            'id'       =>$codigo,
            'nom_cursos'=>$nombre,
            'des_cursos'=>$descri,
            'cant_horas'=>$cant_horas,
            'cant_capacidades'=>$cant_capacidades
        );
        $this->htmlData['bodyData']->datos =   $datos;
        $this->load->view('vistasDialog/gestionEducativa/curso/editar', $this->htmlData);
    }
    public function editarBimestre()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("id");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $busqueda=$this->Usuarios_model->buscarBimestre($codigo);
        $nombre= $busqueda[0]->nom_bimestre;
        $desde= $busqueda[0]->fecini_bimestre;
        $hasta= $busqueda[0]->fecfin_bimestre;
        $datos= array(
            'id'            =>$codigo,
            'nom_bimestre'  =>$nombre,
            'desde'         =>$desde,
            'hasta'         =>$hasta
        );
        $this->htmlData['bodyData']->datos =   $datos;
        $this->load->view('vistasDialog/gestionEducativa/bimestre/editar', $this->htmlData);
    }
    public function editarNota()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("id");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $busqueda=$this->Usuarios_model->buscarNota($codigo);
        $nomb= $busqueda[0]->nom_notas;
        $desc= $busqueda[0]->des_notas;
        $peso= $busqueda[0]->pes_notas;
        $datos= array(
            'id'                =>$codigo,
            'nom_notas'         =>$nomb,
            'des_notas'         =>$desc,
            'pes_notas'         =>$peso
        );
        $this->htmlData['bodyData']->datos =   $datos;
        $this->load->view('vistasDialog/gestionEducativa/notas/editar', $this->htmlData);
    }
    public function editarGrados()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo1    = $this->input->post('txtcodigogrado');
        $nombre     = $this->input->post('txtgrado');
        $descri     = $this->input->post('txtdescr');
        $datos= array(
            "nom_grado"=> $nombre,
            "des_grado"=> $descri
        );
        $this->Usuarios_model->editarGradosa($datos, $codigo1);
    }
    public function editarSecciones()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $descri     = $this->input->post('txtdescr');
        $nombre     = $this->input->post('txtseccion');
        $codigo1     = $this->input->post('txtcodigoseccion');
        $datos= array(
            "nom_seccion"=> $nombre,
            "des_seccion"=> $descri
        );
        $this->Usuarios_model->editarSeccionesa($datos, $codigo1);
    }
    public function editarCursos()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $nombre      = $this->input->post('txtcursos');
        $descri      = $this->input->post('txtdescr');
        $codigo1     = $this->input->post('txtcodigo');
        $canthoras     = $this->input->post('canthoras');
        $cantcapacidades     = $this->input->post('cantcapacidades');
        $datos       = array(
                                "nom_cursos"=> $nombre,
                                "des_cursos"=> $descri,
                                "cant_horas"=> (int)$canthoras,
                                "cant_capacidades"=> (int)$cantcapacidades
                        );

        $this->Usuarios_model->editarCursosa($datos, $codigo1);
    }
    public function editarBimestres()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo1       = $this->input->post('txtcodigo');
        $nombre      = $this->input->post('txtbimestres');
        $desde       = $this->input->post('desdes');
        $hasta       = $this->input->post('hastas');
        $datos       = array(
                                "nom_bimestre"=> $nombre,
                                "fecini_bimestre"=> $desde,
                                "fecfin_bimestre"=>$hasta,
                                "usu_modificacion"=>$this->session->webCasSession->usuario->USUARIO,
                                "fec_modificacion"=> date('Y-m-d')

                        );
        $this->Usuarios_model->editarBimestresa($datos, $codigo1);
    }
    public function editarNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo1      = $this->input->post('txtcodigo');
        $nombre       = $this->input->post('txtnotas');
        $descri       = $this->input->post('txtdesn');
        $pesos        = $this->input->post('txtpes');
        $datos       = array(
                                "nom_notas"=> $nombre,
                                "des_notas"=> $descri,
                                "pes_notas"=>$pesos,
                                "usu_modificacion"=>$this->session->webCasSession->usuario->USUARIO,
                                "fec_modificacion"=> date('Y-m-d')

                        );

        $this->Usuarios_model->editarNotasa($datos, $codigo1);
    }
    public function eliminarGrado()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("ide");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $this->load->view('vistasDialog/gestionEducativa/grado/eliminar', $this->htmlData);
    }
    public function eliminarAula()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $seccion   = $this->input->post('seccion');
        $grado     = $this->input->post('grado');
        $curso     = $this->input->post('curso');
        $aula= array('seccion'=>$seccion,'grado'=>$grado,'curso'=>$curso);
        $this->htmlData['bodyData']->aula =   $aula;
        $this->load->view('vistasDialog/gestionEducativa/aula/eliminar', $this->htmlData);
    }
    public function eliminarSeccion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("ide");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $this->load->view('vistasDialog/gestionEducativa/seccion/eliminar', $this->htmlData);
    }
    public function eliminarCurso()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("ide");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $this->load->view('vistasDialog/gestionEducativa/curso/eliminar', $this->htmlData);
    }
    public function eliminarBimestre()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("ide");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $this->load->view('vistasDialog/gestionEducativa/bimestre/eliminar', $this->htmlData);
    }
    public function eliminarNota()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("ide");
        $this->htmlData['bodyData']->codigo =   $codigo;
        $this->load->view('vistasDialog/gestionEducativa/notas/eliminar', $this->htmlData);
    }
    public function eliminarGrados()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("ide");
        $codigo1=(int)$codigo;
        $this->Usuarios_model->eliminarGradosa($codigo1);
    }
    public function eliminarAulas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $seccion   = $this->input->post('seccion');
        $secciona=$this->Usuarios_model->busquedaSecc($seccion);
        $grado     = substr($this->input->post('grado'), 0, 1);
        $gradosas=$this->Usuarios_model->busquedaGrado($grado);
        $curso     = $this->input->post('curso');
        $cursosas=$this->Usuarios_model->busquedaCurs($curso);

        $cambio=array('estado'=>0,'usu_modificacion'=>$this->session->webCasSession->usuario->USUARIO,'fec_modificacion'=>date('Y-m-d H:i:s') );
        $aula= array('seccion'=>$secciona[0]->id,'grado'=>$gradosas[0]->id,'curso'=>$cursosas[0]->id);
        $this->Usuarios_model->eliminarAulasa($cambio, $aula);
    }
    public function eliminarSecciones()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo=$this->input->post("ides");
        $codigo1=(int)$codigo;
        $this->Usuarios_model->eliminarSeccionesa($codigo1);
    }
    public function eliminarCursos($codigo)
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo1=(int)$codigo;
        $this->Usuarios_model->eliminarCursosa($codigo1);
    }
    public function eliminarBimestres()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo1=(int)$this->input->post("ide");
        $this->Usuarios_model->eliminarBimestresa($codigo1);
    }
    public function eliminarNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $codigo1=(int)$this->input->post("ide");
        $this->Usuarios_model->eliminarNotasa($codigo1);
    }
    public function insertarGrado()
    {
        $nombre        = $this->input->post("txtgrado");
        $descri        = $this->input->post("txtdescr");
        $this->load->model("Usuarios_model", '', true);
        $insert= array(
                    'nom_grado'         => $nombre      ,
                    'des_grado'         => $descri      ,
                    'usu_creacion'      => $this->session->webCasSession->usuario->USUARIO,
                    'usu_modificacion'  => $this->session->webCasSession->usuario->USUARIO
                );
        $this->Usuarios_model->insertarGrados($insert);
    }
    public function insertarSeccion()
    {
        $nombre        = $this->input->post("txtseccion");
        $descri        = $this->input->post("txtdescrs");
        $this->load->model("Usuarios_model", '', true);
        $insert= array(
                    'nom_seccion'         => $nombre      ,
                    'des_seccion'         => $descri      ,
                    'ano'                 =>date('Y')    ,
                    'usu_creacion'        => $this->session->webCasSession->usuario->USUARIO,
                    'fec_creacion'        =>date('Y-m-d'),
                    'usu_modificacion'    => $this->session->webCasSession->usuario->USUARIO
                );
        $this->Usuarios_model->insertarSecciones($insert);
    }
    public function insertarCurso()
    {
        $nombre        = $this->input->post("txtcurso");
        $descri        = $this->input->post("txtdescr");
        $txtcanthoras        = $this->input->post("txtcanthoras");
        $txtcantcapacidades        = $this->input->post("txtcantcapacidades");
        $this->load->model("Usuarios_model", '', true);
        $insert= array(
                    'nom_cursos'         => $nombre      ,
                    'des_cursos'         => $descri      ,
                    'cant_horas'         => $txtcanthoras      ,
                    'cant_capacidades'   => $txtcantcapacidades      ,
                    'ano'                 =>date('Y')    ,
                    'usu_creacion'        => $this->session->webCasSession->usuario->USUARIO,
                    'fec_creacion'        =>date('Y-m-d'),
                    'usu_modificacion'    => $this->session->webCasSession->usuario->USUARIO
                );
        $this->Usuarios_model->insertarCursos($insert);
    }
    public function insertarBimestre()
    {
        $nombre        = $this->input->post("txtcurso");
        $fecini        = $this->input->post("desde");
        $fecfin        = $this->input->post("hasta");
        $this->load->model("Usuarios_model", '', true);
        $insert= array(
                    'nom_bimestre'    => $nombre      ,
                    'fecini_bimestre' => $fecini      ,
                    'ano'             => date('Y'),
                    'fecfin_bimestre' => $fecfin,
                    'usu_creacion'    => $this->session->webCasSession->usuario->USUARIO,
                    'fec_creacion'    =>  date('Y-m-d')
                );
        $this->Usuarios_model->insertarBimestre($insert);
    }
    public function insertarNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $valido        = $this->input->post("valido");
        if (isset($valido)==true) {
            $insert= array(
                    'nom_notas'       => "Promedio Final"      ,
                    'des_notas'       => "Promedio Final"      ,
                    'ano'             => date('Y')    ,
                    'pe'              => "on"           ,
                    'estado'          =>1,
                    'usu_creacion'    => $this->session->webCasSession->usuario->USUARIO,
                    'fec_creacion'    =>  date('Y-m-d')
                );
            $this->Usuarios_model->insertarNotas($insert);
        } else {
            $nombre        = $this->input->post("txtnotasn");
            $descri        = $this->input->post("txtdescrn");
            $pesos         = $this->input->post("txtPeso");
            $pe           =  $this->input->post("pe");
            $bimestre= $this->Usuarios_model->getBimestre();

            foreach ($bimestre as $bim) {
                $insert= array(
                    'id_bimestre'     =>$bim->id      ,
                    'nom_notas'       => $nombre      ,
                    'des_notas'       => $descri      ,
                    'ano'             => date('Y')    ,
                    'estado'          => 1,
                    'pes_notas'       => $pesos       ,
                    'pe'              =>$pe           ,
                    'usu_creacion'    => $this->session->webCasSession->usuario->USUARIO,
                    'fec_creacion'    =>  date('Y-m-d')
                );
                $this->Usuarios_model->insertarNotas($insert);
            }
        }
    }
    public function bandejaGrado()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $bandeja     = $this->Usuarios_model->getGrados();
        $this->load->library('encryption');
        $this->htmlData['bodyData']->grado =   $bandeja;
        $this->load->view('vistasDialog/gestionEducativa/grado/bandeja', $this->htmlData);
    }
    public function bandejaSeccion()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $bandeja     = $this->Usuarios_model->getSecciones();
        $this->load->library('encryption');
        $this->htmlData['bodyData']->grado =   $bandeja;
        $this->load->view('vistasDialog/gestionEducativa/seccion/bandeja', $this->htmlData);
    }
    public function bandejaCurso()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $bandeja     = $this->Usuarios_model->getCursos();
        $this->load->library('encryption');
        $this->htmlData['bodyData']->cursos =   $bandeja;
        $this->load->view('vistasDialog/gestionEducativa/curso/bandeja', $this->htmlData);
    }
    public function bandejaBimestre()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $bandeja     = $this->Usuarios_model->getBimestre();
        $this->load->library('encryption');
        $this->htmlData['bodyData']->bimestre =   $bandeja;
        $this->load->view('vistasDialog/gestionEducativa/bimestre/bandeja', $this->htmlData);
    }

    public function bandejaNotas()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');
        $bandeja     = $this->Usuarios_model->getNotas();
        $this->load->library('encryption');
        $this->htmlData['bodyData']->notas =   $bandeja;
        $this->load->view('vistasDialog/gestionEducativa/notas/bandeja', $this->htmlData);
    }


    //
    //FUNCIONES REGISTRAR HORARIO








    public function editarCliente($usuarioId=null)
    {
        if ($usuarioId==null or (int)$usuarioId == 0) {
            echo " <p>Datos No Encontrados</p>";
            return;
        }
        $this->load->model("Usuarios_model", '', true);
        $usuario = $this->Usuarios_model->getClienteLocal($usuarioId);
        $empresa = $this->Usuarios_model->getEmpresa($usuarioId);
        if (count($usuario)<1) {
            echo " <p>Datos No Encontrados</p>";
            return;
        }
        $usuario = $usuario[0];
        $this->load->library('encryption');
        //$usuario->pass = $this->encryption->decrypt( $usuario->pass );
        $this->htmlData['bodyData']->cuentas     = $this->Usuarios_model->getTipoLocal();
        $this->htmlData['bodyData']->usuario =   $usuario;
        $this->htmlData['bodyData']->empresa =   $empresa;
        //var_dump($this->htmlData['bodyData']->usuario);
        $this->load->view('bodys/GestionEducativa/grado/editarCliente', $this->htmlData);
    }


    public function registrarEmpresa($usuarioId=null)
    {
        if ($usuarioId==null or (int)$usuarioId == 0) {
            echo " <p>Datos No Encontrados</p>";
            return;
        }
        $this->load->model("Usuarios_model", '', true);
        $usuario = $this->Usuarios_model->getClienteLocal($usuarioId);

        if (count($usuario)<1) {
            echo " <p>Datos No Encontrados</p>";
            return;
        }
        $usuario = $usuario[0];
        $this->load->library('encryption');
        //$usuario->pass = $this->encryption->decrypt( $usuario->pass );
        $this->htmlData['bodyData']->cuentas     = $this->Usuarios_model->getTipoLocal();
        $this->htmlData['bodyData']->usuario =   $usuario;
        $this->htmlData['bodyData']->idusuario = $usuarioId;
        //var_dump($this->htmlData['bodyData']->usuario);
        $this->load->view('vistasDialog/permisos', $this->htmlData);
    }
    public function sistemas($usuarioId=null)
    {
        $usuarioId=$this->session->webCasSession->usuario->CODIGO;
        if ($usuarioId==null or (int)$usuarioId == 0) {
            echo " <p>Datos No Encontrados</p>";
            return;
        }
        $this->load->model("Usuarios_model", '', true);
        $usuario = $this->Usuarios_model->getClienteLocal($usuarioId);
        $empresa = $this->Usuarios_model->getEmpresa($usuarioId);
        if (count($usuario)<1) {
            echo " <p>Datos No Encontrados</p>";
            return;
        }
        $usuario = $usuario[0];
        $this->load->library('encryption');
        //$usuario->pass = $this->encryption->decrypt( $usuario->pass );
        $this->htmlData['bodyData']->cuentas     = $this->Usuarios_model->getTipoLocal();
        $this->htmlData['bodyData']->usuario =   $usuario;
        $this->htmlData['bodyData']->empresa =   $empresa;
        $this->htmlData['body']                          .= "/sistemas";
        $this->htmlData['headData']->titulo               = "GestionEducativa";

        if ($this->session->webCasSession->usuario->ROLES==1) {
            $this->load->view('plantillas_base/standar2/body', $this->htmlData);
        } else {
            $this->load->view('plantillas_base/standar/body', $this->htmlData);
        }
    }

    public function editPerfil()
    {
        //var_dump($this->input->post() );


        $this->load->model("Usuarios_model", '', true);
        $this->load->library('encryption');

        $datos = $this->input->post();
        if (!empty($datos['pass'])) {
            //  $datos['pass'] = $this->encryption->encrypt($datos['pass']);
        }

        $id = $this->input->post('id');
        if (!empty($id)) {
            $this->Usuarios_model->Update($datos, $id);
        }


        redirect('GestionEducativa/index');
        return;
    }

    public function registrarLocal()
    {
        $usuario           = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('usuario')));
        $rol               = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('rol'));
        $usuarioId         = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('usuarioid'));
        $nombre            = Utilitario::limpiarCaracteresEspeciales($this->input->post('nomLocal'));

        $direccion         = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('direccion')));
        $descripcion       = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('descripcion')));


        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $insert = array(
                    'webusuario_id'           => $usuarioId    ,
                    'nombreLocal'             => $nombre       ,
                    'tipolocal_id'            => $rol          ,
                    'direccion'               => $direccion    ,
                    'descripcion'             => $descripcion  ,
                    'usuarioCreacion'         =>$this->session->webCasSession->usuario->USUARIO
                );
        if (!$this->Usuarios_model->SetEmpresa($insert)) {
            $this->session->set_flashdata('flashdata_respuesta', 'Error de Registro. Verifique los Datos');
        }
    }
    public function consultaGeneral()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $nombre="";
        $arrayDatos = $this->Rol_model->busquedaDatosGeneral($nombre);


        $this->htmlData['bodyData']->datos                 =$arrayDatos;
        $this->htmlData['bodyData']->usuarios              = $this->Rol_model->getUsuario();
        $this->htmlData['headData']->titulo                = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionEducativa/consultaGeneral', $this->htmlData);
    }
    public function buscarUser()
    {

        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $usuario= $this->input->post('nombre');
        $boolean= $this->input->post('boolean');
        $codigo=$this->Usuarios_model->busquedaProfesor($usuario);
        if (isset($codigo)==true) {
            $usuario10=$codigo[0]->id;
            $datos=$this->Usuarios_model->busquedaDatos($usuario10);
            $alu= $usuario10;
            $alumnos=array('id_alumno'=>$alu);



            switch ($datos[0]->user) {
    case 2:

        $valores  = $this->Usuarios_model->busquedaGradoSeccion($alumnos) ;

        if (isset($datos[0]->ruta)==false) {
            $valor='publico/media/user.png';
        } else {
            $valor=$datos[0]->ruta;
        }
        $arrayDatos= array('nombre'=>$datos[0]->nombre,'apepat'=>$datos[0]->apepat,'apemat'=>$datos[0]->apemat,
                           'direcc'=>$datos[0]->direcc,'docume'=>$datos[0]->docume,'claves'=>$datos[0]->claves,
                           'usuari'=>$datos[0]->usuari,'correo'=>$datos[0]->correo,'telefo'=>$datos[0]->telefo,
                           'grados'=>"DIRECTOR",'fecha'=>$datos[0]->fecha,'ruta'=>$valor);
        $this->htmlData['bodyData']->results         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $usuario10 ;

        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('vistasDialog/gestionAuxiliar/bandeja/bandejaBusquedaDir', $this->htmlData);   break;
    case 3: $this->load->view('vistasDialog/gestionAuxiliar/bandeja/bandejaBusqueda', $this->htmlData);      break;
    case 4:
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
        $ano     =date('Y');

        $resultado=  $this->Usuarios_model->getBusquedaAulaProf($alumnos['id_alumno'], $ano);

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
        $this->htmlData['bodyData']->results1         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $usuario10 ;
         $this->load->view('vistasDialog/gestionAuxiliar/bandeja/bandejaBusquedaDoc', $this->htmlData);   break;
    case 5:
                $valores  = $this->Usuarios_model->busquedaGradoSeccion($alumnos) ;

        if (isset($datos[0]->ruta)==false) {
            $valor='publico/media/user.png';
        } else {
            $valor=$datos[0]->ruta;
        }
        $arrayDatos= array('nombre'=>$datos[0]->nombre,'apepat'=>$datos[0]->apepat,'apemat'=>$datos[0]->apemat,
                           'direcc'=>$datos[0]->direcc,'docume'=>$datos[0]->docume,'claves'=>$datos[0]->claves,
                           'usuari'=>$datos[0]->usuari,'correo'=>$datos[0]->correo,'telefo'=>$datos[0]->telefo,
                           'grados'=>"DIRECTOR",'fecha'=>$datos[0]->fecha,'ruta'=>$valor);
        $this->htmlData['bodyData']->results         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $usuario10 ;

        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('vistasDialog/gestionAuxiliar/bandeja/bandejaBusquedaDir', $this->htmlData);   break;


    default:
        redirect('/Login/gestionAlumnoDir/'.$codigo[0]->id, 'location', 301);

        break;
}
        } else {
            echo "<h3><strong style='color:red'>Informacion Ingresada: No valida<br> Por favor ingresar correctamente los datos de la Persona</strong></h3>";
            die();
        }
    }
    public function horario()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alu= $this->input->post('codigo');
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
        $data=array('id_alumno'=>$codigo,
                    'ano'=>$ano,
                   );


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

        $bimestre= $this->Usuarios_model->busquedaBimestre();
        $bimestre= array_column($bimestre,'nom_bimestre');

        $this->htmlData['bodyData']->bimestre                   = json_encode($bimestre) ;
        $this->htmlData['bodyData']->haber                   = $haber1 ;
        $this->htmlData['bodyData']->ano                     = $ano ;


        $this->htmlData['bodyData']->resultadoTot            = $arrayConocerTot ;
        $this->load->view('vistasDialog/gestionEducativa/notaGeneral/reporteNotas', $this->htmlData);
    }
    public function puestos()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alu= $this->input->post('codigo');
        $ano     = $this->Usuarios_model->busquedaAno($alu);
        if ($ano[0]->ano==date('Y')) {
            $valores  = $this->Usuarios_model->busquedaGradoSeccion2($alu, $ano[0]->ano) ;
        }
        $puesto_grado=$this->Usuarios_model->puestoGrado($valores['id_grado']);
        $indice_alumno_grado=array_search($alu,array_column($puesto_grado,'id_alumno'));
            // EXTRAIGO EL PUESTO Y LA NOTA DEL GRADO
        $arraygrado=array('puesto'=>$indice_alumno_grado+1,'nota'=>$puesto_grado[$indice_alumno_grado]['nota']);

        $puesto_salon=$this->Usuarios_model->puestoSalon($valores['id_grado'], $valores['id_seccion']);
        $indice_alumno_salon=array_search($alu,array_column($puesto_salon,'id_alumno'));
            // ESTRAIGO EL PUESTO Y LA NOTA DEL SALON
        $arraysalon=array('puesto'=>$indice_alumno_salon+1,'nota'=>$puesto_salon[$indice_alumno_salon]['nota']);


        $puesto_colegio=$this->Usuarios_model->puestoColegio();
        $indice_alumno_colegio=array_search($alu,array_column($puesto_colegio,'id_alumno'));
            // EXTRAIGO EL PUESTO Y LA NOTA DEL COLEGIO
        $arraycolegio=array('puesto'=>$indice_alumno_colegio+1,'nota'=>$puesto_colegio[$indice_alumno_colegio]['nota']);

        $totales= array('salon'=>$puesto_salon[$indice_alumno_salon]['cantidad'],'grado'=>$puesto_grado[$indice_alumno_grado]['cantidad'],'colegio'=>$puesto_colegio[$indice_alumno_colegio]['cantidad']);
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
        $alu= $this->input->post('codigo');
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

    public function notasProfesor()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->htmlData['body']                           .= "/notasProfesor";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function consultaGeneralDir()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $nombre= $this->input->post("nombre");
        $boolean= $this->input->post("boolean");
        $arrayDatos = $this->Rol_model->busquedaDatosGeneral($nombre);

            $boolean="false";


        if(empty($arrayDatos)){
            echo "No se encontraron datos."; die();
        }


        $this->htmlData['bodyData']->boolean                 =$boolean;
        $this->htmlData['bodyData']->datos                 =$arrayDatos;
        $this->htmlData['headData']->titulo                = "GESTION :: INTRANET";
        $this->load->view('vistasDialog/gestionEducativa/bandejaConsulta/index', $this->htmlData);
    }
    public function notasGeneral()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $ano= $this->Usuarios_model->getGradosAno();

        if (count($ano)!=0) {
            $this->htmlData['bodyData']->anos=$ano[0]->ano;
            $this->htmlData['bodyData']->ano=$ano;
            $this->htmlData['bodyData']->resultado=0;
        } else {
            $this->htmlData['bodyData']->resultado=1;
        }
        $this->htmlData['body']                           .= "/notasGeneral";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function comboAnoDir()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $ano=$this->input->post("ano");

        $anos=implode(',', explode(',', $ano));

        $busquedaSecc= $this->Usuarios_model->buscargradosAno($anos);

        $html="<option value='' selected>Marcar</option>";
        foreach ($busquedaSecc as $bus) {
            $html.='<option value='.$bus["id"].'>'.$bus["nom_grado"].'</option>';
        }
        echo $html;
    }
    public function comboGradoDir()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $ano=$this->input->post("ano");
        $busquedaSecc= $this->Usuarios_model->buscarBimestres($ano);

        $html="<option value='' selected>Seleccione</option>";
        foreach ($busquedaSecc as $bus) {
            $html.="<option value='$bus->id'>$bus->nom_bimestre</option>";
        }
        $html.="<option value='total' >TOTAL</option>";
        echo $html;
    }
    public function comboBandeGen()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $ano=$this->input->post("ano");
        $grado=$this->input->post("grado");
        $bimestre=$this->input->post("bimestre");
        $grados=$this->Usuarios_model->buscarGrados($grado);
        $seccion=$this->Usuarios_model->busquedaSeccion($grado);
        $arraySeccion=array_column($seccion, 'id_seccion');
        $sec=implode(',', $arraySeccion);
        $nomsec=$this->Usuarios_model->buscarSecciones($sec);
        $texto='';
        foreach ($nomsec as $nom) {
            $texto.="'".$grados[0]->nom_grado.'°'.$nom->nom_seccion."',";
        }
        $j=0;
        $haber="";
        if ($bimestre!="total") {
            $reporte=$this->Usuarios_model->comparacionGrado($ano, $grado, $bimestre);
            $reporte2=$this->Usuarios_model->comparacionGradoCurso($ano, $grado, $bimestre);

            $i=0;
            foreach ($reporte as $mostrar) {
                $i=0;
                foreach ($reporte as $mostrar2) {
                    if ($mostrar->id_curso==$mostrar2->id_curso) {
                        $arrayCurso[$mostrar->curso][$i]=$mostrar2->nota;
                        $i++;
                    }
                }
            }
        } else {
            $reporte=$this->Usuarios_model->comparacionGrados($ano, $grado);
            $reporte2=$this->Usuarios_model->comparacionGradoCursos($ano, $grado);

            $i=0;
            foreach ($reporte as $mostrar) {
                $i=0;
                foreach ($reporte as $mostrar2) {
                    if ($mostrar->id_curso==$mostrar2->id_curso) {
                        $arrayCurso[$mostrar->curso][$i]=round($mostrar2->nota/($mostrar2->cantidad), 2);
                        $i++;
                    }
                }
            }
        }

        foreach ($reporte2 as $mostrar) {
            $data[$j]=implode(',', $arrayCurso[$mostrar->curso]);
            $haber.="{
                       name: '".$mostrar->curso."',
                       data: [".$data[$j]."]
                             },";
            $j++;
        }
        $haber1=  substr($haber, 0, -1);

        $this->htmlData['bodyData']->ano        = $ano;
        $this->htmlData['bodyData']->arrayNombre        = $haber1;
        $this->htmlData['bodyData']->arrayGrado         = substr($texto, 0, -1);
        $this->htmlData['headData']->titulo             = "GestionEducativa";
        $this->load->view('vistasDialog/gestionEducativa/notaGeneral/bandejaGeneral', $this->htmlData);
    }
    public function usuarioGeneral()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
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
                           'grados'=>"DIRECTOR",'fecha'=>$datos[0]->fecha,'ruta'=>$valor);
        $this->htmlData['bodyData']->results         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $alumno ;
        $this->htmlData['body']                           .= "/usuarioGeneral";
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function editarInfo()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alumno=$this->session->webCasSession->usuario->CODIGO;
        $fecha  =$this->input->post('fecha');
        $telef  =$this->input->post('telefono');
        $docum  =ltrim($this->input->post('documento'));
        $direc  =ltrim($this->input->post('direccion'));
        $email  =$this->input->post('email');
        $clave  =$this->input->post('clave');
        $data=array('clav_usuario'=>$clave);
        $dato=array('direccion'=>$direc,'documento'=>$docum,'fecha_nac'=>$fecha);
        $datoC=array('des_correo'=>$email,'usu_modificacion'=>$alumno,'fec_modificacion'=>date('Y-m-d H:m:s'));
        $datoT=array('num_tel'=>$telef,'usu_modificacion'=>$alumno,'fec_modificacion'=>date('Y-m-d H:m:s'));


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
}
