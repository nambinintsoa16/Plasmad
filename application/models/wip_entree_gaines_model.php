<?php
class wip_entree_gaines_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_wip_entree_gaines($param = array())
    {
        return $this->db->where($param)->get('wip_entree_gaines')->result_object();
    }
    public function get_detail_wip_entree_gaines($param)
    {
        return $this->db->where($param)->get('wip_entree_gaines')->row_object();
    }
    public function insert_data_wip_entree_gaines($data)
    {
        return $this->db->insert('wip_entree_gaines', $data);
    }
    public function update_date_wip_entree_gaines($param, $data)
    {
        return $this->db->where($param)->update('wip_entree_gaines', $data);
    }
    public function delete_date_wip_entree_gaines($param)
    {
        return $this->db->where($param)->delete('wip_entree_gaines');
    }
}



