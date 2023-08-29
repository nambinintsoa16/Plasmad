<?php
class reextrusion_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_reextrusion($param){
    return $this->db->where($param)->get('reextrusion')->result_object();
  }
  public function get_detail_reextrusion($param){
    return $this->db->where($param)->get('reextrusion')->row_object();
  }
  public function insert_reextrusion($data){
    return $this->db->insert('reextrusion',$data);
  }
  public function delete_reextrusion($param){
    return $this->db->where($param)->delete('reextrusion');
  }
  public function update_reextrusion($param,$data){
    return $this->db->where($param)->update('reextrusion',$data);
  }
  
}


