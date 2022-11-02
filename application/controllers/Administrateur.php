<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'libraries/SimpleXLSX/SimpleXLSX.php';
class Administrateur extends My_Controller {

	public function index()
	{   
		$this->render_view('global/Accueil');
	}
	public function changePhoto()
	{ 
		$uploads_dir = FCPATH.'/images/user';
		$tmp_name = $_FILES["file"]["tmp_name"];
		$name = basename($this->session->userdata("matricule").".jpg");
		if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
           return true;
		}else{
			return false;
		}
	
	}
	public function nouveauOperateur(){
		$this->load->model('utilisateur_model');
		$data =[
          'data'=>$this->utilisateur_model->machine()
		];

		$this->render_view('Administrateur/Utilisateur/nouveauOperateur',$data);
	}
	public function datalisteOperateur(){
		$this->load->model('utilisateur_model');
		$datas=$this->utilisateur_model->listeOperateur();
        $data =array();
		foreach($datas as $row) 
	{ 
			$sub_array = array();
			$sub_array[] = $row->OP_MATRICULES;
			$sub_array[] = $row->OP_NOM;
			$sub_array[] = $row->OP_MACHINE;
			$sub_array[] = $row->OP_STATUT;	
			$sub_array[] = '<a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>';	
			$data[] = $sub_array;
	}
			 $output = array("data" =>$data);
	   echo json_encode($output);
	}
	public function listeOperateur(){
		$this->render_view('Administrateur/Utilisateur/listeOperateur');
	}
	public function listeMachine(){
		$this->render_view('Administrateur/Machine/liste');
	}
    public function datamachine(){
        $this->load->model('utilisateur_model');
		$datas=$this->utilisateur_model->listeMachine();

		foreach($datas as $row) 
	{ 
			$sub_array = array();
			$sub_array[] = $row->MA_ID;
			$sub_array[] = $row->MA_DESIGNATION;
			$sub_array[] = $row->MA_SPECIFIQUE;
			$sub_array[] = $row->MA_VITESSE;
			$sub_array[] = $row->MA_DIM_MM;	
			$sub_array[] = $row->MA_STATUT;	
			$sub_array[] = '<a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>';	
			$data[] = $sub_array;
	}
			 $output = array(
			 "data" =>$data
	);
	   echo json_encode($output);
	}
	public function saveOperateur(){
		$this->load->model('utilisateur_model');
		$data =[
            "OP_NOM" =>$this->input->post("OP_NOM"),
			"OP_MATRICULES"=>$this->input->post("OP_MATRICULES"),
			"OP_PRENOM"=>"",
			"OP_FONCTION"=>$this->input->post("OP_FONCTION"),
			"OP_MACHINE"=>$this->input->post("OP_MACHINE"),
			"OP_STATUT"=>'on'
		];
		echo json_encode($this->utilisateur_model->insetOperateur($data));
  }
  	public function Valeur_Matiers(){
		$this->render_view('Administrateur/Templet/calcul');  
  	}
	public function caltculPrix(){
		    $type_prix=$this->input->post("type_prix");
			$HDPE_LDPE=$this->input->post("HDPE_LDPE");
			$HDPE_LDPERATE=$this->input->post("HDPE_LDPERATE");
			$LLDPE=$this->input->post("LLDPE");
			$LLDPERATE=$this->input->post("LLDPERATE");
			$BorstarRATE=$this->input->post("BorstarRATE");
			$Borstar=$this->input->post("Borstar");
			$Elastomers_Vistamaxx=$this->input->post("Elastomers_Vistamaxx");
			$Elastomers_Vistamax=$this->input->post("Elastomers_Vistamax");
			$Recycled=$this->input->post("Recycled");
			$RecycledRate=$this->input->post("RecycledRate");
			$CaCo3=$this->input->post("CaCo3");
			$CaCo3Rate=$this->input->post("CaCo3Rate");
			$Elastomers_VistamaxRateStd=$this->input->post("Elastomers_VistamaxRateStd");
			$Elastomers_VistamaxRate=$this->input->post("Elastomers_VistamaxRate");
		$data = [
            "type_prix"=>$this->input->post("type_prix"),
			"HDPE_LDPE"=>$this->input->post("HDPE_LDPE"),
			"HDPE_LDPERATE"=>$this->input->post("HDPE_LDPERATE"),
			"LLDPE"=>$this->input->post("LLDPE"),
			"LLDPERATE"=>$this->input->post("LLDPERATE"),
			"BorstarRATE"=>$this->input->post("BorstarRATE"),
			"Borstar"=>$this->input->post("Borstar"),
			"Elastomers_Vistamaxx"=>$this->input->post("Elastomers_Vistamaxx"),
			"Elastomers_Vistamax"=>$this->input->post("Elastomers_Vistamax"),
			"Recycled"=>$this->input->post("Recycled"),
			"RecycledRate"=>$this->input->post("RecycledRate"),
			"CaCo3"=>$this->input->post("CaCo3"),
			"CaCo3Rate"=>$this->input->post("CaCo3Rate"),
			"Elastomers_VistamaxRateStd"=>$this->input->post("Elastomers_VistamaxRateStd"),
			"Elastomers_VistamaxRate"=>$this->input->post("Elastomers_VistamaxRate")	
		];
		$total=($HDPE_LDPE*$HDPE_LDPERATE)+($LLDPE*$LLDPERATE)+($Borstar*$BorstarRATE)+($Elastomers_Vistamax*$Elastomers_Vistamaxx)+($Recycled*$RecycledRate)+($CaCo3*$CaCo3Rate)+($Elastomers_VistamaxRateStd*$Elastomers_VistamaxRate);
		$this->savePrixMatier($type_prix,$total);
		$this->load->view('Administrateur/Templet/tableauPrix',$data);
	}
	public function savePrixMatier($PA_REFERENCE,$PA_PRIX){
		$this->load->model('utilisateur_model');
		$param = [
			"PA_REFERENCE"=>$PA_REFERENCE,
			"PA_PRIX"=>$PA_PRIX,
			'PA_STATUT'=>"on"
		];
	$this->utilisateur_model->UpDateprixAppliquer(['PA_STATUT'=>"off"],['PA_REFERENCE'=>$PA_REFERENCE]);	
	$this->utilisateur_model->insertprixAppliquer($param);
		
	}
 public function parametrePrixSave()
	{
		$this->load->model('utilisateur_model');
		
		$data = [
			"H_MACHINE_EXTR"=>$this->input->post("H_MACHINE_EXTR"), 
			"H_MOD_EXTR"=>$this->input->post("H_MOD_EXTR"), 
			"H_MOD_IMPR"=>$this->input->post("H_MOD_IMPR"), 
			"H_MACHINE_COUPE"=>$this->input->post("H_MACHINE_COUPE"), 
			"H_MOD_COUPE"=>$this->input->post("H_MOD_COUPE"), 
			"H_MACHINE_IMPR"=>$this->input->post("H_MACHINE_IMPR"), 
			"OVERHEADS"=>$this->input->post("OVERHEADS"), 
			"PA_STATUT"=>"actif",
			"PA_DATE"=>date("Y-m-d"),

		];
		echo  json_encode($this->utilisateur_model->insertprixAppliquer($data));
	}
	public function parametrePrix(){
		$this->render_view('Administrateur/Templet/parametrePrix');	
	}
    public function parametrePrixs(){
		$this->render_view('Administrateur/Templet/parametrePrix');	
	}
	public function dataListePrix(){
 $this->load->model('utilisateur_model');
		$datas=$this->utilisateur_model->ListeprixAppliquer();
		$data=array();
		foreach($datas as $row) 
	{ 
			$sub_array = array();
			$sub_array[] = $row->PA_ID;
			$sub_array[] = $row->PA_DATE;
			$sub_array[] = $row->H_MACHINE_EXTR;
			$sub_array[] = $row->H_MOD_EXTR;	
			$sub_array[] = $row->H_MOD_IMPR;
			$sub_array[] = $row->H_MACHINE_COUPE;
			$sub_array[] = $row->H_MOD_COUPE;
			$sub_array[] = $row->H_MACHINE_IMPR;	
			$sub_array[] = $row->OVERHEADS;
			$sub_array[] = $row->PA_STATUT;
			$sub_array[] = '<a href="#" class="btn btn-warning editStatut btn-sm" id="'.$row->PA_ID.'"><i class="fa fa-edit"></i></a>';	
			$data[] = $sub_array;
	}
			 $output = array(
			 "data" =>$data
	);
	   echo json_encode($output);
	}
	public function editStatutPrixApp(){
		$id= $this->input->post('id');
		$this->load->model('utilisateur_model');
		echo $this->utilisateur_model->UpDateprixAppliquer(['PA_STATUT'=>'inactif'],["PA_ID"=>$id]);

	}

	public function ListePrix(){
		$this->render_view('Administrateur/Templet/ListePrix');	
	}
	
	public function saveMachine(){
		$this->load->model('utilisateur_model');
		$data =[
            "MA_DESIGNATION" =>$this->input->post("MA_DESIGNATION"),
			"MA_SPECIFIQUE"  =>$this->input->post("MA_SPECIFIQUE"),
			"MA_STATUT"=>'on'
		];

		echo  json_encode($this->utilisateur_model->insetMachine($data));
		
	}
	public function nouveauMachine(){
        $this->render_view('Administrateur/Machine/nouveau');  
	}
	public function parametrePrixSaves(){
		$this->load->model('utilisateur_model');
		$this->utilisateur_model->updateFormule(['FOR_DESIGNATION'=>$this->input->post("FOR_DESIGNATION")],['FOR_STATUT'=>'off']);
		$data =[
            "FOR_TEXT" =>$this->input->post("FOR_TEXT"),
			"FOR_DESIGNATION"  =>$this->input->post("FOR_DESIGNATION"),
			"FOR_STATUT"=>'on',
			"FOR_DATE"=>date('Y-m-d')
		];

		echo  json_encode($this->utilisateur_model->insetFormule($data));
		
	}
	public function autocompleteFormule(){
		$this->load->model('utilisateur_model');
		$mot = $this->input->get('term');
		$resultat=array();
		$data=$this->utilisateur_model->requetteSimple("SELECT * FROM `formule` WHERE `FOR_DESIGNATION` LIKE '%$mot%' AND `FOR_STATUT` = 'on'");
		foreach ($data as $key => $data) {
			$resultat[]= $data->FOR_DESIGNATION;
		}
		echo json_encode($resultat);
	  }

public function update_po()
	{
		$this->load->model('Utilisateur_model');
		$data = scandir(FCPATH . 'uploads/excel');
		$uploads_dir = FCPATH . 'uploads/excel';

			if ($xlsx = SimpleXLSX::parse("$uploads_dir/Classeur1.xlsx")) {

				$header_values = $rows = [];

				foreach ($xlsx->rows() as $k => $r) {
					if ($k === 0) {
						$header_values = $r;
						continue;
					}
					$rows[] = array_combine($header_values, $r);
				}
				foreach ($rows as $key => $rows) {
					//var_dump($rows);
				  $donnee =  [
				  		 "BC_PE"=> $rows["PO"], 
				  		 "BC_DATE"=> $rows["Date"], 
				  		 "BC_DIMENSION"=> $rows["Dimensions"],
				  		 "BC_DATELIVRE"=> $rows["Delivery"],
				  		 "BC_CLIENT"=> $rows["Customer"], 
				  		 "BC_PRIX"=> $rows["Price"], 
				  		 "BC_QUNTITE"=> $rows["Quantity"], 
				  		 "BC_STATUT"=> $rows["STATUS"]
		               //		  		Description	 Delivered 	  	


				  ];
					$this->Utilisateur_model->insertbontest($donnee);
				}
		     
		 }
		 return 0;
	}


}
