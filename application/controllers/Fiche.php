<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fiche extends My_Controller {
 
	public function index()
	{ 
	$this->load->model('fiche_model');
	$data=[
	'data'=>$this->fiche_model->lastId() 
	];
		
      $this->render_view('Fiche/createFiche',$data);
	}
	
   public function detail($D_ID){
	$this->load->model('fiche_model');
	$data=[
	'data'=>$this->fiche_model->detail($D_ID)
	];
	$this->render_view('Fiche/detailFiche',$data);  
   }	
    public function privillege(){
	  $demande = $this->input->post("demande");
      $action	=  $this->input->post("action");
	  $this->load->model('fiche_model'); 
	switch ($action){
		case 'Céer Fiche':
		     echo  json_encode($this->createFiche($demande,$this->input->post('debut'),$this->input->post('fin')));
		break;
		case 'Responsable' :
		   echo  json_encode($this->signer($action,$demande));
		break;
		case 'Direction' :
		   echo  json_encode($this->signer($action,$demande));
		break;
		case 'Terminer' :
		   echo  json_encode($this->traitement($action,$demande));
		break;
		case 'Sans suite' :
		   echo  json_encode($this->traitement($demande));
		break;
		case 'Remetre en instance' :
		   echo  json_encode($this->traitement($demande));
		break;
	}
		 
}
    
     public function createFiche($demande,$debut,$fin){  
	     $this->load->model('fiche_model');  
	     $data = $this->fiche_model->detail($demande);
		 if ($data->F_ID ==""){
			 if($this->session->userdata("fonction")==="Developpeur"){
				  return $this->dataAlert('fiche créer avec success','success'); 
			 }else{
				 $f_ID=$this->fiche_model->lastFID();
				 
				 $data = [
				       'D_STATUT'=>'En cours',
					   'D_PDATEDATEFICHEDEB'=>$debut,
					   'D_PDATEDATEFICHEFIN'=>$fin,
					   'F_ID'=>$f_ID->F_ID + 1
				 ];
				 $this->fiche_model->updateDemande($demande,$data);
				 return $this->dataAlert("Vous n'avez l'ourisation de créer une fiche",'error');
				 
			 }
			
		 }else{
			return $this->dataAlert('fiche déjà créer','error'); 
		 }
    }
     public function traitement(){  
        return $this->dataAlert('fiche déjà créer','error');
    }	
	
    public function signer(){  
	
     return $this->dataAlert('test','success');
  }	
  public function updateFiche($demande){
	  
  }
  public function dataAlert($content,$type){
	     $json=array();
	 if($type=="error"){	 
		 $json["title"]="Ooops!";
		 $json["containt"]=$content;
		 $json["icon"]="error";
		 $json["color"]="btn btn-danger";
		 $json["Message"]="true";
		 
	}else{
		 $json["title"]="";
		 $json["containt"]=$content;
		 $json["icon"]="success";
		 $json["color"]="btn btn-success";
		 $json["Message"]="true";
	}	
    return 	$json;
  }
    
   public function statutDemande($demande){
	  $this->load->model('fiche_model');  
	  $data = $this->fiche_model->detail($demande); 
   }
   
   public function saveDemande(){
	     
   $this->load->model('fiche_model');
   $nature=$this->input->post('nature');
   $application=$this->input->post('application');
   $date=$this->input->post('date');
   $object=$this->input->post('object');
   $text=$this->input->post('text');
   $data = [
    'D_DATE'=>date('Y-m-d'),
	'D_DEMANDEUR'=>$this->session->userdata('matricule'),
	'D_NATURE'=>$nature,
	'D_application'=>$application,
	'D_DATESOUHAITE'=>$date,
	'D_OBJECT'=>$object, 
	'D_TEXT'=>$text, 
	'D_STATUT'=>'En instances'
     ];
	 
	$this->fiche_model->saveDemande($data);   
	echo json_encode(array("message"=>true));
   }
}
