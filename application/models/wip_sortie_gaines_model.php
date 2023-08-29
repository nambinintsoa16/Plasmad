<?php
class wip_sortie_gaines_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_wip_sortie_gaines($param = array())
    {
        return $this->db->where($param)->get('wip_sortie_gaines')->result_object();
    }
    public function get_detail_wip_sortie_gaines($param)
    {
        return $this->db->where($param)->get('wip_sortie_gaines')->row_object();
    }
    public function insert_data_wip_sortie_gaines($data)
    {
        return $this->db->insert('wip_sortie_gaines', $data);
    }
    public function update_date_wip_sortie_gaines($param, $data)
    {
        return $this->db->where($param)->update('wip_sortie_gaines', $data);
    }
    public function delete_date_wip_sortie_gaines($param)
    {
        return $this->db->where($param)->delete('wip_sortie_gaines');
    }
}



