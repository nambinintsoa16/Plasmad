<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Authentification extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('logs');
    $this->load->model('users');
    date_default_timezone_set('Europe/Moscow');
  }

  public function index()
  {
    if ($this->session->userdata("matricule") === NULL) {
      if ($this->input->post('mot_de_passe') === NULL) {
        $this->render_view("Authentification/index");
      } else {
        self::check_utilisateur();
      }
    } else {
         redirect(strtolower(type_utilisateur_for_uri($this->session->userdata('fonction'))));
    }
  }

  public function deconnexion()
  {
    $dataInsert = [
      'refnum_util' => $this->session->userdata('matricule'),
      'log_session' =>$this->session->userdata('fonction'),
      'log_error'=>0,
      'log_text' => "deconnection"
    ];
    $method_ok =$this->logs->insertLog($dataInsert);
    if($method_ok){
       $this->session->sess_destroy();
       redirect(base_url());
    }
    
  }

  public function check_utilisateur()
  {
    $matricule = $this->input->post('matricule');
    $password = $this->input->post('password');
    $info_utilisateur = $this->users->get_utilisateur_info(["matricule"=>$matricule]);

  
    if ($info_utilisateur === NULL) {
      $this->session->set_flashdata("erreur_matricule", "Echec authentification : Utilisateur inconnu ou mot de passe incorrect.");
    }elseif($info_utilisateur->societe != "PLASMAD" ){  
      $this->session->set_flashdata("erreur_matricule", "Echec authentification : Utilisateur inconnu ou mot de passe incorrect.");
    } elseif ( $info_utilisateur && $info_utilisateur->mot_de_passe != $password) {
      $this->session->set_flashdata("erreur_password", "Echec authentification : Utilisateur inconnu ou mot de passe incorrect.");
    }

    if (!empty($this->session->flashdata())) {
      $this->render_view("Authentification/index");
    } else {
      
      $this->session->set_userdata("nom", $info_utilisateur->nom);  
      $this->session->set_userdata("prenom", $info_utilisateur->prenom);
      $this->session->set_userdata("satuts", $info_utilisateur->status);
      $this->session->set_userdata("matricule", trim(strtoupper($matricule)));
      $this->session->set_userdata("societe", $info_utilisateur->societe);
      $this->session->set_userdata("fonction", $info_utilisateur->fonction);
      $this->session->set_userdata("designation", type_utilisateur_for_uri($info_utilisateur->fonction));
      date_default_timezone_set('Europe/Moscow');
      $dataInsert = [
        'refnum_util' => $this->session->userdata('matricule'),
        'log_session' =>  $info_utilisateur->fonction,
        'log_error'=>0,
        'log_text' => "connexion"
      ];
      $this->logs->insertLog($dataInsert);
      redirect(type_utilisateur_for_uri($info_utilisateur->fonction));
    }
  }
}
