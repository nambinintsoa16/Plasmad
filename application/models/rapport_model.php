<?php
class rapport_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_rapport_de_commande_all($requette=array()){
    return $this->db->where($requette)->get('rapport_de_commande')->result_object();
  }
  public function get_rapport_de_commande($requette=array()){
    return $this->db->where($requette)->get('rapport_de_commande')->row_object();
  }
  public function update_rapport_de_commande($requette,$data){
    return $this->db->where($requette)->update('rapport_de_commande',$data);
  }
  public function insert_rapport_de_commande($pram){
    return $this->db->insert('rapport_de_commande',$pram);
}

}


