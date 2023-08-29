<?php
class entree_gaines_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_entree_gaines($param = array())
    {
        return $this->db->where($param)->get('entree_gaines')->result_object();
    }
    public function get_detail_entree_gaines($param)
    {
        return $this->db->where($param)->get('entree_gaines')->row_object();
    }
    public function insert_data_entree_gaines($data)
    {
        return $this->db->insert('entree_gaines', $data);
    }
    public function update_date_entree_gaines($param, $data)
    {
        return $this->db->where($param)->update('entree_gaines', $data);
    }
    public function delete_date_entree_gaines($param)
    {
        return $this->db->where($param)->delete('entree_gaines');
    }
}



