<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Surplus extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
    }
	public function Stock(){
		$this->render_view("surplus/stock/Stock");
	}
	public function entree_control_quality(){
		$this->render_view("surplus/control_quality/entree_control_quality");
	}
	public function Entree(){
		$this->render_view("surplus/stock/Entree");
	}
	public function Liste_des_entrees(){
		$this->render_view("surplus/stock/Liste_des_entrees");
	}
	public function Sortie(){
		$this->render_view("surplus/stock/Sortie");
	}
	public function Sortie_gaine(){
		$this->render_view("surplus/stock/Sortie_surplus_gaines");
	}
	public function Liste_des_sorties(){
		$this->render_view("surplus/stock/Liste_des_sorties");
	}
	public function save_entree_surplus()
	{
		
		$this->load->model('stock_surplus_produit_finis');
		$this->load->model('entree_surplus_finis');
		$this->load->model('commande');
		$date = $this->input->post('date');
		 if($date ==""){
			$date = ("Y-m-d");
		 }
		 $refnum = $this->input->post('refnum');
		 $client = $this->input->post('client');
		 $code_client = $this->input->post('code_client');
		 $dim = $this->input->post('dim');
		 $tail = $this->input->post('tail');
		 $quantite = $this->input->post('quantite');
		 $localisation = $this->input->post('localisation');
		 $obs = $this->input->post('obs');
		$detal_commande = $this->commande->select_commande (["BC_PE" => $refnum]);
		$methodOk = $detal_commande != null;
		if($methodOk){
			$data = [
				"EF_QUANTITE" => $quantite,
				"EF_DATE" => $date,
				"EF_MAGASIN" => $this->session->userdata('matricule'),
				"BC_ID" => $refnum,
				"STF_OBSE" => $obs,
				"EF_TAILL" => $tail,
				"STF_LOCALISATION" =>$localisation
			];
			$methodOk = $this->entree_surplus_finis->insert_entree_surplus_finis($data);
		}
	
		if ($methodOk) {
			$param = ["BC_ID" => $refnum,"STF_TAIL"=>$tail];
			$reponse = $this->stock_surplus_produit_finis->get_detail_stock_surplus_produit_finis($param);
			$methodOk = $reponse != null;
			if($methodOk ){
					$quantite_update = $reponse->STF_QUANTITE + $quantite;
					$methodOk = $this->stock_surplus_produit_finis->update_stock_surplus_produit_finis(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $quantite_update]);
			} else {
					$param = [
						"BC_ID" => $refnum,
						"STF_QUANTITE" => $quantite,
						"STF_TAIL" => $tail,
						"STF_CLIENT" => $client,
						"STF_DIM" => $dim,
						"STF_LOCALISATION" => $localisation
					];
					$methodOk = $this->stock_surplus_produit_finis->insert_stock_surplus_produit_finis($param);
			}
			
		}	
      echo $methodOk;
		
	}
	public function data_liste_sortie_surplus()
	{
		$this->load->model('sortie_surplus_finis');
		$date_debut = $this->input->get('debut');
		$date_fin = $this->input->get('fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->sortie_surplus_finis->get_sortie_surplus_finis(("SF_DATE BETWEEN $date_debut AND $date_fin"));
		} 
		
		$methodOk = $date_debut!="";
		if ($methodOk) {
			$datas = $this->sortie_surplus_finis->get_sortie_surplus_finis(("SF_DATE like '$date_debut%'"));
		} 

		if(!$methodOk) {
			$datas = $this->sortie_surplus_finis->get_sortie_surplus_finis();
		}
		
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->SF_ID;
			$sub_array[] = $row->SF_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->SF_MAGASIN;
			$sub_array[] = $row->SF_BL;
			$sub_array[] = $row->SF_TAILL;
			$sub_array[] = $row->SF_QUANTITE;
			$sub_array[] = $row->SF_DESTINATION;
			$sub_array[] = $row->STF_OBSE;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_liste_entree_surplus()
	{
		$this->load->model('entree_surplus_finis');
		$date_debut = $this->input->get('debut');
		$date_fin = $this->input->get('fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->entree_surplus_finis->get_entree_surplus_finis(("STF_DATE BETWEEN $date_debut AND $date_fin"));
		} 
		
		$methodOk = $date_debut!="";
		if ($methodOk) {
			$datas = $this->entree_surplus_finis->get_entree_surplus_finis(("STF_DATE like '$date_debut%'"));
		} 
	
		if(!$methodOk) {
			$datas = $this->entree_surplus_finis->get_entree_surplus_finis();
		}
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->EF_ID;
			$sub_array[] = $row->EF_DATE;
			$sub_array[] = $row->EF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->EF_TAILL;
			$sub_array[] = $row->EF_QUANTITE;
			$sub_array[] = $row->STF_LOCALISATION;
			$sub_array[] = $row->STF_OBSE;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_liste_controle_qualite()
	{
		$this->load->model('controle_qualite');
		$date_debut = $this->input->get('debut');
		$date_fin = $this->input->get('fin');
        $refnum_pe = $this->input->get('refnum');
		$methodOk = $refnum_pe !="";
		if ($methodOk) {
			$datas = $this->controle_qualite->get_controle_qualite(["C_PO" =>$refnum_pe]);
		} 
	

		$methodOk = (isset($date_debut) & isset($date_fin));
		if ($methodOk) {
			$datas = $this->controle_qualite->get_controle_qualite("C_DATE BETWEEN '$date_debut' AND '$date_fin'");
		} 


		$methodOk = $date_debut!="" & !$methodOk;
		if ($methodOk) {
			$datas = $this->controle_qualite->get_controle_qualite(["C_DATE" => $date_debut]);
			
		} 
		$methodOk = $date_debut=="" & $refnum_pe =="";
		if($methodOk) {
			$datas = $this->controle_qualite->get_controle_qualite();
			
		}
		

		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->C_DATE;
			$sub_array[] = $row->C_PO;
			$sub_array[] = $row->C_QC;
			$sub_array[] = $row->C_POID;
			$sub_array[] = $row->C_ENTRE;
			$sub_array[] = $row->C_CHOIX;
			$sub_array[] = $row->C_TTS;
			$sub_array[] = "<a href='#' id='$row->C_ID' class='btn btn-danger btn-sm delete_select'><i class='fa fa-trash'></i> Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_liste_produit_surplus(){
		$this->load->model('stock_surplus_produit_finis');
		$date_debut = $this->input->get('debut');
		$date_fin = $this->input->get('fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->stock_surplus_produit_finis->get_stock_surplus_produit_finis(("STF_DATE BETWEEN $date_debut AND $date_fin"));
		} 
		
		$methodOk = $date_debut!="";
		if ($methodOk) {
			$datas = $this->stock_surplus_produit_finis->get_stock_surplus_produit_finis(("STF_DATE like '$date_debut%'"));
		} 
	
		if(!$methodOk) {
			$datas = $this->stock_surplus_produit_finis->get_stock_surplus_produit_finis();
		}

		$data = array();
		foreach ($datas as $row) {
		
			$sub_array = array();
			$sub_array[] = $row->STF_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->STF_CLIENT;
			$sub_array[] = $row->STF_DIM;
			$sub_array[] = $row->STF_TAIL;
			$sub_array[] = $row->STF_QUANTITE;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			//$sub_array[] = 0;
			$sub_array[] = $row->STF_LOCALISATION;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info info_produit btn-sm'><i class='fa fa-info'><i/></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
		}
		public function detail_commande_surplus(){
			$this->load->model('global');
			$this->load->model('stock_surplus_produit_finis');
			$refnum_pe = $this->input->post("refnum_pe");
			$reponse =$this->stock_surplus_produit_finis->get_detail_stock_surplus_produit_finis(["BC_ID"=>$refnum_pe]); 
			$methodOk = $reponse != null;
			$resultat = ['message'=>false];
			if($methodOk){
				$resultat['client']=$reponse->STF_CLIENT;
				$quantite_disponible = $this->stock_surplus_produit_finis->get_detail_stock_surplus_produit_finis("BC_ID ='$reponse->BC_ID' ORDER BY STF_ID DESC");
				$resultat['quantite_disponible']= $quantite_disponible!= null ?$quantite_disponible->STF_QUANTITE:0;
				$resultat['dim']=$reponse->STF_DIM;
				$resultat['tail']= $this->stock_surplus_produit_finis->get_tail_commande_stock('STF_TAIL AS tail',["BC_ID"=>$reponse->BC_ID],"STF_TAIL","STF_ID"); 
				$resultat['rack']=$this->stock_surplus_produit_finis->get_tail_commande_stock('STF_LOCALISATION AS rack',["BC_ID"=>$reponse->BC_ID],"STF_LOCALISATION","STF_ID");
				
			
			}
			echo json_encode($resultat);
		}

		public function get_quantite_dispo_stock(){
			$refnum = $this->input->post("refnum");
			$tail = $this->input->post("tail");
			$rack = $this->input->post("rack");
			$quantite_disponible = $this->stock_surplus_produit_finis->get_detail_stock_surplus_produit_finis(["BC_ID"=> $refnum,"STF_TAIL"=>$tail,"STF_LOCALISATION"=>$rack]);
			if($quantite_disponible){
				echo $quantite_disponible->STF_QUANTITE;
			}else{
				echo 0;
			}
		}
	
		public function save_controle_qualite()
		{
			$this->load->model('controle_qualite');
			$this->load->model('stock_deuxieme_choix_plasmad');
			$date =  date("Y-m-d");
			$operateur = $this->input->post('operateur');
			$quantite_choix = $this->input->post('deuxieme_choix');
			$refnum = $this->input->post('refnum_pe');
			$tail = $this->input->post('tail');
			$dim = $this->input->post('dimm'); 
		
			
			$data = ["SD_PO"=>$refnum,"SD_TAILL"=> $tail];
			$deuxieme_choix = $this->stock_deuxieme_choix_plasmad->get_detail_stock_deuxieme_choix_plasmad($data);
			$methodOk = $deuxieme_choix != null;
	
			if($methodOk){
			    $quantite = $quantite_choix + $deuxieme_choix->SD_QUANTITE;
				$requette = ["SD_ID"=>$deuxieme_choix->SD_ID,"SD_TAILL"=> $tail];
				$data = ["SD_QUANTITE"=> $quantite];
				$methodOk = $this->stock_deuxieme_choix_plasmad->update_stock_deuxieme_choix_plasmad($requette,$data);
			}else{
				$data = ["SD_QUANTITE"=> $quantite_choix,"SD_PO"=>$refnum,"SD_DIMM"=>$dim,"SD_TAILL"=>$tail];
				$methodOk  =$this->stock_deuxieme_choix_plasmad->insert_stock_deuxieme_choix_plasmad($data);
			}
			
            if($methodOk){
				$data = [
					"C_DATE" =>$date,
					"C_QC" => $operateur,
					"C_ENTRE" => $this->input->post('qtt_entre'),
					"C_PO" => $refnum,
					"C_TTS" => $this->input->post('qtt_stie'),
					"C_CHOIX" =>$quantite_choix,
					"C_POID" => $this->input->post('poid_entree'),
					"C_ENTREE_USERS"=>$this->session->userdata('matricule')
				];
				$methodOk = $this->controle_qualite->insert_controle_qualite($data);
			}

			if($methodOk){
				$methodOk = $this->sortie_produit_fini($date,$refnum,$tail,$quantite_choix,$operateur);
			}

			echo $methodOk;
		}

		public function sortie_produit_fini($date,$refnum,$tail,$quantite,$operatrice){
			$this->load->model('sortie_produits_finis');
			$this->load->model('stock_produit_finis');
			$detail_produit = $this->stock_produit_finis->get_detail_stock_produit_finis(["BC_ID" => $refnum,"STF_TAIL"=>$tail]);
			$methodOk = $detail_produit != null;
			if ($methodOk) {
				$obs = "Trie control qualite : ".$operatrice;
				$BL =  "0000000";
				$parametre = [
					"SF_DATE" => $date,
					"SF_BL" => $BL,
					"SF_TAILL" => $tail,
					"SF_QUANTITE" => $quantite,
					"BC_ID" => $refnum,
					"SF_MAGASIN" => $this->session->userdata("matricule"),
					"SF_ORIGIN"=>$obs,
					"STF_OBSE" =>""
				];
				$methodOk = $this->sortie_produits_finis->insert_sortie_produits_finis($parametre);
			}
			if ($methodOk) {
					$quantite = $detail_produit->STF_QUANTITE - $quantite;
					$methodOk = $this->stock_produit_finis->update_stock_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
			}
	
			echo $methodOk;
	
		}
	public function delete_select_controle_qualite(){
		$this->load->model('controle_qualite');
		$refnum = $this->input->post("refnum");
        $param = ['C_ID'=>$refnum];
		$methodOk = $this->controle_qualite->delete_controle_qualite($param);
		echo $refnum;
	}
	public function liste_entree_control_quality(){
		$this->render_view('surplus/control_quality/listes_control_qualite');
	}	
}