<?php
class commande_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function type(){
    return $this->db->get('type_fiche_comme')
     ->result_object();
 }
 public function type_de_matier(){
    return $this->db->get('type_de_matier')
     ->result_object();
 }
 public function last_pe_commande(){
    return $this->db->limit(1)
     ->order_by('ID','DESC')
     ->get('refnum_pe')->row_object();
 }

 public function last_p_commande(){
    return $this->db->limit(1)
     ->order_by('ID_PE','DESC')
     ->get('refnum_p_madakem')->row_object();
 }

 public function last_l_commande(){
    return $this->db->limit(1)
     ->order_by('ID_PE','DESC')
     ->get('refnum_l_plasmad')->row_object();
 }



public function insert_P_commande_madakem(){
    return $this->db->insert('refnum_p_madakem',["PE_STATUT"=>"off"]);
}
public function insert_L_commande_madakem(){
    return $this->db->insert('refnum_l_plasmad',["PE_STATUT"=>"off"]);
}
 
 public function insert_pe_commande(){
    return $this->db->insert('refnum_pe',["PE_STATUT"=>"off"]);
}

public function get_last_refnum_cintre_cmti(){
    return $this->db->limit(1)
    ->order_by('ID','DESC')
    ->get('refnum_cintre_cmti')->row_object();
}

public function get_last_refnum_cintre_epz(){
    return $this->db->limit(1)
    ->order_by('ID','DESC')
    ->get('refnum_cintre_epz')->row_object();
}


public function last_pp_commande(){
    return $this->db->limit(1)
     ->order_by('PP_ID','DESC')
     ->get('refnum_pp')->row_object();
}
public function insert_pp_commande(){
    return $this->db->insert('refnum_pp',["PP_STATUT"=>"off"]);
}

 public function last_pe_commande_cmt_pp(){
    return $this->db->limit(1)
    ->order_by('ID_CMT','DESC')
    ->get('refnum_pp_cmt')->row_object();
}

public function insert_pe_commande_cmt_pp(){
    return $this->db->insert('refnum_pp_cmt',["ID_STATUT"=>"off"]);
}
public function last_pe_commande_cmtpe(){
    return $this->db->limit(1)
    ->order_by('CMT_ID','DESC')
    ->get('refnum_pe_cmt')->row_object();
}
public function insert_pe_commande_cmtpe(){
    return $this->db->insert('refnum_pe_cmt',["CMT_STATUT"=>"off"]);
}
public function select_commande($parametre){
    return $this->db->where($parametre) 
    ->get('commande')->row_object();  
    
}

public function update_commande($param,$data){
    return $this->db->where($param)
    ->update('commande',$data);
}
public function select_commande_all($parametre=array()){
    return $this->db->where($parametre) 
    ->get('commande')->result_object(); 

}
public function insert_commande($data){
    return $this->db->insert('commande',$data);
}

public function insert_refnum_cintre_cmti($data){
    return $this->db->insert('refnum_cintre_cmti',$data);
}
public function insert_refnum_cintre_epz($data){
    return $this->db->insert('refnum_cintre_epz',$data);
}

public function select_prix_appliquer($param){
    return $this->db->where($param)->get("prixappliquer")->row_object();
}
public function insert_prix_commande($data){
     return $this->db->insert('prix_commande',$data);
}

}