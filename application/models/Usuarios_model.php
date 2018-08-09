<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Usuarios_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($usuario, $pass)
    {
        return
                $this->db->select('
        ma.id           as CODIGO,
	    mu.nom_usuario	as USUARIO   ,
        ma.documento   as DOCUMENTO  ,
        mt.num_tel	as TELEFONO      ,
        mu.clav_usuario as CLAVE     ,
        mu.role_usuario as ROLES     ,
        mc.des_correo	as CORREO	 ,
        ma.ruta         as RUTA      ,
        ma.ape_pat_per       as NOMBRE
                      ')
                ->from('maepersona  ma')
                ->join('maecorreos  mc', 'ma.id=mc.id_persona')
                ->join('maetelefono mt', 'ma.id=mt.id_persona')
                ->join('maeusuarios mu', 'ma.id=mu.id_persona')
                ->where(array('mu.nom_usuario'=>$usuario,'mu.clav_usuario'=>$pass))
                ->get()->result_object()  ;
    }
    public function updateAsitencia($marcado, $datos)
    {
        $this->db->set($marcado);
        $this->db->where(array(
              "id_grado"=>$datos['id_grado'],
              "id_seccion"=>$datos['id_seccion'],
              "id_curso"=>$datos['id_curso'],
              "ano"=>date('Y'),
              "dia"=>date('d'),
              "mes"=>date('m'),
        ));
        $this->db->where("id_alumno in (".$datos['marcado'].")");
        $this->db->update('asistencia_alumno');
    }
    public function updateAsitenciaAux($marcado, $datos)
    {
        $this->db->set($marcado);
        $this->db->where(array(
              "id_grado"=>$datos['id_grado'],
              "id_seccion"=>$datos['id_seccion'],
              "ano"=>date('Y'),
              "dia"=>date('d'),
              "mes"=>date('m'),
        ));
        $this->db->where("id_alumno in (".$datos['marcado'].")");
        $this->db->update('asistencia_alumno_aux');
    }
    public function editarpersona($datos, $id)
    {
        $this->db->set($datos)->where('id', $id)->update('maepersona');
    }
    public function editarcorreos($datos, $id)
    {
        $this->db->set($datos);
        $this->db->where('id_persona', $id);
        $this->db->update('maecorreos');
    }
    public function cambiarclave($datos, $id)
    {
        $this->db->set($datos);
        $this->db->where('id_persona', $id);
        $this->db->update('maeusuarios');
    }
    public function editar_configuracion_nota($datos, $lista,$detalle)
    {
        $this->db->set($datos);
        $this->db->where('id in ('.$detalle.")");
        $this->db->update('rel_notas_detalle');
        return true;
    }
    public function editar_configuracion_nota_alumno($datos, $lista,$seccion,$detalle)
    {
        $this->db->set($datos);
        $this->db->where($lista);
        $this->db->where('id_seccion in ('.$seccion.")");
        $this->db->where('id_nota in ('.$detalle.")");
        $this->db->update('rel_notas_detalle_alumno');
        return true;
    }
    public function cambiardat($datos, $id)
    {
        $this->db->set($datos);
        $this->db->where('id', $id);
        $this->db->update('maepersona');
    }
    public function editarusuario($datos, $id)
    {
        $this->db->set($datos);
        $this->db->where('id_persona', $id);
        $this->db->update('maeusuarios');
    }
    public function editartelefon($datos, $id)
    {
        $this->db->set($datos);
        $this->db->where('id_persona', $id);
        $this->db->update('maetelefono');
    }
    public function getList()
    {
        $this->db->distinct()
                ->select('
        ma.id           as CODIGO,
        ma.ape_pat_per  as PROFESOR ,
	mu.nom_usuario	as USUARIO      ,
        mt.num_tel	as TELEFONO     ,
        mc.des_correo	as CORREO	,
        mu.role_usuario	as ROLES	,
           case   mu.role_usuario
           when  2 then \'DIRECTOR\'
           when  3 then \'SUB DIRECTOR\'
           when  4 then \'PROFESOR\'
           when  5 then \'AUXILIAR\'
           when  6 then \'ALUMNO\'  END AS CARGO
                      ')
                ->from('maepersona  ma')
                ->join('maecorreos  mc', 'ma.id=mc.id_persona')
                ->join('maetelefono mt', 'ma.id=mt.id_persona')
                ->join('maeusuarios mu', 'ma.id=mu.id_persona')
                ->where('mu.role_usuario<>', '1')
                ->order_by('1', 'desc');

        return $this->db->get()->result_object() ;
    }
    public function getListPer()
    {
        $this->db->distinct()
                ->select('
        ma.id           as CODIGO,
        ma.ape_pat_per  as PROFESOR ,
	mu.nom_usuario	as USUARIO      ,
        mt.num_tel	as TELEFONO     ,
        mc.des_correo	as CORREO	,
        mu.role_usuario	as ROLES	,
           case   mu.role_usuario
           when  2 then \'DIRECTOR\'
           when  3 then \'SUB DIRECTOR\'
           when  4 then \'PROFESOR\'
           when  5 then \'AUXILIAR\'
           when  6 then \'ALUMNO\'  END AS CARGO
                      ')
                ->from('maepersona  ma')
                ->join('maecorreos  mc', 'ma.id=mc.id_persona')
                ->join('maetelefono mt', 'ma.id=mt.id_persona')
                ->join('maeusuarios mu', 'ma.id=mu.id_persona')
                ->where('mu.role_usuario<>', '1')
                ->order_by('1', 'desc');

        $query = $this->db->get();
        return $query;
    }
    public function getBandeja()
    {
        $this->db->distinct();
        $this->db->select(
            '
                            CONCAT(MG.nom_grado,\' \',MG.des_grado) as GRADO  ,
                            MS.nom_seccion as SECCION                         ,
                            MA.nom_cursos  as CURSOS                          ,
                            ape_pat_per as PROFESOR
                            '
                )
                ->from('relaula RE')
                ->join('maecursos  MA', 'RE.id_curso   =MA.id')
                ->join('maeseccion MS', 'RE.id_seccion =MS.id')
                ->join('maepersona MP', 'RE.id_profesor=MP.id')
                ->join('maegrados  MG', 'RE.id_grado   =MG.id')
                ->where('RE.estado', '1')
                ->order_by('1', 'desc');


        return $this->db->get()->result_object();
    }
    public function getBusquedaAulaProf($id_profesor, $ano)
    {
        $this->db->distinct();
        $this->db->select(
            '
                            RE.horario as horario,
                            RE.dia as dia,
                            MG.nom_grado as GRADO  ,
                            MS.nom_seccion as SECCION                         ,
                            MA.nom_cursos  as CURSOS                          ,
                            MA.des_cursos  as descripcion
                            '
                )
                ->from('relaula RE')
                ->join('maecursos  MA', 'on RE.id_curso   =MA.id')
                ->join('maeseccion MS', 'on RE.id_seccion =MS.id')
                ->join('maepersona MP', 'on RE.id_profesor=MP.id')
                ->join('maegrados  MG', 'on RE.id_grado   =MG.id')
                ->where('RE.estado=1 and RE.id_profesor='.$id_profesor.' and RE.ano='.$ano)
                ->order_by('1,2', 'asc');


        return $this->db->get()->result_object();
    }
    public function getBusquedaAulaAlu($grado, $seccion, $ano)
    {
        $this->db->distinct();
        $this->db->select(
            '
                            RE.horario as horario,
                            RE.dia as dia,
                            MG.nom_grado as GRADO  ,
                            MS.nom_seccion as SECCION                         ,
                            MA.nom_cursos  as CURSOS                          ,
                            MA.des_cursos  as descripcion
                            '
                )
                ->from('relaula RE')
                ->join('maecursos  MA', 'on RE.id_curso   =MA.id')
                ->join('maeseccion MS', 'on RE.id_seccion =MS.id')
                ->join('maepersona MP', 'on RE.id_profesor=MP.id')
                ->join('maegrados  MG', 'on RE.id_grado   =MG.id')
                ->where('RE.estado=1 and MG.id='.$grado.' and MS.id='.$seccion.' and  RE.ano='.$ano)
                ->order_by('1,2', 'asc');


        return $this->db->get()->result_object();
    }
    public function ultimoregistro()
    {
        $this->db->select(" MAX(id) as ultimo ")->from("maepersona");
        return $this->db->get()->result_object() ;
    }
    public function capacidad_curso()
    {
        $this->db->select("round(count(*)/(select count(*) from maebimestre)) as capacidad")
                 ->from('rel_curso_nota')
                 ->group_by('id_curso');
        return $this->db->get()->result_array() ;
    }
    public function comparacionGrado($ano, $grado, $bimestre)
    {

        $this->db->distinct();
        $this->db->select(" mu.nom_cursos as curso,mg.nom_grado as grado, ms.nom_seccion as seccion,rn.id_grado,rn.id_curso,mi.id_bimestre,rna.id_seccion,sum(rna.nota*rn.peso)/((select count(*) from relaulalumno rl where rl.id_grado=rn.id_grado and rl.id_seccion=rna.id_seccion)* (select round(count(*)/(select count(*) from maebimestre)) from rel_curso_nota where id_curso=rn.id_curso group by id_curso) ) as nota,
                            (select count(*) from relaulalumno rl where rl.id_grado=rn.id_grado and rl.id_seccion=rna.id_seccion) as cantidad
                          ")->from("rel_notas_detalle rn ")
                            ->join("rel_notas_detalle_alumno rna", "on rna.id_nota=rn.id")
                            ->join("maenotas mi", "on rn.id_nota=mi.id")
                            ->join("maegrados mg", "on rn.id_grado=mg.id")
                            ->join("maeseccion ms", "on rna.id_seccion=ms.id")
                            ->join("maecursos mu", "on rn.id_curso=mu.id")
                            ->where("rn.estado=1 and rn.ano=".$ano." and rn.id_grado=".$grado." and mi.id_bimestre=".$bimestre)
                            ->group_by("rn.id_grado,rn.id_curso,mi.id_bimestre,rna.id_seccion")
                            ->order_by("rna.id_seccion,rn.id_curso", "asc");
        return $this->db->get()->result_object() ;
    }
    public function comparacionGrados($ano, $grado)
    {

        $this->db->distinct();
        $this->db->select(" mu.nom_cursos as curso,mg.nom_grado as grado, ms.nom_seccion as seccion,rn.id_grado,rn.id_curso,rna.id_seccion,sum(rna.nota*rn.peso)/(select round(count(*)) from rel_curso_nota where id_curso=rn.id_curso group by id_curso) as nota,
                            (select count(*) from relaulalumno rl where rl.id_grado=rn.id_grado and rl.id_seccion=rna.id_seccion) as cantidad
                          ")->from("rel_notas_detalle rn ")
                            ->join("rel_notas_detalle_alumno rna", "on rna.id_nota=rn.id")
                            ->join("maenotas   mi", "on rn.id_nota=mi.id")
                            ->join("maegrados  mg", "on rn.id_grado=mg.id")
                            ->join("maeseccion ms", "on rna.id_seccion=ms.id")
                            ->join("maecursos  mu", "on rn.id_curso=mu.id")
                            ->where("rn.estado=1 and rn.ano=".$ano." and rn.id_grado=".$grado)
                            ->group_by("rn.id_grado,rn.id_curso,rna.id_seccion")
                            ->order_by("rna.id_seccion,rn.id_curso", "asc");
        return $this->db->get()->result_object() ;
    }
    public function comparacionGradoCurso($ano, $grado, $bimestre)
    {
        $this->db->distinct();
        $this->db->select(" mu.nom_cursos as curso
                          ")->from("rel_notas_detalle rn ")
                            ->join("rel_notas_detalle_alumno rna", "on rna.id_nota=rn.id")
                            ->join("maegrados mg", "on rn.id_grado=mg.id")
                            ->join("maenotas mi", "on rn.id_nota=mi.id")
                            ->join("maeseccion ms", "on rna.id_seccion=ms.id")
                            ->join("maecursos mu", "on rn.id_curso=mu.id")
                            ->where("rn.estado=1 and rn.ano=".$ano." and rn.id_grado=".$grado." and mi.id_bimestre=".$bimestre)
                            ->order_by("mu.nom_cursos", "asc");
        return $this->db->get()->result_object() ;
    }
    public function comparacionGradoCursos($ano, $grado)
    {
        $this->db->distinct();
        $this->db->select(" mu.nom_cursos as curso
                          ")->from("rel_notas_detalle rn ")
                            ->join("rel_notas_detalle_alumno rna", "on rn.id=rna.id_nota")
                            ->join("maegrados mg", "on rn.id_grado=mg.id")
                            ->join("maeseccion ms", "on rna.id_seccion=ms.id")
                            ->join("maecursos mu", "on rn.id_curso=mu.id")
                            ->where("rn.estado=1 and rn.ano=".$ano." and rn.id_grado=".$grado)
                            ->order_by("mu.nom_cursos", "asc");
        return $this->db->get()->result_object() ;
    }
    public function puestoSalon($grado, $seccion)
    {
        $this->db->select("rnda.id_alumno,rnda.id_grado,rnda.id_seccion,round(sum(rnda.nota*rnd.peso),2) as nota, (select distinct count(*) from relaulalumno rla where rla.id_grado=rnda.id_grado and rla.id_seccion=rnda.id_seccion) as cantidad");
        $this->db->from("rel_notas_detalle_alumno rnda");
        $this->db->join("rel_notas_detalle rnd ", "ON rnda.id_nota  =rnd.id");
        $this->db->join("maenotas   ma "        , "ON rnd.id_nota   =ma.id ");
        $this->db->join("maepersona mp "        , "ON rnda.id_alumno=mp.id");
        $this->db->where("rnda.estado=1 and rnd.estado=1 and rnda.ano=".date('Y')."  and rnda.id_grado=".$grado." and rnda.id_seccion=".$seccion);
        $this->db->group_by('rnda.id_grado,rnda.id_seccion,rnda.id_alumno');
        $this->db->order_by('nota', 'DESC') ;
        return $this->db->get()->result_array() ;
    }
    public function puestoSalonTotal()
    {
        $this->db->distinct();
        $this->db->select("ma.ape_pat_per as alumno,CONCAT(mg.nom_grado,'°',me.nom_seccion) as grado,rl.id_alumno,round(SUM(rl.nota),2) as nota ")->from("relnotas rl")
                ->join("maenotas mn", "on rl.id_nota=mn.id")
                ->join("maepersona   ma", "on rl.id_alumno =ma.id")
                ->join("maegrados    mg", "on rl.id_grado  =mg.id")
                ->join("maeseccion   me", "on rl.id_seccion=me.id");
        $this->db->where("rl.estado=1 and rl.id_curso!=0 and mn.pe is null and mn.id_bimestre is not null and rl.ano=".date('Y'));
        $this->db->group_by('rl.id_alumno,ma.ape_pat_per,mg.nom_grado,me.nom_seccion')->limit('5') ;
        $this->db->order_by('4', 'DESC');
        return $this->db->get()->result_array() ;
    }

    public function puestoGrado($grado)
    {
        $this->db->select("rnda.id_alumno,rnda.id_grado,round(sum(rnda.nota*rnd.peso),2) as nota, (select distinct count(*) from relaulalumno rla where rla.id_grado=rnda.id_grado ) as cantidad");
        $this->db->from("rel_notas_detalle_alumno rnda");
        $this->db->join("rel_notas_detalle rnd ", "ON rnda.id_nota  =rnd.id");
        $this->db->join("maenotas   ma "        , "ON rnd.id_nota   =ma.id ");
        $this->db->join("maepersona mp "        , "ON rnda.id_alumno=mp.id");
        $this->db->where("rnda.estado=1 and rnd.estado=1 and rnda.ano=".date('Y')."  and rnda.id_grado=".$grado);
        $this->db->group_by('rnda.id_grado,rnda.id_alumno');
        $this->db->order_by('nota', 'DESC') ;
        return $this->db->get()->result_array() ;
    }
    public function puestoColegio()
    {
        $this->db->select("rnda.id_alumno,round(sum(rnda.nota*rnd.peso),2) as nota, (select distinct count(*) from relaulalumno rla ) as cantidad");
        $this->db->from("rel_notas_detalle_alumno rnda");
        $this->db->join("rel_notas_detalle rnd ", "ON rnda.id_nota  =rnd.id");
        $this->db->join("maenotas   ma "        , "ON rnd.id_nota   =ma.id ");
        $this->db->join("maepersona mp "        , "ON rnda.id_alumno=mp.id");
        $this->db->where("rnda.estado=1 and rnd.estado=1 and rnda.ano=".date('Y'));
        $this->db->group_by('rnda.id_alumno');
        $this->db->order_by('nota', 'DESC') ;
        return $this->db->get()->result_array() ;
    }
    public function getGrados()
    {
        $this->db->select(" id,nom_grado,des_grado,usu_creacion,fec_creacion ");
        $this->db->from("maegrados");
        $this->db->order_by('nom_grado', 'DESC') ;
        return $this->db->get()->result_object() ;
    }
    public function getGradosAno()
    {
        $this->db->distinct();
        $this->db->select("ano");
        $this->db->from("maenotas");
        $this->db->order_by('ano', 'DESC') ;
        return $this->db->get()->result_object() ;
    }
    public function getSecciones()
    {
        $this->db->select(" id,nom_seccion,des_seccion,usu_creacion,fec_creacion ");
        $this->db->from("maeseccion");
        $this->db->order_by('nom_seccion', 'DESC') ;
        return $this->db->get()->result_object() ;
    }
    public function getCursos()
    {
        $this->db->select(" id,nom_cursos,des_cursos,cant_horas,cant_capacidades,usu_creacion,fec_creacion ");
        $this->db->from("maecursos");
        $this->db->order_by('nom_cursos', 'DESC') ;
        return $this->db->get()->result_object() ;
    }
    public function getBimestre()
    {
        $this->db->select(" id,nom_bimestre,fecini_bimestre,fecfin_bimestre,ano ");
        $this->db->from("maebimestre");
        $this->db->order_by('nom_bimestre', 'DESC') ;
        return $this->db->get()->result_object() ;
    }
    public function getbi()
    {
        $this->db->select(" id,nom_bimestre,fecini_bimestre,fecfin_bimestre,ano ");
        $this->db->from("maebimestre");
        $this->db->order_by('nom_bimestre', 'DESC') ;
        return $this->db->get()->num_rows() ;
    }
    public function getsec($grado, $profesor, $curso)
    {
        $this->db->distinct();
        $this->db->select("id_seccion");
        $this->db->from("relaula");
        $this->db->where('id_grado='.$grado.' and id_profesor='.$profesor.' and id_curso='.$curso);
        return $this->db->get()->num_rows() ;
    }
    public function getNotas()
    {
        $this->db->select(" id,id_bimestre,nom_notas,des_notas,ano,pes_notas ");
        $this->db->from("maenotas");
        $this->db->order_by('2', 'DESC') ;
        return $this->db->get()->result_object() ;
    }
    public function insertarGrados($datos)
    {
        $data = array(
            'nom_grado'             => null,
            'des_grado'             => null,
            'ano'                   =>date('Y'),
            'usu_creacion'          => null,
            'usu_modificacion'      => null

        );
        foreach ($datos as $tempKey => $tempVal) {
            if (array_key_exists($tempKey, $data)) {
                $data[$tempKey] = $tempVal;
            }
        }
        return     $this->db->insert('maegrados', $data);
    }
    public function insertarSecciones($datos)
    {
        $data = array(
            'nom_seccion'             => null,
            'des_seccion'             => null,
            'usu_creacion'            => null,
            'usu_modificacion'        => null
        );
        foreach ($datos as $tempKey => $tempVal) {
            if (array_key_exists($tempKey, $data)) {
                $data[$tempKey] = $tempVal;
            }
        }
        return     $this->db->insert('maeseccion', $data);
    }
    public function insertarCursos($datos)
    {

        return     $this->db->insert('maecursos', $datos);
    }

    public function insertarBimestre($datos)
    {
        return  $this->db->insert('maebimestre', $datos);
    }
    public function insertarNotas($datos)
    {
        return  $this->db->insert('maenotas', $datos);
    }
    public function buscardocumentos($data)
    {
        $this->db->select(" id,nom_archivo,nombre,ruta,ano,tipo,fec_creacion,fec_modificacion,descripcion ")->from("documentos_docentes");
        $this->db->where(array('id_curso'=>$data['id_curso'],'id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'],'id_bimestre'=>$data['id_bimestre'])) ;
        $this->db->order_by('fec_creacion', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function buscardocumentos_bandeja($data)
    {
        $this->db->select(" dc.id,mc.nom_cursos,dc.nom_archivo,dc.nombre,dc.ruta,dc.ano,dc.tipo,dc.fec_creacion,dc.fec_modificacion,dc.descripcion ")->from("documentos_docentes dc")->join('maecursos mc','on dc.id_curso=mc.id');
        $this->db->where(array('dc.id_grado'=>$data['id_grado'],'dc.id_seccion'=>$data['id_seccion'],'dc.ano'=>date('Y'),'notificacion'=>0)) ;
        $this->db->order_by('dc.fec_creacion', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function buscardocumentosasistencia($data)
    {
        $this->db->select(" id,id_asistencia,fecha_jus,nombre,ruta,ano,fec_creacion ")->from("documentos_asistencia");
        $this->db->where('id_asistencia='.$data.' and ano='.date('Y')) ;
        $this->db->order_by('fec_creacion', 'asc');
        return $this->db->get()->result_object() ;
    }
    public function buscaralumno($data)
    {
        $this->db->select("id_alumno")->from("relaulalumno");
        $this->db->where(array('id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'],'ano'=>date('Y'))) ;
        $this->db->order_by('id_alumno', 'asc');
        return $this->db->get()->result_object() ;
    }
    public function list_alumno($data)
    {
        $this->db->select("id_alumno")->from("relaulalumno");
        $this->db->where(array('id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'],'ano'=>date('Y'))) ;
        $this->db->order_by('id_alumno', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function list_alumno_capacidad($data)
    {
        $this->db->distinct();
        $this->db->select("id_alumno,id_seccion")->from("relaulalumno");
        $this->db->where('id_grado='.$data['id_grado'].'  and id_seccion in ('.$data['id_seccion'].')') ;
        $this->db->order_by('id_alumno', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function getClientes()
    {
        $this->db->select(" * ")->from("maeusuarios");
        $this->db->where('role_usuario =', 6) ;
        return $this->db->get()->result_object() ;
    }
    public function busquedaHorario($codigo)
    {
        $this->db->select(" horario ")->from("relaula")->where("id_seccion", $codigo);
        return $this->db->get()->result_object() ;
    }
    public function busquedaHorarios($codigo,$grado)
    {
        $this->db->select(" horario ")->from("relaula")->where("id_seccion=".$codigo.' and id_grado='.$grado);
        return $this->db->get()->result_object() ;
    }
    public function reporteNotasFinal($data,$boolean)
    {
        $this->db->select("mp.ape_pat_per,rnda.id_alumno,rnda.id_grado,rnda.id_seccion,round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2) as nota ")
                 ->from("rel_notas_detalle_alumno rnda")
                 ->join("rel_notas_detalle rnd", "ON rnda.id_nota   =rnd.id")
                 ->join("maenotas   ma"        , "ON rnd.id_nota    =ma.id")
                 ->join("maepersona mp"        , "ON rnda.id_alumno =mp.id");
        $this->db->where(array('rnda.id_curso'=>$data['id_curso'],'rnda.id_grado'=>$data['id_grado'],'rnda.id_seccion'=>$data['id_seccion'],'rnda.ano'=>date('Y'))) ;
        $this->db->where('rnd.estado=1  and rnda.estado=1 ');
        $this->db->group_by('rnda.id_grado,rnda.id_seccion,rnda.id_alumno');
        if($boolean==true){
            $this->db->order_by('nota','desc');
            $this->db->limit(3);
        }
        return $this->db->get()->result_array() ;
    }
    public function nota_vacia($codigo)
    {
        $this->db->distinct();
        $this->db->select("id_curso")
                 ->from("rel_notas_detalle_alumno ")
                 ->where("id_alumno=".$codigo." and estado=1 and ano=".date('Y')." and nota is null");
        return $this->db->get()->result_array() ;
    }
    public function validar_registro($codigo)
    {
        $this->db->distinct();
        $this->db->select("id_curso")
                 ->from("rel_notas_detalle_alumno ")
                 ->where("id_alumno=".$codigo." and estado=1 and ano=".date('Y'));
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasFinal_alumno($data,$no_curso)
    {

        $this->db->select("rnda.id_curso,mc.nom_cursos,round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2) as nota,
        case
            when
                round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2)>10.49
            then 'APROBADO'
            else 'DESAPROBADO'
        end as criterio
        ")
                 ->from("rel_notas_detalle_alumno rnda")
                 ->join("rel_notas_detalle rnd", "ON rnda.id_nota   =rnd.id")
                 ->join("maenotas   ma"        , "ON rnd.id_nota    =ma.id")
                 ->join("maecursos   mc"        , "ON rnda.id_curso    =mc.id")
                 ->join("maepersona mp"        , "ON rnda.id_alumno =mp.id");
        $this->db->where(array('rnda.id_grado'=>$data['id_grado'],'rnda.id_seccion'=>$data['id_seccion'],'rnda.ano'=>$data['ano'],'rnda.id_alumno'=>$data['id_alumno'])) ;
        $this->db->where('rnd.estado=1  and rnda.estado=1 ');
        if(count($no_curso)!=0){
            $this->db->where(' rnda.id_curso not in ('.$no_curso.')');
        }
        $this->db->group_by('rnda.id_curso');
        $this->db->order_by('mc.nom_cursos','asc');
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasFinal_dir()
    {
        $this->db->select("mp.ape_pat_per as alumno,CONCAT(mg.nom_grado,' ',ms.nom_seccion) as grado , rnda.id_alumno,rnda.id_grado,rnda.id_seccion,round(sum(rnda.nota*rnd.peso),2) as nota ")
                 ->from("rel_notas_detalle_alumno rnda")
                 ->join("rel_notas_detalle rnd", "ON rnda.id_nota   =rnd.id")
                 ->join("maenotas   ma"        , "ON rnd.id_nota    =ma.id")
                 ->join("maepersona mp"        , "ON rnda.id_alumno =mp.id")
                 ->join("maegrados  mg "       , "ON rnda.id_grado=mg.id")
                 ->join("maeseccion  ms "       , "ON rnda.id_seccion=ms.id");
        $this->db->where(array('rnda.ano'=>date('Y'))) ;
        $this->db->where('rnd.estado=1  and rnda.estado=1 ');
        $this->db->group_by('rnda.id_alumno,rnda.id_seccion,rnda.id_grado');
        $this->db->order_by('nota','desc');
        $this->db->limit(3);
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasFinal10($data)
    {
        $this->db->select("mp.ape_pat_per,rnda.id_alumno,rnda.id_grado,rnda.id_seccion,round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2) as nota ")
                 ->from("rel_notas_detalle_alumno rnda")
                 ->join("rel_notas_detalle rnd", "ON rnda.id_nota   =rnd.id")
                 ->join("maenotas   ma"        , "ON rnd.id_nota    =ma.id")
                 ->join("maepersona mp"        , "ON rnda.id_alumno =mp.id");
        $this->db->where(array('rnda.id_curso'=>$data['id_curso'],'rnda.id_grado'=>$data['id_grado'],'rnda.id_seccion'=>$data['id_seccion'],'rnda.ano'=>date('Y'))) ;
        $this->db->where('rnd.estado=1  and rnda.estado=1 ');
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasMerito10($data,$boolean)
    {
        $this->db->select("mp.ape_pat_per,rnda.id_alumno,rnda.id_grado,rnda.id_seccion,round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2) as nota ")
                 ->from("rel_notas_detalle_alumno rnda")
                 ->join("rel_notas_detalle rnd", "ON rnda.id_nota   =rnd.id")
                 ->join("maenotas   ma"        , "ON rnd.id_nota    =ma.id")
                 ->join("maepersona mp"        , "ON rnda.id_alumno =mp.id");
        $this->db->where(array('ma.id_bimestre'=>$data['id_bimestre'],'rnda.id_curso'=>$data['id_curso'],'rnda.id_grado'=>$data['id_grado'],'rnda.id_seccion'=>$data['id_seccion'],'rnda.ano'=>date('Y'))) ;
        $this->db->where('rnd.estado=1  and rnda.estado=1 ');
        $this->db->group_by('rnda.id_grado,rnda.id_seccion,rnda.id_alumno');
        if($boolean==true){
            $this->db->order_by('nota','desc');
            $this->db->limit(3);
        }
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasMerito101($data,$boolean)
    {
        $this->db->select("mp.ape_pat_per as nombre,round(sum(rnda.nota*rnd.peso),0) as nota ")
                 ->from("rel_notas_detalle_alumno rnda")
                 ->join("rel_notas_detalle rnd", "ON rnda.id_nota   =rnd.id")
                 ->join("maenotas   ma"        , "ON rnd.id_nota    =ma.id")
                 ->join("maepersona mp"        , "ON rnda.id_alumno =mp.id");
        $this->db->where(array('ma.id_bimestre'=>$data['id_bimestre'],'rnda.id_curso'=>$data['id_curso'],'rnda.id_grado'=>$data['id_grado'],'rnda.id_seccion'=>$data['id_seccion'],'rnda.ano'=>date('Y'))) ;
        $this->db->where('rnd.estado=1  and rnda.estado=1 ');
        $this->db->group_by('rnda.id_alumno,rnd.id_nota');
        if($boolean==true){
            $this->db->order_by('nota','desc');
            $this->db->limit(3);
        }
        return $this->db->get()->result_array() ;
    }
    public function reporteNotas($data, $cantidad)
    {
        $this->db->select("re.id_alumno,round(sum(re.nota)/".$cantidad.") as notas ")
                ->from("relnotas re")
                ->join("maenotas ma", "on re.id_nota=ma.id");
        $this->db->where(array('re.id_curso'=>$data['id_curso'],'re.id_grado'=>$data['id_grado'],'re.id_seccion'=>$data['id_seccion'],'re.id_bimestre'=>$data['id_bimestre'],'re.ano'=>date('Y'))) ;
        $this->db->where('re.estado=1 and ma.pe is not null and ma.id_bimestre is not null');
        $this->db->group_by('re.id_alumno');
        return $this->db->get()->result_object() ;
    }
    public function reporteNotas2($data)
    {
        $this->db->select("re.id_alumno,round(avg(re.nota),2) as notas ")
                ->from("relnotas re")
                ->join("maenotas ma", "on re.id_nota=ma.id");
        $this->db->where(array('re.id_curso'=>$data['id_curso'],'re.id_grado'=>$data['id_grado'],'re.id_seccion'=>$data['id_seccion'],'re.id_bimestre'=>$data['id_bimestre'],'re.ano'=>date('Y'))) ;
        $this->db->where('re.estado=1 and ma.pe is not null and ma.id_bimestre is not null');
        $this->db->group_by('re.id_alumno');
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasAlu($data)
    {
        $this->db->select("round(sum(rnda.nota*rnd.peso),2) as nota,ma.id_bimestre as desci,me.nom_bimestre as desc")
        ->from("rel_notas_detalle_alumno rnda")
        ->join("rel_notas_detalle rnd", "on rnda.id_nota=rnd.id")
        ->join("maenotas ma"          , "on rnd.id_nota =ma.id")
        ->join("maebimestre me"          , "on ma.id_bimestre =me.id")
        ->where('rnda.id_alumno='.$data['id_alumno'].' and
                 rnda.ano='.date('Y').' and
                 rnda.estado=1         and
                 rnd.estado=1')
        ->group_by('ma.id_bimestre')
        ->order_by('2', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasAluCurTol($data)
    {
        $this->db->select("ma.id_bimestre as desc,me.nom_bimestre as nombi,round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2) as nota,mc.nom_cursos as nombre ")
        ->from("rel_notas_detalle_alumno rnda")
        ->join('rel_notas_detalle rnd', ' ON rnda.id_nota=rnd.id')
        ->join('maenotas  ma', ' ON rnd.id_nota =ma.id')
        ->join("maebimestre me"          , "on ma.id_bimestre =me.id")
        ->join('maecursos mc', ' ON rnda.id_curso=mc.id');
        $this->db->where('rnda.id_alumno='.$data['id_alumno'].' and  rnda.estado=1 and rnd.estado=1  and rnda.ano='.$data['ano']) ;
        $this->db->group_by('ma.id_bimestre,mc.nom_cursos');
        $this->db->order_by('1', 'asc');
        return $this->db->get()->result_object() ;
    }
    public function reporteNotasAluCur($data)
    {
        $this->db->select("ma.id_bimestre as desc,me.nom_bimestre as nombi,round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2) as nota,mc.nom_cursos as nombre ")

        ->from("rel_notas_detalle_alumno rnda")
        ->join('rel_notas_detalle rnd', ' on rnda.id_nota=rnd.id')
        ->join('maenotas  ma'         , ' on rnd.id_nota =ma.id')
        ->join("maebimestre me"          , "on ma.id_bimestre =me.id")
        ->join('maecursos mc'         , ' on rnda.id_curso=mc.id');
        $this->db->where('rnda.id_alumno='.$data['id_alumno'].' and rnda.ano='.$data['ano'].' and rnda.id_curso='.$data['id_curso']) ;
        $this->db->where('rnda.estado=1 and rnd.estado=1');
        $this->db->group_by('ma.id_bimestre');
        $this->db->order_by('1', 'asc');
        return $this->db->get()->result_object() ;
    }
    public function reporteNotasAluCur_bimestre($data)
    {
        $this->db->select("ma.id_bimestre as desc,round(sum(rnda.nota*rnd.peso)/COUNT(distinct ma.id),2) as nota,mc.nom_cursos as nombre ")

        ->from("rel_notas_detalle_alumno rnda")
        ->join('rel_notas_detalle rnd', ' on rnda.id_nota=rnd.id')
        ->join('maenotas  ma'         , ' on rnd.id_nota =ma.id')
        ->join('maecursos mc'         , ' on rnda.id_curso=mc.id');
        $this->db->where('rnda.id_alumno='.$data['id_alumno'].' and rnda.ano='.$data['ano'].' and rnda.id_curso='.$data['id_curso'].' and ma.id_bimestre='.$data['id_bimestre']) ;
        $this->db->where('rnda.estado=1 and rnd.estado=1');
        $this->db->group_by('ma.id_bimestre');
        $this->db->order_by('1', 'asc');
        return $this->db->get()->row_array() ;
    }
    public function reporteNotasAluSal($data)
    {
        $this->db->select("round(sum(rnda.nota*rnd.peso)/(select distinct count(*) from relaulalumno rla  where rla.id_grado=rnda.id_grado and rla.id_seccion=rnda.id_seccion),2) as nota,ma.id_bimestre as desc,rnda.id_grado,rnda.id_seccion")
        ->from("rel_notas_detalle_alumno rnda")
        ->join("rel_notas_detalle rnd", "on rnda.id_nota=rnd.id")
        ->join("maenotas ma"          , "on rnd.id_nota =ma.id")
        ->where('rnda.id_grado='.$data['id_grado'].'     and
                 rnda.id_seccion='.$data['id_seccion'].' and
                 rnda.ano='.date('Y').'                  and
                 rnda.estado=1                           and
                 rnd.estado=1')
        ->group_by('ma.id_bimestre,rnda.id_grado,rnda.id_seccion')
        ->order_by('2', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasAluGra($data)
    {
        $this->db->select("round(sum(rnda.nota*rnd.peso)/(select distinct count(*) from relaulalumno rla  where rla.id_grado=rnda.id_grado ),2) as nota,ma.id_bimestre as desc,rnda.id_grado")
        ->from("rel_notas_detalle_alumno rnda")
        ->join("rel_notas_detalle rnd", "on rnda.id_nota=rnd.id")
        ->join("maenotas ma"          , "on rnd.id_nota =ma.id")
        ->where('rnda.id_grado='.$data['id_grado'].'     and
                 rnda.ano='.date('Y').'                  and
                 rnda.estado=1                           and
                 rnd.estado=1')
        ->group_by('ma.id_bimestre,rnda.id_grado')
        ->order_by('2', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasAluCol()
    {
        $this->db->select("round(sum(rnda.nota*rnd.peso)/(select distinct count(*) from relaulalumno rla   ),2) as nota,ma.id_bimestre as desc")
        ->from("rel_notas_detalle_alumno rnda")
        ->join("rel_notas_detalle rnd", "on rnda.id_nota=rnd.id")
        ->join("maenotas ma"          , "on rnd.id_nota =ma.id")
        ->where('
                 rnda.ano='.date('Y').'                  and
                 rnda.estado=1                           and
                 rnd.estado=1')
        ->group_by('ma.id_bimestre')
        ->order_by('2', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function reporteNotasMerito($data)
    {
        $this->db->select("ma.ape_pat_per,rl.id_alumno,round(avg(rl.nota)) as nota")->from("relnotas rl")
             ->join("maenotas me", "on rl.id_nota=me.id")
             ->join("maepersona ma", "on rl.id_alumno=ma.id")   ;
        $this->db->where(array('rl.id_curso'=>$data['id_curso'],'rl.id_grado'=>$data['id_grado'],'rl.id_seccion'=>$data['id_seccion'],'rl.id_bimestre'=>$data['id_bimestre'],'rl.ano'=>date('Y'))) ;
        $this->db->where('rl.estado=1 and me.pe is  null and me.id_bimestre is not null');
        $this->db->group_by('rl.id_alumno,ma.ape_pat_per')->limit('3');
        $this->db->order_by('sum(rl.nota)', 'desc');
        return $this->db->get()->result_object() ;
    }

    public function reporteNotasMerito2($data)
    {
        $this->db->select("re.id_alumno,avg(re.nota) as nota")->from("relnotas re")->join("maenotas ma", "on re.id_nota=ma.id")   ;
        $this->db->where(array('re.id_curso'=>$data['id_curso'],'re.id_grado'=>$data['id_grado'],'re.id_seccion'=>$data['id_seccion'],'re.ano'=>date('Y'))) ;
        $this->db->where('re.estado=1 and ma.pe is not null and ma.id_bimestre is null');
        $this->db->group_by('re.id_alumno')->limit('3');
        $this->db->order_by('sum(re.nota)', 'desc');
        return $this->db->get()->result_object() ;
    }
    public function consultarano($data)
    {
        $this->db->select("ano,id_grado,id_seccion")->from("relaulalumno");
        $this->db->where('id_alumno', $data) ;
        return $this->db->get()->result_object() ;
    }
    public function reporteCantidad($data)
    {
        $this->db->select("count(*) as cantidad")->from("relaulalumno");
        $this->db->where(array('id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'])) ;
        $this->db->where('ano', date('Y'));
        return $this->db->get()->result_object() ;
    }
    public function informacionAlumno($codigoAlumno, $grado, $seccion, $ano)
    {
        $data=$this->db->query("CALL puestos('".$codigoAlumno."','".$grado."','".$seccion."','".$ano."')");
        return $data->result();
    }
    public function promediar($array, $id_prom)
    {
        $this->db->select('round(avg(nota),0) as nota')->from('relnotas')->where('id_nota in ('.$array.')');
        $query=$this->db->get()->row_array();

        $this->db->set($query)->where($id_prom)->update('relnotas');
    }


    public function reporteCantidadToral()
    {
        $this->db->select("count(*) as cantidad")->from("maepersona");
        return $this->db->get()->result() ;
    }
    public function reporteCantidadCur($data)
    {
        $this->db->distinct();
        $this->db->select("rl.id_curso as cantidad")->from("relnotas rl");
        $this->db->where(array('rl.id_grado'=>$data['id_grado'],'rl.id_seccion'=>$data['id_seccion'])) ;
        $this->db->where("rl.estado=1  and rl.id_curso!=0");
        $this->db->where('rl.ano', date('Y'))
                 ->order_by('rl.id_curso', 'asc');
        return $this->db->get()->result_object() ;
    }
    public function busquedaAsistencia($datos, $id_curso)
    {
        $this->db->select("count(id_alumno) as cantidad1,id_alumno")->from("asistencia_alumno");
        $this->db->where('id_alumno in ('.$datos.') and id_curso='.$id_curso.' and ano='.date('Y')) ;
        $this->db->group_by('id_alumno');
        return $this->db->get()->result_object() ;
    }
    public function buscarInfo()
    {
        $this->db->select("id,respuesta,id_grado,id_seccion,id_alumno,mensaje,fecha_val,fec_creacion")->from("asistencia_alumno_aux");
        $this->db->where('mensaje is not null  and ano='.date('Y')) ;
        $this->db->order_by('id_alumno', 'desc');
        return $this->db->get()->result_object() ;
    }
    public function buscarInfoG()
    {
        $this->db->select("id,respuesta,id_grado,id_seccion,id_alumno,mensaje,fecha_val,fec_creacion")->from("asistencia_alumno_aux");
        $this->db->where('mensaje is not null and date(fecha_val)=date(CURRENT_TIMESTAMP) and ano='.date('Y')) ;
        $this->db->order_by('id_alumno', 'desc');
        return $this->db->get()->result_object() ;
    }
    public function buscarInfoCantidad()
    {
        $this->db->select("count(*) as cantidad")->from("asistencia_alumno_aux");
        $this->db->where('mensaje is not null and ano='.date('Y')) ;
        $this->db->order_by('id_alumno', 'desc');
        return $this->db->get()->result_object() ;
    }
    public function buscarInfoCantidadRes()
    {
        $this->db->select("count(*) as cantidad")->from("asistencia_alumno_aux");
        $this->db->where('respuesta is not null and ano='.date('Y')) ;
        $this->db->order_by('id_alumno', 'desc');
        return $this->db->get()->result_object() ;
    }
    public function busquedaAsistenciaAux($datos)
    {
        $this->db->select("count(id_alumno) as cantidad1, id_alumno")->from("asistencia_alumno_aux");
        $this->db->where('id_alumno in ('.$datos.') and ano='.date('Y')) ;
        $this->db->group_by('id_alumno');
        $this->db->order_by('id_alumno', 'desc');
        return $this->db->get()->result_object() ;
    }
    public function busquedaAsistenciaP($datos, $id_curso)
    {
        $this->db->select("  count(id_alumno) as asistencia ")->from("asistencia_alumno");
        $this->db->where('id_alumno in ('.$datos.') and id_curso='.$id_curso.' and ano='.(int)date('Y').' and asistencia="p"') ;
        $this->db->group_by('id_alumno');
        return $this->db->get()->result_object() ;
    }
    public function busquedaAsistenciaPAux($datos)
    {
        $this->db->select(" id_alumno, count(*) as asistencia ")->from("asistencia_alumno_aux");
        $this->db->where('id_alumno in ('.$datos.') and ano='.(int)date('Y').' and asistencia="p"') ;
        $this->db->group_by('id_alumno');
        $this->db->order_by('id_alumno', 'desc');
        return $this->db->get()->result_object() ;
    }
    public function validacionFechaAlumno($data)
    {
        $this->db->select("  fecha_val as asistencia ")->from("asistencia_alumno");
        $this->db->where(array('id_curso'=>$data['id_curso'],'id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'])) ;
        return $this->db->get()->result_object() ;
    }
    public function validacionFechaAlumnoAux($data)
    {
        $this->db->select("  fecha_val as asistencia ")->from("asistencia_alumno_aux");
        $this->db->where(array('id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'])) ;
        return $this->db->get()->result_object() ;
    }
    public function buscarAlumnoasi($codigo, $curso)
    {
        $this->db->distinct();
        $this->db->select("id,ano,dia,mes,asistencia,fecha_val,mensaje,respuesta")->from("asistencia_alumno");
        $this->db->where('id_alumno='.$codigo.' and id_curso='.$curso.' and ano='.date('Y'))
                 ->order_by('ano,mes,dia', 'asc');
        return $this->db->get()->result_object() ;
    }
    public function comparacionAsistenciaCant()
    {
        $this->db->distinct();
        $this->db->select("count(*) as cantidad")
                 ->from("asistencia_alumno aa")
                 ->join("asistencia_alumno_aux aux", "on aa.id_alumno=aux.id_alumno and aa.id_grado=aux.id_grado and aa.id_seccion=aux.id_seccion and aa.ano=aux.ano")
                ->where("aa.asistencia!=aux.asistencia and aa.id_alumno is not null and date(aa.fecha_val)=date(CURRENT_TIMESTAMP) and date(aux.fecha_val)=date(CURRENT_TIMESTAMP)")
                 ->order_by("aa.fec_creacion", "desc");
        return $this->db->get()->result_object();
    }
    public function comparacionAsistenciaCantAzul()
    {
        $this->db->distinct();
        $this->db->select("count(aux.tipo_obs) as cantidad")
                 ->from("asistencia_alumno aa")
                 ->join("asistencia_alumno_aux aux", "on aa.id_alumno=aux.id_alumno and aa.id_grado=aux.id_grado and aa.id_seccion=aux.id_seccion and aa.ano=aux.ano")
                ->where("aa.asistencia!=aux.asistencia and aa.id_alumno is not null and date(aa.fecha_val)=date(CURRENT_TIMESTAMP) and date(aux.fecha_val)=date(CURRENT_TIMESTAMP)")
                 ->order_by("aa.fec_creacion", "desc");
        return $this->db->get()->result_object();
    }
    public function cantidadAsistenciaFalt()
    {
        $this->db->select("count(distinct re.id_grado,re.id_seccion)-(select count(distinct aux.id_grado,aux.id_seccion) from asistencia_alumno_aux aux where date(aux.fecha_val)=date(CURRENT_TIMESTAMP)) as resultado")
                 ->from("relaula re");
        return $this->db->get()->result_object();
    }
    public function comparacionAsistenciaTotal()
    {
        $this->db->distinct();
        $this->db->select("aa.fecha_val,aa.fec_creacion,aux.id as id,aa.id,aa.id_alumno,aa.id_grado as id_grado,aa.id_seccion as id_seccion,aa.id_curso as id_curso,aux.asistencia,aa.asistencia")
                 ->from("asistencia_alumno aa")
                 ->join("asistencia_alumno_aux aux", "on aa.id_alumno=aux.id_alumno and aa.id_grado=aux.id_grado and aa.id_seccion=aux.id_seccion and aa.ano=aux.ano")
                ->where("aa.asistencia!=aux.asistencia")
                 ->order_by("2", "desc");
        return $this->db->get()->result_object();
    }
    public function comparacionAsistencia()
    {
        $this->db->distinct();
        $this->db->select("aux.tipo_obs,aa.fecha_val,aa.fec_creacion,aux.id as id,aa.id_alumno,aa.id_grado as id_grado,aa.id_seccion as id_seccion,aa.id_curso as id_curso,aux.asistencia,aa.asistencia")
                 ->from("asistencia_alumno aa")
                 ->join("asistencia_alumno_aux aux", "on aa.id_alumno=aux.id_alumno and aa.id_grado=aux.id_grado and aa.id_seccion=aux.id_seccion and aa.ano=aux.ano ")
                ->where("aa.asistencia!=aux.asistencia AND date(aa.fecha_val)=date(CURRENT_TIMESTAMP)  AND date(aux.fecha_val)=date(CURRENT_TIMESTAMP)")
                 ->order_by("2", "desc");
        return $this->db->get()->result_object();
    }
    public function comparacionAsistenciaF()
    {
        $this->db->distinct();
        $this->db->select("aux.tipo_obs,aux.fecha_val,aa.fec_creacion,aux.id as id,aa.id_alumno,aa.id_grado as id_grado,aa.id_seccion as id_seccion,aa.id_curso as id_curso,aux.asistencia,aa.asistencia")
                 ->from("asistencia_alumno aa")
                 ->join("asistencia_alumno_aux aux", "on aa.id_alumno=aux.id_alumno and aa.fecha_val=aux.fecha_val and aa.id_grado=aux.id_grado and aa.id_seccion=aux.id_seccion and aa.ano=aux.ano ")
                ->where("aa.asistencia!=aux.asistencia and aa.ano=".date('Y'))
                 ->order_by("2", "desc");
        return $this->db->get()->result_object();
    }
    public function evasion_alumno($codigo)
    {
        $this->db->distinct();
        $this->db->select("aux.tipo_obs,aux.fecha_val,aa.fec_creacion,aux.id as id,aa.id_alumno,aa.id_grado as id_grado,aa.id_seccion as id_seccion,aa.id_curso as id_curso,aux.asistencia,aa.asistencia")
                 ->from("asistencia_alumno aa")
                 ->join("asistencia_alumno_aux aux", "on aa.id_alumno=aux.id_alumno and aa.fecha_val=aux.fecha_val and aa.id_grado=aux.id_grado and aa.id_seccion=aux.id_seccion and aa.ano=aux.ano ")
                ->where("aa.id_alumno=".$codigo." and tipo_obs!=2 and aa.asistencia!=aux.asistencia and aa.ano=".date('Y'))
                 ->order_by("2", "desc");
        return $this->db->get()->result_object();
    }
    public function inasistencia_alumno($codigo,$asistencia)
    {
        $this->db->distinct();
        $this->db->select("count(*) as asistencia")
                 ->from("asistencia_alumno_aux aux")
                ->where("aux.id_alumno=".$codigo." and aux.asistencia='".$asistencia."' and  aux.ano=".date('Y'));
        return $this->db->get()->row_array();
    }
    public function buscarAlumnoasiAux($codigo)
    {
        $this->db->distinct();
        $this->db->select("id,ano,dia,mes,asistencia,fecha_val,mensaje,
                CASE respuesta
                    WHEN 2 THEN 'SI'
                    WHEN 1 THEN 'NO'
                END
                as respuesta")->from("asistencia_alumno_aux");
        $this->db->where("id_alumno=".$codigo."    and asistencia='f'  and ano=".date('Y'))
                 ->order_by('ano,mes,dia', 'asc');
        return $this->db->get()->result_object() ;
    }
    public function buscarAlumnoasi2($codigo)
    {
        $this->db->distinct();
        $this->db->select("id,ano,dia,mes,asistencia,fecha_val,mensaje")->from("asistencia_alumno");
        $this->db->where('id_alumno='.$codigo.' and id_curso=1 and ano='.date('Y')) ;
        return $this->db->get()->result_object() ;
    }
    public function getClienteLocal($id)
    {
        $this->db->select(" * ")->from("webusuarios");
        $this->db->where('id =', $id) ;
        return $this->db->get()->result_object() ;
    }
    public function buscarGrados($id)
    {
        $this->db->select(" id,nom_grado,des_grado ")->from("maegrados");
        $this->db->where('id in ('.$id.')') ;
        return $this->db->get()->result_object() ;
    }
    public function busquedaNotas3($id, $curso)
    {
        $this->db->select("
                        re.id,
                        re.id_nota,
                        re.nota,
                        re.id_alumno,
                        re.id_bimestre,
                        ma.pe
                           ")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where('re.estado=1 and re.id_alumno in ('.$id.') and re.id_curso='.$curso.' and re.ano='.date('Y'))
                 ->order_by('1', 'asc') ;
        return $this->db->get()->result_object() ;
    }
    public function bimestre()
    {
        $this->db->distinct();
        $this->db->select("id_bimestre")->from("maenotas")->where("id_bimestre is not null")->order_by("id_bimestre", "asc");
        return $this->db->get()->result_object();
    }
    public function busquedaNotas5($id, $ano)
    {
        $this->db->select(" re.id,re.id_nota,re.nota,re.id_alumno,re.id_curso,ma.pe,ma.id_bimestre ")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id", 'left')
                 ->where('re.id_alumno in ('.$id.')  and re.ano='.$ano)
                 ->order_by('1', 'asc') ;
        return $this->db->get()->result_object() ;
    }

    public function buscarSecciones($id)
    {
        $this->db->select(" id,nom_seccion,des_seccion ")->from("maeseccion");
        $this->db->where('id in ('.$id.')')->order_by('nom_seccion', 'ASC')
                ;
        return $this->db->get()->result_object() ;
    }
    public function busquedaRespuesta()
    {
        $this->db->select(" id,nom_justificada ")->from("maerespjustificada")->order_by('id', 'ASC');
        return $this->db->get()->result_object() ;
    }
    public function validarObs($codigo)
    {
        $this->db->select("tipo_obs")->from("asistencia_alumno_aux")->where("id", $codigo);
        return $this->db->get()->result_object() ;
    }
    public function buscarBimestres($id)
    {
        $this->db->select(" id,nom_bimestre")->from("maebimestre");
        $this->db->where('ano in ('.$id.')') ;
        return $this->db->get()->result_object() ;
    }
    public function buscargradosAno($id)
    {
        $this->db->select("id,nom_grado,des_grado")->from("maegrados");
        $this->db->where('ano in('.$id.') ')
             ->order_by('2', 'asc');
        return $this->db->get()->result_array() ;
    }
    public function buscarCursos($id)
    {
        $this->db->select(" id,nom_cursos,des_cursos,cant_horas,cant_capacidades ")->from("maecursos");
        $this->db->where('id in ('.$id.')') ;
        return $this->db->get()->result_object() ;
    }
    public function buscarBimestre($id)
    {
        $this->db->select(" id,nom_bimestre,fecini_bimestre,fecfin_bimestre ")->from("maebimestre");
        $this->db->where('id in ('.$id.')') ;
        return $this->db->get()->result_object() ;
    }
    public function buscarNota($id)
    {
        $this->db->select(" id,nom_notas,des_notas,pes_notas ")->from("maenotas");
        $this->db->where('id in ('.$id.')') ;
        return $this->db->get()->result_object() ;
    }
    public function editarGradosa($datos, $id)
    {
        $data = array(
            'nom_grado'    => null,
            'des_grado'    => null
        );
        foreach ($datos as $tempKey => $tempVal) {
            if (array_key_exists($tempKey, $data)) {
                $data[$tempKey] = $tempVal;
            }
        }
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('maegrados');
        //    return $this->db->insert('WebUsuarios', $data);
    }
    public function editarSeccionesa($datos, $id)
    {
        $data = array(
            'nom_seccion'    => null,
            'des_seccion'    => null
        );
        foreach ($datos as $tempKey => $tempVal) {
            if (array_key_exists($tempKey, $data)) {
                $data[$tempKey] = $tempVal;
            }
        }
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('maeseccion');
        //    return $this->db->insert('WebUsuarios', $data);
    }
    public function editar_notificacion_bandeja()
    {
        $this->db->set(array('notificacion'=>1));
        $this->db->update('documentos_docentes');
    }
    public function editarCursosa($datos, $id)
    {

        $this->db->set($datos);
        $this->db->where('id', $id);
        $this->db->update('maecursos');
    }
    public function editarBimestresa($datos, $id)
    {
        $this->db->set($datos);
        $this->db->where('id', $id);
        $this->db->update('maebimestre');
    }
    public function editarNotasa($datos, $id)
    {
        $this->db->set($datos);
        $this->db->where('id', $id);
        $this->db->update('maenotas');
    }
    public function eliminarGradosa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('maegrados');
    }
    public function editarMateriales1($id)
    {
        $this->db->select('nom_archivo,descripcion')->from('documentos_docentes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function editarMateriales2($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('documentos_docentes');

        $this->db->select('nom_archivo')->from('documentos_docentes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function eliminarMateriales($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('documentos_docentes');
    }
    public function eliminarMaterialesAs($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('documentos_asistencia');
    }
    public function guardarMensajeAl($data, $cambio)
    {
        $this->db->set($cambio);
        $this->db->where(array('id_alumno'=>$data['id_alumno'],'fecha_val'=>$data['fecha_val']));
        $this->db->update('asistencia_alumno');
    }
    public function cambiarRespuesta($data, $grado, $seccion, $curso, $alumno, $fecha)
    {
        $this->db->set($data);
        $this->db->where('id_grado='.$grado.' and id_seccion='.$seccion.' and id_curso='.$curso.' and id_alumno='.$alumno.' and date(fecha_val) =\''.$fecha.'\'');
        $this->db->update('asistencia_alumno');
    }
    public function cambiarObservacion($data, $cambio)
    {
        $this->db->set($data);
        $this->db->where('id='.$cambio);
        $this->db->update('asistencia_alumno_aux');
    }
    public function cambiarObservacionProf($data, $grado, $seccion, $curso, $alumno, $fecha)
    {
        $this->db->set($data);
        $this->db->where('id_grado='.$grado.' and id_seccion='.$seccion.' and id_curso='.$curso.' and id_alumno='.$alumno.' and date(fecha_val) =\''.$fecha.'\'');
        $this->db->update('asistencia_alumno');
    }
    public function cambiarRespuestaA($data, $cambio)
    {
        $this->db->set($data);
        $this->db->where('id='.$cambio);
        $this->db->update('asistencia_alumno_aux');
    }
    public function cambiarRespuestaAux($data, $cambio)
    {
        $this->db->set($cambio);
        $this->db->where(array('fecha_val'=>$data['fecha_val'],'id_alumno'=>$data['codigo']));
        $this->db->update('asistencia_alumno');
    }
    public function guardarMensajeAlAux($data, $cambio)
    {
        $this->db->set($cambio);
        $this->db->where(array('id_alumno'=>$data['id_alumno'],'fecha_val'=>$data['fecha_val']));
        $this->db->update('asistencia_alumno_aux');
    }
    public function eliminarAulasa($cambio, $data)
    {
        $this->db->set($cambio);
        $this->db->where(array('id_curso'=>$data['curso'],'id_grado'=>$data['grado'],'id_seccion'=>$data['seccion']));
        $this->db->update('relaula');
    }
    public function buscarcodigonotas($data)
    {
        $this->db->select('id')->from('relnotas')->where($data);
        return $this->db->get()->row_array();
    }
    public function cambioNotas($cambio, $data)
    {
        $this->db->set($cambio);
        $this->db->where($data);
        $this->db->update('relnotas');
    }
    public function insertcambioNotas($data)
    {
        return  $this->db->insert('relnotas', $data);
    }

    public function buscarcambioNotas($data)
    {
        $this->db->distinct();
        $this->db->select('id_grado')
                 ->from('relnotas')
                 ->where(array('id_curso'=>$data['id_curso'],'id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'],'id_nota'=>$data['id_nota'],'id_alumno'=>$data['id_alumno'],'ano'=>$data['ano']));
        $this->db->where('estado=1');

        $query = $this->db->get();
        return $query->result();
    }
    public function cambioNotas2($cambio, $data)
    {
        $this->db->set($cambio);
        $this->db->where(array('id_curso'=>$data['id_curso'],'id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'],'id_nota'=>$data['id_nota'],'id_alumno'=>$data['id_alumno'],'ano'=>$data['ano']));
        $this->db->update('relnotas');
    }
    public function busquedaGradoProf($data)
    {
        $this->db->distinct();
        $this->db->select('id_grado')
                ->from('relaula')
                ->where(array('id_profesor'=>$data['profesor'],'ano'=>date('Y')));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function suma_notas($id_grado, $id_curso, $id_profesor, $id_nota)
    {
        $this->db->select('sum(peso) as acumulado')->from('rel_notas_detalle')->where('id_grado='.$id_grado.'  and id_curso='.$id_curso.' and id_profesor='.$id_profesor.' and id_nota in ('.$id_nota.') and estado=1 and ano='.date('Y'));
        return $this->db->get()->row_array();
    }
    public function validar_abreviacion($grado, $curso, $nota, $profesor, $ano, $abreviacion)
    {
        $this->db->distinct();
        $this->db->select('id')
        ->from('rel_notas_detalle')
        ->where('id_grado='.$grado.'  and id_curso='.$curso.' and id_nota in( '.$nota.') and id_profesor='.$profesor.' and estado=1 and ano='.$ano.' and abreviacion="'.$abreviacion.'"');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function mostrar_notas_alumnos($dato)
    {
        $this->db->distinct();
        $this->db->select("ma.des_notas as Capacidad,rnd.abreviacion as Evaluacion,rnd.descripcion AS Descripcion,concat(peso*100 ,'%') as Peso,round(sum(rnda.nota),2) as Nota,ma.id_bimestre as Bimestre,rnd.id ,mc.nom_cursos,ma.id as id_nota")
        ->from('rel_notas_detalle_alumno rnda')
        ->join('rel_notas_detalle rnd',' on rnda.id_nota=rnd.id')
        ->join('maenotas  ma'         ,' on rnd.id_nota =ma.id ')
        ->join('maecursos mc'         ,' on rnda.id_curso=mc.id')
        ->where('rnda.id_alumno='.$dato['id_alumno'].' and rnd.estado=1 and rnda.estado=1 and rnda.ano='.$dato['ano'].' and rnda.id_curso='.$dato['id_curso'].' and ma.id_bimestre='.$dato['id_bimestre'])
        ->group_by('ma.id,rnd.abreviacion,rnd.id,ma.des_notas,mc.nom_cursos')
        ->order_by('ma.des_notas,mc.nom_cursos,ma.id_bimestre,rnd.id,rnd.abreviacion');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function busqueda_profesor($data)
    {
        $this->db->distinct()
                ->select('id_profesor')
                ->from('relaula')
                ->where(array('ano'=>$data['ano'],'id_curso'=>$data['id_curso'],'id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion']))
                ->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function busquedaSeccion($data)
    {
        $this->db->distinct();
        $this->db->select('id_seccion')
                ->from('relaula')
                ->where('id_grado', $data);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function buscarmensaje($data)
    {
        $this->db->distinct();
        $this->db->select('mensaje')
                ->from('asistencia_alumno_aux')
                ->where('id='.$data);
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaGradoSeccion($data)
    {
        $this->db->distinct();
        $this->db->select('id_grado,id_seccion')
                ->from('relaulalumno')
                ->where(array('id_alumno'=>$data['id_alumno']));
        $this->db->where('ano='.date('Y'));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function busquedaAno($codigo)
    {
        $this->db->distinct();
        $this->db->select('ano')->from('relaulalumno')->where('id_alumno', $codigo)->order_by('ano', 'desc')->limit(1);
        return $this->db->get()->result();
    }
    public function busquedaGradoSeccion2($data, $ano)
    {
        $this->db->distinct();
        $this->db->select('id_grado,id_seccion')
                ->from('relaulalumno')
                ->where(array('id_alumno'=>$data));
        $this->db->where('ano='.$ano);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function busquedaSeccionProf($data)
    {
        $this->db->distinct();
        $this->db->select('id_seccion')
                ->from('relaula')
                ->where(array('id_profesor'=>$data['profesor'],'id_grado'=>$data['grado']));
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaCursoGradoProf($data)
    {
        $this->db->distinct();
        $this->db->select('id_curso')
                ->from('relaula')
                ->where(array('id_profesor'=>$data['profesor'],'id_grado'=>$data['grado'],'ano'=>date('Y')));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function busquedaCursoSeccionProf($data)
    {
        $this->db->distinct();
        $this->db->select('id_seccion')
                ->from('relaula')
                ->where('id_profesor='.$data['profesor'].' and id_grado='.$data['grado'].' and id_curso='.$data['curso'].' and ano='.date('Y'))
                ->order_by('id_seccion','asc');
        return $this->db->get()->result_array();

    }
    public function busquedaSeccionAux($data)
    {
        $this->db->distinct();
        $this->db->select('id_seccion')
                ->from('relaula')
                ->where(array('id_grado'=>$data['grado']));
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaCursoProf($data)
    {
        $this->db->distinct();
        $this->db->select('id_curso')
                ->from('relaula')
                ->where(array('id_profesor'=>$data['profesor'],'id_grado'=>$data['grado'],'id_seccion'=>$data['seccion']));
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaCursoAlu($data)
    {
        $this->db->distinct();
        $this->db->select('id_curso')
                ->from('relaula')
                ->where(array('id_grado'=>$data['grado'],'id_seccion'=>$data['seccion'],'ano'=>date('Y')));
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaCursoAlu2($data)
    {
        $this->db->distinct();
        $this->db->select('id_curso')
                ->from('relaula')
                ->where(array('id_grado'=>$data['grado'],'id_seccion'=>$data['seccion'],'ano'=>$data['ano']));
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaCurso($data)
    {
        $this->db->distinct();
        $this->db->select('id_curso')
                ->from('relaula')
                ->where(array('id_grado'=>$data['id_grado'],'id_seccion'=>$data['id_seccion'],'ano'=>$data['ano']));
        $query = $this->db->get();
        return $query->result();
    }

    public function busquedaAulas($data)
    {
        $this->db
                ->select('des_aula,id_profesor')
                ->from('relaula')
                ->where(array('id_curso'=>$data['curso'],'id_grado'=>$data['grado'],'id_seccion'=>$data['seccion']))
                ->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaAulasS($data)
    {
        $this->db->distinct()
                ->select('horario')
                ->from('relaula')
                ->where(array('id_curso'=>$data['curso'],'id_grado'=>$data['grado'],'id_seccion'=>$data['seccion']));
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaAulasD($data)
    {
        $this->db->distinct()
                ->select('dia')
                ->from('relaula')
                ->where(array('id_curso'=>$data['curso'],'id_grado'=>$data['grado'],'id_seccion'=>$data['seccion']));
        $query = $this->db->get();
        return $query->result();
    }
    public function eliminarCursosa($id)
    {
        //elimina cursos

        $this->db->where('id', $id);
        $this->db->delete('maecursos');
    }
    public function eliminarBimestresa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('maebimestre');
    }
    public function eliminarNotasa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('maenotas');
    }
    public function eliminarAulass($data)
    {
        $this->db->where(array('id_curso'=>(int)$data['curso'],'id_grado'=>(int)$data['grados'],'id_seccion'=>(int)$data['seccion']));
        $this->db->delete('relaula');
    }
    public function eliminarSeccionesa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('maeseccion');
    }
    public function busquedaProfesor($profesor)
    {
        $campo='ape_pat_per';
        $this->db->select('id')->from('maepersona')->where($campo.'=', $profesor)->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function busquedaTotal()
    {
        $this->db->select('mu.role_usuario as rol,count(*) as cantidad')
                 ->from('maepersona      ma')
                 ->join('maeusuarios     mu', ' on ma.id=mu.id_persona')
                 ->join('webusuariosrol  we', ' on mu.role_usuario=we.id')
                ->group_by('mu.role_usuario');
        return $this->db->get()->result_array() ;
    }
    public function busquedaDatos($codigo)
    {
        $this->db->select('
            ma.id           as codigo,
            ma.nom_per      as nombre,
            ma.ape_pat_per  as apepat,
            ma.ape_mat_per  as apemat,
            ma.ruta         as ruta  ,
            ma.direccion    as direcc,
            ma.documento    as docume,
            me.clav_usuario as claves,
            wu.titulo	    as usuari,
            mc.des_correo   as correo,
            mt.num_tel      as telefo,
            ma.fecha_nac    as fecha,
            me.role_usuario as user
                ')
                 ->from('maepersona ma')
                 ->join('maeusuarios    me', 'on ma.id=me.id_persona')
                 ->join('maecorreos     mc', 'on ma.id=mc.id_persona')
                 ->join('maetelefono    mt', 'on ma.id=mt.id_persona')
                 ->join('webusuariosrol wu', 'on me.role_usuario=wu.id')
                 ->where('ma.id', (int)$codigo)->limit(1);

        return $this->db->get()->result_object() ;
    }
    public function getHorarioss()
    {
        $this->db->select(" id as codigo, des_horario as horarios,turno as turnos");
        $this->db->from("maehorario");
        $this->db->order_by('id', 'ASC') ;
        return $this->db->get()->result_object() ;
    }
    public function getHorariossid($codigo)
    {
        $this->db->select(" id as codigo, des_horario as horarios,turno as turnos");
        $this->db->from("maehorario")->where("id", $codigo);
        $this->db->order_by('id', 'ASC') ;
        return $this->db->get()->result_object() ;
    }
    public function getDiass()
    {
        $this->db->select(" id as codigo, des_dia as dias");
        $this->db->from("maedias");
        $this->db->order_by('id', 'ASC') ;
        return $this->db->get()->result_object() ;
    }
    public function busquedaProfesorN($profesor)
    {
        $campo='id';
        $this->db->select('ape_pat_per as profesor')->from('maepersona')->where($campo.'=', $profesor)->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function busquedaAlumnoN($alumno)
    {
        $this->db->select('ape_pat_per as alumno,id ')->from('maepersona')->where("id in (".$alumno.")")->order_by("id", "asc");
        $this->db->order_by('1', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    public function busquedaBimestre()
    {
        $anio= date('Y');
        $this->db->distinct();
        $this->db->select('id,nom_bimestre,fecini_bimestre,fecfin_bimestre')->from('maebimestre')->where('ano', (int)$anio)->order_by('nom_bimestre', 'asc');
        return $this->db->get()->result_array();
    }
    public function busquedaBimestre2($anio)
    {
        $this->db->select('id,nom_bimestre')->from('maebimestre')->where('ano', (int)$anio)->order_by('nom_bimestre', 'asc');
        return $this->db->get()->result();
    }
    public function busquedaNotas($bimestre)
    {
        $this->db->select('id,nom_notas,des_notas')->from('maenotas')->where('id_bimestre='.$bimestre.' and estado=1 and ano='.date('Y'))->order_by('id', 'asc');
        return $this->db->get()->result();
    }
    public function busquedaNotas2($curso)
    {
        $this->db->distinct();
        $this->db->select("ma.id,ma.nom_notas,ma.des_notas,ma.id_bimestre,ma.pe")
                 ->from("maenotas ma")
                 ->join("relnotas rl", "on ma.id=rl.id_nota")
                 ->where("rl.estado=1 and ma.ano=".date('Y')."  and ma.estado=1 and ma.id_bimestre is not null and rl.id_curso=".$curso);
        $this->db->order_by("id_bimestre,id", "asc");
        return $this->db->get()->result();
    }
    public function busqueda_notas_config($curso)
    {#rl.id_bimestre seteado porque se sobre entiende que debe de cumplir para todos los trimestres
        $this->db->distinct();
        $this->db->select("ma.id,ma.nom_notas,ma.des_notas")
                 ->from("maenotas ma")
                 ->join("rel_curso_nota rl", "on ma.id=rl.id_nota")
                 ->where("rl.estado=1 and ma.ano=".date('Y')."     and rl.id_curso=".$curso)
                 ->order_by('ma.nom_notas', 'ASC');
        return $this->db->get()->result_array();
    }

    public function busquedaNotas6($ano)
    {
        $this->db->distinct();
        $this->db->select("ma.id,ma.nom_notas,ma.des_notas,ma.id_bimestre,ma.pe")
                 ->from("maenotas ma")
                 ->join("relnotas rl", "on ma.id=rl.id_nota")
                 ->where("ma.ano=".$ano."  and ma.estado=1 and ma.id_bimestre is not null ");
        $this->db->order_by("id_bimestre,id", "asc");
        return $this->db->get()->result();
    }
    public function busquedaCurs($curso)
    {
        $campo='nom_cursos';
        $this->db->select('id')->from('maecursos')->where($campo, $curso)->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaSecc($seccion)
    {
        $campo='nom_seccion';
        $this->db->select('id')->from('maeseccion')->where($campo, $seccion)->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    public function busquedaGrado($grado)
    {
        $campo='nom_grado';
        $this->db->select('id')->from('maegrados')->where($campo, $grado)->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertAsitencia($datos)
    {
        return  $this->db->insert('asistencia_alumno', $datos);
    }
    public function insertAsitenciaAux($datos)
    {
        return  $this->db->insert('asistencia_alumno_aux', $datos);
    }
    public function GuardarArchivoProf($datos)
    {
        return  $this->db->insert('documentos_docentes', $datos);
    }
    public function GuardarArchivoAsis($datos)
    {
        return  $this->db->insert('documentos_asistencia', $datos);
    }
    public function registrarAula($datos)
    {
        return  $this->db->insert('relaula', $datos);
    }
    public function insertarPersona($datos)
    {
        $this->db->insert('maepersona', $datos);
    }
    public function insertarCorreoss($datos)
    {
        $this->db->insert('maecorreos', $datos);
    }
    public function insertarTelefono($datos)
    {
        $this->db->insert('maetelefono', $datos);
    }
    public function insertarUsuarios($datos)
    {
        $this->db->insert('maeusuarios', $datos);
    }
    public function insertarAlumno($datos)
    {
        $this->db->insert('relaulalumno', $datos);
    }
    public function insertarrelnotas($datos)
    {
        $this->db->insert('relnotas', $datos);
    }
    public function recuperPersona()
    {
        $this->db->select("id");
        $this->db->from("maepersona");
        $this->db->order_by("1", "desc");
        $this->db->limit(1);

        return  $this->db->get()->result_object() ;
    }
    public function notificacion_repositorio($data)
    {
        $this->db->distinct();
        $this->db->select("count(*) as cantidad");
        $this->db->from("documentos_docentes ")
                 ->where('id_grado='.$data['id_grado'].' and id_seccion='.$data['id_seccion'].' and ano='.date('Y').' and notificacion=0');
        return  $this->db->get()->row_array() ;
    }
    public function cambio_clave($datos,$id)
    {

       return $this->db->set($datos)->where('id_persona', $id)->update('maeusuarios');
    }
    public function user_correo($dni)
    {
        $this->db->distinct();
        $this->db->select("ma.id,mc.des_correo,ma.ape_pat_per as usuario,mu.clav_usuario");
        $this->db->from("maepersona ma")
                 ->join('maecorreos mc','on ma.id=mc.id_persona')
                 ->join('maeusuarios mu','on ma.id=mu.id_persona')
                 ->where('ma.documento="'.$dni.'"');

        return  $this->db->get()->row_array() ;
    }
    public function setPermiso($permisos, $ultimo)
    {
        $usuario=(int)$ultimo+1;

        for ($i=0;$i<count($permisos);$i++) {
            $data = array(
            'WebUsuarios_id' => $usuario ,
            'WebModulos_id' => $permisos[$i],
            'permiso' => 1
        );
            $this->db->insert('webusuariopermisos', $data);
        }
    }
    public function busquedaRol($rolhijo)
    {
        $this->db->select(" webusuariosrol_id,nombre ")->from("webusuariosrolhijo");
        $this->db->where('id', $rolhijo) ;
        return $this->db->get()->result_object() ;
    }
    public function ultimoIdNotas()
    {
        $this->db->select("id")->from("maenotas")->order_by('id', 'desc')->limit(1);
        return $this->db->get()->result_object();
    }
    public function cantidadXbimestre15()
    {
        $this->db->select("id_bimestre,count(*) as cantidad")->from("maenotas")->group_by("id_bimestre")->order_by("id_bimestre", "desc")->limit(1);
        return $this->db->get()->result_object();
    }
    public function cantidadXbimestre($curso)
    {
        $this->db->select("count(*) as cantidad")
                 ->from("maenotas ma")
                 ->join("relnotas re", "on ma.id=re.id_nota")
                 ->where("re.estado=1 and re.id_curso=".$curso." and ma.pe is  null and re.id_bimestre is not null")
                  ->group_by("re.id_alumno,re.id_bimestre")->limit(1);
        return $this->db->get()->result_object();
    }
    public function cantidadXbimestre2($curso)
    {
        $this->db->distinct();
        $this->db->select("ma.id_bimestre,count(*) as cantidad")
                 ->from("maenotas ma")
                 ->join("relnotas rl", "on ma.id=rl.id_nota")
                 ->where("rl.ano=".date('Y')." and rl.estado=1 and  ma.pe is null and ma.id_bimestre is not null and rl.id_curso=".$curso['id_curso'])
                 ->group_by("ma.id_bimestre,ma.pe,rl.id_alumno,rl.id_curso")
                 ->order_by("ma.id_bimestre", "desc")
                 ->limit(1);
        return $this->db->get()->result_object();
    }
    public function promedioEvaluacion($bimestre, $alumno, $curso, $numero)
    {
        $this->db->select("sum(re.nota)/".$numero." as suma")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where("re.estado=1 and ma.pe is null and re.id_bimestre=".$bimestre." and re.id_alumno=".$alumno.' and re.id_curso='.$curso);
        $valor= $this->db->get()->result_object();
        // print_r($valor);
        $this->db->select("re.id as codigo")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where("re.estado=1 and ma.pe is not null and re.id_bimestre=".$bimestre." and re.id_alumno=".$alumno.' and re.id_curso='.$curso);
        $valor2= $this->db->get()->result_object();
        $arrayCambio= array('nota'=>$valor[0]->suma);
        $this->db->set($arrayCambio)->where("id", $valor2[0]->codigo)->update("relnotas");

        $valor3= $this->validacion2($alumno, $curso);
        $valor4= $this->validacion3($alumno, $curso);
        $this->db->select("re.id as codigo")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where("re.estado=1 and ma.pe is not null and re.id_bimestre is null and re.id_alumno=".$alumno.' and re.id_curso='.$curso);
        $valor5=$this->db->get()->result_object();

        if ($valor3[0]->cantidad10==$valor4[0]->cantidad10) {
            $promedioFinal=$this->promedioFinal($alumno, $valor4[0]->cantidad10, $curso);

            $arrayCambio10= array('nota'=>$promedioFinal[0]->suma);

            $this->db->set($arrayCambio10)->where("id", $valor5[0]->codigo)->update("relnotas");
        } else {
            $valor10="";
        }
    }
    public function promedioFinal($alumno, $contador, $curso)
    {
        $this->db->select("sum(re.nota)/".$contador." as suma")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where("re.estado=1 and ma.pe is not null and re.id_bimestre is not null   and re.id_alumno=".$alumno.' and re.id_curso='.$curso);
        return $this->db->get()->result_object();
    }
    public function validacion($bimestre, $alumno, $curso)
    {
        $this->db->select("count(*) as cantidad10")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where("re.estado=1 and ma.pe is null and re.nota is not null   and re.id_bimestre=".$bimestre." and re.ano=".date('Y')." and re.id_alumno=".$alumno.' and re.id_curso='.$curso);
        return $this->db->get()->result_object();
    }
    public function validacion2($alumno, $curso)
    {
        $this->db->select("count(*) as cantidad10")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where("re.estado=1 and ma.pe is not null and re.nota is not null and re.id_bimestre is not null and re.ano=".date('Y').' and re.id_alumno='.$alumno.' and re.id_curso='.$curso);
        return $this->db->get()->result_object();
    }
    public function validacion3($alumno, $curso)
    {
        $this->db->distinct();
        $this->db->select("count(*) as cantidad10")
                 ->from("relnotas re")
                 ->join("maenotas ma", "on re.id_nota=ma.id")
                 ->where("re.estado=1 and ma.pe is not null and re.id_bimestre is not null and re.ano=".date('Y')." and re.id_alumno=".$alumno.' and re.id_curso='.$curso);
        return $this->db->get()->result_object();
    }

    public function buscardatosusu($codigo)
    {
        $this->db->distinct();
        $this->db->select(
            '
                                ma.id           as CODIGO,
                                ma.nom_per      as NOMBRE,
                                ma.ape_pat_per  as APEPAT,
                                ma.ape_mat_per  as APEMAT,
                                ma.documento    as DOCUME,
                                ma.direccion    as DIRECC,
                                ma.descripcion  as DESCRI,
                                ma.estado       as ESTADO,
                                mc.des_correo   as CORREO,
                                mu.nom_usuario  as USUARI,
                                mu.clav_usuario as CLAVES,
                                mu.role_usuario as USUARR,
                                mt.num_tel      as TELEFO
                            '
                )
                ->from('maepersona  ma')
                ->join('maecorreos  mc', 'mc on ma.id=mc.id_persona')
                ->join('maeusuarios mu', 'mu on ma.id=mu.id_persona')
                ->join('maetelefono mt', 'ma.id=mt.id_persona')
                ->where('ma.id', $codigo)
                ->order_by('1', 'desc');
        return $this->db->get()->result_object();
    }
    public function SetEmpresa($datos)
    {
        $data = array(
            'webusuario_id'          => null,
            'nombreLocal'            => null,
            'tipolocal_id'           => null,
            'direccion'              => null,
            'descripcion'            => null,
            'usuarioCreacion'        => null
        );
        foreach ($datos as $tempKey => $tempVal) {
            if (array_key_exists($tempKey, $data)) {
                $data[$tempKey] = $tempVal;
            }
        }
        return $this->db->insert('empresa', $data);
    }
    public function Update($datos, $id)
    {
        $data = array(
            'nombre'    => null,
            'documento' => null,
            'usuario'   => null,
            'pass'      => null,
            'email'     => null
        );


        foreach ($datos as $tempKey => $tempVal) {
            if (array_key_exists($tempKey, $data)) {
                $data[$tempKey] = $tempVal;
            }
        }
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('webusuarios');
        //    return $this->db->insert('WebUsuarios', $data);
    }

    public function CheckList($datos)
    {
        return $this->db->select(" * ")->from("maepersona ")
                ->where($datos)->get()->result_object();
    }
}
