<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class utilisateur extends My_Controller {

	public function index()
	{  
    }
   public function Nouveau(){
      $this->render_view('Administrateur/Utilisateur/nouveau');
   }
   public function liste(){
    $this->render_view('Administrateur/Utilisateur/liste');
  }
  
  public function detail($UT_ID){
    $this->load->model('utilisateur_model');
    $data= [
        'data'=>$this->utilisateur_model->datailUtilisateur($UT_ID)
    ];
    $this->render_view('Administrateur/Utilisateur/detail',$data);
 }

 public function updateUser(){
    $this->load->model('utilisateur_model');
    $data = [
        "UT_MOT_DE_PASS"=>$this->input->post('pass'),
        "UT_PROFIL"=>$this->input->post('profils')
    ];
    $this->utilisateur_model->updateUtilisateur($this->input->post('id'),$data);
    echo json_encode(array('message'=>'true'));
 }

 public function updateStatut(){
    $this->load->model('utilisateur_model');
    $data = [
        "UT_STATUT"=>'Désactivé',
    ];
    $this->utilisateur_model->updateUtilisateur($this->input->post('id'),$data);
    echo json_encode(array('message'=>'true'));
 }

 public function saveutilisateur(){
    $this->load->model('utilisateur_model');
    $data = [

        "UT_CODE"=>$this->input->post('UT_CODE') , 
        "UT_NOM"=>$this->input->post('UT_NOM') , 
        "UT_PRENOM"=>$this->input->post('UT_PRENOM') ,
        "UT_MOT_DE_PASS"=>$this->input->post('UT_MOT_DE_PASS') , 
        "UT_PROFIL"=>$this->input->post('UT_PROFIL') ,
        "UT_STATUT"=>"Actif"
    ];
    $this->utilisateur_model->insertutilisateur($data);
    echo json_encode(array('message'=>'true'));
 }


  public function dataListe(){
      $this->load->model('utilisateur_model');
      $data=array();
      $datas=$this->utilisateur_model->listeUtilisateur();
    foreach($datas as $row) 
    {
        $sub_array = array();
        $sub_array[] = $row->UT_CODE;
        $sub_array[] = $row->UT_NOM;
        $sub_array[] = $row->UT_PRENOM;
        $sub_array[] = type_utilisateur_for_uri($row->UT_PROFIL);
        $sub_array[] = $row->UT_MOT_DE_PASS;
        $sub_array[] = $row->UT_STATUT;
        
        $sub_array[] = 
        '<a href="'.base_url('Administrateur/Utilisateur/mettre_a_jour/'.$row->UT_ID).'"  class="edit_post btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
         <a href="'.base_url('Administrateur/Utilisateur/supprimer/'.$row->UT_ID).'"  class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
        ';
        $data[] = $sub_array;
    }
         $output = array(
         "data" =>$data
    );
    echo json_encode($output);
		
  }
  public function deletes($UT_ID){
	  $this->load->model('utilisateur_model');
	  $this->utilisateur_model->supprimerUtilisateur($UT_ID);
	   $this->render_view('Administrateur/Utilisateur/liste');
	  
  }


}    