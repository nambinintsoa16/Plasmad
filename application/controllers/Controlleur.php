<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class controlleur extends My_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}
	public function index()
	{
		$this->render_view('controlleur/Accueil');
	}
    
    public function dataSuivie(){

		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		$datas = array();
		if( !empty($debut)  && !empty($fin)){
			$datas = $this->Controlleur_model->select_sortie_materiel_PO("MS_DATE BETWEEN '".$debut."' AND '".$fin."'");
		}else if(!empty($debut)){
			$datas = $this->Controlleur_model->select_sortie_materiel_PO("MS_DATE like '".$debut."'");
		}else{
			$datas = $this->Controlleur_model->select_sortie_materiel_PO("MS_DATE like '".date('Y-m')."%'");
		}

		$data = array();
		foreach ($datas as $key => $row) {
			$sub_array = array();

										 $this->load->model('compta_model');
        								$dextrusion =  $this->compta_model->extrusion(['EX_BC_ID'=>$row->BC_PE]);
        								$extrusion_inpression = $this->compta_model->extrusion_inpression(['extrusion_inpression.BC_ID'=>$row->BC_PE]);
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
        						$extrusion_coupe = $this->compta_model->extrusion_coupe(['extrusion_coupe.BC_ID'=>$row->BC_PE]);
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
                               $control = $this->compta_model->controlDatas("C_PO ='$row->BC_PE' ORDER BY C_ID DESC");

							   if($control){
								   	foreach($control as $control){
								   			$piece -= (int) $control->C_CHOIX;
								   	}
									
									
							   }

								$matierinression = $this->compta_model->matierinression(['MI_PO'=>$row->BC_PE]);
								$matier = $this->compta_model->stock_materiel(["LI_REFERENCE"=>$row->BC_PE,"LI_TYPE"=>"sortie"]);
								$totalSortie=0;
								$prixTotal= 0;
								$detaiMAt = "";
							$x= 0;
								foreach($matier as $matier){
									$totalSortie += $matier->LI_QUANTITE;
									
									if($x !=0 ){
										$detaiMAt .= "/".$matier->LI_MATIER;
										$x++;
									}else{
										$detaiMAt .=$matier->LI_MATIER;
										$x++;
									}
									
								}
			$sub_array[] =	$row->BC_PE;	
			$sub_array[] =  $row->BC_TYPEPRODUIT;			
			$sub_array[] = number_format($totalSortie , 2, ',', ' ');
			$sub_array[] = number_format($poids, 2, ',', ' ');
			$sub_array[] = number_format($totalSortie-$poids, 2, ',', ' ');
			$sub_array[] = number_format($sortir, 2, ',', ' ');
			$sub_array[] = number_format($entreInpress, 2, ',', ' ');
			$sub_array[] = number_format($sortir-$entreInpress, 2, ',', ' ');
			if($entreInpress != 0){
			   $sub_array[] = number_format($entreInpress, 2, ',', ' ');
			}else{
               $sub_array[] = number_format($sortir, 2, ',', ' ');
			}
			
			$sub_array[] = number_format($poidsSomme, 2, ',', ' ');		
			if($entreInpress != 0){
			$sub_array[] = number_format($entreInpress-$poidsSomme, 2, ',', ' ');		
			}else{
               $sub_array[] = number_format($sortir-$poidsSomme, 2, ',', ' ');
			}
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
    }



	public function page()
	{

		$page = $this->input->post('page');
		switch ($page) {
			case 'SURPLUS':
			   $this->load->view('controlleur/surplus/Accueil');
			break; 
			case 'SUIVIE PO':
			   $this->load->view('controlleur/suivie/suiviePo');
			break; 
			case 'LISTE DES RETOURS':
			
			break;

			case 'STOCK RECYCLE':
				$dechet =$this->Controlleur_model->selectStockdechet();
				$data = ["data"=>$dechet];
				$this->load->view('controlleur/recycle/stockDechet',$data);
			 break;
			
			 case 'ENTRE MACHINE':
				$this->load->view('controlleur/recycle/historiqueDeDechet');
			 break;
			 case 'SORTIE MACHINE':
				$this->load->view('controlleur/recycle/historiqueDeLivraison');
			 break;
			 case 'CONTROLLE QUALITE':
				$this->load->view('controlleur/qc/Accueil');
			 break;	
			case 'RECYCLE':
			   $this->load->view('controlleur/recycle/Accueil');
			break;
			case 'VALIDER SORTIE MATIER':
			   $this->load->view('controlleur/matier/validerMatier');
			break;
			
			case 'RECAP COSTING':
				$date = $this->input->post('date');
				$clients = $this->input->post('client');
				if ($date == "") {
					$date = date('Y-m');
					if ($clients != "") {
						$requette = "BC_CODE LIKE '$clients'";
					} else {
						$requette = "BC_DATE LIKE '%$date%'";
					}
				} else {
					$temp = explode("-", $date);
					$date = $temp[0] . "-" . $temp[1];
					$requette = "BC_DATE LIKE '%$date%'";
				}
				$client = $this->compta_model->lisClientDuMois(($requette));
				$reponse = [
					"data" => $client,
					"date"=>$date
				];
				$this->load->view('comptabiliter/recap_costing', $reponse);
				break;
			case 'COSTING':

				$this->load->view('comptabiliter/constingContent');
				break;
			case 'SUIVIE MACHINE':
				$this->load->model('planning_model');
				$data = [
					"machine" => $this->planning_model->listemachinex()
				];
				$this->load->view('controlleur/suvieMachine', $data);
				break;
			case 'DAILY PRODUCTION FOLLOW UP':
				$this->load->view('controlleur/suivieProd');
				break;
			case 'recapMachine':
				$date = $this->input->post('date');
				$machine = $this->input->post('machine');

				if ($date == "") {
					$date = date("Y-m-d");
				}
				if ($machine == "") {
					$machine = "MACHINE 1";
				}


				$data = [
					"machine" => $machine,
					'date' => $date

				];
				$this->load->view('controlleur/accueilSuivieMachine', $data);
				break;
			case 'dataRepotFollow':
				$dateArray = array();
				$tableArray = array();
				$in = "";
				$date = "2021-11";
				$po = $this->input->get('po');
				$type = $this->input->get('type');
				if ($type == "") {
					$type = "PE";
				}
				$findate = $this->input->get('fin');
				$i = 0;
				if ($date == "") {
					if ($po != "") {
						$requette = "BC_PE LIKE '%$po%' ORDER BY BC_DATE ASC";
					} else {
						$date = date('Y-m');
						$extru = $this->compta_model->extrusion("EX_DATE like '$date%' AND BC_TYPEMATIER = '$type'  ORDER BY EX_DATE ASC");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '$date%' AND BC_TYPEMATIER = '$type'  ORDER BY ED_DATE ASC");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '$date%' AND BC_TYPEMATIER = '$type'  ORDER BY EI_DATE ASC");
						foreach ($extru as $key => $extru) {
							if (!in_array($extru->EX_BC_ID, $tableArray)) {
								array_push($tableArray, $extru->EX_BC_ID);
								array_push($dateArray, $extru->EX_DATE);
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
						if ($in != "") {
							$requette = "$in ORDER BY BC_DATE ASC";
						} else {
							$requette = "0";
						}
					}
				} else {

					if ($findate != "") {
						$extru = $this->compta_model->extrusion("EX_DATE  BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE BETWEEN '$date' AND '$findate' AND BC_TYPEMATIER = '$type'");
					} else {
						$dateTEmp = explode("-", $date);
						$date = $dateTEmp[0] . "-" . $dateTEmp[1];
						$extru = $this->compta_model->extrusion("EX_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
						$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
						$imprm = $this->compta_model->extrusion_inpression("EI_DATE like '%$date%' AND BC_TYPEMATIER = '$type'");
					}
					foreach ($extru as $key => $extru) {
						if (!in_array($extru->EX_BC_ID, $tableArray)) {

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
							if ($i != 0) {
								$in .= " OR BC_PE like '$imprm->BC_ID'";
							} else {
								$in .= "BC_PE like  '$imprm->BC_ID'";
								$i++;
							}
						}
					}

					$date = date('Y-m');
					if ($in != "") {
						$requette = "$in ORDER BY BC_DATE ASC";
					} else {
						$requette = "0";
					}
				}


				$data = ["data" => $this->compta_model->lisPeDuMois(($requette))];
				$this->load->view('controlleur/dataRepotFollow', $data);
				break;
			case 'recapMachine':
				$this->load->model('planning_model');
				$date = $this->input->post('date');
				$specification = $this->input->post("specification");
				$data = [
					"machine" => $this->planning_model->listemachinex(),
					"date" => $date,
					"machine" => $this->input->post('machine')
				];
				if ($specification == "EXTRUSION") {
					$this->load->view('controlleur/recapExtrusion', $data);
				} else if ($specification == "IMPRESSION_EXTRUSION") {
					$this->load->view('controlleur/suiVieMachineImpression', $data);
				} else if ($specification == "COUPE_EXTRUSION") {
					$this->load->view('controlleur/suivieCoupeExtrusion', $data);
				}
				break;
			case 'SUIVIE PRODUCTION':
				$this->load->view('controlleur/suiviProdAccueil');
				break;
			case 'STATUT PO':
				$date = $this->input->post('debut');
				$fin  = $this->input->post('fin');
				if ($date == "") {
					$date = date('Y-m');
				}
				if($fin !=""){
					$reponse = $this->compta_model->lisPeDuMois("(BC_DATE BETWEEN '$date' AND '$fin') ORDER BY BC_DATE ASC");
				}else{
				  $reponse = $this->compta_model->lisPeDuMois("BC_DATE like '%$date%' ORDER BY BC_DATE ASC");	
				}
               
				$data = [
					"data" =>  $reponse
				];
				$this->load->view('controlleur/listePoStatut',	$data);
				break;
			case 'DONNE DE PRODUCTION':
				$this->load->view('production/extrusiondata');

				break;
			case 'SUIVIE PLANNING':
				$this->load->view('controlleur/suivuitProduction');
				break;
			case 'SUIVIE MATIERE':
				$this->load->view('controlleur/Matier/Accueil');

				break;
			case 'RECAP MATIERE PREMIERE':
				$this->load->view('controlleur/Matier/recap');
				break;
			case 'STOCK MATIERE':
				$this->load->view('controlleur/produit/Accueil');
				break;
			case 'STOCK MATIERE PREMIERE':
				$this->load->view('controlleur/Stock_matierPremier');
				break;
			case 'LISTE DES SORTIES':
				$this->load->view('controlleur/produit/sortieProduit');
				break;
			case 'LISTE DES ENTREES MATIERE PREMIERE':
				$this->load->view('controlleur/matier/entreMatier');
				break;
			case 'LISTE DES SORTIES MATIERE PREMIERE':
				$this->load->view('controlleur/matier/sortieMatier');
				break;
			case 'STOCK PRODUIT FINI':
				$this->load->view('controlleur/AccueilFini');
				break;
			case 'MODIFIER TRANSACTION':
				$this->load->view('controlleur/produit/menuModifFini');
				break;
			case 'REINITIALISER STOCK':
				$this->load->view('controlleur/produit/InitStock');
				break;	
			case 'ENTREE':
				$this->load->view('Magasiner/Entree');
			break;
			case 'SUIVIE LIVRAISON':
				$this->load->model('Magasiner_model');
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
					"date" => $date,
					"po" => $po

				];
				$this->load->view('controlleur/produit/historique',$data);
			break;
			case 'SUIVI PRODUIT FINI':
					$this->load->view('controlleur/produit/MenuFini');
					break;	
				 case 'ENCRES ET SOLVANTS':
            		$this->load->view('controlleur/Production/modifEncreEtSolvant');
            	break;
			default:
			
				break;
		}
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
	public function tableProcessus()
	{
		$page = $this->input->post('page');
		$this->load->model('planning_model');
		switch ($page) {
			case 'EXTRUSION':
				$this->load->view('controlleur/Planning/processus_extrusion');
				break;
			case 'INJECTION':
				$this->load->view('controlleur/Planning/processus_injection');
				break;
			default:
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "EXTRUSION", "MA_STATUT" => "on"])
				];
				$this->load->view('controlleur/Planning/tableExtrusion', $data);
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
				$this->load->view('controlleur/Planning/tableExtrusion', $data);
				break;
			case 'COUPE':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "COUPE_EXTRUSION", "MA_STATUT" => "on"])
				];
				$this->load->view('controlleur/Planning/tableExtrusionCoup', $data);
				break;
			case 'IMPRESSION':
				$data = [
					"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION", "MA_STATUT" => "on"])
				];
				$this->load->view('controlleur/Planning/tableleEXtrusionInpression', $data);
				break;
			default:
				break;
		}
	}

	public function lisete_sortie_materiel()
	{
		$this->load->model('controlleur_model');
		$origin = $this->input->get('origin');
		if ($origin == "") {
			$origin = "PLASMAD_MAGASIN";
		}
		$debut = $this->input->get('dateCost');
		$fin = $this->input->get('dateCostFin');
		$reference = $this->input->get('reference');

		if ($reference != "" && $debut != "" && $fin != "") {

			$sql = "LI_ORIGIN like '$origin' AND MS_MATIER like '$reference' AND MS_DATE BETWEEN '$debut' AND '$fin'";
		} else if ($reference != "" && $debut != "") {

			$sql = "LI_ORIGIN like '$origin' AND  MS_MATIER like '$reference'  AND MS_DATE LIKE '$debut' ";
		} else if ($reference != "") {
			$sql = "LI_ORIGIN like '$origin' AND  MS_MATIER like '$reference'";
		} else if ($debut != "" && $fin != "") {
			$sql = "LI_ORIGIN like '$origin' AND MS_DATE BETWEEN '$debut' AND '$fin'";
		} else if ($debut != "") {
			$sql = "LI_ORIGIN like '$origin' AND MS_DATE LIKE '$debut' ";
		} else {
			$sql = "LI_ORIGIN like '$origin'";
		}
		$type = "";
		$datas = $this->controlleur_model->sortie_materiel($sql);
		$matiere = array();
		$i = 0;
		foreach ($datas as $key => $datas) {
			if (array_key_exists($datas->MS_MATIER, $matiere)) {
				$matiere[$datas->MS_MATIER]['quantite'] += $datas->LI_QUANTITE;
				$matiere[$datas->MS_MATIER]['PO'] .= " / " . $datas->LI_REFERENCE;
				$i++;
			} else {
				$matiere[$datas->MS_MATIER]['quantite'] = $datas->LI_QUANTITE;
				$matiere[$datas->MS_MATIER]['PO'] = $datas->LI_REFERENCE;
				$i++;
			}
		}
		$data = array();
		foreach ($matiere as $key => $matiere) {
			$sub_array = array();
			$sub_array[] = $key;
			$sub_array[] = $matiere['quantite'];
			$sub_array[] = "KG";
			$sub_array[] = $matiere['PO'];
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
public function exportStockSortieRecap(){



	$this->load->model('controlleur_model');
		$origin = $this->input->get('origin');
		if ($origin == "") {
			$origin = "PLASMAD_MAGASIN";
		}
		$debut = $this->input->get('dateCost');
		$fin = $this->input->get('dateCostFin');
		$reference = $this->input->get('reference');

		if ($reference != "" && $debut != "" && $fin != "") {

			$sql = "LI_ORIGIN like '$origin' AND MS_MATIER like '$reference' AND MS_DATE BETWEEN '$debut' AND '$fin'";
		} else if ($reference != "" && $debut != "") {

			$sql = "LI_ORIGIN like '$origin' AND  MS_MATIER like '$reference'  AND MS_DATE LIKE '$debut' ";
		} else if ($reference != "") {
			$sql = "LI_ORIGIN like '$origin' AND  MS_MATIER like '$reference'";
		} else if ($debut != "" && $fin != "") {
			$sql = "LI_ORIGIN like '$origin' AND MS_DATE BETWEEN '$debut' AND '$fin'";
		} else if ($debut != "") {
			$sql = "LI_ORIGIN like '$origin' AND MS_DATE LIKE '$debut' ";
		} else {
			$sql = "LI_ORIGIN like '$origin'";
		}
		$type = "";
		$datas = $this->controlleur_model->sortie_materiel($sql);
		$matiere = array();
		$i = 0;

		foreach ($datas as $key => $datas) {
			if (array_key_exists($datas->MS_MATIER, $matiere)) {
				$matiere[$datas->MS_MATIER]['quantite'] += $datas->LI_QUANTITE;
				$matiere[$datas->MS_MATIER]['PO'] .= " / " . $datas->LI_REFERENCE;
				$i++;
			} else {
				$matiere[$datas->MS_MATIER]['quantite'] = $datas->LI_QUANTITE;
				$matiere[$datas->MS_MATIER]['PO'] = $datas->LI_REFERENCE;
				$i++;
			}
		}
		




		$excel = "RCAP SORTIE STOCK MATIER PREMIERES " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "REFERENCE\QUANTITE\UNITE\N PO\tQUANTITE\n";
			foreach ($matiere as $key => $matiere) {
			
			 $excel .= "$key\t".$matiere['quantite']."\tKG\t".$matiere['PO']."\n";
			
		}
	
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;

}

public function printStockSortieRecap(){
$content = "";
$this->load->model('controlleur_model');
		$origin = $this->input->get('origin');
		if ($origin == "") {
			$origin = "PLASMAD_MAGASIN";
		}
		$debut = $this->input->get('dateCost');
		$fin = $this->input->get('dateCostFin');
		$reference = $this->input->get('reference');

		if ($reference != "" && $debut != "" && $fin != "") {
            $stringdate = "RECAP SORTIE STOCK MATIER ".$reference." DU ".$debut."AU".$fin;
			$sql = "LI_ORIGIN like '$origin' AND MS_MATIER like '$reference' AND MS_DATE BETWEEN '$debut' AND '$fin'";
		} else if ($reference != "" && $debut != "") {
			$stringdate = "RECAP SORTIE STOCK MATIER ".$reference." DU ".$debut;
			$sql = "LI_ORIGIN like '$origin' AND  MS_MATIER like '$reference'  AND MS_DATE LIKE '$debut' ";
		} else if ($reference != "") {
			$stringdate = "RECAP SORTIE STOCK MATIER ".$reference;
			$sql = "LI_ORIGIN like '$origin' AND  MS_MATIER like '$reference'";
		} else if ($debut != "" && $fin != "") {
			$stringdate = "RECAP SORTIE STOCK MATIER  DU ".$debut." AU ".$fin;
			$sql = "LI_ORIGIN like '$origin' AND MS_DATE BETWEEN '$debut' AND '$fin'";
		} else if ($debut != "") {
			$stringdate = "RECAP SORTIE STOCK MATIER ".$reference." DU ".$debut;
			$sql = "LI_ORIGIN like '$origin' AND MS_DATE LIKE '$debut' ";
		} else {
			$stringdate = "RECAP SORTIE STOCK MATIER ";
			$sql = "LI_ORIGIN like '$origin'";
		}
		$type = "";
		$datas = $this->controlleur_model->sortie_materiel($sql);
		$matiere = array();
		$i = 0;

		foreach ($datas as $key => $datas) {
			if (array_key_exists($datas->MS_MATIER, $matiere)) {
				$matiere[$datas->MS_MATIER]['quantite'] += $datas->LI_QUANTITE;
				$matiere[$datas->MS_MATIER]['PO'] .= " / " . $datas->LI_REFERENCE;
				$i++;
			} else {
				$matiere[$datas->MS_MATIER]['quantite'] = $datas->LI_QUANTITE;
				$matiere[$datas->MS_MATIER]['PO'] = $datas->LI_REFERENCE;
				$i++;
			}
		}

		$content .= "<div class='cont w-100'>
  <table>
			<thead class='thead w-100'>
			<tr class='header'>
				<td colspan='4'>".$stringdate."\n</td>
			</tr>
		</thead>
		<tbody>
		   <tr>
		   
		  	 <th>REFERENCE</th>
			 	 <th>QUANTITE</th>
				 <th>UNITE</th>
			 	 <th>N°PO</th>
   
		</tr>";

		foreach ($matiere as $key => $matiere) {
			$content .= "<tr>
		    	<td>".$key."</td>
				<td>".$matiere['quantite']."</td>
				<td style='whidth:40px!important'>KG</td>
				<td style='whidth:300px!important'>".$matiere['PO']."</td>";
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
		
	 }
	 .cont{
		 display: block;
		 margin:15px;
		
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
	public function autocompleteSortie()
	{
		$this->load->model('planning_model');
		$resultat = array();
		$data = $this->planning_model->autocompleteStock($this->input->get('term'));
		foreach ($data as $key => $data) {
			$resultat[] = $data->ST_DESIGNATION;
		}
		echo json_encode($resultat);
	}
	public function pageMachine()
	{
		$this->load->model('planning_model');
		$type = $this->input->get('type');
		$date = $this->input->get('date');
		$fin = $this->input->get('fin');
		if ($date == "") {
			$date = date("Y-m-d");
		}
		if ($type == "EXTRUSION") {

			$data = [
				"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "EXTRUSION", "MA_STATUT" => "on"]),
				"date" =>$fin ,
				'fin' => $date
			];
			$this->load->view("controlleur/suivieMachieExtrusion", $data);
		} else if ($type == "IMPRESSION") {

			$data = [
				"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION", "MA_STATUT" => "on"]),
				"date" => $date,
				'fin' => $fin
			];

			$this->load->view("controlleur/suiVieMachineImpressions", $data);
		} else if ($type == "COUPE") {
			$data = [
				"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "COUPE_EXTRUSION", "MA_STATUT" => "on"]),
				"date" => $date,
				'fin' => $fin
			];
			$this->load->view("controlleur/suivieCoupe", $data);
		}
	}




function time_to_sec($time)
	{
		list($h, $m, $s) = explode(":", $time);
		$seconds = 0;
		$seconds += (intval($h) * 3600);
		$seconds += (intval($m) * 60);
		$seconds += (intval($s));
		return $seconds;
	}
function se_to_time($sec)
	{
		return sprintf('%02d:%02d:%02d', floor($sec / 3600), floor($sec / 60 % 60), floor($sec % 60));
	}


public function exportDataMachine()
	{
		$this->load->model('planning_model');
		$this->load->model('compta_model');
		$type = $this->input->get('type');
		$date = $this->input->get('fin');
		$fin = $this->input->get('debut');
		if ($date == "") {
			$date = date("Y-m-d");
		}
if ($type == "EXTRUSION") {


		$machine =$this->planning_model->listemachines(["MA_SPECIFIQUE" => "EXTRUSION", "MA_STATUT" => "on"]);	
		$ffect = 0; $i= 0 ;


	    $excel = "RCAP EXTRUSION" . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "\tMACHINE\tPOIDS SORTIE\tPOIDS DECHET\tTAUX DE REBUT\tTEMPS DE PRODUCTION\n";		
	foreach ($machine as $key => $machine){
           $this->load->model('compta_model');
           if($fin!=""){
			  $extru = $this->compta_model->extrusion("(EX_DATE BETWEEN '$date' AND '$fin') AND EX_N_MACH like '$machine->MA_DESIGNATION'");
		   }else{
			  $extru = $this->compta_model->extrusion("EX_DATE like '%$date%' AND EX_N_MACH like '$machine->MA_DESIGNATION'");
		   }
         
           $poid = 0;
           $deche = 0;
           $dure =0;
          
           foreach ($extru as $key => $extru) {
           	if($extru->EX_PDS_SOMME!=""){
 				$poid += $extru->EX_PDS_SOMME;
           	}
          	
          	if($extru->EX_DECHETS!=""){
 				$deche += $extru->EX_DECHETS;
           	}
          
				$dure +=$this->time_to_sec($extru->EX_DUREE);
          
           }
           if($poid!=0){
           	   $rebut = ($deche*100 )/$poid;
               $ffect +=  $rebut;
           }else{
           	 $rebut = 0;
           }
        
           $i++;
      $excel .= "\t".$machine->MA_DESIGNATION."\t".$poid."\t".$deche."\t".number_format($rebut,'2')."\t".$this->se_to_time($dure)."\n";
          }
			
		
	
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;


		} else if ($type == "IMPRESSION") {


		$machine = $this->planning_model->listemachines(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION", "MA_STATUT" => "on"]);
	

					
 $excel = "RCAP IMPRESSION" . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "\tMachine\tPoids/kgs\tMetrage\tHours\n";		

			$dateX = $date;
		$ffect = 0;
		$i = 0;
		foreach ($machine as $key => $machine){
			if ($fin != "") {
				$dataEx = $this->Controlleur_model->dataImpressionExtrusion("(EI_DATE BETWEEN '$date' AND '$fin') AND EI_MACH like '$machine->MA_DESIGNATION'");
			} else {
				$dataEx = $this->Controlleur_model->dataImpressionExtrusion("EI_DATE like '%$date%' AND EI_MACH like '$machine->MA_DESIGNATION'");
			}
		$sortie = 0;	
        $DECHETS = 0;
		$metrage = 0;
		$heure = 0;

			foreach ($dataEx as $dataEx) {
				$heure += $this->Controlleur_model->time_to_sec($dataEx->EI_DUREE);
				$sortie += $dataEx->EI_PDS_SOMME;
				$metrage += $dataEx->EI_METRE_SOMME;
				if ($DECHETS != "") {
					$DECHETS += $dataEx->EI_DECHET;
				}
			}
	
			 $excel .= "\t".$machine->MA_DESIGNATION."\t". $sortie."\t". $metrage ."\t".$this->se_to_time($heure)."\n";
						
	}	
	
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;





		} else if ($type == "COUPE") {
		
		$machine = $this->planning_model->listemachines(["MA_SPECIFIQUE" => "COUPE_EXTRUSION", "MA_STATUT" => "on"]);
					
        $excel = "RCAP COUPE" . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "\tMachine\tPoids/kgs\tMetrage\tPCS\tDECHET\tHours\n";


			$i = 0;
		foreach ($machine as $key => $machine) {
		$piece = 0;
	 	$metrage = 0;		
		$DECHETS = 0;
		$metrage = 0;
		$heure = 0;
		$ffect = 0;
		$sortie = 0;

			if ($fin != "") {
				$coupe = $this->compta_model->extrusion_coupe("(ED_DATE BETWEEN  '$date' AND '$fin') AND  ED_MACHINE like '$machine->MA_DESIGNATION'");
			} else {
				$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '%$date%' AND  ED_MACHINE like '$machine->MA_DESIGNATION'");
			}



			foreach ($coupe as $key => $coupe) {
				if ($coupe->ED_POID_ENTRE != "") {
					$poidEntre = explode("+", $coupe->ED_POID_ENTRE);
					foreach ($poidEntre as $key => $poidEntre) {
						$sortie += $poidEntre;
					}
				}
                $metrage += $coupe->ED_METRAGE_SOMME;
				$piece += $coupe->ED_1ER_CHOIX_SOMME;
				$heure += $this->Controlleur_model->time_to_sec($coupe->ED_DURE);
				$DECHETS += $coupe->ED_DECHE_COUPE;
			}
		
$excel .= "\t".$machine->MA_DESIGNATION ."\t". $sortie."\t". $metrage ."\t". $piece."\t".$DECHETS."\t".$this->se_to_time($heure)."\n";
		

	}		


		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;
		}
	}
	public function editImprimermatier(){
	    $this->load->model('production_model');
		$id = $this->input->post('id');
		$imp  = $this->production_model->matierUtiliser(["MI_PO" => $id]);
		$data = [
			"data" => $imp,
			"po"=>$id
		];
		echo json_encode($this->load->view('formulaire/modiPrintMatierControlleur', $data, true));

}

public function printStockEntre()
	{

		$this->load->model('Magasiner_model');
		$content ="";
		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		if(!empty($debut) && !empty($fin)){
			$stringdate = "LISTE ENTRE MATIEREES  DU ".$debut." AU " .$fin;
			$datas = $this->magasiner_model->entree_materiel_Mag("EM_DATE BETWEEN  '$debut'  AND '$fin'");
		}else if(!empty($debut)){
			$stringdate = "LISTE ENTRE MATIEREES  DU ".$debut;
			$datas = $this->magasiner_model->entree_materiel_Mag(["EM_DATE"=> $debut]);
		}else if(!empty($fin)){
			$stringdate = "LISTE ENTRE MATIEREES  DU " .$fin;
			$datas = $this->magasiner_model->entree_materiel_Mag(["EM_DATE" => $fin]);
		}else{
			$date= date('Y-d');
			$stringdate = "LISTE ENTRE MATIEREES  DU ".$date;
			$datas = $this->magasiner_model->entree_materiel_Mag(" EM_DATE like '$date'");
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
		   <th>ARTICLE </th>
		   <th>QUANTITE</th>
   
		</tr>";

		foreach ($datas as $row) {
			$content .= "<tr>
		    	<td> $row->EM_ID</td>
				<td> $row->EM_DATE</td>
				<td>$row->EM_MAGASINIER</td>
				<td style='whidth:200px!important'> $row->EM_MATIER</td>
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
public function exportStockEntre()
	{
		$this->load->model('Magasiner_model');

		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		if(!empty($debut) && !empty($fin)){
			$datas = $this->magasiner_model->entree_materiel_Mag("EM_DATE BETWEEN  '$debut'  AND '$fin'");
		}else if(!empty($debut)){
			$datas = $this->magasiner_model->entree_materiel_Mag(["EM_DATE"=> $debut]);
		}else if(!empty($fin)){
			$datas = $this->magasiner_model->entree_materiel_Mag(["EM_DATE" => $fin]);
		}else{
			$date= date('Y-d');
			$datas = $this->magasiner_model->entree_materiel_Mag(" EM_DATE like '$date'");
		}

		
		$excel = "\tENTRE STOCK MATIERS PREMIERES " . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "ID\tDATE\tMAGASINER\tARTICLE\tQUANTITE\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->EM_ID\t$row->EM_DATE\t$row->EM_MAGASINIER\t$row->EM_MATIER\t $row->LI_QUANTITE\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK MATIERS PREMIERES DU  : " . date("d-m-Y") . "PLASMAD.xls");
		print $excel;
		exit;
	}
public function validerSortieMatier(){
	$this->load->model('Magasiner_model');
	$po = $this->input->post('po');
	if ( $this->magasiner_model->updatematierattentvalide(['PO_MAV'=>$po],["STATUT_MAV"=>'VAILIDER',"VALIDE_MAV"=>$this->session->userdata('matricule')]) ){
		$reponse = $this->magasiner_model->selectmatierInfoAttentValide(['PO_MIAV'=>$po]);
		foreach ($reponse as $key => $reponse) {
			$this->validerSortieMatierTransaction(
                    $reponse->DES_MIAV,
                    $reponse->PO_MIAV,
                    $reponse->QTT_MIAV,
                    $reponse->PRIX_MIAV          
			);
		}

	}

	
}
public function validerSortieMatierTransaction($designation,$reference,$quantite,$prix ){
	$this->load->model('Magasiner_model');
		
	
		
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
		
}

public function liste_matierattentvalide(){
		$this->load->model('Magasiner_model');
	$datas = $this->magasiner_model->selectmatierattentvalide([
         "STATUT_MAV"=>"NON VAILIDER"
	]);
	$data =array();
	foreach ($datas as $row) {

			$sub_array = array();
			$sub_array[] = $row->DATE_MAV;
			$sub_array[] = $row->DEMANDE_MAV;
			$sub_array[] = $row->PO_MAV;
			$sub_array[] = $row->MAC_MAV;
			$produit = $this->magasiner_model->selectmatierInfoAttentValide([
               "PO_MIAV"=>$row->PO_MAV
	        ]);
	        $dataProduit = "";
	        foreach ($produit as $key => $produit) {
	        	$dataProduit .= $produit->DES_MIAV." | ".$produit->QTT_MIAV."<br/>";
	        }
			$sub_array[] = $dataProduit;
			$sub_array[] = $row->STATUT_MAV;
			$sub_array[] ='<a href="'.$row->PO_MAV.'" class="btn btn-primary btn-sm valider"><i class="fa fa-check"></i> Valider</a> &nbsp; <a href="'.$row->PO_MAV.'" class="btn btn-warning btn-sm edit"><i class="fa fa-edit"></i> Modifier</a>';
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
}
	public function listeInfoValide(){
			$this->load->model('Magasiner_model');
			$po= $this->input->get('po')
;	$datas = $this->magasiner_model->selectmatierInfoAttentValide([
         "PO_MIAV"=>$po
	]);
	$data =array();
	foreach ($datas as $row) {

			$sub_array = array();
			$sub_array[] = $row->ID_MIAV;
			$sub_array[] = $row->DES_MIAV;
			$sub_array[] = $row->QTT_MIAV;
			$sub_array[] = $row->PRIX_MIAV;
			$sub_array[] ='<a href="'.$row->ID_MIAV.'" class="btn btn-danger btn-sm supprimer"><i class="fa fa-trash"></i> </a>';
			
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
public function insertInfoMatierProduit(){
	$this->load->model('Magasiner_model');
	$this->magasiner_model->insertmatierInfoAttentValide([
		 "PO_MIAV"=>$this->input->post('po'),
		 "DES_MIAV"=>$this->input->post('des'),
		 "QTT_MIAV"=>$this->input->post('quantite'),
		 "PRIX_MIAV"=>$this->input->post('prix')
	]);
	 
}
public function deleteSortieTransac(){
	$id = $this->input->post('id');
	$this->load->model('Magasiner_model');
	echo $this->magasiner_model->deletematierInfoAttentValide(["ID_MIAV"=>$id]);
}	
public function lisete_entre_materiel()
	{
		$this->load->model('Magasiner_model');
		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		if(!empty($debut) && !empty($fin)){
			$datas = $this->magasiner_model->entree_materiel_Mag("EM_DATE BETWEEN  '$debut'  AND '$fin'");
		}else if(!empty($debut)){
			$datas = $this->magasiner_model->entree_materiel_Mag(["EM_DATE"=> $debut]);
		}else if(!empty($fin)){
			$datas = $this->magasiner_model->entree_materiel_Mag(["EM_DATE" => $fin]);
		}else{
			
			$datas = $this->magasiner_model->entree_materiel_Mag();
		}

		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->EM_ID;
			$sub_array[] = $row->EM_DATE;
			$sub_array[] = $row->EM_MAGASINIER;
			$sub_array[] = $row->LI_REFERENCE;
			$sub_array[] = $row->EM_MATIER;
			$sub_array[] = $row->LI_QUANTITE;
			$sub_array[] ='<a href="'.$row->EM_ID.'" id="'.$row->LI_ID.'" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Supprimer</a>';
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
public function lisete_sortie_materiels()
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
				$sub_array[] =  $row->LI_QUANTITE. " Kg";
			}
			$sub_array[] = '<a href="'.$row->MS_ID.'" id="'.$row->LI_ID.'" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Supprimer</a>';
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function deleteTransactionSortie(){
		$this->load->model('Controlleur_model');
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$idstock = $this->input->post('idstock');
		if($this->Controlleur_model->delete_sortie_materiel(["MS_ID"=>$id])){
			 $reponse = $this->Controlleur_model->select_stock_materiel(["LI_ID"=>$idstock]);
			 if($reponse){
				 if($type=='sortie'){
					$resultat = $this->Controlleur_model->select_stock_matier_premier(["ST_DESIGNATION"=>$reponse->LI_MATIER,"ST_ORIGIN"=>$reponse->LI_ORIGIN]);
					 $newMatier =  $resultat->ST_QUANTITE +  $reponse->LI_QUANTITE;
					if($this->Controlleur_model->update_stock_matier_premier(["ST_DESIGNATION"=>$reponse->LI_MATIER],['ST_QUANTITE'=>$newMatier])){
                        return $this->Controlleur_model->delete_stock_materiel(["LI_ID"=>$idstock]);
					}
				 }
			 }
		}
	}

	public function deleteTransactionEntre(){
		$this->load->model('Controlleur_model');
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$idstock = $this->input->post('idstock');
		if($this->Controlleur_model->delete_entree_materiel(["EM_ID"=>$id])){
			 $reponse = $this->Controlleur_model->select_stock_materiel(["LI_ID"=>$idstock]);
			 if($reponse){
				 if($type=='entre'){
					$resultat = $this->Controlleur_model->select_stock_matier_premier(["ST_DESIGNATION"=>$reponse->LI_MATIER,"ST_ORIGIN"=>$reponse->LI_ORIGIN]);
					
					if($resultat){
						$newMatier =  $resultat->ST_QUANTITE -  $reponse->LI_QUANTITE;
					}else{
                        $newMatier = 0 -  $reponse->LI_QUANTITE; 
					}
					
					if($this->Controlleur_model->update_stock_matier_premier(["ST_DESIGNATION"=>$reponse->LI_MATIER],['ST_QUANTITE'=>$newMatier])){
                        return $this->Controlleur_model->delete_stock_materiel(["LI_ID"=>$idstock]);
					}
				 }
			 }
		}
	}
	public function exportSuiviPo(){
	
		
		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		$datas = array();
		if( !empty($debut)  && !empty($fin)){
			$datas = $this->Controlleur_model->select_sortie_materiel_PO("MS_DATE BETWEEN '".$debut."' AND '".$fin."'");
			$excel = "\tSuivie PO du : $debut au $fin \n\n";
		}else if(!empty($debut)){
			$datas = $this->Controlleur_model->select_sortie_materiel_PO("MS_DATE like '".$debut."'");
			$excel = "\tSuivie PO du : $debut\n\n";
		}else{
			$datas = $this->Controlleur_model->select_sortie_materiel_PO("MS_DATE like '".date('Y-m')."%'");
			$excel = "\t Suivie PO du mois\n\n";
		}
		
		$excel .= "\tN PO\t\tEXTRUSION\t\t\tIMPRESSION\t\t\tCOUPE\n";
		$excel .= "\t\tSORTIE MAGASIN\tUTILISER\tNON UTILISER\tSORTIE EXTRUSION\tIMPRIMER\tNON IMPRIMER\tSORTIE IMPRESSION\tCOUPER\tNON COUPER\n";

		$data = array();
		foreach ($datas as $key => $row) {
		

										 $this->load->model('compta_model');
        								$dextrusion =  $this->compta_model->extrusion(['EX_BC_ID'=>$row->BC_PE]);
        								$extrusion_inpression = $this->compta_model->extrusion_inpression(['extrusion_inpression.BC_ID'=>$row->BC_PE]);
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
        						$extrusion_coupe = $this->compta_model->extrusion_coupe(['extrusion_coupe.BC_ID'=>$row->BC_PE]);
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
                               $control = $this->compta_model->controlDatas("C_PO ='$row->BC_PE' ORDER BY C_ID DESC");

							   if($control){
								   	foreach($control as $control){
								   			$piece -= (int) $control->C_CHOIX;
								   	}
									
									
							   }

								$matierinression = $this->compta_model->matierinression(['MI_PO'=>$row->BC_PE]);
								$matier = $this->compta_model->stock_materiel(["LI_REFERENCE"=>$row->BC_PE,"LI_TYPE"=>"sortie"]);
								$totalSortie=0;
								$prixTotal= 0;
								$detaiMAt = "";
							$x= 0;
								foreach($matier as $matier){
									$totalSortie += $matier->LI_QUANTITE;
									
									if($x !=0 ){
										$detaiMAt .= "/".$matier->LI_MATIER;
										$x++;
									}else{
										$detaiMAt .=$matier->LI_MATIER;
										$x++;
									}
									
								}
			$excel .="\t$row->BC_PE";				
			$excel .= "\t". number_format($totalSortie , 2, ',', ' ');
			$excel .= "\t". number_format($poids, 2, ',', ' ');
			$excel .= "\t". number_format($totalSortie-$poids, 2, ',', ' ');
			$excel .= "\t". number_format($sortir, 2, ',', ' ');
			$excel .= "\t". number_format($entreInpress, 2, ',', ' ');
			$excel .= "\t". number_format($sortir-$entreInpress, 2, ',', ' ');
			$excel .= "\t". number_format($entreInpress, 2, ',', ' ');
			$excel .= "\t". number_format($poidsSomme, 2, ',', ' ');		
			$excel .= "\t". number_format($entreInpress-$poidsSomme, 2, ',', ' ');
			$excel .="\n";
			
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=SUIVIE PO.xls");

		print $excel;
		exit;
	}
	public function printDataMachine(){

		$this->load->model('planning_model');
		$type = $this->input->get('type');
		$date = $this->input->get('debut');
		$fin = $this->input->get('fin');
		if ($date == "") {
			$date = date("Y-m-d");
		}
		if ($type == "EXTRUSION") {

			$data = [
				"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "EXTRUSION", "MA_STATUT" => "on"]),
				"date" => $date,
				'fin' => $fin
			];
			$html =$this->load->view("controlleur/suivieMachieExtrusion", $data,true);
			$filename = "SUIVIE MACHINE EXTRUSION". date('d / m / Y');
		 
		} else if ($type == "IMPRESSION") {

			$data = [
				"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION", "MA_STATUT" => "on"]),
				"fin" => $date,
				'date' => $fin
			];
			$html = $this->load->view("controlleur/suiVieMachineImpressions", $data,true);
			$filename = "SUIVIE MACHINE IMPRESSION " . date('d / m / Y');
		 
		} else if ($type == "COUPE") {
			$data = [
				"machine" => $this->planning_model->listemachines(["MA_SPECIFIQUE" => "COUPE_EXTRUSION", "MA_STATUT" => "on"]),
				"fin" => $date,
				'date' => $fin
			];
			$html =$this->load->view("controlleur/suivieCoupe", $data,true);
			$filename = "SUIVIE MACHINE  COUPE du " .$date;
		}
		
		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
	}

	public function update_stock_surplus()
	{
		$this->load->model('Magasiner_model');
	if($this->session->userdata('fonction')){
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
					if($rows['PO'] != ""){
				$data = "";
				$reponse = $this->Stock_model->bondecommande("BC_PE like '%".$rows['PO']."'");
					if ($reponse) {

						$dt = new DateTime($rows["DATE"]);
						$date = $dt->format('Y-m-d');
						$data = [
							"BC_ID" => $reponse->BC_PE,
							"STF_QUANTITE" => $rows["QUANTITE"],
							"STF_TAIL" => $rows["TAILLE"],
							"STF_DIM"=>$reponse->BC_DIMENSION,
							"STF_CLIENT" => $reponse->BC_CODE,
							"STF_LOCALISATION" => $rows["LOCATION"],
							"STF_DATE" => $date,
							"STF_ORIGIN" => "PLASMAD_STOCK"

						];
						$this->Stock_model->insertstock_produit_fini($data);
					}else{

					}
					}
				}
			}
		}
		echo 0;
	}else{
		echo 1;
	}
		
	}
public function exportStockMatier(){
	$this->load->model('Magasiner_model');
	$datas = $this->magasiner_model->listeMatier(["ST_ORIGIN" => "PLASMAD_MAGASIN"]);
	$excel = "\tRéférence\tDésignation\tPrix Unitaire\tEn stock\n";
	foreach ($datas as $row) {
		$excel .= "\t$row->ST_ID\t$row->ST_DESIGNATION\t$row->ST_PRIX_UNITAIRE\t$row->ST_QUANTITE kg\n";
				  
	}
	header("Content-type: application/vnd.ms-excel");
	header("Content-disposition: attachment; filename=STOCK MATIER PREMIER.xls");

	print $excel;
	exit;
}

public function printStockMatier(){
	$this->load->model('Magasiner_model');
	$datas = $this->magasiner_model->listeMatier(["ST_ORIGIN" => "PLASMAD_MAGASIN"]);
	$content = "<div class='cont w-100'>
	<table>
			  <thead class='thead w-100'>
			  <tr class='header'>
				  <td colspan='6'>STOCK MATIER PREMIER : ".date('d-m-Y')."</td>
			  </tr>
		  </thead>
		  <tbody>
			 <tr>
			 
			 <th>Référence</th>
			 <th>Désignation</th>
			 <th>Prix Unitaire</th>
			 <th>En stock</th>
	 
		  </tr>";
		  foreach ($datas as $row) {
			  $content .= "<tr>
				  <td> $row->ST_ID</td>
				  <td> $row->ST_DESIGNATION</td>
				  <td>$row->ST_PRIX_UNITAIRE</td>
				  <td> $row->ST_QUANTITE kg</td>";
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
		$filename = "STOCK MATIER DU du " .date('d-m-Y');
	    $dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
}


}
