

<?php
class commercial_model extends CI_Model{
 public function __construct(){

 }

 public function listebondecommande(){
    return $this->db->get('bondecommande')->result_object();
}
public function type(){
     return $this->db->get('type_fiche_comme')->result_object();
}
public function insertrapportcommande($pram){
    return $this->db->insert('rapportcommande',$pram);
}
public function updaterapportcommande($requette,$pram){
    return $this->db->where($requette)->update('rapportcommande',$pram);
}
public function dateLivraison($pram){
    return $this->db->where($pram)->get('datedelivraison')->result_object();
}
	
public function selectrapportcommande($requette){
    return $this->db->where($requette)->get('rapportcommande')->row_object();
}
public function type_de_matier(){
     return $this->db->get('type_de_matier')->result_object();
}
public function listedate($parametre){
    return $this->db->where($parametre)->get('datedelivraison')->result_object();
}
public function cherchePre($parametre){
    return $this->db->where($parametre)
    ->get('pre_costing')->row_object();   
}
public function selectprixbon($parametre){
    return $this->db->where($parametre)->get('prixbon')->row_object();
}
public function countCommandeMois(){
 return   $this->db->like('BC_DATE',date('Y-m'))->count_all_results('bondecommande');
}
public function listedatedelivraison($parametre){
    $this->db->where($parametre);
    $this->db->join('bondecommande','bondecommande.BC_PE=datedelivraison.DL_PO');
    return $this->db->get('datedelivraison')->result_object();
}
public function chercheBon($parametre){
    return $this->db->where($parametre)
    ->get('bondecommande')->row_object();   
}

public function countCommandePlMois(){
    $this->db->like('BC_DATE',date('Y-m'));
    $this->db->like('BC_STATUT','PLANNIFIE');
    return  $this->db->count_all_results('bondecommande');
}
public function bondeprecosting($COMMERCIAL){
    return $this->db->where('BC_COMMERCIAL',$COMMERCIAL)
    ->get('pre_costing')->result_object();
}
public function rechercheMatierPr($parametre){
    return $this->db->where($parametre)->get('stock_matier_premier')->row_object();
}
public function stockfinal(){
    return $this->db->join("bondecommande","bondecommande.BC_PE=stock_produit_fini.BC_PE")
    ->get('stock_produit_fini')->result_object();
}
public function bondecommande($BC_PE,$COMMERCIAL){
    $this->db->where('BC_COMMERCIAL',$COMMERCIAL);
    $this->db->where('BC_PE',$BC_PE);
    return $this->db->get('bondecommande')->row_object();
}

public function bondecommandeTous($BC_PE){
    $this->db->where('BC_PE',$BC_PE);
    return $this->db->get('bondecommande')->row_object();
}


public function bondecommandes($COMMERCIAL){
    return $this->db->where('BC_COMMERCIAL',$COMMERCIAL)
           ->get('bondecommande')->result_object();
}
public function bondecommandesTous($parametre = array()){
    return $this->db->where($parametre)->get('bondecommande')->result_object();
}
public function PrebondeType($REQUETTE,$REQUETTELIKE=null){
    if($REQUETTELIKE!=null){ 
     return $this->db->where($REQUETTE)
            ->like($REQUETTELIKE)
            ->get('pre_costing')->result_object();
    }else{
     return $this->db->where($REQUETTE)
     ->get('pre_costing')->result_object();  
    }       
 }
public function bondeType($REQUETTE,$REQUETTELIKE=null){
   if($REQUETTELIKE!=null){ 
    return $this->db->where($REQUETTE)
           ->like($REQUETTELIKE)
           ->get('bondecommande')->result_object();
   }else{
    return $this->db->where($REQUETTE)
    ->get('bondecommande')->result_object();  
   }       
}

 


public function lastPEbondecommandePE(){
    $this->db->limit(1);
    $this->db->order_by('ID','DESC');
    return $this->db->get('pe_data')->row_object();
}
public function insertPEbondecommandePE(){
    return $this->db->insert('pe_data',["PE_STATUT"=>"off"]);
}
public function insertPEbondecommandePP(){
    return $this->db->insert('pp_data',["PP_STATUT"=>"off"]);
}
public function insertPEbondecommandeHDPE(){
     return $this->db->insert('hdpe',["HD_STATUT"=>"off"]);
}
public function lastPEbondecommandeCMTPE(){
     $this->db->limit(1);
    $this->db->order_by('CMT_ID','DESC');
    return $this->db->get('pe_cmt')->row_object();
}
public function lastPEbondecommandeCMTPP(){
     $this->db->limit(1);
    $this->db->order_by('ID_CMT','DESC');
    return $this->db->get('pp_cmt')->row_object();
}

public function lastCintreEPZ(){
     $this->db->limit(1);
    $this->db->order_by('ID','DESC');
    return $this->db->get('cintreEPZ')->row_object();
}

public function lastCintreCMTI(){
     $this->db->limit(1);
    $this->db->order_by('ID','DESC');
    return $this->db->get('cintreCMTI')->row_object();
}

public function insertCintreEPZ($data){
    return $this->db->insert('cintreEPZ',$data);
}

public function insertCintreCMTI($data){
    return $this->db->insert('cintreCMTI',$data);
}

public function lastPEbondecommandePP(){
    $this->db->limit(1);
    $this->db->order_by('PP_ID','DESC');
    return $this->db->get('pp_data')->row_object();
}

public function insertPEbondecommandeCMTPP($data){
      return $this->db->insert('pp_cmt',$data);
}
public function insertPEbondecommandeCMTPE($data){
      return $this->db->insert('pe_cmt',$data);
}

public function updateUresult($BC_PE,$BC_DATA){
    $this->db->where('BC_PE',$BC_PE);
    $this->db->set($BC_DATA);
    $this->db->update('bondecommande');
}
public function prixApp($PARAMERE){
    return $this->db->where($PARAMERE)->get('prixappliquer')->row_object();
}

public function updatePre($PARAMERE,$BC_DATA){
    $this->db->where($PARAMERE);
    $this->db->set($BC_DATA);
    $this->db->update('pre_costing');
}
public function insertPrecosting($data){
    return $this->db->insert('pre_costing',$data);
 
}
public function insertbondecommande($data){
    return $this->db->insert('bondecommande',$data);
}
public function getformule($parametre){
    return $this->db->where($parametre)->get('formule')->row_object();
}
public function insertprixbon($data){
   return $this->db->insert('prixbon',$data);
}

public function selectprixAppliquer($parametre){
    return $this->db->where($parametre)->get('prixappliquer')->row_object();
}
}
