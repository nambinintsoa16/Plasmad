<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class Recyclage extends My_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Controlleur_model');
	}
    public function index()
	{   
		$this->render_view('Recyclage/Accueil');
	}
	public function page()
	{
		$this->load->model('commercial_model');


		$page = $this->input->post('page');

		switch ($page) {
			case 'ENREGISTREMENT DECHET':
				$this->load->view('Recyclage/enregistrement');
				break;
			case 'RECYCLAGES ENTREES':
				$this->load->view('Recyclage/recycle');
				break;
			case 'RECYCLAGES SORTIEES':
				$this->load->view('Recyclage/RSortie');
			break;	
			case 'LIVRAISON':
				$this->load->view('Recyclage/livraison');
				break;

			case 'HISTORIQUE ENTREES RECYCLAGES':
				$this->load->view('Recyclage/historiqueDeDechet');
			    break;	
			case 'HISTORIQUE RECYCLAGES':
				$this->load->view('Recyclage/historiqueDeRecyclages');
			    break;
			case 'HISTORIQUE DES SORTIEES':
		    	$this->load->view('Recyclage/historiqueDeLivraison');
			    break;       
			case 'STOCK DES DECHETS':
				    $dechet =$this->Controlleur_model->selectStockdechet();
				    $data = ["data"=>$dechet];
					$this->load->view('Recyclage/stockDechet', $data);
				break;  	
			default:

				break;
		}
	}
  public function saveentre(){
	if($this->Controlleur_model->insertDechet([
		"DE_PO"=>$this->input->post('po'),
		"DE_MACHINE"=>$this->input->post('MACHINES'),
		"DE_OPERATEUR"=>$this->input->post('OPERATEUR'),
		"DE_DATE"=>$this->input->post('date'),
		"DE_POIDS"=>$this->input->post('POIDS'),
		"DE_TYPE"=>$this->input->post('TYPE'),
		"DE_DECHET"=>$this->input->post('DECHETS'),
		"DE_TYPE_MATIER"=>$this->input->post('MATIERE'),
		"DE_USER"=>$this->session->userdata('matricule')
	])){
		$data = $this->Controlleur_model->selectStockdechet(["id"=>1]);
		if($data ){
			$matier = $data->stock + $this->input->post('POIDS');
            return $this->Controlleur_model->updateStockdechet(["id"=>1],["stock"=>$matier]);     
		}
		
	}


	
  }
 public function tableDecheRecycle(){
		$data = array();
		$datas = $this->Controlleur_model->selectsDechet();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->DE_DATE;
			$sub_array[] = $row->DE_MACHINE;
			$sub_array[] = $row->DE_PO;
			$sub_array[] = $row->DE_OPERATEUR;
			$sub_array[] = $row->DE_DECHET;
			$sub_array[] = $row->DE_POIDS;

			$sub_array[] =
				'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->DE_PO) . '" id="' . $row->DE_PO . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->DE_PO) . '" id="' . $row->DE_PO . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
 }

 public function entreDechet(){
	$data = array();

	$debut = $this->input->get('debut');
	$fin = $this->input->get('fin');
	$datas = array();
	if( !empty($debut)  && !empty($fin)){
		$datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE' AND  DE_DATE BETWEEN '".$debut."' AND '".$fin."'");
	}else if(!empty($debut)){
		$datas = $this->Controlleur_model->selectsDechet(["DE_TYPE"=>"ENTRE","DE_DATE"=>$debut]);
	}else{
		$datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE'AND  DE_DATE like '".date('Y-m')."%'");
	}

	foreach ($datas as $row) {
		$sub_array = array();
		$sub_array[] = $row->DE_DATE;
		$sub_array[] = $row->DE_PO;
		$sub_array[] = $row->DE_OPERATEUR;
		$sub_array[] = $row->DE_MACHINE;
		$sub_array[] = $row->DE_TYPE_MATIER;
		$sub_array[] = $row->DE_DECHET;
		$sub_array[] = $row->DE_POIDS;
		$sub_array[] =
			'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->DE_PO) . '" id="' . $row->DE_PO . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i>&nbsp;Détail</a>';

		$data[] = $sub_array;
	}
	$output = array(
		"data" => $data
	);
	echo json_encode($output);
}
public function sortieRecyclage(){
	$data = array();
	$output = array(
		"data" => $data
	);
	echo json_encode($output);
}

public function saveRecycleentre(){

	if($this->Controlleur_model->insertRecycle([
		"MR_MACHINE"=>$this->input->post('MACHINES'),
		"MR_OPERATEUR"=>$this->input->post('OPERATEUR'),
		"MR_DATE"=>$this->input->post('DATE'),
		"MR_POIDS"=>$this->input->post('POIDS'),
		"MR_TYPE"=>$this->input->post('TYPE'),
		"MR_DECHET"=>$this->input->post('DECHETS'),
		"MR_TYPE_DECHET"=>$this->input->post('MATIERE'),
		"MR_UTILSATEUR"=>$this->session->userdata('matricule')
	])){


	$data = $this->Controlleur_model->selectStockdechet(["id"=>1]);
		if($data ){
			$matier = $data->stock - $this->input->post('POIDS');
            return $this->Controlleur_model->updateStockdechet(["id"=>1],["stock"=>$matier]);     
		}
	}	
}

public function saveRecycleSortie(){

	return $this->Controlleur_model->insertRecycle([
		"MR_MACHINE"=>$this->input->post('MACHINES'),
		"MR_OPERATEUR"=>$this->input->post('OPERATEUR'),
		"MR_DATE"=>$this->input->post('DATE'),
		"MR_POIDS"=>$this->input->post('POIDS'),
		"MR_TYPE"=>$this->input->post('TYPE'),
		"MR_DECHET"=>$this->input->post('DECHETS'),
		"MR_TYPE_MATIER"=>$this->input->post('MATIERE'),
		"MR_UTILSATEUR"=>$this->session->userdata('matricule'),
		"MR_DECHET_SORTIE"=>$this->input->post('POIDSDECHET')
	]);
}

public function entreRecycle(){
	$data = array();
	$datas = $this->Controlleur_model->selectsRecyleChange(["MR_TYPE"=>"ENTRE"]);
	foreach ($datas as $row) {
		$sub_array = array();
		$sub_array[] = $row->MR_DATE;
		$sub_array[] = $row->MR_MACHINE;
		$sub_array[] = $row->MR_OPERATEUR;
		$sub_array[] = $row->MR_TYPE_DECHET;
		$sub_array[] = $row->MR_DECHET;
		$sub_array[] = $row->MR_POIDS;
		$sub_array[] =
			'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->MR_ID) . '" id="' . $row->MR_ID . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i>&nbsp;Détail</a>';

		$data[] = $sub_array;
	}
	$output = array(
		"data" => $data
	);
	echo json_encode($output);
}




public function entreDechetExport(){

	$debut = $this->input->get('debut');
	$fin = $this->input->get('fin');
	$datas = array();
	if( !empty($debut)  && !empty($fin)){
		$datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE' AND  DE_DATE BETWEEN '".$debut."' AND '".$fin."'");
	}else if(!empty($debut)){
		$datas = $this->Controlleur_model->selectsDechet(["DE_TYPE"=>"ENTRE","DE_DATE"=>$debut]);
	}else{
		$datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE'AND  DE_DATE like '".date('Y-m')."%'");
	}
	
		$excel = "\tSTOCK RECYCLE\t" . mois(date('m')) . " " . date('Y') . "\n";
		$excel .= "\t\n";
		$excel .= "DATE\tN°PO\tOPERATEUR\tTYPE DE MATIEER\tTYPE DE MATIEER\tTYPE DE DECHETS\tPOIDS\n";
			foreach ($datas as $key => $row) {
			
			 $excel .= "$row->DE_DATE\t $row->DE_PO\t $row->DE_OPERATEUR\t$row->DE_MACHINE\t $row->DE_TYPE_MATIER\t$row->DE_DECHET\t$row->DE_POIDS\n";
			
		}
	
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=STOCK RECYCLE  : " . date("d-m-Y") . ".xls");
		print $excel;
		exit;

}
public function sortieRecycle(){
	$data = array();
	$datas = $this->Controlleur_model->selectsRecyleChange(["MR_TYPE"=>"SORTIE"]);
	foreach ($datas as $row) {
		$sub_array = array();
		$sub_array[] = $row->MR_DATE;
		$sub_array[] = $row->MR_MACHINE;
		$sub_array[] = $row->MR_OPERATEUR;
		$sub_array[] = $row->MR_DECHET;
		$sub_array[] = $row->MR_TYPE_MATIER;
		$sub_array[] = $row->MR_POIDS;
		$sub_array[] = $row->MR_DECHET_SORTIE;
		
		$sub_array[] =
			'<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->MR_ID) . '" id="' . $row->MR_ID . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i>&nbsp;Détail</a>';

		$data[] = $sub_array;
	}
	$output = array(
		"data" => $data
	);
	echo json_encode($output);
}

public function entreDechetPrint(){
	$content = "";
	$debut = $this->input->get('debut');
	$fin = $this->input->get('fin');
	$datas = array();
	if( !empty($debut)  && !empty($fin)){
		$datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE' AND  DE_DATE BETWEEN '".$debut."' AND '".$fin."'");
	}else if(!empty($debut)){
		$datas = $this->Controlleur_model->selectsDechet(["DE_TYPE"=>"ENTRE","DE_DATE"=>$debut]);
	}else{
		$datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE'AND  DE_DATE like '".date('Y-m')."%'");
	}

		$html =$this->load->view("controlleur/suivieCoupe", $data,true);
		$filename = "SUIVIE MACHINE  COUPE du ";

		$dompdf = new pdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream($filename);
			
}	
 
}
