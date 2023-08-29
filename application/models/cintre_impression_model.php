<?php
class cintre_impression_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_cintre_impression($param = array())
    {
        return $this->db->where($param)->get('cintre_impression')->result_object();
    }
    public function get_detail_cintre_impression($param)
    {
        return $this->db->where($param)->get('cintre_impression')->row_object();
    }
    public function insert_data_cintre_impression($data)
    {
        return $this->db->insert('cintre_impression', $data);
    }
    public function update_date_cintre_impression($param, $data)
    {
        return $this->db->where($param)->update('cintre_impression', $data);
    }
    public function delete_date_cintre_impression($param)
    {
        return $this->db->where($param)->delete('cintre_impression');
    }
}
