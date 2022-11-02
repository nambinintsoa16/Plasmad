<?php
class magasiner_model extends CI_Model{
 public function __construct(){

 }
public function insertSortie($data){
    return $this->db->insert('sortie',$data);
}
public function listebondecommande($parametre){
    return $this->db->where($parametre)->get('bondecommande')->result_object();
}


public function selectStock_matier_premier($parametre){
	return $this->db->where($parametre)->get('stock_matier_premier')->result_object();
}
public function insertStock_matier_premier($parametre){
    return  $this->db->insert('stock_matier_premier',$parametre);
}
public function listeMatier($parametre=array()){
	 return  $this->db->where($parametre)->get('stock_matier_premier')->result_object();
}
public function updateMatier($parametre,$data){
   return $this->db->where($parametre)->update("matier_utiliser",$data);
}
public function sortie_materiel($requette=array()){
    $this->db->join('stock_materiel','stock_materiel.LI_SORTIE=sortie_materiel.MS_ID');
    $this->db->where('LI_ORIGIN','PLASMAD_MAGASIN');
	$this->db->where($requette);
   return $this->db->get('sortie_materiel')->result_object();
}

public function sortie_materiel_date($parametre){
    $this->db->join('stock_materiel','stock_materiel.LI_SORTIE=sortie_materiel.MS_ID');
    $this->db->where('LI_ORIGIN','PLASMAD_MAGASIN');
    $this->db->where($parametre);
   return $this->db->get('sortie_materiel')->result_object();
}
public function sortie_materielParama($parametre){
    $this->db->join('stock_materiel','stock_materiel.LI_SORTIE=sortie_materiel.MS_ID');
    $this->db->where('LI_ORIGIN','PLASMAD_MAGASIN');
    $this->db->where($parametre);
   return $this->db->get('sortie_materiel')->result_object();
}

public function entre_produit_fini($parametre){
    $this->db->join('bondecommande','bondecommande.BC_PE=entre_produit_fini.BC_ID');
    return $this->db->where($parametre)->get('entre_produit_fini')->result_object();
}
public function dataentre_produit_fini($parametre){
    return $this->db->where($parametre)->get('entre_produit_fini')->result_object();
}

public function deleteEntre_produit_fini($parametre){
    return $this->db->where($parametre)->delete('entre_produit_fini');
}
public function dataentre_produit_finis($parametre){
    return $this->db->where($parametre)->get('entre_produit_fini')->row_object();
}
public function delete_entre_produit_finis($parametre){
    return $this->db->where($parametre)->delete('entre_produit_fini');
}
public function entree_materiel(){
    $this->db->join('stock_materiel','stock_materiel.LI_ENTRE=entree_materiel.EM_ID');
    $this->db->where('LI_ORIGIN','PLASMAD_STOCK');
    return $this->db->get('entree_materiel')->result_object();
 }
public function entree_materiel_Mag($requette=array()){
    $this->db->join('stock_materiel','stock_materiel.LI_ENTRE=entree_materiel.EM_ID');
    $this->db->where('EM_ORIGIN','PLASMAD_MAGASIN');
	$this->db->where($requette);
    return $this->db->get('entree_materiel')->result_object();
 }
public function listeMatierUtiliser($parametre){
	 return  $this->db->where($parametre)->get('matier_utiliser')->result_object();
}
public function insertentree_materiel($parametre){
    return  $this->db->insert('entree_materiel',$parametre);
}
public function insertsortie_materiel($parametre){
    return  $this->db->insert('sortie_materiel',$parametre);
}
public function insertstock_materiel($parametre){
    return  $this->db->insert('stock_materiel',$parametre);
}
public function lsatInsetEntre(){
    $this->db->limit(1);
    $this->db->order_by('EM_ID','DESC');
    return $this->db->get('entree_materiel')->row_object();
 }
 public function lsatInsetSortie(){
    $this->db->limit(1);
    $this->db->order_by('MS_ID','DESC');
    return $this->db->get('sortie_materiel')->row_object();
 }
 public function updatestock_matier_premier($parametre,$data){
    return $this->db->where($parametre)->update("stock_matier_premier",$data);
 }
 public function select_stock_matier_premier($parametre){
    return  $this->db->where($parametre)->get('stock_matier_premier')->row_object();
 }

public function autocompletePo($mot){
    return $this->db->like("BC_PE",$mot)
    ///->where("(BC_STATUT <> 'NON PLANNIFIE' AND  BC_STATUT <>'TERMINER') LIMIT 10")
    ->LIMIT(10)
    ->get("bondecommande")->result_object(); 
  }

  public function autocompleteSo($mot){
    return $this->db->distinct()
    ->select("BC_ID")
    ->where("STF_ORIGIN","PLASMAD_MAGASIN")
    ->like("BC_ID",$mot)
    ->get("stock_produit_fini")->result_object(); 
  }
 public function autocompleteSortie($mot){
    return $this->db->distinct()
    ->select("BC_ID")
    ->limit(10)
    //->where("STF_ORIGIN","PLASMAD_MAGASIN")
    ->like("BC_ID",$mot)
    ->get("stock_produit_fini")->result_object(); 
  }
public function autocompletesurplus($mot){
    return $this->db->distinct()
    ->select("BC_ID")
    ->where("STF_ORIGIN","PLASMAD_STOCK")
    ->like("BC_ID",$mot)
    ->get("stock_produit_fini")->result_object(); 
  }
public function bondecommande($parametre){
    return  $this->db->where($parametre)->get('bondecommande')->row_object();
    
}
public function insertentre_produit_fini($parametre){
    return  $this->db->insert('entre_produit_fini',$parametre);
}
public function selectstock_produit_fini($parametre){
    return  $this->db->where($parametre)->get('stock_produit_fini')->row_object(); 
}

public function updatestock_produit_fini($parametre,$data){
    return  $this->db->where($parametre)->update('stock_produit_fini',$data); 
}

public function Allstock_produit_fini($parametre){
    return  $this->db->where($parametre)->get('stock_produit_fini')->result_object(); 
}
public function insertstock_produit_fini($parametre){
    return  $this->db->insert('stock_produit_fini',$parametre);
}
public function updateproduit_fini($parametre,$data){
    return $this->db->where($parametre)->update("stock_produit_fini",$data);
 }


 public function queryall($parametre){
    return $this->db->query($parametre)->result_object();
 }
public function dataLivraison($parametre){
    return  $this->db
    ->where($parametre)
    ->join('stock_produit_fini','entre_produit_fini.BC_ID=stock_produit_fini.BC_ID')
    ->get('entre_produit_fini')
    ->result_object();  
}


public function autocompletMa($mot){
  $this->db->like('MA_DESIGNATION', $mot);
  return $this->db->get('machine')->result_object();
}

}

