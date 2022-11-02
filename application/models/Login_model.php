<?php
class login_model extends CI_Model{
 public function __construct(){

 }

 public function get_utilisateur_info($UT_CODE){
  $this->db->where('UT_CODE', $UT_CODE);
  $query = $this->db->get('utilisateurs');
  return $query->unbuffered_row();
}

}