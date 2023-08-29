<?php
class stock_produit_finis_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_stock_produit_finis($param=array()){
    return $this->db->where($param)->get('stock_produits_finis_plasmad')->result_object();
  }
  public function get_detail_stock_produit_finis($param){
    return $this->db->where($param)->get('stock_produits_finis_plasmad')->row_object();
    
  }
  public function insert_stock_produit_finis($data){
    return $this->db->insert('stock_produits_finis_plasmad',$data);
  }
  public function update_stock_produit_finis($param,$data){
    return $this->db->where($param)->update('stock_produits_finis_plasmad',$data);
  }
  public function get_tail_commande_stock($select,$param,$groupe,$order){
    return $this->db->select($select)->where($param)->group_by($groupe)->order_by($order, 'DESC')->get('stock_produits_finis_plasmad')->result_object();
  }
}



