<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Docente_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function registrar_nueva_configuracion($save_informacion)
    {
         $this->db->insert('rel_notas_detalle', $save_informacion);
         return $this->db->insert_id();
    }
    public function registrar_nuevo_regstro_notas($save_informacion)
    {
         $this->db->insert('rel_notas_detalle_alumno', $save_informacion);


    }
    public function busqueda_notas_cantidad($busqueda){
        $this->db->distinct();
        $this->db->select('ma.nom_notas as label,count(rnd.abreviacion)+1 as colspan')
                 ->from('maenotas ma')
                 ->join('rel_notas_detalle rnd', 'on ma.id=rnd.id_nota')
                 ->where('     rnd.ano               ='.$busqueda['ano'].'
                               and rnd.id_grado      ='.$busqueda['id_grado'].'
                               and rnd.id_curso      ='.$busqueda['id_curso'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1
                               and rnd.id_profesor   ='.$busqueda['id_profesor'])
                ->group_by("ma.nom_notas")
                ->order_by("ma.nom_notas");
        return $this->db->get()->result_array() ;
    }
    public function busqueda_notas_configuradas($grado, $curso, $nota, $profesor, $ano)
    {
        $this->db->distinct();
        $this->db->select('abreviacion,descripcion,peso')
                 ->from('rel_notas_detalle')
                 ->where('
                       ano           ='.$ano.'
                   and id_grado      ='.$grado.'
                   and id_curso      ='.$curso.'
                   and id_nota       in ('.$nota.')
                   and estado= 1
                   and id_profesor   ='.$profesor);
                  // ->order_by("ma.nom_notas")
        return $this->db->get()->result_array() ;
    }
    public function busqueda_notas_configuradas_id($grado, $curso, $abreviacion, $profesor, $ano)
    {
        $this->db->distinct();
        $this->db->select('id')
                 ->from('rel_notas_detalle')
                 ->where('
                       ano           ='.$ano.'
                   and id_grado      ='.$grado.'
                   and id_curso      ='.$curso.'
                   and abreviacion   ="'.$abreviacion.'"
                   and estado= 1
                   and id_profesor   ='.$profesor);
                  // ->order_by("ma.nom_notas")
        return $this->db->get()->result_array() ;
    }
    public function busqueda_notas_configuradas_abreviacion($grado, $curso, $abreviacion, $profesor, $ano)
    {
        $this->db->distinct();
        $this->db->select('rnd.abreviacion,ma.nom_notas')
                 ->from('maenotas ma')
                 ->join('rel_notas_detalle rnd', 'on ma.id=rnd.id_nota')
                 ->where('     rnd.ano               ='.$ano.'
                               and rnd.id_grado      ='.$grado.'
                               and rnd.id_curso      ='.$curso.'
                               and rnd.estado        = 1
                               and rnd.abreviacion   ="'.$abreviacion.'"
                               and rnd.id_profesor   ='.$profesor
    );
        return $this->db->get()->result_array() ;
    }
    public function formulario_capacidades($grado,$nota,$profesor,$ano,$curso){
        $this->db->distinct();
        $this->db->select('ma.des_notas,concat(rd.abreviacion," * ",rd.peso) as form')
                 ->from('rel_notas_detalle rd')
                 ->join('maenotas ma','on rd.id_nota = ma.id')
                 ->where('rd.id_grado='.$grado.' and rd.id_nota in ('.$nota.') and rd.id_profesor='.$profesor.' and rd.estado=1 and rd.ano='.$ano.' and rd.id_curso='.$curso)
                 ->order_by('form','asc');
                 return $this->db->get()->result_array();
    }
    public function head($busqueda)
    {
        $this->db->distinct();
        $this->db->select('ma.id_bimestre, ma.nom_notas,rnd.abreviacion,rnd.id_nota')
                 ->from('maenotas ma')
                 ->join('rel_notas_detalle rnd', 'on ma.id=rnd.id_nota')
                 ->where('     rnd.ano               ='.$busqueda['ano'].'
                               and rnd.id_grado      ='.$busqueda['id_grado'].'
                               and rnd.id_curso      ='.$busqueda['id_curso'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1
                               and rnd.id_profesor   ='.$busqueda['id_profesor'])
                ->order_by("rnd.id_nota,rnd.abreviacion", "asc")                    ;
        return $this->db->get()->result_array() ;
    }
    public function head_validacion($busqueda)
    {
        $this->db->distinct();
        $this->db->select('ma.nom_notas')
                 ->from('maenotas ma')
                 ->join('rel_notas_detalle rnd', 'on ma.id=rnd.id_nota')
                 ->where('     rnd.ano               ='.$busqueda['ano'].'
                               and rnd.id_grado      ='.$busqueda['id_grado'].'
                               and rnd.id_curso      ='.$busqueda['id_curso'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1
                               and rnd.id_profesor   ='.$busqueda['id_profesor'])
                               ->order_by("ma.nom_notas")    ;
        return $this->db->get()->result_array() ;
    }
    public function cambiar_nota($id_nota,$nota)
    {
        $this->db->set($nota);
        $this->db->where('id', $id_nota);
        $this->db->update('rel_notas_detalle_alumno');
    }
    public function busqueda_id_nota($codigo_alumno,$string_id_notas,$estado,$ano)
    {
        $this->db->distinct();
        $this->db->select('id')
                 ->from('rel_notas_detalle_alumno')
                 ->where('      id_alumno='.$codigo_alumno.'
                          and   id_nota in ('.$string_id_notas.')
                          and   ano='.$ano.'
                          and   estado='.$estado);
                return $this->db->get()->result_array() ;
    }
    public function busqueda_id_notas($list_datos)
    {
        $this->db->distinct();
        $this->db->select('rl.id,rl.abreviacion,rl.id_nota')
                 ->from('rel_notas_detalle rl')
                 ->join('maenotas ma'  , 'rl.id_nota=ma.id')
                 ->where('     rl.ano               ='.$list_datos['ano'].'
                               and rl.id_grado      ='.$list_datos['id_grado'].'
                               and rl.id_curso      ='.$list_datos['id_curso'].'
                               and ma.id_bimestre    ='.$list_datos['id_bimestre'].'
                               and rl.estado        = 1 '.'
                               and rl.id_profesor   ='.$list_datos['id_profesor'])
                 ->order_by('rl.id_nota,rl.abreviacion')                        ;
        return $this->db->get()->result_array() ;

    }
    public function detalle_alumno($busqueda,$valor)
    {

        if($valor==true){
            $concatenar=' and rnd.id_alumno='.$busqueda['id_alumno'];
            $mostrar='rnd.id_nota,rnd.nota,rnd.id,rn.abreviacion,rn.id_nota,';
        }else{
            $concatenar=' ';
            $mostrar=' ';
        }

        $this->db->distinct();
        $this->db->select($mostrar.'mp.ape_pat_per,rnd.id_alumno,rnd.id_curso,ma.id_bimestre,rnd.id_seccion,rnd.id_grado,rn.id_profesor,rnd.ano')
                 ->from('rel_notas_detalle_alumno rnd')
                 ->join('rel_notas_detalle rn'  , 'rnd.id_nota=rn.id')
                 ->join('maenotas ma'           ,'rn.id_nota=ma.id')
                 ->join('maepersona mp'         ,'rnd.id_alumno=mp.id')
                 ->where('     rnd.ano               ='.$busqueda['ano'].'
                               and rnd.id_grado      ='.$busqueda['id_grado'].'
                               and rnd.id_seccion    ='.$busqueda['id_seccion'].'
                               and rnd.id_curso      ='.$busqueda['id_curso'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1 '.$concatenar.'
                               and rn.estado        = 1 '.$concatenar.'
                               and rn.id_profesor   ='.$busqueda['id_profesor'])          ;

                               if($valor==true){
                                $this->db->order_by('rn.id_nota,rn.abreviacion');
                            }
        return $this->db->get()->result_array() ;

    }
    public function detalle_alumno_peso($busqueda,$alumno)
    {




        $this->db->select('rnd.id_alumno,rn.peso')
                 ->from('rel_notas_detalle_alumno rnd')
                 ->join('rel_notas_detalle rn'  , 'rnd.id_nota=rn.id')
                 ->join('maenotas ma'           ,'rn.id_nota=ma.id')
                 ->join('maepersona mp'         ,'rnd.id_alumno=mp.id')
                 ->where('     rnd.ano               ='.$busqueda['ano'].'
                               and rnd.id_grado      ='.$busqueda['id_grado'].'
                               and rnd.id_seccion    ='.$busqueda['id_seccion'].'
                               and rnd.id_curso      ='.$busqueda['id_curso'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.id_alumno    ='.$alumno.'
                               and rnd.estado        = 1
                               and rn.estado        = 1
                               and rn.id_profesor   ='.$busqueda['id_profesor'])
                               ->order_by("ma.nom_notas");

        return $this->db->get()->result_array() ;

    }
    public function detalle_alumno_cantidad($busqueda)
    {

        $this->db->distinct();
        $this->db->select('ma.id,ma.nom_notas,count(*) as cantidad')
                 ->from('rel_notas_detalle_alumno rnd')
                 ->join('rel_notas_detalle rn'  , 'rnd.id_nota=rn.id')
                 ->join('maenotas ma'           ,'rn.id_nota=ma.id')
                 ->join('maepersona mp'         ,'rnd.id_alumno=mp.id')
                 ->where('     rnd.ano               ='.$busqueda['ano'].'
                               and rnd.id_grado      ='.$busqueda['id_grado'].'
                               and rnd.id_seccion    ='.$busqueda['id_seccion'].'
                               and rnd.id_curso      ='.$busqueda['id_curso'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1 '.'
                               and rn.estado         = 1 '.'
                               and rn.id_profesor    ='.$busqueda['id_profesor'])
                ->group_by('ma.id,rnd.id_alumno,ma.nom_notas')
                ->order_by('ma.nom_notas','asc');
        return $this->db->get()->result_array() ;

    }
}