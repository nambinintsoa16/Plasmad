<?php
class production_model extends CI_Model{
 public function __construct(){

 }

 public function get_utilisateur_info($UT_CODE){
  $this->db->where('UT_CODE', $UT_CODE);
  $query = $this->db->get('utilisateurs');
  return $query->unbuffered_row();
}
public function bondeCommande(){
      return $this->db->get("bondecommande")->result_object();
}
public function selectStock_matier_premier($parametre){
	return $this->db->where($parametre)->get('stock_matier_premier')->result_object();
}
public function machine($param){
  return $this->db->where($param)->get("machine")->result_object(); 
}
public function matierVer($param){
return  $this->db->where($param)->limit(1)->order_by('VM_ID','DESC')->get('verificationmatier')->row_object();
}
public function autocompletePo($mot){
  return $this->db->like("BC_PE",$mot)
  //->where("(BC_STATUT <> 'NON PLANNIFIE' AND  BC_STATUT <>'TERMINER')")
  ->limit(10)
  ->get("bondecommande")->result_object(); 
}
public function matierUtiliser($parametre){
	return $this->db->where($parametre)->get('matierinression')->result_object();
}
public function deleteMatierUtiliser($parametre){
	return $this->db->where($parametre)->delete('matierinression');
}
public function operateur($param){
  return $this->db->where($param)->get("operateur")->result_object(); 
}
public function bondeCommandes($param){
  return $this->db->where($param)->get("bondecommande")->result_object();
}
public function bonTerminer(){
  return $this->db->where("BC_STATUT",'TERMINER')->get("bondecommande")->result_object();
}

public function chercheCommande($op){     
  return $this->db->where('BC_PE',$op)->get("bondecommande")->row_object();
}
public function chercheVer($param){
  return $this->db->where('VM_PO',$param)->get("verificationmatier")->result_object();
}
public function cherchePEEX($param){
  return $this->db->where($param)->get("extrusion")->result_object();
}
public function insertVerfication($parametre){
  return $this->db->insert('verificationmatier',$parametre);
}
public function cherchePEEXTRu($param){
  return $this->db->where($param)
   ->order_by('VM_ID','ASC')
   ->get("verificationmatier")
   ->result_object();
}
public function cherchePEEXVer($param){
  return $this->db->where($param)->get("extrusion")->row_object();
}

public function saveverification($data){
  return $this->db->insert('verificationmatier',$data);
}

public function cherche($data){
  return $this->db->where($data)->get('verificationmatier')->result_object();
}
public function bonPlanifier(){
   return $this->db->where('JO_ID <> "null"')
   ->get("bondecommande")
   ->result_object();
}
public function sausaveexinpressionve($data){
  return $this->db->insert('extrusion_inpression',$data);
}
public function saveexcoupe($data){
  return $this->db->insert('extrusion_coupe',$data);
}
public function saveInjection($data){
 return $this->db->insert('Injection',$data);
}
public function dataInjection($requette){
  return $this->db->where($requette)
  ->get('Injection')->result_object();
}
public function testJobCard($PE){
  return $this->db->where(["JO_STATUT"=>"PLANIFIER","BC_PE"=>$PE])
  ->get('jobcart')->row_object();
}

public function testJobCards($PE){
  return $this->db->where("BC_PE",$PE)
  ->get('jobcart')->row_object();
}

public function bondecommandeDetail($BC_PE){
    $this->db->where('BC_PE',$BC_PE);
    return $this->db->get('bondecommande')->row_object();
}
public function autocompleteOperateur($mot){
	$this->db->like('OP_NOM', $mot);
	return $this->db->get('operateur')->result_object();
}
public function autocompletMa($mot){
  $this->db->like('MA_DESIGNATION', $mot);
  return $this->db->get('machine')->result_object();
}


public function insertFiche($data){
   return $this->db->insert('detailcart',$data);
 }
 public function listemach(){
	return $this->db->get("machine")->result_object();
}
public function lsatInset(){
    $this->db->limit(1);
    $this->db->order_by('DC_ID','DESC');
    return $this->db->get('detailcart')->row_object();
 }
 public function tableEX($parametre=array()){
  //$this->db->join('bondecommande','bondecommande.BC_PE=extrusion.EX_BC_ID');
 	return $this->db->where($parametre)->get('extrusion')->result_object();
 }
 
 public function tableImprimeRow($parametre=array()){
  //$this->db->join('bondecommande','bondecommande.BC_PE=extrusion.EX_BC_ID');
 	return $this->db->where($parametre)->get('extrusion_inpression')->row_object();
 }


 public function deleteExtrusion($parametre=array()){
  //$this->db->join('bondecommande','bondecommande.BC_PE=extrusion.EX_BC_ID');
 	return $this->db->where($parametre)->delete('extrusion');
 }
 
 public function deleteImprime($parametre=array()){
  //$this->db->join('bondecommande','bondecommande.BC_PE=extrusion.EX_BC_ID');
 	return $this->db->where($parametre)->delete('extrusion_inpression');
 }

 public function deleteEcooupe($parametre=array()){
 	return $this->db->where($parametre)->delete('extrusion_coupe');
 }

 
 public function tableIPre($parametre=array()){
  $this->db->join('bondecommande','bondecommande.BC_PE=extrusion_inpression.BC_ID');
 	return $this->db->where($parametre)->get('extrusion_inpression')->result_object();
 }
 public function tableEcooupe($parametre=array()){
  $this->db->join('bondecommande','bondecommande.BC_PE=extrusion_coupe.BC_ID');
 	return $this->db->where($parametre)->get('extrusion_coupe')->result_object();
 }


 public function tableEXRow($parametre=array()){
  //$this->db->join('bondecommande','bondecommande.BC_PE=extrusion.EX_BC_ID');
 	return $this->db->where($parametre)->get('extrusion')->row_object();
 }
 public function updateextrusion($requette,$parametre){
  return $this->db->where($requette)->update('extrusion',$parametre);

 }
 public function tableIPreRow($parametre=array()){
  $this->db->join('bondecommande','bondecommande.BC_PE=extrusion_inpression.BC_ID');
 	return $this->db->where($parametre)->get('extrusion_inpression')->row_object();
 }
 public function tableEcooupeRow($parametre=array()){
  $this->db->join('bondecommande','bondecommande.BC_PE=extrusion_coupe.BC_ID');
 	return $this->db->where($parametre)->get('extrusion_coupe')->row_object();
 }

 public function tableEcoupeRow($parametre=array()){
 	return $this->db->where($parametre)->get('extrusion_coupe')->row_object();
 }
 public function tableEcoupeRows($parametre=array()){
	return $this->db->where($parametre)->get('extrusion_coupe')->result_object();
}
 public function updatetableEcoupe($requette,$parametre){
  return $this->db->where($requette)->update('extrusion_coupe',$parametre);
 }
 public function matierinression($parametre){
   return $this->db->where($parametre)->get('matierinression')->result_object();
 }
 public function deleteMatier($parametre){
 
  //return $this->db->where($parametre)->delete('matierinression');

 }
 public function updateMatier($requette,$parametre){
  return $this->db->where($requette)->update('matierinression',$parametre);
 }
 
 public function saveextrusion($data){
   return $this->db->insert('extrusion',$data);
 }
 public function tableIN(){
 	$this->db->where('DC_STATUT','on');
 	$this->db->where('DC_PRO','INJECTION');
 	return $this->db->get('detailcart')->result_object();
 }
 public function saveQC($param){
  return $this->db->insert('control',$param);
 }
public function control($parametre){
  return $this->db->where($parametre)->get('control')->result_object();
}
public function controlData($parametre){
  return $this->db->where($parametre)->get('control')->row_object();
}

 public function somme_poinet($po){
   return $this->db->query("SELECT SUM(`ED_2E_CHOIX_SOMME`) AS 'SOMME' FROM `extrusion_coupe` WHERE `BC_ID`='".$po."'")->row_object();
 }
 public function insertmatierinression($data){
   return $this->db->insert('matierinression',$data);
 }
 public function se_to_time($sec)
	{
		return sprintf('%02d:%02d:%02d', floor($sec / 3600), floor($sec / 60 % 60), floor($sec % 60));
	}
  public function updateImpression($requette,$data) {
     return  $this->db->where($requette)->update('extrusion_inpression',$data);
  }
  public function StockChoix($parametre = 1){
        return $this->db->query("
           SELECT DISTINCT(`C_PO`) AS 'N_PO',
          (SELECT SUM(`C_CHOIX`) FROM `control` WHERE `C_PO` = N_PO ) AS 'STOCK',
          (SELECT SUM(`C_POID`) FROM `control` WHERE `C_PO` = N_PO ) AS 'POIS',
          (SELECT SUM(`CS_QTT`) FROM `sortie_control` WHERE `CS_PO` = N_PO ) AS 'SORTIE',
          (SELECT SUM(`ED_2E_CHOIX_SOMME`) FROM `extrusion_coupe` WHERE `BC_ID` = N_PO ) AS 'COUPE'
          FROM `control` WHERE $parametre
          ")->result_object();
  }
    public function StockChoixProd($parametre = 1){
        return $this->db->query("
           SELECT DISTINCT(`C_PO`) AS 'N_PO',
          (SELECT SUM(`C_CHOIX`) FROM `control` WHERE `C_PO` = N_PO ) AS 'STOCK',
          (SELECT SUM(`C_POID`) FROM `control` WHERE `C_PO` = N_PO ) AS 'POIS',
          (SELECT SUM(`CS_QTT`) FROM `sortie_control` WHERE `CS_PO` = N_PO ) AS 'SORTIE',
          (SELECT SUM(`ED_2E_CHOIX_SOMME`) FROM `extrusion_coupe` WHERE `BC_ID` = N_PO ) AS 'COUPE'
          FROM `control` WHERE $parametre
          ")->result_object();
  }
}
