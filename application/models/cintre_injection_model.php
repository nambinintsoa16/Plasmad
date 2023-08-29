<?php
class cintre_injection_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_cintre_injection($param = array())
    {
        return $this->db->where($param)->get('cintre_injection')->result_object();
    }
    public function get_detail_cintre_injection($param)
    {
        return $this->db->where($param)->get('cintre_injection')->row_object();
    }
    public function insert_data_cintre_injection($data)
    {
        return $this->db->insert('cintre_injection', $data);
    }
    public function update_date_cintre_injection($param, $data)
    {
        return $this->db->where($param)->update('cintre_injection', $data);
    }
    public function delete_date_cintre_injection($param)
    {
        return $this->db->where($param)->delete('cintre_injection');
    }
}
