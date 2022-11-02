<?php
class planning_model extends CI_Model{
 public function __construct(){

 }

 public function get_utilisateur_info($UT_CODE){
  $this->db->where('UT_CODE', $UT_CODE);
  $query = $this->db->get('utilisateurs');
  return $query->unbuffered_row();
}
 public function listebondecommande($statut=null,$statut_2=null){
 	if($statut!=null && $statut_2!=null){
 		$this->db->where("BC_STATUT",$statut);
 		$this->db->where("BC_STATUT",$statut);
 	}else if($statut!=null){
 		$this->db->where("BC_STATUT",$statut);
 	}
    return $this->db->get('bondecommande')->result_object();
}
public function savedate($data){
	return $this->db->insert('datedelivraison',$data);
}
public function listedatedelivraison($parametre){
	$this->db->where($parametre);
	$this->db->join('bondecommande','bondecommande.BC_PE=datedelivraison.DL_PO');
	return $this->db->get('datedelivraison')->result_object();
}
public function listedate($parametre){
	return $this->db->where($parametre)->get('datedelivraison')->result_object();
}
public function heureplanning($parametre){
    return $this->db->where($parametre)->order_by('HP_ID','DESC')->get("heureplanning")->row_object(); 
}
public function control(){
	  return $this->db->get('control')->result_object();
}

public function deleteJobs($parametre){

	 return $this->db->where($parametre)->delete('jobcart');
}
 public function tableEX($PO=null){
 	if($PO!=null){
 		$this->db->where("EX_BC_ID",$PO);
 	}
  //$this->db->join('bondecommande','bondecommande.BC_PE=extrusion.EX_BC_ID');
 	return $this->db->get('extrusion')->result_object();
 }
 public function tableIPre($PO=null){
 	if($PO!=null){
 		$this->db->where("extrusion_inpression.BC_ID",$PO);
 	}
 // $this->db->join('bondecommande','bondecommande.BC_PE=extrusion_inpression.BC_ID');
 	return $this->db->get('extrusion_inpression')->result_object();
 }
 public function tableEcooupe($PO=null){
 	if($PO!=null){
 		$this->db->where("extrusion_coupe.BC_ID",$PO);
 	}
  $this->db->join('bondecommande','bondecommande.BC_PE=extrusion_coupe.BC_ID');
 	return $this->db->get('extrusion_coupe')->result_object();
 }
public function listebon($statut){
	return	$this->db->where($statut)->get('bondecommande')->result_object();
}
public function bonCommande($statut){
	return	$this->db->like($statut)->get('bondecommande')->result_object();
}
 public function listebondecommandeParMa($BC_MACHINE){
 	$this->db->where("BC_MACHINE",$BC_MACHINE);
    return $this->db->get('bondecommande')->result_object();
}

 public function listebondecommandeTeminer(){
 	$this->db->where("BC_STATUT","TERMINER");
    return $this->db->get('bondecommande')->result_object();
}

public function listemachines($parametre){
	return $this->db->where($parametre)->get("machine")->result_object();
}
public function listemachinex($parametre=array()){
	return $this->db->where($parametre)->get("machine")->result_object();
}
public function listemach(){
	return $this->db->get("machine")->result_object();
}
public function machineActive(){
	$this->db->distinct();
	$this->db->select('BC_MACHINE');
	$this->db->where('BC_STATUT !=','DECOUPE');
	$this->db->where('BC_STATUT !=','INPRESSION');
	$this->db->where('BC_STATUT !=','TERMINER');
	return $this->db->get('bondecommande')->result_object();
}
public function editBonDeCommande($BC_PE,$data){
    $this->db->where('BC_PE',$BC_PE);
    $this->db->set($data);
	return $this->db->update("bondecommande");
}
public function insertheurePlanning($data){
	return $this->db->insert('heurePlanning',$data);   
}
public function selectheureplanning($parametre){
	return $this->db->where($parametre)->get('heureplanning')->row_object();
}
public function dateCallandar(){
	$this->db->distinct();
	$this->db->select("BC_DATE");
	return $this->db->get("bondecommande")->result_object();
}
public function mombreStatut($date,$statut=false){
	if($statut!=false){
		if($statut=="PROD"){
			$this->db->where("BC_STATUT NOT LIKE '%Términer%' AND BC_STATUT NOT LIKE '%ETA1%' AND BC_STATUT NOT LIKE '%Annulée%'");
		}else{
			$this->db->where("BC_STATUT",$statut);
		}
       
	}
  $this->db->where("BC_DATE",$date);
  return  $this->db->count_all_results('bondecommande');
  
}

public function autocompleteStock($mot){
   $this->db->like('ST_DESIGNATION', $mot); 
   $this->db->like('ST_ORIGIN','PLASMAD_MAGASIN');
   return $this->db->get("stock_matier_premier")->result_object();
  
}
public function autocompleteStockAll($mot){
	$this->db->like('ST_DESIGNATION', $mot); 
	return $this->db->get("stock_matier_premier")->result_object();
 }
public function machine($type=false){
	if($type !=false){
		$this->db->where("MA_DESIGNATION ",$type);
	}
	return $this->db->get("machine")->row_object();
}
public function machines($type=false){
	if($type !=false){
		$this->db->where("MA_SPECIFIQUE",$type);
	}
	$this->db->where("MA_STATUT","on");
	return $this->db->get("machine")->result_object();
}
public function lastIdJob(){
 $this->db->select('JO_IDS');
 $this->db->limit('1');
 $this->db->order_by('JO_IDS','DESC');
 return $this->db->get('jobcart')->row_object();
}
public function testJobCard($PE){
	return $this->db->where(["JO_STATUT"=>"NON_PLANIFIER","BC_PE"=>$PE])
	->get('jobcart')->row_object();
}
public function selectJobCard($parametre){
	return $this->db->where($parametre)->get('jobcart')->row_object();
}
public function selectJobCardAsc($parametre){
	return $this->db->where($parametre)->order_by('JO_ID','DESC')->get('jobcart')->row_object();
}
public function selectJobCards($parametre){
	return $this->db->where($parametre)->get('jobcart')->result_object();
}
public function standardQuery($sql){
	return $this->db->query($sql)->result_object();

}
public function standardQueryfetch($sql){
	return $this->db->query($sql)->row_object();

}
public function selectJobCardComm($parametre){

	$this->db->select('bondecommande.BC_DATELIVRE,BC_DIMENSIONPROD,jobcart.JO_SORTIE,jobcart.JO_PIECE,jobcart.JO_AV,jobcart.JO_ETAT,jobcart.JO_DATEFIN,jobcart.JO_DATEDEDEBU,jobcart.JO_DATEFIN,jobcart.JO_ID AS "JO_ID",JO_IDS,jobcart.JO_OBS,bondecommande.BC_PE , JO_DATE, JO_MACHINE,JO_MACHINE_PRINT,JO_MACHINE_COUPE ,JO_DATE_DECOUPE,JO_DATE_IMPRIMER,JO_TYPE,JO_STATUT,JO_CREAT,JO_DURE,JO_DEB,JO_FIN ,JO_AV,BC_DATE ,BC_CLIENT ,BC_CODE,BC_DATELIVRE,BC_REASSORT,BC_ECHANTILLON,BC_DIMENSION,BC_RABAT,BC_SOUFFLET,BC_PERFORATION,BC_TYPE,BC_IMPRESSION,BC_CYLINDRE,BC_QUNTITE,BC_PRIX,BC_QUANTITEAPRODUIREENMETRE,BC_POIDSDUNSACHET,BC_POISENKGSAVECMARGE,BC_OBSERVATION,BC_COMMERCIAL,BC_VALIDATAIRE,BC_STATUT,BC_OBJETANNULATION,BC_TYPEPRODUIT,BC_TYPEMATIER,BC_MACHINE,BC_DATE_DE_PRODUCTION,BC_TYPE_PRODUIT,BC_ID,BC_MODEL,BC_PROCCESSUS,BC_ETAT');
	$this->db->join("bondecommande","bondecommande.BC_PE=jobcart.BC_PE");
	
	return $this->db->where($parametre)->get('jobcart')->result_object();
}
public function selectJobCardCommS($parametre){
	$this->db->select('bondecommande.BC_DATELIVRE,BC_DIMENSIONPROD,jobcart.JO_SORTIE,jobcart.JO_PIECE,jobcart.JO_AV,jobcart.JO_ETAT,jobcart.JO_DATEFIN,jobcart.JO_DATEDEDEBU,jobcart.JO_DATEFIN,jobcart.JO_ID,JO_IDS,jobcart.JO_OBS,bondecommande.BC_PE , JO_DATE, JO_MACHINE,JO_MACHINE_PRINT,JO_MACHINE_COUPE ,JO_DATE_DECOUPE,JO_DATE_IMPRIMER,JO_TYPE,JO_STATUT,JO_CREAT,JO_DURE,JO_DEB,JO_FIN ,JO_AV,BC_DATE ,BC_CLIENT ,BC_CODE,BC_DATELIVRE,BC_REASSORT,BC_ECHANTILLON,BC_DIMENSION,BC_RABAT,BC_SOUFFLET,BC_PERFORATION,BC_TYPE,BC_IMPRESSION,BC_CYLINDRE,BC_QUNTITE,BC_PRIX,BC_QUANTITEAPRODUIREENMETRE,BC_POIDSDUNSACHET,BC_POISENKGSAVECMARGE,BC_OBSERVATION,BC_COMMERCIAL,BC_VALIDATAIRE,BC_STATUT,BC_OBJETANNULATION,BC_TYPEPRODUIT,BC_TYPEMATIER,BC_MACHINE,BC_DATE_DE_PRODUCTION,BC_TYPE_PRODUIT,BC_ID,BC_MODEL,BC_PROCCESSUS,BC_ETAT');
	$this->db->join("bondecommande","bondecommande.BC_PE=jobcart.BC_PE");
	
	return $this->db->where($parametre)->get('jobcart')->row_object();
}

public function testJobCards($PE){
	return $this->db->where("BC_PE",$PE)
	->get('jobcart')->row_object();
}
public function extrusion($parametre){
	return $this->db->where($parametre)->get('extrusion')->result_object();
}

public function extrusion_inpression($parametre){
	return $this->db->where($parametre)->get('extrusion_inpression')->result_object();
}
public function extrusion_coupe($parametre){  
	return $this->db->where($parametre)->get('extrusion_coupe')->result_object();
}
public function listeMartierPr($param){
	return $this->db->where($param)->get('matier_utiliser')->result_object();
}
public function saveMartierPr($data){
	return $this->db->insert('matier_utiliser',$data);
}
public function deleTeMatier($param){
	$this->db->where($param);
	return $this->db->delete('matier_utiliser');
}
public function insertJobCard($data){
	 return $this->db->insert('jobcart',$data);
}
public function updateJobCard($data,$requette){
	$this->db->where($requette);
	return $this->db->update('jobcart',$data);
}
public function insertbondecommande($data){
    return $this->db->insert('bondecommande',$data);
}
public function listeMachine(){
    return $this->db->get('machine')->result_object();
}
public function DetailMachine($parametre){
    return $this->db->where($parametre)->get('machine')->row_object();
}
public function listebons($parametre=array()){
	  return $this->db->where($parametre)->get('bondecommande')->result_object();
}

public function sommeTeminerBC($BC){
	return $this->db->query("SELECT SUM(`JO_AV`) FROM `jobcart` WHERE `BC_PE` = $BC");
}
public function insertPurge($data){
	return $this->db->insert('purge',$data);
}

public function Detailheureplanning($parametre){
	$this->db->where($parametre);
	return $this->db->delete('heureplanning');
}
public function updateheureplanning($data,$requette){
	$this->db->where($requette);
	return $this->db->update('heureplanning',$data);
}
public function time_to_sec($time)
	{
		list($h, $m, $s) = explode(":", $time);
		$seconds = 0;
		$seconds += (intval($h) * 3600);
		$seconds += (intval($m) * 60);
		$seconds += (intval($s));
		return $seconds;
	}
	public function se_to_time($sec)
	{
		return sprintf('%02d:%02d:%02d', floor($sec / 3600), floor($sec / 60 % 60), floor($sec % 60));
	}


}
