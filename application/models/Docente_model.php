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
         return $this->db->count_all('rel_notas_detalle_alumno');

    }
    public function busqueda_notas_cantidad($busqueda){
        $this->db->distinct();
        $this->db->select('ma.nom_notas as label,count(rnd.abreviacion)+1 as colspan')
                 ->from('maenotas ma')
                 ->join('rel_notas_detalle rnd', 'on ma.id=rnd.id_nota')
                 ->where('     rnd.ano               ='.$busqueda['ano'].'
                               and rnd.id_grado      ='.$busqueda['id_grado'].'
                               and rnd.id_curso      ='.$busqueda['id_curso'].'
                               and rnd.id_seccion    ='.$busqueda['id_seccion'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1
                               and rnd.id_profesor   ='.$busqueda['id_profesor'])
                ->group_by("ma.nom_notas");
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
                   and id_profesor   ='.$profesor)        ;
        return $this->db->get()->result_array() ;
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
                               and rnd.id_seccion    ='.$busqueda['id_seccion'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1
                               and rnd.id_profesor   ='.$busqueda['id_profesor'])
                ->order_by("rnd.id_nota", "asc")                    ;
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
                               and rnd.id_seccion    ='.$busqueda['id_seccion'].'
                               and ma.id_bimestre    ='.$busqueda['id_bimestre'].'
                               and rnd.estado        = 1
                               and rnd.id_profesor   ='.$busqueda['id_profesor'])          ;
        return $this->db->get()->result_array() ;
    }
    public function crosstabcantidad($busqueda)
    {
        $sql="";
        switch ($busqueda['id_bimestre']) {
            case 1:
                $sql2="
                        coalesce(SUM(C_1),0)  AS C_1,
                        coalesce(SUM(C_2),0)  AS C_2,
                        coalesce(SUM(C_3),0)  AS C_3,
                        coalesce(SUM(C_4),0)  AS C_4,
                        coalesce(SUM(C_5),0)  AS C_5,
                        coalesce(SUM(C_16),0)  AS P_P,
                        coalesce(SUM(a),\"\")  AS C1,
                        coalesce(SUM(b),\"\")  AS C2,
                        coalesce(SUM(c),\"\")  AS C3,
                        coalesce(SUM(d),\"\")  AS C4,
                        coalesce(SUM(e),\"\")  AS C5,
                        concat('=IF(COUNT(B',@i := @i + 1 ,':F',@i,')>0;ROUND(average(B',@i,':F',@i,');0);\"\")') AS PT";
                break;
            case 2:
                $sql2="
                        coalesce(SUM(C_6),0)  AS C_1,
                        coalesce(SUM(C_7),0)  AS C_2,
                        coalesce(SUM(C_8),0)  AS C_3,
                        coalesce(SUM(C_9),0) AS C_4,
                        coalesce(SUM(C_10),0) AS C_5,
                        coalesce(SUM(C_17),0) AS P_P,
                        coalesce(SUM(g),\"\")  AS C1,
                        coalesce(SUM(i),\"\")  AS C2,
                        coalesce(SUM(j),\"\")  AS C3,
                        coalesce(SUM(k),\"\")  AS C4,
                        coalesce(SUM(l),\"\") AS C5,
                        concat('=IF(COUNT(B',@x := @x + 1,':F',@x,')>0;ROUND(average(B',@x,':F',@x,');0);\"\")') AS PT";
                break;
            case 3:
                $sql2="
                        coalesce(SUM(C_11),0) AS C_1,
                        coalesce(SUM(C_12),0) AS C_2,
                        coalesce(SUM(C_13),0) AS C_3,
                        coalesce(SUM(C_14),0) AS C_4,
                        coalesce(SUM(C_15),0) AS C_5,
                        coalesce(SUM(C_18),0) AS P_P,
                        coalesce(SUM(n),\"\") AS C1,
                        coalesce(SUM(o),\"\") AS C2,
                        coalesce(SUM(p),\"\") AS C3,
                        coalesce(SUM(q),\"\") AS C4,
                        coalesce(SUM(r),\"\") AS C5,
                        concat('=IF(COUNT(B',@y := @y + 1,':F',@y,')>0;ROUND(average(B',@y,':F',@y,');0);\"\")') as PT";
                break;

        }

        $sql.="
                SELECT
                rl4.id_alumno AS id_alumno,ma.ape_pat_per as ape_pat_per,".$sql2."
                FROM(SELECT
                rl3.id_alumno,rl3.id_bimestre,rl3.id_nota,
                CASE WHEN rl3.capacidades='C1' then  rl3.id	END AS 'C_1',
                CASE WHEN rl3.capacidades='C2' then  rl3.id	END AS 'C_2',
                CASE WHEN rl3.capacidades='C3' then  rl3.id	END AS 'C_3',
                CASE WHEN rl3.capacidades='C4' then  rl3.id	END AS 'C_4',
                CASE WHEN rl3.capacidades='C5' then  rl3.id	END AS 'C_5',
                CASE WHEN rl3.capacidades='C6' then  rl3.id	END AS 'C_6',
                CASE WHEN rl3.capacidades='C7' then  rl3.id	END AS 'C_7',
                CASE WHEN rl3.capacidades='C8' then  rl3.id	END AS 'C_8',
                CASE WHEN rl3.capacidades='C9' then  rl3.id	END AS 'C_9',
                CASE WHEN rl3.capacidades='C10' then  rl3.id	END AS 'C_10',
                CASE WHEN rl3.capacidades='C11' then  rl3.id	END AS 'C_11',
                CASE WHEN rl3.capacidades='C12' then  rl3.id	END AS 'C_12',
                CASE WHEN rl3.capacidades='C13' then  rl3.id	END AS 'C_13',
                CASE WHEN rl3.capacidades='C14' then  rl3.id	END AS 'C_14',
                CASE WHEN rl3.capacidades='C15' then  rl3.id	END AS 'C_15',
                CASE WHEN rl3.capacidades='PRIMER TRIMESTRE'  then  rl3.id	END AS 'C_16',
                CASE WHEN rl3.capacidades='SEGUNDO TRIMESTRE' then  rl3.id	END AS 'C_17',
                CASE WHEN rl3.capacidades='TERCER TRIMESTRE'  then  rl3.id	END AS 'C_18',
                CASE WHEN rl3.capacidades='PROMEDIO FINAL'  then  rl3.id	END AS 'C_19'	,
                CASE WHEN rl3.capacidades='C1' then  rl3.total  END AS 'a',
                CASE WHEN rl3.capacidades='C2' then  rl3.total  END AS 'b',
                CASE WHEN rl3.capacidades='C3' then  rl3.total  END AS 'c',
                CASE WHEN rl3.capacidades='C4' then  rl3.total  END AS 'd',
                CASE WHEN rl3.capacidades='C5' then  rl3.total  END AS 'e',
                CASE WHEN rl3.capacidades='C6' then  rl3.total  END AS 'f',
                CASE WHEN rl3.capacidades='C7' then  rl3.total  END AS 'g',
                CASE WHEN rl3.capacidades='C8' then  rl3.total  END AS 'i',
                CASE WHEN rl3.capacidades='C9' then  rl3.total  END AS 'j',
                CASE WHEN rl3.capacidades='C10' then  rl3.total END AS 'k',
                CASE WHEN rl3.capacidades='C11' then  rl3.total END AS 'l',
                CASE WHEN rl3.capacidades='C12' then  rl3.total END AS 'm',
                CASE WHEN rl3.capacidades='C13' then  rl3.total END AS 'n',
                CASE WHEN rl3.capacidades='C14' then  rl3.total END AS 'o',
                CASE WHEN rl3.capacidades='C15' then  rl3.total END AS 'p',
                CASE WHEN rl3.capacidades='PRIMER TRIMESTRE'  then  rl3.total   END AS 'q',
                CASE WHEN rl3.capacidades='SEGUNDO TRIMESTRE' then  rl3.total   END AS 'r',
                CASE WHEN rl3.capacidades='TERCER TRIMESTRE'  then  rl3.total   END AS 's',
                CASE WHEN rl3.capacidades='PROMEDIO FINAL'  then  rl3.total END AS 't'
                FROM(
                SELECT rl2.id,rl2.id_alumno, capacidades,rl2.nota total,rl2.id_bimestre,rl2.id_nota  FROM(
                SELECT id,id_alumno,nota,id_nota,id_bimestre,id_curso,
                CASE WHEN id_nota=3 then  'C1'
                     WHEN id_nota=6 then  'C2'
                     WHEN id_nota=9 then  'C3'
                     WHEN id_nota=12 then 'C4'
                     WHEN id_nota=15 then 'C5'
                     WHEN id_nota=16 then 'PRIMER TRIMESTRE'
                     WHEN id_nota=2 then  'C6'
                     WHEN id_nota=5 then  'C7'
                     WHEN id_nota=8 then  'C8'
                     WHEN id_nota=11 then 'C9'
                     WHEN id_nota=14 then 'C10'
                     WHEN id_nota=17 then 'SEGUNDO TRIMESTRE'
                     WHEN id_nota=1 then  'C11'
                     WHEN id_nota=4 then  'C12'
                     WHEN id_nota=7 then  'C13'
                     WHEN id_nota=10 then 'C14'
                     WHEN id_nota=13 then 'C15'
                     WHEN id_nota=18 then 'TERCER TRIMESTRE'
                     WHEN id_nota=19 then 'PROMEDIO FINAL' ELSE NULL END AS 'capacidades'
                FROM relnotas  where id_grado=".$busqueda['id_grado']." and id_seccion=".$busqueda['id_seccion']." and id_curso=".$busqueda['id_curso']."  and ano=".date('Y')."
                ) rl2 WHERE rl2.id_nota in (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19)
                )rl3)rl4 inner join maepersona ma on rl4.id_alumno=ma.id cross join (select @i := 0,@y := 0,@x := 0,@z := 0) r

           ";
        $sql.=' group by rl4.id_alumno';



        return $this->db->query($sql)->result_array();
    }
}
