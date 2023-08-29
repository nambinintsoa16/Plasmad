<?php
class operateur_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_operateur($param=array()){
    return $this->db->where($param)->get('operateur')->result_object();
  }
  public function insert_operateur($data){
    return $this->db->insert('operateur',$data);
  }
  public function update_operateur($param,$data){
    return $this->db->where($param)->update('operateur',$data);
  }
  public function delete_operateur($param){
    return $this->db->where($param)->delete('operateur');
  }
  
} 


