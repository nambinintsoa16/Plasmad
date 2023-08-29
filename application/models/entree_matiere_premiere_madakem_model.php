<?php
class entree_matiere_premiere_madakem_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_entree_matiere_premiere($param){
    return $this->db->where($param)->get('entree_matiere_premiere_madakem')->result_object();
  }
  public function get_detail_entree_matiere_premiere($param){
    return $this->db->where($param)->get('entree_matiere_premiere_madakem')->row_object();
    
  }
  public function insert_entree_matiere_premiere($data){
    return $this->db->insert('entree_matiere_premiere_madakem',$data);
  }
  public function update_entree_matiere_premiere($param,$data){
    return $this->db->where($param)->update('entree_matiere_premiere_madakem',$data);
  }

  

}
