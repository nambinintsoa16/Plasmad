<?php
class prix_commande_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_prix_commande($param){
    return $this->db->where($param)->get('prix_commande')->result_object();
  }
  public function get_detail_prix_commande($param){
    return $this->db->where($param)->get('prix_commande')->row_object();
  }
  
} 





