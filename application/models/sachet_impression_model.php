<?php
class sachet_impression_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_sachet_impression($param){
    return $this->db->where($param)->get('sachet_impression')->result_object();
  }
  public function get_detail_sachet_impression($param){
    return $this->db->where($param)->get('sachet_impression')->row_object();
  }
  public function delete_sachet_impression($param){
    return $this->db->where($param)->delete('sachet_impression');
  }
  public function update_sachet_impression($requette,$data){
    return $this->db->where($requette)->update('sachet_impression',$data);
  }
  public function insert_sachet_impression($data){
    $this->db->insert('sachet_impression',$data);
    return $this->db->insert_id();
  }
}
