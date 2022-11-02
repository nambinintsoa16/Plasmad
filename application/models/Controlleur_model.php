<?php
class Controlleur_model extends CI_Model{
 public function __construct(){

 }

public function insertDechet($param){
	return $this->db->insert('dechet',$param);
}
public function selectsDechet($param=array()){
	return $this->db->where($param)->get('dechet')->result_object();
}



/*** stock ***/

public function updateStockdechet($param,$data){
	return $this->db->where($param)->update('stockdechet',$data);
}
public function selectStockdechet($param=array()){
	return $this->db->where($param)->get('stockdechet')->row_object();
}

public function selectStockdechets($param){
	return $this->db->where($param)->get('stockdechet')->result_object();
}


public function delete_stock_materiel($param){
	return $this->db->where($param)->delete('stock_materiel');
}
public function select_stock_materiel($param){
	return $this->db->where($param)->get('stock_materiel')->row_object();
}
public function update_stock_matier_premier($param,$data){
	return $this->db->where($param)->update('stock_matier_premier',$data);
}
public function select_stock_matier_premier($param){
	return $this->db->where($param)->get('stock_matier_premier')->row_object();
}
public function select_sortie_materiel($param){
	return $this->db->where($param)->get('sortie_materiel')->row_object();
}
public function delete_sortie_materiel($param){
	return $this->db->where($param)->delete('sortie_materiel');
}


public function select_entree_materiel($param){
	return $this->db->where($param)->get('entree_materiel')->row_object();
}
public function delete_entree_materiel($param){
	return $this->db->where($param)->delete('entree_materiel');
}


/*******************************************/
public function cherchePEEX($param){
	return $this->db->where($param)->get("extrusion")->result_object();
}
public function dataImpressionExtrusion($param){
	return $this->db->where($param)->get("extrusion_inpression")->result_object();
}
public function dataCoupeExtrusion($param){
	return $this->db->where($param)->get("extrusion_coupe")->result_object();
}
public function machineRow($param){
	return $this->db->where($param)->get("machine")->row_object(); 
  }
 
public function insertSortieControl($param){
   return $this->db->insert("sortie_control",$param); 
}
public function selectsortie_control($param=array()){
	return $this->db->where($param)->get("sortie_control")->result_object(); 	
}

public function deletesortie_control($param=array()){
	return $this->db->where($param)->delete("sortie_control"); 	
}
public function sortie_materiel($parametre){
    $this->db->join('stock_materiel','stock_materiel.LI_SORTIE=sortie_materiel.MS_ID');
    $this->db->where($parametre);
   return $this->db->get('sortie_materiel')->result_object();
}  
 public  function detailPo($parametre=array()){
  return $this->db->where($parametre)->get("bondecommande")->row_object();

 }
 public function Allstock_produit_fini($parametre){
    return  $this->db->where($parametre)->get('stock_produit_fini')->result_object(); 
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
	public function cherchePEEXVer($param){
		return $this->db->where($param)->get("extrusion")->row_object();
	  }


	  public  function insertRecycle($parametre){
		return $this->db->insert("mouvement_recycle",$parametre);
	  
	   }  
	   public function selectsRecyleChange($param){
		return $this->db->where($param)->get("mouvement_recycle")->result_object();
	  }
	   
	  
public function select_sortie_materiel_PO($param){
		return 	$this->db->join('stock_materiel','bondecommande.BC_PE=stock_materiel.LI_REFERENCE')
		    ->join('sortie_materiel','stock_materiel.LI_SORTIE=sortie_materiel.MS_ID')
			->where($param)
			->group_by('bondecommande.BC_PE')
			->order_by('bondecommande.BC_ID','DESC')
			->get('bondecommande')->result_object();
}



}
