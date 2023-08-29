<?php
class stock_gaines_plasmad_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_stock_gaines_plasmad($param=array()){
    return $this->db->where($param)->get('stock_gaines_plasmad')->result_object();
  }
  public function get_detail_stock_gaines_plasmad($param){
    return $this->db->where($param)->get('stock_gaines_plasmad')->row_object();
    
  }
  public function insert_stock_gaines_plasmad($data){
    return $this->db->insert('stock_gaines_plasmad',$data);
  }
  public function update_stock_gaines_plasmad($param,$data){
    return $this->db->where($param)->update('stock_gaines_plasmad',$data);
  }
  public function get_tail_commande_stock($select,$param,$groupe,$order){
    return $this->db->select($select)->where($param)->group_by($groupe)->order_by($order, 'DESC')->get('stock_gaines_plasmad')->result_object();
  }
}



