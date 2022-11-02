<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

	public $type_utilisateur;

	public function __construct() {
		parent::__construct();
		$this->type_utilisateur = str_replace("/", "", $this->uri->slash_segment(1));
	}
	
	public function render_view($view, $data = null) {

		self::connecte();

		$type_user = str_replace("/", "", $this->uri->slash_segment(1));

		$uri = $this->uri->segment_array();
		if($this->session->userdata("fonction")=="Administrateur" || $type_user=="authentification"){
			$layout="layout";	
		}else{
			$layout="layouts";	
		}
        
		$this->load->view($layout."/header", compact("type_user", "uri"));
		
		if ( !empty($type_user) && strtolower($type_user) != "authentification" ) {

			$menu_content = self::type_config($type_user);
			$data['nav_color'] = $menu_content->couleur_nav;
			$data['base_color'] = $menu_content->couleur_base;
			$data['list_menu'] = $menu_content->menu;
			$data['type_user'] = $type_user;
			$data['uri'] = $uri;
			
			$this->load->view($layout."/navbar", $data);
			$this->load->view($layout."/menu", $data);
		}

		if (is_array($view)){
			$data["content"] = implode(" ", $view);
		}
		else{
			$data['uri'] = $uri;
			$data["content"] = $this->load->view($view, $data, TRUE);
		}

		$this->load->view($layout."/content", $data);
		$this->load->view($layout."/footer", compact("type_user", "uri"));

	}

	public function type_config($type){

		$json = json_decode( read_file("application/menu_content/$type.json") );
		return $json;

	}

	public function connecte(){
		if ($this->session->userdata("matricule") === NULL && $this->uri->segment(1) != "authentification" ) {
			redirect('authentification');
		}
		else{
			if( strtolower($this->uri->segment(1)) != strtolower($this->session->userdata("fonction")) &&  $this->uri->segment(1) != "authentification"){
				redirect($this->session->userdata("fonction"));
			}
		}
	}

}

