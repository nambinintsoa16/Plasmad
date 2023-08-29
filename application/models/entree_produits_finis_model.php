<?php
class entree_produits_finis_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_entree_produits_finis($param=array()){
    return $this->db->where($param)->get('entree_produits_finis')->result_object();
  }
  public function get_detail_entree_produits_finis($param){
    return $this->db->where($param)->get('entree_produits_finis')->row_object();
    
  }

  public function get_delete_entree_produits_finis($param){
    return $this->db->where($param)->delete('entree_produits_finis');
    
  }
  public function insert_entree_produits_finis($data){
    return $this->db->insert('entree_produits_finis',$data);
  }
  public function update_entree_produits_finis($param,$data){
    return $this->db->where($param)->update('entree_produits_finis',$data);
  }

  

}
