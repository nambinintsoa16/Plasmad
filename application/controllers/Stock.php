<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stock extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('stock_matier_premier');
		$this->load->model('stock_matier_premier_madakem');
		$this->load->model('entree_matiere_premiere');
		$this->load->model('sortie_matiere_premiere');
		$this->load->model('planning_matiere_utiliser');
		$this->load->model('entree_matiere_premiere_madakem');
		$this->load->model('sortie_matiere_premiere_madakem');
		$this->load->model('stock_produit_finis');
		$this->load->model('machine');
		$this->load->model('validation_matiere');
		$this->load->model('commande');
	}
	public function index()
	{

		$this->render_view('stock/accueil');
	}
	public function export_stock_matiere()
	{

		$datas = $this->stock_matier_premier->get_stock_matier_premier(["ST_ORIGIN" => "PLASMAD_MAGASIN"]);
		$excel = "\tSTOCK MATIERES PREMIERES " . get_moth(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "Désignation\tType\tPrix Unitaire\tPrix Ariary\tStock\n";
		foreach ($datas as  $row) {
			$excel .= "$row->ST_DESIGNATION\t$row->ST_MATIER_TYPE\t$row->ST_UNITE\t$row->ST_PRIX_UNITAIRE\t$row->ST_QUANTITE\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . " PLASMAD.xls");
		print $excel;
		exit;
	}
	public function export_entree_stock_matiere()
	{

		$methodOk = isset($_GET["date_de_debut"]) && isset($_GET['date_fin']);
		if ($methodOk) {
			$date_de_debut = $_GET["date_de_debut"];
			$date_fin = $_GET['date_fin'];
			$datas = $this->entree_matiere_premiere->get_entree_matiere_premiere("EM_DATE BETWEEN  '$date_de_debut'  AND '$date_fin'");
		}
		if (!$methodOk) {
			$methodOk = isset($_GET["date_de_dedut"]);
			if ($methodOk) {
				$date_de_debut = $_GET["date_de_dedut"];
				$datas = $this->entree_matiere_premiere->get_entree_matiere_premiere(["EM_DATE" => $date_de_debut]);
			}
		}

		if (!$methodOk) {
			$datas = $this->entree_matiere_premiere->get_entree_matiere_premiere();
		}

		$excel = "\tENTREE STOCK MATIERES PREMIERES " . get_moth(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "ID\tDATE\tUSER\tFOURNISSEUR\tARTICLE\tQUANTITE\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->EM_ID\t$row->EM_DATE\t$row->EM_MAGASINIER\t$row->EM_FORNISEUR\t$row->EM_MATIER\t$row->EM_QUANTITE\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=ENNTRE STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;
	}
	public function autocomplete_matiere()
	{
		$mot = $this->input->get('term');
		$data = $this->stock_matier_premier->get_stock_matier_premier("ST_DESIGNATION like '%$mot%' LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] =  $data->ST_ID . " | " . $data->ST_DESIGNATION;
		}
		echo json_encode($reponse);
	}
	public function autocomplete_matiere_sortie_magasin()
	{
		$mot = $this->input->get('term');
		$data = $this->stock_matier_premier->get_stock_matier_premier("ST_DESIGNATION like '%$mot%' LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] =  $data->ST_ID . " | " . $data->ST_DESIGNATION . " | " . $data->ST_UNITE;
		}
		echo json_encode($reponse);
	}

    public function autocomplete_matiere_sortie_magasin_quantite()
	{
		$mot = $this->input->get('term');
		$data = $this->stock_matier_premier->get_stock_matier_premier("ST_DESIGNATION like '%$mot%' LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] =  $data->ST_ID . " | " . $data->ST_DESIGNATION . " | " . $data->ST_QUANTITE. " | ".$data->ST_UNITE;
		}
		echo json_encode($reponse);
	}



	public function autocomplete_produit_surplus()
	{
		$this->load->model('stock_surplus_produit_finis');
		$mot = $this->input->get('term');
		$data = $this->stock_surplus_produit_finis->get_stock_surplus_produit_finis("BC_ID like '%$mot%' GROUP BY `BC_ID` LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] = $data->BC_ID;
		}
		echo json_encode($reponse);
	}
	public function autocomplete_produit_plasmad()
	{
		
		$mot = $this->input->get('term');
		$data = $this->stock_produit_finis->get_stock_produit_finis("BC_ID like '%$mot%' GROUP BY `BC_ID` LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] = $data->BC_ID;
		}
		echo json_encode($reponse);
	}
	public function save_entree_matiere()
	{

		$date =  $this->input->post('date');
		$designation =  $this->input->post('designation');
		$quantite =  $this->input->post('quantite');
		$reference = $this->input->post('reference');
		$forniseur = $this->input->post('forniseur');
		$refnum = $this->input->post('refnum');

		$parametre = [
			"EM_REFERENCE" => $reference,
			"EM_DATE" => $date,
			"EM_MATIER" => $designation,
			"EM_FORNISEUR" => $forniseur,
			"EM_QUANTITE" => $quantite,
			"RF_MATIERE" => $refnum,
			"EM_MAGASINIER" => $this->session->userdata("matricule"),
			"EM_TYPE" => "ENTREE"
		];
		$methodOk = $this->entree_matiere_premiere->insert_entree_matiere_premiere($parametre);
		if ($methodOk) {
			$detail_matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_ID" => $refnum]);
			$methodOk = $detail_matiere != null;
			if ($methodOk) {
				$quantite += $detail_matiere->ST_QUANTITE;
				$methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID" => $refnum], ["ST_QUANTITE" => $quantite]);
			}
		}

		echo $methodOk;
	}
	public function entree_echange_create_plasmad()
	{

		$date =  date('Y-m-d');
		$refnum = $this->input->post('refnum_entree');
		$detail_matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_ID" => $refnum]);
		$methodOk = $detail_matiere != null;
		if ($methodOk) {
			$designation =  $this->input->post('produit_entree');
			$quantite =  $this->input->post('quantite_entree');
			$forniseur = "Madakem";
			$parametre = [
				"EM_DATE" => $date,
				"EM_MATIER" => $designation,
				"EM_FORNISEUR" => $forniseur,
				"EM_QUANTITE" => $quantite,
				"RF_MATIERE" => $designation,
				"EM_MAGASINIER" => $this->session->userdata("matricule"),
				"EM_TYPE" => "ENTREE"
			];
			$methodOk = $this->entree_matiere_premiere->insert_entree_matiere_premiere($parametre);
		}
		if ($methodOk) {
			if ($methodOk) {
				$quantite += $detail_matiere->ST_QUANTITE;
				$methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID" => $refnum], ["ST_QUANTITE" => $quantite]);
			}
		}

		echo $methodOk;
	}
	public function sortie_echange_create_plasmad()
	{
		$date =  date('Y-m-d');
		$refnum = $this->input->post('refnum_sortie');
		$detail_matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_ID" => $refnum]);
		$methodOk = $detail_matiere != null;
		if ($methodOk) {
			$designation =  $this->input->post('produit_sortie');
			$quantite =  $this->input->post('quantite_sortie');
			$forniseur = "Madakem";
			$parametre = [
				"SM_DATE" => $date,
				"SM_MATIER" => $designation,
				"SM_DESTINATAIRE" => $forniseur,
				"SM_QUANTITE" => $quantite,
				"RF_MATIERE" => $refnum,
				"SM_MAGASINIER" => $this->session->userdata("matricule"),
				"EM_TYPE" => "ENTREE"
			];
			$methodOk = $this->sortie_matiere_premiere->insert_sortie_matiere_premiere($parametre);
		}
		if ($methodOk) {
			if ($methodOk) {
				$quantite = $detail_matiere->ST_QUANTITE - $quantite;
				$methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID" => $refnum], ["ST_QUANTITE" => $quantite]);
			}
		}

		echo $methodOk;
	}
	public function Liste_des_matieres_premieres()
	{
		$this->render_view("stock/matiere_premiere/liste_matieres_premiere");
	}
	public function Entree_matiere()
	{
		$this->render_view("stock/matiere_premiere/entree");
	}
	public function Liste_des_entrees_matieres()
	{
		$this->render_view("stock/matiere_premiere/liste_des_entrees");
	}
	public function Sortie_matiere()
	{
		$this->render_view("stock/matiere_premiere/sortie");
	}
	public function Liste_des_sorties_matieres()
	{
		$this->render_view("stock/matiere_premiere/liste_des_sorties");
	}
	public function Entree_livraison()
	{
		$this->render_view("stock/livraison/entree_livraison");
	}
	public function Historique_de_livraison()
	{
		$this->render_view("stock/livraison/historique_de_livraison");
	}
	public function entree_echange_create_madakem()
	{
		$date =  date('Y-m-d');
		$refnum = $this->input->post('refnum_entree');
		$detail_matiere = $this->stock_matier_premier_madakem->get_detail_matiere_premiere(["ST_ID" => $refnum]);
		$methodOk = $detail_matiere != null;
		$user = $this->session->userdata('matricule');
		if ($methodOk) {
			$designation =  $this->input->post('produit_entree');
			$quantite =  $this->input->post('quantite_entree');
			$forniseur = "Plasmad";
			$parametre = [
				"EM_DATE" => $date,
				"EM_MATIER" => $designation,
				"EM_FORNISEUR" => $forniseur,
				"EM_QUANTITE" => $quantite,
				"RF_MATIERE" => $refnum,
				"EM_MAGASINIER" => $user ,
				"EM_TYPE" => "ENTREE"
			];
			$methodOk = $this->entree_matiere_premiere_madakem->insert_entree_matiere_premiere($parametre);
		}
		if ($methodOk) {
			if ($methodOk) {
				$quantite += $detail_matiere->ST_QUANTITE;
				$methodOk = $this->stock_matier_premier_madakem->update_matiere_premiere(["ST_ID" => $refnum], ["ST_QUANTITE" => $quantite]);
			}
		}

		echo $methodOk;
	}
	public function sortie_echange_create_madakem()
	{
		$date =  date('Y-m-d');
		$refnum = $this->input->post('refnum_sortie');
		$detail_matiere = $this->stock_matier_premier_madakem->get_detail_matiere_premiere(["ST_ID" => $refnum]);
		$methodOk = $detail_matiere != null;
		$user = $this->session->userdata('matricule');
		if ($methodOk) {
			$designation =  $this->input->post('produit_sortie');
			$quantite =  $this->input->post('quantite_sortie');
			$forniseur = "Plasmad";
			$parametre = [
				"SM_DATE" => $date,
				"SM_MATIER" => $designation,
				"SM_DESTINATAIRE" => $forniseur,
				"SM_QUANTITE" => $quantite,
				"RF_MATIERE" => $refnum,
				"SM_MAGASINIER" => $user,
				"SM_ORIGIN" => "MADAKEM_MAGASIN"
			];
			$methodOk = $this->sortie_matiere_premiere_madakem->insert_sortie_matiere_premiere($parametre);
		}
		if ($methodOk) {
			if ($methodOk) {
				$quantite = $detail_matiere->ST_QUANTITE - $quantite;
				$methodOk = $this->stock_matier_premier_madakem->update_matiere_premiere(["ST_ID" => $refnum], ["ST_QUANTITE" => $quantite]);
			}
		}

		echo $methodOk;
	}
	public function autocomplete_matiere_plasmad()
	{
		$mot = $this->input->get('term');
		$data = $this->stock_matier_premier->get_stock_matier_premier("ST_DESIGNATION like '%$mot%' LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] =  $data->ST_ID . " | " . $data->ST_DESIGNATION;
		}
		echo json_encode($reponse);
	}
	public function autocomplete_matiere_mdakem()
	{
		$mot = $this->input->get('term');
		$data = $this->stock_matier_premier_madakem->get_matiere_premiere("ST_DESIGNATION like '%$mot%' LIMIT 10");
		$reponse = array();
		foreach ($data as $data) {
			$reponse[] =  $data->ST_ID . " | " . $data->ST_DESIGNATION;
		}
		echo json_encode($reponse);
	}
	public function autocomplete_machine()
	{
		$resultat = array();
		$mot = $this->input->get('term');
		$data = $this->machine->get_machine("MA_DESIGNATION like '%$mot%' LIMIT 10");
		foreach ($data as $key => $data) {
			$resultat[] = $data->MA_DESIGNATION;
		}
		echo json_encode($resultat);
	}
	public function get_detai_produit_finis()
	{
		$refnum = $this->input->post('refnum');
		$parametre = [
			"BC_PE" => $refnum
		];
		echo json_encode($this->commande->select_commande($parametre));
	}
	public function get_matiere_use()
	{
		$refnum = $this->input->post('refnum');
		$parametre = ["BC_PE" => $refnum];
		$html = '';
		$data = $this->planning_matiere_utiliser->get_planning_matiere_utiliser($parametre);
		foreach ($data as  $data) {
			$html .= '<li class="feed-item feed-item-danger">';
			$html .= "<span class='text'> DESIGNATION : $data->MU_DESIGNATION -- || -- QUANTITE : $data->MU_QUANTITE </span>";
			$html  .= "</li>";
		}

		echo $html;
	}

	public function sauve_sortie_matier_a_valider()
	{

		$machine = $this->input->post('machine');
		$reference = $this->input->post('reference');
		$prix = $this->input->post('prix');
		$quantite = $this->input->post('quantite');
		$article = $this->input->post('article');

		$data = [
			"PO_MAV" => $reference,
			"DATE_MAV" => date('Y-m-d'),
			"DEMANDE_MAV" => $this->session->userdata('matricule'),
			"MAC_MAV" => $machine,
			"DES_MIAV" => $article,
			"PRIX_MIAV" => $prix,
			"QTT_MIAV" => $quantite,
			"STATUT_MAV" => "NON VALIDER"
		];

		return	$this->validation_matiere->insert_validation_matiere($data);
	}

	public function list_des_sortie_matiere()
	{
		$methodOk = (isset($_GET['debut']) && !empty($_GET['debut'])) &&  (isset($_GET['fin']) && !empty($_GET['fin']));

		if ($methodOk) {
			$datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere("SM_DATE between '".$_GET['debut']."' AND '".$_GET['fin']."'");
		}
        if(!$methodOk){
			$methodOk = isset($_GET['date']) && !empty($_GET['date']);
			if($methodOk) {
				$datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(['SM_DATE'=>$_GET['date']]);
			}
	    } 
		if(!$methodOk){
			$datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere();

		}


		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->SM_ID;
			$sub_array[] = $row->SM_DATE;
			$sub_array[] = $row->SM_MAGASINIER;
			$sub_array[] = $row->SM_DESTINATAIRE;
			$sub_array[] = $row->SM_MATIER;
			$sub_array[] = $row->SM_QUANTITE;
			if ($row->SM_QUANTITE >= 25) {
				$qtt =  $row->SM_QUANTITE;
				$total = 0;
				while ($qtt >= 25) {
					$total = $total + 1;
					$qtt = $qtt - 25;
				}
				if ($qtt != 0) {
					$sub_array[] = $total . "sac et " . $qtt . " Kg";
				} else {
					$sub_array[] = $total . "sac";
				}
			} else {
				$qtt =  $row->SM_QUANTITE  / 25;
				$sub_array[] = $qtt . "sac";
			}
			$sub_array[] = "<input type='checkbox' id='$row->SM_ID'>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_liste_produit_fini(){

		$date_debut = $this->input->post('dateDebut');
		$date_fin = $this->input->post('dateFin');
		$methodOk = !empty($dateDebut) && !empty($dateFin);
		if ($methodOk) {
			$datas = $this->stock_produit_finis->get_stock_produit_finis("STF_QUANTITE <> 0 AND  (STF_DATE BETWEEN $date_debut AND $date_fin)");
		} else {
			
			$datas = $this->stock_produit_finis->get_stock_produit_finis("STF_QUANTITE <> 0");
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
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'><i/></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	
	public function data_liste_entre_produit_fini()
	{
		$this->load->model('entree_produits_finis');
		$datas = $this->entree_produits_finis->get_entree_produits_finis();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->EF_ID;
			$sub_array[] = $row->EF_DATE;
			$sub_array[] = $row->EF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->EF_QUANTITE;
			$sub_array[] = $row->EF_TAILL;
			$sub_array[] = $row->STF_OBSE;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_liste_sortie_produit_fini()
	{
		$this->load->model('sortie_produits_finis');
		$datas = $this->sortie_produits_finis->get_sortie_produits_finis();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->SF_ID;
			$sub_array[] = $row->SF_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->SF_MAGASIN;
			$sub_array[] = $row->SF_BL;
			$sub_array[] = $row->SF_QUANTITE;
			$sub_array[] = $row->SF_TAILL;
			$sub_array[] = $row->STF_OBSE;
			$sub_array[] = $row->SF_ORIGIN;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}



	public function detail_commande_livraison(){
		$this->load->model('global');
		$this->load->model('stock_produit_finis');
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
		    $quantite = $this->global->get_sum_colum(["BC_ID"=>$reponse->BC_PE,"SF_ORIGIN"=>'Sortie livraison'],'SF_QUANTITE','sortie_produits_finis'); 
			$quantite_retour = $this->global->get_sum_colum(["BC_ID"=>$reponse->BC_PE,"EF_TYPE"=>'retour'],'EF_QUANTITE','entree_produits_finis'); 
			//$quantite_surplus = $this->global->get_sum_colum(["SF_DESTINATION"=>$reponse->BC_PE],'SF_QUANTITE','sortie_surplus_finis'); 
			//$resultat['sortie']=$quantite->SF_QUANTITE + $quantite_surplus->SF_QUANTITE; 
			$quantite_disponible = $this->stock_produit_finis->get_detail_stock_produit_finis("BC_ID ='$reponse->BC_PE' ORDER BY STF_ID DESC")->STF_QUANTITE;
			$resultat['quantite_disponible']=$quantite_disponible;
			$resultat['sortie']=$quantite->SF_QUANTITE-$quantite_retour->EF_QUANTITE; 
			$resultat['reste']=(int)trim($temp_quantite[0])-$resultat['sortie'];
			$resultat['tail']= $this->stock_produit_finis->get_tail_commande_stock('STF_TAIL AS tail',["BC_ID"=>$reponse->BC_PE],"STF_TAIL","STF_ID");
			
		}
		echo json_encode($resultat);
	}
	public function get_quantite_dispo_stock(){
        $refnum = $this->input->post("refnum");
		$tail = $this->input->post("tail");
		$quantite_disponible = $this->stock_produit_finis->get_detail_stock_produit_finis(["BC_ID"=> $refnum,"STF_TAIL"=>$tail]);
		if($quantite_disponible){
			echo $quantite_disponible->STF_QUANTITE;
		}else{
			echo 0;
		}
	}

	public function data_liste_sortie_surplus_livraison()
	{
		$this->load->model('sortie_surplus_finis');
		$refnum= $this->input->get('refnum');
		$datas =$this->sortie_surplus_finis->get_sortie_surplus_finis(["SF_DESTINATION"=>$refnum]);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->SF_DATE;
			$sub_array[] = $row->SF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->SF_TAILL;
			$sub_array[] = $row->SF_QUANTITE;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function sortie_suplus_fini(){
		$this->load->model('sortie_surplus_finis');
		$refnum_surplus = $this->input->post('refnum_surplus');
		$tail_suplus = $this->input->post('tail_suplus');
		$rack = $this->input->post('rack');
		$detail_produit = $this->stock_surplus_produit_finis->get_detail_stock_surplus_produit_finis(["BC_ID" => $refnum_surplus,"STF_TAIL"=>$tail_suplus,"STF_LOCALISATION"=>$rack]);
		$methodOk = $detail_produit != null;
		if ($methodOk) {
		
		$refnum = $this->input->post('refnum');
		$quantite_surplus = $this->input->post('quantite_surplus');
		$date_entre = $this->input->post('date_entre');
		$BL = $this->input->post('BL');
		$obs = $this->input->post('obs');
		$parametre = [
			"SF_DATE" => $date_entre,
			"SF_BL" => $BL,
			"SF_TAILL" => $tail_suplus,
			"SF_QUANTITE" => $quantite_surplus,
			"BC_ID" => $refnum_surplus,
			"SF_MAGASIN" => $this->session->userdata("matricule"),
			"STF_OBSE" =>$obs,
			"SF_DESTINATION"=>$refnum
		];
		$methodOk = $this->sortie_surplus_finis->insert_sortie_surplus_finis($parametre);
		}
		if ($methodOk) {
			
				$quantite = $detail_produit->STF_QUANTITE - (int)$quantite_surplus;
				$methodOk = $this->stock_surplus_produit_finis->update_stock_surplus_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
			    if($methodOk){
					$methodOk = $this->save_entre_produit_fini($date_entre,$refnum,$tail_suplus,(int)$quantite_surplus,"Entree surplus","Sortie refnum surplus :".$refnum_surplus);
				}
		}

		echo $methodOk;
	}
	
	public function save_entre_produit_fini( $date,$refnum,$taille,$entree,$type,$obs)
	{
	  $this->load->model("entree_produits_finis");
	  $this->load->model("stock_produit_finis");
	  $this->load->model("commande");
	  $detail_produit = $this->stock_produit_finis->get_detail_stock_produit_finis(["STF_TAIL" => $taille, "BC_ID " => $refnum]);
	  $methodOk = $detail_produit != null;
  
	  if ($methodOk) {
		$quantite = $detail_produit->STF_QUANTITE + $entree;
		$methodOk = $this->stock_produit_finis->update_stock_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
	  }
  
	  if (!$methodOk) {
		$commande = $this->commande->select_commande(["BC_PE" => $refnum]);
		$methodOk = $commande != null;
		if ($methodOk) {
		  $data_insert = [
			"BC_ID" => $refnum,
			"STF_QUANTITE" => $entree,
			"STF_TAIL" => $taille,
			"STF_CLIENT" => $commande->BC_CLIENT,
			"STF_DIM" => $commande->BC_DIMENSION,
			"STF_DATE" => $date,
			"STF_VALEUR" => $commande->BC_PRIX,
			"STF_ORIGIN" => "PLASMAD"
		  ];
		  $methodOk = $this->stock_produit_finis->insert_stock_produit_finis($data_insert);
		}
	  }
  
	  if ($methodOk) {
		$param = [
		  "EF_DATE" => $date,
		  "EF_MAGASIN" => $this->session->userdata('matricule'),
		  "BC_ID" => $refnum,
		  "EF_TAILL" => $taille,
		  "EF_QUANTITE" => $entree,
		  "EF_TYPE" => $type,
		  "EF_REMARQUE" => "",
		  "STF_OBSE" => $obs
		];
		$methodOk = $this->entree_produits_finis->insert_entree_produits_finis($param);
	  }
  
	  
  
	  return $methodOk;
	}

	public function sortie_suplus_gaine(){
		$this->load->model('sortie_surplus_finis');
		$refnum_surplus = $this->input->post('refnum_surplus');
		$tail_suplus = $this->input->post('tail_suplus');
		$detail_produit = $this->stock_surplus_produit_finis->get_detail_stock_surplus_produit_finis(["BC_ID" => $refnum_surplus,"STF_TAIL"=>$tail_suplus]);
		$methodOk = $detail_produit != null;
		if ($methodOk) {
		
		$refnum = $this->input->post('refnum');
		$quantite_surplus = $this->input->post('quantite_surplus');
		$date_entre = $this->input->post('date_entre');
		$BL = $this->input->post('BL');
		$obs = $this->input->post('obs');
		$parametre = [
			"SF_DATE" => $date_entre,
			"SF_BL" => $BL,
			"SF_TAILL" => $tail_suplus,
			"SF_QUANTITE" => $quantite_surplus,
			"BC_ID" => $refnum_surplus,
			"SF_MAGASIN" => $this->session->userdata("matricule"),
			"STF_OBSE" =>$obs,
			"SF_DESTINATION"=>$refnum
		];
		$methodOk = $this->sortie_surplus_finis->insert_sortie_surplus_finis($parametre);
		}
		if ($methodOk) {
				$quantite = $detail_produit->STF_QUANTITE - (int)$quantite_surplus;
				$methodOk = $this->stock_surplus_produit_finis->update_stock_surplus_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
			    if($methodOk){
					$methodOk = $this->save_entre_gaines($date_entre,$refnum,$tail_suplus,(int)$quantite_surplus,"Entree surplus","Sortie refnum surplus :".$refnum_surplus);
				}
		}

		echo $methodOk;
	}
	public function save_entre_gaines( $date,$refnum,$taille,$entree,$type,$obs)
	{
	  $this->load->model("entree_gaines");
	  $this->load->model("stock_gaines_plasmad");
	  $this->load->model("commande");
	  $detail_produit = $this->stock_gaines_plasmad->get_detail_stock_gaines_plasmad(["STF_TAIL" => $taille, "BC_ID " => $refnum]);
	  $methodOk = $detail_produit != null;
  
	  if ($methodOk) {
		$quantite = $detail_produit->STF_QUANTITE + $entree;
		$methodOk = $this->stock_gaines_plasmad->update_stock_gaines_plasmad(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
	  }
	
	  if (!$methodOk) {
		$commande = $this->commande->select_commande(["BC_PE" => $refnum]);
		$methodOk = $commande != null;
		if ($methodOk) {
		  $data_insert = [
			"BC_ID" => $refnum,
			"STF_QUANTITE" => $entree,
			"STF_TAIL" => $taille,
			"STF_CLIENT" => $commande->BC_CLIENT,
			"STF_DIM" => $commande->BC_DIMENSION,
			"STF_DATE" => $date,
			"STF_VALEUR" => $commande->BC_PRIX,
			"STF_ORIGIN" => "PLASMAD"
		  ];
		  $methodOk = $this->stock_gaines_plasmad->insert_stock_gaines_plasmad($data_insert);
		}
	  }
  
	  if ($methodOk) {
		$param = [
		  "EF_DATE" => $date,
		  "EF_MAGASIN" => $this->session->userdata('matricule'),
		  "BC_ID" => $refnum,
		  "EF_TAILL" => $taille,
		  "EF_QUANTITE" => $entree,
		  "EF_TYPE" => $type,
		  "EF_REMARQUE" => "",
		  "STF_OBSE" => $obs
		];
		$methodOk = $this->entree_gaines->insert_data_entree_gaines($param);
	  }
  
	  
  
	  return $methodOk;
	}
	 

	public function taille_produit_surplus(){
		$this->load->model('global');
		$reponse =["message"=>false];
		$refnum = $this->input->post('refnum');
		$reponse['tail']= $this->global->get_distinct_colum(["BC_ID"=>$refnum],"STF_TAIL AS 'tail'","stock_surplus_produit_finis"); 
	    $methodOk = $reponse['tail'] != null;
		$methodOk ? $reponse["message"]=true:"";
		echo json_encode($reponse);
	}
	public function sortie_produit_fini(){
		$this->load->model('sortie_produits_finis');
		$date = $this->input->post('date_entre');
		$refnum = $this->input->post('refnum');
		$tail =  $this->input->post('tail');
		$detail_produit = $this->stock_produit_finis->get_detail_stock_produit_finis(["BC_ID" => $refnum,"STF_TAIL"=>$tail]);
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
			$methodOk = $this->sortie_produits_finis->insert_sortie_produits_finis($parametre);
		}
		if ($methodOk) {
				$quantite = $detail_produit->STF_QUANTITE - $quantite;
				$methodOk = $this->stock_produit_finis->update_stock_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
		}

		echo $methodOk;

	}
	public function data_historique_livraison(){
		
 		$date = $this->input->post('date');
		$refnum = $this->input->post('refnum');
        $methodOk = $date !="" || $refnum !="";
       
		if(!$methodOk){
		$date = $this->input->get('date');
		$refnum = $this->input->get('refnum');
		}

       
		$methodOk = $refnum !="";
		if($methodOk){
			
			$param =['BC_PE'=>$refnum];
		}
		$methodOk = $date !="";
		if($methodOk){
			$param =['BC_DATE'=>$date];
		}

		$methodOk = $refnum =="" & $date =="";
		if($methodOk){
			$param =['BC_DATE'=>date('Y-m-d')];
		}
		
		$commande = $this->commande->select_commande_all($param);
		
		$data =[
			'data'=>$commande,
			"date" => $this->input->post('date'),
			"refnum" => $this->input->post('refnum')
		];
		$this->load->view('stock/livraison/data_historique',$data);
		$methodOk = isset($_GET["type"]) && !empty($_GET["type"]);
		if($methodOk){
			header('Content-Type: application/vnd.ms-excel');  
			header('Content-disposition: attachment; filename=Export livraison.xls'); 
			
		}
		
	}
	public function Liste_des_produits_finis()
	{
		$this->render_view("stock/produit_finis/liste_produit_finis");
	}
	public function Liste_des_entree()
	{
		$this->render_view("stock/produit_finis/Liste_des_entree");
	}
	public function Liste_des_sortie()
	{
		$this->render_view("stock/produit_finis/Liste_des_sortie");
	}
	public function export_Sortier_matiere()
	{

	
		$date = $this->input->get('date');
		$refnum = explode(" ", $this->input->get('refnum'));

		$requette = "(";
		$p = 0;
		foreach ($refnum as $key => $refnum) {
			if ($p == 0) {
				if ($refnum != " ") {
					$requette .= "SM_ID" . "=" . "'" .trim($refnum). "'";
					$p++;
				}
			} else {
				if ($refnum != " ") {
					$requette .= " OR " . "SM_ID" . "=" . "'" .trim($refnum). "'";
					$p++;
				}
			}
		}
		$requette .= ")";

		$datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere("$requette");

		$data = array();
		$content = "";

		$content .= "<div class='cont w-100'>
  <table>
			<thead class='thead w-100'>
			<tr class='header'>
				<td colspan='6'>LISTE SORTIE MATIEREES DU : $date</td>
			</tr>
		</thead>
		<tbody>
		   <tr>					
            <td>DATE</td>
            <td>MACHINE</td>
            <td>RECEPTIONNAIRE</td>							
	        <td style='whidth:200px!important'>ARTICLE </td>
            <td>QUANTITE</td>
            <td>SAC</td>
          
		</tr>";


		foreach ($datas as $row) {



			$content .= "<tr>
		
				<td> $row->SM_DATE</td>
				<td>$row->SM_MACHINE</td>
				<td> $row->SM_REFERENCE</td>
				<td style='whidth:200px!important'> $row->SM_MATIER</td>
				<td> $row->SM_QUANTITE</td>
		";


			if ($row->SM_QUANTITE >= 25) {
				$qtt =  $row->SM_QUANTITE;
				$total = 0;
				while ($qtt >= 25) {
					$total = $total + 1;
					$qtt = $qtt - 25;
				}
				if ($qtt != 0) {
					$sqts = $total . "sac et " . $qtt . " Kg";
				} else {
					$sqts = $total . "sac";
				}

				$content .= "<td>$sqts</td>";
			} else {
				$liQtt =  $row->SM_QUANTITE. " Kg";;
				$content .= "<td>$liQtt</td>";
			}

			$content .= "</tr>";
		}
		$content .= '</tbody></table></div>';

		$html = '<!DOCTYPE html>
	<html>
	
	<head>
		<title></title>
	</head>
	<style>
	body {
		font-size:11px;
	}
	table{
		border: solid gray 1px;	
	}
	 tr > td{
		 border: solid gray 1px;
		 padding: 3px;
		 margin: 0px;
		 width: 80px;
	 }
	 .cont{
		 display: block;
		 margin:15px;
		
	 }
	 .container{
		width:900px;
	
	 }
	 .thead{
		 background-color: black;
		 color: aliceblue;
	 }
	</style>
	<body>
	<div class="container">' . $content . '
	  </div>
	</body>
	</html>';
		$filename = "LISTE DES SORTIE : " . date('d / m / Y');
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}

}
