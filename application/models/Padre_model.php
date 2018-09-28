<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Padre_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function consultar_hijos($cod_apoderado)
    {
        return
                $this->db->select('
                    ma.ape_pat_per,mu.nom_usuario,ma.id as codigo,ma.ruta
                      ')
                ->from('maepersona  ma')
                ->join('maeusuarios mu', 'ma.id=mu.id_persona')
                ->where(array('ma.cod_apoderado'=>$cod_apoderado))
                ->get()->result_array()  ;
    }
}
?>