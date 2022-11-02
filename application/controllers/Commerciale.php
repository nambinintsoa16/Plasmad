<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Commerciale extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}

	public function index()
	{
		$this->load->model('accueil_model');
		$this->render_view('Commerciale/Accueil');
	}
	public function printFactureCintre(){
		if (isset($_GET['po']) && !empty($_GET['po'])) {
			$BC_PO = $_GET['po'];
		} else {
			$BC_PO = $this->input->post('PO');
		}
		$data = $this->commercial_model->chercheBon(['BC_PE' => $BC_PO]);
		$html =  $this->load->view('global/bonDeCommandeCintre', ["data" => $data], true);
		//echo $html;
		$filename = "BON DE COMMANDE $data->BC_ID";
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);

	}
	public function En_instance()
	{
		$this->load->model('accueil_model');
		echo json_encode($this->accueil_model->listeInstance(''));
	}
	public function Bon_de_commande()
	{
		$this->load->model('commercial_model');
		$data = [
			'type' => $this->commercial_model->type()
		];
		$this->render_view('Commerciale/Bon_de_commande', $data);
	}
	public function livraison()
	{
		$this->load->model('planning_model');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}
		$donne = array();
		$datas = $this->planning_model->listedatedelivraison(['datedelivraison.DL_DATE' => $date]);
		foreach ($datas as $key => $datas) {
			if (array_key_exists($datas->BC_LIEULIVRE, $donne)) {
				$donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
			} else {
				$donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
			}
		}

		$this->load->view('Commerciale/listeLivraison', ["data" => $donne]);
	}
	public function AccuilePage()
	{
		$this->load->view('Commerciale/AccuilePage');
	}
	public function stockfinal()
	{
		$this->load->model('commercial_model');
		$data = array();
		$datas = $this->commercial_model->stockfinal();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->STF_REFENCE;
			$sub_array[] = $row->STF_DESIGNATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->STF_TOTAL;
			$sub_array[] = $row->STF_VALEUR;
			$sub_array[] =
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>';
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function retourProduit()
	{

		$this->load->model('commercial_model');
		$reponse = ["message" => "false"];
		$parametre = [
			"ST_DESIGNATION" => $this->input->post("param")
		];
		$data = $this->commercial_model->rechercheMatierPr($parametre);
		if ($data) {

			$reponse = [
				"message" => "true",
				"designation" => $data->ST_DESIGNATION,
				"prix" => $data->ST_PRIX_UNITAIRE
			];
		}
		echo json_encode($reponse);
	}
	public function autocompleteMatier()
	{
		$this->load->model('planning_model');
		$resultat = array();
		$data = $this->planning_model->autocompleteStock($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->ST_DESIGNATION;
		}
		echo json_encode($resultat);
	}
	public function numBon()
	{
		$this->load->model('commercial_model');
		$type = $this->input->post('type');

		$typePO = $this->input->post('typePO');
		if ($typePO == "CMTI I") {
			if ($type == "PP") {
				$dataCOm = $this->commercial_model->lastPEbondecommandeCMTPP();
				//$BC_PE = "PP";
				if ($dataCOm != "") {
					$BC_PE = $dataCOm->ID_CMT + 1;
				} else {
					$BC_PE = 1;
				}
			} else if ($type == "PE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandeCMTPE();
				//$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE = $dataCOm->CMT_ID + 1;
				} else {
					$BC_PE = 1;
				}
			} else if ($type = "HDPE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandeCMTPE();
				//$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE = $dataCOm->CMT_ID + 1;
				} else {
					$BC_PE = 1;
				}
			}
		} else {

			if ($type == "PP") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePP();
				//$BC_PE = "PP";
				if ($dataCOm != "") {
					$BC_PE = $dataCOm->PP_ID + 1;
				} else {
					$BC_PE = 1;
				}
			} else if ($type == "PE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePE();
				//$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE = $dataCOm->ID + 1;
				} else {
					$BC_PE = 1;
				}
			} else if ($type = "HDPE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePE();
				//$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE = $dataCOm->ID + 1;
				} else {
					$BC_PE = 1;
				}
			}
		}

		echo json_encode($BC_PE);
	}
	public function lastPEbondecommandePE()
	{
		$this->load->model('commercial_model');
	}
	public function countCommandeLIvre()
	{
		echo 20;
	}
	public function countCommande()
	{
		$this->load->model('commercial_model');
		echo $this->commercial_model->countCommandeMois();
	}
	public function countCommandePlan()
	{
		$this->load->model('commercial_model');
		$dtt =  $this->commercial_model->countCommandeMois();
		$rep = $this->commercial_model->countCommandePlMois();
		$json = [
			"text" => $rep,
			"value" => ($rep * 100) / $dtt
		];
		echo json_encode($json);
	}


	public function page()
	{
		$this->load->model('commercial_model');


		$page = $this->input->post('page');

		switch ($page) {
			case 'BON DE COMMANDE':
				$dataCOm = $this->commercial_model->lastPEbondecommandePE();
				$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->ID + 1;
				} else {
					$BC_PE .= 1;
				}
				$data = [
					"BC_PE" => $BC_PE,
					'type' => $this->commercial_model->type(),
					'type_de_matier' => $this->commercial_model->type_de_matier()
				];
				$this->load->view('Commerciale/Bon_de_commande', $data);
				break;
			case 'STOCK DISPONIBLE':
				$this->load->view('Commerciale/Stock_disponible');
				break;
			case 'MES COMMANDES':
				$data = [
					'annee' => $this->anne(),
					'type' => $this->commercial_model->type(),
					'type_de_matier' => $this->commercial_model->type_de_matier()
				];
				$this->load->view('Commerciale/Mes_commande', $data);
				break;
			case 'CALENDRIER DE LIVRAISON':
				$this->load->view('Commerciale/AccuilePage');
				break;
			case 'MES PRE COSTING':
				$data = [
					'annee' => $this->anne(),
					'type' => $this->commercial_model->type(),
					'type_de_matier' => $this->commercial_model->type_de_matier()
				];
				$this->load->view('Commerciale/mesprecosting', $data);
				break;
			case 'STOCK MATIERE':
				$this->load->view('global/stockMatier');
				break;
			case 'PRE COSTING':
				$data = [
					'type' => $this->commercial_model->type(),
					'type_de_matier' => $this->commercial_model->type_de_matier()
				];
				$this->load->view('Commerciale/Pre_costing', $data);
				break;
			case 'BON DE COMMANDE CINTRES':
				$this->load->view('Commerciale/bonCintre');
				break;
			case 'SUIVIE COMMANDE':
					$this->load->view('Commerciale/suivie_commande');
				break;	
			default:

				break;
		}
	}
	public function anne()
	{
		$indate = date('Y');
		$data = array(0 => $indate);
		$i = 1;
		for ($i = 1; $i < 20; $i++) {
			$data[$i] = $indate -  $i;
		}
		return $data;
	}
	public function migreBon()
	{
		$this->load->model('commercial_model');
		$reponse = $this->commercial_model->cherchePre(['BC_PE' => $this->input->post('id')]);
		if ($reponse) {
			if ($reponse->BC_TYPEMATIER == "PP") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePP();
				$BC_PE = "PP";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->PP_ID + 1;
				} else {
					$BC_PE .= 1;
				}
			} else if ($reponse->BC_TYPEMATIER == "PE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePE();
				$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->ID + 1;
				} else {
					$BC_PE .= 1;
				}
			}



			$migre = [
				'BC_PE' => $this->input->post('id')
			];
			$param = [
				"BC_MIGRE" => $BC_PE,
				"BC_STATUT" => "MIGRE"
			];






			$this->commercial_model->updatePre($migre, $param);

			$data = [
				"BC_PE" => $BC_PE,
				"JO_ID" => $reponse->JO_ID,
				"BC_DATE" => date('Y-m-d'),
				"BC_CLIENT" => $reponse->BC_CLIENT,
				"BC_CODE" => $reponse->BC_CODE,
				"BC_DATELIVRE" => $reponse->BC_DATELIVRE,
				"BC_REASSORT" => $reponse->BC_REASSORT,
				"BC_ECHANTILLON" => $reponse->BC_ECHANTILLON,
				"BC_DIMENSION" => $reponse->BC_DIMENSION,
				"BC_RABAT" => $reponse->BC_RABAT,
				"BC_SOUFFLET" => $reponse->BC_SOUFFLET,
				"BC_PERFORATION" => $reponse->BC_PERFORATION,
				"BC_TYPE" => $reponse->BC_TYPE,
				"BC_IMPRESSION" => $reponse->BC_IMPRESSION,
				"BC_CYLINDRE" => $reponse->BC_CYLINDRE,
				"BC_QUNTITE" => $reponse->BC_QUNTITE,
				"BC_PRIX" => $reponse->BC_PRIX,
				"BC_QUANTITEAPRODUIREENMETRE" => $reponse->BC_QUANTITEAPRODUIREENMETRE,
				"BC_POIDSDUNSACHET" => $reponse->BC_POIDSDUNSACHET,
				"BC_POISENKGSAVECMARGE" => $reponse->BC_POISENKGSAVECMARGE,
				"BC_OBSERVATION" => $reponse->BC_OBSERVATION,
				"BC_COMMERCIAL" => $reponse->BC_COMMERCIAL,
				"BC_VALIDATAIRE" => $reponse->BC_VALIDATAIRE,
				"BC_STATUT" => "NON PLANNIFIE",
				"BC_OBJETANNULATION" => $reponse->BC_OBJETANNULATION,
				"BC_TYPEPRODUIT" => $reponse->BC_TYPEPRODUIT,
				"BC_TYPEMATIER" => $reponse->BC_TYPEMATIER,
				"BC_MACHINE" => $reponse->BC_MACHINE,
				"BC_DATE_DE_PRODUCTION" => $reponse->BC_DATE_DE_PRODUCTION,
				"BC_TYPE_PRODUIT" => $reponse->BC_TYPE_PRODUIT
			];
			echo json_encode($this->commercial_model->insertbondecommande($data));
			if ($reponse->BC_TYPE == "PP") {
				$this->commercial_model->insertPEbondecommandePP();
			} else if ($reponse->BC_TYPE == "PE") {
				$this->commercial_model->insertPEbondecommandePE();
			} else {
				$this->commercial_model->insertPEbondecommandePE();
			}
		} else {
			echo json_encode($reponse);
		}
	}
	public function precosting()
	{
		$this->load->model('commercial_model');
		$data = array();
		$datas = $this->commercial_model->bondeprecosting($this->session->userdata('matricule'));
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_MIGRE;
			if ($row->BC_STATUT == "MIGRE") {
				$sub_array[] =
					'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->BC_PE) . '" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
			} else {
				$sub_array[] =
					'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->BC_PE) . '" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
			 <a href="#" id="' . $row->BC_PE . '" class="migre_post btn btn-success btn-sm"><i class="fa fa-save"></i></a>';
			}
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	public function MES_COMMANDES()
	{
		$this->load->model('commercial_model');
		$data = array();
		$datas = $this->commercial_model->bondecommandes($this->session->userdata('matricule'));
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;

			$sub_array[] =
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->BC_PE) . '" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function PrecommandeSpecifique($type, $anne = null, $mois = null)
	{
		$this->load->model('commercial_model');
		$data = array();
		if ($anne != null) {
			if ($type == 'TOUT') {
				$requette = [
					'BC_COMMERCIAL' => $this->session->userdata('matricule'),
				];
			} else {


				$requette = [
					'BC_COMMERCIAL' => $this->session->userdata('matricule'),
					'BC_TYPEPRODUIT' => $type
				];
			}
			if ($mois < 10) {
				$moisx = '0' . $mois;
			} else {
				$moisx = $mois;
			}
			$like = [
				'BC_DATE' => $anne . "-" . $moisx
			];
			$datas = $this->commercial_model->PrebondeType($requette, $like);
		} else {
			$requette = [
				'BC_COMMERCIAL' => $this->session->userdata('matricule'),
				'BC_TYPEPRODUIT' => $type
			];
			$datas = $this->commercial_model->PrebondeType($requette);
		}

		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_MIGRE;

			$sub_array[] =
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->BC_PE) . '" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function commandeSpecifique($type, $anne = null, $mois = null,$debut=null,$fin=null)
	{
		$this->load->model('commercial_model');
		$data = array();
		if($debut!="" && $fin !=""){
			if ($type == 'TOUT') {
				$requette ="BC_COMMERCIAL like '".$this->session->userdata('matricule')."' AND  BC_DATE between '".$debut."' AND '".$fin."'";
			} else {
$requette = "(BC_COMMERCIAL like  '".$this->session->userdata('matricule')."' AND  BC_TYPEPRODUIT like  '".$type."') AND  BC_DATE between '".$debut."' AND '".$fin."'";
			}
		
			$datas = $this->commercial_model->bondeType($requette);
       }else{

		if ($anne != null) {
			if ($type == 'TOUT') {
				$requette = [
					'BC_COMMERCIAL' => $this->session->userdata('matricule'),
				];
			} else {


				$requette = [
					'BC_COMMERCIAL' => $this->session->userdata('matricule'),
					'BC_TYPEPRODUIT' => $type
				];
			}
			if ($mois < 10) {
				$moisx = '0' . $mois;
			} else {
				$moisx = $mois;
			}
			$like = [
				'BC_DATE' => $anne . "-" . $moisx
			];
			$datas = $this->commercial_model->bondeType($requette, $like);
		} else {
			$requette = [
				'BC_COMMERCIAL' => $this->session->userdata('matricule'),
				'BC_TYPEPRODUIT' => $type
			];
			$datas = $this->commercial_model->bondeType($requette);
		}
}
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;

			$sub_array[] =
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->BC_PE) . '" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function detailPE()
	{
		$this->load->model('commercial_model');
		$pe = $this->input->post("pe");
		echo json_encode($this->commercial_model->bondecommande($pe, $this->session->userdata('matricule')));
	}

	public function detailPES()
	{
		$this->load->model('commercial_model');
		$pe = $this->input->post("pe");
		echo json_encode($this->commercial_model->bondecommandeTous($pe));
	}
	public function calculePrixCommande()
	{

		$this->load->model('commercial_model');
		$parametrePrix = $this->commercial_model->selectprixAppliquer(["PA_STATUT"=>"actif"]);
		$resultatPrix = array("prix" => 0, "marge" => 0, "total" => 0);
		$width = $this->input->post('width');
		$length = $this->input->post('length');
		$tickness = $this->input->post('thickness');
		$flat = $this->input->post('Flap');
		$gusset = $this->input->post('Gusset');
		$order = $this->input->post('Order');
		if($this->input->post('marge')==""){
			$porcent = 0;
		}else{
			$porcent = $this->input->post('marge');
		}
		$marge = $this->input->post('marges');
	
		$Prix_matier = $this->input->post('Prix_matier');
		$VitesseMachine = $this->input->post('VitesseMachine');
		$Printing_area = $this->input->post('Printing_area');
		$parametre = $this->input->post('parametre');
		switch ($parametre) {
			case '1':
				$rollDim = $width;
				$wt = (($rollDim * 1000 * $tickness * 2 * 0.923) / 1000) / 1000;
				$row = $order;
				$marielYeild = (($rollDim * 1000 * $tickness * 2 * 0.923) / 1000) / 1000;
				$totalYeild = $row / $marielYeild;
				$totalMat = $row + ($row * $marge / (100));
				$total = $totalMat * $Prix_matier;

				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
				$liknColor = (0.000222 * $Printing_area * $totalYeild * 0.001 * 3) * 5;

				$liknColor1 = (0.000222 * $Printing_area * $totalYeild * 0.001 * 3) * 5;


				$solvant = ((0.002 / 0.75) * $Printing_area * $totalYeild * 0.001) * 2.5;
				$printMc = ($totalMat / 25) * 0.910;
				$printPow = (($totalMat / 25) * 2) * 0.470;
				$Pover = $totalMat * 0.403;

				$totalBE = $Pover + $printPow + $printMc + $solvant + $modEXT + $hmachineEXT + $total + $liknColor1 + $liknColor;
				$prix = $totalBE / $order;
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = $prixmarge + $prix;
				break;


			case '2':



				$rollDim = $width + ($gusset * 2);
				$wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;

				$total = $totalMat * $Prix_matier;
				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
				$hmachineCoupe = 40 * 0.136;
				$modeCoupe = (40 * 2) * 0.5;
				$Pover = $totalMat * 0.403;
				$totalBE = $Pover + $modeCoupe + $hmachineCoupe + $modEXT + $hmachineEXT + $total;
				$prix = $totalBE / $order;
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;
			case '3':

				$rollDim = $width;
				$wt = ($rollDim * 1000 * $tickness * 2 * 0.923) / 1000 / 1000;
				$row = $order;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $row / $marielYeild;
				$total = $totalMat * $Prix_matier;
				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
				$Pover = $row * 0.403;

				$totalBE = $Pover + $modEXT + $hmachineEXT + $total;
				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;
			case '4':
				$rollDim = $width + $gusset;
				$wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;
				$total = $totalMat * $Prix_matier;

				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
				$hmachin = (($order * 12) / 15000) *  $parametrePrix->H_MACHINE_COUPE;

				$modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
				$Pover = $totalMat * 0.403;

				$totalBE = $Pover + $modeCoupe + $hmachin + $modEXT + $hmachineEXT + $total;


				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);
				break;
			case '5':



				$rollDim = $width + $gusset;
				$wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;
				$total = $totalMat * $Prix_matier;

				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

				$machinPrint =  ($totalMat / 25) * $parametrePrix->H_MACHINE_IMPR;
				$modPrint =  (($totalMat / 25) * 2) * $parametrePrix->H_MOD_IMPR;

				$machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
				$modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;

				$solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;
				$enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;

				$Pover = $totalMat * 0.403;


				$totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover;
				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;
			case '6':



				$rollDim = $width + $gusset;
				$wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;
				$total = $totalMat * $Prix_matier;
				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
				$enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;
				$solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

				$machinPrint =  ($totalYeild / 2000) * $parametrePrix->H_MACHINE_IMPR;
				$modPrint =  (($totalYeild / 2000)) * $parametrePrix->H_MOD_IMPR;
				$machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
				$modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
				$Pover = $totalMat * 0.403;

				$totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover;
				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;
			case '7':



				$rollDim = $length + $flat / 2 + $gusset;
				$wt = ($rollDim * $width * $tickness * 2 * 0.923) / 1000 / 1000;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;
				$total = $totalMat * $Prix_matier;

				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

				$enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;
				$solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

				$machinPrint =  ($totalMat / 25) * $parametrePrix->H_MACHINE_IMPR;
				$modPrint =  (($totalMat / 25) * 2) * $parametrePrix->H_MOD_IMPR;
				$sealing = $totalYeild * 0.0045;
				$machinecoupe = (($order * 12) / 15000) *  $parametrePrix->H_MACHINE_COUPE;
				$modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
				$Pover = $totalMat * 0.403;

				$totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover + $sealing;
				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;
			case '8':



				$rollDim = $length + $flat / 2 + $gusset;
				$wt = ($rollDim * $width * $tickness * 2 * 0.9) / 1000 / 1000;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.9 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;
				$total = $totalMat * $Prix_matier;

				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

				$sealing = $totalYeild * 0.0045;
				$machinecoupe = (($order * 12) / 15000) *  $parametrePrix->H_MACHINE_COUPE;
				$modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
				$Pover = $totalMat * 0.403;

				$totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinecoupe + $Pover + $sealing;
				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;

			case '9':
				$rollDim = $length + $flat / 2 + $gusset;
				$wt = ($rollDim * $width * $tickness * 2 * 0.9) / 1000 / 1000;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.9 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;
				$total = $totalMat * $Prix_matier;

				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

				$enrenoir = (0.000222 * $Printing_area * $order * 0.001) * 5;
				$solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

				$machinPrint =  ($totalMat / 25) * $parametrePrix->H_MACHINE_IMPR;
				$modPrint =  (($totalMat / 25) * 2) * $parametrePrix->H_MOD_IMPR;



				$sealing = $totalYeild * 0.0045;

				$machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
				$modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
				$Pover = $totalMat * 0.403;

				$totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinecoupe + $Pover + $sealing + $machinPrint + $modPrint + $solvant + $enrenoir;
				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;
			case '10':
				$rollDim = $width + $gusset;
				$wt = (($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000) / 2;
				$row = $order * $wt;
				$marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
				$totalMat = $row + ($row * $marge / (100));
				$totalYeild = $totalMat / $marielYeild;
				$total = $totalMat * $Prix_matier;
				$hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
				$modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
				$enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;
				$solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

				$machinPrint =  ($totalYeild / 2000) * $parametrePrix->H_MACHINE_IMPR;
				$modPrint =  (($totalYeild / 2000)) * $parametrePrix->H_MOD_IMPR;
				$machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
				$modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
				$Pover = $totalMat * 0.403;

				$totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover;
				$prix = number_format($totalBE / $order, 4);
				$prixmarge = ($prix * $porcent) / 100;
				$prixavemarge = number_format($prixmarge + $prix, 4);

				break;
			default:
            $totalBE = 0;
            $prix = number_format(0, 4);
            $prixmarge = 0;
            $prixavemarge = number_format(0, 4);
				break;
		}
		$resultatPrix['prix'] = number_format($prix, '4');
		$resultatPrix['marge'] = number_format($prixmarge, '4');
		$resultatPrix['total'] = number_format($prixavemarge, '4');

		/* $resultatPrix['row']=number_format($row);
    $resultatPrix['marielYeild']=$marielYeild;
    $resultatPrix['rollDim']=number_format($rollDim);
   
	$resultatPrix['totalYeild']= $totalYeild;
	$resultatPrix['solvant']=number_format( $solvant);
	$resultatPrix['sealing']= $sealing;*/

		//$resultatPrix['mrg']= $marge;
		/*
	$resultatPrix['enrenoir']= $enrenoir;*/
		$resultatPrix['rollDim'] = number_format($rollDim, '4');
		$resultatPrix['totalMat'] = number_format($totalMat, '4');
		$resultatPrix['totalYeild'] = number_format($totalYeild, '4');
		$resultatPrix['wt'] = number_format($wt, '4');

		echo json_encode($resultatPrix);
	
	}
	public function annuleBonDeCommande()
	{
		$this->load->model('commercial_model');
		$pe = $this->input->post("pe");
		$text = $this->input->post("text");
		$data = [
			"BC_OBJETANNULATION " => $text,
			"BC_STATUT" => "Annulée"
		];
		$this->commercial_model->updateUresult($pe, $data);
	}
	public function upadatePeCom()
	{
		$content = json_decode($this->input->post('content'));
		$data = [
			"BC_CLIENT" => $content[14],
			"BC_CODE" => $content[15],
			"BC_DATELIVRE" => $content[16],
			"BC_REASSORT" => $content[9],
			"BC_ECHANTILLON" => $content[10],
			"BC_DIMENSION" => $content[11],
			"BC_RABAT" => $content[12],
			"BC_SOUFFLET" => $content[5],
			"BC_PERFORATION" => $content[6],
			"BC_TYPE" => $content[7],
			"BC_IMPRESSION" => $content[8],
			"BC_CYLINDRE" => $content[1],
			"BC_QUNTITE" => $content[2],
			"BC_OBSERVATION" => $content[4],
			"BC_TYPEPRODUIT" => $content[17],
			"BC_TYPEMATIER" => $content[18]
		];

		echo $this->commercial_model->updateUresult($content[13], $data);
	}
	public function savePrecosting()
	{
		$this->load->model('commercial_model');
		$content = json_decode($this->input->post('content'));
		$data = [
			"BC_DATE" => date('Y-m-d'),
			"BC_CLIENT" => $content[14],
			"BC_CODE" => $content[15],
			"BC_DATELIVRE" => $content[16],
			"BC_REASSORT" => $content[9],
			"BC_ECHANTILLON" => $content[10],
			"BC_DIMENSION" => $content[11],
			"BC_RABAT" => $content[12],
			"BC_SOUFFLET" => $content[5],
			"BC_PERFORATION" => $content[6],
			"BC_TYPE" => $content[7],
			"BC_IMPRESSION" => $content[8],
			"BC_CYLINDRE" => $content[1],
			"BC_QUNTITE" => $content[2],
			"BC_PRIX" => $content[3],
			"BC_OBSERVATION" => $content[4],
			"BC_COMMERCIAL" => $this->session->userdata('matricule'),
			"BC_STATUT" => "NON PLANNIFIE",
			"BC_TYPEPRODUIT" => $content[17],
			"BC_TYPEMATIER" => $content[18],
			"BC_LIEULIVRE" => $content[20]
		];
		echo $this->commercial_model->insertPrecosting($data);
	}

	public function saveCommande()
	{
		$this->load->model('commercial_model');
		$content = json_decode($this->input->post('content'));
		$data = [
			"BC_PE" => $content[13],
			"BC_DATE" => date('Y-m-d'),
			"BC_CLIENT" => $content[14],
			"BC_CODE" => $content[15],
			"BC_DATELIVRE" => $content[16],
			"BC_REASSORT" => $content[9],
			"BC_ECHANTILLON" => $content[10],
			"BC_DIMENSION" => $content[11],
			"BC_RABAT" => $content[12],
			"BC_SOUFFLET" => $content[5],
			"BC_PERFORATION" => $content[6],
			"BC_TYPE" => $content[7],
			"BC_IMPRESSION" => $content[8],
			"BC_CYLINDRE" => $content[1],
			"BC_QUNTITE" => $content[2],
			"BC_PRIX" => $content[3],
			"BC_OBSERVATION" => $content[4],
			"BC_COMMERCIAL" => $this->session->userdata('matricule'),
			"BC_STATUT" => "NON PLANNIFIE",
			"BC_TYPEPRODUIT" => $content[17],
			"BC_TYPEMATIER" => $content[18],
			"BC_TYPE_PRODUIT" => $content[19],
			"BC_LIEULIVRE " => $content[20],
			"BC_QUANTITEAPRODUIREENMETRE" => $content[23],
			"BC_POIDSDUNSACHET" => $content[24],
			"BC_POISENKGSAVECMARGE" => $content[25],
			"BC_DIMENSIONPROD " => $content[26],


		];
		$this->commercial_model->insertbondecommande($data);
		$parametrePrix = $this->commercial_model->selectprixAppliquer(["PA_STATUT"=>"actif"]);
		$datas = [
			"PB_PO" => $content[13],
			"PB_PRIX" => $content[22],
			"PB_TYPECALCULE" => $content[19],
			"PB_DATE" => date('Y-m-d'),
			"PB_PRIXARIARY" => $content[28],
			"PB_VITESSEMACHINE" => $content[39],
			"PB_WIDTH" => $content[29],
			"PB_LENGTH" => $content[30],
			"PB_THICKNESS" => $content[31],
			"PB_FLAP" => $content[32],
			"PB_GUSSET" => $content[33],
			"PB_ORDER" => $content[34],
			"PB_MARGE" => $content[35],
			"PB_PRINTING_AREA" => $content[36],
			"PB_PRIX_MATIER" => $content[37],
			"PB_MARGES" => $content[38],
			"PB_SANS_MARGE"=>$content[40],
			"PB_EURO"=>$content[41],
			"PB_MARGE_REEL"=>$content[42],
			"PB_ID_HM"=>$parametrePrix->PA_ID,
			"BC_ORIGIN"=>"PLASMAD"

		];
		$this->commercial_model->insertprixbon($datas);

		if ($content[21] == "CMTI I") {
			if ($content[18] == "PP") {
				$this->commercial_model->insertPEbondecommandeCMTPP(['ID_STATUT' => 'off']);
			} else if ($content[18] == "PE") {
				$this->commercial_model->insertPEbondecommandeCMTPE(['CMT_STATUT' => 'off']);
			} else {
				$this->commercial_model->insertPEbondecommandeCMTPE();
			}
		} else {
			if ($content[18] == "PP") {
				$this->commercial_model->insertPEbondecommandePP();
			} else if ($content[18] == "PE") {
				$this->commercial_model->insertPEbondecommandePE();
			} else {
				$this->commercial_model->insertPEbondecommandePE();
			}
		}

		if ($content[21] == "CMTI I") {

			if ($content[18] == "PP") {
				$dataCOm = $this->commercial_model->lastPEbondecommandeCMTPP();
				$BC_PE = "PP";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->ID_CMT + 1;
				} else {
					$BC_PE .= 1;
				}
			} else if ($content[18] == "PE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandeCMTPE();
				$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->CMT_ID + 1;
				} else {
					$BC_PE .= 1;
				}
			} else if ($content[18] == "HDPE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandeCMTPE();
				$BC_PE = "HDPE";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->CMT_ID + 1;
				} else {
					$BC_PE .= 1;
				}
			}
		} else {
			if ($content[18] == "PP") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePP();
				$BC_PE = "PP";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->PP_ID + 1;
				} else {
					$BC_PE .= 1;
				}
			} else if ($content[18] == "PE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePE();
				$BC_PE = "PE";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->ID + 1;
				} else {
					$BC_PE .= 1;
				}
			} else if ($content[18] == "HDPE") {
				$dataCOm = $this->commercial_model->lastPEbondecommandePE();
				$BC_PE = "HDPE";
				if ($dataCOm != "") {
					$BC_PE .= $dataCOm->ID + 1;
				} else {
					$BC_PE .= 1;
				}
			}
		}

		echo json_encode(array("messsage" => "true", "bc" => $BC_PE));
	}
	public function viewPrint()
	{
		return $this->load->view('global/bonDeCommande');
	}
	public function printFacture()
	{
		if (isset($_GET['po']) && !empty($_GET['po'])) {
			$BC_PO = $_GET['po'];
		} else {
			$BC_PO = $this->input->post('PO');
		}
		$data = $this->commercial_model->chercheBon(['BC_PE' => $BC_PO]);
		$html =  $this->load->view('global/bonDeCommande', ["data" => $data], true);
		//echo $html;
		$filename = "BON DE COMMANDE $data->BC_ID";
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}


	public function printcosting()
	{
		if (isset($_GET['po']) && !empty($_GET['po'])) {
			$BC_PO = $_GET['po'];
		} else {
			$BC_PO = $this->input->post('PO');
		}
		$data = $this->commercial_model->selectprixbon(['PB_PO' => $BC_PO]);
		$prix = $this->commercial_model->selectprixbon(['PB_PO' => $BC_PO]);
		$html =  $this->load->view('global/printCosting', ["data" => $data,"prix"=>$prix], true);
		//echo $html;
		$filename = "PRECOSTING : $data->PB_PO";
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}
	public function exportLivraison()
	{
		$this->load->model('planning_model');
		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}
		$donne = array();
		$datas = $this->planning_model->listedatedelivraison(['datedelivraison.DL_DATE' => $date]);
		foreach ($datas as $key => $datas) {
			if (array_key_exists($datas->BC_LIEULIVRE, $donne)) {
				$donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
			} else {
				$donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
			}
		}
		$html = "";
		$excel = "LIVRAISON DU : $date\n\n";
		foreach ($donne as $key => $donne) {
			$excel .= "$key\t\t\tQUANTITE\tPOIDS(KGS)\n";
			foreach ($donne as $valeur) {
				$excel .= "$valeur->BC_PE\t$valeur->BC_CODE\t$valeur->BC_DIMENSION\t$valeur->BC_QUNTITE\t$valeur->BC_POISENKGSAVECMARGE\n";
			}
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des livraison du : " . $date . ".xls");

		print $excel;
		exit;
	}
	public function saveCintre()
	{
		$this->load->model('commercial_model');
		$BC_DATE = $this->input->post('BC_DATE');
		$dt = new dateTime($BC_DATE);
		$BC_DATE =$dt->format('Y-m-d');
		// $this->input->post('BC_DATE');
		$BC_TYPEPO = $this->input->post('BC_TYPEPO');
		$BC_PE = $this->input->post('BC_PE');
		$BC_TYPEPRODUIT = $this->input->post('BC_TYPEPRODUIT');
		$BC_CLIENT = $this->input->post('BC_CLIENT');
		$BC_CODE = $this->input->post('BC_CODE');
		$BC_DATELIVRE = $this->input->post('BC_DATELIVRE');
		$dt = new dateTime($BC_DATELIVRE);
		$BC_DATELIVRE =$dt->format('Y-m-d');
		$BC_LIEU = $this->input->post('BC_LIEU');
		$BC_TYPE_PRODUIT = $this->input->post('BC_TYPE_PRODUIT');
		$BC_MODEL = $this->input->post('BC_MODEL');
		$BC_COULEUR = $this->input->post('BC_COULEUR');
		$BC_QUNTITE = $this->input->post('BC_QUNTITE');
		$BC_OBSERVATION = $this->input->post('BC_OBSERVATION');
		$BC_CON_PRIX = $this->input->post('BC_CON_PRIX');
		$data = [
			"BC_DATE" => $BC_DATE,
			"BC_PE" => $BC_PE,
			"BC_TYPEPRODUIT" => $BC_TYPEPRODUIT,
			"BC_CLIENT" => $BC_CLIENT,
			"BC_CODE" => $BC_CODE,
			"BC_DATELIVRE" => $BC_DATELIVRE,
			"BC_LIEULIVRE" => $BC_LIEU,
			"BC_MODEL" => $BC_MODEL,
			"BC_IMPRESSION" => $BC_COULEUR,
			"BC_QUNTITE" => $BC_QUNTITE,
			"BC_OBSERVATION" => $BC_OBSERVATION,
			"BC_PRIX" => $BC_CON_PRIX,
			"BC_COMMERCIAL" => $this->session->userdata('matricule'),
			"BC_STATUT" => "NON PLANNIFIE",
		];
		echo  json_encode($this->commercial_model->insertbondecommande($data));

		if ($BC_TYPEPO == "EPZ") {
			$this->commercial_model->insertCintreEPZ(["STATUT" => "off"]);
		} else {
			$this->commercial_model->insertCintreCMTI(["STATUT" => "off"]);
		}
	}

	public function numBonCintre()
	{
		$this->load->model('commercial_model');
		$type = $this->input->post('type');
		if ($type == "") {
			$type = "EPZ";
		}

		if ($type == "CMTI") {
			$dataCOm = $this->commercial_model->lastCintreCMTI();
			if ($dataCOm != "") {
				$BC_PE = $dataCOm->ID + 1;
			} else {
				$BC_PE = 1;
			}
		} else {
			$dataCOm = $this->commercial_model->lastCintreEPZ();
			if ($dataCOm != "") {
				$BC_PE = $dataCOm->ID + 1;
			} else {
				$BC_PE = 1;
			}
		}

		echo json_encode($BC_PE);
	}

	public function suivie()
	{
		$this->load->model('commercial_model');
		$data = array();
		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		$po = $this->input->get('po');
        $client = $this->input->get('client');
		if (!empty($po) ) {
			$datas = $this->commercial_model->bondecommandesTous(["BC_PE" => $po,"BC_COMMERCIAL"=>$this->session->userdata('matricule')]);
			
		}else if(!empty($client) ){
			$datas = $this->commercial_model->bondecommandesTous(["BC_CODE" => $client,"BC_COMMERCIAL"=>$this->session->userdata('matricule')]);
		} else if (!empty($debut) && !empty($fin)) {

			$datas = $this->commercial_model->bondecommandesTous("(BC_DATE BETWEEN '$debut' AND '$fin') AND BC_COMMERCIAL like '".$this->session->userdata('matricule')."'");
		} else {
			$date = date('Y-m');
			$datas = $this->commercial_model->bondecommandesTous("BC_DATE like  '$date%'  AND BC_COMMERCIAL like '".$this->session->userdata('matricule')."'");
		}

		foreach ($datas as $row) {
			$sub_array = array();

			$reponse = $this->commercial_model->selectrapportcommande(["RP_PO"=>$row->BC_PE]);
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_DATELIVRE;
			$dateLivre =  $this->commercial_model->listedate(['DL_PO'=>$row->BC_PE]);
			$ddL= "";
			$var =0;
			foreach ($dateLivre as $key => $dateLivre) {
				if($var==0){
					$ddL.=$dateLivre->DL_DATE;
					$var =1;
				}else{
					$ddL.="/".$dateLivre->DL_DATE;
				}
				
			}
			$sub_array[] = $ddL;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$livre = 0;
			$dataSortie = $this->magasiner_model->dataentre_produit_fini(["BC_ID" => $row->BC_PE, "EF_TYPE" => "sortie"]);

			if ($dataSortie) {
				foreach ($dataSortie as $key => $dataSortie) {
					$qtt =  $dataSortie->EF_QUANTITE;
					$livre = trim($qtt);
				}
			}
			$sub_array[] = $livre;
			$dateLivre = $this->commercial_model->dateLivraison(['DL_PO'=>$row->BC_PE]);
			$replivre = "";
			foreach($dateLivre  as $dateLivre){
                $replivre .=$dateLivre->DL_DATE." / ";
			}
			
			if($reponse){
				$sub_array[] = $reponse->Actual_Delivered_Date;
			}else{
				$sub_array[] ="";
			}
			if($reponse){
				$sub_array[] = $reponse->Delivered_qty;
			}else{
				$sub_array[] ="";
			}
			
			$sub_array[] ="";
			$sub_array[] = $row->BC_PRIX;
			$prix = explode(" ", $row->BC_PRIX);
			$prixs = 0;
			if (is_array($prix)) {
				$quatite = explode(" ", $row->BC_QUNTITE);
				if (is_array($quatite)) {
					$sub_array[] = trim((float)$prix[0]) * (float)$quatite[0];
					$prixs = trim((float)$prix[0]) ;
				} else {
					$sub_array[] = $prix[0] * $row->BC_QUNTITE;
					$prixs = $prix[0];
				}
			} else {
				$quatite = explode(" ", $row->BC_QUNTITE);
				if (is_array($quatite)) {
					$sub_array[] =  $row->BC_PRIX * $quatite[0];
					$prixs = $row->BC_PRIX;
				} else {
					$sub_array[] =  $row->BC_PRIX * $row->BC_QUNTITE;
				}
			}
			if($reponse){
				$sub_array[] = $reponse->Unit_Price_Euro;
				$sub_array[] = $reponse->Amount_Euro ;
				$sub_array[] = $reponse->Production_Lead_time;
				$sub_array[] = $reponse->Variance_Delivery ;
				$sub_array[] = $reponse->Varaince_Actual_Dlvry ;
				$sub_array[] = $reponse->Amount_Dlvd_USD;
				$sub_array[] =  $reponse->Delivered_qty*$prixs;
				$qtt = explode(" ", $row->BC_QUNTITE);
				$sub_array[] =  number_format((float)$qtt[0] - $reponse->Delivered_qty, 2, ',', ' ');
				$sub_array[] =$reponse->Bal_Amount_USD;
				$sub_array[] = number_format(((float)$qtt[0] - $reponse->Delivered_qty)*$prixs, 2, ',', ' ');
			}else{
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$qtt = explode(" ", $row->BC_QUNTITE);
			$sub_array[] = (float)$qtt[0];
			$sub_array[] = "";
			$sub_array[] = "";
		    }
			
			$sub_array[] =
				'<a href="#" id="' .$row->BC_PE. '"  class="edit_post btn btn-warning btn-sm"><i class="fa fa-edit"></i> Modifier</a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}



	public function suivieExport()
	{
		$this->load->model('commercial_model');
		$data = array();
		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		$po = $this->input->get('po');
        $client = $this->input->get('client');
		if (!empty($po) ) {
			$datas = $this->commercial_model->bondecommandesTous(["BC_PE" => $po,"BC_COMMERCIAL"=>$this->session->userdata('matricule')]);
			
		}else if(!empty($client) ){
			$datas = $this->commercial_model->bondecommandesTous(["BC_CODE" => $client,"BC_COMMERCIAL"=>$this->session->userdata('matricule')]);
		} else if (!empty($debut) && !empty($fin)) {

			$datas = $this->commercial_model->bondecommandesTous("(BC_DATE BETWEEN '$debut' AND '$fin') AND BC_COMMERCIAL like '".$this->session->userdata('matricule')."'");
		} else {
			$date = date('Y-m');
			$datas = $this->commercial_model->bondecommandesTous("BC_DATE like  '$date%'  AND BC_COMMERCIAL like '".$this->session->userdata('matricule')."'");
		}
		$excel = "\tREFERENCE CLIENT\tPO Date \tPlasmad PO No.\tSTATUS\tCustomer\tDimensions\tOrder Quantity\tRequired Delivery Date\tConfirmed Delivery Date\tDescription XIT\tDelivered qty\tActual Delivered Date\tDelivery Month\tCfmd Delivery Week\tUnit Price USD\tAmount USD\tUnit Price Euro\tAmount Euro\tProduction Lead-time (day)\tVariance Delivery (day)\tVaraince Actual Dlvry (day)\tAmount-Dlvd USD\tAmount-Dlvd EURO\tBalance to be Dlvd (Qty)\tBal Amount USD\tBal Amount Euro\n";

		foreach ($datas as $row) {
		

			$reponse = $this->commercial_model->selectrapportcommande(["RP_PO"=>$row->BC_PE]);
			$excel .="\t".$row->BC_CLIENT;
			$excel .="\t".$row->BC_DATE;
			$excel .="\t".$row->BC_PE;
			$excel .="\t".$row->BC_STATUT;
			$excel .="\t".$row->BC_CODE;
			$excel .="\t".$row->BC_DIMENSION;
			$excel .="\t".$row->BC_QUNTITE;
			$excel .="\t".$row->BC_DATELIVRE;
			$dateLivre =  $this->commercial_model->listedate(['DL_PO'=>$row->BC_PE]);
			$ddL= "";
			$var =0;
			foreach ($dateLivre as $key => $dateLivre) {
				if($var==0){
					$ddL.=$dateLivre->DL_DATE;
					$var =1;
				}else{
					$ddL.="/".$dateLivre->DL_DATE;
				}
				
			}
			$excel .="\t".$ddL;
			$excel .="\t".$row->BC_TYPEPRODUIT;
			$livre = 0;
			$dataSortie = $this->magasiner_model->dataentre_produit_fini(["BC_ID" => $row->BC_PE, "EF_TYPE" => "sortie"]);

			if ($dataSortie) {
				foreach ($dataSortie as $key => $dataSortie) {
					$qtt =  $dataSortie->EF_QUANTITE;
					$livre = trim($qtt);
				}
			}
			$excel .="\t".$livre;
			$dateLivre = $this->commercial_model->dateLivraison(['DL_PO'=>$row->BC_PE]);
			$replivre = "";
			foreach($dateLivre  as $dateLivre){
                $replivre .=$dateLivre->DL_DATE." / ";
			}
			
			if($reponse){
				$excel .="\t". $reponse->Actual_Delivered_Date;
			}else{
				$excel .="\t";
			}
			if($reponse){
				$excel .="\t". $reponse->Delivered_qty;
			}else{
				$excel .="\t";
			}
			
			$sub_array[] ="";
			$sub_array[] = $row->BC_PRIX;
			$prix = explode(" ", $row->BC_PRIX);
			$prixs = 0;
			if (is_array($prix)) {
				$quatite = explode(" ", $row->BC_QUNTITE);
				if (is_array($quatite)) {
					$excel .="\t". trim((float)$prix[0]) * (float)$quatite[0];
					$prixs = trim((float)$prix[0]) ;
				} else {
					$excel .="\t". $prix[0] * $row->BC_QUNTITE;
					$prixs = $prix[0];
				}
			} else {
				$quatite = explode(" ", $row->BC_QUNTITE);
				if (is_array($quatite)) {
					$excel .="\t".  $row->BC_PRIX * $quatite[0];
					$prixs = $row->BC_PRIX;
				} else {
					$excel .="\t". $row->BC_PRIX * $row->BC_QUNTITE;
				}
			}
			if($reponse){
				$excel .="\t". $reponse->Unit_Price_Euro;
				$excel .="\t". $reponse->Amount_Euro ;
				$excel .="\t". $reponse->Production_Lead_time;
				$excel .="\t". $reponse->Variance_Delivery ;
				$excel .="\t". $reponse->Varaince_Actual_Dlvry ;
				$excel .="\t". $reponse->Amount_Dlvd_USD;
				$excel .="\t". $reponse->Delivered_qty*$prixs;
				$qtt = explode(" ", $row->BC_QUNTITE);
				$excel .="\t".number_format((float)$qtt[0] - $reponse->Delivered_qty, 2, ',', ' ');
				$excel .="\t".$reponse->Bal_Amount_USD;
				$excel .="\t". number_format(((float)$qtt[0] - $reponse->Delivered_qty)*$prixs, 2, ',', ' ');
			}else{
			$excel .= "\t";
			$excel .= "\t";
			$excel .= "\t";
			$excel .= "\t";
			$excel .= "\t";
			$excel .= "\t";
			$excel .= "\t";
			$qtt = explode(" ", $row->BC_QUNTITE);
			$excel .="\t".(float)$qtt[0];
			$excel .= "\t";
			$excel .= "\t"; 
		    }
			
			$excel .="\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=suivi commande : " . date('d-m-Y') . ".xls");

		print $excel;
		exit;
	}
}
