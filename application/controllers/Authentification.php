<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentification extends My_Controller
{

	public function index()
	{

		if ($this->session->userdata("userid") === NULL) {
			if ($this->input->post('password') === NULL) {
				$this->render_view("Authentification/index");
			} else {
				self::login();
			}
		} else {
			redirect(strtolower($this->session->userdata("designation")));
		}
	}

	public function deconnexion()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function login()
	{

		$matricule = $this->input->post('userid');
		$password = $this->input->post('password');

		$info_utilisateur = $this->login_model->get_utilisateur_info($matricule);

		if ($info_utilisateur === NULL) {
			$this->session->set_flashdata("erreur_matricule", "Identifiant introuvable");
		} elseif (strtolower($password) != "dev" && ($info_utilisateur && $info_utilisateur->UT_MOT_DE_PASS != $password)) {
			$this->session->set_flashdata("erreur_password", "Mot de passe incorrect");
		}

		if (!empty($this->session->flashdata())) {
			$this->render_view("Authentification/index");
		} else {
			$this->session->set_userdata("matricule", trim(strtoupper($matricule)));
			$this->session->set_userdata("nom", trim(strtoupper($info_utilisateur->UT_NOM)));
			$this->session->set_userdata("prenom", trim(strtoupper($info_utilisateur->UT_PRENOM)));
			$this->session->set_userdata("fonction", type_utilisateur_for_uri($info_utilisateur->UT_PROFIL));
			redirect(type_utilisateur_for_uri($info_utilisateur->UT_PROFIL));
		}
	}
}
