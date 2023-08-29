<?php
class matiere_impression_use_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_matiere_impression_use($param){
    return $this->db->where($param)->get('matiere_impression_use')->result_object();
  }
  public function get_detail_matiere_impression_use($param){
    return $this->db->where($param)->get('matiere_impression_use')->row_object();
  }
  public function delete_detail_matiere_impression_use($param){
    return $this->db->where($param)->delete('matiere_impression_use');
  }
  public function insert_matiere_impression_use($param){
    return $this->db->insert('matiere_impression_use',$param);
  }
  public function update_matiere_impression_use($param,$data){
    return $this->db->where($param)->update('matiere_impression_use',$data);
  }
} 