<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Production extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('commande');
		$this->load->model('sachet_extrusion');
		$this->load->model('sachet_impression');
		$this->load->model('sachet_coupe');
		$this->load->model('prix_commande');
	}

	public function planning()
	{
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" => $this->machine->get_machine($param)
		];
		$this->render_view('production/planning/index', $data);
	}


	public function Planning_extrusion(){
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" => $this->machine->get_machine($param)
		];
		$this->render_view("production/planning/sachet_extrusion",$data);
	}
	public function Planning_impression(){
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" => $this->machine->get_machine($param)
		];
		$this->render_view("production/planning/sachet_impression",$data);
	}
	public function Planning_coupe(){
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "COUPE_EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" => $this->machine->get_machine($param)
		];
		$this->render_view("production/planning/sachet_coupe",$data);
	}


	public function sachet_Extrusion()
	{
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" => $this->machine->get_machine($param)
		];
		$this->render_view('production/sachet/extrusion', $data);
	}
	public function sachet_impression()
	{
		$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION"]);

		$data = [
			"MACHINE" => $machine
		];
		$this->render_view('production/sachet/impression', $data);
	}
	public function sachet_coupe()
	{
		$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "COUPE_EXTRUSION"]);
		$data = [

			"MACHINE" => $machine
		];
		$this->render_view('production/sachet/coupe', $data);
	}
	public function Cintre_Injection()
	{
		$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "INJECTION"]);
		$data = [
			"machine" => $machine
		];
		$this->render_view('production/cintre/injection',$data);
	}
	public function Cintre_impression()
	{
		$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "IMPRESSION_INJECTION"]);
		$data = [
			"machine_modal" => $machine,
			"machine" => $machine
		];
		$this->render_view('production/cintre/impression',$data);
	}
	public function Cintre_Hook()
	{
		$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "HOOK"]);
		$data = [
			"machine_modal" => $machine,
			"machine" => $machine
		];
		$this->render_view('production/cintre/hook',$data);
	}
	public function sachet_coupe_data_list()
	{

		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		$type_mat = $this->input->get('type_mat');
		if (!empty($_GET['po'])) {
			$datas = $this->sachet_coupe->get_sachet_coupe(['BC_ID' => $_GET['po']]);
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
 			if($type_mat==""){
				$datas = $this->sachet_coupe->get_sachet_coupe("ED_DATE BETWEEN '" . $_GET['debut'] . "' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "' AND ED_MACHINE like '" . $_GET['machine'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_coupe","commande","sachet_coupe.BC_ID=`commande.BC_PE","ED_DATE BETWEEN '" . $_GET['debut'] . "' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "' AND ED_MACHINE like '" . $_GET['machine'] . "' AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			if($type_mat==""){
				$datas = $this->sachet_coupe->get_sachet_coupe("ED_DATE BETWEEN '" . $_GET['debut'] . "' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_coupe","commande","sachet_coupe.BC_ID=`commande.BC_PE","ED_DATE BETWEEN '" . $_GET['debut'] . "' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND  ED_EQUIPE like '" . $_GET['operateurs'] . "' AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			if($type_mat==""){
				$datas = $this->sachet_coupe->get_sachet_coupe("ED_DATE BETWEEN '" . $_GET['debut'] . "' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_coupe","commande","sachet_coupe.BC_ID=`commande.BC_PE","ED_DATE BETWEEN '" . $_GET['debut'] . "' AND '" . $_GET['date'] . "' AND ( ED_QUART like '" . $_GET['quart'] . "' AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}
		} else if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			if($type_mat==""){
				$datas = $this->sachet_coupe->get_sachet_coupe(["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine'], "ED_EQUIPE" => $_GET['operateurs']]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_coupe","commande","sachet_coupe.BC_ID=`commande.BC_PE",["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine'], "ED_EQUIPE" => $_GET['operateurs'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		} else if (!empty($_GET['operateurs'])) {
			if($type_mat==""){
				$datas = $this->sachet_coupe->get_sachet_coupe(["ED_DATE" => $date, "ED_EQUIPE" => $_GET['operateurs']]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_coupe","commande","sachet_coupe.BC_ID=`commande.BC_PE",["ED_DATE" => $date, "ED_EQUIPE" => $_GET['operateurs'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		} else  if (!empty($_GET['machine'])) {
			if($type_mat==""){
				$datas = $this->sachet_coupe->get_sachet_coupe(["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine']]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_coupe","commande","sachet_coupe.BC_ID=`commande.BC_PE",["ED_DATE" => $date, "ED_MACHINE" => $_GET['machine'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		} else {
			if($type_mat==""){
				$datas = $this->sachet_coupe->get_sachet_coupe(["ED_DATE" => $date]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_coupe","commande","sachet_coupe.BC_ID=`commande.BC_PE",["ED_DATE" => $date,"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		}
		$data = array();
		foreach ($datas as $row) {
			$nreoul = explode(",", $row->ED_RLX);

			$sub_array = array();
			$sub_array[] = $row->ED_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->ED_RLX;
			$sub_array[] = $row->ED_DURE;
			$sub_array[] = $row->ED_METRAGE_SOMME;
			$sub_array[] = $row->ED_PIOD_ENTRE_SOMME;
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
			$sub_array[] = "<a href='#' id='$row->ED_ID' class='btn btn-warning btn-sm edit_coupe'><i class='fa fa-edit'></i>&nbsp;Modifier</a>";
			$sub_array[] = "<a href='#' id='$row->ED_ID' class='btn btn-danger btn-sm delete_coupe'><i class='fa fa-trash'></i>&nbsp;Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

    public function get_detail_sachet_coup(){
		$refnum = $this->input->post('refnum');
		$param =["ED_ID"=>$refnum];
	echo json_encode($this->sachet_coupe->get_detail_sachet_coupe($param));
	}
	public function Stock_Produit_finis()
	{
		$this->render_view('stock_magasin/data_liste');
	}
	public function produit_finis_data_list_madakem()
	{
		$this->load->model("stock_produit_finis_madakem");
		$dateDebut = $this->input->post('dateDebut');
		$dateFin = $this->input->post('dateFin');
		if (!empty($dateDebut) && !empty($dateFin)) {
			$datas = $this->stock_produit_finis_madakem->get_stget_stock_produit_finis_madakemock_produit_finis(("STF_DATE BETWEEN $dateDebut AND $dateFin"));
		} else {
			//$date = date('Y-m');
			$datas = $this->stock_produit_finis_madakem->get_stock_produit_finis_madakem();
		}

		$data = array();
		foreach ($datas as $row) {
			if ($row->STF_QUANTITE != 0) {
				$sub_array = array();
				$sub_array[] = $row->STF_DATE;
				$sub_array[] = $row->BC_ID;
				$sub_array[] = $row->STF_CLIENT;
				$sub_array[] = $row->STF_DIM;
				$sub_array[] = $row->STF_TAIL;
				$sub_array[] = $row->STF_QUANTITE;
				$refnum = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
				$refnum ? $sub_array[]  = $refnum->BC_PRIX : $sub_array[] = 0;
				$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info info_Produit btn-sm'><i class='fa fa-info'></i>&nbsp;Détail</a>";
				$data[] = $sub_array;
			}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function  produit_finis_data_list()
	{

		$dateDebut = $this->input->post('dateDebut');
		$dateFin = $this->input->post('dateFin');
		if (!empty($dateDebut) && !empty($dateFin)) {
			$datas = $this->stock_produit_finis->get_stock_produit_finis("STF_DATE BETWEEN $dateDebut AND $dateFin");
		} else {
			//$date = date('Y-m');
			$datas = $this->stock_produit_finis->get_stock_produit_finis();
		}

		$data = array();
		foreach ($datas as $row) {
			if ($row->STF_QUANTITE != 0) {
				$sub_array = array();
				$date = new DateTime($row->STF_DATE);
				$sub_array[] = $date->format('d-m-Y');
				$sub_array[] = $row->BC_ID;
				$sub_array[] = $row->STF_CLIENT;
				$sub_array[] = $row->STF_DIM;
				$sub_array[] = $row->STF_TAIL;
				$sub_array[] = $row->STF_QUANTITE;
				$refnum = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
				$refnum ? $sub_array[]  = $refnum->BC_PRIX : $sub_array[] = 0;
				$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info info_Produit btn-sm'><i class='fa fa-info'></i>&nbsp;&nbsp;Détail</a>";
				$data[] = $sub_array;
			}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function delete_sachet_refnum_print(){
		$refnum = $this->input->post("refnum");
		echo  $this->matiere_impression_use->delete_detail_matiere_impression_use(["MI_ID" => $refnum]);
	}
	public function delete_sachet_print()
	{
		$methode_ok = false;
		$id = $this->input->post('id');
		$methode_ok = $this->sachet_impression->delete_sachet_impression(["EI_ID" => $id]);
		if($methode_ok){
		  echo $this->matiere_impression_use->delete_detail_matiere_impression_use(["MI_PROD" => $id]);
		}
	
	}
	public function Verification_matieres(){
		$this->render_view("production/verification_matiere/index");
	}
	public function get_detail_print(){
		$refnum = $this->input->post('refnum');
		$data = $this->sachet_impression->get_detail_sachet_impression(["EI_ID"=>$refnum]);
		echo json_encode($data);
	}
	public function sachet_impression_data_list()
	{

		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
		$type_mat = $this->input->get('type_mat');

		if (!empty($_GET['po'])) {
			$datas = $this->sachet_impression->get_sachet_impression(['BC_ID' => $_GET['po']]);
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['machine'])) {
			if($type_mat==""){
				$datas = $this->sachet_impression->get_sachet_impression("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND EI_MACH like '" . $_GET['machine'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE","EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND EI_MACH like '" . $_GET['machine'] ."' AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}
		
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			if($type_mat==""){
		 		$datas = $this->sachet_impression->get_sachet_impression("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs'] . "' AND EI_MACH like '" . $_GET['machine'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE","EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs'] . "' AND EI_MACH like '" . $_GET['machine']."' AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			} 		
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			if($type_mat==""){
				$datas = $this->sachet_impression->get_sachet_impression("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE","EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EI_QUART like '" . $_GET['quart'] . "' AND  EI_EQUIPE like '" . $_GET['operateurs']."' AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			if($type_mat==""){
				$datas = $this->sachet_impression->get_sachet_impression("EI_DATE BETWEEN '$date' AND '" . $_GET['date'] . "'");
		    }else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE","EI_DATE BETWEEN '$date' AND '" .$_GET['date']."' AND commande.BC_TYPE_CLIENT ='".$type_mat."'");
			}
		} else if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			if($type_mat==""){
				$datas = $this->sachet_impression->get_sachet_impression(["EI_DATE" => $date, "EI_EQUIPE" => $_GET['machine'], "EI_MACH" => $_GET['machine']]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE",["EI_DATE" => $date, "EI_EQUIPE" => $_GET['machine'], "EI_MACH" => $_GET['machine'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		} else if (!empty($_GET['operateurs'])) {
			if($type_mat==""){
				$datas = $this->sachet_impression->get_sachet_impression(["EI_DATE" => $date, "EI_EQUIPE" => $_GET['operateurs']]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE",["EI_DATE" => $date, "EI_EQUIPE" => $_GET['operateurs'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		} else if (!empty($_GET['machine'])) {
			if($type_mat==""){
				$datas = $this->sachet_impression->get_sachet_impression(["EI_DATE" => $date, "EI_MACH" => $_GET['machine']]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE",["EI_DATE" => $date, "EI_MACH" => $_GET['machine'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		} else {
			if($type_mat==""){
				$datas = $this->sachet_impression->get_sachet_impression(["EI_DATE" => $date]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_impression","commande","sachet_impression.BC_ID=`commande.BC_PE",["EI_DATE" => $date,"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		}

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
			$sub_array[] = "<a href='#' id='$row->EI_ID' class='btn btn-warning btn-sm edit_print_data'><i class='fa fa-edit'></i>&nbsp;Modifier prod</a>";
			$sub_array[] = "<a href='#' id='$row->BC_ID' refnum_prod='$row->EI_ID' class='btn btn-secondary btn-sm edit_print_mat'><i class='fa fa-edit'></i>&nbsp; Modiffier matière</a>";
			$sub_array[] = "<a href='#' id='$row->EI_ID' class='btn btn-danger btn-sm delete_Imprim_matiere'><i class='fa fa-trash'></i>&nbsp; Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_list_use_update_matiere_print()
	{
		$this->load->model("matiere_impression_use");
		$param = array();
		$refnum = $this->input->get("refnum");
		if ($refnum != "") {
			$param = ["MI_PO" => $refnum];
		}
		$datas = $this->matiere_impression_use->get_matiere_impression_use($param);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->MI_ID;
			$sub_array[] = $row->MI_DATE;
			$sub_array[] = $row->MI_PO;
			$sub_array[] = $row->MI_DESIGNATION;
			$sub_array[] = $row->MI_QUANTITE;
			$sub_array[] = $row->MI_PRIX;
			$sub_array[] = "<a href='#' id='$row->MI_ID' class='btn btn-danger btn-sm delete_Imprim_matiere'><i class='fa fa-trash'></i>&nbsp; Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_list_use_matiere_print()
	{
		$this->load->model("matiere_impression_use");
		$param = array();
		$refnum = $this->input->get("refnum");
		if ($refnum != "") {
			$param = ["MI_PO" => $refnum];
		}

		if($refnum==""){
			$refnum = $this->input->get("refnum_prod");
			if ($refnum != "") {
				$param = ["MI_PROD" => $refnum];
			}
		}
		
		$datas = $this->matiere_impression_use->get_matiere_impression_use($param);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->MI_DATE;
			$sub_array[] = $row->MI_PO;
			$sub_array[] = $row->MI_DESIGNATION;
			$sub_array[] = $row->MI_QUANTITE;
			$sub_array[] = "<a href='#' id='$row->MI_ID' class='btn btn-danger btn-sm delete_matiere'><i class='fa fa-trash'></i>&nbsp; Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function get_data_sachet_extrusion(){
		$refnum = $this->input->post("refnum");
		$datas = $this->sachet_extrusion->get_sachet_extrusion(['EX_BC_ID' =>$refnum]);
		echo json_encode($datas);
	}
	public function save_verification_matiere(){
		$this->load->model("verification_matiere");
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
		return  $this->verification_matiere->insert_verification_matiere($data);
	}
	public function get_form_verification(){
		
		$data = [
			"VM_PO" => $this->input->post('param'),
		];
		$this->load->model('machine');
		$this->load->model('verification_matiere');

		$me = $this->verification_matiere->get_last_verification_matiere($data);
		$machine = $this->machine->get_machine(array());
		$donne =  $this->verification_matiere->get_verification_matiere($data);
		$lastData = $this->sachet_extrusion->get_detail_sachet_extrusion(["EX_BC_ID" => $this->input->post('param'), "EX_EQUIP" => $this->input->post('goupe'), "EX_DATE" => $this->input->post('datePro')]);
		$this->load->view('production/verification_matiere/form_verification', ["me" => $me, "last" => $lastData, "donne" => $donne, 'PO' => $this->input->post('param'), "equipe" => $this->input->post('goupe'), "machine" => $machine]);	
	}
	public function sachet_extrusion_data_list()
	{

		if (isset($_GET['debut']) and !empty($_GET['debut'])) {
			$date = $_GET['debut'];
		} else {
			$date = date('Y-m-d');
		}
        $type = $this->input->post('type');
	    $type_mat = $this->input->get('type_mat');
		$methodeOk = $type !="";

		if (!empty($_GET['po'])) {
			$datas = $this->sachet_extrusion->get_sachet_extrusion(['EX_BC_ID' => $_GET['po']]);
			
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])  and  !empty($_GET['machine'])) {
			if($type_mat !=""){
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=commande.BC_PE","EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND EX_N_MACH like '" . $_GET['machine'] . " AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}else{
			    $datas = $this->sachet_extrusion->get_sachet_extrusion("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND EX_N_MACH like '" . $_GET['machine'] . "')");
			}
	
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs']) and  !empty($_GET['machine'])) {
			if($type_mat ==""){
				$datas = $this->sachet_extrusion->get_sachet_extrusion("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] . "' AND EX_N_MACH like '" . $_GET['machine'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=commande.BC_PE","EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] . "' AND EX_N_MACH like '" . $_GET['machine'] . "AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}
		} else if (!empty($_GET['date']) and !empty($_GET['debut']) and !empty($_GET['operateurs'])) {
			if($type_mat ==""){
				$datas = $this->sachet_extrusion->get_sachet_extrusion("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=`commande`.`BC_PE`","EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "' AND  EX_EQUIP like '" . $_GET['operateurs'] ."' AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}		
		} else if (!empty($_GET['date']) and !empty($_GET['debut'])) {
			if($type_mat ==""){
				$datas = $this->sachet_extrusion->get_sachet_extrusion("EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] . "')");
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=commande.BC_PE","EX_DATE BETWEEN '$date' AND '" . $_GET['date'] . "' AND ( EX_QAURT like '" . $_GET['quart'] ."'AND commande.BC_TYPE_CLIENT ='".$type_mat."')");
			}
		} else  if (!empty($_GET['operateurs']) and !empty($_GET['machine'])) {
			if($type_mat ==""){
				$datas = $this->sachet_extrusion->get_sachet_extrusion(['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine'], "EX_EQUIP" => $_GET['operateurs']]);
			}else{
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=`commande.BC_PE",['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine'], "EX_EQUIP" => $_GET['operateurs'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}
		} else if (!empty($_GET['operateurs'])) {
			if($type_mat !=""){
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=`commande.BC_PE",['EX_DATE' => $date, "EX_EQUIP" => $_GET['operateurs'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}else{
				$datas = $this->sachet_extrusion->get_sachet_extrusion(['EX_DATE' => $date, "EX_EQUIP" => $_GET['operateurs']]);
			}
		} else if (!empty($_GET['machine'])) {
			if($type_mat ==""){
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=`commande.BC_PE",['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine'],"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}else{
				$datas = $this->sachet_extrusion->get_sachet_extrusion(['EX_DATE' => $date, "EX_N_MACH" => $_GET['machine']]);
			}
		} else {
			if($type_mat !=""){
				$datas =$this->global->get_data_joint_parameter("sachet_extrusion","commande","sachet_extrusion.EX_BC_ID=`commande.BC_PE",['EX_DATE' => $date,"commande.BC_TYPE_CLIENT" =>$type_mat]);
			}else{
				$datas = $this->sachet_extrusion->get_sachet_extrusion(['EX_DATE' => $date]);
			}
		}
    
		$data = array();
		foreach ($datas as $row) {
			$nreoul = explode("+", $row->EX_RLL);
			$sub_array = array();
			$sub_array[] = $row->EX_DATE;
			$sub_array[] = $row->EX_BC_ID;
			$sub_array[] = $row->EX_METRE_SOMME;
			$sub_array[] = $row->EX_PDS_NET;
			$sub_array[] = $row->EX_DECHETS;
			$sub_array[] = $row->EX_PDS_SOMME;
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
			$sub_array[] = "<a href='#' id='$row->EX_ID' class='btn btn-warning btn-sm edit_extrusion'><i class='fa fa-edit'></i> Modifier</a>";
			$sub_array[] = "<a href='#' id='$row->EX_ID' class='btn btn-danger btn-sm delete_extrusion'><i class='icon-trash'></i>&nbsp;Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function detail_extrusion_production()
	{
		$id = $this->input->post("id");
		$reponse = $this->sachet_extrusion->get_detail_sachet_extrusion(["EX_ID" => $id]);
		echo json_encode($reponse);
	}

	public function delete_extrusion_production()
	{
		$id = $this->input->post("id");
		echo $this->sachet_extrusion->delete_sachet_exrusion(["EX_ID" => $id]);
	}
	public function delete_extrusion()
	{
		$refnum = $this->input->post('refnum');
		echo $this->sachet_extrusion->delete_sachet_exrusion(["EX_ID" => $refnum]);
	}
	public function autocomplete_operateur()
	{
		$resultat = array();
		$mot = $this->input->get('term');
		$data = $this->operateur->get_operateur("OP_NOM like '%$mot%' LIMIT 5");
		foreach ($data as $key => $data) {
			$resultat[] = $data->OP_NOM;
		}
		echo json_encode($resultat);
	}
	public function autocomplet_reference_matiere()
	{
		$resultat = array();
		$mot = $this->input->get('term');
		$data = $this->stock_matier_premier->get_stock_matier_premier("ST_DESIGNATION like '%$mot%' LIMIT 5");
		foreach ($data as $key => $data) {
			$resultat[] = $data->ST_DESIGNATION . " | " . $data->ST_UNITE;
		}
		echo json_encode($resultat);
	}

	public function autocomplete_contolle_qualite()
	{
		$resultat = array();
		$mot = $this->input->get('term');
		$data = $this->operateur->get_operateur("OP_NOM like '%$mot%' AND OP_FONCTION = 'QC' LIMIT 5");
		foreach ($data as $key => $data) {
			$resultat[] = $data->OP_NOM;
		}
		echo json_encode($resultat);
	}


	public function autocomplete_machine()
	{

		$resultat = array();
		$mot = $this->input->get('term');
		$data = $this->machine->get_machine("MA_DESIGNATION like '%$mot%' LIMIT 5");
		foreach ($data as $key => $data) {
			$resultat[] = $data->MA_DESIGNATION;
		}
		echo json_encode($resultat);
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
	public function save_matiere_utiliser()
	{
		$this->load->model("matiere_impression_use");
		$refnum_commande = $this->input->post("refnum_commande");
		$refnum_production = $this->input->post("refnum_production");
		$date = $this->input->post("date");
		$designation = $this->input->post("designation");
		$quantite = $this->input->post("quantite");
		$prix = $this->input->post("prix");


		$data = ["MI_PROD" => $refnum_production, "MI_DESIGNATION" => $designation, "MI_PO" => $refnum_commande, "MI_QUANTITE" => $quantite, "MI_DATE" => $date, "MI_PRIX" => $prix];
		echo $this->matiere_impression_use->insert_matiere_impression_use($data);
	}
	public function save_sachet_impression()
	{
		$poid = 0;
		$dechet = 0;
		$mettrage = 0;
		try {

			eval('$mettrage = ' . $this->input->post("EI_METRAGE") . ';');
			eval('$dechet =' . $this->input->post("EI_DECHET") . ';');
			eval('$poid =' . $this->input->post("EI_POIDS") . ';');


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
				"EI_DEBUT"=>$this->input->post("EX_DEBUT"),
				"EI_FIN "=>$this->input->post("EX_FIN"),
				"EI_MACH" => $this->input->post("EI_MACH"),
				"EI_TAILLE" => $this->input->post("EI_TAILLE"),
				"EI_OBSERVATION" => $this->input->post("EI_OBS"),
				"EI_RLX" => $this->input->post("EI_RLX"),
				"EI_DECHET" => $dechet,
				"EI_PDS_SOMME" => $poid,
				"EI_DECHETS" => $this->input->post("EI_DECHET"),
				"EI_METRE_SOMME" => $mettrage,
				"EI_RESTE_GAINE" => $this->input->post("EI_RESTE_GAINE"),
			];
			$methodOk =$this->sachet_impression->insert_sachet_impression($data);

			if($methodOk){
				$commande_detail = $this->commande->select_commande(["BC_PE"=>$this->input->post("BC_ID")]);
				if ($commande_detail->BC_TYPE == 'GTI') {
					$methodeOk = $this->save_entree_gaine(date('Y-m-d'),$this->input->post("BC_ID"),$commande_detail->BC_CLIENT,$commande_detail->BC_CODE,$commande_detail->BC_DIMENSION,$this->input->post("EI_TAILLE"),$EX_PDS_NET,$commande_detail->BC_PRIX);
				}
			}
           echo $methodeOk;

		} catch (\Throwable $th) {
			echo 'erreur';
		}
	}
    public function action_edit_print_data(){
		$poid = 0;
		$dechet = 0;
		$mettrage = 0;
		$refnum = $this->input->post("EI_ID");
		try {

			eval('$mettrage = ' . $this->input->post("EI_METRAGE") . ';');
			eval('$dechet =' . $this->input->post("EI_DECHET") . ';');
			eval('$poid =' . $this->input->post("EI_POIDS") . ';');


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
				"EI_DEBUT"=>$this->input->post("EX_DEBUT"),
				"EI_FIN "=>$this->input->post("EX_FIN"),
				"EI_MACH" => $this->input->post("EI_MACH"),
				"EI_TAILLE" => $this->input->post("EI_TAILLE"),
				"EI_OBSERVATION" => $this->input->post("EI_OBS"),
				"EI_RLX" => $this->input->post("EI_RLX"),
				"EI_DECHET" => $dechet,
				"EI_PDS_SOMME" => $poid,
				"EI_DECHETS" => $this->input->post("EI_DECHET"),
				"EI_METRE_SOMME" => $mettrage,
				"EI_RESTE_GAINE" => $this->input->post("EI_RESTE_GAINE"),
			];
			echo $this->sachet_impression->update_sachet_impression(["EI_ID"=>$refnum],$data);
		} catch (\Throwable $th) {
			echo 'erreur';
		}
	}
	public function save_update_extrusion()
	{

		$mettrage = 0;
		$poid = 0;
		try {
			$dechet = $this->input->post("EX_DECHETS");
			eval('$poid =' . $this->input->post("EX_PDS_BRUT") . ";");
			eval('$mettrage=' . $this->input->post("EX_METRE") . ';');
			$EX_PDS_NET =  $dechet + $poid;
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
				"EX_DEBUT" => $this->input->post("EX_DEBUT"),
				"EX_FIN" => $this->input->post("EX_FIN"),
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
			echo json_encode($this->sachet_extrusion->update_sachet_extrusion(["EX_ID" => $this->input->post("EX_ID")], $data));
		} catch (\Throwable $th) {
			echo 'erreur';
		}
	}
	public function save_sachet_extrusion()
	{
		$methode_ok = false;
		$mettrage = 0;
		$poid = 0;
		$dechet = $this->input->post("EX_DECHETS");
		eval('$poid =' . $this->input->post("EX_PDS_BRUT") . ";");
		eval('$mettrage=' . $this->input->post("EX_METRE") . ';');
		$EX_PDS_NET =  $dechet + $poid;
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
			"EX_DEBUT" => $this->input->post("EX_DEBUT"),
			"EX_FIN" => $this->input->post("EX_FIN"),
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
		$methodOk = $this->sachet_extrusion->insert_sachet_exrusion($data);
        
		/*if($methodOk){
			$commande_detail = $this->commande->select_commande(["BC_PE"=>$this->input->post("EX_BC_ID")]);
			if ($commande_detail->BC_TYPE == 'GT') {
				$this->save_entree_gaine(date('Y-m-d'),$this->input->post("EX_BC_ID"),$commande_detail->BC_CLIENT,$commande_detail->BC_CODE,$commande_detail->BC_DIMENSION,$this->input->post("EX_TAILL"),$poid,$commande_detail->BC_PRIX);
			}
		}*/
		

		echo json_encode($methodOk);
	}

	public function save_entree_gaine($date,$refnum ,$client,$Codeclient,$dim,$taille,$entre,$valeur,$obs=""){
        $data_entree = [
			"EF_DATE`"=>$date, 
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
					"STF_VALEUR"=>$valeur
					];
		   echo $this->stock_gaines_plasmad->insert_stock_gaines_plasmad($data);
		}
		
	}


	public function save_sachet_coupe()
	{

		$mettrage = 0;
		$choix1 = 0;
		$choix2 = 0;
		$gaine = 0;
		$dechet = 0;
		$poid = 0;
		$poidEntre = 0;
		eval('$mettrage =' . $this->input->post("ED_METRAGE") . ';');
		eval('$choix1 =' . $this->input->post("ED_1ER_CHOIX") . ';');
		eval('$choix2 =' . $this->input->post("ED_2E_CHOIX") . ';');
		eval('$gaine =' . $this->input->post("ED_GAINE_TIRE") . ';');
		// eval('$dechet='.$this->input->post("EI_DECHET").';');
		eval('$poid =' . $this->input->post("ED_POID_SORTIE") . ';');
		eval('$poidEntre=' . $this->input->post("ED_POID_ENTRE") . ';');

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
			"ED_HEURE" => $heureF1. "-" . $heureF2,
			"ED_DEBUT"=>$this->input->post("EX_DEBUT"),
			"ED_FIN"=>$this->input->post("EX_FIN"),
			"ED_OBSERVATION" => $this->input->post("ED_OBSERVATION2"),
			"ED_OBSERVATION2" => $this->input->post("ED_OBSERVATION")
		];

		$methodeOk = $this->sachet_coupe->insert_sachet_coupe($data);
		/*if($methodeOk){
			$type = "entree";
			$obs = "Saisie production";
            $methodeOk = $this->save_entre_produit_fini($this->input->post("ED_DATE"),$this->input->post("BC_ID"),$this->input->post("ED_TAILL"),$choix1,$type,$obs);
		}*/

		if($methodeOk){
			$methodeOk = $this->save_deuxieme_choix( $this->input->post("BC_ID"),$this->input->post("ED_TAILL"),$choix2);
		}

		echo json_encode($methodeOk);
	}


	public function save_deuxieme_choix($refnum, $tail,$quantite_choix){
        $this->load->model('stock_deuxieme_choix_plasmad');
		$this->load->model("commande");
		$detail_produit = $this->commande->select_commande(["BC_PE" => $refnum]);
		$methodOk = $detail_produit != null;

		if($methodOk){
			$data = ["SD_PO"=>$refnum,"SD_TAILL"=> $tail];
			$deuxieme_choix = $this->stock_deuxieme_choix_plasmad->get_detail_stock_deuxieme_choix_plasmad($data);
			$methodOk = $deuxieme_choix != null;
			if($methodOk){
				$quantite = $quantite_choix + $deuxieme_choix->SD_QUANTITE;
				$requette = ["SD_ID"=>$deuxieme_choix->SD_ID,"SD_TAILL"=> $tail];
				$data = ["SD_QUANTITE"=> $quantite];
				$methodOk = $this->stock_deuxieme_choix_plasmad->update_stock_deuxieme_choix_plasmad($requette,$data);
			}else{
				$data = ["SD_QUANTITE"=> $quantite_choix,"SD_PO"=>$refnum,"SD_DIMM"=>$detail_produit->BC_DIMENSION,"SD_TAILL"=>$tail];
				$methodOk  =$this->stock_deuxieme_choix_plasmad->insert_stock_deuxieme_choix_plasmad($data);
			}
       }
	   return $methodOk;
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
	public function update_sachet_coupe(){
		$mettrage = 0;
		$choix1 = 0;
		$choix2 = 0;
		$gaine = 0;
		$poid = 0;
		$poidEntre = 0;
		eval('$mettrage =' . $this->input->post("ED_METRAGE") . ';');
		eval('$choix1 =' . $this->input->post("ED_1ER_CHOIX") . ';');
		eval('$choix2 =' . $this->input->post("ED_2E_CHOIX") . ';');
		eval('$gaine =' . $this->input->post("ED_GAINE_TIRE") . ';');
		// eval('$dechet='.$this->input->post("EI_DECHET").';');
		eval('$poid =' . $this->input->post("ED_POID_SORTIE") . ';');
		eval('$poidEntre=' . $this->input->post("ED_POID_ENTRE") . ';');

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
			"ED_HEURE" => $heureF1. "-" . $heureF2,
			"ED_DEBUT"=>$this->input->post("EX_DEBUT"),
			"ED_FIN"=>$this->input->post("EX_FIN"),
			"ED_OBSERVATION" => $this->input->post("ED_OBSERVATION2"),
			"ED_OBSERVATION2" => $this->input->post("ED_OBSERVATION")
		];

		echo $this->sachet_coupe->update_sachet_coupe(["ED_ID"=>$this->input->post("ED_ID")],$data);
		
	}
	public function update_sachet_matiere_impression(){
		$this->render_view("production/sachet/update_matiere");
	}
    public function get_data_list_injection(){
		$this->load->model("cintre_injection");
		if (isset($_GET['date_debut_show']) AND !empty($_GET['date_debut_show'])) {
			$date = $_GET['date_debut_show'];
		} else {
			$date = date('Y-m-d');
		}
		
		if (!empty($_GET['refnum_commande'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection(['BC_PO' => $_GET['refnum_commande']]);
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show'])  and  !empty($_GET['machine_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND IN_MACHINE like '" . $_GET['machine_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) and !empty($_GET['Operateur_show']) and  !empty($_GET['machine'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND  IN_OPERATEUR1 like '" . $_GET['Operateur_show'] . "' AND IN_MACHINE like '" . $_GET['machine_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) and !empty($_GET['Operateur_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND  IN_OPERATEUR1 like '" . $_GET['Operateur_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) AND !empty($_GET['Quart_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "'");
		} else  if (!empty($_GET['Operateur_show']) and !empty($_GET['machine_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection(['IN_DATE' => $date, "IN_MACHINE" => $_GET['machine_show'], "IN_OPERATEUR1" => $_GET['Operateur_show']]);
		} else if (!empty($_GET['Operateur_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection(['IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['Operateur_show']]);
		} else if (!empty($_GET['machine_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection(['IN_DATE' => $date, "IN_MACHINE" => $_GET['machine_show']]);
		} else if (!empty($_GET['Quart_show'])) {
			$datas = $this->cintre_injection->get_date_cintre_injection(['IN_DATE' => $date, "QUART_TIME" => $_GET['Quart_show']]);
	
		} else {
			$datas = $this->cintre_injection->get_date_cintre_injection(['IN_DATE' => $date]);
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
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-warning btn-sm edit_cintre_injection'><i class='fa fa-edit'></i> Modifier</a>";
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-danger btn-sm delete_cintre_injection'><i class='icon-trash'></i>&nbsp;Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

    public function get_data_list_cintre_impression(){
		$this->load->model("cintre_impression");

		if (isset($_GET['date_debut_show']) AND !empty($_GET['date_debut_show'])) {
			$date = $_GET['date_debut_show'];
		} else {
			$date = date('Y-m-d');
		}
		
		if (!empty($_GET['refnum_commande'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression(['BC_PO' => $_GET['refnum_commande']]);
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show'])  and  !empty($_GET['machine_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND IN_MACHINE like '" . $_GET['machine_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) and !empty($_GET['Operateur_show']) and  !empty($_GET['machine'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND  IN_OPERATEUR1 like '" . $_GET['Operateur_show'] . "' AND IN_MACHINE like '" . $_GET['machine_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) and !empty($_GET['Operateur_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND  IN_OPERATEUR1 like '" . $_GET['Operateur_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) AND !empty($_GET['Quart_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "'");
		} else  if (!empty($_GET['Operateur_show']) and !empty($_GET['machine_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression(['IN_DATE' => $date, "IN_MACHINE" => $_GET['machine_show'], "IN_OPERATEUR1" => $_GET['Operateur_show']]);
		} else if (!empty($_GET['Operateur_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression(['IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['Operateur_show']]);
		} else if (!empty($_GET['machine_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression(['IN_DATE' => $date, "IN_MACHINE" => $_GET['machine_show']]);
		} else if (!empty($_GET['Quart_show'])) {
			$datas = $this->cintre_impression->get_date_cintre_impression(['IN_DATE' => $date, "QUART_TIME" => $_GET['Quart_show']]);
	
		} else {
			$datas = $this->cintre_impression->get_date_cintre_impression(['IN_DATE' => $date]);
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
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-warning btn-sm edit_cintre_injection'><i class='fa fa-edit'></i> Modifier</a>";
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-danger btn-sm delete_cintre_injection'><i class='icon-trash'></i>&nbsp;Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);

	}

	public function get_data_list_cintre_hook(){
		$this->load->model("cintre_hook");
		
		if (isset($_GET['date_debut_show']) AND !empty($_GET['date_debut_show'])) {
			$date = $_GET['date_debut_show'];
		} else {
			$date = date('Y-m-d');
		}
		
		if (!empty($_GET['refnum_commande'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook(['BC_PO' => $_GET['refnum_commande']]);
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show'])  and  !empty($_GET['machine_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND IN_MACHINE like '" . $_GET['machine_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) and !empty($_GET['Operateur_show']) and  !empty($_GET['machine'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND  IN_OPERATEUR1 like '" . $_GET['Operateur_show'] . "' AND IN_MACHINE like '" . $_GET['machine_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) and !empty($_GET['Operateur_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "' AND  IN_OPERATEUR1 like '" . $_GET['Operateur_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show']) AND !empty($_GET['Quart_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "' AND ( QUART_TIME like '" . $_GET['Quart_show'] . "')");
		} else if (!empty($_GET['date_debut_show']) and !empty($_GET['date_fin_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook("IN_DATE BETWEEN '$date' AND '" . $_GET['date_fin_show'] . "'");
		} else  if (!empty($_GET['Operateur_show']) and !empty($_GET['machine_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook(['IN_DATE' => $date, "IN_MACHINE" => $_GET['machine_show'], "IN_OPERATEUR1" => $_GET['Operateur_show']]);
		} else if (!empty($_GET['Operateur_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook(['IN_DATE' => $date, "IN_OPERATEUR1" => $_GET['Operateur_show']]);
		} else if (!empty($_GET['machine_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook(['IN_DATE' => $date, "IN_MACHINE" => $_GET['machine_show']]);
		} else if (!empty($_GET['Quart_show'])) {
			$datas = $this->cintre_hook->get_date_cintre_hook(['IN_DATE' => $date, "QUART_TIME" => $_GET['Quart_show']]);
	
		} else {
			$datas = $this->cintre_hook->get_date_cintre_hook(['IN_DATE' => $date]);
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
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-warning btn-sm edit_cintre_hook'><i class='fa fa-edit'></i> Modifier</a>";
			$sub_array[] = "<a href='#' id='$row->IN_ID' class='btn btn-danger btn-sm delete_cintre_hook'><i class='icon-trash'></i>&nbsp;Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);

	}

	public function delete_date_cintre_impression (){
		$this->load->model("cintre_impression");
		$refnum = $this->input->post("refnum");
		$data = $this->cintre_impression->delete_date_cintre_impression(["IN_ID"=>$refnum]);
        echo  json_encode($data);
	}
	public function delete_date_cintre_injection(){
		$this->load->model("cintre_injection");
		$refnum = $this->input->post("refnum");
		$data = $this->cintre_injection->delete_date_cintre_injection(["IN_ID"=>$refnum]);
        echo  json_encode($data);
	}
	public function delete_date_cintre_hook(){
		$this->load->model("cintre_hook");
		$refnum = $this->input->post("refnum");
		$data = $this->cintre_injection->delete_date_cintre_hook(["IN_ID"=>$refnum]);
        echo  json_encode($data);
	}
	public function get_data_cintre_hook(){
		$this->load->model("cintre_hook");
		$refnum = $this->input->post("refnum");
		$data = $this->cintre_injection->get_detail_cintre_hook(["IN_ID"=>$refnum]);
        echo  json_encode($data);
	}

	public function get_data_cintre_injection(){
		$this->load->model("cintre_injection");
		$refnum = $this->input->post("refnum");
		$data = $this->cintre_injection->get_detail_cintre_injection(["IN_ID"=>$refnum]);
        echo  json_encode($data);
	}
	public function save_cintre_impression_data(){
		$this->load->model("cintre_impression");
		$heureF1 = $this->time_to_sec(date($this->input->post("IN_DURE") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("IN_FIN") . ":00"));

		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}
		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" =>  $this->se_to_time($heureBe),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_FIN"=>$this->input->post("IN_FIN"),
			"IN_DEBUT"=>$this->input->post("IN_DURE")
			
		];
		echo $this->cintre_impression->insert_data_cintre_impression($data);
	}
	public function save_cintre_hook_data()
	{
		$this->load->model("cintre_hook");
		$heureF1 = $this->time_to_sec(date($this->input->post("IN_DURE") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("IN_FIN") . ":00"));

		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}
		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" =>  $this->se_to_time($heureBe),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_FIN"=>$this->input->post("IN_FIN"),
			"IN_DEBUT"=>$this->input->post("IN_DURE")
			
		];
		echo $this->cintre_hook->insert_data_cintre_hook($data);
	}
	public function update_cintre_hook(){
		$this->load->model("cintre_hook");
		$heureF1 = $this->time_to_sec(date($this->input->post("IN_DURE") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("IN_FIN") . ":00"));

		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}
		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" =>  $this->se_to_time($heureBe),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_FIN"=>$this->input->post("IN_FIN"),
			"IN_DEBUT"=>$this->input->post("IN_DURE")
			
		];
		$requette = ["IN_ID"=>$this->input->post("BC_ID")];
		echo $this->cintre_hook->update_date_cintre_hook($requette,$data);

	}
	public function save_injection_data()
	{
		$this->load->model("cintre_injection");
		$heureF1 = $this->time_to_sec(date($this->input->post("IN_DURE") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("IN_FIN") . ":00"));

		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}
		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" =>  $this->se_to_time($heureBe),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_FIN"=>$this->input->post("IN_FIN"),
			"IN_DEBUT"=>$this->input->post("IN_DURE")
			
		];
		echo $this->cintre_injection->insert_data_cintre_injection($data);
	}
    public function update_cintre_injection(){
		$this->load->model("cintre_injection");
		$heureF1 = $this->time_to_sec(date($this->input->post("IN_DURE") . ":00"));
		$heureF2 = $this->time_to_sec(date($this->input->post("IN_FIN") . ":00"));

		if ($heureF2 < $heureF1) {
			$heureF2 = $heureF2 + 86400;
			$heureBe = $heureF2 - $heureF1;
		} else {
			$heureBe = $heureF2 - $heureF1;
		}
		$data = [
			"BC_PO" => $this->input->post("BC_PO"),
			"IN_REFERENCE" => $this->input->post("IN_REFERENCE"),
			"IN_QTY" => $this->input->post("IN_QTY"),
			"IN_DECHETS" => $this->input->post("IN_DECHETS"),
			"IN_MACHINE" => $this->input->post("IN_MACHINE"),
			"IN_DURE" =>  $this->se_to_time($heureBe),
			"QUART_TIME" => $this->input->post("QUART_TIME"),
			"IN_OPERATEUR1" => $this->input->post("IN_OPERATEUR1"),
			"IN_OPERATEUR2" => $this->input->post("IN_OPERATEUR2"),
			"IN_MATIERES" => $this->input->post("IN_MATIERES"),
			"IN_MASTERBATCHE" => $this->input->post("IN_MASTERBATCHE"),
			"IN_OBSERVATION1" => $this->input->post("IN_OBSERVATION1"),
			"IN_OBSERVATION2" => $this->input->post("IN_OBSERVATION2"),
			"IN_DATE" => $this->input->post("IN_DATE"),
			"IN_FIN"=>$this->input->post("IN_FIN"),
			"IN_DEBUT"=>$this->input->post("IN_DURE")
			
		];
		$requette = ["IN_ID"=>$this->input->post("BC_ID")];
		echo $this->cintre_injection->update_date_cintre_injection($requette,$data);

	}
	public function save_entre_encre($entre, $taill, $date, $deux, $PO, $OBSE)
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

	public function edit_extrusion_coupe()
	{
		$refnum = $this->input->post('refnum');
		$reponse = $this->sachet_coupe->get_detail_sachet_coupe(["ED_ID" => $refnum]);
		echo json_encode($reponse);
	}
	public function delete_coupe()
	{
		$refnum = $this->input->post('refnum');
		echo $this->sachet_coupe->delete_sachet_coupe(["ED_ID" => $refnum]);
	}
	public function extrusion_form()
	{
		$param = $this->input->post('param');
		switch ($param) {
			case 'extrusion':
				$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "EXTRUSION"]);
				$operateur = $this->operateur->get_operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('production/form/extrusion', $data);
				break;
			case 'injection':
				$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "EXTRUSION"]);
				$operateur = $this->operateur->get_operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('production/form/injection');
				break;
			case 'sachet_impression':
				$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION"]);
				$operateur = $this->operateur->get_operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('production/form/sachet_inpression', $data);
				break;
			case 'coupe':
				$machine = $this->machine->get_machine(["MA_SPECIFIQUE" => "COUPE_EXTRUSION"]);
				$operateur = $this->operateur->get_operateur(["OP_STATUT" => "on"]);
				$data = [
					"EQUIPE" => $operateur,
					"MACHINE" => $machine
				];
				$this->load->view('production/form/extrusion_coupe', $data);
				break;
			default:
				echo false;
				break;
		}
	}
}
