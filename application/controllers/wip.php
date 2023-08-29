<?php
defined('BASEPATH') or exit('No direct script access allowed');
class wip extends My_Controller
{
	public function index(){
		 $this->render_view('wip/accueil');
	}
	public function entree_gaine(){
		$this->render_view('wip/gaine/entree');
	}
	public function sortie_gaine(){
		$this->render_view('wip/gaine/sortie');
	} 
	public function entree_gaine_imprimer(){
		$this->render_view('wip/gaine_imprmer/entree');
	}
    public function sortie_gaine_imprimer(){
		$this->render_view('wip/gaine_imprmer/sortie');
	}
	public function Stock_gaine_imprimer(){
		$this->render_view('wip/gaine_imprmer/stock');
	}
    public function stock_gaine_plaine(){
		$this->render_view('wip/gaine/stock');
	}
	public function Liste_des_entrees_gaine_plaine(){
		$this->render_view('wip/gaine/Liste_des_entrees');
	}

	public function Liste_des_sorties_gaine_plaine(){
		$this->render_view('wip/gaine/Liste_des_sorties');
	}

	public function gaine_imprimer_liste_des_entrees_gaine_plaine(){
		$this->render_view('wip/gaine_imprmer/Liste_des_entrees');
	}
	public function gaine_imprimer_liste_des_sorties_gaine_plaine(){
		$this->render_view('wip/gaine_imprmer/Liste_des_sorties');
	}

	public function save_gaine_entree(){
		$date = $this->input->post('date');
		$refnum = $this->input->post('refnum');
		$client = $this->input->post('client');
		$Codeclient = $this->input->post('Codeclient');
		$dim = $this->input->post('dim');
		$entre = $this->input->post('entre');
		$obs = $this->input->post('obs');
		$operateur = $this->input->post('operateur');
        $machine = $this->input->post('machine');
        $data_entree = [
			"EF_DATE"=>$date, 
			"EF_MAGASIN"=>$this->session->userdata('matricule'),
			"BC_ID"=>$refnum, 
			"EF_CLIENT"=>$client,
			"EF_DIM"=>$dim,
			"EF_QUANTITE"=>$entre, 
			"EF_TYPE"=>"entre",
			"EF_REMARQUE"=>"entre_gaine", 
			"STF_OBSE"=>$obs,
			"EF_OPERATEUR"=>$operateur,
			"EF_MACHINE"=>$machine
		];
		$this->wip_entree_gaines->insert_data_wip_entree_gaines($data_entree);
		$reponse = $this->wip_stock_gaines_plasmad->get_detail_wip_stock_gaines_plasmad(["BC_ID"=>$refnum]);
		$methodOk = $reponse !=null;
        if($methodOk){
			$reponse->STF_QUANTITE = $reponse->STF_QUANTITE + $entre;
			echo $this->wip_stock_gaines_plasmad->update_wip_stock_gaines_plasmad(["STF_ID"=>$reponse->STF_ID],$reponse);
		}else{
			$data = [
					"BC_ID"=>$refnum,
					"STF_QUANTITE"=>$entre,
					"STF_CLIENT"=>$client,
					"STF_DIM"=>$dim,
					"STF_DATE"=>$date,
					"STF_VALEUR"=>0
					];
		   echo $this->wip_stock_gaines_plasmad->insert_wip_stock_gaines_plasmad($data);
		}
	}
	public function wip_gaine_imprimer_save_sortie(){
		$date = $this->input->post("date");
		$refnum = $this->input->post("refnum");
		$client = $this->input->post("client");
		$dim = $this->input->post("dim");
		$taille = $this->input->post("taille");
		$quantite = $this->input->post("quantite");
		$obs = $this->input->post("obs");
		$BL = $this->input->post("BL");

		$reponse = $this->wip_stock_gaines_plasmad_imprimer->get_detail_wip_stock_gaines_imprimer_plasmad(["BC_ID"=>$refnum]);
		$methodOk = $reponse !=null;
        if($methodOk){
			$reponse->STF_QUANTITE = $reponse->STF_QUANTITE - $quantite;
			$methodOk = $this->wip_stock_gaines_plasmad_imprimer->update_wip_stock_gaines_imprimer_plasmad(["STF_ID"=>$reponse->STF_ID],$reponse);
			if($methodOk){
				$data_sortie = [
					"SF_DATE"=>$date, 
					"SF_BL"=>$BL, 
					"SF_MAGASIN"=>$this->session->userdata("matricule"),
					"BC_ID"=>$refnum, 
					"SF_QUANTITE"=>$quantite, 
					"STF_OBSE"=>$obs, 
					"SF_DIM"=>$dim, 
					"SF_CLIENT"=>$client
				];
				echo $this->wip_sortie_gaines_imprimer->insert_data_wip_sortie_gaines_imprimer($data_sortie);
			}
		}


	}



	public function save_gaine_imprimer_entree(){
		$date = $this->input->post('date');
		$refnum = $this->input->post('refnum');
		$client = $this->input->post('client');
		$Codeclient = $this->input->post('Codeclient');
		$dim = $this->input->post('dim');
		$entre = $this->input->post('entre');
		$obs = $this->input->post('obs');
		
        $data_entree = [
			"EF_DATE"=>$date, 
			"EF_MAGASIN"=>$this->session->userdata('matricule'),
			"BC_ID"=>$refnum, 
			"EF_CLIENT"=>$client,
			"EF_DIM"=>$dim,
			"EF_QUANTITE"=>$entre, 
			"EF_TYPE"=>"entre",
			"EF_REMARQUE"=>"entre_gaine", 
			"STF_OBSE"=>$obs
		];
		$this->wip_entree_gaines_imprimer->insert_data_wip_entree_gaines_imprimer($data_entree);
		$reponse = $this->wip_stock_gaines_plasmad_imprimer->get_detail_wip_stock_gaines_imprimer_plasmad(["BC_ID"=>$refnum]);
		$methodOk = $reponse !=null;
        if($methodOk){
			$reponse->STF_QUANTITE = $reponse->STF_QUANTITE + $entre;
			echo $this->wip_stock_gaines_plasmad_imprimer->update_wip_stock_gaines_imprimer_plasmad(["STF_ID"=>$reponse->STF_ID],$reponse);
		}else{
			$data = [
					"BC_ID"=>$refnum,
					"STF_QUANTITE"=>$entre,
					"STF_CLIENT"=>$client,
					"STF_DIM"=>$dim,
					"STF_DATE"=>$date,
					"STF_VALEUR"=>0
					];
		   echo $this->wip_stock_gaines_plasmad_imprimer->insert_wip_stock_gaines_imprimer_plasmad($data);
		}
	}
	public function autocomplet_stock_wipe_gane_plaine()
  {
    $mot = $this->input->get('term');
    $data = $this->wip_stock_gaines_plasmad->get_wip_stock_gaines_plasmad("BC_ID like '%$mot%' LIMIT 10");
    $reponse = array();
    foreach ($data as $key => $data) {
      $reponse[] = $data->BC_ID;
    }
    echo json_encode($reponse);
  }
	public function wip_gaine_save_sortie(){
		$date = $this->input->post("date");
		$refnum = $this->input->post("refnum");
		$client = $this->input->post("client");
		$dim = $this->input->post("dim");
		$taille = $this->input->post("taille");
		$quantite = $this->input->post("quantite");
		$obs = $this->input->post("obs");
		$BL = $this->input->post("BL");
		$machine = $this->input->post("machine");
		$operateur = $this->input->post("operateur");
		

		$reponse = $this->wip_stock_gaines_plasmad->get_detail_wip_stock_gaines_plasmad(["BC_ID"=>$refnum]);
		$methodOk = $reponse !=null;
        if($methodOk){
			$reponse->STF_QUANTITE = $reponse->STF_QUANTITE - $quantite;
			$methodOk = $this->wip_stock_gaines_plasmad->update_wip_stock_gaines_plasmad(["STF_ID"=>$reponse->STF_ID],$reponse);
			if($methodOk){
				$data_sortie = [
					"SF_DATE"=>$date, 
					"SF_BL"=>$BL, 
					"SF_MAGASIN"=>$this->session->userdata("matricule"),
					"BC_ID"=>$refnum, 
					"SF_QUANTITE"=>$quantite, 
					"STF_OBSE"=>$obs, 
					"SF_DIM"=>$dim, 
					"SF_CLIENT"=>$client, 
					"SF_OPERATEUR"=>$operateur, 
					"SF_MACHINE"=>$machine
				];
				echo $this->wip_sortie_gaines->insert_data_wip_sortie_gaines($data_sortie);
			}
		}


	}
	public function data_liste_stock_ganes_imprimer(){

		$date_debut = $this->input->get('date_debut');
		$date_fin = $this->input->get('date_fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->wip_stock_gaines_plasmad_imprimer->get_wip_stock_gaines_imprimer_plasmad(("STF_DATE BETWEEN '$date_debut' AND '$date_fin'"));
		} else {
			
			$datas = $this->wip_stock_gaines_plasmad_imprimer->get_wip_stock_gaines_imprimer_plasmad();
		}


		$data = array();
		foreach ($datas as $row) {
			if($row->STF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->STF_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->STF_CLIENT;
			$sub_array[] = $row->STF_DIM;
			$sub_array[] = $row->STF_TAIL;
			$sub_array[] = $row->STF_QUANTITE;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info info_produit btn-sm'><i class='fa fa-info'></i>&nbsp;Détail</a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function data_liste_stock_ganes_plaine(){

		$date_debut = $this->input->get('date_debut');
		$date_fin = $this->input->get('date_fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->wip_stock_gaines_plasmad->get_wip_stock_gaines_plasmad(("STF_DATE BETWEEN '$date_debut' AND '$date_fin'"));
		} else {
			
			$datas = $this->wip_stock_gaines_plasmad->get_wip_stock_gaines_plasmad();
		}

		$data = array();
		foreach ($datas as $row) {
			if($row->STF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->STF_DATE;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->STF_CLIENT;
			$sub_array[] = $row->STF_DIM;
			$sub_array[] = $row->STF_TAIL;
			$sub_array[] = $row->STF_QUANTITE;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info info_produit btn-sm'><i class='fa fa-info'></i>&nbsp;Détail</a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}
	public function data_liste_entre_ganes_plaine(){
		$this->load->model('commande');
		$date_debut = $this->input->get('date_debut');
		$date_fin = $this->input->get('date_fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->wip_entree_gaines->get_date_wip_entree_gaines(("EF_DATE BETWEEN '$date_debut' AND '$date_fin'"));
		} else {
			
			$datas = $this->wip_entree_gaines->get_date_wip_entree_gaines();
		}

		$data = array();
		foreach ($datas as $row) {
			if($row->EF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->EF_ID;
			$sub_array[] = $row->EF_DATE;
			$sub_array[] = $row->EF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->EF_TAILL;
			$sub_array[] = $row->EF_QUANTITE;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = $row->STF_OBSE;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'></i>&nbsp;Détail</a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function data_liste_sortie_ganes_plaine(){
		$this->load->model('commande');
		$date_debut = $this->input->post('dateDebut');
		$date_fin = $this->input->post('dateFin');
		$methodOk = !empty($dateDebut) && !empty($dateFin);
		if ($methodOk) {
			$datas = $this->wip_sortie_gaines->get_date_wip_sortie_gaines(("SF_DATE BETWEEN $date_debut AND $date_fin"));
		} else {
			
			$datas = $this->wip_sortie_gaines->get_date_wip_sortie_gaines();
		}

		$data = array();
		foreach ($datas as $row) {
			if($row->SF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->SF_ID;
			$sub_array[] = $row->SF_DATE;
			$sub_array[] = $row->SF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->SF_TAILL;
			$sub_array[] = $row->SF_QUANTITE;
			$sub_array[] = $row->SF_BL;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = $row->STF_OBSE;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'><i/></a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}



	public function data_liste_entre_ganes_imprimer(){
		$this->load->model('commande');
		$date_debut = $this->input->get('date_debut');
		$date_fin = $this->input->get('date_fin');
		$methodOk = !empty($date_debut) && !empty($date_fin);
		if ($methodOk) {
			$datas = $this->wip_entree_gaines_imprimer->get_date_wip_entree_gaines_imprimer(("EF_DATE BETWEEN '$date_debut' AND '$date_fin'"));
		} else {
			
			$datas = $this->wip_entree_gaines_imprimer->get_date_wip_entree_gaines_imprimer();
		}

		$data = array();
		foreach ($datas as $row) {
			if($row->EF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->EF_ID;
			$sub_array[] = $row->EF_DATE;
			$sub_array[] = $row->EF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->EF_TAILL;
			$sub_array[] = $row->EF_QUANTITE;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = $row->STF_OBSE;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'></i>&nbsp;Détail</a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}

	public function data_liste_sortie_ganes_imprimer(){
		$this->load->model('commande');
		$date_debut = $this->input->post('dateDebut');
		$date_fin = $this->input->post('dateFin');
		$methodOk = !empty($dateDebut) && !empty($dateFin);
		if ($methodOk) {
			$datas = $this->wip_sortie_gaines_imprimer->get_date_wip_sortie_gaines_imprimer(("SF_DATE BETWEEN $date_debut AND $date_fin"));
		} else {
			
			$datas = $this->wip_sortie_gaines_imprimer->get_date_wip_sortie_gaines_imprimer();
		}

		$data = array();
		foreach ($datas as $row) {
			if($row->SF_QUANTITE !=0){
			$sub_array = array();
			$sub_array[] = $row->SF_ID;
			$sub_array[] = $row->SF_DATE;
			$sub_array[] = $row->SF_MAGASIN;
			$sub_array[] = $row->BC_ID;
			$sub_array[] = $row->SF_TAILL;
			$sub_array[] = $row->SF_QUANTITE;
			$sub_array[] = $row->SF_BL;
			$commande = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
            $commande ? $sub_array[] =	 $commande->BC_PRIX : $sub_array[] = 0;
			$sub_array[] = $row->STF_OBSE;
			$sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'><i/></a>";
			$data[] = $sub_array;
		}
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);
	}


}
