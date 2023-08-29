<?php
class cintre_hook_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_cintre_hook($param = array())
    {
        return $this->db->where($param)->get('cintre_hook')->result_object();
    }
    public function get_detail_cintre_hook($param)
    {
        return $this->db->where($param)->get('cintre_hook')->row_object();
    }
    public function insert_data_cintre_hook($data)
    {
        return $this->db->insert('cintre_hook', $data);
    }
    public function update_date_cintre_hook($param, $data)
    {
        return $this->db->where($param)->update('cintre_hook', $data);
    }
    public function delete_date_cintre_hook($param)
    {
        return $this->db->where($param)->delete('cintre_hook');
    }
}
