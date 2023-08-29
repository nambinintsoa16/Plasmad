<?php
class dechet_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_dechet($param = array())
    {
        return $this->db->where($param)->get('dechet')->result_object();
    }
    public function get_detail_dechet($param)
    {
        return $this->db->where($param)->get('dechet')->row_object();
    }
    public function insert_data_dechet($data)
    {
        return $this->db->insert('dechet', $data);
    }
    public function update_date_dechet($param, $data)
    {
        return $this->db->where($param)->update('dechet', $data);
    }
    public function delete_date_dechet($param)
    {
        return $this->db->where($param)->delete('dechet');
    }
}



