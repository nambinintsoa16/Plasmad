<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Production extends My_Controller
{

	public function index()
	{


		$this->render_view('Production/Acceuil');
	}
	public function page()
	{


		$page = $this->input->post('page');

		switch ($page) {
			case 'PROCESSUS EN COURS':
				$this->load->view('Production/en_processuss');
				break;
			case 'PLANNING DU JOUR':
				$this->load->view('Production/planning_du_jour');
				break;
			case 'MES COMMANDES':
				$this->load->view('Planning/MesCommandes');
				break;
			case 'VERIFICATION MATIERES':
				$this->load->view('Production/verification');
				break;
			case 'CREE FICHE':
				$this->load->view('Production/fiche');
				break;
			case 'TERMINER':
				$this->load->view('Production/terminer');
				break;
			case 'QC':
				$this->load->view('Production/QC');
				break;
			case "STOCKS DISPONIBLES":
				$this->load->view('Production/stock');
				break;
			case "STOCKS MATIERES PREMIERES":
				$this->load->view('global/stockMatier');
				break;
			case 'COSTING':
				$this->load->view('comptabiliter/constingContent');
				break;
			case "MODIFIER MATIERES":
				$this->load->view('Production/modifMatier');
				break;
			case 'ENCRES ET SOLVANTS':
				$this->load->view('Production/modifEncreEtSolvant');
				break;
			default:
				$this->load->view('errors/html/error_404');
				break;
		}
	}

	public function dataPross()
	{
		$this->load->model('production_model');
		$page = $this->input->post('page');
		switch ($page) {
			case 'EXTRUSION':
				$this->load->view('Production/extrusiondata');
				break;
			case 'INJECTION':
				/*$data = [
					'injection' => $this->production_model->dataInjection('INJECTION'),
					'inpression' => $this->production_model->dataInjection('INPRESSION'),
					'hook' => $this->production_model->dataInjection('HOOK')
				];*/
				$this->load->view('Production/injectiondata');
				break;
		}
	}


	public function dataCoupe()
	{
		$this->load->model('production_model');
		$data = $this->production_model->somme_poinet($this->input->post('param'));
		echo json_encode(["somme" => $data->SOMME]);
	}

	public function saveQC()
	{
		$this->load->model('production_model');
		$this->load->model('magasiner_model');

		$data = [
			"C_DATE" => date("Y-m-d"),
			"C_QC" => $this->input->post('QC'),
			"C_ENTRE" => $this->input->post('QTT_ENTRE'),
			"C_PO" => $this->input->post('PO'),
			"C_TTS" => $this->input->post('CHOIX_DEUX'),
			"C_CHOIX" => $this->input->post('QTT_STIE'),
			"C_POID" => $this->input->post('C_POID')
		];
		return $this->production_model->saveQC($data);
	}
	public function mes_bonsDeCommande()
	{
		$this->load->model('production_model');
	}
	public function formulaire()
	{
		$type = $this->input->post('type');
		$this->load->view('Production/formulaireProduction');
	}
	public function detailPE()
	{
		$this->load->model('production_model');
		$pe = $this->input->post("pe");
		echo json_encode($this->production_model->bondecommandeDetail($pe));
	}
	public function formulaireProduction()
	{
		return $this->load->view('Production/formulaireProduction');
	}
	public function autocompleteOperateur()
	{
		$this->load->model('production_model');
		$resultat = array();
		$data = $this->production_model->autocompleteOperateur($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->OP_ID . "|" . $data->OP_NOM . " " . $data->OP_PRENOM;
		}
		echo json_encode($resultat);
	}
	public function autocompleteQC()
	{
		$this->load->model('production_model');
		$resultat = array();
		$data = $this->production_model->autocompleteOperateur($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->OP_NOM;
		}
		echo json_encode($resultat);
	}

	public function autocompletMa()
	{
		$this->load->model('production_model');
		$resultat = array();
		$data = $this->production_model->autocompletMa($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->MA_DESIGNATION;
		}
		echo json_encode($resultat);
	}
	public function autocompletMaChine()
	{
		$this->load->model('production_model');
		$mot = $this->input->get('term');
		$resultat = array();
		$data = $this->production_model->machine("MA_DESIGNATION like '%$mot%'");
		foreach ($data as $key => $data) {
			$resultat[] = $data->MA_DESIGNATION;
		}
		echo json_encode($resultat);
	}
	public function autocompleteMatier()
	{
		$this->load->model('production_model');
		$mot = $this->input->get('term');
		$resultat = array();
		$data = $this->production_model->selectStock_matier_premier("ST_DESIGNATION LIKE '%$mot%' LIMIT 10");
		foreach ($data as $key => $data) {
			$resultat[] = $data->ST_DESIGNATION . " | " . $data->ST_UNITE;
		}
		echo json_encode($resultat);
	}


	public function autocompleteOperateurs()
	{
		$this->load->model('production_model');
		$resultat = array();
		$data = $this->production_model->autocompleteOperateur($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->OP_NOM;
		}
		echo json_encode($resultat);
	}
	public function creeFiche()
	{
		$this->load->model('production_model');
		$lsatInset = $this->production_model->lsatInset();

		$donne = [
			'JO_ID' => $this->input->post("JBO"),
			'DC_QUART' => $this->input->post("QR"),
			'DC_CHEFEQUIPE' => $this->input->post("EQ"),
			'DC_OP' => $this->input->post("OP"),
			'BC_PE' => $this->input->post("PO"),
			'DC_FICHE' => 'FC-' . $this->input->post("JBO"),
			'DC_DATE' => $this->input->post('Dt'),
			'DC_PRO' => $this->input->post('DC_PRO'),
			'DC_STATUT' => 'on'
		];
		if ($this->production_model->insertFiche($donne)) {
			$data = array('message' => true);
		} else {
			$data = array('message' => false);
		}

		echo json_encode($data);
	}
	public function formulaires()
	{
		$param = $this->input->post('param');
		$this->load->model('production_model');

		switch ($param) {
			case 'extrusion':
				$machine = $this->production_model->machine(["MA_SPECIFIQUE" => "EXTRUSION"]);
				$operateur = $this->production_model->operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('formulaire/extrusion', $data);
				break;
			case 'injection':
				$machine = $this->production_model->machine(["MA_SPECIFIQUE" => "EXTRUSION"]);
				$operateur = $this->production_model->operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('formulaire/injection');
				break;
			case 'exinpression':
				$machine = $this->production_model->machine(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION"]);
				$operateur = $this->production_model->operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('formulaire/exinpression', $data);
				break;
			case 'excoupe':
				$machine = $this->production_model->machine(["MA_SPECIFIQUE" => "COUPE_EXTRUSION"]);
				$operateur = $this->production_model->operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('formulaire/excoupe', $data);
				break;
			default:
				echo false;
				break;
		}
	}
	public function saveINJECTION()
	{
		$this->load->model('production_model');
		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" => $this->input->post("IN_DURE"),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_TYPE" => "INJECTION"
		];
		echo json_encode($this->production_model->saveInjection($data));
	}
	public function saveexcoupe()
	{
		$this->load->model('production_model');
		$mettreTemp = explode("+", $this->input->post("ED_METRAGE"));
		$choix1Temp = explode("+", $this->input->post("ED_1ER_CHOIX"));
		$choix2Temp = explode("+", $this->input->post("ED_2E_CHOIX"));
		$gaineTemp = explode("+", $this->input->post("ED_GAINE_TIRE"));
		$mettrage = 0;
		$poid = 0;
		$dechets = 0;
		$choix1 = 0;
		$choix2 = 0;
		$gaine = 0;
		$poidEntre = 0;
		$dechet = explode("+", $this->input->post("EI_DECHET"));
		$poidTEmp = explode("+", $this->input->post("ED_POID_SORTIE"));
		$poidEntreTEmp = explode("+", $this->input->post("ED_POID_ENTRE"));
		foreach ($mettreTemp as $key => $mettreTemp) {
			$mettrage += $mettreTemp;
		}
		foreach ($poidTEmp as $key => $poidTEmp) {
			$poid += $poidTEmp;
		}
		foreach ($choix1Temp as $key => $choix1Temp) {
			$choix1 += $choix1Temp;
		}
		foreach ($choix2Temp as $key => $choix2Temp) {
			$choix2 += $choix2Temp;
		}
		foreach ($gaineTemp as $key => $gaineTemp) {
			$gaine += $gaineTemp;
		}
		foreach ($poidEntreTEmp as $key => $poidEntreTEmp) {
			$poidEntre += $poidEntreTEmp;
		}


		// $tempDure = explode("-",$this->input->post("ED_HEURE"));
		$heureF1 = $this->time_to_sec(date($this->input->post("EX_DEBUT") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("EX_FIN") . ":00"));



		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}

		$data = [
			"BC_ID" => $this->input->post("BC_ID"),
			"ED_DATE" => $this->input->post("ED_DATE"),
			"ED_RLX" => $this->input->post("ED_RLX"),
			"ED_METRAGE" => $this->input->post("ED_METRAGE"),
			"ED_METRAGE_SOMME" => $mettrage,
			"ED_POID_ENTRE" => $this->input->post("ED_POID_ENTRE"),
			"ED_PIOD_ENTRE_SOMME" => $poidEntre,
			"ED_POID_SORTIE_SOMME" => $poid,
			"ED_POID_SORTIE" => $this->input->post("ED_POID_SORTIE"),
			"ED_1ER_CHOIX" => $this->input->post("ED_1ER_CHOIX"),
			"ED_1ER_CHOIX_SOMME" => $choix1,
			"ED_2E_CHOIX" => $this->input->post("ED_2E_CHOIX"),
			"ED_2E_CHOIX_SOMME" => $choix2,
			"ED_DECHE_INPRESSION" => $this->input->post("ED_DECHE_INPRESSION"),
			"ED_DECHE_EXTRUSION" => $this->input->post("ED_DECHE_EXTRUSION"),
			"ED_DECHE_COUPE" => $this->input->post("ED_DECHE_COUPE"),
			"ED_EQUIPE" => $this->input->post("EI_EQUIPE"),
			"ED_OPERATEUR_1" => $this->input->post("ED_OPERATEUR_1"),
			"ED_OPERATEUR_2" => $this->input->post("ED_OPERATEUR_2"),
			"ED_OPERATEUR_3" => $this->input->post("ED_OPERATEUR_3"),
			"ED_RESTE_GAINE" => $this->input->post("ED_RESRT_GAINE"),
			"ED_QUART " => $this->input->post("ED_QUART"),
			"ED_GAINE_TIRE" => $this->input->post("ED_GAINE_TIRE"),
			"ED_GAINE_TIRE_SOMME" => $gaine,
			"ED_MACHINE" => $this->input->post("ED_MACHINE"),
			"ED_QC" => $this->input->post("ED_QC"),
			"ED_TAILL" => $this->input->post("ED_TAILL"),
			"ED_2E_POIDS" => $this->input->post("ED_2E_POIDS"),
			"ED_DURE" => $this->se_to_time($heureBe),
			"ED_HEURE" => $this->se_to_time($heureF1) . "-" . $this->se_to_time($heureF2),
			"ED_OBSERVATION" => $this->input->post("ED_OBSERVATION2"),
			"ED_OBSERVATION2" => $this->input->post("ED_OBSERVATION")
		];


		echo json_encode($this->production_model->saveexcoupe($data));
	}
	public function recherchePOVerifier()
	{

		$this->load->model('production_model');
		$data = [
			"VM_PO" => $this->input->post('param'),
		];

		$me = $this->production_model->matierVer($data);
		$machine = $this->production_model->listemach();
		$donne =  $this->production_model->cherchePEEXTRu($data);
		$lastData = $this->production_model->cherchePEEXVer(["EX_BC_ID" => $this->input->post('param'), "EX_EQUIP" => $this->input->post('goupe'), "EX_DATE" => $this->input->post('datePro')]);
		$this->load->view('Production/tableVerification', ["me" => $me, "last" => $lastData, "donne" => $donne, 'PO' => $this->input->post('param'), "equipe" => $this->input->post('goupe'), "machine" => $machine]);
	}
	public function saveverification()
	{
		$this->load->model('production_model');
		$data = [
			"VM_PO" => $this->input->post('VM_PO'),
			"VM_ME" => $this->input->post('VM_ME'),
			"VM_SUITE" => $this->input->post('VM_SUITE'),
			"VM_R1" => $this->input->post('VM_R1'),
			"VM_R2" => $this->input->post('VM_R2'),
			"EX_ID" => $this->input->post('EX_ID'),
			"VP_DATE" => $this->input->post('VP_DATE'),
			"VM_QRT" => $this->input->post('VM_QRT'),
			"VM_NMCH" => $this->input->post('VM_NMCH'),
			"VM_PDSNET" => $this->input->post('VM_PDSNET'),
			"VM_OBSERVATION" => $this->input->post('VM_OBSERVATION'),
			"VM_EQUIPE" => $this->input->post('VM_EQUIPE')
		];
		return  $this->production_model->saveverification($data);
	}
	public function recherchePE()
	{
		$data = [
			"EX_BC_ID" => $this->input->post('param')
		];
		$resultat = $this->production_model->cherchePEEX($data);
		$donne = "";
		foreach ($resultat as $key => $resultat) {
			$donne .= "<option>" . $resultat->EX_EQUIP . "</option>";
		}
		echo json_encode(array('result' => $donne));
		//EX_EQUIP,=>
	}
	public function saveexinpression()
	{
		$this->load->model('production_model');
		$mettreTemp = explode("+", $this->input->post("EI_METRAGE"));
		$mettrage = 0;
		$poid = 0;
		$dechets = 0;
		$dechet = explode("+", $this->input->post("EI_DECHET"));
		$poidTEmp = explode("+", $this->input->post("EI_POIDS"));
		foreach ($mettreTemp as $key => $mettreTemp) {
			$mettrage += $mettreTemp;
		}
		foreach ($poidTEmp as $key => $poidTEmp) {
			$poid += $poidTEmp;
		}

		foreach ($dechet as $key => $dechet) {
			$dechets += $dechet;
		}

		$EX_PDS_NET = $poid - $dechet;
		//$tempDure = explode("-",$this->input->post("EI_DUREE"));
		$heureF1 = $this->time_to_sec(date($this->input->post("EX_DEBUT") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("EX_FIN") . ":00"));

		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}

		$data = [
			"EI_DATE" => $this->input->post("EI_DATE"),
			"BC_ID" => $this->input->post("BC_ID"),
			"EI_METRAGE" => $this->input->post("EI_METRAGE"),
			"EI_POIDS" => $this->input->post("EI_POIDS"),
			"EI_POIDS_NET" => $EX_PDS_NET,
			"EI_DUREE" => $this->se_to_time($heureBe),
			"EI_HEURE" => $heureF1 . "-" . $heureF2,
			"EI_EQUIPE" => $this->input->post("EI_EQUIPE"),
			"EI_OPERATEUR1" => $this->input->post("EI_OPERATEUR1"),
			"EI_OPERATEUR2" => $this->input->post("EI_OPERATEUR2"),
			"EI_QUART" => $this->input->post("EI_QUART"),
			"EI_MACH" => $this->input->post("EI_MACH"),
			"EI_TAILLE" => $this->input->post("EI_TAILLE"),
			"EI_OBS" => $this->input->post("EI_OBS"),
			"EI_RLX" => $this->input->post("EI_RLX"),
			"EI_DECHET" => $dechets,
			"EI_PDS_SOMME" => $poid,
			"EI_DECHETS" => $this->input->post("EI_DECHET"),
			"EI_METRE_SOMME" => $mettrage,
			"EI_RESTE_GAINE" => $this->input->post("EI_RESTE_GAINE"),
		];

		echo json_encode($this->production_model->sausaveexinpressionve($data));
	}
	public function saveINPRESSION()
	{
		$this->load->model('production_model');

		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" => $this->input->post("IN_DURE"),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_TYPE" => "IMPRESSION"

		];
		echo json_encode($this->production_model->saveInjection($data));
	}

	public function saveHOOK()
	{
		$this->load->model('production_model');
		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" => $this->input->post("IN_DURE"),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_TYPE" => "HOOK"
		];
		echo json_encode($this->production_model->saveInjection($data));
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

	public function saveextrusion()
	{
		$this->load->model('production_model');
		$mettreTemp = explode("+", $this->input->post("EX_METRE"));
		$mettrage = 0;
		$poid = 0;
		$dechet = $this->input->post("EX_DECHETS");
		$poidTEmp = explode("+", $this->input->post("EX_PDS_BRUT"));
		foreach ($mettreTemp as $key => $mettreTemp) {
			$mettrage += $mettreTemp;
		}
		foreach ($poidTEmp as $key => $poidTEmp) {
			$poid += $poidTEmp;
		}
		$EX_PDS_NET =  $dechet + $poid;
		// $tempDure = explode("-",$this->input->post("EX_DUREE"));
		$heureF1 = $this->time_to_sec(date($this->input->post("EX_DEBUT") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("EX_FIN") . ":00"));
		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}


		$data = [
			"EX_DATE" => $this->input->post("EX_DATE"),
			"EX_BC_ID" => $this->input->post("EX_BC_ID"),
			"EX_METRE" => $this->input->post("EX_METRE"),
			"EX_METRE_SOMME" => $mettrage,
			"EX_PDS_BRUT" => $this->input->post("EX_PDS_BRUT"),
			"EX_PDS_SOMME" => $poid,
			"EX_DECHETS" => $this->input->post("EX_DECHETS"),
			"EX_PDS_NET" => $EX_PDS_NET,
			"EX_DUREE" => $this->se_to_time($heureBe),
			"EX_HEURE " => $heureF1 . " - " . $heureF2,
			"EX_QAURT" => $this->input->post("EX_QAURT"),
			"EX_N_MACH" => $this->input->post("EX_N_MACH"),
			"EX_RLL" => $this->input->post("EX_Nbre_rlx"),
			"EX_TAILL" => $this->input->post("EX_TAILL"),
			"EX_EQUIP" => $this->input->post("EX_EQUIP"),
			"EX_OPERETEUR_1" => $this->input->post("EX_OPERETEUR_1"),
			"EX_OPERETEUR_2" => $this->input->post("EX_OPERETEUR_2"),
			"EX_OBSERVATION1" => $this->input->post("EX_OBS"),


		];

		/*$datas = [
			"VM_PO"=>$this->input->post("EX_BC_ID"),
			"VP_DATE"=>$this->input->post("EX_DATE"),
			"VM_QRT"=>$this->input->post("EX_QAURT"),
			"VM_NMCH"=>$this->input->post("EX_N_MACH"),
			"VM_PDSNET"=>$this->input->post("EX_PDS_NET"),
			"VM_EQUIPE"=>$this->input->post("EX_EQUIP"),
		];
		$this->production_model->insertVerfication($datas);*/


		$prod = $this->production_model->chercheCommande($this->input->post("EX_BC_ID"));
		if ($prod->BC_TYPE == 'Direct rolls PE plain') {
			$this->saveEntre($EX_PDS_NET, $this->input->post("EX_TAILL"), $this->input->post("EX_DATE"), 0, $this->input->post("EX_BC_ID"), "");
		}

		echo json_encode($this->production_model->saveextrusion($data));
	}

	public function saveEntre($entre, $taill, $date, $deux, $PO, $OBSE)
	{
		$this->load->model('Magasiner_model');
		$detalPo = $this->magasiner_model->bondecommande(["BC_PE" => $PO]);
		$data = [
			"EF_QUANTITE" => $entre,
			"EF_DATE" => $date,
			"EF_QUANTITE_CHOIX" => $deux,
			"EF_MAGASIN" => $this->session->userdata('matricule'),
			"EF_TYPE" => "entre",
			"BC_ID" => $PO,
			"STF_OBSE" => $OBSE,
			"EF_REMARQUE" => "vide",
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

	public function autocompletPo()
	{
		$this->load->model('production_model');
		$data = $this->production_model->autocompletePo($this->input->get('term'));
		$reponse = array();
		foreach ($data as $key => $data) {
			$reponse[] = $data->BC_PE;
		}
		echo json_encode($reponse);
	}
	public function tableEX()
	{
		$this->load->model('production_model');

		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}

		if (!empty($_GET['po']) ) {
			$datas = $this->production_model->tableEX(['EX_BC_ID' => $_GET['po']]);
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])  and  !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEX("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND EX_N_MACH like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEX("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] . "' AND EX_N_MACH like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEX("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->tableEX("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "')");
		} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine'], "EX_EQUIP" => $_GET['operateurs'], "EX_QAURT" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date, "EX_EQUIP" => $_GET['operateurs'], "EX_QAURT" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine'], "EX_QAURT" => $_GET['operateurs']]);
		} else {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date]);
		}

		$data = array();
		foreach ($datas as $row) {
			$nreoul = explode("+", $row->EX_RLL);
			$sub_array = array();
			$sub_array[] = $row->EX_DATE;
			$sub_array[] = $row->EX_BC_ID;
			$sub_array[] = $row->EX_METRE_SOMME;
			$sub_array[] = $row->EX_PDS_SOMME;
			$sub_array[] = $row->EX_DECHETS;
			$sub_array[] = $row->EX_PDS_NET;
			$sub_array[] = $row->EX_DUREE;
			$sub_array[] = $row->EX_QAURT;
			$sub_array[] = $row->EX_N_MACH;
			$sub_array[] = $row->EX_RLL;
			$sub_array[] = count($nreoul);
			$sub_array[] = $row->EX_TAILL;
			$sub_array[] = $row->EX_EQUIP;
			$sub_array[] = $row->EX_OPERETEUR_1;
			$sub_array[] = $row->EX_OPERETEUR_2;
			$sub_array[] = $row->EX_OBSERVATION1;
			$sub_array[] = "<a href='#' id='$row->EX_ID' class='btn btn-warning btn-sm editExtrusion'><i class='fa fa-edit'></i></a>";
			$sub_array[] = "<a href='#' id='$row->EX_ID' class='btn btn-danger btn-sm deleteExtrusion'><i class='fa fa-trash'></i></a>";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function tableEXRow()
	{
		$id = $this->input->post('id');
		$this->load->model('production_model');
		$data  = $this->production_model->tableEXRow(["EX_ID" => $id]);
		$reponse = array();

		$reponse["EX_DATE"] =  $data->EX_DATE;
		$reponse["EX_ID"] =  $data->EX_ID;
		$reponse["EX_METRE"] =  $data->EX_METRE;
		$reponse["EX_PDS_BRUT"] =  $data->EX_PDS_BRUT;
		$reponse["EX_DECHETS"] =  $data->EX_DECHETS;
		$heure = explode("-", $data->EX_HEURE);
		$reponse["EX_HEURE"] =  $this->se_to_time((int) $heure[0]) . "-" . $this->se_to_time((int) $heure[1]);
		$reponse["EX_QAURT"] =  $data->EX_QAURT;
		$reponse["EX_N_MACH"] =  $data->EX_N_MACH;
		$reponse["EX_Nbre_rlx"] =  $data->EX_Nbre_rlx;
		$reponse["EX_TAILL"] =  $data->EX_TAILL;
		$reponse["EX_EQUIP"] =  $data->EX_EQUIP;
		$reponse["EX_OPERETEUR_1"] =  $data->EX_OPERETEUR_1;
		$reponse["EX_OPERETEUR_2"] =  $data->EX_OPERETEUR_2;
		$reponse["EX_OBSERVATION1"] =  $data->EX_OBSERVATION1;


		echo json_encode($reponse);
	}

	public function tableImprime()
	{
		$id = $this->input->post('id');
		$this->load->model('production_model');
		$row  = $this->production_model->tableImprimeRow(["EI_ID" => $id]);
		$reponse = array();
		$reponse["EI_DATE"] = $row->EI_DATE;
		$reponse["BC_PE"] = $row->BC_ID;
		$reponse["EI_METRE_SOMME"] = $row->EI_METRE_SOMME;
		$reponse["EI_PDS_SOMME"] = $row->EI_PDS_SOMME;
		$reponse["EI_DECHET"] = $row->EI_DECHET;
		$reponse["EI_POIDS_NET"] = $row->EI_POIDS_NET;
		$reponse["EI_DUREE"] = $row->EI_DUREE;
		$reponse["EI_EQUIPE"] = $row->EI_EQUIPE;
		$reponse["EI_OPERATEUR1"] = $row->EI_OPERATEUR1;
		$reponse["EI_OPERATEUR2"] = $row->EI_OPERATEUR2;
		$reponse["EI_QUART"] = $row->EI_QUART;
		$reponse["EI_MACH"] = $row->EI_MACH;
		$reponse["EI_TAILLE"] = $row->EI_TAILLE;
		$reponse["EI_RESTE_GAINE"] = $row->EI_RESTE_GAINE;
		$reponse["EI_RLX"] = $row->EI_RLX;
		$reponse["EI_OBSERVATION"] = $row->EI_OBSERVATION;
		$reponse["MATIER"] = $this->production_model->matierUtiliser(["MI_PO" => $row->BC_ID]);
		echo json_encode($reponse);
	}
	public function tableIPreRow()
	{
		$id = $this->input->post('id');
		$this->load->model('production_model');
		$data  = ["data" => $this->production_model->tableIPreRow(["EI_ID" => $id])];
		echo json_encode($data);
	}
	public function tableEcooupeRow()
	{
		$id = $this->input->post('id');
		$this->load->model('production_model');
		$data  = ["data" => $this->production_model->tableEcooupeRow(["ED_ID" => $id])];
		echo json_encode($data);
	}
	public function extrusioninpression()
	{
		$this->load->model('production_model');
		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
        
		if (!empty($_GET['po']) ) {
			$datas = $this->production_model->tableIPre(['extrusion_inpression.BC_ID' => $_GET['po']]);
		}else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->tableIPre("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND EI_MACH like '" . $_GET['machine'] . "')");
		}else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->tableIPre("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs'] . "' AND EI_MACH like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableIPre("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->tableIPre("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "')");
		} else if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {

			$datas = $this->production_model->tableIPre(["EI_DATE" => $date, "EI_EQUIPE" => $_GET['machine'], "EI_MACH" => $_GET['machine']]);
		} else if (!empty($_GET['operateurs'])) {

			$datas = $this->production_model->tableIPre(["EI_DATE" => $date, "EI_EQUIPE" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->tableIPre(["EI_DATE" => $date, "EI_MACH" => $_GET['machine']]);
		} else {
			$datas = $this->production_model->tableIPre(["EI_DATE" => $date]);
		}

		$data = array();
		foreach ($datas as $row) {
			$nbop = 0;

			$sub_array = array();
			$sub_array[] = $row->EI_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->EI_METRE_SOMME;
			$sub_array[] = $row->EI_PDS_SOMME;
			$sub_array[] = $row->EI_DECHET;
			$sub_array[] = $row->EI_POIDS_NET;
			$sub_array[] = $row->EI_DUREE;
			$sub_array[] = $row->EI_EQUIPE;
			$sub_array[] = $row->EI_OPERATEUR1;
			$sub_array[] = $row->EI_OPERATEUR2;
			$sub_array[] = $row->EI_QUART;
			$sub_array[] = $row->EI_MACH;
			$sub_array[] = $row->EI_TAILLE;
			$sub_array[] = $row->EI_RESTE_GAINE;
			$sub_array[] = $row->EI_RLX;
			$sub_array[] = $row->EI_OBSERVATION;
			$sub_array[] = "<a href='#' id='$row->EI_ID' class='btn btn-warning btn-sm editExImprim'><i class='fa fa-edit'></i></a>";
			$sub_array[] = "<a href='#' id='$row->BC_PE' class='btn btn-secondary btn-sm editMatier'><i class='fa fa-edit'></i></a>";
			$sub_array[] = "<a href='#' id='$row->EI_ID' class='btn btn-danger btn-sm deleteImprim'><i class='fa fa-trash'></i></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	public function exdecoupe()
	{
		$this->load->model('production_model');
		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		if (!empty($_GET['po']) ) {
			$datas = $this->production_model->tableEcooupe(['extrusion_coupe.BC_ID' => $_GET['po']]);
		}else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEcooupe("ED_DATE BETWEEN '".$_GET['debut']."' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "' AND ED_MACHINE like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEcooupe("ED_DATE BETWEEN '".$_GET['debut']."' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->tableEcooupe("ED_DATE BETWEEN '".$_GET['debut']."' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "')");
		} else if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine'], "ED_EQUIPE" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date, "ED_EQUIPE" => $_GET['operateurs']]);
		} else  if (!empty($_GET['machine'])) {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine']]);
		} else {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date]);
		}
		$data = array();
		foreach ($datas as $row) {
			$nreoul = explode(",", $row->ED_RLX);

			$sub_array = array();
			$sub_array[] = $row->ED_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->ED_RLX;
			$sub_array[] = $row->ED_DURE;
			$sub_array[] = $row->ED_METRAGE_SOMME;
			$sub_array[] = $row->ED_POID_ENTRE;
			$sub_array[] = $row->ED_1ER_CHOIX_SOMME;
			$sub_array[] = $row->ED_POID_SORTIE_SOMME;
			$sub_array[] = $row->ED_2E_CHOIX_SOMME;
			$sub_array[] = $row->ED_DECHE_INPRESSION + $row->ED_DECHE_EXTRUSION + $row->ED_DECHE_COUPE;
			$sub_array[] = $row->ED_GAINE_TIRE_SOMME;
			$sub_array[] = $row->ED_EQUIPE;
			$sub_array[] = $row->ED_OPERATEUR_1;
			$sub_array[] = $row->ED_OPERATEUR_2;
			$sub_array[] = $row->ED_OPERATEUR_3;
			$sub_array[] = $row->ED_QC;
			$sub_array[] = $row->ED_TAILL;
			$sub_array[] = $row->ED_QUART;
			$sub_array[] = $row->ED_MACHINE;
			$sub_array[] = $row->ED_RESTE_GAINE;
			$sub_array[] = $row->ED_OBSERVATION;
			$sub_array[] = $row->ED_OBSERVATION2;
			$sub_array[] = "<a href='#' id='$row->ED_ID' class='btn btn-warning btn-sm editcoupe'><i class='fa fa-edit'></i></a>";
			$sub_array[] = "<a href='#' id='$row->ED_ID' class='btn btn-danger btn-sm deletecoupe'><i class='fa fa-trash'></i></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function tableIN()
	{
		$this->load->model('production_model');
		$datas = $this->production_model->tableIN();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->DC_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->DC_CHEFEQUIPE;
			$sub_array[] = $row->DC_OP;
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = $row->DC_QUART;
			$sub_array[] = "";
			$sub_array[] = "";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function dataExtrusion()
	{
		$this->load->model('production_model');
		$datas = $this->production_model->tableEX();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_MACHINE;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_TYPE;
			$sub_array[] = $row->BC_TYPEMATIER;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_PERFORATION;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_REASSORT;
			$sub_array[] = $row->BC_RABAT;
			$sub_array[] = $row->BC_PERFORATION;
			$sub_array[] = $row->BC_CYLINDRE;
			$sub_array[] = $row->BC_OBSERVATION;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}



	public function TableTerminer()
	{
		$this->load->model('production_model');
		$datas = $this->production_model->bonTerminer();
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->JO_ID;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_MACHINE;
			$sub_array[] = $row->BC_STATUT;
			$sub_array[] = $row->BC_TYPE;
			$sub_array[] = $row->BC_TYPEMATIER;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_PERFORATION;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_REASSORT;
			$sub_array[] = $row->BC_RABAT;
			$sub_array[] = $row->BC_PERFORATION;
			$sub_array[] = $row->BC_CYLINDRE;
			$sub_array[] = $row->BC_OBSERVATION;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function TableProduction()
	{
		$this->load->model('production_model');
		$datas = $this->production_model->bonPlanifier();
		$data = array();
		foreach ($datas as $row) {
			if ($this->production_model->testJobCard($row->BC_PE)) {
				$sub_array = array();
				$sub_array[] = $row->BC_DATE;
				$sub_array[] = $row->BC_PE;
				$sub_array[] = $row->JO_ID;
				$sub_array[] = $row->BC_TYPEPRODUIT;
				$sub_array[] = $row->BC_MACHINE;
				$sub_array[] = $row->BC_STATUT;
				$sub_array[] = $row->BC_TYPE;
				$sub_array[] = $row->BC_TYPEMATIER;
				$sub_array[] = $row->BC_DIMENSION;
				$sub_array[] = $row->BC_PERFORATION;
				$sub_array[] = $row->BC_QUNTITE;
				$sub_array[] = $row->BC_REASSORT;
				$sub_array[] = $row->BC_RABAT;
				$sub_array[] = $row->BC_PERFORATION;
				$sub_array[] = $row->BC_CYLINDRE;
				$sub_array[] = $row->BC_OBSERVATION;
				$data[] = $sub_array;
			}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function update_extrusion()
	{
		$this->load->model('Magasiner_model');
		$data = scandir(FCPATH . 'uploads/excel/Production');
		$uploads_dir = FCPATH . 'uploads/excel/Production';
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
	public function saveEncre()
	{
		$this->load->model('production_model');
		$reference = $this->input->post('reference');
		$quantite = $this->input->post('quantite');
		$po = $this->input->post('po');
		$prix = $this->input->post('prix');
		$date = $this->input->post('date');
		if ($date == "") {
			$date = date('Y-m-d');
		}
		$data = [
			"MI_DESIGNATION" => $reference,
			"MI_PO" => $po,
			"MI_QUANTITE" => $quantite,
			"MI_DATE" => $date,
			"MI_PRIX" => $prix
		];
		$bon = $this->magasiner_model->bondecommande(["BC_PE" => $po]);
			$parametre = [
				"MS_REFERENCE" => $po,
				"MS_DATE" => date('Y-m-d'),
				"MS_MATIER" => $reference,
				"MS_MAGASINIER" => $this->session->userdata("matricule"),
				"MS_ORIGIN" =>  $bon->BC_ORIGINE."_MAGASIN"
			];	
			if ($this->magasiner_model->insertsortie_materiel($parametre)) {		
				$lastId = $this->magasiner_model->lsatInsetSortie();
				$requette = [
					"LI_MATIER" => $reference,
					"LI_QUANTITE" => $quantite,
					"LI_TYPE" => "sortie",
					"LI_SORTIE" => $lastId->MS_ID,
					"LI_VALEUR" => $prix,
					"LI_REFERENCE" => $po,
					"LI_ORIGIN" => $bon->BC_ORIGINE."_MAGASIN"
				];
				if ($this->magasiner_model->insertstock_materiel($requette)) {
					$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $reference, "ST_ORIGIN" => $bon->BC_ORIGINE."_MAGASIN"]);
					$quantites = $id->ST_QUANTITE - $quantite;
					$this->magasiner_model->updatestock_matier_premier(["ST_DESIGNATION" => $reference, "ST_ORIGIN" => $bon->BC_ORIGINE."_MAGASIN"], ["ST_QUANTITE" => $quantites]);
				}
		        $this->production_model->insertmatierinression($data);
			}	
	}

	public function saveupdateextrusion()
	{
		$this->load->model('production_model');
		$mettreTemp = explode("+", $this->input->post("EX_METRE"));
		$mettrage = 0;
		$poid = 0;
		$dechet = $this->input->post("EX_DECHETS");
		$poidTEmp = explode("+", $this->input->post("EX_PDS_BRUT"));
		foreach ($mettreTemp as $key => $mettreTemp) {
			$mettrage += $mettreTemp;
		}
		foreach ($poidTEmp as $key => $poidTEmp) {
			$poid += $poidTEmp;
		}
		$EX_PDS_NET =  $dechet + $poid;
		// $tempDure = explode("-",$this->input->post("EX_DUREE"));

		$heureF1 = $this->time_to_sec(date($this->input->post("EX_DEBUT") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("EX_FIN") . ":00"));
		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}



		$data = [
			"EX_DATE" => $this->input->post("EX_DATE"),
			"EX_METRE" => $this->input->post("EX_METRE"),
			"EX_METRE_SOMME" => $mettrage,
			"EX_PDS_BRUT" => $this->input->post("EX_PDS_BRUT"),
			"EX_PDS_SOMME" => $poid,
			"EX_DECHETS" => $this->input->post("EX_DECHETS"),
			"EX_PDS_NET" => $EX_PDS_NET,
			"EX_DUREE" => $this->se_to_time($heureBe),
			"EX_HEURE " => $heureF1 . " - " . $heureF2,
			"EX_QAURT" => $this->input->post("EX_QAURT"),
			"EX_N_MACH" => $this->input->post("EX_N_MACH"),
			"EX_RLL" => $this->input->post("EX_Nbre_rlx"),
			"EX_TAILL" => $this->input->post("EX_TAILL"),
			"EX_EQUIP" => $this->input->post("EX_EQUIP"),
			"EX_OPERETEUR_1" => $this->input->post("EX_OPERETEUR_1"),
			"EX_OPERETEUR_2" => $this->input->post("EX_OPERETEUR_2"),
			"EX_OBSERVATION1" => $this->input->post("EX_OBS"),


		];

		/*$datas = [
	 "VM_PO"=>$this->input->post("EX_BC_ID"),
	 "VP_DATE"=>$this->input->post("EX_DATE"),
	 "VM_QRT"=>$this->input->post("EX_QAURT"),
	 "VM_NMCH"=>$this->input->post("EX_N_MACH"),
	 "VM_PDSNET"=>$this->input->post("EX_PDS_NET"),
	 "VM_EQUIPE"=>$this->input->post("EX_EQUIP"),
 ];
 $this->production_model->insertVerfication($datas);*/
		echo json_encode($this->production_model->updateextrusion(["EX_ID" => $this->input->post("EX_BC_ID")], $data));
	}


	public function deleteExtrusion()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		return $this->production_model->deleteExtrusion(["EX_ID" => $id]);
	}
	public function deleteImprime()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		return $this->production_model->deleteImprime(["EI_ID" => $id]);
	}
	public function deleteEcooupe()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		return $this->production_model->deleteEcooupe(["ED_ID" => $id]);
	}

	public function deleteMatierUtiliser()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		return $this->production_model->deleteMatierUtiliser(["MI_ID" => $id]);
	}
	public function editImprimer()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		$machine = $this->production_model->machine(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION"]);
		$imp  = $this->production_model->tableImprimeRow(["EI_ID" => $id]);
		$data = [
			"data" => $imp,
			"MACHINE" => $machine
		];
		echo json_encode($this->load->view('formulaire/modiPrint', $data, true));
	}

	public function editCoupeEx()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		$machine = $this->production_model->machine(["MA_SPECIFIQUE" => "COUPE_EXTRUSION"]);
		$coupe  = $this->production_model->tableEcoupeRow(["ED_ID" => $id]);
		$data = [
			"data" => $coupe,
			"MACHINE" => $machine
		];
		echo json_encode($this->load->view('formulaire/modifCoup', $data, true));
	}


	public function saveupdateexinpression()
	{
		$this->load->model('production_model');
		$mettreTemp = explode("+", $this->input->post("EI_METRAGE"));
		$mettrage = 0;
		$poid = 0;
		$dechets = 0;
		$dechet = explode("+", $this->input->post("EI_DECHET"));
		$poidTEmp = explode("+", $this->input->post("EI_POIDS"));
		foreach ($mettreTemp as $key => $mettreTemp) {
			$mettrage += $mettreTemp;
		}
		foreach ($poidTEmp as $key => $poidTEmp) {
			$poid += $poidTEmp;
		}

		foreach ($dechet as $key => $dechet) {
			$dechets += $dechet;
		}

		$EX_PDS_NET = $poid - $dechet;
		//$tempDure = explode("-",$this->input->post("EI_DUREE"));
		$heureF1 = $this->time_to_sec(date($this->input->post("EX_DEBUT") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("EX_FIN") . ":00"));

		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}

		$data = [
			"EI_DATE" => $this->input->post("EI_DATE"),
			"EI_METRAGE" => $this->input->post("EI_METRAGE"),
			"EI_POIDS" => $this->input->post("EI_POIDS"),
			"EI_POIDS_NET" => $EX_PDS_NET,
			"EI_DUREE" => $this->se_to_time($heureBe),
			"EI_HEURE" => $heureF1 . "-" . $heureF2,
			"EI_EQUIPE" => $this->input->post("EI_EQUIPE"),
			"EI_OPERATEUR1" => $this->input->post("EI_OPERATEUR1"),
			"EI_OPERATEUR2" => $this->input->post("EI_OPERATEUR2"),
			"EI_QUART" => $this->input->post("EI_QUART"),
			"EI_MACH" => $this->input->post("EI_MACH"),
			"EI_TAILLE" => $this->input->post("EI_TAILLE"),
			"EI_OBS" => $this->input->post("EI_OBS"),
			"EI_RLX" => $this->input->post("EI_RLX"),
			"EI_DECHET" => $dechets,
			"EI_PDS_SOMME" => $poid,
			"EI_DECHETS" => $this->input->post("EI_DECHET"),
			"EI_METRE_SOMME" => $mettrage,
			"EI_RESTE_GAINE" => $this->input->post("EI_RESTE_GAINE"),
		];



		echo json_encode($this->production_model->updateImpression(["EI_ID" => $this->input->post("BC_ID")], $data));
	}



	public function saveupdateexcoupe()
	{
		$this->load->model('production_model');
		$mettreTemp = explode("+", $this->input->post("ED_METRAGE"));
		$choix1Temp = explode("+", $this->input->post("ED_1ER_CHOIX"));
		$choix2Temp = explode("+", $this->input->post("ED_2E_CHOIX"));
		$gaineTemp = explode("+", $this->input->post("ED_GAINE_TIRE"));
		$mettrage = 0;
		$poid = 0;
		$dechets = 0;
		$choix1 = 0;
		$choix2 = 0;
		$gaine = 0;
		$dechet = explode("+", $this->input->post("EI_DECHET"));
		$poidTEmp = explode("+", $this->input->post("ED_POID_ENTRE"));
		foreach ($mettreTemp as $key => $mettreTemp) {
			$mettrage += $mettreTemp;
		}
		foreach ($poidTEmp as $key => $poidTEmp) {
			$poid += $poidTEmp;
		}
		foreach ($choix1Temp as $key => $choix1Temp) {
			$choix1 += $choix1Temp;
		}
		foreach ($choix2Temp as $key => $choix2Temp) {
			$choix2 += $choix2Temp;
		}
		foreach ($gaineTemp as $key => $gaineTemp) {
			$gaine += $gaineTemp;
		}


		// $tempDure = explode("-",$this->input->post("ED_HEURE"));
		$heureF1 = $this->time_to_sec(date($this->input->post("EX_DEBUT") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("EX_FIN") . ":00"));



		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}

		$data = [
			"ED_DATE" => $this->input->post("ED_DATE"),
			"ED_RLX" => $this->input->post("ED_RLX"),
			"ED_METRAGE" => $this->input->post("ED_METRAGE"),
			"ED_METRAGE_SOMME" => $mettrage,
			"ED_POID_ENTRE" => $this->input->post("ED_POID_ENTRE"),
			"ED_POID_SORTIE_SOMME" => $poid,
			"ED_1ER_CHOIX" => $this->input->post("ED_1ER_CHOIX"),
			"ED_1ER_CHOIX_SOMME" => $choix1,
			"ED_2E_CHOIX" => $this->input->post("ED_2E_CHOIX"),
			"ED_2E_CHOIX_SOMME" => $choix2,
			"ED_DECHE_INPRESSION" => $this->input->post("ED_DECHE_INPRESSION"),
			"ED_DECHE_EXTRUSION" => $this->input->post("ED_DECHE_EXTRUSION"),
			"ED_DECHE_COUPE" => $this->input->post("ED_DECHE_COUPE"),
			"ED_EQUIPE" => $this->input->post("EI_EQUIPE"),
			"ED_OPERATEUR_1" => $this->input->post("ED_OPERATEUR_1"),
			"ED_OPERATEUR_2" => $this->input->post("ED_OPERATEUR_2"),
			"ED_OPERATEUR_3" => $this->input->post("ED_OPERATEUR_3"),
			"ED_RESTE_GAINE" => $this->input->post("ED_RESRT_GAINE"),
			"ED_QUART " => $this->input->post("ED_QUART"),
			"ED_GAINE_TIRE" => $this->input->post("ED_GAINE_TIRE"),
			"ED_GAINE_TIRE_SOMME" => $gaine,
			"ED_MACHINE" => $this->input->post("ED_MACHINE"),
			"ED_QC" => $this->input->post("ED_QC"),
			"ED_TAILL" => $this->input->post("ED_TAILL"),
			"ED_2E_POIDS" => $this->input->post("ED_2E_POIDS"),
			"ED_DURE" => $this->se_to_time($heureBe),
			"ED_HEURE" => $this->se_to_time($heureF1) . "-" . $this->se_to_time($heureF2),
			"ED_OBSERVATION" => $this->input->post("ED_OBSERVATION2"),
			"ED_OBSERVATION2" => $this->input->post("ED_OBSERVATION")
		];

		echo json_encode($this->production_model->updatetableEcoupe(["ED_ID" => $this->input->post("BC_ID")], $data));
	}
	public function control()
	{
		$this->load->model('production_model');
		$html = "";
		$date = $this->input->post('date');
		if ($date != "") {
			$data = $this->production_model->control(['C_DATE' => $date]);
		} else {
			$data = $this->production_model->control(['C_PO' => $this->input->post('PO')]);
		}
		foreach ($data as $data) {
			$html .= "<tr><td>" . $data->C_DATE . "</td><td>" . $data->C_QC . "</td><td>" . $data->C_PO . "</td><td>" . $data->C_POID . "</td><td>" . $data->C_ENTRE . "</td><td>" . $data->C_TTS . "</td><td>" . $data->C_CHOIX . "</td><td><a href='" . $data->C_ID . "' class='btn btn-danger btn-sm delete'><i class='fa fa-trash'></i></a></td></tr>";
		}

		echo json_encode($html);
	}
	public function  matierinression()
	{
		$this->load->model('production_model');
		$html = "";
		$data = $this->production_model->matierinression(['MI_PO' => $this->input->post('PO')]);
		foreach ($data as $data) {
			$html .= "<tr><td>$data->MI_ID</td><td>$data->MI_DATE</td><td>$data->MI_PO</td><td>$data->MI_DESIGNATION</td><td>$data->MI_QUANTITE</td><td>$data->MI_PRIX</td><td><a href='#' class='btn btn-warning btn-sm edit' id='$data->MI_ID'><i class='fa fa-edit'></i></a> <a href='#' class='btn btn-danger btn-sm delete' id='$data->MI_ID'><i class='fa fa-trash'></i></a></td></tr>";
		}

		echo json_encode($html);
	}
	public function deleteMatier()
	{
		$this->load->model('production_model');
		$id =  $this->input->post('id');
		return $this->production_model->deleteMatier(['MI_ID' => $this->input->post('id')]);
	}
	public function updateMatier()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		$data = [
			"MI_DESIGNATION" => $this->input->post('MI_DESIGNATION'),
			"MI_QUANTITE" => $this->input->post('MI_QUANTITE'),
			"MI_PRIX" => $this->input->post('MI_PRIX')
		];
		return $this->production_model->updateMatier(["MI_ID" => $id], $data);
	}
	public function coupeQc()
	{
		$po = $this->input->post('PO');
		$data = $this->production_model->tableEcoupeRows(["BC_ID" => $po]);
		$result = 0;
		$dataControl = $this->production_model->control(["C_PO" => $po]);
		if ($dataControl) {
			foreach ($dataControl as $key => $dataControl) {
				$result = $dataControl->C_TTS;
			}
		} else {
			foreach ($data as $key => $data) {
				$result += $data->ED_1ER_CHOIX;
			}
		}
		echo $result;
	}
	public function coupeQcTest()
	{
		$this->load->model("compta_model");
		$param = $this->input->post("PO");
		$reponse = 0;
		$data = $this->compta_model->extrusion_coupedata(["extrusion_coupe.BC_ID" => $param]);
		foreach ($data as $key => $data) {
			$reponse += $data->ED_1ER_CHOIX_SOMME;
		}
		echo $reponse;
	}
	public function deleteQC()
	{
		$param =  $this->input->post('parametre');
		$this->load->model("compta_model");
		echo $this->compta_model->deleteQC(["C_ID" => $param]);
	}


	public function exportExtrusion()
	{
		$this->load->model('production_model');

		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		if (!empty($_GET['po']) ) {
			$datas = $this->production_model->tableEX(['EX_BC_ID' => $_GET['po']]);
		}else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEX("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] . "' AND EX_N_MACH like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEX("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->tableEX("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "')");
		} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine'], "EX_EQUIP" => $_GET['operateurs'], "EX_QAURT" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date, "EX_EQUIP" => $_GET['operateurs'], "EX_QAURT" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine'], "EX_QAURT" => $_GET['operateurs']]);
		} else {
			$datas = $this->production_model->tableEX(['EX_DATE' => $date]);
		}

		$machine = $_GET['machine'];
		$data = array();

		$excel = "";
		$excel .= "DAILY REPPORT DU : $date\n\n";
		$excel .= "MACHINE\tPOIDS NET\tDUREE\tQUART\tDECHETS\tCHEF D'EQUIPE\tOPERETEUR 1\tOPERETEUR 2\n\n";
		foreach ($datas as $key => $row) {
			$excel .= " $row->EX_N_MACH\t$row->EX_PDS_NET\t$row->EX_DUREE\t $row->EX_QAURT\t$row->EX_DECHETS\t$row->EX_EQUIP\t$row->EX_OPERETEUR_1\t$row->EX_OPERETEUR_2\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . $date . ".xls");

		print $excel;
		exit;
	}


	public function exportImpression()
	{
		$this->load->model('production_model');
		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}

		if (!empty($_GET['po']) ) {
			$datas = $this->production_model->tableIPre(['extrusion_inpression.BC_ID' => $_GET['po']]);
		}else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->tableIPre("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs'] . "' AND EI_MACH like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableIPre("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->tableIPre("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "')");
		} else if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {

			$datas = $this->production_model->tableIPre(["EI_DATE" => $date, "EI_EQUIPE" => $_GET['machine'], "EI_MACH" => $_GET['machine']]);
		} else if (!empty($_GET['operateurs'])) {

			$datas = $this->production_model->tableIPre(["EI_DATE" => $date, "EI_EQUIPE" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->tableIPre(["EI_DATE" => $date, "EI_MACH" => $_GET['machine']]);
		} else {
			$datas = $this->production_model->tableIPre(["EI_DATE" => $date]);
		}
		$machine = $_GET['machine'];
		$data = array();
		$excel = "";
		$excel .= "DAILY REPPORT DU : $date\n\n";
		$excel .= "MACHINE\tPOIDS NET\tMETTRAGE\tDUREE\tQUART\tOPERETEUR 1\tOPERETEUR 2\n\n";
		foreach ($datas as $key => $row) {
			$excel .= " $row->EI_MACH\t$row->EI_PDS_SOMME\t$row->EI_METRE_SOMME\t$row->EI_DUREE\t $row->EI_QUART\t$row->EI_OPERATEUR1\t$row->EI_OPERATEUR2\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . $date . ".xls");

		print $excel;
		exit;
	}

	public function exportCoupe()
	{
		$this->load->model('production_model');
		if (isset($_GET['date']) and !empty($_GET['date'])) {
			$date = $_GET['date'];
		} else {
			$date = date('Y-m-d');
		}
		if (!empty($_GET['po']) ) {
			$datas = $this->production_model->tableEcooupe(['extrusion_coupe.BC_ID' => $_GET['po']]);
		}else  if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEcooupe("ED_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "' AND ED_MACHINE like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEcooupe("ED_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->tableEcooupe("ED_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "')");
		} else if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine'], "ED_EQUIPE" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date, "ED_EQUIPE" => $_GET['operateurs']]);
		} else  if (!empty($_GET['machine'])) {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine']]);
		} else {
			$datas = $this->production_model->tableEcooupe(["ED_DATE" => $date]);
		}
		$data = array();
		$machine = $_GET['machine'];
		$data = array();

		$excel = "";
		$excel .= "DAILY REPPORT DU : $date\n\n";
		$excel .= "MACHINE\t1érè CHOIX\tPOID ENTRE\tDECHETS\t2émè CHOIX\tDUREE\tQUART\tOPERETEUR 1\tOPERETEUR 2\tOPERETEUR 3\n\n";
		foreach ($datas as $key => $row) {
			$dechet = $row->ED_DECHE_INPRESSION + $row->ED_DECHE_EXTRUSION + $row->ED_DECHE_COUPE;
			$tempPoid = explode("+", $row->ED_POID_ENTRE);
			$entre = 0;
			foreach ($tempPoid as $key => $tempPoid) {
				if ($tempPoid != "") {
					$entre += $tempPoid;
				}
			}

			$excel .= " $row->ED_MACHINE\t$row->ED_1ER_CHOIX_SOMME\t$entre\t$dechet\t$row->ED_2E_CHOIX_SOMME\t$row->ED_DURE\t$row->ED_QUART\t$row->ED_OPERATEUR_1\t$row->ED_OPERATEUR_2\t$row->ED_OPERATEUR_3\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . $date . ".xls");

		print $excel;
		exit;
	}
	public function editImprimermatier()
	{
		$this->load->model('production_model');
		$id = $this->input->post('id');
		$imp  = $this->production_model->matierUtiliser(["MI_PO" => $id]);
		$data = [
			"data" => $imp,
			"po" => $id
		];
		echo json_encode($this->load->view('formulaire/modiPrintMatier', $data, true));
	}
	public function deleteMatierEmpress()
	{

		$this->load->model('production_model');
		$reference = $this->input->post('reference');
		$quantite = $this->input->post('quantite');
		$po = $this->input->post('po');
		$prix = $this->input->post('prix');
	
		$date = date('Y-m-d');
		
		$id = $this->input->post('id');
		$bon = $this->magasiner_model->bondecommande(["BC_PE" => $po]);
		$parametre = [
			"EM_REFERENCE" => $po,
			"EM_DATE" => $date,
			"EM_MATIER" => $reference,
			"EM_FORNISEUR" => $po,
			"EM_MAGASINIER" => $this->session->userdata("matricule"),
			"EM_ORIGIN" => $bon->BC_ORIGINE."_MAGASIN"
		];
	
		if ($this->magasiner_model->insertentree_materiel($parametre)) {
			$lastId = $this->magasiner_model->lsatInsetEntre();
			$requette = [
				"LI_MATIER" => $reference,
				"LI_QUANTITE" => $quantite,
				"LI_TYPE" => "entre",
				"LI_ENTRE" => $lastId->EM_ID,
				"LI_ORIGIN" => $bon->BC_ORIGINE."_MAGASIN",
				"LI_REFERENCE" => "RETOUR"
			];
			
			if ($this->magasiner_model->insertstock_materiel($requette)) {
				$id = $this->magasiner_model->select_stock_matier_premier(["ST_DESIGNATION" => $reference, 'ST_ORIGIN' => $bon->BC_ORIGINE.'_MAGASIN']);
				$quantites = $id->ST_QUANTITE + $quantite;
				$this->magasiner_model->updatestock_matier_premier(["ST_DESIGNATION" => $reference, 'ST_ORIGIN' => $bon->BC_ORIGINE.'_MAGASIN'], ["ST_QUANTITE" => $quantites]);
				$json['message'] = "succes";
				$json['type'] = "succes";
			}
		}
	
		 $this->production_model->deleteMatierUtiliser(['MI_ID' => $id]);
		
	}

	public function tableInjection()
	{
		$this->load->model('production_model');
		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'INJECTION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "' AND IN_MACHINE like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'INJECTION' AND  IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'INJECTION' AND  IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "')");
		} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'INJECTION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'INJECTION','IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'INJECTION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "QUART_TIME" => $_GET['operateurs']]);
		} else {
			$datas = $this->production_model->dataInjection(['IN_DATE' => $date,'IN_TYPE' => 'INJECTION']);
		}
			
		

		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->IN_DATE;
			$sub_array[] = $row->BC_PO;
			$sub_array[] = $row->IN_REFERENCE;
			$sub_array[] = $row->IN_QTY;
			$sub_array[] = $row->IN_DECHETS;
			$sub_array[] = $row->IN_MACHINE;
			$sub_array[] = $row->IN_DURE;
			$sub_array[] = $row->QUART_TIME;
			$sub_array[] = $row->IN_OPERATEUR1;
			$sub_array[] = $row->IN_OPERATEUR2;
			$sub_array[] = $row->IN_MATIERES;
			$sub_array[] = $row->IN_MASTERBATCHE;
			$sub_array[] = $row->IN_OBSERVATION1;
			$sub_array[] = $row->IN_OBSERVATION2;
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-warning btn-sm editExtrusion'><i class='fa fa-edit'></i></a>";
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-danger btn-sm deleteExtrusion'><i class='fa fa-trash'></i></a>";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	public function tableInjectionImpression()
	{
		$this->load->model('production_model');
		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'IMPRESSION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "' AND IN_MACHINE like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'IMPRESSION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'IMPRESSION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "')");
		} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'IMPRESSION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'IMPRESSION','IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'IMPRESSION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "QUART_TIME" => $_GET['operateurs']]);
		} else {
			$datas = $this->production_model->dataInjection(['IN_DATE' => $date,'IN_TYPE' => 'IMPRESSION']);
		}
		
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PO;
			$sub_array[] = $row->IN_REFERENCE;
			$sub_array[] = $row->IN_QTY;
			$sub_array[] = $row->IN_DECHETS;
			$sub_array[] = $row->IN_MACHINE;
			$sub_array[] = $row->IN_DURE;
			$sub_array[] = $row->QUART_TIME;
			$sub_array[] = $row->IN_OPERATEUR1;
			$sub_array[] = $row->IN_OPERATEUR2;
			$sub_array[] = $row->IN_MATIERES;
			$sub_array[] = $row->IN_MASTERBATCHE;
			$sub_array[] = $row->IN_OBSERVATION1;
			$sub_array[] = $row->IN_OBSERVATION2;
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-warning btn-sm editExtrusion'><i class='fa fa-edit'></i></a>";
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-danger btn-sm deleteExtrusion'><i class='fa fa-trash'></i></a>";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	public function Injectionecoupe()
	{
		$this->load->model('production_model');
		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'HOOK' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "' AND IN_MACHINE like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'HOOK' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'HOOK' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "')");
		} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'HOOK','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'HOOK','IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'HOOK','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "QUART_TIME" => $_GET['operateurs']]);
		} else {
			$datas = $this->production_model->dataInjection(['IN_DATE' => $date,'IN_TYPE' => 'HOOK']);
		}
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PO;
			$sub_array[] = $row->IN_REFERENCE;
			$sub_array[] = $row->IN_QTY;
			$sub_array[] = $row->IN_DECHETS;
			$sub_array[] = $row->IN_MACHINE;
			$sub_array[] = $row->IN_DURE;
			$sub_array[] = $row->QUART_TIME;
			$sub_array[] = $row->IN_OPERATEUR1;
			$sub_array[] = $row->IN_OPERATEUR2;
			$sub_array[] = $row->IN_MATIERES;
			$sub_array[] = $row->IN_MASTERBATCHE;
			$sub_array[] = $row->IN_OBSERVATION1;
			$sub_array[] = $row->IN_OBSERVATION2;
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-warning btn-sm editExtrusion'><i class='fa fa-edit'></i></a>";
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-danger btn-sm deleteExtrusion'><i class='fa fa-trash'></i></a>";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


public function	exportInjection(){

	$this->load->model('production_model');
	if (isset($_GET['debut']) and !empty($_GET['debut'])) {
		$date = $_GET['debut'];
	} else {
		$date = date('Y-m-d');
	}
	if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
		$datas = $this->production_model->dataInjection("IN_TYPE like 'INJECTION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "' AND IN_MACHINE like '" . $_GET['machine'] . "')");
	} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
		$datas = $this->production_model->dataInjection("IN_TYPE like 'INJECTION' AND  IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "')");
	} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
		$datas = $this->production_model->dataInjection("IN_TYPE like 'INJECTION' AND  IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "')");
	} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
		$datas = $this->production_model->dataInjection(['IN_TYPE' => 'INJECTION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
	} else if (!empty($_GET['operateurs'])) {
		$datas = $this->production_model->dataInjection(['IN_TYPE' => 'INJECTION','IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
	} else if (!empty($_GET['machine'])) {
		$datas = $this->production_model->dataInjection(['IN_TYPE' => 'INJECTION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "QUART_TIME" => $_GET['operateurs']]);
	} else {
		$datas = $this->production_model->dataInjection(['IN_DATE' => $date,'IN_TYPE' => 'INJECTION']);
	}

	$machine = $_GET['machine'];
		$data = array();

		$excel = "";
		$excel .= "DAILY REPPORT DU : $date\n\n";
		$excel .= "MACHINE\tPOIDS NET\tDUREE\tQUART\tDECHETS\tCHEF D'EQUIPE\tOPERETEUR 1\tOPERETEUR 2\n\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->IN_DATE\t$row->BC_PO\t$row->IN_REFERENCE\t$row->IN_MACHINE\t$row->IN_MATIERES\t$row->IN_MASTERBATCHE\t$row->IN_QTY\t$row->IN_DECHETS\t$row->IN_DURE\t$row->QUART_TIME\t$row->IN_OPERATEUR1\t$row->IN_OPERATEUR2\t$row->IN_OBSERVATION1\t$row->IN_OBSERVATION2\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . $date . ".xls");

		print $excel;
		exit;

}

public function	exporttableInjectionImpression(){
	$this->load->model('production_model');
		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'IMPRESSION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "' AND IN_MACHINE like '" . $_GET['machine'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'IMPRESSION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "')");
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			$datas = $this->production_model->dataInjection("IN_TYPE like 'IMPRESSION' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "')");
		} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'IMPRESSION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['operateurs'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'IMPRESSION','IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
		} else if (!empty($_GET['machine'])) {
			$datas = $this->production_model->dataInjection(['IN_TYPE' => 'IMPRESSION','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "QUART_TIME" => $_GET['operateurs']]);
		} else {
			$datas = $this->production_model->dataInjection(['IN_DATE' => $date,'IN_TYPE' => 'IMPRESSION']);
		}
	$machine = $_GET['machine'];
	$data = array();

	$excel = "";
	$excel .= "DAILY REPPORT DU : $date\n\n";
	$excel .= "MACHINE\tPOIDS NET\tDUREE\tQUART\tDECHETS\tCHEF D'EQUIPE\tOPERETEUR 1\tOPERETEUR 2\n\n";
	foreach ($datas as $key => $row) {
		$excel .= "$row->IN_DATE\t$row->BC_PO\t$row->IN_REFERENCE\t$row->IN_MACHINE\t$row->IN_MATIERES\t$row->IN_MASTERBATCHE\t$row->IN_QTY\t$row->IN_DECHETS\t$row->IN_DURE\t$row->QUART_TIME\t$row->IN_OPERATEUR1\t$row->IN_OPERATEUR2\t$row->IN_OBSERVATION1\t$row->IN_OBSERVATION2\n";
	}

	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . $date . ".xls");

	print $excel;
	exit;


}


public function exportInjectionecoupe(){
	$this->load->model('production_model');
	if (isset($_GET['debut']) and !empty($_GET['debut'])) {
		$date = $_GET['debut'];
	} else {
		$date = date('Y-m-d');
	}
	if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
		$datas = $this->production_model->dataInjection("IN_TYPE like 'HOOK' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "' AND IN_MACHINE like '" . $_GET['machine'] . "')");
	} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
		$datas = $this->production_model->dataInjection("IN_TYPE like 'HOOK' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "' AND  IN_OPERATEUR1 like '" . $_GET['operateurs'] . "')");
	} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
		$datas = $this->production_model->dataInjection("IN_TYPE like 'HOOK' AND IN_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( QUART_TIME like '" . $_GET['quart'] . "')");
	} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
		$datas = $this->production_model->dataInjection(['IN_TYPE' => 'HOOK','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
	} else if (!empty($_GET['operateurs'])) {
		$datas = $this->production_model->dataInjection(['IN_TYPE' => 'HOOK','IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['operateurs'], "QUART_TIME" => $_GET['operateurs']]);
	} else if (!empty($_GET['machine'])) {
		$datas = $this->production_model->dataInjection(['IN_TYPE' => 'HOOK','IN_DATE' => $date, "IN_MACHINE" => $_GET['machine'], "QUART_TIME" => $_GET['operateurs']]);
	} else {
		$datas = $this->production_model->dataInjection(['IN_DATE' => $date,'IN_TYPE' => 'HOOK']);
	}

	$machine = $_GET['machine'];
	$data = array();

	$excel = "";
	$excel .= "DAILY REPPORT DU : $date\n\n";
	$excel .= "MACHINE\tPOIDS NET\tDUREE\tQUART\tDECHETS\tCHEF D'EQUIPE\tOPERETEUR 1\tOPERETEUR 2\n\n";
	foreach ($datas as $key => $row) {
		$excel .= "$row->IN_DATE\t$row->BC_PO\t$row->IN_REFERENCE\t$row->IN_MACHINE\t$row->IN_MATIERES\t$row->IN_MASTERBATCHE\t$row->IN_QTY\t$row->IN_DECHETS\t$row->IN_DURE\t$row->QUART_TIME\t$row->IN_OPERATEUR1\t$row->IN_OPERATEUR2\t$row->IN_OBSERVATION1\t$row->IN_OBSERVATION2\n";
	}

	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . $date . ".xls");

	print $excel;
	exit;
}


}
