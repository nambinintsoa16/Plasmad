<?php
class prixappliquer_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_prix_appliquer($param){
    return $this->db->where($param)->get('prixappliquer')->row_object();
  }
  public function get_prix_all_appliquer($param=array()){
    return $this->db->where($param)->get('prixappliquer')->result_object();
  }
  public function insert_prixappliquer($data){
    return $this->db->insert('prixappliquer',$data);
  }
  public function update_prixappliquer($param,$data){
    return $this->db->where($param)->update('prixappliquer',$data);
  }
  public function delete_prixappliquer($param){
    return $this->db->where($param)->delete('prixappliquer');
  }
  
} 