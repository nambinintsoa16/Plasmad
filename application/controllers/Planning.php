<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Planning extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}
	public function commande_non_planifier()
	{

		$this->render_view('planning/commande/non_planifier');
	}
	public function terminer_commande(){
		$this->load->model('commande');
		$refnum = $this->input->post('refnum');
		echo $this->commande->update_commande(["BC_PE"=>$refnum], ["BC_STATUT" => "TERMINER"]);
	}
	public function Commande_terminer()
	{

		$this->render_view('planning/Terminer_commande/Terminer');
	}
	public function commande_suivie()
	{
		$this->render_view('planning/commande/suivie');
	}
	public function detail_production()
	{
		$this->load->model("sachet_impression");
		$this->load->model("sachet_extrusion");
		$this->load->model("sachet_coupe");
		$refnum = $this->input->post('refnum');
		$data = [
			"extrusion" => $this->sachet_extrusion->get_sachet_extrusion(["EX_BC_ID" => $refnum]),
			"impression" => $this->sachet_impression->get_sachet_impression(["BC_ID" => $refnum]),
			"coupe" => $this->sachet_coupe->get_sachet_coupe(["BC_ID" => $refnum]),
			"refnum" => $refnum
		];
		$this->load->view('Planning/Reconciliation/data_Production', $data);
	}
	public function Sachet_extrusion_data()
	{
		$this->load->model('sachet_extrusion');
		$refnum = $_GET['PO'];
		$data = array();
		$datas = $this->sachet_extrusion->get_sachet_extrusion(["EX_BC_ID" => $refnum]);
		
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
	public function Sachet_impression_data()
	{
		$this->load->model('sachet_impression');
		$refnum = $_GET['PO'];
		$datas =$this->sachet_impression->get_sachet_impression(["BC_ID" => $refnum]);
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
	public function Sachet_coupe_data()
	{
		$this->load->model('sachet_coupe');
		$refnum = $_GET['PO'];
		$datas = $this->sachet_coupe->get_sachet_coupe(["BC_ID" => $refnum]);
		$data = array();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->ED_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->ED_RLX;
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
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function update_commande()
	{
		$this->load->model('commande');
		$refnum = $this->input->post('refnum');
		$quantite_en_mettre = $this->input->post('quantite_en_mettre');
		$poids_en_kg = $this->input->post('poids_en_kg');
		$dim_prod = $this->input->post('dim_prod');
		$nb_rouleaux = $this->input->post('nb_rouleaux');
		$poid_sachet = $this->input->post('poid_sachet');
		$data = [
			"BC_STATUT" => "PLANIFIER",
			"BC_ROULEAUX" => $nb_rouleaux,
			"BC_QUANTITEAPRODUIREENMETRE" => $quantite_en_mettre,
			"BC_POISENKGSAVECMARGE" => $poids_en_kg,
			"BC_DIMENSIONPROD" => $dim_prod,
			"BC_POIDSDUNSACHET" => $poid_sachet
		];
		echo json_encode($this->commande->update_commande(["BC_PE" => $refnum], $data));
	}
	public function insert_matiere_utiliser()
	{
		$this->load->model('planning_matiere_utiliser');
		$quantite = $this->input->post('quantite');
		$designation = $this->input->post('designation');
		$prix = $this->input->post('prix');
		$refnum = $this->input->post('refnum');
		$param = [
			"MU_QUANTITE" => $quantite,
			"MU_STATUT" => "SORTIE NON VALIDER",
			"MU_DESIGNATION" => $designation,
			"MU_PRIX" => $prix,
			"BC_PE" => $refnum,
			"MU_TYPE" => "NORMAL"

		];
		$this->planning_matiere_utiliser->insert_planning_matiere_utiliser($param);
	}
	public function liste_commande_sachet_all_champ()
	{
		$this->load->model("commande");
		$date = date('Y-m-d');
		$datas = $data = array();

		$methodOk = $this->input->get("date") != "";

		if ($methodOk) {
			$date = $this->input->get("date");
			$datas = $this->commande->select_commande_all(['BC_DATE' => $date,"BC_STATUT" => "NON PLANIFIER"]);
		}
		$methodOk = $this->input->get("refnum")  != "" && $methodOk == false;
		if ($methodOk) {
			$refnum =  $this->input->get("refnum");
			$datas = $this->commande->select_commande_all(['BC_PE' => $refnum, "BC_STATUT" => "NON PLANIFIER"]);
		}
		if ($methodOk == false) {
			$datas = $this->commande->select_commande_all(['BC_DATE' => $date,"BC_STATUT" => "NON PLANIFIER"]);
		}
		foreach ($datas as $row) {
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
			$sub_array[] = $row->BC_MODEL;
			$sub_array[] = $row->BC_IMPRESSION;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_REASSORT;
			$sub_array[] = $row->BC_RABAT;
			$sub_array[] = $row->BC_SOUFFLET;
			$sub_array[] = $row->BC_PERFORATION;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_QUANTITEAPRODUIREENMETRE;
			$sub_array[] = $row->BC_POIDSDUNSACHET;
			$sub_array[] = $row->BC_POISENKGSAVECMARGE;
			$sub_array[] = $row->BC_DIMENSIONPROD;
			$sub_array[] = $row->BC_ROULEAUX;
			$sub_array[] = '<button type="button" class="btn btn-primary btn-observation btn-sm" id="' . $row->BC_PE . '">OBSERVATION</button>';
			$sub_array[] = '<a href="#" class="btn btn-success btn-sm mise_en_prod"><i class="fa fa-edit"></i>&nbsp; Création job card</a>';
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function Sachet_extrusion()
	{
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" => $machine = $this->machine->get_machine($param)
		];
		$this->render_view('planning/Job_card/Sachet/extrusion', $data);
	}
	public function Sachet_impression()
	{
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" =>  $this->machine->get_machine($param)
		];
		$this->render_view('planning/Job_card/Sachet/sachet_impression', $data);
	}
	public function Sachet_coupe()
	{
		$this->load->model('machine');
		$param = [
			"MA_SPECIFIQUE" => "COUPE_EXTRUSION",
			"MA_STATUT" => "on"
		];
		$data = [
			"machine" =>  $this->machine->get_machine($param)
		];
		$this->render_view('planning/Job_card/Sachet/sachet_coupe', $data);
	}
	

	public function get_liste_livraison()
	{
		$this->load->model('global');
		$date = $this->input->get('date');
		$refnum = $this->input->get('refnum');
		$methodOk= $date!="";
		$methodOk  ? "" : $date = date('Y-m-d'); 

		$int_table="date_de_livraison";
		$joint_table="commande";
		$param_joint="date_de_livraison.DL_PO  = commande.BC_PE";
		$param_select=["DL_DATE"=>$date];
		if($methodOk ==false){
			$methodOk= $refnum!="";
			$param_select=["DL_PO"=>$refnum];
		}
		
	
		$datas = $this->global->get_data_joint_parameter($int_table,$joint_table,$param_joint,$param_select);
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
    public function get_recap_machine_extrusion(){
		$this->load->model('machine');
		$date = $this->input->post("date");
		$machine = $this->input->post("machine");
		$data = [
			"machine" => $machine ,
			"date"=>$date
		];
		$this->load->view("planning/Reconciliation/Recap_machine_extrusion",$data);
	}
	public function get_recap_machine_impression(){
		$date = $this->input->post("date");
		$machine = $this->input->post("machine");
		$data = [
			"machine" => $machine,
			"date"=>$date
		];
		$this->load->view("planning/Reconciliation/Recap_machine_impression",$data);
	}
	public function get_data_recap_machine_impression(){
		$this->load->model('global');
		$this->load->model('machine');
		$date = $this->input->get('date');
		$machine = $this->input->get('machine');
		$dt = new DateTime($date);
		$reponse  = $dt->format('t');
		$ligne = $reponse+1;
	     for ($i = 1; $i < $ligne; $i++){
			$sub_array = array();
			$i<10 ? $i="0".$i:"";
			$date = $dt->format('Y-m')."-".$i;
			$sub_array[] = $i."-".$dt->format('m-Y');
			$param = ["EI_DATE"=>$date,"EI_MACH"=>$machine];
			$poid = $this->global->get_sum_colum($param,"EI_PDS_SOMME","sachet_impression")->EI_PDS_SOMME;
			$poid==""?$poid= "00":"";
			$sub_array[] =$poid;
			$metrage = $this->global->get_sum_colum($param,"EI_METRE_SOMME","sachet_impression")->EI_METRE_SOMME;
			$metrage==""?$metrage= "00":"";
			$sub_array[] =number_format($metrage);
			$temps_prod =  $this->global->get_somme_time("EI_DUREE",$param,"sachet_impression");
			$temps_prod->format_heure == null ? $heure_prod = "00:00:00":$heure_prod = $temps_prod->format_heure; 
			$sub_array[] =$heure_prod;
			$operateur_1 = $this->global->get_distinct_colum($param, "EI_OPERATEUR1 AS 'OPERATEUR'","sachet_impression");
			$operateur_2 = $this->global->get_distinct_colum($param, "EI_OPERATEUR2 AS 'OPERATEUR'","sachet_impression");
			$operateur_array = array_merge($operateur_1,$operateur_2);
			$operateur ="";
			foreach ($operateur_array as $key => $operateur_array) {
				if($operateur_array->OPERATEUR!=""){
					if(strpos($operateur,trim($operateur_array->OPERATEUR))===false){
						if($operateur==""){
							$operateur=$operateur_array->OPERATEUR;
						}else{
							$operateur.=" / ".$operateur_array->OPERATEUR;
						}
				   }
		     	}
			}
			$sub_array[] =$operateur;

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function get_data_recap_machine_extrusion(){
		$this->load->model('global');
		$this->load->model('machine');
		$date = $this->input->get('date');
		$machine = $this->input->get('machine');
		$detail_machine = $this->machine->get_detail_machine(['MA_DESIGNATION'=>$machine]);
		$dt = new DateTime($date);
		$reponse  = $dt->format('t');
		$ligne = $reponse+1;
	     for ($i = 1; $i < $ligne; $i++){
		    $sub_array = array();
			$i<10 ? $i="0".$i:"";
			$date = $dt->format('Y-m')."-".$i;
			$param = ["EX_DATE"=>$date,"EX_N_MACH"=>$machine];
			$sub_array[] = $i."-".$dt->format('m-Y');
            $poid_net = $this->global->get_sum_colum($param,"EX_PDS_NET","sachet_extrusion")->EX_PDS_NET;
			$sub_array[] = number_format($poid_net,2,".",",");
			$temps_prod =  $this->global->get_somme_time("EX_DUREE",$param,"sachet_extrusion");
			$temps_prod->format_heure == null ? $heure_prod = "00:00:00":$heure_prod = $temps_prod->format_heure; 
			$sub_array[] =$heure_prod;
			$utilisation = (($temps_prod->second_format/3600)/24)*100;
			$sub_array[] =number_format($utilisation,'2')." %";
			$vitesse_machine = $temps_prod->second_format/3600*$detail_machine->MA_VITESSE;
            $efficiency = 0; 
			if($vitesse_machine!=0){ $efficiency = $poid_net/$vitesse_machine;}
			$sub_array[] = number_format($efficiency,2,".",",")." %";
			$sub_array[] = number_format((100-$efficiency)/100,'2',".",",");
			$dechet = $this->global->get_sum_colum($param,"EX_DECHETS","sachet_extrusion")->EX_DECHETS;
			$sub_array[] =$dechet==""?"0":$dechet;
			$scrap = 0;
			if($poid_net!=0){$scrap =($dechet/$poid_net)*100;}
			$sub_array[] =number_format($scrap,'2')." %";
			$operateur_1 = $this->global->get_distinct_colum($param, "EX_OPERETEUR_1 AS 'OPERATEUR'","sachet_extrusion");
			$operateur_2 = $this->global->get_distinct_colum($param, "EX_OPERETEUR_2 AS 'OPERATEUR'","sachet_extrusion");
			$operateur_array = array_merge($operateur_1,$operateur_2);
			$operateur ="";
			foreach ($operateur_array as $key => $operateur_array) {
				if($operateur_array->OPERATEUR!=""){
					if(strpos($operateur,trim($operateur_array->OPERATEUR))===false){
						if($operateur==""){
							$operateur=$operateur_array->OPERATEUR;
						}else{
							$operateur.=" / ".$operateur_array->OPERATEUR;
						}
				   }
		     	}
			}
			$sub_array[] =$operateur;
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
    public function add_new_livraison(){
		$this->load->model('date_de_livraison');
		$date = $this->input->post('date');
		$refnum = $this->input->post('refnum');
		$quantite = $this->input->post('quantite');
		$param =[
			"DL_PO"=>$refnum,
			"DL_DATE"=>$date,
			"DL_QUANTITE"=>$quantite,
			"DL_USER"=>$this->session->userdata('matricule')
		];
		echo $this->date_de_livraison->insert_date_de_livraison($param);
	}

	public function current_production_extrusion()
	{
		$this->load->model('global');
		$this->load->model('machine');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$param = ["JO_MACHINE" => $machine,"JO_STATUT"=>"PLANIFIER"];
		$datas = $this->global->select_job_card_commande($param);
		$data_machine = $this->machine->get_detail_machine(['MA_DESIGNATION' => $machine]);
		$data = array();
		foreach ($datas as $key => $row) {
			$produit = $this->global->get_sum_colum(["JO_ID" => $row->JO_ID], "JO_AV", "jobcart_sachet_extrusion");
			$sortie = $this->global->get_sum_colum(["JO_ID" => $row->JO_ID], "JO_SORTIE", "jobcart_sachet_extrusion");
			$sub_array = array();
			$sub_array[] = $row->JO_IDS;
			$sub_array[] = $row->JO_ID;
			$sub_array[] = $row->JO_DATEDEDEBU;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_TYPE;
			$sub_array[] = $row->BC_TYPEMATIER;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_IMPRESSION;
			$sub_array[] = $row->BC_ECHANTILLON;
			$sub_array[] = $row->BC_QUANTITEAPRODUIREENMETRE;
			$sub_array[] = $row->BC_DIMENSIONPROD;
			$sub_array[] = $row->BC_POISENKGSAVECMARGE;
			$sub_array[] = $row->JO_SORTIE;
			$sub_array[] = $row->JO_AV;
			$sub_array[] = $sortie->JO_SORTIE - $produit->JO_AV;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $data_machine->MA_VITESSE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->JO_DATEDEDEBU;
			$sub_array[] = $row->JO_DEB;
			$sub_array[] = $row->JO_DATEFIN;
			$sub_array[] = $row->JO_FIN;
			$sub_array[] = $row->JO_DURE;
			$sub_array[] = $this->get_rest_time($sortie->JO_SORTIE - $row->JO_AV, $data_machine->MA_VITESSE);
			$sub_array[] = $row->JO_OBS;
			$row->JO_ETAT == "ON" ? $sub_array[] = "OUI" : $sub_array[] = "NON";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	
	public function current_production_sachet_coupe()
	{
		$this->load->model('global');
		$this->load->model('jobcart_sachet_coupe');
		$this->load->model('machine');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$param = ["JO_MACHINE" => $machine,"JO_STATUT"=>"PLANIFIER"];
		$datas = $this->jobcart_sachet_coupe->select_job_card_commande($param);
		$data_machine = $this->machine->get_detail_machine(['MA_DESIGNATION' => $machine]);
		$data = array();
		foreach ($datas as $key => $row) {
			$produit = $this->global->get_sum_colum(["JO_ID" => $row->JO_ID], "JO_AV", "jobcart_sachet_coupe");
			$sortie = $this->global->get_sum_colum(["JO_ID" => $row->JO_ID], "JO_SORTIE", "jobcart_sachet_coupe");
			$sub_array = array();
			$sub_array[] = $row->JO_IDS;
			$sub_array[] = $row->JO_ID;
			$sub_array[] = $row->JO_DATEDEDEBU;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_TYPE;
			$sub_array[] = $row->BC_TYPEMATIER;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_IMPRESSION;
			$sub_array[] = $row->BC_ECHANTILLON;
			$sub_array[] = $row->BC_QUANTITEAPRODUIREENMETRE;
			$sub_array[] = $row->BC_DIMENSIONPROD;
			$sub_array[] = $row->BC_POISENKGSAVECMARGE;
			$sub_array[] = $row->JO_SORTIE;
			$sub_array[] = $row->JO_AV;
			$piece = explode("P",$row->BC_QUNTITE);
			$sub_array[] = trim($piece[0]) - $produit->JO_AV;
			
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $data_machine->MA_VITESSE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->JO_DATEDEDEBU;
			$sub_array[] = $row->JO_DEB;
			$sub_array[] = $row->JO_DATEFIN;
			$sub_array[] = $row->JO_FIN;
			$sub_array[] = $row->JO_DURE;
			$sub_array[] = $this->get_rest_time($sortie->JO_SORTIE - $row->JO_AV, $data_machine->MA_VITESSE);
			$sub_array[] = $row->JO_OBS;
			$row->JO_ETAT == "ON" ? $sub_array[] = "OUI" : $sub_array[] = "NON";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function current_production_sachet_impression()
	{
		$this->load->model('global');
		$this->load->model('jobcart_sachet_impression');
		$this->load->model('machine');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$param = ["JO_MACHINE" => $machine,"JO_STATUT"=>"PLANIFIER"];
		$datas = $this->jobcart_sachet_impression->select_job_card_commande($param);
		$data_machine = $this->machine->get_detail_machine(['MA_DESIGNATION' => $machine]);
		$data = array();
		foreach ($datas as $key => $row) {
			$produit = $this->global->get_sum_colum(["JO_ID" => $row->JO_ID], "JO_AV", "jobcart_sachet_impression");
			$sortie = $this->global->get_sum_colum(["JO_ID" => $row->JO_ID], "JO_SORTIE", "jobcart_sachet_impression");
			$sub_array = array();
			$sub_array[] = $row->JO_IDS;
			$sub_array[] = $row->JO_ID;
			$sub_array[] = $row->JO_DATEDEDEBU;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->BC_CLIENT;
			$sub_array[] = $row->BC_CODE;
			$sub_array[] = $row->BC_TYPE;
			$sub_array[] = $row->BC_TYPEMATIER;
			$sub_array[] = $row->BC_DIMENSION;
			$sub_array[] = $row->BC_IMPRESSION;
			$sub_array[] = $row->BC_ECHANTILLON;
			$sub_array[] = $row->BC_QUANTITEAPRODUIREENMETRE;
			$sub_array[] = $row->BC_DIMENSIONPROD;
			$sub_array[] = $row->BC_POISENKGSAVECMARGE;
			$sub_array[] = $row->JO_SORTIE;
			$sub_array[] = $row->JO_AV;
			$sub_array[] = $sortie->JO_SORTIE - $produit->JO_AV;
			$sub_array[] = $row->BC_QUNTITE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $data_machine->MA_VITESSE;
			$sub_array[] = $row->BC_PE;
			$sub_array[] = $row->JO_DATEDEDEBU;
			$sub_array[] = $row->JO_DEB;
			$sub_array[] = $row->JO_DATEFIN;
			$sub_array[] = $row->JO_FIN;
			$sub_array[] = $row->JO_DURE;
			$sub_array[] = $this->get_rest_time($sortie->JO_SORTIE - $row->JO_AV, $data_machine->MA_VITESSE);
			$sub_array[] = $row->JO_OBS;
			$row->JO_ETAT == "ON" ? $sub_array[] = "OUI" : $sub_array[] = "NON";

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function get_data_livraison(){
		$this->load->model('global');
		$data = array();
		$date = $this->input->get('date');
		$refnum_commande = $this->input->get('refnum_commande');
      
		if (!empty($refnum_commande) ) {
			$datas = $this->commande->select_commande_all(["BC_PE" => $refnum_commande]);
		} else if (!empty($date)) {
			$datas = $this->commande->select_commande_all(["BC_DATE"=>$date]);
		} else {
			$date = date('Y-m');
			$datas = $this->commande->select_commande_all(["BC_DATE"=>$date]);
		}

			$data = array();
			foreach ($datas as $row) {
				$sub_array = array();
				$sub_array[] = $row->BC_PE;
				$sub_array[] = $row->BC_QUNTITE;
				$sub_array[] = (int) $this->global->get_sum_colum(["C_PO"=>$row->BC_PE],"C_CHOIX","controle_qualite")->C_CHOIX;
				$magasin = $this->global->get_sum_colum(["BC_ID"=>$row->BC_PE],"SF_QUANTITE","sortie_produits_finis")->SF_QUANTITE;
				$surplus = $this->global->get_sum_colum(["SF_DESTINATION"=>$row->BC_PE],"SF_QUANTITE","sortie_surplus_finis")->SF_QUANTITE;
				$livre=(int)$magasin + (int)$surplus;
				$sub_array[] = $livre;
				$quantite = explode(" ",$row->BC_QUNTITE);
				$sub_array[] =  (int)trim($quantite[0]) - $livre;
				$sub_array[] = "<a href='#' id='$row->BC_PE' class='btn btn-info btn-sm w-100 detail'><i class='fa fa-info'></i>&nbsp;Détail</a>";
				$data[] = $sub_array;
			}
			$output = array("data" => $data);
			echo json_encode($output);
		
	}
	public function update_statut_prod()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$refnum = $this->input->post('refnum');
		$machine = $this->input->post('machine');
		$value = $this->input->post('value');
		$machine = str_replace("_", " ", $machine);
		$type = $this->input->post('type');

		switch ($type) {
			case 'mise_en_prod':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				$request = ["JO_ETAT" => "ON"];
				echo $this->jobcart_sachet_extrusion->update_jobcart_sachet_extrusion($param, $request);
				break;
			case 'terminer':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				$request = ["JO_STATUT" => "TERMINER","JO_IDS"=>""];
				echo $this->jobcart_sachet_extrusion->update_jobcart_sachet_extrusion($param, $request);
				break;
			case 'prod_terminer':
				$param = ["JO_ID" => $refnum];
				$request = ["JO_AV" => $value];
				echo $this->jobcart_sachet_extrusion->update_jobcart_sachet_extrusion($param, $request);
				break;
			case 'supprimer':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				echo $this->jobcart_sachet_extrusion->delete_jobcart_sachet_extrusion($param);
				break;

			default:
				echo 0;
				break;
		}
	}

	public function update_statut_impression_prod()
	{
		$this->load->model('jobcart_sachet_impression');
		$refnum = $this->input->post('refnum');
		$machine = $this->input->post('machine');
		$value = $this->input->post('value');
		$machine = str_replace("_", " ", $machine);
		$type = $this->input->post('type');

		switch ($type) {
			case 'mise_en_prod':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				$request = ["JO_ETAT" => "ON"];
				echo $this->jobcart_sachet_impression->update_jobcart_sachet_impression($param, $request);
				break;
			case 'terminer':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				$request = ["JO_STATUT" => "TERMINER","JO_IDS"=>""];
				echo $this->jobcart_sachet_impression->update_jobcart_sachet_impression($param, $request);
				break;
			case 'prod_terminer':
				$param = ["JO_ID" => $refnum];
				$request = ["JO_AV" => $value];
				echo $this->jobcart_sachet_impression->update_jobcart_sachet_impression($param, $request);
				break;
			case 'supprimer':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				echo $this->jobcart_sachet_impression->delete_jobcart_sachet_impression($param);
				break;

			default:
				echo 0;
				break;
		}
	}
	public function update_statut_coupe_prod()
	{
		$this->load->model('jobcart_sachet_coupe');
		$refnum = $this->input->post('refnum');
		$machine = $this->input->post('machine');
		$value = $this->input->post('value');
		$machine = str_replace("_", " ", $machine);
		$type = $this->input->post('type');

		switch ($type) {
			case 'mise_en_prod':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				$request = ["JO_ETAT" => "ON"];
				echo $this->jobcart_sachet_coupe->update_jobcart_sachet_coupe($param, $request);
				break;
			case 'terminer':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				$request = ["JO_STATUT" => "TERMINER","JO_IDS"=>""];
				echo $this->jobcart_sachet_coupe->update_jobcart_sachet_coupe($param, $request);
				break;
			case 'prod_terminer':
				$param = ["JO_ID" => $refnum];
				$request = ["JO_AV" => $value];
				echo $this->jobcart_sachet_coupe->update_jobcart_sachet_coupe($param, $request);
				break;
			case 'supprimer':
				$param = ["JO_ID" => $refnum, "JO_MACHINE" => $machine];
				echo $this->jobcart_sachet_coupe->delete_jobcart_sachet_coupe($param);
				break;

			default:
				echo 0;
				break;
		}
	}
	public function show_form_update_data_prod()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$this->load->model('planning_matiere_utiliser');
		$this->load->model('commande');

		$refnum = $this->input->get('refnum');
		$param = [
			"JO_ID" => $refnum
		];
		$donne = $this->jobcart_sachet_extrusion->get_detail_jobcart_sachet_extrusion($param);
		$methodOk = $donne != null;
		if ($methodOk) {
			$parametre = ["BC_PE" => $donne->BC_PE];
			$commande = $this->commande->select_commande($parametre);
			$methodOk =  $commande != null;
			if ($methodOk) {
				$matiere_utiliser = $this->planning_matiere_utiliser->get_planning_matiere_utiliser($parametre);
				$data = [
					'job' => $donne,
					'matiere' => $matiere_utiliser,
					'commande' => $commande

				];
				$this->load->view('planning/Job_card/Sachet/form_update_data_prod', $data);
			}
		}
	}
	public function show_form_update_data_impression_prod()
	{
		$this->load->model('jobcart_sachet_impression');
		$this->load->model('planning_matiere_utiliser');
		$this->load->model('commande');

		$refnum = $this->input->get('refnum');
		$param = [
			"JO_ID" => $refnum
		];
		$donne = $this->jobcart_sachet_impression->get_detail_jobcart_sachet_impression($param);
		$methodOk = $donne != null;
		if ($methodOk) {
			$parametre = ["BC_PE" => $donne->BC_PE];
			$commande = $this->commande->select_commande($parametre);
			$methodOk =  $commande != null;
			if ($methodOk) {
				$matiere_utiliser = $this->planning_matiere_utiliser->get_planning_matiere_utiliser($parametre);
				$data = [
					'job' => $donne,
					'matiere' => $matiere_utiliser,
					'commande' => $commande

				];
				$this->load->view('planning/Job_card/Sachet/form_update_data_impression_prod', $data);
			}
		}
	}

	public function show_form_update_data_coupe_prod()
	{
		$this->load->model('jobcart_sachet_coupe');
		$this->load->model('commande');

		$refnum = $this->input->get('refnum');
		$param = [
			"JO_ID" => $refnum
		];
		$donne = $this->jobcart_sachet_coupe->get_detail_jobcart_sachet_coupe($param);
		$methodOk = $donne != null;
		if ($methodOk) {
			$parametre = ["BC_PE" => $donne->BC_PE];
			$commande = $this->commande->select_commande($parametre);
			$methodOk =  $commande != null;
			if ($methodOk) {
				$data = [
					'job' => $donne,
					'commande' => $commande
				];
				$this->load->view('planning/Job_card/Sachet/form_update_data_coupe_prod', $data);
			}
		}
	}
	public function delete_matiere_planning()
	{
		$this->load->model('planning_matiere_utiliser');
		$refnum = $this->input->post('refnum');
		$param = [
			"MU_ID" => $refnum
		];
		echo $this->planning_matiere_utiliser->delete_planning_matiere_utiliser($param);
	}
	public function create_plinning_matiere()
	{
		$this->load->model('planning_matiere_utiliser');
		$refnum = $this->input->post('refnum');
		$designation = $this->input->post('designation');
		$quantite = $this->input->post('quantite');
		$refnum = $this->input->post('refnum');
		$prix = $this->input->post('prix');
		$param = [
			"MU_DESIGNATION" => $designation,
			"MU_QUANTITE" => $quantite,
			"BC_PE" => $refnum,
			"MU_PRIX" => $prix,
			"MU_VALIDATEUR" => "NON VALIDER",
			"MU_TYPE" => "NORMAL"
		];
		echo $this->planning_matiere_utiliser->insert_planning_matiere_utiliser($param);
	}
	public function update_commande_with_param()
	{
		$this->load->model('commande');
		$refnum = $this->input->post('refnum');
		$champs = $this->input->post('champs');
		$value = $this->input->post('value');
		$requette = [$champs => $value];
		$param = ["BC_PE" => $refnum];
		echo $this->commande->update_commande($param, $requette);
	}
	public function get_rest_time($produite, $vitesse)
	{
		$dure_temp = $produite / $vitesse;

		$hdt = 00;
		while ($dure_temp > 0.99) {
			$hdt++;
			$dure_temp = $dure_temp - 1;
		}
		if ($hdt < 10) {
			$hdt = "0" . $hdt;
		}
		$tempds = number_format(($dure_temp * 60), 0);
		if ($tempds < 10) {
			$tempds = "0" . $tempds;
		}

		$temp_rest = date($hdt . ":" . $tempds . ":00");
		return "$temp_rest";
	}
	public function Calendrier_commande()
	{
		$this->render_view('planning/commande/calendrier');
	}
	public function liste_commande()
	{
		$date_commande = $this->input->get('date_commande');
		$data = ['date_commande' => $date_commande];
		$this->render_view('planning/commande/liste_commande', $data);
	}
	public function calendrier_plannifier()
	{
		$this->load->model('commande');
		$this->load->model('global');
		$tab = array();
		$i = 0;
		$data = $this->global->get_distinct_colum(array(), "BC_DATE", "commande");
		foreach ($data as $data) {
			$count = $this->global->count_data_result(["BC_DATE" => $data->BC_DATE], "commande");
			$tab[$i] = array(
				'id' => $i,
				'title' => "Plannifié : " . $count,
				'start' => $data->BC_DATE,
				'color' => "green"
			);

			$i++;
		}
		echo json_encode($tab);
	}
	public function calendrier_non_plannifier()
	{
		$this->load->model('commande');
		$this->load->model('global');
		$tab = array();
		$i = 0;
		$data = $this->global->get_distinct_colum(array(), "BC_DATE", "commande");
		foreach ($data as $data) {
			$count = $this->global->count_data_result(["BC_DATE" => $data->BC_DATE], "commande");
			$tab[$i] = array(
				'id' => $i,
				'title' => "Non plannifié : " . $count,
				'start' => $data->BC_DATE,
				'color' => "red"
			);

			$i++;
		}
		echo json_encode($tab);
	}
	public function update_date_time_prod()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$this->load->model('global');
		$rang = $this->input->post('rang');

		$refnum = $this->input->post('refnum');
		$heure = $this->input->post('heure');
		$date = $this->input->post('date');


		$json = ["error" => "error"];
		$job_card = $this->jobcart_sachet_extrusion->get_detail_jobcart_sachet_extrusion(["JO_ID" => $refnum]);


		if ($job_card) {
			$dt = new DateTime($date . " " . $heure);
			$temp_hours = $job_card->JO_DURE == "" ? "00:00:00" : $job_card->JO_DURE;
			$dt->modify('+ ' . $this->time_to_sec($temp_hours) . ' seconds');
			$update_data = [
				"JO_DEB" => $heure,
				"JO_DATEDEDEBU" => $date,
				"JO_FIN" => $dt->format('H:i:s'),
				"JO_DATEFIN" => $dt->format('Y-m-d')
			];
			$methodOk = $this->jobcart_sachet_extrusion->update_jobcart_sachet_extrusion(["JO_ID" => $refnum], $update_data);

			if ($methodOk) {
				$dt = new DateTime($date . " " . $heure);
				$all_job_data = $this->jobcart_sachet_extrusion->get_jobcart_sachet_extrusion("JO_IDS < $job_card->JO_IDS AND  JO_MACHINE = '$job_card->JO_MACHINE'");
				$nombre_enregsitrement = $this->global->count_data_result("JO_IDS < $job_card->JO_IDS AND  JO_MACHINE = '$job_card->JO_MACHINE'", 'jobcart_sachet_extrusion');
				foreach ($all_job_data as  $all_job_data) {
					$all_job_data->JO_DATEFIN = $dt->format('Y-m-d');
					$all_job_data->JO_FIN = $dt->format('H:i:s');
					$temp_hours = $all_job_data->JO_DURE == "" ? "00:00:00" : $all_job_data->JO_DURE;
					$dt->modify("-" . $this->time_to_sec($temp_hours) . "seconde");
					$all_job_data->JO_DATEDEDEBU = $dt->format('Y-m-d');
					$all_job_data->JO_DEB = $dt->format('H:i:s');
					$all_job_data->JO_IDS = $nombre_enregsitrement;
					$this->jobcart_sachet_extrusion->update_jobcart_sachet_extrusion(["JO_ID" => $all_job_data->JO_ID], $all_job_data);
					$nombre_enregsitrement--;
				}
			}
		}
	}


    public function update_date_time_impression_prod()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$this->load->model('global');
		$rang = $this->input->post('rang');

		$refnum = $this->input->post('refnum');
		$heure = $this->input->post('heure');
		$date = $this->input->post('date');


		$json = ["error" => "error"];
		$job_card = $this->jobcart_sachet_impression->get_detail_jobcart_sachet_impression(["JO_ID" => $refnum]);


		if ($job_card) {
			$dt = new DateTime($date . " " . $heure);
			$temp_hours = $job_card->JO_DURE == "" ? "00:00:00" : $job_card->JO_DURE;
			$dt->modify('+ ' . $this->time_to_sec($temp_hours) . ' seconds');
			$update_data = [
				"JO_DEB" => $heure,
				"JO_DATEDEDEBU" => $date,
				"JO_FIN" => $dt->format('H:i:s'),
				"JO_DATEFIN" => $dt->format('Y-m-d')
			];
			$methodOk = $this->jobcart_sachet_impression->update_jobcart_sachet_impression(["JO_ID" => $refnum], $update_data);

			if ($methodOk) {
				$dt = new DateTime($date . " " . $heure);
				$all_job_data = $this->jobcart_sachet_impression->get_jobcart_sachet_impression("JO_IDS < $job_card->JO_IDS AND  JO_MACHINE = '$job_card->JO_MACHINE'");
				$nombre_enregsitrement = $this->global->count_data_result("JO_IDS < $job_card->JO_IDS AND  JO_MACHINE = '$job_card->JO_MACHINE'", 'jobcart_sachet_impression');
				foreach ($all_job_data as  $all_job_data) {
					$all_job_data->JO_DATEFIN = $dt->format('Y-m-d');
					$all_job_data->JO_FIN = $dt->format('H:i:s');
					$temp_hours = $all_job_data->JO_DURE == "" ? "00:00:00" : $all_job_data->JO_DURE;
					$dt->modify("-" . $this->time_to_sec($temp_hours) . "seconde");
					$all_job_data->JO_DATEDEDEBU = $dt->format('Y-m-d');
					$all_job_data->JO_DEB = $dt->format('H:i:s');
					$all_job_data->JO_IDS = $nombre_enregsitrement;
					$this->jobcart_sachet_impression->update_jobcart_sachet_impression(["JO_ID" => $all_job_data->JO_ID], $all_job_data);
					$nombre_enregsitrement--;
				}
			}
		}
	}

	public function update_date_time_coupe_prod()
	{
		$this->load->model('jobcart_sachet_coupe');
		$this->load->model('global');
		$rang = $this->input->post('rang');

		$refnum = $this->input->post('refnum');
		$heure = $this->input->post('heure');
		$date = $this->input->post('date');


		$json = ["error" => "error"];
		$job_card = $this->jobcart_sachet_coupe->get_detail_jobcart_sachet_coupe(["JO_ID" => $refnum]);


		if ($job_card) {
			$dt = new DateTime($date . " " . $heure);
			$temp_hours = $job_card->JO_DURE == "" ? "00:00:00" : $job_card->JO_DURE;
			$dt->modify('+ ' . $this->time_to_sec($temp_hours) . ' seconds');
			$update_data = [
				"JO_DEB" => $heure,
				"JO_DATEDEDEBU" => $date,
				"JO_FIN" => $dt->format('H:i:s'),
				"JO_DATEFIN" => $dt->format('Y-m-d')
			];
			$methodOk = $this->jobcart_sachet_coupe->update_jobcart_sachet_coupe(["JO_ID" => $refnum], $update_data);

			if ($methodOk) {
				$dt = new DateTime($date . " " . $heure);
				$all_job_data = $this->jobcart_sachet_coupe->get_jobcart_sachet_coupe("JO_IDS < $job_card->JO_IDS AND  JO_MACHINE = '$job_card->JO_MACHINE'");
				$nombre_enregsitrement = $this->global->count_data_result("JO_IDS < $job_card->JO_IDS AND  JO_MACHINE = '$job_card->JO_MACHINE'", 'jobcart_sachet_coupe');
				foreach ($all_job_data as  $all_job_data) {
					$all_job_data->JO_DATEFIN = $dt->format('Y-m-d');
					$all_job_data->JO_FIN = $dt->format('H:i:s');
					$temp_hours = $all_job_data->JO_DURE == "" ? "00:00:00" : $all_job_data->JO_DURE;
					$dt->modify("-" . $this->time_to_sec($temp_hours) . "seconde");
					$all_job_data->JO_DATEDEDEBU = $dt->format('Y-m-d');
					$all_job_data->JO_DEB = $dt->format('H:i:s');
					$all_job_data->JO_IDS = $nombre_enregsitrement;
					$this->jobcart_sachet_coupe->update_jobcart_sachet_coupe(["JO_ID" => $all_job_data->JO_ID], $all_job_data);
					$nombre_enregsitrement--;
				}
			}
		}
	}
  
	
	public function print_jobs_cart()
	{
		
		$refnum = $this->input->get('refnum');
		$this->load->model('global');
		$requette = ['jobcart_sachet_extrusion.JO_ID' => $refnum];
		$data = $this->global->select_detail_job_card_commande($requette);
		$link = "PLASMAD";
		if($data){
			$html = $this->load->view('planning/Job_card/Sachet/templete_job_cart', ["data" => $data, "logo" => $link], true);
			$filename = "Job_card N°: $refnum";
			$dompdf = new pdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			$dompdf->stream($filename);
		}else{
			echo "Erreur!";
		}
		//$this->load->view('planning/Job_card/Sachet/templete_job_cart', ["data" => $data, "logo" => $link]);
	}
	public function print_sachet_extrusion()
	{
		$this->load->model('global');
		$machine = $this->global->get_distinct_colum(array(),"EX_N_MACH","sachet_extrusion");
		$content = "<div><h2><b><u> PLANNING EXTRUSION DU : " . date('d / m / Y') . "</u></b></h2></div>";
		foreach ($machine as $key => $machine) {
			$param = [
				"JO_MACHINE" => $machine->EX_N_MACH,
				"JO_STATUT" => "PLANIFIER",
				"JO_ETAT" =>'on'
			];
		    $data = $this->global->select_job_card_commande($param); 
			$content .= "<div class='cont'>
		<table>
			<thead class='thead'>
			<tr class='header'>
				<td colspan='8'>$machine->EX_N_MACH</td>
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
				$result =  $this->planning_matiere_utiliser->get_planning_matiere_utiliser(['BC_PE' => $data->BC_PE]);
				foreach ($result as $key => $result) {
					$refence .= $result->MU_DESIGNATION . " : " . $result->MU_QUANTITE . "<br/>";
					if($data->BC_POISENKGSAVECMARGE !=""){
					$pmg .= ($data->BC_POISENKGSAVECMARGE * $result->MU_QUANTITE) / 100;
					}else{
						$pmg .= "0";
					}
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
	public function get_detail_job_card()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$refnum = $this->input->post('refnum');
		$requette = ['JO_ID' => $refnum];
		$reponse = $this->jobcart_sachet_extrusion->get_detail_jobcart_sachet_extrusion($requette);
		echo json_encode($reponse);
	}
	public function get_detail_impression_job_card()
	{
		$this->load->model('jobcart_sachet_impression');
		$refnum = $this->input->post('refnum');
		$requette = ['JO_ID' => $refnum];
		$reponse = $this->jobcart_sachet_impression->get_detail_jobcart_sachet_impression($requette);
		echo json_encode($reponse);
	}
	public function show_form_nouveau_processus()
	{
		$this->load->model("jobcart_sachet_impression");
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$refnum = $this->jobcart_sachet_impression->last_insert_id() + 1;
		$data = ["refnum"=>$refnum];
		$this->load->view('planning/Job_card/sachet/form_nouveau_processus', $data);
	}

	public function show_form_nouveau_impression_processus()
	{
	
		$this->load->view('planning/Job_card/sachet/form_nouveau_impression_processus');
	}

	
	public function show_form_add_data_prod()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$id_job = $this->jobcart_sachet_extrusion->last_insert_id() + 1;
		$data = ["id_job" => $id_job, "machine" => $machine];
		$this->load->view('planning/Job_card/sachet/form_add_data_prod', $data);
	}

	public function show_form_add_data_purge()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$id_job = $this->jobcart_sachet_extrusion->last_insert_id() + 1;
		$data = ["id_job" => $id_job, "machine" => $machine];
		$this->load->view('planning/Job_card/sachet/form_add_data_purge', $data);
	}

	public function show_form_add_data_coupe_prod()
	{
		$this->load->model('jobcart_sachet_coupe');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$id_job = $this->jobcart_sachet_coupe->last_insert_id() + 1;
		$data = ["id_job" => $id_job, "machine" => $machine];
		$this->load->view('planning/Job_card/sachet/form_add_data_coupe_prod', $data);
	}

	public function show_form_add_data_impression_prod()
	{
		$this->load->model('jobcart_sachet_impression');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$id_job = $this->jobcart_sachet_impression->last_insert_id() + 1;
		$data = ["id_job" => $id_job, "machine" => $machine];
		$this->load->view('planning/Job_card/sachet/form_add_data_prod', $data);
	}


     public function show_form_add_data_impression_purge(){
		$this->load->model('jobcart_sachet_impression');
		$machine = $this->input->get('machine');
		$machine = str_replace("_", " ", $machine);
		$id_job = $this->jobcart_sachet_impression->last_insert_id() + 1;
		$data = ["id_job" => $id_job, "machine" => $machine];
		$this->load->view('planning/Job_card/sachet/form_add_data_purge', $data);
	 }

	public function add_job_card_prod()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$obs = $this->input->post("obs");
		$machine = $this->input->post('machine');
		$id_jobs = $this->input->post('id_jobs');
		$refnum = $this->input->post('refnum');
		$quantite = $this->input->post('quantite');
		$date_prod = $this->input->post('date_prod');
		$heure_debut = $this->input->post('heure_debut');
		$duree_prod = $this->input->post('duree_prod');
		$date_fin = $this->input->post('date_fin');
		$heure_fin = $this->input->post('heure_fin');
		$order = $this->jobcart_sachet_extrusion->last_insert_ids(["JO_MACHINE" => $machine]) + 1;
		$user = $this->session->userdata('matricule');
		$param = [
			"JO_IDS" => $order, "JO_ID" => $id_jobs, "BC_PE" => $refnum, "JO_DATE" => date('Y-m-d'), "JO_MACHINE" => $machine,
			"JO_STATUT" => "PLANIFIER", "JO_CREAT" => $user, "JO_DURE" => $duree_prod,
			"JO_DEB" => $heure_debut, "JO_FIN" => $heure_fin, "JO_AV" => 0, "JO_DATEFIN" => $date_fin,
			"JO_DATEDEDEBU" => $date_prod, "JO_ETAT" => "off", "JO_SORTIE" => $quantite,"JO_OBS"=>$obs
		];
		echo $this->jobcart_sachet_extrusion->insert_jobcart_sachet_extrusion($param);
	}
    
	public function add_job_card_impression_prod()
	{
		$this->load->model('jobcart_sachet_impression');
		$obs = $this->input->post("obs");
		$machine = $this->input->post('machine');
		$id_jobs = $this->input->post('id_jobs');
		$refnum = $this->input->post('refnum');
		$quantite = $this->input->post('quantite');
		$date_prod = $this->input->post('date_prod');
		$heure_debut = $this->input->post('heure_debut');
		$duree_prod = $this->input->post('duree_prod');
		$date_fin = $this->input->post('date_fin');
		$heure_fin = $this->input->post('heure_fin');
		$order = $this->jobcart_sachet_impression->last_insert_ids(["JO_MACHINE" => $machine]) + 1;
		$user = $this->session->userdata('matricule');
		$param = [
			"JO_IDS" => $order, "JO_ID" => $id_jobs, "BC_PE" => $refnum, "JO_DATE" => date('Y-m-d'), "JO_MACHINE" => $machine,
			"JO_STATUT" => "PLANIFIER", "JO_CREAT" => $user, "JO_DURE" => $duree_prod,
			"JO_DEB" => $heure_debut, "JO_FIN" => $heure_fin, "JO_AV" => 0, "JO_DATEFIN" => $date_fin,
			"JO_DATEDEDEBU" => $date_prod, "JO_ETAT" => "off", "JO_SORTIE" => $quantite,"JO_OBS"=>$obs
		];
		echo $this->jobcart_sachet_impression->insert_jobcart_sachet_impression($param);
	}

	public function add_job_card_coupe_prod()
	{
		$this->load->model('jobcart_sachet_coupe');
		$obs = $this->input->post("obs");
		$machine = $this->input->post('machine');
		$id_jobs = $this->input->post('id_jobs');
		$refnum = $this->input->post('refnum');
		$quantite = $this->input->post('quantite');
		$date_prod = $this->input->post('date_prod');
		$heure_debut = $this->input->post('heure_debut');
		$duree_prod = $this->input->post('duree_prod');
		$date_fin = $this->input->post('date_fin');
		$heure_fin = $this->input->post('heure_fin');
		$order = $this->jobcart_sachet_coupe->last_insert_ids(["JO_MACHINE" => $machine]) + 1;
		$user = $this->session->userdata('matricule');
		$param = [
			"JO_IDS" => $order, "JO_ID" => $id_jobs, "BC_PE" => $refnum, "JO_DATE" => date('Y-m-d'), "JO_MACHINE" => $machine,
			"JO_STATUT" => "PLANIFIER", "JO_CREAT" => $user, "JO_DURE" => $duree_prod,
			"JO_DEB" => $heure_debut, "JO_FIN" => $heure_fin, "JO_AV" => 0, "JO_DATEFIN" => $date_fin,
			"JO_DATEDEDEBU" => $date_prod, "JO_ETAT" => "off", "JO_SORTIE" => $quantite,"JO_OBS"=>$obs
		];
		echo $this->jobcart_sachet_coupe->insert_jobcart_sachet_coupe($param);
	}


	public function add_new_job_card_prod()
	{
		$processus = $this->input->post("processus");
		$machine = $this->input->post('machine');
		$db = $table = "";
		$methodOk = $processus != "";
		if ($methodOk) {
			$methodOk = $processus == "IMPRESSION_EXTRUSION";
			if ($methodOk) {
				$this->load->model('jobcart_sachet_impression');
				$table = "insert_jobcart_sachet_impression";
				$db = "jobcart_sachet_impression";
				$last_order = $this->jobcart_sachet_impression->last_insert_ids(["JO_MACHINE" => $machine]);
			}
			$methodOk = $processus == "COUPE_EXTRUSION";
			if ($methodOk) {
				$this->load->model('jobcart_sachet_coupe');
				$table = "insert_jobcart_sachet_coupe";
				$db = "jobcart_sachet_coupe";
				$order = $this->jobcart_sachet_coupe->last_insert_ids(["JO_MACHINE" => $machine]);
			}
		}
		$methodOk =  $table != "" && $db != "";

		if ($methodOk) {
			$order = $last_order + 1;
			$refnum = $this->input->post('refnum');
			$quantite = $this->input->post('quantite');
			$date_prod = $this->input->post('date_prod');
			$heure_debut = $this->input->post('heure_debut');
			$duree_prod = $this->input->post('duree_prod');
			$date_fin = $this->input->post('date_fin');
			$heure_fin = $this->input->post('heure_fin');
			$user = $this->session->userdata('matricule');
		}

		if ($methodOk) {
			$param = [
				"JO_IDS" => $order, "BC_PE" => $refnum, "JO_DATE" => date('Y-m-d'), "JO_MACHINE" => $machine,
				"JO_STATUT" => "PLANIFIER", "JO_CREAT" => $user, "JO_DURE" => $duree_prod,
				"JO_DEB" => $heure_debut, "JO_FIN" => $heure_fin, "JO_AV" => 0, "JO_DATEFIN" => $date_fin,
				"JO_DATEDEDEBU" => $date_prod, "JO_ETAT" => "off", "JO_SORTIE" => $quantite
			];
			echo $this->$db->$table($param);
		} else {
			echo 0;
		}
	}
	public function mouve_job_card_prod()
	{
		$this->load->model('jobcart_sachet_extrusion');
		$requette = $this->input->post('data');
		$machine = $this->input->post("machine");
		$machine = str_replace("_", " ", $machine);
		$min_position = array();

		$ini_count = min($requette)[0];
		$methodOk = false;
		$data_init = $this->jobcart_sachet_extrusion->get_detail_jobcart_sachet_extrusion(["JO_MACHINE" => $machine, "JO_IDS" => $ini_count]);
		foreach ($requette as $requette) {
			$Position = $requette[1];
			$refnum = $requette[2];
			$min_position[] = $Position;
			$requette = ["JO_ID" => $refnum];
			$param = ["JO_IDS" => $Position];
			$methodOk = $this->jobcart_sachet_extrusion->update_jobcart_sachet_extrusion($requette, $param);
		}

		$count_postion = count($min_position) - 1;
		$max_postion = $min_position[$count_postion];
		$min_position = $min_position[0];

		if ($methodOk) {
			$dt = new DateTime($data_init->JO_DATEDEDEBU . " " . $data_init->JO_DEB);
			for ($i = $min_position; $i <= $max_postion; $i++) {
				$donne = "";
				$donne = $this->jobcart_sachet_extrusion->get_detail_jobcart_sachet_extrusion(["JO_MACHINE" => $machine, "JO_IDS" => $i]);
				//unset($donne->JO_ID);
				$temp_hours = $donne->JO_DURE == "" ? "00:00:00" : $donne->JO_DURE;
				$donne->JO_DATEDEDEBU = $dt->format('Y-m-d');
			
				$donne->JO_DEB = $dt->format('H:i:s');
				$dt->modify("+" . $this->time_to_sec($temp_hours) . "seconde");
				$donne->JO_DATEFIN = $dt->format('Y-m-d');
				$donne->JO_FIN = $dt->format('H:i:s');
				$this->jobcart_sachet_extrusion->update_jobcart_sachet_extrusion(["JO_MACHINE" => $machine, "JO_IDS" => $i], $donne);
			}
		}
	}


	public function mouve_job_card_impression_prod()
	{
		$this->load->model('jobcart_sachet_impression');
		$requette = $this->input->post('data');
		$machine = $this->input->post("machine");
		$machine = str_replace("_", " ", $machine);
		$min_position = array();

		$ini_count = min($requette)[0];
		$methodOk = false;
		$data_init = $this->jobcart_sachet_impression->get_detail_jobcart_sachet_impression(["JO_MACHINE" => $machine, "JO_IDS" => $ini_count]);
		foreach ($requette as $requette) {
			$Position = $requette[1];
			$refnum = $requette[2];
			$min_position[] = $Position;
			$requette = ["JO_ID" => $refnum];
			$param = ["JO_IDS" => $Position];
			$methodOk = $this->jobcart_sachet_impression->update_jobcart_sachet_impression($requette, $param);
		}

		$count_postion = count($min_position) - 1;
		$max_postion = $min_position[$count_postion];
		$min_position = $min_position[0];

		if ($methodOk) {
			$dt = new DateTime($data_init->JO_DATEDEDEBU . " " . $data_init->JO_DEB);
			for ($i = $min_position; $i <= $max_postion; $i++) {
				$donne = "";
				$donne = $this->jobcart_sachet_impression->get_detail_jobcart_sachet_impression(["JO_MACHINE" => $machine, "JO_IDS" => $i]);
				//unset($donne->JO_ID);
				$temp_hours = $donne->JO_DURE == "" ? "00:00:00" : $donne->JO_DURE;
				$donne->JO_DATEDEDEBU = $dt->format('Y-m-d');
			
				$donne->JO_DEB = $dt->format('H:i:s');
				$dt->modify("+" . $this->time_to_sec($temp_hours) . "seconde");
				$donne->JO_DATEFIN = $dt->format('Y-m-d');
				$donne->JO_FIN = $dt->format('H:i:s');
				$this->jobcart_sachet_impression->update_jobcart_sachet_impression(["JO_MACHINE" => $machine, "JO_IDS" => $i], $donne);
			}
		}
	}


	public function mouve_job_card_coupe_prod()
	{
		$this->load->model('jobcart_sachet_coupe');
		$requette = $this->input->post('data');
		$machine = $this->input->post("machine");
		$machine = str_replace("_", " ", $machine);
		$min_position = array();
  try{
		$ini_count = min($requette)[0];
		$methodOk = false;
		$data_init = $this->jobcart_sachet_coupe->get_detail_jobcart_sachet_coupe(["JO_MACHINE" => $machine, "JO_IDS" => $ini_count]);
		foreach ($requette as $requette) {
			$Position = $requette[1];
			$refnum = $requette[2];
			$min_position[] = $Position;
			$requette = ["JO_ID" => $refnum];
			$param = ["JO_IDS" => $Position];
			$methodOk = $this->jobcart_sachet_coupe->update_jobcart_sachet_coupe($requette, $param);
		}

		$count_postion = count($min_position) - 1;
		$max_postion = $min_position[$count_postion];
		$min_position = $min_position[0];

		if ($methodOk) {
			$dt = new DateTime($data_init->JO_DATEDEDEBU . " " . $data_init->JO_DEB);
			for ($i = $min_position; $i <= $max_postion; $i++) {
				$donne = "";
				$donne = $this->jobcart_sachet_coupe->get_detail_jobcart_sachet_coupe(["JO_MACHINE" => $machine, "JO_IDS" => $i]);
				//unset($donne->JO_ID);
				$temp_hours = $donne->JO_DURE == "" ? "00:00:00" : $donne->JO_DURE;
				$donne->JO_DATEDEDEBU = $dt->format('Y-m-d');
			
				$donne->JO_DEB = $dt->format('H:i:s');
				$dt->modify("+" . $this->time_to_sec($temp_hours) . "seconde");
				$donne->JO_DATEFIN = $dt->format('Y-m-d');
				$donne->JO_FIN = $dt->format('H:i:s');
				$this->jobcart_sachet_coupe->update_jobcart_sachet_coupe(["JO_MACHINE" => $machine, "JO_IDS" => $i], $donne);
			}
		}
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	}
    
	
	public function Recap_machine()
	{
		$this->load->model('machine');
		$param = "(MA_SPECIFIQUE = 'EXTRUSION' OR MA_SPECIFIQUE = 'IMPRESSION_EXTRUSION') AND MA_STATUT ='on'";
		$machine = $this->machine->get_machine($param);
		$data = ["machine" => $machine];
		$this->render_view('planning/Reconciliation/Recap_machine', $data);
	}
	public function Calendrier_de_livraison()
	{
		$this->render_view('planning/Reconciliation/Calendrier_de_livraison');
	}
	public function Historique_de_livraison()
	{
		$this->render_view('planning/Reconciliation/Historique_de_livraison');
	}
	public function Suivi_progression()
	{
		$this->render_view('planning/Reconciliation/Suivi_progression');
	}
	public function get_machine_prod()
	{
		$this->load->model('machine');
		$data = array();
		$type_process = $this->input->post('type_process');
		$data =  $this->machine->get_machine(["MA_SPECIFIQUE" => $type_process]);
		echo json_encode($data);
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
	public function get_time_production()
	{
		$this->load->model('machine');
		$date = $this->input->post("date_prod");
		$poids = $this->input->post("quantite");
		$machine = $this->input->post("machine");
		$machine = str_replace("_", " ", $machine);
		$heure = $this->input->post("heure_debut");
		$json = array("message" => false, "dure" => 0);

		$param = [
			"MA_DESIGNATION" => $machine
		];
		$data =  $machine = $this->machine->get_detail_machine($param);
		$methodOk = $data != null;

		if ($methodOk) {
			$methodOk = $poids != "" && $data->MA_VITESSE != "" && $data->MA_VITESSE != 0;
			if ($methodOk) {
				$dure_temp = $poids / $data->MA_VITESSE;
				$return_date = 00;
				while ($dure_temp > 0.99) {
					$return_date++;
					$dure_temp = $dure_temp - 1;
				}
				$return_date < 10 ? $return_date = "0" . $return_date : "";
				$return_hours = number_format(($dure_temp * 60), 0);
				$return_hours < 10 ? $return_hours = "0" . $return_hours : "";

				$dt = new DateTime($date . " " . $heure);
				$dt->modify("+ " . $this->time_to_sec(date($return_date . ":" . $return_hours . ":00")) . " seconde");
				$json["dure"] = date($return_date . ":" . $return_hours . ":00");
				$json["debut"] = $this->se_to_time($this->time_to_sec(date("00:00:00")) + $this->time_to_sec(date($return_date . ":" . $return_hours . ":00")));
				$json["date_fin"] = $dt->format('Y-m-d');
				$json["heure_fin"] = $dt->format('H:i:s');
			}
		}
		if ($methodOk == false) {
			$json["dure"] = "00:00:00";
			$json["debut"] = "00:00:00";
			$json["date_fin"] = "0000-00-00";
			$json["heure_fin"] = "00:00:00";
		}
		echo json_encode($json);
	}
	public function get_commande_simple_info()
	{
		$this->load->model("commande");
		$refnum = $this->input->post('refnum');
		$html = '';
		$data =$this->commande->select_commande(["BC_PE"=>$refnum]); 
		$html.="<h2><i class='fa fa-warning text-warning'></i>&nbsp;<b>Veuillez noter ces informations&nbsp;!</b></h2>";
		$html .= "<li class='feed-item feed-item-danger'><span class='text'> DATE DE CREATION : $data->BC_DATE</span></li>";
		$html .= "<li class='feed-item feed-item-danger'><span class='text'> N°PO : $data->BC_PE  </span></li>";
		$html .= "<li class='feed-item feed-item-danger'><span class='text'> CLIENT : $data->BC_CLIENT  </span></li>";
		$html .= "<li class='feed-item feed-item-danger'><span class='text'> DIMENSION : $data->BC_DIMENSION </span></li>";
		echo $html;
	}
	public function Purge(){
		$this->render_view('planning/Purge');
	}
	public function Reextrusion(){
		$this->render_view('planning/Reextrusion');
	}

	public function Liste_reextrusion(){
		$this->render_view('planning/Liste_reextrusion');

	}
    public function liste_rextrusion(){
		$requette = array();
		$date_debut=$this->input->get("date_debut");
		$date_fin=$this->input->get("date_fin");
		$data =array();
        if($date_debut!="" && $date_fin!=""){
		 $requette = "reextrusion.Date_creation BETWEEN '".$date_debut."' AND '".$date_fin."'";
		}else if($date_debut !=""){
			$requette = "reextrusion.Date_creation like '".$date_debut."%'";
		}
		$datas = $this->global->select_data_joint_colum($requette,"commande.BC_DIMENSION,commande.BC_PE,reextrusion.Date_creation,commande.BC_CODE","`reextrusion`.`BC_ID`= `commande`.`BC_PE`","reextrusion","commande");
		foreach ($datas as $row) {
		  $sub_array = array();
		  $sub_array[] = $row["BC_PE"];
		  $sub_array[] = $row["Date_creation"];
		  $sub_array[] = $row["BC_CODE"];
		  $sub_array[] = $row["BC_DIMENSION"];
		  $sub_array[] = $this->global->get_sum_colum("SM_DESTINATAIRE ='".$row["BC_PE"]."' AND SM_DATE >= '".$row["Date_creation"]."'","SM_QUANTITE", "sortie_matiere_premiere")->SM_QUANTITE;
		  $data[] = $sub_array;
		}
		$output = array(
		  "data" => $data
		);
		echo json_encode($output);
	}

	public function create_reextrusion(){
		$this->load->model("commande");
		$this->load->model("reextrusion");
		$refnum= $this->input->post('refnum');
        $commande = $this->commande->select_commande(["BC_PE"=>$refnum]);
		$methodOk = $commande != "";
		if($methodOk){
			$methodOk = $this->commande->update_commande(["BC_PE"=>$refnum],["BC_STATUT"=>"NON PLANIFIER"]);
		}
		if($methodOk){
			$param = [
				"BC_ID"=>$refnum, 
				"User"=>$this->session->userdata('matricule'), 
			    "Note"=>""
			];
            $methodOk = $this->reextrusion->insert_reextrusion($param);
		}
		echo $methodOk;
	}

	public function liste_commande_sachet(){
 
		$data = array();
		$datas = $this->commande->select_commande_all(["BC_TYPEPRODUIT"=>'SACHETS',"BC_STATUT"=>"Terminer"]);
		
		foreach ($datas as $row) {
		  $sub_array = array();
		  $sub_array[] = $row->BC_PE;
		  $sub_array[] = $row->BC_DATE;
		  $sub_array[] = $row->BC_DATELIVRE;
		  $sub_array[] = $row->BC_CLIENT;
		  $sub_array[] = $row->BC_CODE;
		  $sub_array[] = $row->BC_TYPEPRODUIT;
		  $sub_array[] = $row->BC_TYPE;

		  $sub_array[] = $row->BC_ECHANTILLON;
		  $sub_array[] = $row->BC_IMPRESSION;
		  $sub_array[] = $row->BC_DIMENSION;
		  $sub_array[] = $row->BC_REASSORT;

		  $sub_array[] = $row->BC_RABAT;
		  $sub_array[] = $row->BC_SOUFFLET;
		  $sub_array[] = $row->BC_PERFORATION;
		  $sub_array[] = $row->BC_QUNTITE;
		 
		  $sub_array[] = $row->BC_TYPEPRODUIT;
		  $sub_array[] = $row->BC_DIMENSION;
		  if ($row->BC_OBSERVATION==""){
			$sub_array[] = '<a href="#" class="btn btn-warning lire-obse">Pas d\'observation</a>'; 
		  }else{
		  $sub_array[] = '<a href="#" class="btn btn-success lire-obse" id="'.$row->BC_PE.'">Lire observation</a>';  //$row->BC_OBSERVATION;
		  }
	
		  $data[] = $sub_array;
		}
		$output = array(
		  "data" => $data
		);
		echo json_encode($output);
  }
  public function recherche_commande_specifique()
  {
	$anne = $this->input->get("anne"); 
	$mois = $this->input->get("mois"); 
	$debut = $this->input->get("debut");
	$fin = $this->input->get("fin");
	//$type = $this->input->get("type");
    $data = array();
    $datas = array();
    $method_ok = false;

    $method_ok = ($debut != "" && $fin != "");
    if ($method_ok) {
      $requette = "BC_DATE between '" . $debut . "' AND '" . $fin . "'";
      $datas = $this->commande->select_commande_all($requette);
      if (!$datas) {
        $method_ok = false;
      }
    }

    if (!$method_ok) {
      $method_ok = $anne != null;
      if ($method_ok) {
        $mois < 10 ? $moisx = '0' . $mois :  $moisx = $mois;
        $requette = "BC_DATE like '" . $anne . "-" . $moisx . "%'";
        $datas = $this->commande->select_commande_all($requette);
        if (!$datas) {
          $method_ok = false;
        }
      }
    }

    if ($debut != "" && $fin != "" && $anne != "") {
      $datas = $this->commande->select_commande_all();
    }

    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->BC_PE;
      $sub_array[] = $row->BC_DATE;
      $sub_array[] = $row->BC_CLIENT;
      $sub_array[] = $row->BC_DIMENSION;
      if ($row->BC_OBSERVATION == "") {
        $sub_array[] = '<a href="#" class="btn btn-warning lire-obse">Pas d\'observation</a>';
      } else {
        $sub_array[] = '<a href="#" class="btn btn-success lire-obse" id="' . $row->BC_PE . '">Lire observation</a>';  //$row->BC_OBSERVATION;
      }
      $sub_array[] = $row->BC_TYPEPRODUIT;
      $sub_array[] = $row->BC_STATUT;

      $sub_array[] =
        '<a href="#" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="#" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
}
