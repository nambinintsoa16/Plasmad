<?php
class global_model extends CI_Model
{
  public function __construct()
  {
  }
 
  public function get_sum_colum($param = array(), $colum, $table)
  {
    return $this->db->where($param)->select_sum($colum)->get($table)->row_object();
  }
  public function get_distinct_colum($param = array(), $colum, $table)
  {
    return $this->db->select($colum)->distinct()->where($param)->get($table)->result_object();
  }
  public function get_data_with_parameters($param = array(),$table){
    return $this->db->where($param)->get($table)->result_object();
  }
  public function insert_in_table($table_name,$data_insert){
    return $this->db->insert($table_name,$data_insert);
  }
  public function init_table($table_name){
       return $this->db->truncate($table_name);
  }
  public function array_unique($array,$unique_key){
    if(!is_array($array))
       return $array;
   
    $unique_keys=array();
    foreach ($array as $key => $items) {
        if(!in_array($items[$unique_key],$unique_keys))
           $unique_keys[$items[$unique_key]] =$items;
    }
   return $unique_keys;
 }
  public function get_somme_time($champ,$param=array(),$table){
    return $this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC($champ))) AS 'format_heure' , SUM(TIME_TO_SEC($champ)) AS 'second_format'")
    ->where($param)
    ->get($table)->row_object();
  }
  public function get_data_joint_parameter($int_table,$joint_table,$param_joint,$param_select){
    return $this->db->where($param_select)
            ->join($joint_table,$param_joint)
            ->get($int_table)
            ->result_object();
  }
  public function get_data_joint_parameter_group_by($int_table,$joint_table,$param_joint,$param_select,$group_by){
    return $this->db->where($param_select)
            ->join($joint_table,$param_joint)
            ->group_by($group_by)
            ->get($int_table)
            ->result_object();
  }
  public function get_detail_joint_parameter($int_table,$joint_table,$param_joint,$param_select){
    return $this->db->where($param_select)
            ->join($joint_table,$param_joint)
            ->get($int_table)
            ->row_object();
  }
  public function select_data_joint_colum($requette=array(),$selection="*",$joint,$table1,$table2){
    return $this->db->select($selection)
    ->where($requette)
    ->join($table1,$joint)
    ->get($table2)
    ->result_array();
  }
  public function select_job_card_commande($parametre)
  {
    return $this->db->select('jobcart_sachet_extrusion.JO_ETAT,jobcart_sachet_extrusion.JO_IDS,commande.BC_DATELIVRE,BC_DIMENSIONPROD,jobcart_sachet_extrusion.JO_SORTIE,jobcart_sachet_extrusion.JO_PIECE,jobcart_sachet_extrusion.JO_AV,jobcart_sachet_extrusion.JO_ETAT,jobcart_sachet_extrusion.JO_DATEFIN,jobcart_sachet_extrusion.JO_DATEDEDEBU,jobcart_sachet_extrusion.JO_DATEFIN,jobcart_sachet_extrusion.JO_ID AS "JO_ID",JO_IDS,jobcart_sachet_extrusion.JO_OBS,commande.BC_PE , JO_DATE, JO_MACHINE,JO_STATUT,JO_CREAT,JO_DURE,JO_DEB,JO_FIN ,JO_AV,BC_DATE ,BC_CLIENT ,BC_CODE,BC_DATELIVRE,BC_REASSORT,BC_ECHANTILLON,BC_DIMENSION,BC_RABAT,BC_SOUFFLET,BC_PERFORATION,BC_TYPE,BC_IMPRESSION,BC_CYLINDRE,BC_QUNTITE,BC_PRIX,BC_QUANTITEAPRODUIREENMETRE,BC_POIDSDUNSACHET,BC_POISENKGSAVECMARGE,BC_OBSERVATION,BC_COMMERCIAL,BC_VALIDATAIRE,BC_STATUT,BC_OBJETANNULATION,BC_TYPEPRODUIT,BC_TYPEMATIER,BC_MACHINE,BC_DATE_DE_PRODUCTION,BC_TYPE_PRODUIT,BC_ID,BC_MODEL,BC_PROCCESSUS,BC_ETAT')
      ->join("commande", "commande.BC_PE=jobcart_sachet_extrusion.BC_PE")
      ->where($parametre)
      ->order_by('JO_IDS', "DESC")
      ->get('jobcart_sachet_extrusion')->result_object();
  }

  public function select_detail_job_card_commande($parametre)
  {
    return $this->db->select('jobcart_sachet_extrusion.JO_ETAT,jobcart_sachet_extrusion.JO_IDS,commande.BC_DATELIVRE,BC_DIMENSIONPROD,jobcart_sachet_extrusion.JO_SORTIE,jobcart_sachet_extrusion.JO_PIECE,jobcart_sachet_extrusion.JO_AV,jobcart_sachet_extrusion.JO_ETAT,jobcart_sachet_extrusion.JO_DATEFIN,jobcart_sachet_extrusion.JO_DATEDEDEBU,jobcart_sachet_extrusion.JO_DATEFIN,jobcart_sachet_extrusion.JO_ID AS "JO_ID",JO_IDS,jobcart_sachet_extrusion.JO_OBS,commande.BC_PE , JO_DATE, JO_MACHINE,JO_STATUT,JO_CREAT,JO_DURE,JO_DEB,JO_FIN ,JO_AV,BC_DATE ,BC_CLIENT ,BC_CODE,BC_DATELIVRE,BC_REASSORT,BC_ECHANTILLON,BC_DIMENSION,BC_RABAT,BC_SOUFFLET,BC_PERFORATION,BC_TYPE,BC_IMPRESSION,BC_CYLINDRE,BC_QUNTITE,BC_PRIX,BC_QUANTITEAPRODUIREENMETRE,BC_POIDSDUNSACHET,BC_POISENKGSAVECMARGE,BC_OBSERVATION,BC_COMMERCIAL,BC_VALIDATAIRE,BC_STATUT,BC_OBJETANNULATION,BC_TYPEPRODUIT,BC_TYPEMATIER,BC_MACHINE,BC_DATE_DE_PRODUCTION,BC_TYPE_PRODUIT,BC_ID,BC_MODEL,BC_PROCCESSUS,BC_ETAT')
      ->join("commande", "commande.BC_PE=jobcart_sachet_extrusion.BC_PE")
      ->where($parametre)
      ->get('jobcart_sachet_extrusion')->row_object();
  }
  public function select_data_stock_deuxieme_choix($parametre = 1){
    return $this->db->query("
       SELECT DISTINCT(`C_PO`) AS 'N_PO',
      (SELECT SUM(`C_CHOIX`) FROM `controle_qualite` WHERE `C_PO` = N_PO ) AS 'STOCK',
      (SELECT SUM(`C_POID`) FROM `controle_qualite` WHERE `C_PO` = N_PO ) AS 'POIS',
      (SELECT SUM(`CS_QTT`) FROM `sortie_control_qualite` WHERE `CS_PO` = N_PO ) AS 'SORTIE',
      (SELECT SUM(`ED_2E_CHOIX_SOMME`) FROM `sachet_coupe` WHERE `BC_ID` = N_PO ) AS 'COUPE'
      FROM `controle_qualite` WHERE $parametre
      ")->result_object();
}
  public function count_data_result($param = array(), $table){
    return $this->db->where($param)->count_all_results($table);
  }
}
