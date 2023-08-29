<?php
class sortie_control_qualite_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_sortie_control_qualite($param = array())
    {
        return $this->db->where($param)->get('sortie_control_qualite')->result_object();
    }
    public function get_detail_sortie_control_qualite($param)
    {
        return $this->db->where($param)->get('sortie_control_qualite')->row_object();
    }
    public function insert_data_sortie_control_qualite($data)
    {
        return $this->db->insert('sortie_control_qualite', $data);
    }
    public function update_date_sortie_control_qualite($param, $data)
    {
        return $this->db->where($param)->update('sortie_control_qualite', $data);
    }
    public function delete_date_sortie_control_qualite($param)
    {
        return $this->db->where($param)->delete('sortie_control_qualite');
    }
}
