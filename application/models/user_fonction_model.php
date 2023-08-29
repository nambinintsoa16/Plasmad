<?php 
class user_fonction_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_user_fonction_all($param= array()){
    return $this->db->where($param)->get('user_fonction')->result_object();
  }
  public function get_user_fonction_info($param= array()){
    return $this->db->where($param)->get('user_fonction')->row_object();
  }
  public function insert_user_fonction($data){
   return $this->db->insert("user_fonction",$data);
  }

} 
