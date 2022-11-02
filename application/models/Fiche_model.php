<?php
class fiche_model extends CI_Model{
 public function __construct(){

 }
 public function saveDemande($data){
	 $this->db->insert('demandes',$data);
 }
 public function lastId(){
	 $this->db->select('D_ID');
	 $this->db->limit('1');
	 $this->db->order_by('D_ID','DESC');
	 return $this->db->get('demandes')->row_object();
	 
 }
  public function lastFID(){
	 $this->db->select('F_ID');
	 $this->db->limit('1');
	 $this->db->order_by('F_ID','DESC');
	 return $this->db->get('demandes')->row_object();
	 
 }
  public function detail($D_ID){
	 $this->db->where('D_ID',$D_ID);
	 return $this->db->get('demandes')->row_object();
	 
 }
 public function statutDemande(){

}
 public function updateDemande($demande,$data){
	 $this->db->where('D_ID',$demande);
	 $this->db->set($data);
	 $this->db->update('demandes');
 }
}