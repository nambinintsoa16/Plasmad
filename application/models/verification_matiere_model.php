<?php
class verification_matiere_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_verification_matiere($param= array()){
    return $this->db->where($param)->get('verification_matiere')->result_object();
  }
  public function get_detail_verification_matiere($param= array()){
    return $this->db->where($param)->get('verification_matiere')->row_object();
  }
  public function update_verification_matiere($param,$data){
    return $this->db->where($param)->get('verification_matiere',$data);
  }
  public function insert_verification_matiere($param= array()){
    return $this->db->insert('verification_matiere',$param);
  }
  public function get_last_verification_matiere($param){
    return  $this->db->where($param)->limit(1)->order_by('VM_ID','DESC')->get('verification_matiere')->row_object();
    }
} 