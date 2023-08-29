<?php
class stock_dechet_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_stock_dechet($param = array())
    {
        return $this->db->where($param)->get('stock_dechet')->result_object();
    }
    public function get_detail_stock_dechet($param)
    {
        return $this->db->where($param)->get('stock_dechet')->row_object();
    }
    public function insert_data_stock_dechet($data)
    {
        return $this->db->insert('stock_dechet', $data);
    }
    public function update_date_stock_dechet($param, $data)
    {
        return $this->db->where($param)->update('stock_dechet', $data);
    }
    public function delete_date_stock_dechet($param)
    {
        return $this->db->where($param)->delete('stock_dechet');
    }
}



