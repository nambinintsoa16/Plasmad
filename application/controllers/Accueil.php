<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends My_Controller {

	public function index()
	{   
	     $this->load->model('accueil_model');
		$this->render_view('global/accueil');
	}
	public function En_instance(){
		$this->load->model('accueil_model');
        echo json_encode($this->accueil_model->listeInstance(''));
	}

}
