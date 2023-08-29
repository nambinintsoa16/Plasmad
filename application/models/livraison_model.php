<?php
class livraison_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function get_date_livraison_all($requette=array()){
    return $this->db->where($requette)->get('date_de_livraison')->result_object();
  }
  public function get_date_livraison_join_commande($requette=array()){
    return $this->db->where($requette)
    ->join('commande','commande.BC_PE=date_de_livraison.DL_PO')
    ->get('date_de_livraison')->result_object();
  }

}