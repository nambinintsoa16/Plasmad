<?php
class matiere_detail_attent_validation_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_matiere_detail_attent_validation($param){
    return $this->db->where($param)->get('matiere_detail_attent_validation')->result_object();
  }
  public function get_detail_matiere_detail_attent_validation($param){
    return $this->db->where($param)->get('matiere_detail_attent_validation')->row_object();
  }
  public function delete_detail_matiere_detail_attent_validation($param){
    return $this->db->where($param)->delete('matiere_detail_attent_validation');
  }
  public function insert_matiere_detail_attent_validation($param){
    return $this->db->insert('matiere_detail_attent_validation',$param);
  }
  public function update_matiere_detail_attent_validation($param,$data){
    return $this->db->where($param)->update('matiere_detail_attent_validation',$data);
  }
} 