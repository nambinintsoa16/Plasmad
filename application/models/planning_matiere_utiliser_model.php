<?php
class planning_matiere_utiliser_model extends CI_Model
{
    public function __construct()
  {
   
  }

  public function get_planning_matiere_utiliser($param){
    return $this->db->where($param)->get('planning_matiere_utiliser')->result_object();
  }
  public function get_detail_planning_matiere_utiliser($param){
    return $this->db->where($param)->get('planning_matiere_utiliser')->row_object();
    
  }
  public function insert_planning_matiere_utiliser($data){
     $this->db->insert('planning_matiere_utiliser',$data);
     return $this->db->insert_id();
  }
  public function update_planning_matiere_utiliser($param,$data){
    return $this->db->where($param)->update('planning_matiere_utiliser',$data);
  }
  public function delete_planning_matiere_utiliser($param){
    return $this->db->where($param)->delete('planning_matiere_utiliser');
  }

  
} 

