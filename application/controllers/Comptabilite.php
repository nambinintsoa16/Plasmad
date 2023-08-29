<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Comptabilite extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pdf');
    $this->load->library('SimpleXLSX');
    $this->load->model('stock_matier_premier');
    $this->load->model('entree_matiere_premiere');
    
  }
  public function index()
  {
    $this->render_view('Comptabilite/accueil');
  }
  public function Stock_matieres_premieres()
  {
    $this->render_view('Comptabilite/stock/Stock_matieres_premieres');
  }
  public function detailProduction(){
	$po = $this->input->post('po');
	$this->load->model("sachet_coupe");
    $this->load->model("sachet_extrusion");
    $this->load->model("sachet_impression");
	$this->load->model("controle_qualite");
	$this->load->model("matiere_impression_use");
	$this->load->model("sortie_matiere_premiere");
	
	
	$data = [
		"PO" => $this->input->post("po"),
		"extrusion" => $this->sachet_extrusion->get_sachet_extrusion(["EX_BC_ID" => $po]),
		"impression" => $this->sachet_impression->get_sachet_impression(["BC_ID" => $po]),
		"coupe" => $this->sachet_coupe->get_sachet_coupe(["BC_ID" => $po]),
		"qc" => $this->controle_qualite->get_controle_qualite(["C_PO" => $po]),
		"matier" => $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_DESTINATAIRE" => $po, "EM_TYPE" => "sortie"]),
		"matierinression" => $this->matiere_impression_use->get_matiere_impression_use(['MI_PO' => $po])
	];
	$this->load->view('Comptabilite/costing/detailProd', $data);
  }
  public function consting_containt()
  {
    $this->load->model("commande");
    $this->load->model("sachet_coupe");
    $this->load->model("sachet_extrusion");
    $this->load->model("sachet_impression");
	$this->load->model("global");
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
						$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND  EX_DATE like '$date%'");
						$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE like '$date%'");
						$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EI_DATE like '$date%'");
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

						$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EX_DATE  BETWEEN '$date' AND '$findate'");
						$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE  BETWEEN '$date' AND '$findate'");
						$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EI_DATE BETWEEN '$date' AND '$findate'");

					}else{
						$dateTEmp = explode("-", $date);
					    $date = $dateTEmp[0] . "-" . $dateTEmp[1];

						$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EX_DATE like '$date%'");
						$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE like '$date%'");
						$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND  commande.BC_ORIGINE='PLASMAD') AND EI_DATE like '$date%'");
					
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
                $origin=="Plasmad";
				$data = $this->commande->select_commande_all("(".$requette.") ORDER BY BC_DATE ASC");
				$reponse = [
					"data"   => $data,
					"origin" => $origin 
				];
        $this->load->view('Comptabilite/costing/consting_containt',$reponse);
  }
  public function export_costing_excel(){
	$this->load->model("commande");
    $this->load->model("sachet_coupe");
    $this->load->model("sachet_extrusion");
    $this->load->model("sachet_impression");
	$this->load->model("global");
    $tableArray = array();
				$in = "";
				$date = $this->input->get('date');
				$po = $this->input->get('po');
				$type = $this->input->get('type');
				$origin = $this->input->get('origin'); 
				if($type ==""){
					$type = "PE";
				}
				$findate = $this->input->get('fin');
				$i = 0;
				if ($date == "") {
					if ($po != "") {
						$requette = "BC_PE LIKE '%$po%'";
					} else {
						$date = date('Y-m');
						$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND  EX_DATE like '$date%'");
						$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE like '$date%'");
						$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EI_DATE like '$date%'");

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
						$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EX_DATE  BETWEEN '$date' AND '$findate'");
						$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE  BETWEEN '$date' AND '$findate'");
						$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EI_DATE BETWEEN '$date' AND '$findate'");

					}else{
						$dateTEmp = explode("-", $date);
					    $date = $dateTEmp[0] . "-" . $dateTEmp[1];

						$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EX_DATE like '$date%'");
						$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE like '$date%'");
						$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND  commande.BC_ORIGINE='PLASMAD') AND EI_DATE like '$date%'");
					
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
				$data = $this->commande->select_commande_all("(".$requette.") ORDER BY BC_DATE ASC");
                $reponse = [
					"data"   => $data,
					"origin" => "Plasmad" 
				];
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=COSTING DU  : " . $date . " PLASMAD.xls");
		print $this->load->view('Comptabilite/costing/consting_containt',$reponse,true);
		exit;
  }
  public function export_costing_excel_old(){
    $this->load->model("sortie_matiere_premiere");
    $this->load->model("matiere_impression_use");
    $this->load->model("sachet_impression");
    $this->load->model("sachet_extrusion");
    $this->load->model("controle_qualite");
    $this->load->model("prix_commande");
    $this->load->model("sachet_coupe");
    $this->load->model("prix_appiquer");
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
				$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND  EX_DATE like '$date%'");
				$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE like '$date%'");
				$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EI_DATE like '$date%'");
				/*$extru = $this->sachet_extrusion->get_sachet_extrusion("EX_DATE like '$date%'");
				$coupe = $this->sachet_coupe->get_sachet_coupe("ED_DATE like '$date%'");
				$imprm = $this->sachet_impression->get_sachet_impression("EI_DATE like '$date%'");*/
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

				$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EX_DATE  BETWEEN '$date' AND '$findate'");
				$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE  BETWEEN '$date' AND '$findate'");
				$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"c(ommande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EI_DATE like  BETWEEN '$date' AND '$findate'");

			}else{
				$dateTEmp = explode("-", $date);
				$date = $dateTEmp[0] . "-" . $dateTEmp[1];

				$extru =$this->global->get_data_joint_parameter('sachet_extrusion','commande','commande.BC_PE=sachet_extrusion.EX_BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND EX_DATE like '$date%'");
				$coupe =$this->global->get_data_joint_parameter('sachet_coupe','commande','commande.BC_PE=sachet_coupe.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND commande.BC_ORIGINE='PLASMAD') AND ED_DATE like '$date%'");
				$imprm =$this->global->get_data_joint_parameter('sachet_impression','commande','commande.BC_PE=sachet_impression.BC_ID',"(commande.BC_TYPEMATIER = '$type' AND  commande.BC_ORIGINE='PLASMAD') AND EI_DATE like '$date%'");
			
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
			$matricule  = 325;
	  }else{
		   $matricule  = "44" ;
	  }
		$excel = "";
    $data = $this->commande->select_commande_all("(".$requette.") ORDER BY BC_DATE ASC");

		foreach ($data as $data) {
			if ($data->BC_TYPEPRODUIT == "GAINES") {
				$quantitex = "QUANTITE : " . $data->BC_QUNTITE . " | KGS";
			} else {
				$quantitex = "QUANTITE : " . $data->BC_QUNTITE . " | PCS";
			}
      $prixbon = $this->prix_commande->get_detail_prix_commande(['PB_PO' => $data->BC_PE]);
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
			//_______________________________________________________________________ calcule
			$dextrusion =  $this->sachet_extrusion->get_sachet_extrusion(['EX_BC_ID' => $data->BC_PE]);
			$extrusion_inpression = $this->sachet_impression->get_sachet_impression(['BC_ID' => $data->BC_PE]);
			$poid = $dextrusion;
			$poids = 0;
			$dure = 0;
			$MAT = 150;
			$sortir = 0;
			$EI_DUREE = 0;
			$MATCOUP = 0;
			$EI_DUREECOUP = 0;
			foreach ($poid as $key => $poid) {
				if ($poid->EX_PDS_SOMME != "") {
					$poids += $poid->EX_PDS_NET;
					$dure +=  $this->time_to_sec($poid->EX_DUREE);
					$sortir += $poid->EX_PDS_SOMME;
				}
			}
			$entreInpress = 0;
			if ($extrusion_inpression) {
				foreach ($extrusion_inpression as $key => $extrusion_inpression) {
					$MAT +=  $extrusion_inpression->EI_POIDS_NET;
					$EI_DUREE += $this->time_to_sec($extrusion_inpression->EI_DUREE);
					$entreInpress += $extrusion_inpression->EI_PDS_SOMME;
				}
			}
		   
			$extrusion_coupe = $this->sachet_coupe->get_sachet_coupe(['BC_ID' => $data->BC_PE]);
			$EI_DUREECOUP = 0;
			$ED_METRAGE_SOMME = 0;
			$ED_POID_SORTIE_SOMME = 0;
			$piece = 0;
			$metrage = 0;
			$poidsSomme = 0;
			if ($extrusion_coupe) {
				foreach ($extrusion_coupe as $key => $extrusion_coupe) {
					//	$MATCOUP +=  $extrusion_coupe->EI_POIDS_NET;
					//$sortirCoup += $extrusion_coupe->ED_POID_SORTIE_SOMME;
					$poientre = "";
					$poientre = explode("+", $extrusion_coupe->ED_POID_ENTRE);
					foreach ($poientre as $key => $poientre) {
						$poidsSomme += (float)$poientre;
					}
					$ED_POID_SORTIE_SOMME  +=  $extrusion_coupe->ED_POID_SORTIE_SOMME;
					$EI_DUREECOUP += $this->time_to_sec($extrusion_coupe->ED_DURE);
					$ED_METRAGE_SOMME +=  $extrusion_coupe->ED_METRAGE_SOMME;
					$piece += $extrusion_coupe->ED_1ER_CHOIX_SOMME;
					$metrage += $extrusion_coupe->ED_METRAGE_SOMME;
				}
			}
			
			$control = $this->controle_qualite->get_controle_qualite("C_PO ='$data->BC_PE' ORDER BY C_ID DESC");

			if ($control) {
				foreach ($control as $control) {
					$piece -= $control->C_CHOIX;
				}
			}
			
			$matierinression = $this->matiere_impression_use->get_matiere_impression_use(['MI_PO' => $data->BC_PE]);
			$matier = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_DESTINATAIRE" => $data->BC_PE]);
			$totalSortie = 0;
			$prixTotal = 0;
			$detaiMAt = "";
			$x = 0;
			foreach ($matier as $matier) {
				$totalSortie += $matier->SM_QUANTITE;
				$prixTotal += $matier->SM_VALEUR * $matier->SM_QUANTITE;
				if ($x != 0) {
					$detaiMAt .= "/" . $matier->SM_MATIER;
					$x++;
				} else {
					$detaiMAt .= $matier->SM_MATIER;
					$x++;
				}
			}
			$pu = 0;
			if ($totalSortie != 0) {
				//$pu = ($prixTotal * $poids ) / $totalSortie;
				$pu = $prixTotal /  $totalSortie;
			}
			$pux = $pu * $poids;
			$prix_a_appliquer =$this->global->get_detail_joint_parameter("prix_commande","prixappliquer", 'prixappliquer.PA_ID =prix_commande.PB_ID_HM',["prix_commande.PB_PO"=>$data->BC_PE]);
			$pxMatIpp = $pux + (($dure * 1.2213) / 3600) + ((($dure * 2) * 1.0166) / 3600);
			$exdure = ($dure *  $prix_a_appliquer->H_MACHINE_EXTR) / 3600;
			$hdue = ($dure * $prix_a_appliquer->H_MOD_EXTR) / 3600;
			$piodsover = $poids * $prix_a_appliquer->OVERHEADS;

			if ($data->BC_TYPE == "SS") {
				$coupe = (($EI_DUREECOUP) * $prix_a_appliquer->H_MOD_COUPE) / 3600;
			} else if ($data->BC_TYPE == "BS") {
				$coupe = (($EI_DUREECOUP) * $prix_a_appliquer->H_MOD_COUPE) / 3600;
			} else {
				$coupe = (($EI_DUREECOUP) * $prix_a_appliquer->H_MOD_COUPE) / 3600;
			}

			$imp = ($EI_DUREE * $prix_a_appliquer->H_MACHINE_IMPR) / 3600;
			$HModIMP = (($EI_DUREE * 2) *  $prix_a_appliquer->H_MOD_IMPR) / 3600;
			$hcoupe = ($EI_DUREECOUP * $prix_a_appliquer->H_MACHINE_COUPE) / 3600;
			$sommeex =  $piodsover + $pux + $exdure +  $hdue;
			$toto = 0;
			if ($poids != 0) {

				$toto = number_format($sommeex / $poids, "3");
			}
			$sommeMat = 0;
			$varmatiers = $matierinression;
			foreach ($varmatiers  as $varmatiers) {
				$sommeMat += ($varmatiers->MI_PRIX * $varmatiers->MI_QUANTITE);
			}

			$totaMatIpp = $entreInpress * $toto;
			$prixImPrixtotal = $HModIMP + $imp + $totaMatIpp + $sommeMat;
		
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
		$EI_DUREEX = $this->se_to_time($EI_DUREE);
		$EI_DUREECOUPX = $this->se_to_time($EI_DUREECOUP);
		$durex = $this->se_to_time($dure);
        $excel .="\tH MACHINE EXTR\t$durex\tH\t3.08\t$exdure\tH MACHINE IMPR\t$EI_DUREEX\tH\t2.84\t$imp\tH MACHINE COUPE\t$EI_DUREECOUPX\tH\t0,260\t$hcoupe\n";
		$EI_DUREEXS=number_format($EI_DUREE*2,3);
		$EI_DUREEXH = $this->se_to_time($EI_DUREE*2);
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
		header("Content-disposition: attachment; filename=COSTING DU  : " . $date . " PLASMAD.xls");
		print $excel;
		exit;
    
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

  public function get_entree_stock_matieres()
  {
    $this->render_view('Comptabilite/stock/entree');
  }
  public function echange_matiere()
  {
    $this->render_view('Comptabilite/stock/echange');
  }
  public function Costing()
  {
    $this->render_view("Comptabilite/costing/index");
  }
  public function save_matiere()
  {
    $ST_DESIGNATION = $this->input->post('designation');
    $ST_UNITE = $this->input->post('prix_usd');
    $ST_PRIX_UNITAIRE = $this->input->post('prix_ariary');
    $ST_MATIER_TYPE = $this->input->post('type_matiere_new');

    $data = [
      "ST_DESIGNATION" => $ST_DESIGNATION,
      "ST_ORIGIN" => "PLASMAD_MAGASIN",
      "ST_PRIX_UNITAIRE" => $ST_PRIX_UNITAIRE,
      "ST_UNITE" => $ST_UNITE,
      "ST_QUANTITE" => 0,
      "ST_MATIER_TYPE" => $ST_MATIER_TYPE
    ];
    echo $this->stock_matier_premier->insert_stock_matier_premier($data);
  }
  public function update_matiere()
  {
    $ST_DESIGNATION = $this->input->post('designation');
    $ST_PRIX_UNITAIRE = $this->input->post('prix_ariary'); 
    $ST_UNITE = $this->input->post('prix_usd');
    $ST_ID =  $this->input->post('refnum');
    $data = [
      "ST_DESIGNATION" => $ST_DESIGNATION,
      "ST_PRIX_UNITAIRE" => $ST_PRIX_UNITAIRE,
      "ST_UNITE" => $ST_UNITE,

    ];
    $requette = ['ST_ID' => $ST_ID];
    echo $this->stock_matier_premier->update_stock_matier_premier($requette, $data);
  }
  public function matiere_liste_Data()
  {

    $datas = $this->stock_matier_premier->get_stock_matier_premier(["ST_ORIGIN" => "PLASMAD_MAGASIN"]);
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->ST_DESIGNATION;
      $sub_array[] = $row->ST_QUANTITE;
      $sub_array[] = $row->ST_UNITE;
      $sub_array[] = $row->ST_PRIX_UNITAIRE;
      $sub_array[] = $row->ST_MATIER_TYPE;
      $sub_array[] = "<a href='#' class='btn btn-warning btn-sm edit_matiere' id=' $row->ST_ID'><i class='fa fa-edit'></i>&nbsp;Modifier</a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function Recap_costing()
  {
    $data = ["data" => array()];
    $this->render_view("Comptabilite/recap/index", $data);
  }

  public function detailLivre()
  {
	  $numpos = $this->input->post('numpos');
	  $clientPo = $this->input->post('clientPo');
	  $resultat = array("reponse" => "false", "data" => "");
	  $data = $this->commande->select_commande_all("BC_CODE like '$clientPo'");


	  if ($clientPo != "") {
		  $data = $this->commande->select_commande_all("BC_CODE like '$clientPo'");
		  if ($data) {
			  $resultat["reponse"] = "true";
		  }
		  foreach ($data as $data) {
			  $qtt = explode(" ", $data->BC_QUNTITE);
			  $prix = explode(" ", $data->BC_PRIX);
			  $resultat["data"] .= "<tr><td>$data->BC_CODE</td><td>$data->BC_PE</td><td>$data->BC_TYPEPRODUIT  $data->BC_TYPEMATIER</td><td>$data->BC_TYPEPRODUIT $data->BC_DIMENSION</td><td>$qtt[0]</td><td> $prix[0]</td><td><a href='#' id='$data->BC_PE' class='btn btn-warning btn-sm editlivre'><i class='fa fa-edit'></i></a><td></tr>";
		  }
	  } else if ($numpos != "") {
		  $data = $this->commande->select_commande_all("BC_PE = '$numpos'");
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
	  echo $this->livraison_compta->insert_livraison_compta($data);
  }

  public function data_recap_costing(){
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
	$client = $this->global->get_data_joint_parameter_group_by("livraison_compta","commande","commande.BC_PE=livraison_compta.LV_PO",$requette,"commande.BC_CODE");
	$reponse = [
		"data" => $client,
		"date"=>$date
	];

	$this->load->view('Comptabilite/recap_costing', $reponse);

  }
  public function import_files_matiere_premiere()
  {

    $data = scandir(FCPATH . 'uploads/excel');
    $uploads_dir = FCPATH . 'uploads/excel';
    $methodOk = false;
    $methodOk = isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"]);
    if ($methodOk) {
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
          foreach ($rows as $rows) {
            $data = "";
			$matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_DESIGNATION" => $rows['ST_DESIGNATION']]);
            $methodOk = $matiere == Null;
			$data = [
                "ST_DESIGNATION" => $rows["ST_DESIGNATION"],
                "ST_QUANTITE" => $rows["ST_INITIAL"],
                "ST_PRIX_UNITAIRE" => $rows["ST_REVIENT"],
                "ST_UNITE" => $rows["ST_PRIX_UNITAIRE"],
                "ST_ORIGIN" => $rows['ST_ORIGIN'],
                "ST_MATIER_TYPE"=>$rows['ST_MATIER_TYPE']

              ];
            if ($methodOk) {
              $methodOk = $this->stock_matier_premier->insert_stock_matier_premier($data);
            }else{
			  $methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID"=>$matiere->ST_ID],$data);
			}
          }
        }
      }
    }
    echo $methodOk;
  }
  public function get_liste_des_entrees(){
       $this->render_view("Comptabilite/stock/liste_des_entrees");
  }
  public function get_liste_des_sortiee(){
    $this->render_view("Comptabilite/stock/liste_des_sortie");
   }


   public function update_recap(){
	$this->load->model('livraison_compta');
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
					$this->livraison_compta->insert_livraison_compta($data);
			}
		}
	}
	return 0;

}

  public function entree_matiere_liste_data(){
    $methodOk = isset($_GET["date_de_debut"]) && isset($_GET['date_fin']);
    if($methodOk){
      $date_de_debut = $_GET["date_de_debut"];
      $date_fin = $_GET['date_fin'];
      $datas = $this->entree_matiere_premiere->get_entree_matiere_premiere("EM_DATE BETWEEN '$date_de_debut' AND '$date_fin'");
    }

    if(!$methodOk){
      $methodOk = isset($_GET["date_de_debut"]);
      if($methodOk){
        $date_de_debut = $_GET["date_de_debut"];
        $datas = $this->entree_matiere_premiere->get_entree_matiere_premiere(["EM_DATE"=>$date_de_debut]);  
      }
    }
    
    if(!$methodOk){

      $datas = $this->entree_matiere_premiere->get_entree_matiere_premiere();
    }
   
    
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->EM_ID;
      $sub_array[] = $row->EM_DATE;
      $sub_array[] = $row->EM_MAGASINIER;
      $sub_array[] = $row->EM_FORNISEUR;
      $sub_array[] = $row->EM_MATIER;
      $sub_array[] = $row->EM_QUANTITE;
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }


  public function sortie_matiere_liste_data(){
	$this->load->model("sortie_matiere_premiere");
    $methodOk = isset($_GET["date_de_debut"]) && isset($_GET['date_fin']);
    if($methodOk){
      $date_de_debut = $_GET["date_de_debut"];
      $date_fin = $_GET['date_fin'];
      $datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere("SM_DATE BETWEEN '$date_de_debut' AND '$date_fin'");
    }

    if(!$methodOk){
      $methodOk = isset($_GET["date_de_debut"]);
      if($methodOk){
        $date_de_debut = $_GET["date_de_debut"];
        $datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_DATE"=>$date_de_debut]);  
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
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
}
