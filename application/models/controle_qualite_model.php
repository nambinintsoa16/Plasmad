<?php
class controle_qualite_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_controle_qualite($param=array()){
    return $this->db->where($param)->get('controle_qualite')->result_object();
  }
  public function get_detail_controle_qualite($param){
    return $this->db->where($param)->get('controle_qualite')->row_object();
    
  }
  public function insert_controle_qualite($data){
    return $this->db->insert('controle_qualite',$data);
  }
  public function update_controle_qualite($param,$data){
    return $this->db->where($param)->update('controle_qualite',$data);
  }

  public function delete_controle_qualite($param){
    return $this->db->where($param)->delete('controle_qualite');
  }

}
