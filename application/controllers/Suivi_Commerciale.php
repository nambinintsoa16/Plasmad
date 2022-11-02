<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Suivi_Commerciale extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}

	public function index()
	{

		$this->render_view('Suivi_Commerciale/Accueil');
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

	public function page()
	{
		$this->load->model('commercial_model');


		$page = $this->input->post('page');

		switch ($page) {

			case 'COMMANDES':
				$data = [
					'annee' => $this->anne(),
					'type' => $this->commercial_model->type(),
					'type_de_matier' => $this->commercial_model->type_de_matier()
				];
				$this->load->view('Suivi_Commerciale/Mes_commande', $data);
				break;
			case 'COSTING':
				$this->load->view('comptabiliter/constingContent');
				break;
			case 'SUIVIE COMMANDE':
				$this->load->view('Suivi_Commerciale/suivies');
				break;
			case 'PO SUIVIE':
				$this->load->view('Suivi_Commerciale/suivi');
				break;
			default:
				$this->load->view('Suivi_Commerciale/suivies');
				break;
		}
	}

	public function MES_COMMANDES()
	{
		$this->load->model('commercial_model');
		$data = array();
		$date = date('Y-m');
		$datas = $this->commercial_model->bondecommandesTous("BC_DATE like '$date%'");
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
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->BC_PE) . '" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
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
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->BC_PE) . '" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->BC_PE) . '" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
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

	public function detailPE()
	{
		$this->load->model('commercial_model');
		$pe = $this->input->post("pe");
		echo json_encode($this->commercial_model->bondecommandeTous($pe));
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



	public function exportBon()
	{

		$datas = $this->commercial_model->bondecommandesTous();

		$data = array();

		$excel = "";
		$excel .= "DAILY REPPORT DU : \n\n";
		$excel .= "DATE\tTYPE DE PRODUIT\tPO\tREFERENCE\tCODE\tDATE DE LIVRAISON\tLIEU\tREASSORT\tECHANTILLON\tDIMENSION\tRABAT\tSOUFFLET\tPERFORATION\tTYPE\tIMPRESSION\tCYLINDRE\tQUNTITE\tPRIX\n\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->BC_DATE\t$row->BC_TYPEPRODUIT\t$row->BC_PE\t$row->BC_CLIENT\t$row->BC_CODE\t$row->BC_DATELIVRE\t$row->BC_LIEULIVRE\t$row->BC_REASSORT\t$row->BC_ECHANTILLON\t$row->BC_DIMENSION\t$row->BC_RABAT\t$row->BC_SOUFFLET\t$row->BC_PERFORATION\t$row->BC_TYPE\t$row->BC_IMPRESSION\t$row->BC_CYLINDRE\t$row->BC_QUNTITE\t$row->BC_PRIX\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . date("Y-m-d") . ".xls");

		print $excel;
		exit;
	}


	public function exportParam()
	{

		$this->load->model('commercial_model');
		$data = array();
		$type = $_GET['type'];
		$anne = $_GET['anne'];
		$mois = $_GET['mois'];

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

		$data = array();

		$excel = "";
		$excel .= "DAILY REPPORT DU : \n\n";
		$excel .= "DATE\tTYPE DE PRODUIT\tPO\tREFERENCE\tCODE\tDATE DE LIVRAISON\tLIEU\tREASSORT\tECHANTILLON\tDIMENSION\tRABAT\tSOUFFLET\tPERFORATION\tTYPE\tIMPRESSION\tCYLINDRE\tQUNTITE\tPRIX\n\n";
		foreach ($datas as $key => $row) {
			$excel .= "$row->BC_DATE\t$row->BC_TYPEPRODUIT\t$row->BC_PE\t$row->BC_CLIENT\t$row->BC_CODE\t$row->BC_DATELIVRE\t$row->BC_LIEULIVRE\t$row->BC_REASSORT\t$row->BC_ECHANTILLON\t$row->BC_DIMENSION\t$row->BC_RABAT\t$row->BC_SOUFFLET\t$row->BC_PERFORATION\t$row->BC_TYPE\t$row->BC_IMPRESSION\t$row->BC_CYLINDRE\t$row->BC_QUNTITE\t$row->BC_PRIX\n";
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=DAILY REPPORT DU : " . date("Y-m-d") . ".xls");

		print $excel;
		exit;
	}
	public function saveSuivie(){
		$id = $this->input->post("idModifMod");
		$reponse = $this->commercial_model->selectrapportcommande(["RP_PO"=>$id]);
		if($reponse){
			$item = $this->input->post("itemModif");
			$valeur = $this->input->post("valeurModif");
			$first = str_replace(" ","_",$item);
			$second = str_replace("-","_",$first); 
			$last = str_replace("_(day)","",$second); 
			if($item == "Actual Delivered Date"){
				$key =trim($last); 
				$valeur = $reponse->$key."/".$this->input->post("valeurModif");
				return $this->commercial_model->updaterapportcommande(["RP_PO"=>$id],[trim($last)=>$valeur]);
			}else{
				return $this->commercial_model->updaterapportcommande(["RP_PO"=>$id],[trim($last)=>$valeur]);
			}
			
		}else{
			$item = $this->input->post("itemModif");
			$valeur = $this->input->post("valeurModif");
			$first = str_replace(" ","_",$item);
			$second = str_replace("-","_",$first); 
			$last = str_replace("(day)","",$second); 
			$second;
			return $this->commercial_model->insertrapportcommande([trim($last)=>$valeur,"RP_PO"=>$id]);
		}
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
		
			$datas = $this->commercial_model->bondecommandesTous(["BC_PE" => $po]);
			
		}else if(!empty($client) ){
			$datas = $this->commercial_model->bondecommandesTous(["BC_CODE" => $client]);
		} else if (!empty($debut) && !empty($fin)) {

			$datas = $this->commercial_model->bondecommandesTous("BC_DATE BETWEEN '$debut' AND '$fin'");
		} else {
			$date = date('Y-m');
			$datas = $this->commercial_model->bondecommandesTous("BC_DATE like  '$date%'");
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
			$sub_array[] = "";
			$sub_array[] = $row->BC_TYPEPRODUIT;
			$livre = 0;
			$dataSortie = $this->magasiner_model->dataentre_produit_fini(["BC_ID" => $row->BC_PE, "EF_TYPE" => "sortie"]);
			if ($dataSortie) {
				foreach ($dataSortie as $key => $dataSortie) {
					$qtt =  $dataSortie->EF_QUANTITE;
					$livre = trim($qtt);
				}
			}
			if($reponse){
				$sub_array[] = $reponse->Actual_Delivered_Date;
			}else{
				$sub_array[] ="";
			}
			
			$dateLivre = $this->commercial_model->dateLivraison(['DL_PO'=>$row->BC_PE]);
			$replivre = "";
			foreach($dateLivre  as $dateLivre){
                $replivre .=$dateLivre->DL_DATE." / ";
			}
			
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = $row->BC_PRIX;
			$prix = explode(" ", $row->BC_PRIX);
			$prixs = 0;
			if (is_array($prix)) {
				$quatite = explode(" ", $row->BC_QUNTITE);
				if (is_array($quatite)) {
				
					$sub_array[] = trim((float)$prix[0]) * (float)$quatite[0];
					$prixs = trim((float)$prix[0]) ;
				} else {
					$sub_array[] =  number_format($prix[0] * $row->BC_QUNTITE, ',', ' ');
					$prixs = $prix[0];
				}
			} else {
				$quatite = explode(" ", $row->BC_QUNTITE);
				if (is_array($quatite)) {
					$sub_array[] =   number_format($row->BC_PRIX * $quatite[0], ',', ' ');
					$prixs = $row->BC_PRIX;
				} else {
					$sub_array[] =   number_format($row->BC_PRIX * $row->BC_QUNTITE, ',', ' ');
				}
			}
			
			if($reponse){
				$sub_array[] = $reponse->Delivered_qty; 
				$sub_array[] = $reponse->Unit_Price_Euro;
				$sub_array[] = $reponse->Amount_Euro ;
				$sub_array[] = $reponse->Production_Lead_time;
				$sub_array[] = $reponse->Variance_Delivery ;
				$sub_array[] = $reponse->Varaince_Actual_Dlvry ;
				$sub_array[] = $reponse->Amount_Dlvd_USD;
				$sub_array[] = $reponse->Delivered_qty*$prixs;
				$qtt = explode(" ", $row->BC_QUNTITE);
				$sub_array[] = number_format((float)$qtt[0] - $reponse->Delivered_qty, 2, ',', ' ');
				$sub_array[] = $reponse->Bal_Amount_USD;
				$sub_array[] = number_format(((float)$qtt[0] - $reponse->Delivered_qty)*$prixs, 2, ',', ' ');
			}else{
			$sub_array[] =""; 
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$sub_array[] = "";
			$qtt = explode(" ", $row->BC_QUNTITE);
			$sub_array[] = (float)$qtt[0] ;
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
	public function exportsuivie()
	{

		$this->load->model('commercial_model');
		$data = array();
		$debut = $this->input->get('debut');
		$fin = $this->input->get('fin');
		$po = $this->input->get('po');
        $client = $this->input->get('client');
		if (!empty($po) ) {
		
			$datas = $this->commercial_model->bondecommandesTous(["BC_PE" => $po]);
			
		}else if(!empty($client) ){
			$datas = $this->commercial_model->bondecommandesTous(["BC_CODE" => $client]);
		} else if (!empty($debut) && !empty($fin)) {

			$datas = $this->commercial_model->bondecommandesTous("BC_DATE BETWEEN '$debut' AND '$fin'");
		} else {
			$date = date('Y-m');
			$datas = $this->commercial_model->bondecommandesTous("BC_DATE like  '$date%'");
		}
		$excel = "";
		$excel .= "COMMERCIAL REPPORT DU :".date("Y-m-d")."\n\n";
		$excel .= "\tREFERENCE CLIENT\tPO Date \tPlasmad PO No.\tCustomer\tDimensions\tOrder Quantity\tRequired Delivery Date\tConfirmed Delivery Date\tDescription XIT\tDelivered qty\tActual Delivered Date\tDelivery Month\tCfmd Delivery Week\tUnit Price USD\tAmount USD\tUnit Price Euro\tAmount Euro\tProduction Lead-time (day)\tVariance Delivery (day)\tVaraince Actual Dlvry (day)\tAmount-Dlvd USD\tAmount-Dlvd EURO\tBalance to be Dlvd (Qty)\tBal Amount USD\tBal Amount Euro\tSTATUS\n";
		
		foreach ($datas as $key => $row) {
	     $excel .="\t $row->BC_CLIENT\t $row->BC_DATE\t $row->BC_PE\t $row->BC_CODE\t $row->BC_DIMENSION\t $row->BC_QUNTITE\t $row->BC_DATELIVRE\t\t$row->BC_TYPEPRODUIT";		
		 $reponse = $this->commercial_model->selectrapportcommande(["RP_PO"=>$row->BC_PE]);
		
		 $livre = 0;
		 $dataSortie = $this->magasiner_model->dataentre_produit_fini(["BC_ID" => $row->BC_PE, "EF_TYPE" => "sortie"]);
		 if ($dataSortie) {
			 foreach ($dataSortie as $key => $dataSortie) {
				 $qtt =  $dataSortie->EF_QUANTITE;
				 $livre = trim($qtt);
			 }
		 }
		 $excel .= "\t$livre";
		 $dateLivre = $this->commercial_model->dateLivraison(['DL_PO'=>$row->BC_PE]);
		 $replivre = "";
		 foreach($dateLivre  as $dateLivre){
			 $replivre .=$dateLivre->DL_DATE." / ";
		 }
		 $excel .="\t $replivre";
		 $excel .="\t";
		 $excel .="\t";
		 $excel .="\t$row->BC_PRIX";
		 $prix = explode(" ", $row->BC_PRIX);
		 if (is_array($prix)) {
			 $quatite = explode(" ", $row->BC_QUNTITE);
			 $ttPrix = 0;
			 if (is_array($quatite)) {
				$ttPrix = trim((float)$prix[0]) * (float)$quatite[0];
				$excel .= "\t$ttPrix";
			 } else {
				$ttPrix = $prix[0] * $row->BC_QUNTITE;
				$excel .= "\t$ttPrix";
			 }
		 } else {
			 $quatite = explode(" ", $row->BC_QUNTITE);
			 $ttPrix = 0;
			 if (is_array($quatite)) {
				$ttPrix = $row->BC_PRIX * $quatite[0];
				$excel .= "\t$ttPrix";
			 } else {
				$ttPrix = $row->BC_PRIX * $row->BC_QUNTITE;
				$excel .= "\t$ttPrix";
			 }
		 }

		 if($reponse){
			$qtt = explode(" ", $row->BC_QUNTITE);
			$livrerre= (float)$qtt[0] - (float)$livre;
			$excel .="\t$reponse->Unit_Price_Euro\t$reponse->Amount_Euro \t$reponse->Production_Lead_time\t$reponse->Variance_Delivery \t$reponse->Varaince_Actual_Dlvry\t$reponse->Amount_Dlvd_USD\t$reponse->Amount_Dlvd_EURO\t$qtt[0]\t$reponse->Bal_Amount_USD\t$reponse->Bal_Amount_Euro";
		}else{
			$qtt = explode(" ", $row->BC_QUNTITE);
			$livrerre= (float)$qtt[0] - (float)$livre;
			$excel .="\t\t\t\t\t\t\t\t$livrerre\t\t";
		}
		$excel .="\t$row->BC_STATUT\n";
		
		}
		
		
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=COMMERCIAL REPPORT DU : " . date("Y-m-d") . ".xls");

		print $excel;
		exit;
	}
}
