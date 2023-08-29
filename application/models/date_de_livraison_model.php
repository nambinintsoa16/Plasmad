<?php
class date_de_livraison_model extends CI_Model
{
    public function __construct()
    {
    }
    public function get_date_de_livraison($param = array())
    {
        return $this->db->where($param)->get('date_de_livraison')->result_object();
    }
    public function get_detail_date_de_livraison($param)
    {
        return $this->db->where($param)->get('date_de_livraison')->row_object();
    }
    public function insert_date_de_livraison($data)
    {
        return $this->db->insert('date_de_livraison', $data);
    }
    public function update_date_de_livraison($param, $data)
    {
        return $this->db->where($param)->update('date_de_livraison', $data);
    }
    public function delete_date_de_livraison($param)
    {
        return $this->db->where($param)->delete('date_de_livraison');
    }
}
