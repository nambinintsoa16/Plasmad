<?php
class sachet_extrusion_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_sachet_extrusion($param){
    return $this->db->where($param)->get('sachet_extrusion')->result_object();
  }
  public function get_detail_sachet_extrusion($param){
    return $this->db->where($param)->get('sachet_extrusion')->row_object();
  }
  public function update_sachet_extrusion($requette,$data){
    return $this->db->where($requette)->update('sachet_extrusion',$data);
  }
  public function insert_sachet_exrusion($data){
    return $this->db->insert('sachet_extrusion',$data);
  }
  public function delete_sachet_exrusion($param){
    return $this->db->where($param)->delete('sachet_extrusion');
  }
}


