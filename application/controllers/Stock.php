<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class stock extends My_Controller
{
	public function index()
	{
		$this->render_view('Stock/Accueil');
	}

	public function saurSortie()
	{
		$this->load->model('Stock_model');
		$data = json_decode($this->input->post('data'));
		$dataInit = [
			"SO_DATE" => date('Y-m-d'),
			"SO_RECEPTIONNAIRE" => $this->input->post('reception'),
			"SO_PE" => $this->input->post('PE'),
			"SO_SORTIE" => $this->input->post('date'),
			"SO_Stock" => $this->session->userdata('matricule'),
			"BO_BONDESORTIE" => 'BC-0001'

		];
		$this->Stock_model->insertSortie($dataInit);

		echo json_encode(array('message' => 'true'));
	}
	public function page()
	{
		$this->load->model('commercial_model');


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
				$this->load->view('Stock/Entree');
				break;
			case 'SORTIE':
				$this->load->view('Stock/Sortie');
				break;
			case 'PRODUIT FINI EN SURPLUS':
				$this->load->view('Stock/produit/produitFini');
				break;
			case 'STOCK PRODUIT FINI':
				$this->load->view('Stock/produit/stockproduitFini');
				break;
			case 'ENTREE MATIERE PREMIERE':
				$this->load->view('Stock/matier/approvisionnement');
				break;
			case 'QC':
				$this->load->view('Production/QC');
				break;
			case 'STOCK GENERALE':
				$this->load->view('Stock/Stock_generale');
				break;
			case 'MATIERE PREMIERE':
				$this->load->view('Stock/matier/Accueil');
				break;
			case 'STOCK MATIERE PREMIERE':
				$this->load->view('Stock/Stock_matierPremier');
				break;
			case "SORTIE_ECHANGE":
				$this->load->view('Stock/matier/echange');
				break;
			case "SORTIE_SORTIE":
				$this->load->view('Stock/matier/sortieSimple');
				break;
			case 'SORTIE MATIERE PREMIERE':
				$this->load->view('Stock/matier/sortie');
				break;
			case 'SORTIE_BON DE COMMANDE':
				$this->load->view('Stock/matier/bon_de_commande');
				break;
			case 'HISTORIQUE':
				$this->load->view('Stock/historique');
				break;

			case 'LISTE DES ENTREES MATIERE PREMIERE':
				$this->load->view('Stock/matier/entreMatier');
				break;
			case 'LISTE DES SORTIES MATIERE PREMIERE':
				$this->load->view('Stock/matier/sortieMatier');
				break;
			case 'LISTE DES SORTIES':
				$this->load->view('Stock/produit/sortieProduit');
				break;
			case 'LISTE DES ENTRES':
				$this->load->view('Stock/produit/entreProduit');
				break;
			case 'HISTORIQUE PRODUIT FINI PREMIER':
				$this->load->view('Stock/produit/historiqueFini');
				break;
			default:

				break;
		}
	}
	public function autocompletPo()
	{
		$this->load->model('Stock_model');
		$data = $this->Stock_model->autocompletePo($this->input->get('term'));
		$reponse = array();
		foreach ($data as $key => $data) {
			$reponse[] = $data->BC_PE;
		}
		echo json_encode($reponse);
	}

	public function lisete_sortie_materiel()
	{
		$this->load->model('Stock_model');
		$datas = $this->Stock_model->sortie_materiel();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->MS_ID;
			$sub_array[] = $row->MS_DATE;
			$sub_array[] = $row->MS_MAGASINIER;
			$sub_array[] = $row->MS_REFERENCE;
			$sub_array[] = $row->MS_MATIER;
			$sub_array[] = $row->LI_QUANTITE;

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function lisete_entre_materiel()
	{
		$this->load->model('Stock_model');
		$datas = $this->Stock_model->entree_materiel();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->EM_ID;
			$sub_array[] = $row->EM_DATE;
			$sub_array[] = $row->EM_MAGASINIER;
			$sub_array[] = $row->EM_FORNISEUR;
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
		$this->load->model('Stock_model');
		$datas = $this->Stock_model->entre_produit_fini(['EF_TYPE' => 'entre', 'EF_REMARQUE' => 'SURPLUS']);
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
		$this->load->model('Stock_model');
		$datas = $this->Stock_model->entre_produit_fini(['EF_TYPE' => 'sortie', 'EF_ORIGIN' => 'PLASMAD_STOCK']);
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
		$this->load->model('Stock_model');
		$json = array('message' => false);
		$data = $this->Stock_model->bondecommande(["BC_PE" => $this->input->post('param')]);
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
		$this->load->model('Stock_model');
		$json = array('message' => false);
		$data = $this->Stock_model->bondecommande(["BC_PE" => $this->input->post('param')]);
		$dim = array();
		if ($data) {
			$dimTemp = $this->Stock_model->Allstock_produit_fini(["BC_ID" => $this->input->post('param')]);
			foreach ($dimTemp as $dimTemp) {
				$dim[] = $dimTemp->STF_TAIL;
			}
			$json['message'] = "true";
			$json['client'] = $data->BC_CLIENT;
			$json['code'] = $data->BC_CODE;
			$json['dim'] = $data->BC_DIMENSION;
			$json['tail'] = $dim;
		}
		echo json_encode($json);
	}

	public function savesortie()
	{
		$this->load->model('Stock_model');
		$sortie = $this->input->post('sortie');
		$taill = $this->input->post('tail');
		$date = $this->input->post('date_entre');
		$deux = $this->input->post('choix');
		$EF_BL = $this->input->post('BL');
		$OBSE = $this->input->post('obs');
		$PO = $this->input->post('PO');
		$posortie = $this->input->post('posortie');
		$detalPo = $this->Stock_model->bondecommande(["BC_PE" => $this->input->post('PO')]);
		$data = [
			"EF_QUANTITE" => $sortie,
			"EF_DATE" => $date,
			"EF_MAGASIN" => $this->session->userdata('matricule'),
			"EF_TYPE" => "sortie",
			"EF_BL" => $EF_BL,
			"BC_ID" => $PO,
			"EF_TAILL" => $taill,
			"EF_ORIGIN" => "PLASMAD_STOCK",
			"STF_OBSE" => $OBSE,
			"EF_REMARQUE" => $posortie
		];
		if ($this->Stock_model->insertentre_produit_fini($data)) {
			$reponse = $this->Stock_model->selectstock_produit_fini(["BC_ID" => $PO, "STF_DIM" => $detalPo->BC_DIMENSION, "STF_TAIL" => $taill, "STF_ORIGIN" => "PLASMAD_STOCK"]);
			if ($reponse) {
				$qtt = $reponse->STF_QUANTITE - $sortie;
				return $this->Stock_model->updateproduit_fini(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $qtt]);
			}
		}
	}
	public function dataProduitFini()
	{
		$this->load->model('Stock_model');
		$this->load->model('Commercial_model');
		$datas = $this->Stock_model->Allstock_produit_fini(['STF_ORIGIN' => 'PLASMAD_STOCK',]);
		$data = array();
		$output = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = date('d-m-Y');
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
			$sub_array[] = $row->STF_LOCALISATION;
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
		$this->load->model('Stock_model');
		$entre = $this->input->post('entre');
		$taill = $this->input->post('taille');
		$date = $this->input->post('date');
		$deux = $this->input->post('choix');
		$PO = $this->input->post('PO');
		$local = $this->input->post('local');
		$OBSE = $this->input->post('obs');
		$detalPo = $this->Stock_model->bondecommande(["BC_PE" => $this->input->post('PO')]);
		$data = [
			"EF_QUANTITE" => $entre,
			"EF_DATE" => $date,
			"EF_MAGASIN" => $this->session->userdata('matricule'),
			"EF_TYPE" => "entre",
			"BC_ID" => $PO,
			"STF_OBSE" => $OBSE,
			"EF_TAILL" => $taill,
			"EF_ORIGIN" => "PLASMAD_STOCK",
			"EF_REMARQUE" => "SURPLUS",

		];
		if ($this->Stock_model->insertentre_produit_fini($data)) {

			$po = $this->Stock_model->selectstock_produit_fini(["BC_ID" => $PO]);
			if (!$po) {
				$parametre = [
					"BC_ID" => $PO,
					"STF_QUANTITE" => $entre,
					"STF_TAIL" => $taill,
					"STF_CLIENT" => $detalPo->BC_CLIENT,
					"STF_DIM" => $detalPo->BC_DIMENSION,
					"STF_LOCALISATION" => $local,
					"STF_ORIGIN" => "PLASMAD_STOCK"
				];
				return $this->Stock_model->insertstock_produit_fini($parametre);
			} else {
				$reponse = $this->Stock_model->selectstock_produit_fini(["BC_ID" => $PO, "STF_DIM" => $detalPo->BC_DIMENSION, "STF_TAIL" => $taill, "STF_ORIGIN" => "PLASMAD_STOCK"]);
				if ($reponse) {
					$qtt = $reponse->STF_QUANTITE + $entre;
					return $this->Stock_model->updateproduit_fini(["STF_ID" => $reponse->STF_ID], ['STF_QUANTITE' => $qtt]);
				} else {
					$param = [
						"BC_ID" => $PO,
						"STF_QUANTITE" => $entre,
						"STF_TAIL" => $taill,
						"STF_CLIENT" => $detalPo->BC_CLIENT,
						"STF_DIM" => $detalPo->BC_DIMENSION,
						"STF_ORIGIN" => "PLASMAD_STOCK"
					];
					return $this->Stock_model->insertstock_produit_fini($param);
				}
			}
		}
	}

	public function autocompletSortie()
	{
		$this->load->model('Stock_model');
		$data = $this->Stock_model->autocompleteSo($this->input->get('term'));
		$reponse = array();
		foreach ($data as $key => $data) {
			$reponse[] = $data->BC_ID;
		}
		echo json_encode($reponse);
	}

	public function saveApprove()
	{
		$this->load->model('Stock_model');
		$date =  $this->input->post('date');;
		$designation =  $this->input->post('designation');
		$quantite =  $this->input->post('quantite');
		$reference = $this->input->post('reference');
		$forniseur = $this->input->post('forniseur');

		$json = array("message" => "test", "type" => "error");
		$parametre = [
			"EM_REFERENCE" => $reference,
			"EM_DATE" => $date,
			"EM_MATIER" => $designation,
			"EM_FORNISEUR" => $forniseur,
			"EM_MAGASINIER" => $this->session->userdata("matricule")
		];
		if ($this->Stock_model->insertentree_materiel($parametre)) {
			$lastId = $this->Stock_model->lsatInsetEntre();
			$requette = [
				"LI_MATIER" => $designation,
				"LI_QUANTITE" => $quantite,
				"LI_TYPE" => "entre",
				"LI_ENTRE" => $lastId->EM_ID
			];
			if ($this->Stock_model->insertstock_materiel($requette)) {
				$id = $this->Stock_model->select_stock_matier_premier(["ST_DESIGNATION" => $designation]);
				$quantites = $id->ST_QUANTITE + $quantite;
				$this->Stock_model->updatestock_matier_premier(["ST_DESIGNATION" => $designation], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "succes";
				$json['type'] = "succes";
			}
		}

		echo json_encode($json);
	}

	public function sortireMateriel($id)
	{
		$this->load->model('Stock_model');
		$designation =  $this->input->post('matier');
		$reference = $this->input->post('po');
		$quantite = $this->input->post('quantite');
		$parametre = [
			"MU_ID" => $id,
		];
		$data = [
			"MU_VALIDATEUR" => $this->session->userdata("matricule"),
			"MU_STATUT" => "SORTIE VALIDER"

		];
		if ($this->Stock_model->updateMatier($parametre, $data)) {
			$bon = $this->Stock_model->bondecommande(["BC_PE" => $reference]);
			$qtt = ($bon->BC_POISENKGSAVECMARGE * $quantite) / 100;
			$parametre = [
				"MS_REFERENCE" => $reference,
				"MS_DATE" => date('Y-m-d'),
				"MS_MATIER" => $designation,
				"MS_MAGASINIER" => $this->session->userdata("matricule")
			];
			if ($this->Stock_model->insertsortie_materiel($parametre)) {
				$lastId = $this->Stock_model->lsatInsetSortie();
				$requette = [
					"LI_MATIER" => $designation,
					"LI_QUANTITE" => $qtt,
					"LI_TYPE" => "sortie",
					"LI_SORTIE" => $lastId->MS_ID
				];
				if ($this->Stock_model->insertstock_materiel($requette)) {
					$id = $this->Stock_model->select_stock_matier_premier(["ST_DESIGNATION" => $designation]);
					$quantites = $id->ST_QUANTITE - $qtt;
					$this->Stock_model->updatestock_matier_premier(["ST_DESIGNATION" => $designation], ["ST_QUANTITE" => $quantites]);
					$json['message'] = "";
					$json['type'] = "success";
				}
			}

			echo trim($id);
		} else {
			echo false;
		}
	}
	public function echange()
	{

		$this->load->model('Stock_model');
		$quantiteForn =  $this->input->post('quantiteForn');
		$produitForn =  $this->input->post('produitForn');
		$forniseur = $this->input->post('fornisseur');

		$json = array("message" => "test", "type" => "error");
		$parametre = [
			"EM_DATE" => date('Y-m-d'),
			"EM_MATIER" => $produitForn,
			"EM_FORNISEUR" => $forniseur,
			"EM_MAGASINIER" => $this->session->userdata("matricule")
		];
		if ($this->Stock_model->insertentree_materiel($parametre)) {
			$lastId = $this->Stock_model->lsatInsetEntre();
			$requette = [
				"LI_MATIER" => $produitForn,
				"LI_QUANTITE" => $quantiteForn,
				"LI_TYPE" => "entre",
				"LI_ENTRE" => $lastId->EM_ID
			];
			if ($this->Stock_model->insertstock_materiel($requette)) {
				$id = $this->Stock_model->select_stock_matier_premier(["ST_DESIGNATION" => $produitForn]);
				$quantites = $id->ST_QUANTITE + $quantiteForn;
				$this->Stock_model->updatestock_matier_premier(["ST_DESIGNATION" => $produitForn], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "";
				$json['type'] = "succes";
			}
			echo json_encode($json);
		}
		/******************* sortie ***************************/
		$receptQuantite =  $this->input->post('receptQuantite');
		$receptProduit =  $this->input->post('receptProduit');
		$recept = $this->input->post('recept');
		$parametre = [

			"MS_DATE" => date('Y-m-d'),
			"MS_MATIER" => $receptProduit,
			"MS_MAGASINIER" => $this->session->userdata("matricule")
		];
		if ($this->Stock_model->insertsortie_materiel($parametre)) {
			$lastId = $this->Stock_model->lsatInsetSortie();
			$requette = [
				"LI_MATIER" => $receptProduit,
				"LI_QUANTITE" => $receptQuantite,
				"LI_TYPE" => "sortie",
				"LI_SORTIE" => $lastId->MS_ID
			];
			if ($this->Stock_model->insertstock_materiel($requette)) {
				$id = $this->Stock_model->select_stock_matier_premier(["ST_DESIGNATION" => $receptProduit]);
				$quantites = $id->ST_QUANTITE - $receptQuantite;
				$this->Stock_model->updatestock_matier_premier(["ST_DESIGNATION" => $receptProduit], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "";
				$json['type'] = "success";
			}
		}
	}
	//a modifier
	public function detailBon()
	{
		$this->load->model('Stock_model');
		$parametre = [
			"BC_PE" => $this->input->post('pe')
		];
		echo json_encode($this->Stock_model->bondecommande($parametre));
	}
	public function chercheMateir()
	{
		$this->load->model('Stock_model');
		$parametre = [
			"BC_PE" => $this->input->post('po')
		];
		$html = "";
		$podata = $this->Stock_model->bondecommande($parametre);
		$data = $this->Stock_model->listeMatierUtiliser($parametre);
		foreach ($data as $key => $data) {
			$Qtt = "";
			if ($data->MU_STATUT != "SORTIE VALIDER") {
				$btnLink = "<a href='Stock/sortireMateriel/$data->MU_ID' class='btn btn-warning   btn-sm text-center sortierMatier'><i class='fa fa-edit'></i></a>";
			} else {
				$btnLink = "<span class='btn btn-success btn-sm text-center'><i class='fa fa-check-circle'></i></span>";
			}
			$Qtt = ($podata->BC_POISENKGSAVECMARGE * $data->MU_QUANTITE) / 100;
			$html .= "<tr><td>$data->MU_ID</td><td>$data->MU_DESIGNATION</td><td>$data->MU_QUANTITE</td><td>$Qtt</td><td>$data->MU_STATUT</td><td>$btnLink</td></tr>";
		}
		echo $html;
	}

	public function liseteMPremierData()
	{
		$this->load->model('Stock_model');
		$datas = $this->Stock_model->listeMatier();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->ST_ID;
			$sub_array[] = $row->ST_DESIGNATION;
			$sub_array[] = $row->ST_TYPE;
			$sub_array[] = $row->ST_PRIX_UNITAIRE;
			$sub_array[] = $row->ST_QUANTITE;

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function update_matierPremier()
	{
		$this->load->model('Stock_model');
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
					if (!$this->Stock_model->selectStock_matier_premier(["ST_DESIGNATION" => $rows['ST_DESIGNATION']])) {
						$data = [
							"ST_DESIGNATION" => $rows["ST_DESIGNATION"],
							"ST_QUANTITE" => $rows["ST_QUANTITE"],
							"ST_TYPE" => $rows["ST_TYPE"],
							"ST_PRIX_UNITAIRE" => $rows["ST_PRIX_UNITAIRE"]
						];
						$this->Stock_model->insertStock_matier_premier($data);
					}
				}
			}
		}
		return 0;
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
}
