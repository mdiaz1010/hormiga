<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuenta extends CI_Controller
{
    public $htmlData = array();

    public function __construct()
    {
        parent::__construct();

        $this->htmlData = array(

            "body"=> get_class($this)
            ,"bodyData"=> (object) array()
            ,"headData"=> (object) array()
            ,"footerData"=> (object) array()
        );
    }

    public function index()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->htmlData['bodyData']->cuentas     = $this->Usuarios_model->getList(null, $this->session->webCasSession->usuario->ROLES  + 1);
        $this->htmlData['bodyData']->roles       = $this->Rol_model->getList(null, $this->session->webCasSession->usuario->ROLES  + 1);
        $this->htmlData['bodyData']->rolesSeccion       = $this->Rol_model->getSeccion();
        $this->htmlData['bodyData']->rolesGrado         = $this->Rol_model->getGrados();
        $this->htmlData['body'] .= "/index";
        $this->htmlData['headData']->titulo      = "CUENTAS :: INTRANET";
        $this->load->view('plantillas_base/standar/body', $this->htmlData);
    }

    public function vistabandeja()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $this->htmlData['bodyData']->cuentas     = $this->Usuarios_model->getList();
        $this->htmlData['headData']->titulo      = "CUENTAS::INTRANET";
        $this->load->view('vistasDialog/cuenta/bandeja', $this->htmlData);
    }
    public function crear()
    {
        $nombre           = Utilitario::limpiarCaracteresEspeciales($this->input->post('nombre'))            ;
        $apepat           = Utilitario::limpiarCaracteresEspeciales($this->input->post('apepat'))            ;
        $apemat           = Utilitario::limpiarCaracteresEspeciales($this->input->post('apemat'))            ;
        $rol              = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('rol'))          ;
        $usuario          = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('usuario')))     ;
        $pass             = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('pass')))        ;
        $email            = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('email')))       ;
        $documento        = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('documento')))   ;
        $direccion        = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('direccion')))   ;
        $descripcion      = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('descripcion'))) ;
        $telefono         = Utilitario::limpiarCaracteresEspeciales(trim($this->input->post('telefono')))    ;
        $seccion               = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('seccionrol'))        ;
        $grado                 = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('gradorol'))          ;
        //echo $rol;die();
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true)     ;
        $ultimoIdNota= $this->Usuarios_model->ultimoIdNotas();

        $insertPersona = array(
                    'nom_per'             => $nombre                                        ,
                    'ape_pat_per'         => $apepat                                        ,
                    'ape_mat_per'         => $apemat                                        ,
                    'estado'              => 1                                              ,
                    'direccion'           => $direccion                                     ,
                    'descripcion'         => $descripcion                                   ,
                    'documento'           => $documento                                     ,
                    'usu_creacion'        => $this->session->webCasSession->usuario->USUARIO
                );

        $busquedapermisos=$this->Rol_model->getbusqueda($rol);
        $i=0;

        //print_r($arraypermisos);die();
        if (!$this->Usuarios_model->insertarPersona($insertPersona)) {
            $recuperaId= $this->Usuarios_model->recuperPersona();
            $ultimoId=$recuperaId[0]->id;
            //echo $ultimoId; die();

            $insertCorreoss = array(
                    'id_persona'             => $ultimoId                                         ,
                    'des_correo'             => $email                                            ,
                    'usu_creacion'           => $this->session->webCasSession->usuario->USUARIO

                );
            $insertTelefono = array(
                    'id_persona'             => $ultimoId                                         ,
                    'num_tel'                => $telefono                                         ,
                    'usu_creacion'           => $this->session->webCasSession->usuario->USUARIO
                );
            $insertUsuarios = array(
                    'id_persona'             => $ultimoId                                          ,
                    'nom_usuario'            => $usuario                                           ,
                    'clav_usuario'           => $pass                                              ,
                    'role_usuario'           => $rol                                               ,
                    'usu_creacion'           => $this->session->webCasSession->usuario->USUARIO
                );
            foreach ($busquedapermisos as $busqueda) {
                $arraypermisos[$i]=$busqueda->id;
                $this->Rol_model->setPermiso($ultimoId, $arraypermisos[$i]);
                $i++;
            }

            if ((int)$seccion>0 && (int)$grado>0) {
                $insertAlumno= array('id_alumno'=>$ultimoId,'id_seccion'=>$seccion,'id_grado'=>$grado,'ano'=>date("Y"),'usu_creacion'=> $this->session->webCasSession->usuario->USUARIO);
                $cursos=$this->Usuarios_model->busquedaCurso($insertAlumno);
                $bimestre=$this->Usuarios_model->busquedaBimestre();

                $b=0;
                $n=0;



                $this->Usuarios_model->insertarAlumno($insertAlumno);
                //print_r($insertAlumno);die();
            }
            $this->Usuarios_model->insertarTelefono($insertTelefono);
            $this->Usuarios_model->insertarCorreoss($insertCorreoss);
            $this->Usuarios_model->insertarUsuarios($insertUsuarios);

            $this->session->set_flashdata('flashdata_respuesta', 'Registro Correcto');
        }
    }

    public function import_data()
    {
        @set_time_limit(0);
        @mysql_query("SET NAMES 'utf8'");
        $this->load->model('Usuarios_model', '', true);
        $this->load->model('Rol_model', '', true);
        $this->load->library('Spreadsheet_Excel_Reader');
        $recuperaId= $this->Usuarios_model->recuperPersona();
        $ultimoId=$recuperaId[0]->id;

        foreach ($_FILES['images']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $name = $_FILES['images']['name'][$key];
                $namegeneric = $name;
                $ruta = "temp/masivo/".$namegeneric;
                if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $ruta)) {
                    $archivo= array(
                    'upload_path'          =>base_url().$ruta,
                    'allowed_types'        =>'xls',
                        );
                } else {
                    $errors= error_get_last();
                    echo "COPY ERROR: ".$errors['type'];
                    echo "<br />\n".$errors['message']."<br />\n";
                }
            }
        }

        $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');


        $this->spreadsheet_excel_reader->read("C:\Users\Marco\Desktop\profesores.xls");

        $sheets= $this->spreadsheet_excel_reader->sheets[0];

        //error_reporting(0);

        $data_excel= array();
        $data_usuar= array();
        $data_corre= array();
        $data_telef= array();
        $j=0;
        for ($i = 2; $i <= $sheets['numRows']; $i++) {
            if ($sheets['cells'][$i][1]=='') {
                break;
            }
            $ultimoId++;
            $data_excel[$i-1]['id']=$ultimoId;
            $data_excel[$i-1]['ape_pat_per']=utf8_encode($sheets['cells'][$i][2]);
            $data_excel[$i-1]['estado']=1;
            $data_excel[$i-1]['usu_creacion']="administrador";
            $data_excel[$i-1]['fec_creacion']=date("Y-m-d");

            $data_usuar[$i-1]['id_persona']=$ultimoId;
            $data_usuar[$i-1]['nom_usuario']=$sheets['cells'][$i][4];
            $data_usuar[$i-1]['clav_usuario']=$sheets['cells'][$i][5];
            $data_usuar[$i-1]['role_usuario']=$sheets['cells'][$i][6];
            $data_usuar[$i-1]['usu_creacion']="administrador";
            $data_usuar[$i-1]['fec_creacion']=date("Y-m-d");

            $data_corre[$i-1]['id_persona']=$ultimoId;
            $data_corre[$i-1]['usu_creacion']="administrador";
            $data_corre[$i-1]['fec_creacion']=date("Y-m-d");

            $data_telef[$i-1]['id_persona']=$ultimoId;
            $data_telef[$i-1]['usu_creacion']="administrador";
            $data_telef[$i-1]['fec_creacion']=date("Y-m-d");
            $busquedapermisos=$this->Rol_model->getbusqueda($sheets['cells'][$i][6]);
            foreach ($busquedapermisos as $busqueda) {
                $this->Rol_model->setPermiso($ultimoId, $busqueda->id);
                $j++;
            }
        }
        $this->db->insert_batch('maepersona', $data_excel);
        $this->db->insert_batch('maeusuarios', $data_usuar);
        $this->db->insert_batch('maecorreos', $data_corre);
        $this->db->insert_batch('maetelefono', $data_telef);
    }

    public function import_data_alumnos()
    {
        @set_time_limit(0);
        @mysql_query("SET NAMES 'utf8'");
        $this->load->model('Usuarios_model', '', true);
        $this->load->model('Rol_model', '', true);
        $this->load->library('Spreadsheet_Excel_Reader');
        $recuperaId= $this->Usuarios_model->recuperPersona();
        $ultimoId=$recuperaId[0]->id;
        $ultimoIdNota= $this->Usuarios_model->ultimoIdNotas();

        $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');
        $this->spreadsheet_excel_reader->read("C:\Users\Marco\Desktop\informe_total.xls");
        $sheets= $this->spreadsheet_excel_reader->sheets[0];

        $data_excel= array();
        $data_usuar= array();
        $data_corre= array();
        $data_telef= array();

        for ($i = 1; $i <= $sheets['numRows']; $i++) {
            if ($sheets['cells'][$i][1]=='') {
                break;
            }
            $ultimoId++;
            $data_excel = array('id'=>$ultimoId,
                                          'codigoAlumno'    =>$sheets['cells'][$i][4],
                                          'ape_pat_per'     =>  utf8_encode($sheets['cells'][$i][2]),
                                          'estado'          =>1,
                                          'genero'          =>$sheets['cells'][$i][3],
                                          'documento'       =>$sheets['cells'][$i][1],
                                          'usu_creacion'    =>"administrador",
                                          'fec_creacion'    =>date("Y-m-d"));
            $data_usuar= array('id_persona'  =>$ultimoId,
                                        'nom_usuario' =>$sheets['cells'][$i][1],
                                        'clav_usuario'=>$sheets['cells'][$i][1],
                                        'role_usuario'=>$sheets['cells'][$i][5],
                                        'usu_creacion'=>"administrador",
                                        'fec_creacion'=>date("Y-m-d"));
            $data_corre= array('id_persona'  =>$ultimoId,
                                        'usu_creacion'=>"administrador",
                                        'fec_creacion'=>date("Y-m-d"));
            $data_telef= array('id_persona'  =>$ultimoId,
                                        'usu_creacion'=>"administrador",
                                        'fec_creacion'=>date("Y-m-d"));
            $this->Usuarios_model->insertarPersona($data_excel);
            $this->Usuarios_model->insertarUsuarios($data_usuar);
            $this->Usuarios_model->insertarCorreoss($data_corre);
            $this->Usuarios_model->insertarTelefono($data_corre);

            $busquedapermisos=$this->Rol_model->getbusqueda($sheets['cells'][$i][5]);
            $insertAlumno= array('id_alumno'=>$ultimoId,'id_seccion'=>$sheets['cells'][$i][7],'id_grado'=>$sheets['cells'][$i][6],'ano'=>date("Y"),'usu_creacion'=>'administrador');
            $cursos=$this->Usuarios_model->busquedaCurso($insertAlumno);
            $bimestre=$this->Usuarios_model->busquedaBimestre();
            $b=0;
            $n=0;

            $this->Usuarios_model->insertarAlumno($insertAlumno);
            foreach ($busquedapermisos as $busqueda) {
                $this->Rol_model->setPermiso($ultimoId, $busqueda->id);
            }
        }
    }

    public function permisos()
    {
        $id = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('id'));
        if (empty($id)) {
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.1');
            return;
        }
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $usuario = $this->Usuarios_model->getList($id);
        if (count($usuario)<1) {
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.1');
            return;
        }
        $usuario = $usuario[0];
        $modulos = $this->Rol_model->getPermisosDisponible($id);

        $this->htmlData['bodyData']->usuario =  $usuario;
        $this->htmlData['bodyData']->usuarioId = $id;
        $this->htmlData['bodyData']->permisos  = $this->Rol_model->getPermisosList($id);
        $this->htmlData['bodyData']->modulos   = $modulos;
        $this->load->view('bodys/Cuenta/permisos', $this->htmlData);
    }
    /*
     *  asignar nuevo permiso de usuario  a un modulo
     */
    public function vereditarcuenta()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo=$this->input->post("codigo");
        $this->htmlData['bodyData']->datoscuenta =$this->Usuarios_model->buscardatosusu($codigo);
        $this->htmlData['bodyData']->roles       = $this->Rol_model->getList(null, $this->session->webCasSession->usuario->ROLES  + 1);
        $this->load->view('vistasDialog/cuenta/editar/vereditarcuenta', $this->htmlData);
    }
    public function editarcuenta()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtid'));
        $apepat = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtapepatcuenta'));

        $usuari = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtusuaricuenta'));
        $claves = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtclavescuenta'));
        $telefo = Utilitario::limpiarCaracteresEspeciales($this->input->post('txttelefocuenta'));
        $docume = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtdocumecuenta'));
        $correo = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtemailscuenta'));
        $direcc = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtdirecccuenta'));
        $descri = Utilitario::limpiarCaracteresEspeciales($this->input->post('txtdescricuenta'));


        $datospersona= array(
          'ape_pat_per'     =>$apepat,
          'direccion'       =>$direcc,
          'descripcion'     =>$descri,
          'documento'       =>$docume,
          'usu_modificacion'=>$this->session->webCasSession->usuario->USUARIO
        );


        //    print_r($datospersona);die();
        $datoscorreos= array(
            'des_correo'        =>$correo,
            'usu_modificacion'  =>$this->session->webCasSession->usuario->USUARIO
        );
        $datosusuario= array(
            'nom_usuario'       =>$usuari,
            'clav_usuario'      =>$claves,
            'usu_modificacion'  =>$this->session->webCasSession->usuario->USUARIO
        );
        $datostelefon= array(
            'num_tel'           =>$telefo,
            'usu_modificacion'  =>$this->session->webCasSession->usuario->USUARIO
        );

        $this->Usuarios_model->editarpersona($datospersona, $codigo);
        $this->Usuarios_model->editarcorreos($datoscorreos, $codigo);
        $this->Usuarios_model->editarusuario($datosusuario, $codigo);
        $this->Usuarios_model->editartelefon($datostelefon, $codigo);
    }
    public function permisosAsignar()
    {
        $usuarioId = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('usuarioId'));
        $moduloId  = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('moduloId'));

        if (empty($usuarioId) or empty($moduloId)) {
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.1');
            echo '0';
            return;
        }

        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);

        $verificadorPermiso = $this->Rol_model->getPermisosList($usuarioId);
        //    $verificadorUsuario = $this->Usuarios_model->getList($usuarioId);


        //var_dump($verificadorUsuario,$verificadorPermiso); // return;
        $datospermisos= array(
          'permiso'         =>"1"
        );

        if ($this->Rol_model->setPermiso1($usuarioId, $moduloId, $datospermisos)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function permisosEliminar()
    {
        $usuarioId = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('usuarioId'));
        $moduloId  = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('moduloId'));

        if (empty($usuarioId) or empty($moduloId)) {
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.1');
            echo '0';
            return;
        }
        $this->load->model("Rol_model", '', true);
        $datospermisos= array(
          'permiso'         =>0
        );
        $result = $this->Rol_model->deletePermiso($usuarioId, $moduloId, $datospermisos);
        if ($result) {
            // var_dump($result,$usuarioId,$moduloId);
            echo '1';
        } else {
            echo '0';
        }
    }


    public function ubicaciones()
    {
        $id = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('id'));
        if (empty($id)) {
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.1');
            return;
        }

        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Ubicaciones_model", '', true);

        $usuario = $this->Usuarios_model->getList($id);
        if (count($usuario)<1) {
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.2');
            return;
        }
        $usuario = $usuario[0];

        $this->htmlData['bodyData']->usuario     = $usuario;
        $this->htmlData['bodyData']->RestriccionUbicaciones =   $this->Ubicaciones_model->getRestriccionUbicaciones($usuario->id);
        $this->htmlData['bodyData']->locations   =              $this->Ubicaciones_model->GetLocationsList();
        $this->htmlData['bodyData']->divisions   =              $this->Ubicaciones_model->GetDivisionList();
        $this->htmlData['bodyData']->departments =              $this->Ubicaciones_model->GetDepartamentList();
        $this->htmlData['bodyData']->centroCosto =              $this->Ubicaciones_model->GetCentroCostoList();
        $this->load->view('bodys/Cuenta/ubicaciones', $this->htmlData);

        //    var_dump($this->htmlData);
    }

    public function ubicacionesToggle()
    {
        $usuarioId      = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('usuarioId'));
        $ubicacionType  = (int)Utilitario::limpiarCaracteresEspeciales($this->input->post('ubicacionType'));
        $ubicacionId    = (string)Utilitario::limpiarCaracteresEspeciales($this->input->post('ubicacionId'));

        if ((empty($usuarioId) or strlen($usuarioId)<1) or(empty($ubicacionType) or strlen($ubicacionType)<1) or(empty($ubicacionId) and strlen($ubicacionId)<1)) {//$ubicacionId es AND porq el id puede ser 0
            $this->session->set_flashdata('flashdata_respuesta', 'Datos Invalidos, Intente Nuevamente.1');
            return;
        }

        $this->load->model("Ubicaciones_model", '', true);
        $var = $this->Ubicaciones_model->getRestriccionUbicaciones($usuarioId, $ubicacionType, $ubicacionId);

        //var_dump($var);exit();

        $retorno = array();
        $datos = array(
                    'WebUsuario_id'=>$usuarioId,
                    'area' =>$ubicacionType,
                    'areaId' =>$ubicacionId
                );
        if (count($var)>0) {
            $retorno['bool'] = $this->Ubicaciones_model->deleteRestriccionUbicaciones($datos);
            $retorno['operacion'] = 'delete';
        } else {
            $retorno['bool'] = $this->Ubicaciones_model->setRestriccionUbicaciones($datos);
            $retorno['operacion'] = 'create';
        }
        echo json_encode($retorno);
    }
}
