<?php
defined('BASEPATH') or exit('No direct script access allowed');
class GestionPadre extends CI_Controller
{
    private $login;
    public $htmlData = array();
    public function __construct()
    {
        parent::__construct();
        $this->htmlData = array(
            "body"=> get_class($this)
            ,"bodyData"=> (object) array()
            ,"headData"=> (object) array("titulo"=>"Gestion Padre")
            ,"footerData"=> (object) array()
        );
        SessionSeguridad::tiempo_maximo($this->session->webCasSession);
    }
    public function index()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Padre_model", '', true);
        $cod_apoderado=$this->session->webCasSession->usuario->DOCUMENTO;
        $list_hijos = $this->Padre_model->consultar_hijos($cod_apoderado);
        $this->htmlData['bodyData']->list_hijos     = $list_hijos ;
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";
        $this->load->view('bodys/Login/gestionPadre', $this->htmlData);

    }
    public function bandeja()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";
        $this->load->view('bodys/GestionPadre/bandeja/index', $this->htmlData);
    }
    public function buscarUser()
    {
        $codigo = $this->input->post('user');
        redirect('/Login/gestionAlumnoDir/'.$codigo, 'location', 301);
    }
    public function consultarDatosPadre()
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
        $this->htmlData['headData']->titulo               = "EDUMPRO - SISTEMA EDUCATIVO";
        $this->load->view('bodys/GestionPadre/miUsuario', $this->htmlData);

    }
}

?>