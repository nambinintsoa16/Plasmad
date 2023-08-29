<?php
class validation_matiere_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_validation_matiere($param= array()){
    return $this->db->where($param)->get('validation_matiere')->result_object();
  }
  public function get_detail_validation_matiere($param= array()){
    return $this->db->where($param)->get('validation_matiere')->row_object();
  }
  public function update_validation_matiere($param,$data){
    return $this->db->where($param)->update('validation_matiere',$data);
  }

  public function delete_validation_matiere($param){
    return $this->db->where($param)->delete('validation_matiere');
  }
  public function insert_validation_matiere($param= array()){
    return $this->db->insert('validation_matiere',$param);
  }
} 