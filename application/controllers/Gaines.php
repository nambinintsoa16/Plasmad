<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Gaines extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("stock_gaines_plasmad");
		$this->load->model("entree_gaines");
		$this->load->model("sortie_gaines");
		
    }
	public function Stock_gaine(){
		$this->render_view("gaines/stock/Stock");
	}
	public function Entree(){
		$this->render_view("gaines/stock/Entree");
	}
	public function Liste_des_entrees(){
		$this->render_view("gaines/stock/Liste_des_entrees");
	}
	public function Sortie(){
		$this->render_view("gaines/stock/Sortie");
	}
	public function Liste_des_sorties(){
		$this->render_view("gaines/stock/Liste_des_sorties");
	}
    public function detail_commande_livraison_gaine(){
		$this->load->model('global');
		$this->load->model('stock_gaines_plasmad');
		$refnum_pe = $this->input->post("refnum_pe");
        $reponse =$this->commande->select_commande(["BC_PE"=>$refnum_pe]); 
		$methodOk = $reponse != null;
		$resultat = ['message'=>false];
		if($methodOk){
			$resultat['client']=$reponse->BC_CLIENT;
			$resultat['dim']=$reponse->BC_DIMENSION;
			$resultat['code']=$reponse->BC_CODE;
			$resultat['quantite']=$reponse->BC_QUNTITE;
			$resultat['sortie']=0;
			$temp_quantite = explode("P",$reponse->BC_QUNTITE);
		    $quantite = $this->global->get_sum_colum(["BC_ID"=>$reponse->BC_PE,"SF_ORIGIN"=>'Sortie livraison'],'SF_QUANTITE','sortie_gaines'); 
			$quantite_retour = $this->global->get_sum_colum(["BC_ID"=>$reponse->BC_PE,"EF_TYPE"=>'retour'],'EF_QUANTITE','entree_produits_finis'); 
			//$quantite_surplus = $this->global->get_sum_colum(["SF_DESTINATION"=>$reponse->BC_PE],'SF_QUANTITE','sortie_surplus_finis'); 
			//$resultat['sortie']=$quantite->SF_QUANTITE + $quantite_surplus->SF_QUANTITE; 
			$quantite_disponible = $this->stock_gaines_plasmad->get_detail_stock_gaines_plasmad("BC_ID ='$reponse->BC_PE' ORDER BY STF_ID DESC")->STF_QUANTITE;
			$resultat['quantite_disponible']=$quantite_disponible;
			$resultat['sortie']=$quantite->SF_QUANTITE-$quantite_retour->EF_QUANTITE; 
			$resultat['reste']=(int)trim($temp_quantite[0])-$resultat['sortie'];
			$resultat['tail']= $this->stock_gaines_plasmad->get_tail_commande_stock('STF_TAIL AS tail',["BC_ID"=>$reponse->BC_PE],"STF_TAIL","STF_ID");
			
		}
		echo json_encode($resultat);
	}
	public function get_quantite_dispo_stock(){
        $refnum = $this->input->post("refnum");
		$tail = $this->input->post("tail");
		$quantite_disponible = $this->stock_gaines_plasmad->get_detail_stock_produit_finis(["BC_ID"=> $refnum,"STF_TAIL"=>$tail]);
		if($quantite_disponible){
			echo $quantite_disponible->STF_QUANTITE;
		}else{
			echo 0;
		}
	}

	public function sortie_ganes(){
		$this->load->model('sortie_gaines');
		$date = $this->input->post('date_entre');
		$refnum = $this->input->post('refnum');
		$tail =  $this->input->post('tail');
		$detail_produit = $this->stock_gaines_plasmad->get_detail_stock_gaines_plasmad(["BC_ID" => $refnum,"STF_TAIL"=>$tail]);
		$methodOk = $detail_produit != null;
		if ($methodOk) {
			$obs =  $this->input->post('obs');
			$quantite =  $this->input->post('quantite_sortie');
			$BL =  $this->input->post('BL');
			
			$parametre = [
				"SF_DATE" => $date,
				"SF_BL" => $BL,
				"SF_TAILL" => $tail,
				"SF_QUANTITE" => $quantite,
				"BC_ID" => $refnum,
				"SF_ORIGIN"=>"Sortie livraison",
				"SF_MAGASIN" => $this->session->userdata("matricule"),
				"STF_OBSE" =>$obs
			];
			$methodOk = $this->sortie_gaines->insert_data_sortie_gaines($parametre);
		}
		if ($methodOk) {
				$quantite = $detail_produit->STF_QUANTITE - $quantite;
				$methodOk = $this->stock_gaines_plasmad->update_stock_gaines_plasmad(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
		}

		echo $methodOk;

	}

	public function autocomplete_produit_gaine()
	{
		
		$mot = $this->input->get('term');
		$data = $this->stock_gaines_plasmad->get_stock_gaines_plasmad("BC_ID like '%$mot%' GROUP BY `BC_ID` LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] = $data->BC_ID;
		}
		echo json_encode($reponse);
	}

	public function autocomplet_taille_gaines(){
		$this->load->model('global');
		$mot = $this->input->get('term');
		$resultat = array();
		$data = $this->global->get_distinct_colum("STF_TAIL like '%$mot%'  LIMIT 10", "STF_TAIL", "stock_gaines_plasmad");
		foreach ($data as $key => $data) {
			$resultat[] = $data->STF_TAIL;
		}
		echo json_encode($resultat);
		
	}

	public function detail_gaines_sortie(){
		$this->load->model('global');
		$refnum_pe = $this->input->post("refnum_pe");
        $reponse =$this->commande->select_commande(["BC_PE"=>$refnum_pe]); 
		$methodOk = $reponse != null;
		$resultat = ['message'=>false];
		if($methodOk){
			$resultat['client']=$reponse->BC_CLIENT;
			$resultat['dim']=$reponse->BC_DIMENSION;
			$resultat['code']=$reponse->BC_CODE;
			$resultat['tail']= $this->global->get_distinct_colum(["BC_ID"=>$reponse->BC_PE],"STF_TAIL AS 'tail'","stock_gaines_plasmad"); 
			
		}
		echo json_encode($resultat);
	}

	public function save_sortie(){
		$date = $this->input->post("date");
		$refnum = $this->input->post("refnum");
		$client = $this->input->post("client");
		$dim = $this->input->post("dim");
		$taille = $this->input->post("taille");
		$quantite = $this->input->post("quantite");
		$obs = $this->input->post("obs");
		$BL = $this->input->post("BL");

		$reponse = $this->stock_gaines_plasmad->get_detail_stock_gaines_plasmad(["BC_ID"=>$refnum,"STF_TAIL"=>$taille]);
		$methodOk = $reponse !=null;
        if($methodOk){
			$reponse->STF_QUANTITE = $reponse->STF_QUANTITE - $quantite;
			$methodOk = $this->stock_gaines_plasmad->update_stock_gaines_plasmad(["STF_ID"=>$reponse->STF_ID],$reponse);
			if($methodOk){
				$data_sortie = [
					"SF_DATE"=>$date, 
					"SF_BL"=>$BL, 
					"SF_MAGASIN"=>$this->session->userdata("matricule"),
					"BC_ID"=>$refnum, 
					"SF_TAILL"=>$taille, 
					"SF_QUANTITE"=>$quantite, 
					"STF_OBSE"=>$obs, 
					"SF_DIM"=>$dim, 
					"SF_CLIENT"=>$client
				];
				$this->sortie_gaines->insert_data_sortie_gaines($data_sortie);
			}
		}


	}
	
	public function save_entree(){
		$date = $this->input->post('date');
		$refnum = $this->input->post('refnum');
		$client = $this->input->post('client');
		$Codeclient = $this->input->post('Codeclient');
		$dim = $this->input->post('dim');
		$taille = $this->input->post('taille');
		$entre = $this->input->post('entre');
		$obs = $this->input->post('obs');
		
        $data_entree = [
			"EF_DATE"=>$date, 
			"EF_MAGASIN"=>$this->session->userdata('matricule'),
			"BC_ID"=>$refnum, 
			"EF_TAILL"=>$taille, 
			"EF_CLIENT"=>$client,
			"EF_DIM"=>$dim,
			"EF_QUANTITE"=>$entre, 
			"EF_TYPE"=>"entre",
			"EF_REMARQUE"=>"entre_gaine", 
			"STF_OBSE"=>$obs
		];
		$this->entree_gaines->insert_data_entree_gaines($data_entree);
		$reponse = $this->stock_gaines_plasmad->get_detail_stock_gaines_plasmad(["BC_ID"=>$refnum,"STF_TAIL"=>$taille]);
		$methodOk = $reponse !=null;
        if($methodOk){
			$reponse->STF_QUANTITE = $reponse->STF_QUANTITE + $entre;
			echo $this->stock_gaines_plasmad->update_stock_gaines_plasmad(["STF_ID"=>$reponse->STF_ID],$reponse);
		}else{
			$data = [
					"BC_ID"=>$refnum,
					"STF_QUANTITE"=>$entre,
					"STF_TAIL"=>$taille,
					"STF_CLIENT"=>$client,
					"STF_DIM"=>$dim,
					"STF_DATE"=>$date,
					"STF_VALEUR"=>0
					];
		   echo $this->stock_gaines_plasmad->insert_stock_gaines_plasmad($data);
		}
		
	}
	public function data_liste_entre_ganes(){
		$this->load->model('commande');
		$date_debut = $this->input->get('date_debut');
		$date_fin = $this->input->get('date_fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->entree_gaines->get_date_entree_gaines(("EF_DATE BETWEEN '$date_debut' AND '$date_fin'"));
		} else {
			
			$datas = $this->entree_gaines->get_date_entree_gaines();
		}

		$data = array();
		foreach ($datas as $row) {
			if($row->EF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->EF_ID;
			$sub_array[] = $row->EF_DATE;
			$sub_array[] = $row->EF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->EF_TAILL;
			$sub_array[] = $row->EF_QUANTITE;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = $row->STF_OBSE;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'></i>&nbsp;Détail</a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function data_liste_sortie_ganes(){
		$this->load->model('commande');
		$date_debut = $this->input->post('dateDebut');
		$date_fin = $this->input->post('dateFin');
		$methodOk = !empty($dateDebut) && !empty($dateFin);
		if ($methodOk) {
			$datas = $this->sortie_gaines->get_date_sortie_gaines(("SF_DATE BETWEEN $date_debut AND $date_fin"));
		} else {
			
			$datas = $this->sortie_gaines->get_date_sortie_gaines();
		}

		$data = array();
		foreach ($datas as $row) {
			if($row->SF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->SF_ID;
			$sub_array[] = $row->SF_DATE;
			$sub_array[] = $row->SF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->SF_TAILL;
			$sub_array[] = $row->SF_QUANTITE;
			$sub_array[] = $row->SF_BL;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = $row->STF_OBSE;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'><i/></a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_liste_stock_ganes(){

		$date_debut = $this->input->get('date_debut');
		$date_fin = $this->input->get('date_fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->stock_gaines_plasmad->get_stock_gaines_plasmad(("STF_DATE BETWEEN '$date_debut' AND '$date_fin'"));
		} else {
			
			$datas = $this->stock_gaines_plasmad->get_stock_gaines_plasmad();
		}


		$data = array();
		foreach ($datas as $row) {
			if($row->STF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->STF_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->STF_CLIENT;
			$sub_array[] = $row->STF_DIM;
			$sub_array[] = $row->STF_TAIL;
			$sub_array[] = $row->STF_QUANTITE;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info info_produit btn-sm'><i class='fa fa-info'></i>&nbsp;Détail</a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
   public function Livraison(){
	$this->render_view("gaines/stock/livraison");
   }

}
