<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Planning extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}
	public function index()
	{

		$this->render_view('Planning/Accueil');
	}

	public function AccuilePage()
	{
		$this->load->view('Planning/AccuilePage');
	}

	public function detail($date)
	{
		$this->render_view('Planning/Detail');
	}
	public function deplaceExtrusion()
	{
		$machines = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$this->load->model('planning_model');
		$rang = $this->input->post('rang');
		$place = $this->input->post('place');
		$json = ["error" => "error"];
		$placeData = $this->planning_model->selectJobCard(["JO_ID" => $place]);
		$rangdata = $this->planning_model->selectJobCard(["JO_ID" => $rang]);
		$i = 0;
	


		//$llData = $this->planning_model->standardQuery("SELECT * FROM `jobcart` WHERE `JO_ID` > $rang AND JO_MACHINE = '$rangdata->JO_MACHINE'");
		//var_dump($llData );
		if ($placeData) {
			if ($rangdata) {
				$this->planning_model->deleteJobs(["JO_ID" => $place]);
				$this->planning_model->deleteJobs(["JO_ID" => $rang]);
				$rangdata->JO_ID = $place;
				$rangdata->JO_DATEDEDEBU = $placeData->JO_DATEDEDEBU;
				$rangdata->JO_DEB = $placeData->JO_DEB;
				$dt = new DateTime($placeData->JO_DATEDEDEBU . " " . $placeData->JO_DEB);
				$dt->modify('+ ' . $this->time_to_sec($rangdata->JO_DURE) . ' seconds');
				$rangdata->JO_DATEFIN = $dt->format('Y-m-d');
				$rangdata->JO_FIN = $dt->format('H:i:s');
				if ($this->planning_model->insertJobCard($rangdata)) {
					$placeData->JO_ID = $rang;
					if ($this->planning_model->insertJobCard($placeData)) {
						$type = $machines["$rangdata->JO_TYPE"];
						$llData = $this->planning_model->standardQuery("SELECT * FROM `jobcart` WHERE `JO_ID` > $rang AND $type = '$rangdata->JO_MACHINE' AND `JO_STATUT` = 'PLANIFIER' ORDER BY `JO_ID` ASC ");
						foreach ($llData as $key => $llData) {
							//var_dump($llData);
							$llData->JO_DATEDEDEBU = $dt->format('Y-m-d');
							$llData->JO_DEB = $dt->format('H:i:s');
							$dt->modify("+ " . $this->time_to_sec($llData->JO_DURE) . "seconde");
							$llData->JO_DATEFIN = $dt->format('Y-m-d');
							$llData->JO_FIN = $dt->format('H:i:s');
							$this->planning_model->updateJobCard($llData, ["JO_ID" => $llData->JO_ID]);
						}
					}
				}
			}
		}
	}



public function updateTimeImpression()
	{
		$machines = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$this->load->model('planning_model');
		$rang = $this->input->post('rang');

		        $updatePO =$this->input->post('updatePO');
				$DEBUUPDATE =$this->input->post('DEBUUPDATE');
				$date_prodUPDATE =$this->input->post('date_prodUPDATE');
               

			$json = ["error" => "error"];
			$rangdata = $this->planning_model->selectJobCard(["JO_ID" => $updatePO]);
			$i = 0;

			if ($rangdata) {
				$dt = new DateTime($date_prodUPDATE . " " . $DEBUUPDATE);
				$dt->modify('+ '. $this->time_to_sec($rangdata->JO_DURE) . ' seconds');
				$updatedata=[
				"JO_DEB"=>$DEBUUPDATE,
				"JO_DATEDEDEBU"=>$date_prodUPDATE,
			    "JO_FIN"=>$dt->format('H:i:s'),
			    "JO_DATEFIN"=>$dt->format('Y-m-d')
				];

				if($this->planning_model->updateJobCard($updatedata, ["JO_ID" => $updatePO])){
				  $type = $machines["$rangdata->JO_TYPE"];
					$llData = $this->planning_model->standardQuery("SELECT * FROM `jobcart` WHERE `JO_ID` > $updatePO AND  $type = '$rangdata->JO_MACHINE' AND `JO_STATUT` = 'PLANIFIER' ORDER BY `JO_ID` ASC ");
						foreach ($llData as $key => $llData) {
						
							
							$llData->JO_DATEDEDEBU = $dt->format('Y-m-d');
							$llData->JO_DEB = $dt->format('H:i:s');
							$dt->modify("+ ".$this->time_to_sec($llData->JO_DURE)."seconde");
							$llData->JO_DATEFIN = $dt->format('Y-m-d');
							$llData->JO_FIN = $dt->format('H:i:s');
							$this->planning_model->updateJobCard($llData, ["JO_ID" => $llData->JO_ID]);
					}
					}
			}
		
	}


	public function updateTime()
	{
		$machines = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$this->load->model('planning_model');
		$rang = $this->input->post('rang');

		$updatePO = $this->input->post('updatePO');
		$DEBUUPDATE = $this->input->post('DEBUUPDATE');
		$date_prodUPDATE = $this->input->post('date_prodUPDATE');

		
		
		
		$json = ["error" => "error"];
		$rangdata = $this->planning_model->selectJobCard(["JO_ID" => $updatePO]);
		$i = 0;

		if ($rangdata) {
			$dt = new DateTime($date_prodUPDATE . " " . $DEBUUPDATE);
			$dt->modify('+ ' . $this->time_to_sec($rangdata->JO_DURE) . ' seconds');
			$updatedata = [
				"JO_DEB" => $DEBUUPDATE,
				"JO_DATEDEDEBU" => $date_prodUPDATE,
				"JO_FIN" => $dt->format('H:i:s'),
				"JO_DATEFIN" => $dt->format('Y-m-d')
			];

			if ($this->planning_model->updateJobCard($updatedata, ["JO_ID" => $updatePO])) {
				$type = $machines["$rangdata->JO_TYPE"];
				$llData = $this->planning_model->standardQuery("SELECT * FROM `jobcart` WHERE `JO_ID` > $updatePO AND  $type = '$rangdata->JO_MACHINE' AND `JO_STATUT` = 'PLANIFIER' ORDER BY `JO_ID` ASC ");
				foreach ($llData as $key => $llData) {
					$llData->JO_DATEDEDEBU = $dt->format('Y-m-d');
					$llData->JO_DEB = $dt->format('H:i:s');
					$dt->modify("+ " . $this->time_to_sec($llData->JO_DURE) . "seconde");
					$llData->JO_DATEFIN = $dt->format('Y-m-d');
					$llData->JO_FIN = $dt->format('H:i:s');
					$this->planning_model->updateJobCard($llData, ["JO_ID" => $llData->JO_ID]);
				}
			}
		}
	}


	public function TableCherche()
	{
		$cherche = $this->input->post("cherche");
		$data = [
			"data" => $cherche
		];
		$this->load->view('Planning/TableCherche', $data);
	}
	public function createJobScartEtat1()
	{
		$this->load->model('planning_model');
		$data = [
			"JO_ID" => $this->input->post('JO_ID'),
			"BC_STATUT" => "PLANNIFIE",
			"BC_MACHINE" => $this->input->post('JO_MACHINE'),
			"BC_DATE_DE_PRODUCTION" => $this->input->post('JO_DATE'),
			"BC_PROCCESSUS" => $this->input->post('BC_STATUT'),
			"BC_ROULEAUX" => $this->input->post('BC_ROULEAUX'),
			"BC_QUANTITEAPRODUIREENMETRE" => $this->input->post('BC_QUANTITEAPRODUIREENMETRE'),
			"BC_POISENKGSAVECMARGE" => $this->input->post('BC_POISENKGSAVECMARGE'),
			"BC_DIMENSIONPROD" => $this->input->post('BC_DIMENSIONPROD'),
			"BC_POIDSDUNSACHET" => $this->input->post('POIDSSACHET')
		];
		echo json_encode($this->planning_model->editBonDeCommande($this->input->post('BC_PE'), $data));
	}

	public function editPoInpression()
	{
		$this->load->view('Planning/editPoInpression');
	}
	public function editPoExtrusion()
	{

		$machine = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$this->load->model('planning_model');
		$BC_PE = $this->input->post("BC_PE");
		$jobs = $this->input->post("jobs");
		$type = $this->input->post("type");
		$machine = "MACHINE 1";
		$data = [
			'job' => $this->planning_model->selectJobCardCommS(["jobcart.JO_ID" => $jobs, "jobcart.JO_TYPE" => $type]),
			'matier' => $this->planning_model->listeMartierPr(["BC_PE" => $BC_PE]),
			'machine' => $machine

		];
		$this->load->view('Planning/editPoExtrusion', $data);
	}

	public function insertJobCart()
	{
		$this->load->model('planning_model');
		$machine = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$date = array("IMPRESSION_INJECTION" => 'JO_DATE_IMPRIMER', "HOOK" => 'JO_DATE_DECOUPE', "COUPE_EXTRUSION" => 'JO_DATE_DECOUPE', "IMPRESSION_EXTRUSION" => 'JO_DATE_IMPRIMER', "INJECTION" => 'JO_DATE', "EXTRUSION" => 'JO_DATE');
		$timpFin = explode(":", $this->input->post('hdeb'));
		$tempFins = "";

		if (count($timpFin) < 3) {
			$tempFins =  trim($this->input->post('hdeb') . ":00", " ");
		} else {
			$tempFins = trim($this->input->post('hdeb'), " ");
		}

		//$dt = new DateTime()*/
		$dataPla = [
			"HP_TOTALH" => $this->input->post('heure'),
			"HP_DATE" => $this->input->post('JO_DATE'),
			"BC_ID" => $this->input->post('BC_PE'),
			"HP_MACHINE" => $this->input->post('JO_MACHINE'),
			"H_DEBUT" => $this->input->post('date_prod'),
			"H_FIN" => $this->input->post('heurefin'),
			"H_DATEDFIN" => $this->input->post('dateFIn')

		];

		$this->planning_model->insertheurePlanning($dataPla);
		$dataWHiile =  $this->time_to_sec($this->input->post('heure'));
		$datadate = 0;
		$defaultDate = new DateTime($this->input->post('JO_DATE'));



		$data = [
			"JO_DEB" => $this->input->post('hdeb'),
			"JO_DATE" => date('Y-m-d'),
			"JO_CREAT" => $this->session->userdata('matricule'),
			"BC_PE" => $this->input->post('BC_PE'),
			$date[$this->input->post('BC_STATUT')] => $this->input->post('JO_DATE'),
			$machine[$this->input->post('BC_STATUT')] => $this->input->post('JO_MACHINE'),
			"JO_TYPE" => $this->input->post('BC_STATUT'),
			"JO_STATUT" => 'PLANIFIER',
			"JO_DURE" => $this->input->post('heure'),
			"JO_IDS" => $this->input->post('JO_ID'),
			"JO_FIN" => $this->input->post('heurefin'),
			"JO_DATEDEDEBU" => $this->input->post('date_prod'),
			"JO_DATEFIN" => $this->input->post('dateFIn'),
			"JO_SORTIE" => $this->input->post('JO_SORTIE')
		];

		echo json_encode($this->planning_model->insertJobCard($data));
	}

	public function insertJobPlanning($parametre)
	{
		$data = (object)$parametre;
		if ($data) {
			$dureLast = $this->time_to_sec($data->HP_TOTALH);
			//$deleteSql=  $this->db->query("DELETE FROM `heureplanning` WHERE `BC_ID`= '$data->BC_ID'");

			$updata = $this->db->query("SELECT * FROM `heureplanning` WHERE (H_DEBUT > '$data->H_FIN' AND (HP_DATE ='$data->HP_DATE' OR HP_DATE > '$data->HP_DATE') ) OR (H_DEBUT >'$data->H_FIN' AND ( HP_DATE > '$data->HP_DATE' OR HP_DATE = '$data->HP_DATE' )) GROUP by `BC_ID` ORDER BY `HP_ID` ASC ")->result_object();
			$defaultDate = new DateTime($data->HP_DATE);
			//$this->db->query("DELETE FROM `heureplanning` WHERE (H_DEBUT > '$data->H_FIN' AND HP_DATE ='$data->HP_DATE') OR (H_DEBUT >'$data->H_FIN' AND HP_DATE > '$data->HP_DATE')");

			$dateRes = array();
			array_push($dateRes, $data->HP_DATE);
			$i = 0;
			$dateDebut = $data->H_FIN;
			foreach ($updata as $key => $updata) {
				$time_to_sec = "";
				$timeTest = 0;
				$time_to_sec = $this->time_to_sec($updata->H_DEBUT);
				$timeTest = $this->time_to_sec($updata->HP_TOTALH);

				if ($timeTest > 86400) {
					$dataWHiile =  $timeTest;
					$reste = 0;
					if ($i == 0) {
						$dataWHiile = (int)$dataWHiile - 86400;

						$hfin =   $this->time_to_sec($dateDebut) + $this->time_to_sec($updata->HP_TOTALH);
						if ($hfin > 86400) {
							$reste =  $hfin - 86400;
							$dataWHiile = $dataWHiile -  86400;
							$defaultDate->modify("+1day");
							$hfin = "00:00:00";
							$this->db->query("INSERT INTO `heureplanning`( `HP_TOTALH`, `HP_DATE`, `BC_ID`, `HP_MACHINE`, `H_DEBUT`, `H_FIN`, `H_DATEDFIN`) VALUES ('$updata->HP_TOTALH','$data->HP_DATE','$updata->BC_ID','$updata->HP_MACHINE','$data->H_DEBUT','$hfin','$data->HP_DATE')");
						} else {
							$this->db->query("INSERT INTO `heureplanning`( `HP_TOTALH`, `HP_DATE`, `BC_ID`, `HP_MACHINE`, `H_DEBUT`, `H_FIN`, `H_DATEDFIN`) VALUES ('$updata->HP_TOTALH','$data->HP_DATE','$updata->BC_ID','$updata->HP_MACHINE','$data->H_DEBUT',' $this->se_to_time($this->time_to_sec($dateDebut) + $this->time_to_sec($updata->HP_TOTALH))',$data->HP_DATE)");
						}
						$i++;
					}
					$datadate = 0;

					do {
						$dt = "";
						$datedate = "";
						$listeDAte = "";
						$dataWHiile = (int)$dataWHiile - 86400;
						$datadate += 1;
						$dt = $defaultDate;
						$dt->modify("+" . $datadate . "day");
						$listeDAte = $dt->format("Y-m-d");
						$lastData =  $this->db->query("SELECT * FROM `heureplanning` ORDER BY `heureplanning`.`HP_ID` DESC")->row_object();
						$this->db->query("INSERT INTO `heureplanning`( `HP_TOTALH`, `HP_DATE`, `BC_ID`, `HP_MACHINE`, `H_DEBUT`, `H_FIN`, `H_DATEDFIN`) VALUES ('$updata->HP_TOTALH','$listeDAte','$updata->BC_ID','$updata->HP_MACHINE','00:00:00','00:00:00','$listeDAte')");
					} while ($dataWHiile > 86400);

					if ($dataWHiile != 0) {
						$dt->modify("+1day");
						$listeDAte = $dt->format("Y-m-d");
						$this->db->query("INSERT INTO `heureplanning`( `HP_TOTALH`, `HP_DATE`, `BC_ID`, `HP_MACHINE`, `H_DEBUT`, `H_FIN`, `H_DATEDFIN`) VALUES ('$updata->HP_TOTALH','$listeDAte','$updata->BC_ID','$updata->HP_MACHINE','$lastData->H_FIN','$updata->H_FIN','$listeDAte')");

						$dateDebut = $updata->H_FIN;
						echo $dataWHiile;
					}
				} else {
					// $this->db->query("DELETE FROM `heureplanning` WHERE `BC_ID`= '$data->BC_ID'");

					$insert = "";
					$dateDebut = $data->H_DEBUT;
					$hfin =   $this->se_to_time($this->time_to_sec($dateDebut) + $this->time_to_sec($updata->HP_TOTALH));

					$this->db->query("INSERT INTO `heureplanning`( `HP_TOTALH`, `HP_DATE`, `BC_ID`, `HP_MACHINE`, `H_DEBUT`, `H_FIN`, `H_DATEDFIN`) VALUES ('$updata->HP_TOTALH','$updata->HP_DATE','$updata->BC_ID','$updata->HP_MACHINE','$dateDebut','$hfin','2021-09-02')");
				}
			}
		}
	}

	public function saveMartierPr()
	{
		$this->load->model('planning_model');
		$data = [
			"MU_DESIGNATION" => $this->input->post('MU_DESIGNATION'),
			"MU_QUANTITE" => $this->input->post('MU_QUANTITE'),
			"MU_PRIX" => $this->input->post('MU_PRIX'),
			"BC_PE" => $this->input->post('BC_PE'),
			"MU_TYPE" => $this->input->post('type')
		];

		echo json_encode($this->planning_model->saveMartierPr($data));
	}
	public function testHeure()
	{
		echo '08:02:10';
	}
	public function lastIdJob()
	{
		$this->load->model('planning_model');
		$data = $this->planning_model->lastIdJob();
		if ($data == null) {
			echo "0001";
		} else {
			echo $data->JO_IDS + 1;
		}
	}
	public function Job_terminer()
	{
		$this->load->model('planning_model');
		$data = array();
		$datas = $this->planning_model->listebondecommandeTeminer();
		foreach ($datas as $row) {

			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_DATELIVRE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_TYPEMATIER;
			$sub_array[] = $row->BC_ECHANTILLON;
			$sub_array[] = $row->BC_IMPRESSION;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_REASSORT;
			$sub_array[] = $row->BC_RABAT;
			$sub_array[] = $row->BC_SOUFFLET;
			$sub_array[] = $row->BC_PERFORATION;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_OBSERVATION;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function tableProcessus()
	{
		$page = $this->input->post('page');
		$this->load->model('planning_model');
		switch ($page) {
			case 'EXTRUSION':
				$this->load->view('Planning/processus_extrusion');
				break;
			case 'INJECTION':
				$this->load->view('Planning/processus_injection');
				break;
			default:
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "EXTRUSION", "MA_STATUT" => "on"])
				];
				$this->load->view('Planning/tableExtrusion', $data);
				break;
		}
	}
	public function page_jobs()
	{
		$this->load->model('planning_model');
		$this->load->model('production_model');
		$page = $this->input->post('page');
		switch ($page) {
			case 'NON PLANNIFIER':
				$date = $this->input->post("date");
				$date = $this->input->post("date");
				$PO = $this->input->post("PO");
				if($PO!=""){
					$datas =$this->planning_model->listebon(["BC_PE" => $PO, "BC_STATUT" => "NON PLANNIFIE"]);
				}else if ($date == "") {
					$date = date("Y-m-d");
					$datas = $this->planning_model->listebon(["BC_DATE" => $date, "BC_STATUT" => "NON PLANNIFIE"]);
				}else{
					$datas =$this->planning_model->listebon(["BC_DATE" => $date, "BC_STATUT" => "NON PLANNIFIE"]);
				}
				$machine = $this->production_model->machine(["MA_SPECIFIQUE" => "EXTRUSION"]);
				$operateur = $this->production_model->operateur(["OP_STATUT" => "on"]);
				$data = [
					"data" => $datas,
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('Planning/tableDefault_planning', $data);
				break;
			case 'EN PRODUCTION':
				$this->load->view('Planning/tableEnProduction_planning');
				break;
			case 'TERMINER':
				$this->load->view('Planning/tableTerminer_planning');
				break;
			case 'REEXTRUSION':
				$this->load->view('Planning/tablerex_planning');
				break;
			case 'PURGE':
				$this->load->view('Planning/purge');
				break;
			default:
				break;
		}
	}
	public function reex()
	{
		$this->load->model('planning_model');
		$param = $this->input->post("pe");
		return $this->planning_model->editBonDeCommande($param, ['BC_STATUT' => "NON PLANNIFIE"]);
	}
	public function dataInjection()
	{
		$this->load->model('planning_model');
		$param = $this->input->post("param");
		switch ($param) {
			case 'INJECTION':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "INJECTION", "MA_STATUT" => "on"])
				];
				$this->load->view('Planning/tableInjection', $data);
				break;
			case 'HOOK':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "HOOK", "MA_STATUT" => "on"])
				];
				$this->load->view('Planning/tableInjectionHook', $data);
				break;
			case 'IMPRESSION':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "IMPRESSION_INJECTION", "MA_STATUT" => "on"])
				];
				$this->load->view('Planning/tableInjectionInpression', $data);
				break;
			default:
				break;
		}
	}

	public function dataExtrusion()
	{
		$this->load->model('planning_model');
		$param = $this->input->post("param");
		switch ($param) {
			case 'EXTRUSION':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "EXTRUSION", "MA_STATUT" => "on"])
				];
				$this->load->view('Planning/tableExtrusion', $data);
				break;
			case 'COUPE':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "COUPE_EXTRUSION", "MA_STATUT" => "on"])
				];
				$this->load->view('Planning/tableExtrusionCoup', $data);
				break;
			case 'IMPRESSION':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION", "MA_STATUT" => "on"])
				];
				$this->load->view('Planning/tableleEXtrusionInpression', $data);
				break;
			default:
				break;
		}
	}
	public function updateBondecommande()
	{
		$machine = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$date = array("IMPRESSION_INJECTION" => 'JO_DATE_IMPRIMER', "HOOK" => 'JO_DATE_DECOUPE', "COUPE_EXTRUSION" => 'JO_DATE_DECOUPE', "IMPRESSION_EXTRUSION" => 'JO_DATE_IMPRIMER', "INJECTION" => 'JO_DATE', "EXTRUSION" => 'JO_DATE');
		$this->load->model('planning_model');
		$BC_PE = $this->input->post("BC_PE");
		$BC_STATUT = $this->input->post("BC_STATUT");
		$BC_MACHINE = $this->input->post("BC_MACHINE");
		$data = [
			"BC_PROCCESSUS" => $BC_STATUT,
			"BC_MACHINE" => $BC_MACHINE
		];
		$datas = [
			"JO_DEB" => $this->input->post('hdeb'),
			"JO_DATE" => date('Y-m-d'),
			"JO_CREAT" => $this->session->userdata('matricule'),
			"BC_PE" => $this->input->post('BC_PE'),
			$date[$this->input->post('BC_STATUT')] => $this->input->post('date'),
			$machine[$this->input->post('BC_STATUT')] => $this->input->post('BC_MACHINE'),
			"JO_TYPE" => $this->input->post('BC_STATUT'),
			"JO_STATUT" => 'PLANIFIER',
			"JO_DEB" => date('H:i:s')
		];
		$this->planning_model->insertJobCard($datas);
		return  $this->planning_model->editBonDeCommande($BC_PE, $data);
	}
	public function updateStatuCommandeTerminer()
	{
		$this->load->model('planning_model');
		$BC_PE = $this->input->post("parent");
		$data = [
			"BC_STATUT" => "TERMINER"

		];
		return  $this->planning_model->editBonDeCommande($BC_PE, $data);
	}
	public function Job_card()
	{
		$this->load->model('planning_model');
		$data = array();
		$datas = $this->planning_model->listebondecommande();
		foreach ($datas as $row) {
			if ($this->planning_model->testJobCard($row->BC_PE)) {
				$sub_array = array();
				$sub_array[] = $row->BC_PE;
				$sub_array[] = $row->BC_DATE;
				$sub_array[] = $row->BC_DATELIVRE;
				$sub_array[] = $row->BC_CLIENT;
				$sub_array[] = $row->BC_CODE;
				$sub_array[] = $row->BC_TYPEPRODUIT;
				$sub_array[] = $row->BC_TYPEMATIER;
				$sub_array[] = $row->BC_TYPE;
				$sub_array[] = $row->BC_ECHANTILLON;
				$sub_array[] = $row->BC_IMPRESSION;
				$sub_array[] = $row->BC_DIMENSION;
				$sub_array[] = $row->BC_REASSORT;
				$sub_array[] = $row->BC_RABAT;
				$sub_array[] = $row->BC_SOUFFLET;
				$sub_array[] = $row->BC_PERFORATION;
				$sub_array[] = $row->BC_QUNTITE;
				$sub_array[] = $row->BC_OBSERVATION;

				$data[] = $sub_array;
			} else if (!$this->planning_model->testJobCards($row->BC_PE)) {
				$sub_array = array();
				$sub_array[] = $row->BC_PE;
				$sub_array[] = $row->BC_DATE;
				$sub_array[] = $row->BC_DATELIVRE;
				$sub_array[] = $row->BC_CLIENT;
				$sub_array[] = $row->BC_CODE;
				$sub_array[] = $row->BC_TYPEPRODUIT;
				$sub_array[] = $row->BC_TYPEMATIER;
				$sub_array[] = $row->BC_TYPE;
				$sub_array[] = $row->BC_ECHANTILLON;
				$sub_array[] = $row->BC_IMPRESSION;
				$sub_array[] = $row->BC_DIMENSION;
				$sub_array[] = $row->BC_REASSORT;
				$sub_array[] = $row->BC_RABAT;
				$sub_array[] = $row->BC_SOUFFLET;
				$sub_array[] = $row->BC_PERFORATION;
				$sub_array[] = $row->BC_QUNTITE;
				$sub_array[] = $row->BC_OBSERVATION;
				$data[] = $sub_array;
			}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function autocompleteSortie()
	{
		$this->load->model('planning_model');
		$resultat = array();
		$data = $this->planning_model->autocompleteStock($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->ST_DESIGNATION . " | " . $data->ST_UNITE;
		}
		echo json_encode($resultat);
	}

	public function autocompleteBon()
	{
		$this->load->model('planning_model');
		$mot = $this->input->get('term');
		$resultat = array();
		$data = $this->planning_model->listebons("BC_PE like '%$mot%' LIMIT 20");
		foreach ($data as $key => $data) {
			$resultat[] = $data->BC_PE;
		}
		echo json_encode($resultat);
	}
	public function machineModaleTable()
	{
		$this->load->model('planning_model');
		if ($this->input->post('type') == "PURGE") {
			$data = $this->planning_model->listeMachine();
			$resultat = array();
			foreach ($data as $key => $data) {
				$resultat[] = $data->MA_DESIGNATION;
			}
		} else {
			$data = $this->planning_model->machines($this->input->post('type'));
			$resultat = array();
			foreach ($data as $key => $data) {
				$resultat[] = $data->MA_DESIGNATION;
			}
		}

		echo json_encode($resultat);
	}
	public function fullcalandarData()
	{
		$this->load->model('planning_model');
		$data = $this->planning_model->dateCallandar();
		foreach ($data as $key => $data) {
			$tab[] = array(
				"id" => "1",
				"title" => "NOUVELLE COMMANDE : " . $this->planning_model->mombreStatut($data->BC_DATE, "ETA1"),
				"start" => $data->BC_DATE, // please specify dates in milliseconds, not seconds
				"color" => "#0062cc"
			);
			$tab[] = array(
				"id" => "2",
				"title" => "EN PRODUCTION : " . $this->planning_model->mombreStatut($data->BC_DATE, "PROD"),
				"start" => $data->BC_DATE,
				"color" => "#FFA900"
			);

			$tab[] = array(
				"id" => "2",
				"title" => "TERMINER : " . $this->planning_model->mombreStatut($data->BC_DATE, "Términer"),
				"start" => $data->BC_DATE,
				"color" => "#00B74A"
			);
		}
		echo json_encode($tab);
	}
	public function en_attente()
	{
	}

	public function creetPurge()
	{
		$this->load->model('planning_model');
		$machines = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$date = array("IMPRESSION_INJECTION" => 'JO_DATE_IMPRIMER', "HOOK" => 'JO_DATE_DECOUPE', "COUPE_EXTRUSION" => 'JO_DATE_DECOUPE', "IMPRESSION_EXTRUSION" => 'JO_DATE_IMPRIMER', "INJECTION" => 'JO_DATE', "EXTRUSION" => 'JO_DATE');

		/*$debut = $this->input->post('debut');
	$dure = $this->input->post('dure');
	$BC = $this->input->post('BC');
	//date:date,matier:matier,BC_PO:BC_PO,DJ_MACHINEE:DJ_MACHINEE
	$machine =$this->input->post('machine');
	 $this->planning_model->insertJobCard(["JO_DURE"=>$dure,"JO_DEB"=>$debut,$machines[$this->input->post('type')]);*/

		/*$data = [
			"BC_ID" => $this->input->post('BC_PO'),
			"Pu_POID" => $this->input->post('matier'),
			"P_QUANTITE" => $this->input->post('qtt'),
			"Observation" => $this->input->post('type')
		];

		$this->planning_model->insertPurge($data);*/

		$hdebe = $this->input->post('hdebe');
		$heuree = $this->input->post('heuree');
		$dateFIne = $this->input->post('dateFIne');
		$heurefine = $this->input->post('heurefine');


		echo $this->planning_model->insertJobCard([
			"BC_PE" => $this->input->post('BC_PO'),
			$date[$this->input->post('BC_STATUT')] => $this->input->post('date'),
			$machines[$this->input->post('BC_STATUT')] => $this->input->post('DJ_MACHINEE'),
			"JO_OBS" => $this->input->post('type'),
			"JO_STATUT" => "PLANIFIER",
			"JO_TYPE" => $this->input->post('BC_STATUT'),
			"JO_CREAT" => $this->session->userdata('matricule'),
			"JO_DURE" => $heuree,
			"JO_DEB" => $hdebe,
			"JO_FIN" => $heurefine,
			"JO_DATEFIN" => $dateFIne,
			"JO_DATEDEDEBU" => $this->input->post('date')

		]);
	}
	public function miseEnProduction()
	{
		$this->load->model('planning_model');
		$jobs = $this->input->post('jobs');
		echo $this->planning_model->updateJobCard(["JO_ETAT" => 'on'], ["JO_ID" => $jobs]);
	}
	public function planning_machine()
	{
		$this->load->model('planning_model');
		$data = array();
		$machine = $this->planning_model->machineActive();
		foreach ($machine as $key => $machine) {
			$data[$machine->BC_MACHINE] = $this->planning_model->listebondecommandeParMa($machine->BC_MACHINE);
		}
		return $data;
	}
	public function detailPo()
	{
		$this->load->model('planning_model');
		$po = $this->input->post('PO');
		$data = [
			"extrusion" => $this->planning_model->extrusion(["EX_BC_ID" => $po]),
			"impression" => $this->planning_model->extrusion_inpression(["BC_ID" => $po]),
			"coupe" => $this->planning_model->extrusion_coupe(["BC_ID" => $po])
		];


		$this->load->view('Planning/dataRecons', $data);
	}
	public function detailPoPro()
	{
		$this->load->model('planning_model');
		$po = $this->input->post('PO');
		$data = [
			"extrusion" => $this->planning_model->extrusion(["EX_BC_ID" => $po]),
			"impression" => $this->planning_model->extrusion_inpression(["BC_ID" => $po]),
			"coupe" => $this->planning_model->extrusion_coupe(["BC_ID" => $po]),
			"PO" => $po
		];
		$this->load->view('Planning/dataPro', $data);
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
	public function MES_COMMANDES()
	{
		$this->load->model('commercial_model');
		$data = array();
		$datas = $this->commercial_model->bondecommandesTous();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;

			$sub_array[] =
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function page()
	{
		$this->load->model('planning_model');
		$page = $this->input->post('page');
		switch ($page) {
			case 'LISTE DES COMMANDE':
				$data = [
					'annee' => $this->anne(),
					'type' => $this->commercial_model->type(),
					'type_de_matier' => $this->commercial_model->type_de_matier()
				];
				$this->load->view('Planning/Mes_commande', $data);
			break;
			case 'STOCKS DISPONIBLES':
				echo '<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Accueil</a></li>
					<li class="breadcrumb-item"><a href="#">Planning</a></li>
					<li class="breadcrumb-item active" aria-current="page">Stocks disponibles</li>
				</ol>
			</nav>';
				$this->load->view('Planning/stockProduitFini');
				break;
			case 'RECONCILIATION':

				$this->load->view('Planning/MesCommandes');
				break;

			case 'RECONCILIATIONS':
				$this->load->view('Planning/AccuielReconciliations');
				break;
			case 'SUIVI PROGRESSION':
		
				$this->load->view('Planning/costCont');

				break;
            case 'HISTORIQUE DE LIVRAISON':
				$this->load->view('Planning/historique');
			
				break;
			case 'RECAP MACHINE':

				$data = [
					"machine" => $this->planning_model->listemachinex()
				];
				$this->load->view('Planning/machineReport', $data);
				break;
			case 'PROGRESSION':

				$data = [
					"data" => $this->planning_model->listebons(['BC_DATE' => date('Y-m-d')])
				];
				$this->load->view('Planning/progression', $data);
				break;
			case 'DETAIL DE LIVRAISON':
				$this->load->view('Planning/detailLivre');
			break;

			case 'VERIFICATION MATIERES':
				$this->load->view('Planning/verificationMatier');
				break;
            case 'SUIVIE COMMANDES':
            		$this->load->view('Planning/suivieCommande');
            break;
            case 'ENTRE DEUXIEME CHOIX PRODUCTION':
            	$this->load->view('Planning/choixProd');
            break;
            case 'STOCKS DEUXIEME CHOIX':
            	$this->load->view('Planning/StockChoix');
            break;
            case 'DETAIL QC':
            	$this->load->view('Planning/liste');
            break;            
			case 'STOCK DEUXIEME CHOIX':
				$this->load->view('Planning/AccueilChoix');
				break;
			case 'JOB CARD':
				$this->load->view('Planning/Job_card');
				break;
			case 'ACCUEIL':
				$this->load->view('Planning/AccuilePage');
				break;
			case 'STOCKS MATIERES PREMIERES':
				echo '<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Accueil</a></li>
					<li class="breadcrumb-item"><a href="#">Planning</a></li>
					<li class="breadcrumb-item active" aria-current="page">Stocks matières</li>
				</ol>
			</nav>';
				$this->load->view('global/stockMatier');
				break;
			case 'LISTE DES PRODUCTIONS TERMINEES':
				$date = date('Y-m');
				$data = [
					"data" => $this->planning_model->listebons("BC_DATE like '$date%' AND BC_STATUT LIKE 'TERMINER' ")
				];

				$this->load->view('Planning/tableProgression', $data);
				break;
			case 'CALENDRIER DE LIVRAISON':
				$this->load->view('Planning/calendrierDelivre');
				break;
			case 'FORMULE':
				$this->load->view('Planning/formule');
				break;
			case 'PROGRESSION PO':
				$this->load->view('Planning/detailPoProgression');
				break;
			case 'recapMachine':
				$date = $this->input->post("date");
				$machine = $this->input->post("machine");
				$specification = $this->input->post("specification"); 
				$data = [
					'date'=>$date,
					'machine'=>$machine
				];
				if($specification == "" || $specification=="EXTRUSION"){
					$this->load->view('Planning/recapMachine', $data);
				}else if($specification=="IMPRESSION_EXTRUSION"){
					$this->load->view('Planning/suiVieMachineImpression', $data);
				}
				
				break;
			default:
				break;
		}
	}
public function detailLivraison(){
	$this->load->model("Magasiner_model");
	 $po = $this->input->post('PO'); 
			$data = [

                    "data"=>$this->Magasiner_model->listebondecommande(["BC_PE"=>$po])
    
			];
			$this->load->view('Planning/historique', $data);
}	
public function dataCOst(){
	$this->load->model('planning_model');
	$operateur = $this->production_model->operateur(["OP_STATUT" => "on"]);
	$date = $this->input->post('debut');
	$fin = $this->input->post('fin');

	if($fin!="" && $date!=""){
	
	 $data = $this->planning_model->listebons("BC_DATE BETWEEN '$date' AND '$fin'");
	}else{
		if($date!=""){
			$data=$this->planning_model->listebons(['BC_DATE' => $date]);
		}else{
			$data=$this->planning_model->listebons(['BC_DATE' => date('Y-m-d')]);
		}
	}
	$datas = [
		"data" => $data
	];

	echo $this->load->view('Planning/dataCont', $datas,true);
}
	public function recherchePOVerifier()
	{

		$this->load->model('production_model');
		$data = [
			"VM_PO" => $this->input->post('param'),
		];
		$donne =  $this->production_model->cherchePEEXTRu($data);
		$this->load->view('Planning/tableVerification', ["donne" => $donne]);
	}
	public function cadanceMachine($parametre)
	{
		$this->load->model('planning_model');
		return $this->planning_model->DetailMachine($parametre);
	}
	public function tempsDeProduction()
	{
		$this->load->model('planning_model');
		$date = $this->input->post("date");
		$poids = $this->input->post("poids");
		$machine = $this->input->post("machine");
		$heure = $this->input->post("heure");
		//$processus = $date=$this->input->post("processus");
		$json = array("message" => false, "dure" => 0);
		$parametre = [
			"MA_DESIGNATION" => $machine
		];
		$data = $this->planning_model->detailMachine($parametre);
		if ($data) {

			$dureTemp = $poids / $data->MA_VITESSE;
			$hdt = 00;
			while ($dureTemp > 0.99) {
				$hdt++;
				$dureTemp = $dureTemp - 1;
			}
			if ($hdt < 10) {
				$hdt = "0" . $hdt;
			}
			$tempds = number_format(($dureTemp * 60), 0);
			if ($tempds < 10) {
				$tempds = "0" . $tempds;
			}
			$dt = new DateTime($date . " " . $heure);
			$dt->modify("+ " . $this->time_to_sec(date($hdt . ":" . $tempds . ":00")) . " seconde");
			$json["dure"] = date($hdt . ":" . $tempds . ":00");
			$json["debut"] = $this->se_to_time($this->time_to_sec(date("00:00:00")) + $this->time_to_sec(date($hdt . ":" . $tempds . ":00")));
			$json["dateFIn"] = $dt->format('Y-m-d');
			$json["heurefin"] = $dt->format('H:i:s');
		} else {
		}
		echo json_encode($json);
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
	public function calculePlanning()
	{
		// $machines = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		// $this->load->model('planning_model');
		// $json = array("message" => "false");
		// $poids = 1;
		// $poids = $this->input->post('poids');
		// $date = $this->input->post('date');
		// $machine = $this->input->post('machine');
		// $param = [
		// 	$machines[$this->input->post('BC_STATUT')] => $this->input->post('machine'),
		// ];
		// $mact = $machines[$this->input->post('BC_STATUT')];
		// $requette =  $this->input->post('machine');

		// //$data = $this->planning_model->heureplanning($param);
		// $data = $this->planning_model->standardQueryfetch("SELECT `JO_ID`,`JO_FIN`,`JO_DATEFIN` FROM `jobcart` WHERE $mact = '$requette' ORDER BY `JO_ID` DESC LIMIT 1");
		// if ($data) {
		// 	if (date($data->JO_DATEFIN) > date($date)) {
		// 		$json['observation'] = "La date n'est plus disponible ! Veuillez entrer une nouvelle date";
		// 	} else if ($data->JO_DATEFIN == $date) {
		// 		if ($data->JO_FIN < date('23:59:00')) {
		// 			$dt = new DateTime($data->JO_DATEFIN . " " . $data->JO_FIN);
		// 			$machine = $this->cadanceMachine(["MA_DESIGNATION" => $machine, "MA_STATUT" => "on"]);
		// 			$dureTemp = $poids / $machine->MA_VITESSE;
		// 			$hdt = 00;
		// 			while ($dureTemp > 0.99) {
		// 				$hdt++;
		// 				$dureTemp = $dureTemp - 1;
		// 			}
		// 			if ($hdt < 10) {
		// 				$hdt = "0" . $hdt;
		// 			}
		// 			$tempds = number_format(($dureTemp * 60), 0);
		// 			if ($tempds < 10) {
		// 				$tempds = "0" . $tempds;
		// 			}

		// 			$dt->modify('+ ' . $this->time_to_sec(date($hdt . ":" . $tempds . ":00")) . ' seconds');

		// 			$json["message"] = "true";
		// 			$json["dure"] = date($hdt . ":" . $tempds . ":00");
		// 			$json["hdeb"] = $data->JO_FIN;
		// 			$json["dateFIn"] = $dt->format('Y-m-d');
		// 			$json["heurefin"] = $dt->format('H:i:s');
		// 		} else {
		// 			$json['observation'] = "La date n'est plus disponible ! Veuillez entrer une nouvelle date";
		// 		}
		// 	} else {

		// 		$json["message"] = "init";
		// 	}
		// } else {
		// 	$json["message"] = "init";
		// }
        $json["message"] = "init";
		echo json_encode($json);
	}

	public function bonReconsialisation()
	{
		$this->load->model('planning_model');
		$date = date('Y-m');
		$datas = $this->planning_model->listebons("BC_DATE like '$date%'");
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
	public function tableEX()
	{
		$this->load->model('planning_model');
		$po = $_GET['PO'];
		$datas = $this->planning_model->tableEX($po);
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


			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function extrusioninpression()
	{
		$this->load->model('planning_model');
		$po = $_GET['PO'];
		$datas = $this->planning_model->tableIPre($po);
		$data = array();
		foreach ($datas as $row) {
			$nbop = 0;

			$sub_array = array();
			$sub_array[] = $row->EI_DATE;
			$sub_array[] = $row->BC_ID;
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
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


	public function exdecoupe()
	{
		$this->load->model('planning_model');
		$po = $_GET['PO'];
		$datas = $this->planning_model->tableEcooupe($po);
		$data = array();
		foreach ($datas as $row) {
			$nreoul = explode(",", $row->ED_RLX);

			$sub_array = array();
			$sub_array[] = $row->ED_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->ED_RLX;
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
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function deleTeMatier()
	{
		$this->load->model('planning_model');
		$id = $this->input->post('id');
		echo $this->planning_model->deleTeMatier(['MU_ID' => $id]);
	}
	public function sauveMatier()
	{
		$this->load->model('planning_model');
		$data = [
			"MU_DESIGNATION" => $this->input->post("DESIGNATION"),
			"MU_QUANTITE" => $this->input->post("QUANTITE"),
			"BC_PE" => $this->input->post("BC")
		];
		echo $this->planning_model->saveMartierPr($data);
	}

	public function updateteminer()
	{
		$this->load->model('planning_model');
		$data = $this->input->post('data');
		$BC = $this->input->post("BC");
		echo $this->planning_model->updateJobCard(["JO_AV" => $data], ["JO_ID" => $BC]);
	}
	public function updatemetre()
	{
		$this->load->model('planning_model');
		$data = $this->input->post('data');
		$BC = $this->input->post("BC");
		echo $this->planning_model->editBonDeCommande($BC, ["BC_QUANTITEAPRODUIREENMETRE" => $data]);
	}
	public function updatPoid()
	{
		$this->load->model('planning_model');
		$data = $this->input->post('data');
		$BC = $this->input->post("BC");
		echo $this->planning_model->editBonDeCommande($BC, ["BC_POISENKGSAVECMARGE" => $data]);
	}
	public function terminerPo()
	{
		$po = $this->input->post('po');
		$this->load->model('planning_model');
		echo $this->planning_model->editBonDeCommande($po, ["BC_STATUT" => "TERMINER"]);
	}
	public function crateJobsMachine()
	{
		$machines = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$date = array("IMPRESSION_INJECTION" => 'JO_DATE_IMPRIMER', "HOOK" => 'JO_DATE_DECOUPE', "COUPE_EXTRUSION" => 'JO_DATE_DECOUPE', "IMPRESSION_EXTRUSION" => 'JO_DATE_IMPRIMER', "INJECTION" => 'JO_DATE', "EXTRUSION" => 'JO_DATE');
		//$date[$this->input->post('BC_STATUT')]=>$this->input->post('date')
		$this->load->model('planning_model');
		$debut = $this->input->post('debut');
		$dure = $this->input->post('dure');
		$BC = $this->input->post('BC');
		$machine = $this->input->post('machine');
		echo $this->planning_model->updateJobCard(["JO_DURE" => $dure, "JO_DEB" => $debut, $machines[$this->input->post('type')] => $machine], ["JO_ID" => $BC]);
	}

	public function updateJobsTerminer()
	{
		$this->load->model('planning_model');
		$data = $this->input->post('parent');
		echo $this->planning_model->updateJobCard(["JO_STATUT" => "TERMINER"], ["JO_ID" => $data]);
	}
	public function recalculedate()
	{
	}
	public function savedateLivre()
	{
		$this->load->model('planning_model');
		$date = $this->input->post('date');
		$po = $this->input->post('po');
		$quantite = $this->input->post('quantite');
		return $this->planning_model->savedate(["DL_PO" => $po, "DL_DATE" => $date,"DL_QUANTITE"=>$quantite]);
	}
	public function tableLivraison()
	{
		$this->load->model('planning_model');
		if (!isset($_GET['date'])) {
			$date = date('Y-m-d');
		} else {
			$date = $_GET['date'];
		}
		$datas = $this->planning_model->listedatedelivraison(['datedelivraison.DL_DATE' => $date]);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->DL_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->DL_QUANTITE;
			$sub_array[] = $row->BC_POISENKGSAVECMARGE;
			$data[] = $sub_array;
		}
		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function deleteJobsEx()
	{
		$this->load->model('planning_model');
		$IdDelete = $this->input->post('JO_ID');
		$machines = array("HOOK" => 'JO_MACHINE_COUPE', "IMPRESSION_INJECTION" => 'JO_MACHINE_PRINT', "IMPRESSION_EXTRUSION" => 'JO_MACHINE_PRINT', "COUPE_EXTRUSION" => 'JO_MACHINE_COUPE', "INJECTION" => 'JO_MACHINE', "EXTRUSION" => 'JO_MACHINE');
		$json = ["error" => "error"];
		$placeData = $this->planning_model->selectJobCard(["JO_ID" => $IdDelete]);

		$i = 0;
		if ($placeData) {
			$this->planning_model->deleteJobs(["JO_ID" => $IdDelete]);
			$type = $machines["$placeData->JO_TYPE"];
			$llData = $this->planning_model->standardQuery("SELECT * FROM `jobcart` WHERE `JO_ID` > $IdDelete AND $type = '$placeData->JO_MACHINE'");
			foreach ($llData as $key => $llData) {
				if ($i == 0) {
					$dt = new DateTime($placeData->JO_DATEDEDEBU . " " . $placeData->JO_DEB);
					$llData->JO_DATEDEDEBU = $placeData->JO_DATEDEDEBU;
					$llData->JO_DEB = $placeData->JO_DEB;
					$dt->modify("+" . $this->time_to_sec($llData->JO_DURE) . "seconde");
					$llData->JO_DATEFIN = $dt->format('Y-m-d');
					$llData->JO_FIN = $dt->format('H:i:s');
					$this->planning_model->updateJobCard($llData, ["JO_ID" => $llData->JO_ID]);
					$i++;
				} else {

					$llData->JO_DATEDEDEBU = $dt->format('Y-m-d');
					$llData->JO_DEB = $dt->format('H:i:s');
					$dt->modify('+ ' . $this->time_to_sec($llData->JO_DURE) . ' seconds');
					$llData->JO_DATEFIN = $dt->format('Y-m-d');
					$llData->JO_FIN = $dt->format('H:i:s');
					$this->planning_model->updateJobCard($llData, ["JO_ID" => $llData->JO_ID]);
				}
			}
		}
	}
	public function exportMachineData()
	{
		$this->load->model('planning_model');
		$param = [
			"JO_MACHINE" => $_GET['machine'],
			"JO_TYPE" => "EXTRUSION",
			"JO_STATUT" => "PLANIFIER"
		];
		$data = $this->planning_model->selectJobCardComm($param);
		$excel = "DATE\tPO\tJOBCAR\tCLIENT\tCODE CLIEN\tTYPY\tMAT\tDIMENSION\tIMPRESSION\tECHANTILLON\tMETRAGE\tPOIDS\tTERMINEE\tRESTE\tQUANTITE\tEX\tKGS\tREEL\tDATE DEBU\tDEBU\tDATE FIN\tFIN\tDURE\tRESTE TEMP\tOBS\n";
		$result = array();
		$Vitesse = 1;

		foreach ($data as $data) {
			$av = "";
			
			$av = (int) $data->BC_POISENKGSAVECMARGE - (int) $data->JO_AV;
			$excel .= "$data->JO_DATEDEDEBU\t$data->BC_PE\t$data->JO_ID\t$data->BC_CLIENT\t$data->BC_CODE\t$data->BC_TYPE\t$data->BC_TYPEMATIER\t$data->BC_DIMENSION\t$data->BC_IMPRESSION\t$data->BC_ECHANTILLON\t$data->BC_QUANTITEAPRODUIREENMETRE\t$data->BC_POISENKGSAVECMARGE\t$data->JO_AV\t$av\t$data->BC_QUNTITE\t$data->BC_PE\t$Vitesse\t$data->BC_PE\t$data->JO_DATEDEDEBU?\t$data->JO_DEB\t$data->JO_DATEFIN\t$data->JO_FIN\t$data->JO_DURE\t\t$data->JO_OBS\n";
			
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des tâche du : " . date("d-m-Y") . " " . $_GET['machine'] . ".xls");

		print $excel;
		exit;
	}
  
	public function exportMachineImpre()
	{
		$this->load->model('planning_model');
		$param = [
			"JO_MACHINE_PRINT" => $_GET['machine'],
			"JO_TYPE" => "IMPRESSION_EXTRUSION",
			"JO_STATUT" => "PLANIFIER"
		];
		$data = $this->planning_model->selectJobCardComm($param);
		$excel = "DATE\tPO\tJOBCAR\tCLIENT\tCODE CLIEN\tTYPE\tMAT\tDIMENSION\tIMPRESSION\tECHANTILLON\tMETRAGE\tPOIDS\tTERMINEE\tRESTE\tQUANTITE\tEX\tKGS\tREEL\tDATE DEBU\tDEBU\tDATE FIN\tFIN\tDURE\tRESTE TEMP\tOBS\n";
		$result = array();
		$Vitesse = 1;

		foreach ($data as $data) {
			$av = "";
			
			$av = (int) $data->BC_POISENKGSAVECMARGE - (int) $data->JO_AV;
			$excel .= "$data->JO_DATEDEDEBU\t$data->BC_PE\t$data->JO_ID\t$data->BC_CLIENT\t$data->BC_CODE\t$data->BC_TYPE\t$data->BC_TYPEMATIER\t$data->BC_DIMENSION\t$data->BC_IMPRESSION\t$data->BC_ECHANTILLON\t$data->BC_QUANTITEAPRODUIREENMETRE\t$data->BC_POISENKGSAVECMARGE\t$data->JO_AV\t$av\t$data->BC_QUNTITE\t$data->BC_PE\t$Vitesse\t$data->BC_PE\t$data->JO_DATEDEDEBU?\t$data->JO_DEB\t$data->JO_DATEFIN\t$data->JO_FIN\t$data->JO_DURE\t\t$data->JO_OBS\n";
		
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des tâche du : " . date("d-m-Y") . " " . $_GET['machine'] . ".xls");

		print $excel;
		exit;
	}
  

	public function exportMachineDataCoupe()
	{
		$this->load->model('planning_model');
		$param = [
			"JO_MACHINE_COUPE" => $_GET['machine'],
			"JO_TYPE" => "COUPE_EXTRUSION",
			"JO_STATUT" => "PLANIFIER"
		];
		$data = $this->planning_model->selectJobCardComm($param);
		$excel = "DATE\tPO\tJOBCAR\tCLIENT\tCODE CLIEN\tTYP\tMAT\tDIMENSIO\tIMPRESSION\tECHANTILLON\tMETRAGE\tPOIDS\tTERMINEE\tRESTE\tQUANTITE\tEX\tKGS\tREEL\tDATE DEBU\tDEBU\tDATE FIN\tFIN\tDURE\tRESTE TEMP\tOBS\n";
		$result = array();
		$Vitesse = 1;

		foreach ($data as $data) {
			$av = "";
			
			$av = (int) $data->BC_POISENKGSAVECMARGE - (int) $data->JO_AV;
			$excel .= "$data->JO_DATEDEDEBU\t$data->BC_PE\t$data->JO_ID\t$data->BC_CLIENT\t$data->BC_CODE\t$data->BC_TYPE\t$data->BC_TYPEMATIER\t$data->BC_DIMENSION\t$data->BC_IMPRESSION\t$data->BC_ECHANTILLON\t$data->BC_QUANTITEAPRODUIREENMETRE\t$data->BC_POISENKGSAVECMARGE\t$data->JO_AV\t$av\t$data->BC_QUNTITE\t$data->BC_PE\t$Vitesse\t$data->BC_PE\t$data->JO_DATEDEDEBU?\t$data->JO_DEB\t$data->JO_DATEFIN\t$data->JO_FIN\t$data->JO_DURE\t\t$data->JO_OBS\n";
			
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des tâche du : " . date("d-m-Y") . " " . $_GET['machine'] . ".xls");

		print $excel;
		exit;
	}

	public function printExtrusion()
	{
		$this->load->model('planning_model');
		$sql = "SELECT DISTINCT `JO_MACHINE` FROM `jobcart` WHERE `JO_ETAT` = 'on' AND `JO_TYPE` = 'EXTRUSION'  ORDER BY `JO_MACHINE` ASC";
		$machine = $this->planning_model->standardQuery($sql);
		$content = "<div><h2><b><u> PLANNING EXTRUSION DU : " . date('d / m / Y') . "</u></b></h2></div>";
		foreach ($machine as $key => $machine) {
		
			$param = [
				"JO_MACHINE" => $machine->JO_MACHINE,
				"JO_TYPE" => "EXTRUSION",
				"JO_STATUT" => "PLANIFIER",
				"JO_ETAT" =>'on'
			];
			$data = $this->planning_model->selectJobCardComm($param); 
			$content .= "<div class='cont'>
		<table>
			<thead class='thead'>
			<tr class='header'>
				<td colspan='8'>$machine->JO_MACHINE</td>
			</tr>
		</thead>
		<tbody>
		   <tr>
			  <td>DATE RECEPTION PO</td>
			  <td>REFERENCE CLIENT</td>
			  <td>CODE CLIENT</td>
			  <td>N°PO</td>
			  <td colspan='2'>POIDS EN KGS AVEC MARGE</td>
			  <td style='width:150px'>REFERENCES MATIERES (%)</td>
			  <td>QUANTITE EN KGS</td>
		   </tr>";
			foreach ($data as $key => $data) {
				$refence = "";
				$pmg = "";
				$result =  $this->planning_model->listeMartierPr(['BC_PE' => $data->BC_PE]);
				foreach ($result as $key => $result) {
					$refence .= $result->MU_DESIGNATION . " : " . $result->MU_QUANTITE . "<br/>";
					$pmg .= ($data->BC_POISENKGSAVECMARGE * $result->MU_QUANTITE) / 100;
					$pmg .= "<br/>";
				}
				$content .= "<tr>
			<td>$data->BC_DATE</td>
	        <td>$data->BC_CLIENT</td>
	        <td>$data->BC_CODE</td>
	        <td>$data->BC_PE</td>
			<td colspan='2'>$data->BC_POISENKGSAVECMARGE</td>
			<td >$refence</td>
			<td>$pmg</td>
			</tr>";
			}
			$content .= '</tbody></table></div>';
		}




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
		width:500px;
	
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

		$filename = "PLANNING EXTRUSION DU : ".date('d-m-Y');

		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}

	public function printJobs()
	{
		$job = $this->input->get('job');
		$this->load->model('planning_model');

		$data = $this->planning_model->selectJobCardCommS(["jobcart.JO_ID" => $job]);


		if ($this->input->get('place') == "PLASMAD") {
			$link = "PLASMAD";
		} else {
			$link = "MADAKEM";
		}

		$html = $this->load->view('Planning/printJobs', ["data" => $data, "logo" => $link], true);

		$filename = "Job_card N°: $job";
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
		//$this->load->view('Planning/printJobs',["data"=>$data]);


	}


	public function printExtrusionCoupe()
	{
		$this->load->model('planning_model');
		$sql = "SELECT DISTINCT `JO_MACHINE_COUPE` FROM `jobcart` WHERE `JO_ETAT` = 'on' AND `JO_TYPE` = 'COUPE_EXTRUSION' ORDER BY `JO_MACHINE_COUPE` ASC";
		$machine = $this->planning_model->standardQuery($sql);
		$content = "<div><h2><b><u> PLANNING COUPE DU : " . date('d / m / Y') . "</u></b></h2></div>";
		foreach ($machine as $key => $machine) {
			// $sql2 = "";
			// $sql2 = "SELECT * FROM `jobcart`,`bondecommande` WHERE `bondecommande`.`BC_PE` = `jobcart`.`BC_PE` AND `jobcart`.`JO_MACHINE_COUPE` ='$machine->JO_MACHINE_COUPE' AND `jobcart`.`JO_ETAT` ='on' ";
			$para = [
				"JO_MACHINE_COUPE"=>$machine->MA_DESIGNATION,
				"JO_TYPE"=>"COUPE_EXTRUSION",
				"JO_STATUT"=>"PLANIFIER",
				"JO_ETAT" =>'on'
			 ];
			$data = $this->planning_model->selectJobCardComm($para); //$this->planning_model->standardQuery($sql2);
			$content .= "<div class='cont'>
		<table>
			<thead class='thead'>
			<tr class='header'>
				<td colspan='8'>$machine->JO_MACHINE_COUPE</td>
			</tr>
		</thead>
		<tbody>
		   <tr>
			  <td>DATE RECEPTION PO</td>
			  <td>REFERENCE CLIENT</td>
			  <td>CODE CLIENT</td>
			  <td>N°PO</td>
			  <td colspan='2'>POIDS EN KGS AVEC MARGE</td>
			  <td colspan='2'>PIECES</td>
		   </tr>";
			foreach ($data as $key => $data) {
				$coupe = explode("P", $data->BC_QUNTITE);
				$content .= "<tr>
		<td>$data->BC_DATE</td>
        <td>$data->BC_CLIENT</td>
		<td>$data->BC_CODE</td>
		<td>$data->BC_PE</td>
		<td colspan='2'>$data->BC_POISENKGSAVECMARGE</td>
		<td colspan='2'>$coupe[0]</td>
		</tr>";
			}
			$content .= '</tbody></table></div>';
		}




		$html = '<!DOCTYPE html>
	<html>
	
	<head>
		<title></title>
	</head>
	<style>
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
		width:500px;
	
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

		$filename = "PLANNING COUPE DU : ".date('d-m-Y');

		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}

	public function printExtrusionInpression()
	{
		$this->load->model('planning_model');
		$sql = "SELECT DISTINCT `JO_MACHINE_PRINT` FROM `jobcart` WHERE `JO_ETAT` = 'on' AND `JO_TYPE` = 'IMPRESSION_EXTRUSION' ORDER BY `JO_MACHINE_PRINT` ASC";
		$machine = $this->planning_model->standardQuery($sql);
		$content = "<div><h2><b><u> PLANNING IMPRESSION DU : " . date('d / m / Y') . "</u></b></h2></div>";
		foreach ($machine as $key => $machine) {
			// $sql2 = "";
			// $sql2 = "SELECT * FROM `jobcart`,`bondecommande` WHERE `bondecommande`.`BC_PE` = `jobcart`.`BC_PE` AND `jobcart`.`JO_MACHINE_PRINT` ='$machine->JO_MACHINE_PRINT' AND `jobcart`.`JO_ETAT` ='on' ";
			$para = [
				"JO_MACHINE_PRINT"=>$machine->JO_MACHINE_PRINT,
                "JO_TYPE"=>"IMPRESSION_EXTRUSION",
                "JO_STATUT"=>"PLANIFIER",
				"JO_ETAT" =>'on'
			 ];
			$data = $this->planning_model->selectJobCardComm($para); //$this->planning_model->standardQuery($sql2);
			$content .= "<div class='cont'>
		<table>
			<thead class='thead'>
			<tr class='header'>
				<td colspan='6'>$machine->JO_MACHINE_PRINT</td>
			</tr>
		</thead>
		<tbody>
		   <tr>
			  <td>DATE RECEPTION PO</td>
			  <td>REFERENCE CLIENT</td>
			  <td>CODE CLIENT</td>
			  <td>N°PO</td>
			  <td colspan='2'>POIDS EN KGS AVEC MARGE</td>
		   </tr>";
			foreach ($data as $key => $data) {
				$content .= "<tr>
		<td>$data->BC_DATE</td>
        <td>$data->BC_CLIENT</td>
		<td>$data->BC_CODE</td>
		<td>$data->BC_PE</td>
		<td colspan='2'>$data->BC_POISENKGSAVECMARGE</td></tr>";
			}
			$content .= '</tbody></table></div>';
		}




		$html = '<!DOCTYPE html>
	<html>
	
	<head>
		<title></title>
	</head>
	<style>
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
		width:500px;
	
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

		$filename = "PLANNING IMPRESSION DU : ".date('d-m-Y');

		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}

	public function printMachineData()
	{

		$this->load->model('planning_model');
		$machine = $_GET['machine'];
		$sql2 = "SELECT * FROM `jobcart`,`bondecommande` WHERE `bondecommande`.`BC_PE` = `jobcart`.`BC_PE` AND `jobcart`.`JO_MACHINE` ='" . $_GET['machine'] . "' AND `jobcart`.`JO_ETAT` ='on' ";
		$data = $this->planning_model->standardQuery($sql2);

		$filename = "PLANNING  DU : ".date('d-m-Y');
		$content = "<div style='margin:left:150px'><h2><b><u>" . $machine . "</u></b></h2></div>";
		$content .= "<div style='margin:left:150px'><h2><b><u> EXTRUSION DU : " . date('d / m / Y') . "</u></b></h2></div>";
		$content .= "<div class='cont'>
				<table>
				<thead class='thead'>
				</thead>
				<tbody>
				   <tr>
					  <td>DATE REC PO</td>
					  <td>REFERENCE CLIENT</td>
					  <td>CODE CLIENT</td>
					  <td style='width:20px!important'>N°PO</td>
					  <td>DIMENSION</td>
					  <td>IMPRESSION</td>
					  <td style='width:20px!important'>METTRAGE</td>
					  <td>POIDS EN KGS AVEC MARGE</td>
					  <td  style='width:30px!important'>QUANTITE</td>
					  <td style='width:20px!important'>TYPE</td>
					  <td>DIM EXT</td>
					  <td>REFERENCES MATIERES (%)</td>
			          <td>QUANTITE EN KGS</td>
				   </tr>";
		foreach ($data as $key => $data) {

			$refence = "";
			$pmg = "";
			$result =  $this->planning_model->listeMartierPr(['BC_PE' => $data->BC_PE]);
			foreach ($result as $key => $result) {
				$refence .= $result->MU_DESIGNATION . " : " . $result->MU_QUANTITE . "<br/>";
				$pmg .= ($data->BC_POISENKGSAVECMARGE * $result->MU_QUANTITE) / 100;
				$pmg .= "<br/>";
			}
			$content .= "<tr>
				<td >$data->BC_DATE</td>
		        <td>$data->BC_CLIENT</td>
				<td>$data->BC_CODE</td>
				<td  style='width:20px!important'>$data->BC_PE</td>
				<td>$data->BC_DIMENSION</td>
				<td>$data->BC_IMPRESSION</td>
				<td style='width:20px!important'>$data->BC_QUANTITEAPRODUIREENMETRE</td>
				<td>$data->BC_POISENKGSAVECMARGE</td>
				<td style='width:30px!important'>$data->BC_QUNTITE</td>
				<td style='width:20px!important'>$data->BC_TYPE</td>
				<td>$data->BC_DIMENSIONPROD</td>
				<td>$refence</td>
				<td>$pmg</td>
				</tr>";
		}
		$content .= '</tbody></table></div>';
		$html = '<!DOCTYPE html>
		<html>
		
		<head>
			<title></title>
		</head>
		<style>
		body {
			margin :-30px;
			font-size:12px;
		}
		table{
			margin:0px;
			border: solid gray 1px;
		}
		 tr > td{
			 border: solid gray 1px;
			 padding: 3px;
			 margin: 0px;
			 width: 80px;
		 }
		
		 .container{
			width:100%;
		
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
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'Landscape');
		$dompdf->render();
		$dompdf->stream($filename);
	}


	public function printLivraison()
	{
		$this->load->model('planning_model');
		$date = $this->input->get('date');
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
				$excel .= "$valeur->BC_PE\t$valeur->BC_CODE\t$valeur->BC_DIMENSION\t$valeur->DL_QUANTITE\t$valeur->BC_POISENKGSAVECMARGE\n";
			}
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Liste des livraison du : " . $date . ".xls");
		print $excel;
		exit;
	}

	public function livraison(){
		$this->load->model('planning_model');
		$this->load->model('magasiner_model');
		$po="";
        if(!empty($_GET['po']) AND !empty($_GET['date']) ){
			$date = $_GET['date'];
			$po = $_GET['po'];
			$datas = $this->planning_model->listebon(["BC_DATE"=>$date,"BC_PE"=>$po]);
		}else if(!empty($_GET['po'])){
			$po = $_GET['po'];
			$datas = $this->planning_model->listebon(["BC_PE"=>$po]);
		}else if(!empty($_GET['date'])){
			$date = $_GET['date'];
			$datas = $this->planning_model->listebon(["BC_DATE"=>$date]);
		}else{
			$date = date('Y-m-d');
			$datas = $this->planning_model->listebon(["BC_DATE"=>$date]);
		}
		
		
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_QUNTITE;
			if(empty($po)){
                $po = $row->BC_PE;
			}
            $totalQC = 0;
			$control = $this->production_model->control(["C_PO"=> $row->BC_PE]); 
			foreach ($control as $key => $control) {
				$totalQC += $control->C_CHOIX;
			}
			$qttsortie = 0;
			$sortie = $this->magasiner_model->dataentre_produit_fini("(BC_ID = '$po' OR EF_REMARQUE ='$po' ) AND EF_TYPE='sortie'");
			foreach ($sortie as $key => $sortie) {
				$qttsortie += $sortie->EF_QUANTITE;
			}

			$sub_array[] = $totalQC;
			$sub_array[] = $qttsortie;
			$qtt = explode(" ",$row->BC_QUNTITE);
			$sub_array[] = trim($qtt[0])- $qttsortie;
			$sub_array[] = "<a href='' class='btn btn-info btn-sm w-100'><i class='fa fa-info'></i>&nbsp;Info</a>";
			$data[] = $sub_array;
		}
		$output = array("data" => $data);
		echo json_encode($output);
	}
	public function commandeSpecifique($type, $anne = null, $mois = null)
	{
		$this->load->model('commercial_model');
		$data = array();

		if (isset($_GET['debut']) && isset($_GET['fin']) and !empty($_GET['debut']) and !empty($_GET['fin'])) {
			$debut = $_GET['debut'];
			$fin = $_GET['fin'];
			if ($type == 'TOUT') {
				$requette = " BC_DATE between '" . $debut . "' AND '" . $fin . "'";
			} else {
				$requette = "(BC_TYPEPRODUIT like  '" . $type . "') AND  BC_DATE between '" . $debut . "' AND '" . $fin . "'";
			}

			$datas = $this->commercial_model->bondeType($requette);
		} else {

			if ($anne != null) {
				if ($type == 'TOUT') {
					$requette = [];
				} else {


					$requette = [

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
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_OBSERVATION;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_STATUT;

			$sub_array[] =
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function dataSuivie(){
			$this->load->model('planning_model');
		$data = array();
		 if(!empty($_GET['po']) AND !empty($_GET['date']) ){
			$date = $_GET['date'];
			$po = $_GET['po'];
			$datas = $this->planning_model->listebon(["BC_DATE"=>$date,"BC_PE"=>$po]);
		}else if(!empty($_GET['po'])){
			$po = $_GET['po'];
			$datas = $this->planning_model->listebon(["BC_PE"=>$po]);
		}else if(!empty($_GET['date'])){
			$date = $_GET['date'];
			$datas = $this->planning_model->listebon(["BC_DATE"=>$date]);
		}else{
			$date = date('Y-m-d');
			$datas = $this->planning_model->listebon(["BC_DATE"=>$date]);
		}


			foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->BC_DATE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_IMPRESSION;
			$sub_array[] = $row->BC_QUANTITEAPRODUIREENMETRE;
			$sub_array[] =  $row->BC_POISENKGSAVECMARGE;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$sub_array[] = $row->BC_ROULEAUX;
			$sub_array[] = $row->BC_STATUT;
			if($row->BC_OBSERVATION!=""){
			$sub_array[] ='
<button type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#'.$row->BC_PE.'">
  OBSERVATION
</button>
<div class="modal fade" id="'.$row->BC_PE.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Observation PO N° : '.$row->BC_PE.'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">'
        .$row->BC_OBSERVATION.
      '</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>';
}else{
	$sub_array[] ='<button type="button" class="btn btn-primary w-100">
  OBSERVATION (vide)
</button>';
}
			
			
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);

	}

	public function dataExportSuivie(){
		$this->load->model('planning_model');
	$data = array();
	 if(!empty($_GET['po']) AND !empty($_GET['date']) ){
		$date = $_GET['date'];
		$po = $_GET['po'];
		$datas = $this->planning_model->listebon(["BC_DATE"=>$date,"BC_PE"=>$po]);
	}else if(!empty($_GET['po'])){
		$po = $_GET['po'];
		$datas = $this->planning_model->listebon(["BC_PE"=>$po]);
	}else if(!empty($_GET['date'])){
		$date = $_GET['date'];
		$datas = $this->planning_model->listebon(["BC_DATE"=>$date]);
	}else{
		$date = date('Y-m-d');
		$datas = $this->planning_model->listebon(["BC_DATE"=>$date]);
	}
	$excel = "\tSUIVIE COMMANDES\n\n";
	$excel .= "\tDATE\tPO\tCLIENT\tDIMENSION\tIMPRESSION\tMETRAGE\tPOIDS\tQUANT\tTYPE\tNOMBRE RLX\n";
		foreach ($datas as $row) {
			$excel .= "\t$row->BC_DATE\t$row->BC_PE\t$row->BC_CODE\t$row->BC_DIMENSION\t$row->BC_IMPRESSION\t$row->BC_QUANTITEAPRODUIREENMETRE\t$row->BC_POISENKGSAVECMARGE\t$row->BC_QUNTITE\t$row->BC_TYPEPRODUIT\t$row->BC_ROULEAUX\n";
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=SUIVIE PO.xls");

		print $excel;
		exit;

	

      }
}
