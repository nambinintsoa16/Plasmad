<?php
class sachet_coupe_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_sachet_coupe($param){
    return $this->db->where($param)->get('sachet_coupe')->result_object();
  }
  public function get_detail_sachet_coupe($param){
    return $this->db->where($param)->get('sachet_coupe')->row_object();
  }
  public function insert_sachet_coupe($data){
    return $this->db->insert('sachet_coupe',$data);
  }
  public function delete_sachet_coupe($param){
    return $this->db->where($param)->delete('sachet_coupe');
  }
  public function update_sachet_coupe($param,$data){
    return $this->db->where($param)->update('sachet_coupe',$data);
  }
  
}


