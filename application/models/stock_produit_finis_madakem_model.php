<?php
class stock_produit_finis_madakem_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_stock_produit_finis_madakem($param=array()){
    return $this->db->where($param)->get('stock_produits_finis_madakem')->result_object();
  }
  public function get_detail_stock_produit_finis_madakem($param){
    return $this->db->where($param)->get('stock_produits_finis_madakem')->row_object();
    
  }
  public function insert_stock_produit_finis_madakem($data){
    return $this->db->insert('stock_produits_finis_madakem',$data);
  }
  public function update_stock_produit_finis_madakem($param,$data){
    return $this->db->where($param)->update('stock_produits_finis_madakem',$data);
  }
}



