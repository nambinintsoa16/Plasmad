
<?php
class compta_model extends CI_Model{
 public function __construct(){

 }
 public function entree_materiel($parametre){
    $this->db->join('stock_materiel','stock_materiel.LI_ENTRE=entree_materiel.EM_ID');
    $this->db->where($parametre);
    return $this->db->get('entree_materiel')->result_object();
 }
 public function listeMatier($prametre){
	return  $this->db->where($prametre)->get('stock_matier_premier')->result_object();
}
public function updateStock_matier_premier($requette,$data){
      return    $this->db->where($requette)->update('stock_matier_premier',$data);
}
public function prixbon($parametre){
	return $this->db->where($parametre)->get('prixbon')->row_object();

}
public function prixbonAppliquer($parametre){
	return $this->db->where($parametre)->join('prixappliquer', 'prixappliquer.PA_ID =prixbon.PB_ID_HM')->get('prixbon')->row_object();

}
public function control($parametre){
	return $this->db->where($parametre)->get('control')->result_object();
  }
public function controlData($parametre){
	return $this->db->where($parametre)->get('control')->row_object();
  }
  public function controlDatas($parametre){
	return $this->db->where($parametre)->get('control')->result_object();
  }
 public  function lisPeDuMois($parametre,$params=array()){
  return $this->db->where($params)->where($parametre)->get("bondecommande")->result_object();

 }
 public function selectPrixBon($requette){
 	return $this->db->where($requette)->get("prixbon")->row_object();
 }  

public function stock_materiel($parametre){
	return $this->db
	->where($parametre)
	->get('stock_materiel')
	->result_object();
}
public function extrusion($parametre){
	return $this->db->where($parametre)
	->join('bondecommande','bondecommande.BC_PE=extrusion.EX_BC_ID')
	->get("extrusion")->result_object(); 
  }
public function extrusion_coupe($parametre){
	return $this->db->where($parametre)
	->join('bondecommande','bondecommande.BC_PE=extrusion_coupe.BC_ID')
	->get("extrusion_coupe")->result_object(); 
}

public function extrusion_coupedata($parametre){
	return $this->db->where($parametre)
	->get("extrusion_coupe")->result_object(); 
}


public function extrusion_inpression($parametre){
  return $this->db->where($parametre)
  ->join('bondecommande','bondecommande.BC_PE=extrusion_inpression.BC_ID')
  ->get("extrusion_inpression")->result_object(); 
}
public function matier_utiliser($parametre){
	return $this->db->where($parametre)->get("matier_utiliser")->result_object(); 
	
}
public function lisClientDuMois($parametre){
	return $this->db->distinct()
	 ->select('BC_CODE')
	 ->limit(10)
	 ->where($parametre)->get("bondecommande")->result_object(); 
}
public function deleteQC($parametre){

	return $this->db->where($parametre)->delete('control');
}


public function listeLivraison($parametre){
	return $this->db->join('bondecommande','bondecommande.BC_PE=livraison.LV_PO')
	 ->group_by('bondecommande.BC_CODE')
	 ->where($parametre)->get("livraison")->result_object(); 

}

public function insert_stock_matier_premier($data){
 return $this->db->insert('stock_matier_premier',$data);
}

public function insertlivraison($data){
	return $this->db->insert('livraison',$data);
}
public function selectLivre($parametre=array()){
	return $this->db->where($parametre)->get('livraison')->row_object();
}
public function selectLivres($parametre=array()){
	return $this->db->where($parametre)->get('livraison')->result_object();
}

public function bon($parametre=array()){
	return $this->db->where($parametre)->get("bondecommande")->result_object(); 

}
public function time_to_sec($time){
		list($h,$m,$s) = explode(":",$time);
		$seconds = 0;
		$seconds += (intval($h)*3600);
		$seconds += (intval($m)*60);
		$seconds += (intval($s));
		return $seconds;

	}
	public function se_to_time($sec){
		return sprintf('%02d:%02d:%02d',floor($sec/3600),floor($sec/60%60),floor($sec%60));
	}

public function matierinression($parametre){
 	return $this->db->where($parametre)->get("matierinression")->result_object(); 
}
public function autocompleteStockAll($mot){
	$this->db->like('ST_DESIGNATION', $mot); 
	$this->db->like('ST_ORIGIN', "PLASMAD_MAGASIN"); 
	return $this->db->get("stock_matier_premier")->result_object();
 }


}


