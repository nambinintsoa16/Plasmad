<?php
class sortie_matiere_premiere_madakem_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_sortie_matiere_premiere($param){
    return $this->db->where($param)->get('sortie_matiere_premiere_madakem')->result_object();
  }
  public function get_detail_sortie_matiere_premiere($param){
    return $this->db->where($param)->get('sortie_matiere_premiere_madakem')->row_object();
    
  }
  public function insert_sortie_matiere_premiere($data){
    return $this->db->insert('sortie_matiere_premiere_madakem',$data);
  }
  public function update_sortie_matiere_premiere($param,$data){
    return $this->db->where($param)->update('sortie_matiere_premiere_madakem',$data);
  }

  

}
