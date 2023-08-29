<?php
class entree_surplus_finis_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_entree_surplus_finis($param=array()){
    return $this->db->where($param)->get('entree_surplus_finis')->result_object();
  }
  public function get_detail_entree_surplus_finis($param){
    return $this->db->where($param)->get('entree_surplus_finis')->row_object();
    
  }
  public function insert_entree_surplus_finis($data){
    return $this->db->insert('entree_surplus_finis',$data);
  }
  public function update_entree_surplus_finis($param,$data){
    return $this->db->where($param)->update('entree_surplus_finis',$data);
  }

  

}
