<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel extends CI_Controller
{
    public $htmlData = array();

    public function __construct()
    {
        parent::__construct();
        $this->htmlData = array(
            "body"=> get_class($this)
            ,"bodyData"=> (object) array()
            ,
        );
    }

    public function index()
    {
        $fecha = '';
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $this->htmlData['bodyData']->estadisticasPaeArray =  $this->Usuarios_model->getClientes();
        $fecha = (empty($this->htmlData['bodyData']->estadisticasPaeArray[0]->fec_modificacion))? date('Ymd') : $this->htmlData['bodyData']->estadisticasPaeArray[0]->fec_modificacion;

        $this->htmlData['bodyData']->usuariosTotales = $this->Usuarios_model->getClientes();
        $this->htmlData['bodyData']->lastEvents =  $this->Usuarios_model->getClientes();

        $dotacionPresente =  $this->Usuarios_model->getClientes();
        $dotacionPresenteUltimaMarca = array(); // solo para identificar si la ultima marca fue entrada o salida
        $dotacionPresenteContador = 0; // cuenta solo las ultimas marcas q fueron entradas
        foreach ($dotacionPresente  as $dotacionPresenteTemp) {
            if (!isset($dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ])) {
                $bool = ($dotacionPresenteTemp->role_usuario = 2)? true :false;
                $dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ] = $bool;

                $dotacionPresenteContador = ($bool)? $dotacionPresenteContador +1: $dotacionPresenteContador ;
            }
        }
        $this->htmlData['bodyData']->dotacionPresente = $dotacionPresenteContador;

        //var_dump($dotacionPresenteUltimaMarca);exit();
        $this->load->view('vistasSueltas/modulosOpciones', $this->htmlData);
        //$this->load->view('plantillas_base/standar/body',$this->htmlData);
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

    public function vistaDirector()
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
    public function admin()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->htmlData['body'] .= "/administrador";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }

    public function vistaProfesor()
    {
        $fecha = '';
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $this->htmlData['bodyData']->estadisticasPaeArray =  $this->Usuarios_model->getClientes();
        $fecha = (empty($this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha))? date('Ymd') : $this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha;

        $this->htmlData['bodyData']->usuariosTotales = $this->Usuarios_model->getClientes();
        $this->htmlData['bodyData']->lastEvents =  $this->Usuarios_model->getClientes();

        $dotacionPresente =  $this->Usuarios_model->getClientes();
        $dotacionPresenteUltimaMarca = array(); // solo para identificar si la ultima marca fue entrada o salida
        $dotacionPresenteContador = 0; // cuenta solo las ultimas marcas q fueron entradas
        foreach ($dotacionPresente  as $dotacionPresenteTemp) {
            if (!isset($dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ])) {
                $bool = ($dotacionPresenteTemp->WebUsuarios_parentId = '10')? true :false;
                $dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ] = $bool;

                $dotacionPresenteContador = ($bool)? $dotacionPresenteContador +1: $dotacionPresenteContador ;
            }
        }
        $this->htmlData['bodyData']->dotacionPresente = $dotacionPresenteContador;
        $this->htmlData['body'] .= "/vistaProfesor";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }


    public function vistaSubDirector()
    {
        $fecha = '';
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $this->htmlData['bodyData']->estadisticasPaeArray =  $this->Usuarios_model->getClientes();
        $fecha = (empty($this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha))? date('Ymd') : $this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha;

        $this->htmlData['bodyData']->usuariosTotales = $this->Usuarios_model->getClientes();
        $this->htmlData['bodyData']->lastEvents =  $this->Usuarios_model->getClientes();

        $dotacionPresente =  $this->Usuarios_model->getClientes();
        $dotacionPresenteUltimaMarca = array(); // solo para identificar si la ultima marca fue entrada o salida
        $dotacionPresenteContador = 0; // cuenta solo las ultimas marcas q fueron entradas
        foreach ($dotacionPresente  as $dotacionPresenteTemp) {
            if (!isset($dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ])) {
                $bool = ($dotacionPresenteTemp->WebUsuarios_parentId = '10')? true :false;
                $dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ] = $bool;

                $dotacionPresenteContador = ($bool)? $dotacionPresenteContador +1: $dotacionPresenteContador ;
            }
        }
        $this->htmlData['bodyData']->dotacionPresente = $dotacionPresenteContador;
        $this->htmlData['body'] .= "/vistaSubDirector";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }


    public function vistaAuxiliar()
    {
        $fecha = '';
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $this->htmlData['bodyData']->estadisticasPaeArray =  $this->Usuarios_model->getClientes();
        $fecha = (empty($this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha))? date('Ymd') : $this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha;

        $this->htmlData['bodyData']->usuariosTotales = $this->Usuarios_model->getClientes();
        $this->htmlData['bodyData']->lastEvents =  $this->Usuarios_model->getClientes();

        $dotacionPresente =  $this->Usuarios_model->getClientes();
        $dotacionPresenteUltimaMarca = array(); // solo para identificar si la ultima marca fue entrada o salida
        $dotacionPresenteContador = 0; // cuenta solo las ultimas marcas q fueron entradas
        foreach ($dotacionPresente  as $dotacionPresenteTemp) {
            if (!isset($dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ])) {
                $bool = ($dotacionPresenteTemp->WebUsuarios_parentId = '10')? true :false;
                $dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ] = $bool;

                $dotacionPresenteContador = ($bool)? $dotacionPresenteContador +1: $dotacionPresenteContador ;
            }
        }
        $this->htmlData['bodyData']->dotacionPresente = $dotacionPresenteContador;
        $this->htmlData['body'] .= "/vistaAuxiliar";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
    public function vistaAlumno()
    {
        $fecha = '';
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $this->htmlData['bodyData']->estadisticasPaeArray =  $this->Usuarios_model->getClientes();
        $fecha = (empty($this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha))? date('Ymd') : $this->htmlData['bodyData']->estadisticasPaeArray[0]->fecha;

        $this->htmlData['bodyData']->usuariosTotales = $this->Usuarios_model->getClientes();
        $this->htmlData['bodyData']->lastEvents =  $this->Usuarios_model->getClientes();

        $dotacionPresente =  $this->Usuarios_model->getClientes();
        $dotacionPresenteUltimaMarca = array(); // solo para identificar si la ultima marca fue entrada o salida
        $dotacionPresenteContador = 0; // cuenta solo las ultimas marcas q fueron entradas
        foreach ($dotacionPresente  as $dotacionPresenteTemp) {
            if (!isset($dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ])) {
                $bool = ($dotacionPresenteTemp->WebUsuarios_parentId = '10')? true :false;
                $dotacionPresenteUltimaMarca[$dotacionPresenteTemp->id_persona ] = $bool;

                $dotacionPresenteContador = ($bool)? $dotacionPresenteContador +1: $dotacionPresenteContador ;
            }
        }
        $this->htmlData['bodyData']->dotacionPresente = $dotacionPresenteContador;
        $this->htmlData['body'] .= "/vistaAlumno";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }
}
