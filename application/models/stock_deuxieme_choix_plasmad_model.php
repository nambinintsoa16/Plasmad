<?php
class stock_deuxieme_choix_plasmad_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_stock_deuxieme_choix_plasmad($param=array()){
    return $this->db->where($param)->get('stock_deuxieme_choix_plasmad')->result_object();
  }
  public function get_detail_stock_deuxieme_choix_plasmad($param){
    return $this->db->where($param)->get('stock_deuxieme_choix_plasmad')->row_object();
    
  }
  public function insert_stock_deuxieme_choix_plasmad($data){
    return $this->db->insert('stock_deuxieme_choix_plasmad',$data);
  }
  public function update_stock_deuxieme_choix_plasmad($param,$data){
    return $this->db->where($param)->update('stock_deuxieme_choix_plasmad',$data);
  }
}




