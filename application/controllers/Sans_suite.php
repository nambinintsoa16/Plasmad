<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sans_suite extends My_Controller {

	public function index()
	{   
	     $this->load->model('accueil_model');
		 $data = [
		 'data'=>$this->accueil_model->listeInstance('Sans suite')
		 ];
		$this->render_view('global/accueil',$data);
	}
	

}
