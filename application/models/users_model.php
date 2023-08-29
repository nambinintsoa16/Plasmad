<?php
class users_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_utilisateur_info($param= array()){
    return $this->db->where($param)->get('users')->row_object();
  }
  public function get_utilisateur_data($param= array()){
    return $this->db->where($param)->get('users')->result_object();
  }
  public function delete_utilisateur($param= array()){
    return $this->db->where($param)->delete('users');
  }
  public function insert_utilisateur($data){
   return $this->db->insert("users",$data);
  }
  public function update_utilisateur_data($param= array(),$data){
    return $this->db->where($param)->update('users',$data);
  }
  
} 