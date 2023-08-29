<?php
class stock_matier_premier_madakem_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_matiere_premiere($param){
    return $this->db->where($param)->get('stock_matier_premier_madakem')->result_object();
  }
  public function get_detail_matiere_premiere($param){
    return $this->db->where($param)->get('stock_matier_premier_madakem')->row_object();
    
  }
  public function insert_matiere_premiere($data){
    return $this->db->insert('stock_matier_premier_madakem',$data);
  }
  public function update_matiere_premiere($param,$data){
    return $this->db->where($param)->update('stock_matier_premier_madakem',$data);
  }

  

}
