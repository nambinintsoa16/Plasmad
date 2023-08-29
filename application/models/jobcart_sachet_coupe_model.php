<?php
class jobcart_sachet_coupe_model extends CI_Model
{
  public function __construct()
  {
   
  }

  public function get_jobcart_sachet_coupe($param=array()){
    return $this->db->where($param)->get('jobcart_sachet_coupe')->result_object();
  }
  public function get_detail_jobcart_sachet_coupe($param){
    return $this->db->where($param)->get('jobcart_sachet_coupe')->row_object();
    
  }
  public function insert_jobcart_sachet_coupe($data){
    return $this->db->insert('jobcart_sachet_coupe',$data);
  }
  public function update_jobcart_sachet_coupe($param,$data){
    return $this->db->where($param)->update('jobcart_sachet_coupe',$data);
  }
  public function select_job_card_commande($parametre)
  {
    return $this->db->select('jobcart_sachet_coupe.JO_ETAT,jobcart_sachet_coupe.JO_IDS,commande.BC_DATELIVRE,BC_DIMENSIONPROD,jobcart_sachet_coupe.JO_SORTIE,jobcart_sachet_coupe.JO_PIECE,jobcart_sachet_coupe.JO_AV,jobcart_sachet_coupe.JO_ETAT,jobcart_sachet_coupe.JO_DATEFIN,jobcart_sachet_coupe.JO_DATEDEDEBU,jobcart_sachet_coupe.JO_DATEFIN,jobcart_sachet_coupe.JO_ID AS "JO_ID",JO_IDS,jobcart_sachet_coupe.JO_OBS,commande.BC_PE , JO_DATE, JO_MACHINE,JO_STATUT,JO_CREAT,JO_DURE,JO_DEB,JO_FIN ,JO_AV,BC_DATE ,BC_CLIENT ,BC_CODE,BC_DATELIVRE,BC_REASSORT,BC_ECHANTILLON,BC_DIMENSION,BC_RABAT,BC_SOUFFLET,BC_PERFORATION,BC_TYPE,BC_IMPRESSION,BC_CYLINDRE,BC_QUNTITE,BC_PRIX,BC_QUANTITEAPRODUIREENMETRE,BC_POIDSDUNSACHET,BC_POISENKGSAVECMARGE,BC_OBSERVATION,BC_COMMERCIAL,BC_VALIDATAIRE,BC_STATUT,BC_OBJETANNULATION,BC_TYPEPRODUIT,BC_TYPEMATIER,BC_MACHINE,BC_DATE_DE_PRODUCTION,BC_TYPE_PRODUIT,BC_ID,BC_MODEL,BC_PROCCESSUS,BC_ETAT')
      ->join("commande", "commande.BC_PE=jobcart_sachet_coupe.BC_PE")
      ->where($parametre)
      ->order_by('JO_IDS', "DESC")
      ->get('jobcart_sachet_coupe')->result_object();
  }
  public function delete_jobcart_sachet_coupe($param){
    return $this->db->where($param)->delete('jobcart_sachet_coupe');
  }
  public function last_insert_id(){
    $data = $this->db->limit(1)
    ->order_by('JO_ID','DESC')
    ->get('jobcart_sachet_coupe')->row_object();
    if($data){
      return $data->JO_ID;
    }else{
     
      return 0;
    }
  }
  public function last_insert_ids($param=array()){
    $data = $this->db->limit(1)
    ->where($param)
    ->order_by('JO_IDS','DESC')
    ->get('jobcart_sachet_coupe')->row_object();
    if($data){
      return $data->JO_IDS;
    }else{
     
      return 0;
    }
  }

}
