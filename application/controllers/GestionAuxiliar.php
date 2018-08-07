<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GestionAuxiliar extends CI_Controller
{
    public $htmlData = array();
    public function __construct()
    {
        parent::__construct();
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
        $this->htmlData['headData']->titulo                  = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionAuxiliar/index', $this->htmlData);
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
    public function consultarDatos()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//
        $alumno=$this->session->webCasSession->usuario->CODIGO;
        $datos=$this->Usuarios_model->busquedaDatos($alumno);
        if (isset($datos[0]->ruta)==false) {
            $valor='publico/media/user.png';
        } else {
            $valor=$datos[0]->ruta;
        }
        $arrayDatos= array('nombre'=>$datos[0]->nombre,'apepat'=>$datos[0]->apepat,'apemat'=>$datos[0]->apemat,
                           'direcc'=>$datos[0]->direcc,'docume'=>$datos[0]->docume,'claves'=>$datos[0]->claves,
                           'usuari'=>$datos[0]->usuari,'correo'=>$datos[0]->correo,'telefo'=>$datos[0]->telefo,
                           'fecha'=>$datos[0]->fecha,'ruta'=>$valor);
        $this->htmlData['bodyData']->results         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $alumno ;
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionAuxiliar/miUsuario', $this->htmlData);
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

    public function asistencia()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);//

        $profesor= array('profesor'=>$this->session->webCasSession->usuario->CODIGO);
        $ano= date('Y');
        $valores= $this->Usuarios_model->buscargradosAno($ano);
        $this->htmlData['bodyData']->valores     = $valores ;
        $this->htmlData['headData']->titulo               = "GESTION :: INTRANET";
        $this->load->view('bodys/GestionAuxiliar/asistencia', $this->htmlData);


    }
    public function comboSeccionAux()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_grado=$this->input->post("grado");
        $busqueda= array('profesor'=>$this->session->webCasSession->usuario->CODIGO,'grado'=>$id_grado);
        $busquedaSeccion=$this->Usuarios_model->busquedaSeccionAux($busqueda);

        foreach ($busquedaSeccion as $valor) {
            $arraySeccion[]=$valor->id_seccion;
        }
        $busquedaGrado= implode(',', $arraySeccion);
        if (isset($busquedaGrado)==true) {
            $busquedaSecc= $this->Usuarios_model->buscarSecciones($busquedaGrado);
            $html="<option value='' selected>Seleccione</option>";
            foreach ($busquedaSecc as $bus) {
                $html.="<option value='$bus->id'>$bus->nom_seccion</option>";
            }

            echo $html;
        } else {
            $html="<option value='' selected>Seleccione</option>";
            echo $html;
        }
    }
    public function comboBandeAsis()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id_grado=$this->input->post("grado");
        $id_seccion=$this->input->post("seccion");
        $busqueda= array('id_grado'=>$id_grado,'id_seccion'=>$id_seccion);
        $resultado= $this->Usuarios_model->buscaralumno($busqueda);
        $validacionA= $this->Usuarios_model->validacionFechaAlumnoAux($busqueda);

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

        if (isset($alumnos)==true) {
            $resultado2= implode(',', $alumnos);

            $arrayporcentaje = $this->Usuarios_model->busquedaAsistenciaAux($resultado2);

            $arrayporcentajeP= $this->Usuarios_model->busquedaAsistenciaPAux($resultado2);


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

            $this->htmlData['bodyData']->results          = $arrayalumno ;
            $this->htmlData['bodyData']->filtrog          = $busqueda['id_grado'] ;
            $this->htmlData['bodyData']->filtros          = $busqueda['id_seccion'] ;
            $this->htmlData['bodyData']->porcentaje       = $porcentaje ;
            $this->htmlData['bodyData']->contador         = $contador ;
        } else {
            $this->htmlData['bodyData']->results          = (int)0 ;
        }
        $this->load->view('vistasDialog/gestionAuxiliar/bandejaAsistencia', $this->htmlData);
    }
    public function verdetalleAlumnoAux()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $codigo=$this->input->post("codigo");
        $alumno=$this->input->post("alu2");
        $resultado= $this->Usuarios_model->buscarAlumnoasiAux($codigo);
        $this->htmlData['bodyData']->results         = $resultado ;
        $this->htmlData['bodyData']->alumno          = str_replace("-", " ", $alumno);
        $this->load->view('vistasDialog/gestionAuxiliar/verDetalleAlumno', $this->htmlData);
    }
    public function registrarAsistenciaAux()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $seccion      = $this->input->post('id_seccion');
        $grado        = $this->input->post('id_grado');
        $arrayAlumno  = $this->input->post('txtcodigo');
        $arrayMarcad  = $this->input->post('txtmarcado');

        foreach ($arrayAlumno as $array) {
            $insercion= array(
              "id_grado"=>$grado,
              "id_seccion"=>$seccion,
              "id_alumno"=>$array,
              "ano"=>date('Y'),
              "dia"=>date('d'),
              "mes"=>date('m'),
              "asistencia"=>'f',
              'fecha_val'=>date('Y-m-d'),
              'usu_creacion'=>$this->session->webCasSession->usuario->USUARIO
            );

            $this->Usuarios_model->insertAsitenciaAux($insercion);
        }
        $asistieronAl= implode(',', $arrayMarcad);
        $marcado= array('asistencia'=>'p');
        $asistieron= array(
              "id_grado"=>$grado,
              "id_seccion"=>$seccion,
              "id_alumno"=>$array,
              "ano"=>date('Y'),
              "dia"=>date('d'),
              "mes"=>date('m'),
              "marcado"=>$asistieronAl
              );
        if (count($arrayMarcad)>0) {
            $this->Usuarios_model->updateAsitenciaAux($marcado, $asistieron);
        }
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
    public function registrarRespuesta()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $id  =$this->input->post('respuesta');
        $codigo  =$this->input->post('codigo');
        $grado   =$this->input->post('grado');
        $curso   =$this->input->post('curso');
        $seccion =$this->input->post('seccion');
        $alumno  =$this->input->post('alumno');
        $fecha  =$this->input->post('fecha');
        $data= array('respuesta'=>trim($id));

        $this->Usuarios_model->cambiarRespuestaA($data, $codigo);
        $fecha= substr($fecha, 0, 10);
      //  $this->Usuarios_model->cambiarRespuesta($data, $grado, $seccion, $curso, $alumno, trim($fecha));
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
    public function buscarUser()
    {
        $this->load->model("Usuarios_model", '', true);
        $this->load->model("Rol_model", '', true);
        $usuario= $this->input->post('nombre');
        $codigo=$this->Usuarios_model->busquedaProfesor($usuario);
        if (isset($codigo)==true) {
            $usuario10=$codigo[0]->id;
            $datos=$this->Usuarios_model->busquedaDatos($usuario10);
            $alu= $usuario10;
            $alumnos=array('id_alumno'=>$alu);



            switch ($datos[0]->user) {
    case 1:
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
        // no break
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
        $valores  = $this->Usuarios_model->busquedaGradoSeccion($alumnos) ;
        $grado  =$this->Usuarios_model->buscarGrados($valores[0]->id_grado) ;
        $seccion=$this->Usuarios_model->buscarSecciones($valores[0]->id_seccion) ;
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
        $ano     =date('Y');

        $resultado=  $this->Usuarios_model->getBusquedaAulaAlu($valores[0]->id_grado, $valores[0]->id_seccion, $ano);

        $puesto_grado=$this->Usuarios_model->puestoGrado($valores[0]->id_grado);
        $sump=1;
        $p=0;
        $sums=1;
        $s=0;
        $sumc=1;
        $c=0;
        foreach ($puesto_grado as $grados) {
            if ($alu==$grados->id_alumno) {
                $arraygrado=array('puesto'=>$sump,'nota'=>(int)$grados->nota);
            }
            $sump++;
            $p++;
        }
        $puesto_salon=$this->Usuarios_model->puestoSalon($valores[0]->id_grado, $valores[0]->id_seccion);
        foreach ($puesto_salon as $salon) {
            if ($alu==$salon->id_alumno) {
                $arraysalon=array('puesto'=>$sums,'nota'=>(int)$salon->nota);
            }
            $sums++;
            $s++;
        }
        $puesto_colegio=$this->Usuarios_model->puestoColegio();
        $sums++;
        foreach ($puesto_colegio as $colegio) {
            if ($alu==$colegio->id_alumno) {
                $arraycolegio=array('puesto'=>$sumc,'nota'=>(int)$colegio->nota);
            }
            $sumc++;
            $c++;
        }
        $i=1;
        $totales= array('salon'=>$s,'grado'=>$p,'colegio'=>$c);
        $data= array('id_alumno'=>$alumnos['id_alumno'],'id_grado'=>$valores[0]->id_grado,'id_seccion'=>$valores[0]->id_seccion);
        $trayecto=$this->Usuarios_model->reporteNotasAlu($data);
        $trayectoSalon=$this->Usuarios_model->reporteNotasAluSal($data);
        $trayectoGrado=$this->Usuarios_model->reporteNotasAluGra($data);
        $trayectoColeg=$this->Usuarios_model->reporteNotasAluCol();
        $cantidadCur  =$this->Usuarios_model->reporteCantidadCur($data);    $sum=0;
        foreach ($cantidadCur as $canti) {
            $sum++;
        }
        foreach ($trayectoSalon as $salon) {
            $arraySalonNot[]=round(($salon->nota/($sum*$s)), 2);
        }
        foreach ($trayectoGrado as $grado) {
            $arraySalonGra[]=round(($grado->nota/($sum*$p)), 2);
        }
        foreach ($trayectoColeg as $coleg) {
            $arraySalonCol[]=round(($coleg->nota/($sum*$c)), 2);
        }
        foreach ($trayecto as $tray) {
            $arrayNotA[]=array('nota'=>round($tray->nota/$sum),
                                                        'desc'=>$tray->desc);
        }

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
        $this->htmlData['bodyData']->trayecto        = $arrayNotA ;
        $this->htmlData['bodyData']->trayectoSal     = $arraySalonNot ;
        $this->htmlData['bodyData']->trayectoGra     = $arraySalonGra ;
        $this->htmlData['bodyData']->trayectoCol     = $arraySalonCol ;
        $this->htmlData['bodyData']->results         = $arrayResultado ;
        $this->htmlData['bodyData']->colegio         = $arraycolegio ;
        $this->htmlData['bodyData']->salon           = $arraysalon ;
        $this->htmlData['bodyData']->grado           = $arraygrado ;
        $this->htmlData['bodyData']->total           = $totales ;
        $this->htmlData['bodyData']->color           = $color ;
        $this->htmlData['bodyData']->curso           = $title ;
        $this->htmlData['bodyData']->results1         = $arrayDatos ;
        $this->htmlData['bodyData']->codigo          = $usuario10 ;
        $this->load->view('vistasDialog/gestionAuxiliar/bandeja/bandejaBusquedaAlu', $this->htmlData);
        break;
}
        } else {
            echo "<h3><strong style='color:red'>Informacion Ingresada: No valida<br> Por favor ingresar correctamente los datos de la Persona</strong></h3>";
            die();
        }
    }
}
