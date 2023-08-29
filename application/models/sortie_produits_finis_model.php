<?php
class sortie_produits_finis_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_sortie_produits_finis($param=array()){
    return $this->db->where($param)->get('sortie_produits_finis')->result_object();
  }
  public function get_detail_sortie_produits_finis($param){
    return $this->db->where($param)->get('sortie_produits_finis')->row_object();
  }
  public function delete_sortie_produits_finis($param){
    return $this->db->where($param)->delete('sortie_produits_finis');
  }
  public function insert_sortie_produits_finis($data){
    return $this->db->insert('sortie_produits_finis',$data);
  }
  public function update_sortie_produits_finis($param,$data){
    return $this->db->where($param)->update('sortie_produits_finis',$data);
  }
  public function get_sum_produits_finis($param=array(),$colum){
    return $this->db->where($param)->select_sum($colum)->get('sortie_produits_finis');
  }
  

}
