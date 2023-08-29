<?php
class wip_stock_gaines_imprimer_plasmad_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_wip_stock_gaines_imprimer_plasmad($param=array()){
    return $this->db->where($param)->get('wip_stock_gaines_imprimer_plasmad')->result_object();
  }
  public function get_detail_wip_stock_gaines_imprimer_plasmad($param){
    return $this->db->where($param)->get('wip_stock_gaines_imprimer_plasmad')->row_object();
    
  }
  public function insert_wip_stock_gaines_imprimer_plasmad($data){
    return $this->db->insert('wip_stock_gaines_imprimer_plasmad',$data);
  }
  public function update_wip_stock_gaines_imprimer_plasmad($param,$data){
    return $this->db->where($param)->update('wip_stock_gaines_imprimer_plasmad',$data);
  }
  public function get_tail_commande_stock($select,$param,$groupe,$order){
    return $this->db->select($select)->where($param)->group_by($groupe)->order_by($order, 'DESC')->get('wip_stock_gaines_imprimer_plasmad')->result_object();
  }
}



