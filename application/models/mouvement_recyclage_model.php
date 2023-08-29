<?php
class mouvement_recyclage_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_mouvement_recyclage($param = array())
    {
        return $this->db->where($param)->get('mouvement_recyclage')->result_object();
    }
    public function get_detail_mouvement_recyclage($param)
    {
        return $this->db->where($param)->get('mouvement_recyclage')->row_object();
    }
    public function insert_data_mouvement_recyclage($data)
    {
        return $this->db->insert('mouvement_recyclage', $data);
    }
    public function update_date_mouvement_recyclage($param, $data)
    {
        return $this->db->where($param)->update('mouvement_recyclage', $data);
    }
    public function delete_date_mouvement_recyclage($param)
    {
        return $this->db->where($param)->delete('mouvement_recyclage');
    }
}





