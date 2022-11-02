<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controle_Qualite extends My_Controller {

	public function index()
	{   
		$this->render_view('Controle_Qualite/accueil');
	}
	public function page(){
		$page = $this->input->post('page');
		switch ($page) {
			case 'QC':
				$this->load->view('Production/QC');
			break;
			case 'DETAIL QC':
				$this->load->view('Controle_Qualite/liste');
			break;
			case 'SORTIE DEUXIEME CHOIX':
				$this->load->view('Controle_Qualite/sortie');
			break;
			case 'SORTIE':
				$this->load->view('Controle_Qualite/sortieMenu');
			break;
			case 'DETAIL SORTIE DEUXIEME CHOIX':
				$this->load->view('Controle_Qualite/detail');
			break;
			case 'LISTE DES SORTIES':
				$this->load->view('Controle_Qualite/detail');
			break;	
			case 'ENTRE DEUXIEME CHOIX PRODUCTION':
				$this->load->view('Controle_Qualite/choixProd');
			break;	
			case 'STOCK DEUXIEME CHOIX':
				$this->load->view('Controle_Qualite/StockChoix');
			break;	
			default :
				echo "test"; 
			break;
		}
	}
	public function saveQC(){
		
		$this->load->model("Controlleur_model");
		$data = [
			"CS_DATE" => $this->input->post('CS_DATE'),
			"CS_QTT" => $this->input->post('CS_QTT'),
			"CS_DIM" => $this->input->post('CS_DIM'),
			"CS_PO" => $this->input->post('CS_PO'),
			"CS_BL" => $this->input->post('CS_BL'),
			"CS_PERS"=> $this->session->userdata('matricule')
		];
	 return	$this->Controlleur_model->insertSortieControl($data);
	}
	public function liseteControl(){
		$datas = array();
		$data = array();
        if( isset($_GET['PO']) && !empty($_GET['PO']) && isset($_GET['QC']) && !empty($_GET['QC']) && isset($_GET['PO']) && !empty($_GET['PO'])){
			$date = $_GET['date'];
			$qc = $_GET['QC'];
			$datas = $this->production_model->control(['C_DATE' => $date,"C_QC"=>$qc,"C_PO"=>$_GET['PO']]);
		}else if(isset($_GET['PO']) && !empty($_GET['PO']) && isset($_GET['date']) && !empty($_GET['date'] )){
			$date = $_GET['date'];
			$datas = $this->production_model->control(["C_PO"=>$_GET['PO'],'C_DATE' => $date]);
		}else if( isset($_GET['date']) && !empty($_GET['date']) ){
			$date = $_GET['date'];
			$datas = $this->production_model->control(['C_DATE' => $date]);
		}else if(isset($_GET['po']) && !empty($_GET['po'])){
			$datas = $this->production_model->control(["C_PO"=>$_GET['PO']]);
		}else{
			$datas = $this->production_model->control(array());
		}
		foreach ($datas as $row) {

			$sub_array = array();
			$sub_array[] = $row->C_DATE;
			$sub_array[] = $row->C_QC;
			$sub_array[] = $row->C_PO;
			$sub_array[] = $row->C_POID;
			$sub_array[] = $row->C_ENTRE;
			$sub_array[] = $row->C_TTS;
			$sub_array[] = $row->C_CHOIX;
			$sub_array[] ="<a href='".$row->C_ID."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash'></i></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
public function deletesortie_control(){
	$CS_ID = $this->input->post('parametre');
	return $this->Controlleur_model->deletesortie_control(["CS_ID"=>$CS_ID ]);
}

	public function liseteSortie(){
		
		$datas = array();
		$data = array();
     
		$datas = $this->Controlleur_model->selectsortie_control();
	
		foreach ($datas as $row) {

			$sub_array = array();
			$sub_array[] = $row->CS_DATE;
			$sub_array[] = $row->CS_PO;
			$sub_array[] = $row->CS_DIM;
			$sub_array[] = $row->CS_QTT;
			$sub_array[] = $row->CS_BL;
			$sub_array[] ="<a href='".$row->CS_ID."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash'></i></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


public function liseteControlProd(){
	$datas = array();
		$data = array();
		$this->load->model("Production_model");
		$datas = $this->Production_model->tableEcoupeRows(" ED_2E_CHOIX_SOMME <> '' AND ED_2E_CHOIX_SOMME <> '0' ");
	
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->ED_DATE;
			$sub_array[] = $row->ED_QC;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->ED_2E_CHOIX_SOMME;
			$sub_array[] = $row->ED_2E_POIDS;
			$sub_array[] ="<a href='".$row->BC_ID."' class='btn btn-info btn-sm view'><i class='fa fa-info'></i></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);

}
public function StockChoix(){
	$datas = array();
		$data = array();
		$this->load->model("Production_model");
		$datas = $this->Production_model->StockChoix();
		foreach ($datas as $row) {

			$sub_array = array();
			$sub_array[] = $row->N_PO;
			$sub_array[] = number_format($row->POIS, 2, ',', ' ');
			$sub_array[] = ($row->STOCK + $row->COUPE) - $row->SORTIE;
			$sub_array[] ="<a href='".$row->N_PO."' class='btn btn-info btn-sm view'><i class='fa fa-info'></i></a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);

}
public function Exporter(){
	    $this->load->model("Production_model");
		$datas = $this->Production_model->StockChoix();
		foreach ($datas as $row) {
		$excel .= "\tN° PO \tPOIDS\tQUANTITE\n";
		$excel .= "\t$row->N_PO\t$row->POIS\t$row->STOCK + $row->COUPE\n";
		}
	
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=QC_PLASMAD.xls");
		print $excel;
		exit;
}
	
}


