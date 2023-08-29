<?php
class livraison_compta_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_livraison_compta($param=array()){
    return $this->db->where($param)->get('livraison_compta')->result_object();
  }
  public function get_detail_livraison_compta($param){
    return $this->db->where($param)->get('livraison_compta')->row_object();
    
  }

  public function get_delete_livraison_compta($param){
    return $this->db->where($param)->delete('livraison_compta');
    
  }
  public function insert_livraison_compta($data){
    return $this->db->insert('livraison_compta',$data);
  }
  public function update_livraison_compta($param,$data){
    return $this->db->where($param)->update('livraison_compta',$data);
  }

  

}



