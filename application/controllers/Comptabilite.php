<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class Comptabilite extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('compta_model');
		$this->load->library('pdf');
	}
	public function index()
	{
		$this->render_view('comptabiliter/Accueil');
	}
	public function saveMatierNew()
	{
		$designation = $this->input->post('designation');
		$prixUSDX = $this->input->post('prixUSDX');
		$prixAriaryX = $this->input->post('prixAriaryX');
		return $this->compta_model->insert_stock_matier_premier(["ST_DESIGNATION" => $designation, "ST_ORIGIN" => "PLASMAD_MAGASIN", "ST_PRIX_UNITAIRE" => $prixAriaryX, "ST_UNITE" => $prixUSDX,"ST_QUANTITE"=>0]);
	}
	public function page()
	{

		$page = $this->input->post('page');
		switch ($page) {
			case 'RECAP COSTING':
				$date = $this->input->post('date');
				$clients = $this->input->post('client');
				if ($date == "") {
					$date = date('Y-m');
					if ($clients != "") {
						$requette = "BC_CODE LIKE '$clients'";
					} else {
						$requette = "LV_DATE LIKE '%$date%'";
					}
				} else {
					$temp = explode("-", $date);
					$date = $temp[0] . "-" . $temp[1];
					$requette = "LV_DATE LIKE '%$date%'";
				}

				$client = $this->compta_model->listeLivraison(($requette));
				$reponse = [
					"data" => $client,
					"date"=>$date
				];

				$this->load->view('comptabiliter/recap_costing', $reponse);
				break;
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
				$this->load->view('comptabiliter/Entree');
				break;
			case 'SORTIE':
				$this->load->view('comptabiliter/Sortie');
				break;
			case 'PRODUIT FINI':
				$this->load->view('comptabiliter/produit/produitFini');
				break;
			case 'STOCK PRODUIT FINI':
				$this->load->view('comptabiliter/produit/stockproduitFini');
				break;
			case 'ENTREE MATIERE PREMIERE':
				$this->load->view('comptabiliter/matier/approvisionnement');
				break;
			case 'STOCK GENERALE':
				$this->load->view('comptabiliter/Stock_generale');
				break;
			case 'MATIERE PREMIERE':
				$this->load->view('comptabiliter/matier/Accueil');
				break;
			case 'STOCK MATIERE PREMIERE':
				$this->load->view('comptabiliter/Stock_matierPremier');
				break;
			case "SORTIE_ECHANGE":
				$this->load->view('comptabiliter/matier/echange');
				break;
			case "SORTIE_SORTIE":
				$this->load->view('comptabiliter/matier/sortieSimple');
				break;
			case 'SORTIE MATIERE PREMIERE':
				$this->load->view('comptabiliter/matier/sortie');
				break;
			case 'SORTIE_BON DE COMMANDE':
				$this->load->view('comptabiliter/matier/bon_de_commande');
				break;
			case 'HISTORIQUE':
				$this->load->view('comptabiliter/historique');
				break;

			case 'LISTE DES ENTREES MATIERE PREMIERE':
				$this->load->view('comptabiliter/matier/entreMatier');
				break;
			case 'LISTE DES SORTIES MATIERE PREMIERE':
				$this->load->view('comptabiliter/matier/sortieMatier');
				break;
			case 'LISTE DES SORTIES':
				$this->load->view('comptabiliter/produit/sortieProduit');
				break;
			case 'LISTE DES ENTREES':
				$this->load->view('comptabiliter/produit/entreProduit');
				break;
			case 'HISTORIQUE PRODUIT FINI PREMIER':
				$this->load->view('comptabiliter/produit/historiqueFini');
				break;
			case 'LIVRAISON':
				$this->load->view('comptabiliter/produit/historiqueFini');
				break;
			case 'COSTING':
				$this->load->view('comptabiliter/constingContent');
			break;	
			case 'COSTING DATA':
				$tableArray = array();
				$in = "";
				$date = $this->input->post('date');
				$po = $this->input->post('po');
				$type = $this->input->post('type');
				$origin = $this->input->post('origin'); 
				if($type ==""){
					$type = "PE";
				}
				$findate = $this->input->post('fin');
				$i = 0;
				if ($date == "") {
					if ($po != "") {
						$requette = "BC_PE LIKE '%$po%'";
					} else {
						$date = date('Y-m');
						$extru = $this->compta_model->extrusion("EX_DATE like '$date%' AND BC_TYPEMATIER = '$type'");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '$date%' AND BC_TYPEMATIER = '$type'");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '$date%' AND BC_TYPEMATIER = '$type'");
						foreach ($extru as $key => $extru) {
							if (!in_array($extru->EX_BC_ID, $tableArray)) {
								array_push($tableArray, $extru->EX_BC_ID);
								if ($i != 0) {
									$in .= " OR BC_PE like '$extru->EX_BC_ID'";
								} else {
									$in .= "BC_PE like '$extru->EX_BC_ID'";
									$i++;
								}
							}
						}
						foreach ($coupe as $key => $coupe) {
							if (!in_array($coupe->BC_ID, $tableArray)) {
								array_push($tableArray, $coupe->BC_ID);
								if ($i != 0) {
									$in .= " OR BC_PE like '$coupe->BC_ID'";
								} else {
									$in .= "BC_PE like '$coupe->BC_ID'";
									$i++;
								}
							}
						}
						foreach ($imprm as $key => $imprm) {
							if (!in_array($imprm->BC_ID, $tableArray)) {
								array_push($tableArray, $imprm->BC_ID);
								if ($i != 0) {
									$in .= " OR BC_PE like '$imprm->BC_ID'";
								} else {
									$in .= "BC_PE like '$imprm->BC_ID'";
									$i++;
								}
							}
						}

						$date = date('Y-m');
						if($in!=""){
								$requette = "$in";
						}else{
								$requette ="0";
						}
					
					}
				} else {
				
					if($findate !="" ){
						
						$extru = $this->compta_model->extrusion("EX_DATE  BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
					}else{
						$dateTEmp = explode("-", $date);
					    $date = $dateTEmp[0] . "-" . $dateTEmp[1];
						$extru = $this->compta_model->extrusion("EX_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
					}
					
					foreach ($extru as $key => $extru) {
						if (!in_array($extru->EX_BC_ID, $tableArray)) {
							array_push($tableArray, $extru->EX_BC_ID);
							if ($i != 0) {
								$in .= " OR BC_PE like '$extru->EX_BC_ID'";
							} else {
								$in .= "BC_PE like '$extru->EX_BC_ID'";
								$i++;
							}
						}
					}
					foreach ($coupe as $key => $coupe) {
						if (!in_array($coupe->BC_ID, $tableArray)) {
							array_push($tableArray, $coupe->BC_ID);
							if ($i != 0) {
								$in .= " OR BC_PE like '$coupe->BC_ID'";
							} else {
								$in .= "BC_PE like '$coupe->BC_ID'";
								$i++;
							}
						}
					}
					foreach ($imprm as $key => $imprm) {
						if (!in_array($imprm->BC_ID, $tableArray)) {
							array_push($tableArray, $imprm->BC_ID);
							if ($i != 0) {
								$in .= " OR BC_PE like '$imprm->BC_ID'";
							} else {
								$in .= "BC_PE like  '$imprm->BC_ID'";
								$i++;
							}
						}
					}

					  if($in!=""){
								$requette = "$in";
						}else{
								$requette ="0";
						}
					
				}
                if($origin=="Madakem"){
                      $matricule  = "BC_COMMERCIAL = 325";
				}else{
					 $matricule  = "(BC_COMMERCIAL like '44' OR BC_COMMERCIAL like 'MBOLA')" ;
				}
 
				$po = $this->compta_model->lisPeDuMois("(".$requette.") ORDER BY BC_DATE ASC",$matricule);
				$reponse = [
					"data"   => $po     ,
					"origin" => $origin 
				];
				
				$this->load->view('comptabiliter/costing', $reponse);
				break;
			default:
				break;
		}
	}
	public function liseteMPremierData()
	{

		$datas = $this->compta_model->listeMatier(["ST_ORIGIN"=>"PLASMAD_MAGASIN"]);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->ST_DESIGNATION;
			$sub_array[] = $row->ST_QUANTITE;
			$sub_array[] = $row->ST_UNITE;
			$sub_array[] = $row->ST_PRIX_UNITAIRE;
			$sub_array[] = "<a href='#' class='btn btn-warning btn-sm editMatiert' id=' $row->ST_ID'><i class='fa fa-edit'></i></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function saveApprove()
	{
		$this->load->model('Magasiner_model');
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
				"LI_ORIGIN" => "PLASMDA_MAGASIN"
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
				$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $receptProduit, "ST_ORIGIN" => $recept . "_MAGASIN"]);
				$quantites = $id->ST_QUANTITE + $receptQuantite;
				$this->magasiner_model->updatestock_matier_premier(["ST_DESIGNATION" => $receptProduit, "ST_ORIGIN" => $recept . "_MAGASIN"], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "";
				$json['type'] = "succes";
			}

			echo json_encode($json);
		}

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
				$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $produitForn, "ST_ORIGIN" => $forniseur . "_MAGASIN"]);
				$quantites = $id->ST_QUANTITE - $quantiteForn;
				$this->magasiner_model->updatestock_matier_premier(["ST_DESIGNATION" => $produitForn, "ST_ORIGIN" => $forniseur . "_MAGASIN"], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "";
				$json['type'] = "success";
			}
		}
	}

	public function lisete_entre_materiel()
	{
		$datas = $this->compta_model->entree_materiel([]);
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

	public function UpdateRowMatier()
	{

		$this->load->model('compta_model');
		$data = [
			"ST_DESIGNATION" => $this->input->post('designation'),
			"ST_PRIX_UNITAIRE" => $this->input->post('prixAriary'),
			"ST_UNITE" => $this->input->post('prixUSD'),

		];
		$requette = ['ST_ID' => $this->input->post('id')];
		echo $this->compta_model->updateStock_matier_premier($requette, $data);
	}
    public function update_recap(){
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
						$data = [
							"LV_DATE"=>$rows["DATE"],
							"LV_PO"=>$rows["PO"],
							"LV_BON"=>$rows["BON DE SORTIE"],
							"LV_REPONSABLE"=>$this->session->userdata('matricule')

						];
						$this->compta_model->insertlivraison($data);
				}
			}
		}
		return 0;

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
							"ST_QUANTITE" => $rows["ST_INITIAL"],
							"ST_PRIX_UNITAIRE" => $rows["ST_REVIENT"],
							"ST_UNITE" => $rows["ST_PRIX_UNITAIRE"],
							"ST_ORIGIN" => $rows['ST_ORIGIN']

						];
						$this->magasiner_model->insertStock_matier_premier($data);
					}
				}
			}
		}
		return 0;
	}
	public function exportSortie()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->magasiner_model->sortie_materiel();
		$data = array();

		$excel = "\tSORTIE STOCK MATIERES PREMIERES " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "Id\tDate\tMagasinier\tPO\tDésignation\tStock\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->MS_ID\t$row->MS_DATE\t$row->MS_MAGASINIER\t$row->LI_REFERENCE\t$row->MS_MATIER\t$row->LI_QUANTITE\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;
	}


	public function exportEntre()
	{
		$this->load->model('Magasiner_model');
		$datas = $this->compta_model->entree_materiel([]);
		$data = array();

		$excel = "\tENTREE STOCK MATIERES PREMIERES " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "Id\tDate\tMagasinier\tFournisseur\tDésignation\tStock\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->EM_ID\t$row->EM_DATE\t$row->EM_MAGASINIER\t$row->EM_FORNISEUR\t$row->EM_MATIER\t$row->LI_QUANTITE\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;
	}

	public function detailProduction()
	{
		$this->load->model('planning_model');
		$this->load->model('production_model');

		$po = $this->input->post('po');
		$data = [
			"PO" => $this->input->post("po"),
			"extrusion" => $this->planning_model->extrusion(["EX_BC_ID" => $po]),
			"impression" => $this->planning_model->extrusion_inpression(["BC_ID" => $po]),
			"coupe" => $this->planning_model->extrusion_coupe(["BC_ID" => $po]),
			"qc" => $this->production_model->control(["C_PO" => $po]),
			"matier" => $this->compta_model->stock_materiel(["LI_REFERENCE" => $po, "LI_TYPE" => "sortie"]),
			"matierinression" => $this->compta_model->matierinression(['MI_PO' => $po])
		];


		$this->load->view('comptabiliter/detailProd', $data);
	}

	public function detailLivre()
	{
		$numpos = $this->input->post('numpos');
		$clientPo = $this->input->post('clientPo');
		$resultat = array("reponse" => "false", "data" => "");
		$data = $this->compta_model->bon("BC_CODE like '$clientPo'");


		if ($clientPo != "") {
			$data = $this->compta_model->bon("BC_CODE like '$clientPo'");
			if ($data) {
				$resultat["reponse"] = "true";
			}
			foreach ($data as $data) {
				$qtt = explode(" ", $data->BC_QUNTITE);
				$prix = explode(" ", $data->BC_PRIX);
				$resultat["data"] .= "<tr><td>$data->BC_CODE</td><td>$data->BC_PE</td><td>$data->BC_TYPEPRODUIT  $data->BC_TYPEMATIER</td><td>$data->BC_TYPEPRODUIT $data->BC_DIMENSION</td><td>$qtt[0]</td><td> $prix[0]</td><td><a href='#' id='$data->BC_PE' class='btn btn-warning btn-sm editlivre'><i class='fa fa-edit'></i></a><td></tr>";
			}
		} else if ($numpos != "") {
			$data = $this->compta_model->bon("BC_PE = '$numpos'");
			if ($data) {
				$resultat["reponse"] = "true";
			}
			foreach ($data as $data) {
				$qtt = explode(" ", $data->BC_QUNTITE);
				$prix = explode(" ", $data->BC_PRIX);
				$resultat["data"] .= "<tr><td>$data->BC_CODE</td><td>$data->BC_PE</td><td>$data->BC_TYPEPRODUIT  $data->BC_TYPEMATIER</td><td>$data->BC_TYPEPRODUIT $data->BC_DIMENSION</td><td>$qtt[0]</td><td> $prix[0]</td><td><a href='#' id='$data->BC_PE' class='btn btn-warning btn-sm editlivre'><i class='fa fa-edit'></i></a></td></tr>";
			}
		}
		echo json_encode($resultat);
	}
	public function autocompletClient()
	{
		$mot = $this->input->get('term');
		$resultat = array();
		$data = $this->compta_model->lisClientDuMois(" BC_CODE like '%$mot%'");
		foreach ($data as $key => $data) {
			$resultat[] = $data->BC_CODE;
		}
		echo json_encode($resultat);
	}
	public function livrePo()
	{
		$date = $this->input->post('date');
		$po = $this->input->post('po');
		$bon = $this->input->post('bon');
		$data = [
			"LV_DATE" => $date,
			"LV_PO" => $po,
			"LV_BON" => $bon,
			"LV_REPONSABLE" => $this->session->userdata('matricule'),
		];
		echo $this->compta_model->insertlivraison($data);
	}
	public function exportCosting()
	{
		$tableArray = array();
		$in = "";
		$date = $this->input->post('date');
		$po = $this->input->post('po');
		$i = 0;
		if ($date == "") {
			if ($po != "") {
				$requette = "BC_PE LIKE '%$po%'";
			} else {
				$date = date('Y-m');
				$extru = $this->compta_model->extrusion("EX_DATE like '$date%'");
				$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '$date%'");
				$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '$date%'");
				foreach ($extru as $key => $extru) {
					if (!in_array($extru->EX_BC_ID, $tableArray)) {
						array_push($tableArray, $extru->EX_BC_ID);
						if ($i != 0) {
							$in .= " OR BC_PE like '$extru->EX_BC_ID'";
						} else {
							$in .= "BC_PE like '$extru->EX_BC_ID'";
							$i++;
						}
					}
				}
				foreach ($coupe as $key => $coupe) {
					if (!in_array($coupe->BC_ID, $tableArray)) {
						array_push($tableArray, $coupe->BC_ID);
						if ($i != 0) {
							$in .= " OR BC_PE like '$coupe->BC_ID'";
						} else {
							$in .= "BC_PE like '$coupe->BC_ID'";
							$i++;
						}
					}
				}
				foreach ($imprm as $key => $imprm) {
					if (!in_array($imprm->BC_ID, $tableArray)) {
						array_push($tableArray, $imprm->BC_ID);
						if ($i != 0) {
							$in .= " OR BC_PE like '$imprm->BC_ID'";
						} else {
							$in .= "BC_PE like '$imprm->BC_ID'";
							$i++;
						}
					}
				}

				$date = date('Y-m');
				$requette = "$in ORDER BY BC_DATE ASC";
			}
		} else {
			$dateTEmp = explode("-", $date);
			$date = $dateTEmp[0] . "-" . $dateTEmp[1];

			$extru = $this->compta_model->extrusion("EX_DATE like '%$date%'");
			$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '%$date%'");
			$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '%$date%'");
			foreach ($extru as $key => $extru) {
				if (!in_array($extru->EX_BC_ID, $tableArray)) {
					array_push($tableArray, $extru->EX_BC_ID);
					if ($i != 0) {
						$in .= " OR BC_PE like '$extru->EX_BC_ID'";
					} else {
						$in .= "BC_PE like '$extru->EX_BC_ID'";
						$i++;
					}
				}
			}
			foreach ($coupe as $key => $coupe) {
				if (!in_array($coupe->BC_ID, $tableArray)) {
					array_push($tableArray, $coupe->BC_ID);
					if ($i != 0) {
						$in .= " OR BC_PE like '$coupe->BC_ID'";
					} else {
						$in .= "BC_PE like '$coupe->BC_ID'";
						$i++;
					}
				}
			}
			foreach ($imprm as $key => $imprm) {
				if (!in_array($imprm->BC_ID, $tableArray)) {
					array_push($tableArray, $imprm->BC_ID);
					if ($i != 0) {
						$in .= " OR BC_PE like '$imprm->BC_ID'";
					} else {
						$in .= "BC_PE like  '$imprm->BC_ID'";
						$i++;
					}
				}
			}

			$date = date('Y-m');
			$requette = " $in ORDER BY BC_DATE ASC";
		}


		$po = $this->compta_model->lisPeDuMois(($requette));
		$reponse = [
			"data" => $po
		];


		$html =  $this->load->view('comptabiliter/printCosting', $reponse, true);
		//echo $html;
		$filename = "COSTING";
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}
	public function exportCostingExecel()
	{
		$tableArray = array();
		$in = "";
		$date = $this->input->get('date');
		$po = $this->input->get('po');
		$type = $this->input->get('type');
		$origin = $this->input->get('origin');
		if(	$type==""){
			$type="PE";
		}
		$findate = $this->input->get('fin');
		$i = 0;
		if ($date == "") {
			if ($po != "") {
				$requette = "BC_PE LIKE '%$po%'";
			} else {
				$date = date('Y-m');
				$extru = $this->compta_model->extrusion("EX_DATE like '$date%' AND BC_TYPEMATIER = '$type'");
				$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '$date%' AND BC_TYPEMATIER = '$type'");
				$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '$date%' AND BC_TYPEMATIER = '$type'");
				foreach ($extru as $key => $extru) {
					if (!in_array($extru->EX_BC_ID, $tableArray)) {
						array_push($tableArray, $extru->EX_BC_ID);
						if ($i != 0) {
							$in .= " OR BC_PE like '$extru->EX_BC_ID'";
						} else {
							$in .= "BC_PE like '$extru->EX_BC_ID'";
							$i++;
						}
					}
				}
				foreach ($coupe as $key => $coupe) {
					if (!in_array($coupe->BC_ID, $tableArray)) {
						array_push($tableArray, $coupe->BC_ID);
						if ($i != 0) {
							$in .= " OR BC_PE like '$coupe->BC_ID'";
						} else {
							$in .= "BC_PE like '$coupe->BC_ID'";
							$i++;
						}
					}
				}
				foreach ($imprm as $key => $imprm) {
					if (!in_array($imprm->BC_ID, $tableArray)) {
						array_push($tableArray, $imprm->BC_ID);
						if ($i != 0) {
							$in .= " OR BC_PE like '$imprm->BC_ID'";
						} else {
							$in .= "BC_PE like '$imprm->BC_ID'";
							$i++;
						}
					}
				}

				$date = date('Y-m');
				$requette = "$in";
			}
		} else {

				if($findate !="" ){
						$extru = $this->compta_model->extrusion("EX_DATE  BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
					}else{
						$dateTEmp = explode("-", $date);
					    $date = $dateTEmp[0] . "-" . $dateTEmp[1];
						$extru = $this->compta_model->extrusion("EX_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
					}
			foreach ($extru as $key => $extru) {
				if (!in_array($extru->EX_BC_ID, $tableArray)) {
					array_push($tableArray, $extru->EX_BC_ID);
					if ($i != 0) {
						$in .= " OR BC_PE like '$extru->EX_BC_ID'";
					} else {
						$in .= "BC_PE like '$extru->EX_BC_ID'";
						$i++;
					}
				}
			}
			foreach ($coupe as $key => $coupe) {
				if (!in_array($coupe->BC_ID, $tableArray)) {
					array_push($tableArray, $coupe->BC_ID);
					if ($i != 0) {
						$in .= " OR BC_PE like '$coupe->BC_ID'";
					} else {
						$in .= "BC_PE like '$coupe->BC_ID'";
						$i++;
					}
				}
			}
			foreach ($imprm as $key => $imprm) {
				if (!in_array($imprm->BC_ID, $tableArray)) {
					array_push($tableArray, $imprm->BC_ID);
					if ($i != 0) {
						$in .= " OR BC_PE like '$imprm->BC_ID'";
					} else {
						$in .= "BC_PE like  '$imprm->BC_ID'";
						$i++;
					}
				}
			}

			$date = date('Y-m');
			$requette = " $in";
		}
		if($origin=="Madakem"){
			$matricule  = 325;
	  }else{
		   $matricule  = "44" ;
	  }
		$excel = "";
		$data = $this->compta_model->lisPeDuMois("(".$requette.") ORDER BY BC_DATE ASC",["BC_COMMERCIAL"=>$matricule]);

		foreach ($data as $data) {
			if ($data->BC_TYPEPRODUIT == "GAINES") {
				$quantitex = "QUANTITE : " . $data->BC_QUNTITE . " | KGS";
			} else {
				$quantitex = "QUANTITE : " . $data->BC_QUNTITE . " | PCS";
			}
			$prixbon = $this->compta_model->prixbon(['PB_PO' => $data->BC_PE]);
			if ($prixbon) {
				$RPI =  "P.R.I : " . $prixbon->PB_PRIX;
			} else {
				$RPI =  "P.R.I  : 0";
			}
			$excel .= "\t$data->BC_DATE\t$data->BC_PE\t$data->BC_TYPEPRODUIT  $data->BC_DIMENSION\t$quantitex\t$RPI\tPRIX  CONSENTIES: $data->BC_PRIX\n";
			$excel .= "\t$data->BC_STATUT\tCLIENT : $data->BC_CODE\n";
			$excel .= "\tEXTRUSIONIMPRESSION\tCOUPE\n";
			$excel .= "\tDESCRIPTION\tQTE\tUNIT\tPU\tTOTAL\tDESCRIPTION\tQTE\tUNIT\tPU\tTOTAL\tDESCRIPTION\tQTE\tUNIT\tPU\tTOTAL";
			$excel .= "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\n";
			/************calcule**************/
			$dextrusion =  $this->compta_model->extrusion(['EX_BC_ID'=>$data->BC_PE]);
			$extrusion_inpression = $this->compta_model->extrusion_inpression(['extrusion_inpression.BC_ID'=>$data->BC_PE]);
			$poid = $dextrusion;
			$poids = 0;
			$dure = 0;
			$MAT = 150;
			$sortir = 0;
			$EI_DUREE= 0;
			$MATCOUP=0;
			$EI_DUREECOUP=0;
			foreach ($poid as $key => $poid) {
				if($poid->EX_PDS_SOMME != ""){
					 $poids += $poid->EX_PDS_NET; 
					 $dure +=  $this->compta_model->time_to_sec($poid->EX_DUREE);
					 $sortir +=$poid->EX_PDS_SOMME;

				}
			  
			}
		$entreInpress = 0;	
	if($extrusion_inpression){
		foreach ($extrusion_inpression as $key => $extrusion_inpression) {
				 $MAT +=  $extrusion_inpression->EI_POIDS_NET;
				 $EI_DUREE += $this->compta_model->time_to_sec( $extrusion_inpression->EI_DUREE);
				 $entreInpress += $extrusion_inpression->EI_PDS_SOMME;
		 }
	}	
	$extrusion_coupe = $this->compta_model->extrusion_coupe(['extrusion_coupe.BC_ID'=>$data->BC_PE]);
	$EI_DUREECOUP = 0;
	$ED_METRAGE_SOMME = 0;
	$ED_POID_SORTIE_SOMME = 0;
	$piece = 0;
	$metrage = 0;
	$poidsSomme = 0;
	if($extrusion_coupe){
		foreach ($extrusion_coupe as $key => $extrusion_coupe) {
			 //	$MATCOUP +=  $extrusion_coupe->EI_POIDS_NET;
				 //$sortirCoup += $extrusion_coupe->ED_POID_SORTIE_SOMME;
				  $poientre = "";
				  $poientre =explode("+", $extrusion_coupe->ED_POID_ENTRE);
				  foreach ($poientre as $key => $poientre) {
					  $poidsSomme += (float)$poientre; 
				  }
				$ED_POID_SORTIE_SOMME  +=  $extrusion_coupe->ED_POID_SORTIE_SOMME;
				 $EI_DUREECOUP += $this->compta_model->time_to_sec($extrusion_coupe->ED_DURE);
				 $ED_METRAGE_SOMME +=  $extrusion_coupe->ED_METRAGE_SOMME;
				 $piece += $extrusion_coupe->ED_1ER_CHOIX_SOMME;
				 $metrage += $extrusion_coupe->ED_METRAGE_SOMME;
		 }
	}	

   $this->load->model('compta_model');		
   $control = $this->compta_model->controlData("C_PO ='$data->BC_PE' ORDER BY C_ID DESC");
   if($control){
	$piece = 0;
		$piece = $control->C_CHOIX;
   }
	$matierinression = $this->compta_model->matierinression(['MI_PO'=>$data->BC_PE]);
	$matier = $this->compta_model->stock_materiel(["LI_REFERENCE"=>$data->BC_PE,"LI_TYPE"=>"sortie"]);
	$totalSortie=0;
	$prixTotal= 0;
	$detaiMAt = "";
$x= 0;
	foreach($matier as $matier){
		$totalSortie += $matier->LI_QUANTITE;
		$prixTotal += $matier->LI_VALEUR*$matier->LI_QUANTITE;
		if($x !=0 ){
			$detaiMAt .= "/".$matier->LI_MATIER;
			$x++;
		}else{
			$detaiMAt .=$matier->LI_MATIER;
			$x++;
		}
		
	}
	$pu = 0;
	if($totalSortie != 0){
		//$pu = ($prixTotal * $poids ) / $totalSortie;
		$pu = $prixTotal /  $totalSortie;
	}
	$pux = $pu*$poids;
	
		$pxMatIpp =$pux + (($dure * 3.08 ) / 3600) + ((($dure *2)* 0.49 ) / 3600);
		$exdure = ($dure * 3.08 ) / 3600;
		$hdue= ($dure *  0.49) / 3600;
		$piodsover = $poids*0.403;

		if($data->BC_TYPE == "SS"){
				$coupe= (($EI_DUREECOUP) * 0.510 ) / 3600;
		}else if($data->BC_TYPE == "BS"){
				$coupe= (($EI_DUREECOUP) * 0.510 ) / 3600;
		}else{
				$coupe= (($EI_DUREECOUP) * 0.510 ) / 3600;
		}

		$imp = ($EI_DUREE * 2.84 ) / 3600;
		$HModIMP= (($EI_DUREE*2) *  0.440) / 3600;


		$hcoupe= ($EI_DUREECOUP * 0.260 ) / 3600;

		


		$sommeex =  $piodsover+$pux + $exdure +  $hdue;
		  $toto = 0;
		if($poids!=0){
												
			 $toto = number_format($sommeex/$poids,"3");
		}
		$sommeMat=0;
		$varmatiers = $matierinression;
		foreach($varmatiers  as $varmatiers){
			 $sommeMat +=($varmatiers->MI_PRIX * $varmatiers->MI_QUANTITE); 

		}

		 $totaMatIpp =$entreInpress*$toto; 
		$prixImPrixtotal =$HModIMP+$imp+$totaMatIpp+$sommeMat;
		
	    /*********************************************************/
		$excel .= "\t$detaiMAt\t$poids\tKGS\t$pu\t$pux\tMAT\t$entreInpress\tKGS\t$toto\t$totaMatIpp\tMAT\t$poidsSomme\tKGS";
			
		if($entreInpress!=0){
			$prixUCoupe = number_format($prixImPrixtotal / $entreInpress,'2');
			$poidsSomme = $poidsSomme*($prixImPrixtotal / $entreInpress);
			}else{

				if($poids==0){
					$prixUCoupe = 0;
				}else{
					$prixUCoupe = number_format($sommeex/$poids,"3");
					$poidsSomme = $poidsSomme*($sommeex / $poids);
				}
		}		
		
		$excel .="\t$prixUCoupe\t$poidsSomme\t\n";
		$EI_DUREEX = $this->compta_model->se_to_time($EI_DUREE);
		$EI_DUREECOUPX = $this->compta_model->se_to_time($EI_DUREECOUP);
		$durex = $this->compta_model->se_to_time($dure);
        $excel .="\tH MACHINE EXTR\t$durex\tH\t3.08\t$exdure\tH MACHINE IMPR\t$EI_DUREEX\tH\t2.84\t$imp\tH MACHINE COUPE\t$EI_DUREECOUPX\tH\t0,260\t$hcoupe\n";
		$EI_DUREEXS=number_format($EI_DUREE*2,3);
		$EI_DUREEXH = $this->compta_model->se_to_time($EI_DUREE*2);
		$excel .="\tH MOD EXTR\t$durex\tH\t0,49\t$hdue\tH MOD IMPR\t$EI_DUREEXH\tH\t0,440\t$HModIMP\tH MOD COUPE\t$EI_DUREECOUPX\tH\t0,510\t$coupe\n";
		
		$siValeur=0; $po = 0;$sommeMat=0; 
		if($matierinression ) {
			$tab =array();
			$conte = "";
			foreach($matierinression  as $matierinression ){
				if(array_key_exists($matierinression->MI_DESIGNATION, $tab)){
				   $tab[$matierinression->MI_DESIGNATION]["QUANTITE"] += $matierinression->MI_QUANTITE;
			   

				}else{
				   $tab[$matierinression->MI_DESIGNATION]["QUANTITE"] = $matierinression->MI_QUANTITE;
				   $tab[$matierinression->MI_DESIGNATION]["PRIX"] = $matierinression->MI_PRIX;
				}
			   
			}
		
		   foreach($tab as $key=>$tab){
			
					 
				  if( $data->BC_TYPE == "SS" AND  $po == 0){
					  $metre=$metrage/1000;
						 $siValeur +=number_format(0.007*$metre,'3'); 
						$conte .= "\tSEALING TAPE \t$metre\tM\t0,007\t$siValeur\n";
						$po++;
						
				}else{
					$conte = "\t\t\t\t\t\n";
				}
				$tabTot= $tab['QUANTITE'] * $tab['PRIX'];
				$tabQtt= $tab['QUANTITE'];
				$tabPrix =$tab['PRIX'];	
				$excel .= "\t\t\t\t\t\t$key\t$tabQtt\tKGS\t$tabPrix\t$tabTot $conte";
		   }
		   
		}
	
		$excel .= "\tOVERHEADS\t$poids\tKGS\t0,403\t$piodsover\n";

		if($poids==0){
		$ssp = 0;
		}else{
			$ssp = number_format($sommeex/$poids,"3");
		}

		if( $entreInpress!=0){
			$somPr = number_format($prixImPrixtotal / ($entreInpress+$sommeMat),'4');
		}else{
			$somPr = 0;
		}
		$sommeexs=number_format($sommeex,'3');
		$matprim=$entreInpress+$sommeMat;
		$prtoto = number_format($prixImPrixtotal,'4');
		$totalCops = $siValeur+$coupe+$hcoupe+$poidsSomme; 
		if( $totalCops!=0){
			$totalsp = number_format($totalCops/$piece,'4');
		}else{
			$totalsp =  0;
		}
		$totalCopsForm = number_format($totalCops ,'4');
		$excel .= "\tQTE SORTIE\t$sortir\t\t$ssp\t$sommeexs\tQTE SORTIE\t$matprim\t\t$somPr\t$prtoto\tQTE SORTIE\t$piece\t$totalsp\tPCES\t$totalCopsForm\n";
		 $excel .= "\t\n";
		}
		$excel .= "\t\n";
	
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=COSTING DU  : " . $date . "PLASMAD.xls");
		print $excel;
		exit;
	}
	public function initStock(){
		
	}
		public function autocompleteSortie()
	{
		$this->load->model('Compta_model');
		$resultat = array();
		$data = $this->Compta_model->autocompleteStockAll($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->ST_DESIGNATION;
		}
		echo json_encode($resultat);
	}
}
