<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suivi_des_travaux extends My_Controller {

	public function index()
	{   
	     $this->load->model('accueil_model');
		 $data = [
		 'entete'=>$this->accueil_model->countDemande(),
		 'data'=>$this->accueil_model->listeInstance('En cours')
		 ];
		$this->render_view('Suivi_des_travaux/suivi',$data);
	}
	public function getTravaux($statut){
		$this->load->model('accueil_model');
		//$statut = $this->input->post("statut");
		$datas=$this->accueil_model->listeInstance(str_replace("%20"," ", $statut));
		$data = array();
	 
		
    foreach($datas as $row) 
    {
        $sub_array = array();
        $sub_array[] = $row->D_ID;
        $sub_array[] = $row->D_DATE;
        $sub_array[] = $row->D_APPLICATION;
        $sub_array[] = $row->D_NATURE;
        $sub_array[] = $row->D_DEMANDEUR;
        $sub_array[] = $row->D_DEVELOPPEUR;
		$sub_array[] = $row->D_RESPONSABLE;
        $sub_array[] = $row->D_VALIDATEUR;
        $sub_array[] = '<a href="'.base_url('Administrateur/Detail_fiche/'.$row->D_ID).'"  class="edit_post btn btn-info btn-xs"><i class="fa fa-info"></i></a>';
        $data[] = $sub_array;
    }
    $output = array(
        "data" =>$data
    );
    echo json_encode($output);
		
	}

}
