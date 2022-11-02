<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class magasiner extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}

	public function index()
	{
		$this->render_view('Magasiner/Accueil');
	}

	public function saurSortie()
	{
		$this->load->model('Magasiner_model');
		$data = json_decode($this->input->post('data'));
		$dataInit = [
			"SO_DATE" => date('Y-m-d'),
			"SO_RECEPTIONNAIRE" => $this->input->post('reception'),
			"SO_PE" => $this->input->post('PE'),
			"SO_SORTIE" => $this->input->post('date'),
			"SO_MAGASINER" => $this->session->userdata('matricule'),
			"BO_BONDESORTIE" => 'BC-0001'

		];
		$this->Magasiner_model->insertSortie($dataInit);

		echo json_encode(array('message' => 'true'));
	}
	public function page()
	{
		$this->load->model('commercial_model');
		$this->load->model('Magasiner_model');


		$page = $this->input->post('page');

		switch ($page) {
			case 'CONSOMMATION ENTRANT':
				$dataCOm = $this->commercial_model->lastPEbondecommande();
				if ($dataCOm != "") {
					$BC_PE = $dataCOm->BC_PE + 1;
				} else {
					$BC_PE = 1;
				}
				$data = ["BC_PE" => $BC_PE];
				$this->load->view('Commerciale/Bon_de_commande', $data);
				break;
			case 'ENTREE':
				$this->load->view('Magasiner/Entree');
				break;
			case 'SORTIE':
				$this->load->view('Magasiner/Sortie');
				break;
			case 'PRODUIT FINI':
				$this->load->view('Magasiner/produit/produitFini');
				break;
			case 'STOCK PRODUIT FINI':
				$this->load->view('Magasiner/produit/stockproduitFini');
				break;
			case 'ENTREE MATIERE PREMIERE':
				$this->load->view('Magasiner/matier/approvisionnement');
				break;
			case 'STOCK GENERALE':
				$this->load->view('Magasiner/Stock_generale');
				break;
			case 'MATIERE PREMIERE':
				$this->load->view('Magasiner/matier/Accueil');
				break;
			case 'STOCK MATIERE PREMIERE':
				$this->load->view('Magasiner/Stock_matierPremier');
				break;
			case "SORTIE_ECHANGE":
				$this->load->view('Magasiner/matier/echange');
				break;
			case "SORTIE_SORTIE":
				$this->load->view('Magasiner/matier/sortieSimple');
				break;
			case 'SORTIE MATIERE PREMIERE':
				$this->load->view('Magasiner/matier/sortie');
				break;
			case 'SORTIE_BON DE COMMANDE':
				$this->load->view('Magasiner/matier/bon_de_commande');
				break;
			case 'HISTORIQUE DE LIVRAISON':
				$date = $this->input->post('date');
				$po = $this->input->post('po');
				if (!empty($po)) {
					$data = $this->Magasiner_model->listebondecommande(["BC_PE" => $po]);
				} else {
					if ($date == "") {
						$date = date('Y-m-d');
					}
					$data = $this->Magasiner_model->listebondecommande(["BC_DATE" => $date]);
				}

				$data = [

					"data" => $data,
					"date" => $this->input->post('date'),
					"po" => $this->input->post('po')

				];
				$this->load->view('Magasiner/historique', $data);
				break;

			case 'LISTE DES ENTREES MATIERE PREMIERE':
				$this->load->view('Magasiner/matier/entreMatier');
				break;
			case 'LISTE DES SORTIES MATIERE PREMIERE':
				$this->load->view('Magasiner/matier/sortieMatier');
				break;
			case 'LISTE DES SORTIES':
				$this->load->view('Magasiner/produit/sortieProduit');
				break;
			case 'LISTE DES ENTREES':
				$this->load->view('Magasiner/produit/entreProduit');
				break;
			case 'HISTORIQUE PRODUIT FINI PREMIER':
				$this->load->view('Magasiner/produit/historiqueFini');
				break;
			case 'LIVRAISON':
				$this->load->view('Magasiner/produit/historiqueFini');
				break;
			default:

				break;
		}
	}
	public function autocompletPo()
	{
		$this->load->model('Magasiner_model');
		$data = $this->magasiner_model->autocompletePo($this->input->get('term'));
		$reponse = array();
		foreach ($data as $key => $data) {
			$reponse[] = $data->BC_PE;
		}
		echo json_encode($reponse);
	}

	public function lisete_sortie_materiel()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->sortie_materiel();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->MS_ID;
			$sub_array[] = $row->MS_DATE;
			$sub_array[] = $row->MS_MAGASINIER;
			$sub_array[] = $row->LI_REFERENCE;
			$sub_array[] = $row->MS_MATIER;
			$sub_array[] = $row->LI_QUANTITE;
			if ($row->LI_QUANTITE >= 25) {
				$qtt =  $row->LI_QUANTITE;
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
				$qtt =  $row->LI_QUANTITE  / 25;
				$sub_array[] = $qtt ."sac";
			}
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	public function lisete_sortie_materiel_date()
	{
		$this->load->model('Magasiner_model');
		$debut = $this->input->get('debut');
        $fin  = $this->input->get('fin');
		if(!empty($debut) && !empty( $fin)){
			$datas = $this->magasiner_model->sortie_materiel_date("MS_DATE BETWEEN  '$debut' AND '$fin'");
		}else if(!empty($debut)){
			$datas = $this->magasiner_model->sortie_materiel_date(['MS_DATE' => $debut]);
		}else if(!empty( $fin)){
			$datas = $this->magasiner_model->sortie_materiel_date(['MS_DATE' => $fin]);
		}else{
            $date = date('Y-m');
			$datas = $this->magasiner_model->sortie_materiel_date("MS_DATE like  '%$date'");
		}
		
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->MS_ID;
			$sub_array[] = $row->MS_DATE;
			$sub_array[] = $row->MS_MAGASINIER;
			$sub_array[] = $row->LI_REFERENCE;
			$sub_array[] = $row->MS_MATIER;
			$sub_array[] = $row->LI_QUANTITE;
			if ($row->LI_QUANTITE >= 25) {
				$qtt =  $row->LI_QUANTITE;
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
				$sub_array[] =  $row->LI_QUANTITE. " Kg";;
			}
			$sub_array[] = "<input type='checkbox' class='choix' >";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function lisete_entre_materiel()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->entree_materiel_Mag();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->EM_ID;
			$sub_array[] = $row->EM_DATE;
			$sub_array[] = $row->EM_MAGASINIER;
			$sub_array[] = $row->LI_REFERENCE;
			$sub_array[] = $row->EM_MATIER;
			$sub_array[] = $row->LI_QUANTITE;

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	public function lisete_entre_fini()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->entre_produit_fini(['EF_TYPE' => 'entre']);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->EF_ID;
			$sub_array[] = $row->EF_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->EF_MAGASIN;
			$sub_array[] = $row->BC_DIMENSION;
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

	public function lisete_sortie_fini()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->entre_produit_fini(['EF_TYPE' => 'sortie']);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->EF_ID;
			$sub_array[] = $row->EF_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->EF_MAGASIN;
			$sub_array[] = $row->EF_BL;
			$sub_array[] = $row->BC_DIMENSION;
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


	public function recherchePE()
	{
		$this->load->model('Magasiner_model');
		$json = array('message' => false);
		$data = $this->magasiner_model->bondecommande(["BC_PE" => $this->input->post('param')]);
		if ($data) {
			$json['message'] = "true";
			$json['client'] = $data->BC_CLIENT;
			$json['code'] = $data->BC_CODE;
			$json['dim'] = $data->BC_DIMENSION;
		}
		echo json_encode($json);
	}


	public function recherchePESort()
	{
		$this->load->model('Magasiner_model');
		$json = array('message' => false);
		$data = $this->magasiner_model->bondecommande(["BC_PE" => $this->input->post('param')]);
		$dim = array();
		$po = $this->input->post('param');
		$qttsortie = 0;
		$sortiedata = "";
		$retours = 0 ;
		$sortie =  $this->magasiner_model->dataentre_produit_fini("EF_REMARQUE ='$po'  AND EF_TYPE='sortie'");
		$sorties  = $this->magasiner_model->dataentre_produit_fini("(BC_ID = '$po' OR EF_REMARQUE ='$po' ) AND EF_TYPE='sortie'");
		$retour = $this->magasiner_model->dataentre_produit_fini("(BC_ID = '$po' AND EF_REMARQUE ='RETOUR' ) AND EF_TYPE='entre'");
		foreach ($sortie as $key => $sortie) {
			$sortiedata .= "<tr><td>".$sortie->EF_DATE."</td><td>".$sortie->EF_MAGASIN."</td><td>".$sortie->BC_ID."</td><td>".$sortie->EF_QUANTITE."</td>";
			$sortiedata.="</tr>";
			
		}
		foreach ($retour as $key => $retour) {
			$retours += $retour->EF_QUANTITE;
		}
		foreach ($sorties as $key => $sorties) {
			$qttsortie += $sorties->EF_QUANTITE;
	
		}
		if ($data) {
			$dimTemp = $this->magasiner_model->Allstock_produit_fini(["BC_ID" => $this->input->post('param')]);
			foreach ($dimTemp as $dimTemp) {
				$dim[] = $dimTemp->STF_TAIL;
			}
			$json['message'] = "true";
			$json['client'] = $data->BC_CLIENT;
			$json['code'] = $data->BC_CODE;
			$json['dim'] = $data->BC_DIMENSION;
			$json['tail'] = $dim;
			$json['quantite'] = $data->BC_QUNTITE;
			$json['sortie'] = $qttsortie;
			$json['reste'] =((int)$data->BC_QUNTITE - $qttsortie) + $retours;
			$json['sortiedata'] = $sortiedata;
		}
		echo json_encode($json);
	}

	public function savesortie()
	{
		$this->load->model('Magasiner_model');
		$sortie = $this->input->post('sortie');
		$taill = $this->input->post('tail');
		$date = $this->input->post('date_entre');
		$deux = $this->input->post('choix');
		$EF_BL = $this->input->post('BL');
		$OBSE = $this->input->post('obs');
		$PO = $this->input->post('PO');
		$detalPo = $this->magasiner_model->bondecommande(["BC_PE" => $this->input->post('PO')]);
		$reponse = $this->magasiner_model->selectstock_produit_fini(["BC_ID" => $PO, "STF_DIM" => $detalPo->BC_DIMENSION, "STF_TAIL" => $taill,"STF_ORIGIN"=>"PLASMAD_MAGASIN"]);
		if ($reponse) {

			//if($reponse->STF_QUANTITE <= $sortie ){

				$data = [
					"EF_QUANTITE" => $sortie,
					"EF_DATE" => $date,
					"EF_MAGASIN" => $this->session->userdata('matricule'),
					"EF_TYPE" => "sortie",
					"EF_BL" => $EF_BL,
					"BC_ID" => $PO,
					"STF_OBSE" => $OBSE,
					"EF_TAILL" => $taill,
					"EF_ORIGIN" => "PLASMAD_MAGASIN",
					"EF_REMARQUE" => "vide"
				];
		
				if ($this->magasiner_model->insertentre_produit_fini($data)){
						$qtt = $reponse->STF_QUANTITE - $sortie;
						echo  $this->magasiner_model->updateproduit_fini(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $qtt]);
		    	}
          //  }   
            echo 1;
		}else{
			echo  0;
		}

	}

	public function  dataProduitFinis()
	{
		$this->load->model('Magasiner_model');
		$this->load->model('Commercial_model');
		$dateDebut = $this->input->post('dateDebut');
		$dateFin = $this->input->post('dateFin');
		if (!empty($dateDebut) && !empty($dateFin)) {
			$datas = $this->magasiner_model->Allstock_produit_fini(("STF_ORIGIN='PLASMAD_MAGASIN' AND STF_DATE BETWEEN $dateDebut AND $dateFin"));
		} else {
			//$date = date('Y-m');
			$datas = $this->magasiner_model->Allstock_produit_fini(("STF_ORIGIN='PLASMAD_MAGASIN'"));
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
			$po = $this->Commercial_model->chercheBon(['BC_PE' => $row->BC_ID]);
			if ($po) {
				$prix = $po->BC_PRIX;
			} else {
				$prix = 0;
			}
			$sub_array[] =	$prix;
			$sub_array[] = $row->STF_ORIGIN;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'><i/></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function dataProduitFini()
	{
		$this->load->model('Magasiner_model');
		$this->load->model('Commercial_model');
		$datas = $this->magasiner_model->Allstock_produit_fini(("STF_ORIGIN='PLASMAD_MAGASIN'"));
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->STF_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->STF_CLIENT;
			$sub_array[] = $row->STF_DIM;
			$sub_array[] = $row->STF_TAIL;
			$sub_array[] = $row->STF_QUANTITE;
			$po = $this->Commercial_model->chercheBon(['BC_PE' => $row->BC_ID]);
			if ($po) {
				$prix = $po->BC_PRIX;
			} else {
				$prix = 0;
			}
			$sub_array[] = $prix;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'><i/></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function saveEntre()
	{
		$this->load->model('Magasiner_model');
		$entre = $this->input->post('entre');
		$taill = $this->input->post('taille');
		$type = $this->input->post('type');
		$date = $this->input->post('date');
		$deux = "";
		$PO = $this->input->post('PO');
		$OBSE = $this->input->post('obs');
		$detalPo = $this->magasiner_model->bondecommande(["BC_PE" => $this->input->post('PO')]);
		$data = [
			"EF_QUANTITE" => $entre,
			"EF_DATE" => $date,
			"EF_QUANTITE_CHOIX" => $deux,
			"EF_MAGASIN" => $this->session->userdata('matricule'),
			"EF_TYPE" => "entre",
			"BC_ID" => $PO,
			"EF_TAILL" => $taill,
			"STF_OBSE" => $OBSE,
			"EF_REMARQUE" => $type,
			"EF_ORIGIN" => "PLASMAD_MAGASIN"
		];
		if ($this->magasiner_model->insertentre_produit_fini($data)) {

			$po = $this->magasiner_model->selectstock_produit_fini(["BC_ID" => $PO, "STF_ORIGIN" => "PLASMAD_MAGASIN"]);
			if (!$po) {
				$parametre = [
					"BC_ID" => $PO,
					"STF_QUANTITE" => $entre,
					"STF_TAIL" => $taill,
					"STF_CLIENT" => $detalPo->BC_CLIENT,
					"STF_DIM" => $detalPo->BC_DIMENSION,
					"STF_ORIGIN" => "PLASMAD_MAGASIN"
				];
				return $this->magasiner_model->insertstock_produit_fini($parametre);
			} else {
				$reponse = $this->magasiner_model->selectstock_produit_fini(["BC_ID" => $PO, "STF_DIM" => $detalPo->BC_DIMENSION, "STF_TAIL" => $taill, "STF_ORIGIN" => "PLASMAD_MAGASIN"]);
				if ($reponse) {
					$qtt = $reponse->STF_QUANTITE + $entre;
					return $this->magasiner_model->updateproduit_fini(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $qtt]);
				} else {
					$param = [
						"BC_ID" => $PO,
						"STF_QUANTITE" => $entre,
						"STF_TAIL" => $taill,
						"STF_CLIENT" => $detalPo->BC_CLIENT,
						"STF_DIM" => $detalPo->BC_DIMENSION,
						"STF_ORIGIN" => "PLASMAD_MAGASIN"
					];
					return $this->magasiner_model->insertstock_produit_fini($param);
				}
			}
		}
	}

	public function autocompletSortie()
	{
		$this->load->model('Magasiner_model');
		$data = $this->magasiner_model->autocompleteSortie($this->input->get('term'));
		$reponse = array();
		foreach ($data as $key => $data) {
			$reponse[] = $data->BC_ID;
		}
		echo json_encode($reponse);
	}

	public function autocompletsurplus()
	{
		$this->load->model('Magasiner_model');
		$data = $this->magasiner_model->autocompletesurplus($this->input->get('term'));
		$reponse = array();
		foreach ($data as $key => $data) {
			$reponse[] = $data->BC_ID;
		}
		echo json_encode($reponse);
	}

	public function saveApprove()
	{
		$this->load->model('Magasiner_model');
		$date =  $this->input->post('date');;
		$designation =  $this->input->post('designation');
		$quantite =  $this->input->post('quantite');
		$reference = $this->input->post('reference');
		$forniseur = $this->input->post('forniseur');
		$type = $this->input->post('type');

		$json = array("message" => "test", "type" => "error");
		$parametre = [
			"EM_REFERENCE" => $reference,
			"EM_DATE" => $date,
			"EM_MATIER" => $designation,
			"EM_FORNISEUR" => $forniseur,
			"EM_MAGASINIER" => $this->session->userdata("matricule"),
			"EM_ORIGIN" => "PLASMAD_MAGASIN"
		];
		if ($this->magasiner_model->insertentree_materiel($parametre)) {
			$lastId = $this->magasiner_model->lsatInsetEntre();
			$requette = [
				"LI_MATIER" => $designation,
				"LI_QUANTITE" => $quantite,
				"LI_TYPE" => "entre",
				"LI_ENTRE" => $lastId->EM_ID,
				"LI_ORIGIN" => "PLASMDA_MAGASIN",
				"LI_REFERENCE" => $type
			];
			if ($this->magasiner_model->insertstock_materiel($requette)) {
				$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $designation, 'ST_ORIGIN' => 'PLASMAD_MAGASIN']);
				$quantites = $id->ST_QUANTITE + $quantite;
				$this->magasiner_model->updatestock_matier_premier(["ST_DESIGNATION" => $designation, 'ST_ORIGIN' => 'PLASMAD_MAGASIN'], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "succes";
				$json['type'] = "succes";
			}
		}

		echo json_encode($json);
	}

	public function sortireMateriel($id)
	{
		$this->load->model('Magasiner_model');
		$designation =  $this->input->post('matier');
		$reference = $this->input->post('po');
		$quantite = $this->input->post('quantite');
		$prix = $this->input->post('prix');
		$parametre = [
			"MU_ID" => $id,
		];
		$data = [
			"MU_VALIDATEUR" => $this->session->userdata("matricule"),
			"MU_STATUT" => "SORTIE VALIDER"

		];
		if ($this->magasiner_model->updateMatier($parametre, $data)) {
			$bon = $this->magasiner_model->bondecommande(["BC_PE" => $reference]);
			$qtt = ($bon->BC_POISENKGSAVECMARGE * $quantite) / 100;
			$parametre = [
				"MS_REFERENCE" => $reference,
				"MS_DATE" => date('Y-m-d'),
				"MS_MATIER" => $designation,
				"MS_MAGASINIER" => $this->session->userdata("matricule"),
				"MS_ORIGIN" => "PLASMAD_MAGASIN"
			];
			if ($this->magasiner_model->insertsortie_materiel($parametre)) {
				$lastId = $this->magasiner_model->lsatInsetSortie();
				$requette = [
					"LI_MATIER" => $designation,
					"LI_QUANTITE" => $qtt,
					"LI_TYPE" => "sortie",
					"LI_SORTIE" => $lastId->MS_ID,
					"LI_VALEUR" => $prix,
					"LI_REFERENCE" => $reference,
					"LI_ORIGIN" => "PLASMDA_MAGASIN"
				];
				if ($this->magasiner_model->insertstock_materiel($requette)) {
					$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $designation, "ST_ORIGIN" => "PLASMAD_MAGASIN"]);
					$quantites = $id->ST_QUANTITE - $qtt;
					$this->magasiner_model->updatestock_matier_premier(["ST_DESIGNATION" => $designation, "ST_ORIGIN" => "PLASMAD_MAGASIN"], ["ST_QUANTITE" => $quantites]);
					$json['message'] = "";
					$json['type'] = "success";
				}
			}
			echo json_encode($json);
		} else {
			echo false;
		}
	}
	public function echange()
	{

		$this->load->model('Magasiner_model');
		$quantiteForn =  $this->input->post('quantiteForn');
		$produitForn =  $this->input->post('produitForn');
		$forniseur = strtoupper($this->input->post('fornisseur'));

		$recept = strtoupper($this->input->post('recept'));
		$receptQuantite =  $this->input->post('receptQuantite');
		$receptProduit =  $this->input->post('receptProduit');
		$json = array("message" => "test", "type" => "error");
		$parametre = [
			"EM_DATE" => date('Y-m-d'),
			"EM_MATIER" => $receptProduit,
			"EM_FORNISEUR" => $forniseur,
			"EM_MAGASINIER" => $this->session->userdata("matricule"),
			"EM_ORIGIN" => $recept . "_MAGASIN"
		];


		if ($this->magasiner_model->insertentree_materiel($parametre)) {
			$lastId = $this->magasiner_model->lsatInsetEntre();
			$requette = [
				"LI_MATIER" => $receptProduit,
				"LI_QUANTITE" => $receptQuantite,
				"LI_TYPE" => "entre",
				"LI_ENTRE" => $lastId->EM_ID,
				"LI_ORIGIN" => $recept . "_MAGASIN"
			];
			if ($this->magasiner_model->insertstock_materiel($requette)) {
				if($recept!= strtoupper("Autres sociétés")){
				$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $receptProduit, "ST_ORIGIN" => $recept. "_MAGASIN"]);
				$quantites = $id->ST_QUANTITE + $receptQuantite;
				$this->magasiner_model->updatestock_matier_premier(["ST_ID" =>  $id->ST_ID], ["ST_QUANTITE" => $quantites]);
				
			   }
			   $json['message'] = "";
			   $json['type'] = "succes";
			}
			echo json_encode($json);
		}
	
		/******************* sortie ***************************/

		$parametre = [

			"MS_DATE" => date('Y-m-d'),
			"MS_MATIER" => $produitForn,
			"MS_MAGASINIER" => $this->session->userdata("matricule"),
			"MS_ORIGIN" => $forniseur . "_MAGASIN"
		];
		if ($this->magasiner_model->insertsortie_materiel($parametre)) {
			$lastId = $this->magasiner_model->lsatInsetSortie();
			$requette = [
				"LI_MATIER" => $produitForn,
				"LI_QUANTITE" => $receptQuantite,
				"LI_TYPE" => "sortie",
				"LI_SORTIE" => $lastId->MS_ID,
				"LI_ORIGIN" => $forniseur . "_MAGASIN"
			];
			if ($this->magasiner_model->insertstock_materiel($requette)) {
			
				if($forniseur!= strtoupper("Autres sociétés")){
					$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $produitForn, "ST_ORIGIN" => $forniseur. "_MAGASIN"]);
					$quantites = $id->ST_QUANTITE - $quantiteForn;
					$this->magasiner_model->updatestock_matier_premier(["ST_ID" =>  $id->ST_ID], ["ST_QUANTITE" => $quantites]);
		     	}
				$json['message'] = "";
				$json['type'] = "success";
			}
		}
	 
	}
	//a modifier
	public function detailBon()
	{
		$this->load->model('Magasiner_model');
		$parametre = [
			"BC_PE" => $this->input->post('pe')
		];
		echo json_encode($this->magasiner_model->bondecommande($parametre));
	}
	public function chercheMateir()
	{
		$this->load->model('Magasiner_model');
		$parametre = [
			"BC_PE" => $this->input->post('po')
		];
		$html = '';
		$podata = $this->magasiner_model->bondecommande($parametre);
		$data = $this->magasiner_model->listeMatierUtiliser($parametre);
		foreach ($data as $key => $data) {
			$Qtt = "";
			/*if($data->MU_STATUT != "SORTIE VALIDER"){
             $btnLink ="<a href='magasiner/sortireMateriel/$data->MU_ID' class='btn btn-warning   btn-sm text-center sortierMatier'><i class='fa fa-edit'></i></a>";
		}else{
			 $btnLink ="<span class='btn btn-success btn-sm text-center'><i class='fa fa-check-circle'></i></span>";
		}*/
			$html .= '<li class="feed-item feed-item-danger">';
			$Qtt = ($podata->BC_POISENKGSAVECMARGE * $data->MU_QUANTITE) / 100;
			$html .= "<span class='text'> DESIGNATION : $data->MU_DESIGNATION QUANTITE : $data->MU_QUANTITE </span>";
			$html  .= "</li>";
		}

		echo $html;
	}

	public function liseteMPremierData()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->listeMatier(["ST_ORIGIN" => "PLASMAD_MAGASIN"]);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->ST_ID;
			$sub_array[] = $row->ST_DESIGNATION;
			$sub_array[] = $row->ST_PRIX_UNITAIRE;
			$sub_array[] = $row->ST_QUANTITE;

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function dataMagasin()
	{
		$this->load->model('Magasiner_model');
		if (isset($_GET['date']) and !empty($_GET['date'])) {
			$date = $_GET['date'];
		} else {
			$date = date('Y-m-d');
		}

		$data = array();
		$datas = $this->Magasiner_model->listebondecommande(['BC_DATE' => $date]);
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = "";
			$sub_array[] = $row->BC_QUNTITE;


			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function  dataProduitlivre()
	{
		$this->load->model('Magasiner_model');
		if (isset($_GET['date']) && !empty($_GET['date'])) {
			$date = $_GET['date'];
		} else {
			$date = date('Y-m-d');
		}
		$datas = $this->magasiner_model->dataLivraison(['EF_TYPE' => 'sortie', 'EF_DATE' => $date, "EF_ORIGIN" => 'PLASMAD_MAGASIN']);
		$data = array();
		foreach ($datas as $row) {
			$dataPlus = "";
			$sub_array = array();
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->STF_CLIENT;
			$sub_array[] = $row->STF_DIM;
			$sub_array[] = $row->STF_TAIL;
			$sub_array[] = $row->EF_QUANTITE;
			$dataPlus = $this->magasiner_model->dataentre_produit_fini(["EF_REMARQUE" => $row->BC_ID, "EF_BL" => $row->EF_BL]);
			if ($dataPlus) {
				foreach ($dataPlus as $key => $dataPlus) {
					$sub_array[] .= ',' . $dataPlus->BC_ID;
					$sub_array[] += $dataPlus->EF_QUANTITE;;
				}
			} else {
				$sub_array[] = "";
				$sub_array[] = "";
			}




			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function update_matierPremier()
	{
		$this->load->model('Magasiner_model');
		$data = scandir(FCPATH . 'uploads/excel');
		$uploads_dir = FCPATH . 'uploads/excel';
		$tmp_name = $_FILES["file"]["tmp_name"];
		$name = basename($_FILES["file"]["name"]);
		if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
			if ($xlsx = SimpleXLSX::parse("$uploads_dir/$name")) {

				$header_values = $rows = [];

				foreach ($xlsx->rows() as $k => $r) {
					if ($k === 0) {
						$header_values = $r;
						continue;
					}
					$rows[] = array_combine($header_values, $r);
				}
				foreach ($rows as $key => $rows) {
					$data = "";
					if (!$this->magasiner_model->selectStock_matier_premier(["ST_DESIGNATION" => $rows['ST_DESIGNATION']])) {
						$data = [
							"ST_DESIGNATION" => $rows["ST_DESIGNATION"],
							"ST_QUANTITE" => $rows["ST_QUANTITE"],
							"ST_TYPE" => $rows["ST_TYPE"],
							"ST_PRIX_UNITAIRE" => $rows["ST_PRIX_UNITAIRE"],
							"ST_ORIGIN" => "PLASMAD"

						];
						$this->magasiner_model->insertStock_matier_premier($data);
					}
				}
			}
		}
		return 0;
	}
	public function echangeStockFini()
	{
		$this->load->model('Magasiner_model');
		$sortie = $this->input->post('sortie');
		$taill = $this->input->post('tail');
		$date = $this->input->post('date_entre');
		$EF_BL = $this->input->post('BL');
		$OBSE = $this->input->post('obs');
		$PO = $this->input->post('PO');
		$POS = $this->input->post('POS');
		$detalPo = $this->magasiner_model->bondecommande(["BC_PE" => $this->input->post('PO')]);
		$data = [
			"EF_QUANTITE" => $sortie,
			"EF_DATE" => $date,
			"EF_MAGASIN" => $this->session->userdata('matricule'),
			"EF_TYPE" => "sortie",
			"EF_BL" => $EF_BL,
			"BC_ID" => $PO,
			"STF_OBSE" => $OBSE,
			"EF_TAILL" => $taill,
			"EF_ORIGIN" => "PLASMAD_STOCK",
			"EF_REMARQUE" => $POS
		];
		if ($this->magasiner_model->insertentre_produit_fini($data)) {
			$reponse = $this->magasiner_model->selectstock_produit_fini(["BC_ID" => $PO, "STF_DIM" => $detalPo->BC_DIMENSION, "STF_TAIL" => $taill, "STF_ORIGIN" => "PLASMAD_STOCK"]);
			if ($reponse) {
				$qtt = $reponse->STF_QUANTITE - $sortie;
				return $this->magasiner_model->updateproduit_fini(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $qtt]);
			}
		}
	}
	public function exportProduitFini()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->Allstock_produit_fini(("STF_ORIGIN='PLASMAD_MAGASIN'"));
		$data = array();
		$excel = "DATE\tPO\tCLIENT\tDIM\tTAILLE\tEN STOCK\n";
		foreach ($datas as $row) {

			$excel .= "$row->STF_DATE\t$row->BC_ID\t$row->STF_CLIENT\t$row->STF_DIM\t$row->STF_TAIL\t$row->STF_QUANTITE\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des produit fini du  : " . date("d-m-Y") . "PLASMAD.xls");

		print $excel;
		exit;
	}

	public function exportentreProduitFini()
	{

		$excel = "ID\tDATE\tPO\tMAGASINIER\tDIMENSION\tQTT\tOBSERVATION\n";

		$datas = $this->magasiner_model->entre_produit_fini(['EF_TYPE' => 'entre']);
		$data = array();
		foreach ($datas as $row) {
			$excel .= "$row->EF_ID\t$row->EF_DATE\t$row->BC_ID\t$row->EF_MAGASIN\t$row->BC_DIMENSION\t$row->EF_QUANTITE\t$row->STF_OBSE\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des entrees des produits fini du  : " . date("d-m-Y") . "PLASMAD.xls");

		print $excel;
		exit;
	}
	public function exportsortieProduitFini()
	{

		$excel = "ID\tDATE\tPO\tMAGASINIER\tDIMENSION\tQTT\tOBSERVATION\n";

		$datas = $this->magasiner_model->entre_produit_fini(['EF_TYPE' => 'sortie']);
		$data = array();
		foreach ($datas as $row) {
			$excel .= "$row->EF_ID\t$row->EF_DATE\t$row->BC_ID\t$row->EF_MAGASIN\t$row->BC_DIMENSION\t$row->EF_QUANTITE\t$row->STF_OBSE\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des sortie des produits fini du  : " . date("d-m-Y") . "PLASMAD.xls");

		print $excel;
		exit;
	}

	public function exportentrelivrasoin()
	{
		$this->load->model('Magasiner_model');
		$excel = "\t\t\tMOUVEMENT SACHETS PE MOIS " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "DATE BON DE COMMANDE\tCLIENT\tDIMENSION\tTAILLE\tCMDE\tSTOCK INIT\tQUANTITE ENTREE\tQUANTITE SURPLUS\tQUANTITE LIVRE\tSTOCK FINAL\tOBSERVATION\tDATE DE LIVRAISON\tN°BL\n";




		if (isset($_POST['date']) && !empty($_POST['date'])) {
			$date = $_POST['date'];
		} else {
			$date = date('Y-m-d');
		}
		$datas = $this->magasiner_model->dataLivraison(['EF_TYPE' => 'sortie', 'EF_DATE' => $date, "EF_ORIGIN" => 'PLASMAD_MAGASIN']);
		foreach ($datas as $row) {
			$dataPlus = $this->magasiner_model->dataentre_produit_fini(["EF_REMARQUE" => $row->BC_ID, "EF_BL" => $row->EF_BL]);
			$fini = "";
			$qtt = 0;
			if ($dataPlus) {
				foreach ($dataPlus as $key => $dataPlus) {
					$fini .= ',' . $dataPlus->BC_ID;
					$qtt += $dataPlus->EF_QUANTITE;
				}
			}
			$sfn = 0;
			$bon = $this->magasiner_model->bondecommande(['BC_PE' => $row->BC_ID]);
			$stokMagasin = $this->magasiner_model->selectstock_produit_fini(['STF_TAIL' => $row->STF_TAIL, 'BC_ID' => $row->BC_ID]);
			$reste = $bon->BC_QUNTITE - $row->EF_QUANTITE - $qtt;
			$dataentre = $this->magasiner_model->dataentre_produit_fini(["EF_BL" => $row->EF_BL, "EF_TYPE" => "entre"]);
			if ($dataentre) {
				foreach ($dataentre as $key => $dataentre) {

					$sfn += $dataentre->EF_QUANTITE;
				}
			}
			//$sfn = $row->STF_QUANTITE - $row->EF_QUANTITE - $qtt;
			$excel .= "$row->BC_ID\t$row->STF_CLIENT\t$row->STF_DIM\t$bon->BC_QUNTITE\t$row->STF_TAIL\t$sfn\t$row->EF_QUANTITE\t$fini\t$qtt\t$reste\t$row->STF_QUANTITE\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des sortie des produits fini du  : " . date("d-m-Y") . "PLASMAD.xls");

		print $excel;
		exit;
	}



 public function exportlivrasoin()
	{
		$this->load->model('Magasiner_model');
		$excel = "\t\t\tMOUVEMENT SACHETS PE MOIS " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "DATE BON DE COMMANDE\tCLIENT\tDIMENSION\tTAILLE\tCMDE\tSTOCK INIT\tQUANTITE ENTREE\tQUANTITE SURPLUS\tQUANTITE LIVRE\tSTOCK FINAL\tOBSERVATION\tDATE DE LIVRAISON\tN°BL\n";




		if (isset($_POST['date']) && !empty($_POST['date'])) {
			$date = $_POST['date'];
		} else {
			$date = date('Y-m-d');
		}
		$datas = $this->magasiner_model->dataLivraison(['EF_TYPE' => 'sortie', 'EF_DATE' => $date, "EF_ORIGIN" => 'PLASMAD_MAGASIN']);
		foreach ($datas as $row) {
			$dataPlus = $this->magasiner_model->dataentre_produit_fini(["EF_REMARQUE" => $row->BC_ID, "EF_BL" => $row->EF_BL]);
			$fini = "";
			$qtt = 0;
			if ($dataPlus) {
				foreach ($dataPlus as $key => $dataPlus) {
					$fini .= ',' . $dataPlus->BC_ID;
					$qtt += $dataPlus->EF_QUANTITE;
				}
			}
			$sfn = 0;
			$bon = $this->magasiner_model->bondecommande(['BC_PE' => $row->BC_ID]);
			$stokMagasin = $this->magasiner_model->selectstock_produit_fini(['STF_TAIL' => $row->STF_TAIL, 'BC_ID' => $row->BC_ID]);
			$reste = $bon->BC_QUNTITE - $row->EF_QUANTITE - $qtt;
			$dataentre = $this->magasiner_model->dataentre_produit_fini(["EF_BL" => $row->EF_BL, "EF_TYPE" => "entre"]);
			if ($dataentre) {
				foreach ($dataentre as $key => $dataentre) {

					$sfn += $dataentre->EF_QUANTITE;
				}
			}
			//$sfn = $row->STF_QUANTITE - $row->EF_QUANTITE - $qtt;
			$excel .= "$row->BC_ID\t$row->STF_CLIENT\t$row->STF_DIM\t$bon->BC_QUNTITE\t$row->STF_TAIL\t$sfn\t$row->EF_QUANTITE\t$fini\t$qtt\t$reste\t$row->STF_QUANTITE\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des sortie des produits fini du  : " . date("d-m-Y") . "PLASMAD.xls");

		print $excel;
		exit;
	}

	public function exportSortierMarierPremier()
	{

		$this->load->model('Magasiner_model');
		if (isset($_POST['date']) and !empty($_POST['date'])) {
			$date = $_POST['date'];
		} else {
			$date = date('Y-m-d');
		}
		$datas = $this->magasiner_model->sortie_materielParama(['MS_DATE' => $date]);
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
		
				<td> $row->MS_DATE</td>
				<td>$row->LI_MACHINE</td>
				<td> $row->LI_REFERENCE</td>
				<td style='whidth:200px!important'> $row->MS_MATIER</td>
				<td> $row->LI_QUANTITE</td>
		";


			if ($row->LI_QUANTITE >= 25) {
				$qtt =  $row->LI_QUANTITE;
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
				$liQtt =  $row->LI_QUANTITE . " Kg";;
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

		$filename = "PLANNING EXTRUSION DU : " . date('d / m / Y');

		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}

	public function sortieMatier()
	{
		$this->load->model('Magasiner_model');
		$quantiteForn =  $this->input->post('quantiteForn');
		$produitForn =  $this->input->post('produitForn');
		$prix = $this->input->post('prix');
		$receptQuantite =  $this->input->post('receptQuantite');
		$reference = $this->input->post('reference');
		$machine = $this->input->post('machine');
		$json = array("message" => "test", "type" => "error");
		$parametre = [

			"MS_DATE" => date('Y-m-d'),
			"MS_MATIER" => $produitForn,
			"MS_MAGASINIER" => $this->session->userdata("matricule"),
			"MS_ORIGIN" => "PLASMAD_MAGASIN"
		];
		if ($this->magasiner_model->insertsortie_materiel($parametre)) {
			$lastId = $this->magasiner_model->lsatInsetSortie();
			$requette = [
				"LI_MATIER" => $produitForn,
				"LI_QUANTITE" => $receptQuantite,
				"LI_TYPE" => "sortie",
				"LI_SORTIE" => $lastId->MS_ID,
				"LI_ORIGIN" => "PLASMAD_MAGASIN",
				"LI_VALEUR" => $prix,
				"LI_REFERENCE" => $reference,
				"LI_MACHINE" => $machine
			];
			if ($this->magasiner_model->insertstock_materiel($requette)) {
				$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $produitForn, "ST_ORIGIN" => "PLASMAD_MAGASIN"]);
				$quantites = $id->ST_QUANTITE - $receptQuantite;
				$this->magasiner_model->updatestock_matier_premier(["ST_DESIGNATION" => $produitForn, "ST_ORIGIN" => "PLASMAD_MAGASIN"], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "insert";
				$json['type'] = "success";
			}
		}
		echo json_encode($json);
	}
	public function SauveSortieMatierAValider(){
		$this->load->model('Magasiner_model');
		$machine = $this->input->post('machine');
		$po = $this->input->post('po');

   return	$this->magasiner_model->insertMatierattentvalide([
   		"PO_MAV"=>$po, 
   		"DATE_MAV"=>date('Y-m-d'), 
   		"STATUT_MAV"=>"NON VAILIDER", 
   		"DEMANDE_MAV"=>$this->session->userdata('matricule'), 
   		"MAC_MAV"=>$machine 
   	]);
	}
	public function saveDetailValideSortie(){
		
		$ref = $this->input->post('produitForn');
		$po = $this->input->post('reference');
		$prix = $this->input->post('prix');
		$quantite = $this->input->post('receptQuantite');
		$des = $this->input->post('reference');

	return	$this->magasiner_model->insertmatierInfoAttentValide([
			"PO_MIAV"=>$po, 
			"DES_MIAV"=>$ref, 
			"QTT_MIAV"=>$quantite,
			"PRIX_MIAV"=>$prix
		]);
	}
	public function autocompleteSortie()
	{
		$this->load->model('planning_model');
		$resultat = array();
		$data = $this->planning_model->autocompleteStockAll($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->ST_DESIGNATION;
		}
		echo json_encode($resultat);
	}
	public function machine()
	{
		$this->load->model('Magasiner_model');
		$resultat = array();
		$data = $this->magasiner_model->autocompletMa($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->MA_DESIGNATION;
		}
		echo json_encode($resultat);
	}

	public function transaction()
	{
		$this->load->model('Magasiner_model');
		$param = $this->input->post('param');
		$data = $this->magasiner_model->dataentre_produit_fini(['BC_ID' => $param]);
		$result = "";
		if($data){
		foreach ($data as $data) {
			$result .= "<tr><td>$data->EF_ID</td><td>$data->EF_DATE</td><td>$data->EF_TAILL</td><td>$data->EF_QUANTITE</td><td>$data->EF_TYPE</td><td>$data->EF_ORIGIN</td><td><a href='$data->EF_ID' id='$data->EF_TYPE' class='btn btn-danger btn-sm supprimerEntre'><i class='fa fa-trash'></i></a></td></tr>";
		}
     	}else{
			$result .="<tr><td colspan='7' class='text-center'>Aucun résultat</td></tr>";
		}
		echo $result;
	}

	public function deleteTransaction()
	{
		$this->load->model('Magasiner_model');
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$data = $this->magasiner_model->dataentre_produit_finis(['EF_ID' => $id]);

		if ($type == "entre") {
			$reponse = $this->magasiner_model->selectstock_produit_fini(["BC_ID" => $data->BC_ID, "STF_TAIL" => $data->EF_TAILL]);
			if ($reponse) {
				$qtt = $reponse->STF_QUANTITE -  $data->EF_QUANTITE;
				$this->magasiner_model->updateproduit_fini(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $qtt]);
				return $this->magasiner_model->delete_entre_produit_finis(["EF_ID" => $id, "EF_TAILL" => $data->EF_TAILL]);
			}
		} else {
			$reponse = $this->magasiner_model->selectstock_produit_fini(["BC_ID" => $data->BC_ID, "STF_TAIL" => $data->EF_TAILL]);
			if ($reponse) {
				$qtt = $reponse->STF_QUANTITE +  $data->EF_QUANTITE;
				$this->magasiner_model->updateproduit_fini(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $qtt]);
				return $this->magasiner_model->delete_entre_produit_finis(["EF_ID" => $id, "EF_TAILL" => $data->EF_TAILL]);
			}
		}
	}


	public function exportSortierPram()
	{

		$this->load->model('Magasiner_model');
		$date = $this->input->get('date');
		$Po = explode(" ", $this->input->get('Po'));

		$requette = "(";
		$p = 0;
		foreach ($Po as $key => $Po) {
			if ($p == 0) {
				if ($Po != " ") {
					$requette .= "MS_ID" . "=" . "'" . $Po . "'";
					$p++;
				}
			} else {
				if ($Po != " ") {
					$requette .= " OR " . "MS_ID" . "=" . "'" . $Po . "'";
					$p++;
				}
			}
		}
		$requette .= ") AND MS_DATE LIKE '$date'";

		$datas = $this->magasiner_model->sortie_materielParama("$requette");

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
		
				<td> $row->MS_DATE</td>
				<td>$row->LI_MACHINE</td>
				<td> $row->LI_REFERENCE</td>
				<td style='whidth:200px!important'> $row->MS_MATIER</td>
				<td> $row->LI_QUANTITE</td>
		";


			if ($row->LI_QUANTITE >= 25) {
				$qtt =  $row->LI_QUANTITE;
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
				$liQtt =  $row->LI_QUANTITE. " Kg";;
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




	public function printStockSortie()
	{

		$this->load->model('Magasiner_model');
		$content ="";
		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		if(!empty($debut) && !empty($fin)){
			$stringdate = "LISTE SORTIE MATIEREES  DU ".$debut." AU " .$fin;
			$datas = $this->magasiner_model->sortie_materiel("MS_DATE BETWEEN  '$debut'  AND '$fin'");
		}else if(!empty($debut)){
			$stringdate = "LISTE SORTIE MATIEREES  DU ".$debut;
			$datas = $this->magasiner_model->sortie_materiel(["MS_DATE"=> $debut]);
		}else if(!empty($fin)){
			$stringdate = "LISTE SORTIE MATIEREES  DU " .$fin;
			$datas = $this->magasiner_model->sortie_materiel(["MS_DATE" => $fin]);
		}else{
			
			$date= date('Y-d');
			$stringdate = "LISTE SORTIE MATIEREES  DU ".$date;
			$datas = $this->magasiner_model->sortie_materiel(" MS_DATE like '$date'");
		}
	


		$content .= "<div class='cont w-100'>
  <table>
			<thead class='thead w-100'>
			<tr class='header'>
				<td colspan='6'>".$stringdate."</td>
			</tr>
		</thead>
		<tbody>
		   <tr>
		   
		   <th>ID</th>						
		   <th>DATE</th>
			<th>MAGASINER </th>
		   <th>RECEPTIONNAIRE</th>							
			<th>ARTICLE </th>
		   <th>QUANTITE</th>
   
		</tr>";
	

		foreach ($datas as $row) {
			$content .= "<tr>
		    	<td> $row->MS_ID</td>
				<td> $row->MS_DATE</td>
				<td>$row->MS_MAGASINIER</td>
				<td> $row->LI_REFERENCE</td>
				<td style='whidth:200px!important'> $row->MS_MATIER</td>
				<td> $row->LI_QUANTITE kg</td>";
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




	public function exportStock()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->listeMatier(["ST_ORIGIN" => "PLASMAD_MAGASIN"]);
		$excel = "\tSTOCK MATIERS PREMIERES " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "Désignation\tPrix Unitaire\tPrix Ariary\tStock\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->ST_DESIGNATION\t$row->ST_UNITE\t$row->ST_PRIX_UNITAIRE\t$row->ST_QUANTITE\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;
	}

	public function exportStockSortie()
	{
		$this->load->model('Magasiner_model');

		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		if(!empty($debut) && !empty($fin)){
			$datas = $this->magasiner_model->sortie_materiel("MS_DATE BETWEEN  '$debut'  AND '$fin'");
		}else if(!empty($debut)){
			$datas = $this->magasiner_model->sortie_materiel(["MS_DATE"=> $debut]);
		}else if(!empty($fin)){
			$datas = $this->magasiner_model->sortie_materiel(["MS_DATE" => $fin]);
		}else{
			$date= date('Y-d');
			$datas = $this->magasiner_model->sortie_materiel(" MS_DATE like '$date'");
		}
	

		
		$excel = "\tSORTIE STOCK MATIERS PREMIERES " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "ID\tDATE\tMAGASINER\tRECEPTION\tARTICLE\tQUANTITE\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->MS_ID\t$row->MS_DATE\t$row->MS_MAGASINIER\t$row->LI_REFERENCE\t$row->MS_MATIER\t $row->LI_QUANTITE\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;
	}
	public function deleteFiniTransac($idEntre , $idStockProduit){
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->dataentre_produit_finis(["EF_ID" => $idEntre]);
		if($datas){
			$rep = $this->magasiner_model->selectstock_produit_fini(["STF_ID"=>$idStockProduit]);
			 if($rep){

					if($datas->EF_TYPE=="sortie"){
						$newStock = $rep->STF_QUANTITE + $datas->EF_QUANTITE;
						if($this->magasiner_model->updatestock_produit_fini(["STF_ID"=>$idStockProduit],["STF_QUANTITE"=>$newStock])){
							$this->magasiner_model->deleteEntre_produit_fini(["EF_ID" => $idEntre]);
						}
					      
					}

					if($datas->EF_TYPE=="entre"){
						$newStock = $rep->STF_QUANTITE - $datas->EF_QUANTITE;
						if($this->magasiner_model->updatestock_produit_fini(["STF_ID"=>$idStockProduit],["STF_QUANTITE"=>$newStock])){
							$this->magasiner_model->deleteEntre_produit_fini(["EF_ID" => $idEntre]);
						}
				}
		     }
		}
	}
    

	
	public function initStock()
	{
		$this->load->model('Magasiner_model');
		$data = scandir(FCPATH . 'uploads/excel');
		$uploads_dir = FCPATH . 'uploads/excel';
		$tmp_name = $_FILES["file"]["tmp_name"];
		$name = basename($_FILES["file"]["name"]);
		if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
			if ($xlsx = SimpleXLSX::parse("$uploads_dir/$name")) {

				$header_values = $rows = [];

				foreach ($xlsx->rows() as $k => $r) {
					if ($k === 0) {
						$header_values = $r;
						continue;
					}
					$rows[] = array_combine($header_values, $r);
				}
				foreach ($rows as $key => $rows) {

					$reponse = $this->Magasiner_model->selectstock_produit_fini(['BC_ID'=>$rows["PO"],"STF_TAIL"=>$rows["TAILLE"]]);
                  if($reponse){
					$data = "";
					$data = [
						"STF_QUANTITE" => $rows["QUANTITE"],
					];
					$this->Magasiner_model->updateproduit_fini(['BC_ID'=>$rows["PO"],"STF_TAIL"=>$rows["TAILLE"]],$data);
				  }else{
					$bon = $this->Magasiner_model->bondecommande(['BC_ID'=>$rows["PO"]]);
					if($bon){
					$this->Magasiner_model->insertstock_produit_fini(
                        [
							"BC_ID"=>$rows["PO"], 
							"STF_QUANTITE"=>$rows["QUANTITE"],
							"STF_VALEUR"=>$bon->BC_PRIX, 
							"STF_TAIL"=>$rows["TAILLE"],
							"STF_CLIENT"=>$bon->BC_CODE, 
							"STF_DIM"=>$bon->BC_DIMENSION, 
							"STF_ORIGIN"=>$bon->BC_PRIX, 
							"STF_DATE"=>date('Y-m-d'), 
							"STF_LOCALISATION" =>"PLASMAD_MAGASIN"
						]);
					}	
				  }
					
				}
			}
		}
		return 0;
	}


	public function testQuantiteProduit(){
		$this->load->model('Magasiner_model');
		$designation = $this->input->post('produit');
		$json = array('message'=>false,'quantite'=>'Matier introuvable');
		$data = explode('|',$designation);
		$reponse = $this->Magasiner_model->select_stock_matier_premier(["ST_DESIGNATION"=>$data[0]]);
		if($reponse){
          $json['message'] = true;
		  $json['quantite'] = $reponse->ST_QUANTITE;
		}
		echo json_encode($json);
	}



public function printLivraison(){
	$this->load->model('Magasiner_model');

				$po = $this->input->get('po');
				$date = $this->input->get('date');
				if (!empty($po)) {
					$data = $this->Magasiner_model->listebondecommande(["BC_PE" => $po]);
				} else {
					if ($date == "") {
						$date = date('Y-m-d');
					}
					$data = $this->Magasiner_model->listebondecommande(["BC_DATE" => $date]);
				}

				$data = [

					"data" => $data,
					

				];
			$html = $this->load->view('Magasiner/printLivraison', $data,true);

		$filename = "LISTE DES SORTIE : " . date('d / m / Y');

		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream($filename);
	}
}
