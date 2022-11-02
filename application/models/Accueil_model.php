<?php
class Accueil_model extends CI_Model{
 public function __construct(){

 }
 public function listeInstance($D_STATUT){
	 $this->db->where('D_STATUT',$D_STATUT);
	 $this->db->join('utilisateurs','utilisateurs.UT_CODE=demandes.D_DEMANDEUR');
	 return $this->db->get('demandes')->result_object();
 }
 public function countDemande(){
	return $this->db->query(
	'  
	  Select 
	   ( select count(D_ID) from demandes where D_STATUT = "En instances" ) as "instances",
	   ( select count(D_ID) from demandes where D_STATUT = "Sans suite" ) as "sans_suite",
	   ( select count(D_ID) from demandes where D_STATUT = "En cours" ) as "en_cours",
	   ( select count(D_ID) from demandes where D_STATUT = "En Terminer" ) as "terminer"
	  from dual
	'
	)->row_object();
	 
 }

}