<?php
class wip_entree_gaines_imprimer_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_wip_entree_gaines_imprimer($param = array())
    {
        return $this->db->where($param)->get('wip_entree_gaines_imprimer')->result_object();
    }
    public function get_detail_wip_entree_gaines_imprimer($param)
    {
        return $this->db->where($param)->get('wip_entree_gaines_imprimer')->row_object();
    }
    public function insert_data_wip_entree_gaines_imprimer($data)
    {
        return $this->db->insert('wip_entree_gaines_imprimer', $data);
    }
    public function update_date_wip_entree_gaines_imprimer($param, $data)
    {
        return $this->db->where($param)->update('wip_entree_gaines_imprimer', $data);
    }
    public function delete_date_wip_entree_gaines_imprimer($param)
    {
        return $this->db->where($param)->delete('wip_entree_gaines_imprimer');
    }
}



