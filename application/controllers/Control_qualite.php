<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Control_qualite extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    
  }
  public function index()
  {
    $this->render_view('controlleur/accueil');
  }

  public function data_stock_deuxieme_choix(){
    $datas = array();
		$data = array();
		$this->load->model("global");
		$datas = $this->stock_deuxieme_choix_plasmad->get_stock_deuxieme_choix_plasmad();
		foreach ($datas as $row) {
			$sub_array = array();
			$sub_array[] = $row->SD_ID;
			$sub_array[] = $row->SD_PO;
			$sub_array[] = $row->SD_DIMM;
			$sub_array[] = $row->SD_TAILL;
      $sub_array[] = $row->SD_QUANTITE;
      $sub_array[] = "<a href='$row->SD_PO'  class='view btn btn-info btn-sm'>Info</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);

  }

  public function detail_commande_deuxiemeChoix(){
		$this->load->model("stock_deuxieme_choix_plasmad");
    $this->load->model("global");
		$refnum_pe = $this->input->post("refnum_pe");
    $reponse =$this->commande->select_commande(["BC_PE"=>$refnum_pe]); 
		$methodOk = $reponse != null;
		$resultat = ['message'=>false];
		if($methodOk){
			$resultat['client']=$reponse->BC_CLIENT;
			$resultat['dim']=$reponse->BC_DIMENSION;
			$resultat['code']=$reponse->BC_CODE;
			$resultat['quantite']=$reponse->BC_QUNTITE;
			$resultat['tail']= $this->global->get_distinct_colum(["SD_PO"=>$reponse->BC_PE],"SD_TAILL AS 'tail'","stock_deuxieme_choix_plasmad"); 
			
		}
		echo json_encode($resultat);
	}
  public function data_list_sortie_control_qualite(){
    $this->load->model('sortie_control_qualite');
    $datas = array();
		$data = array();
     
		$datas = $this->sortie_control_qualite->get_date_sortie_control_qualite();
	
		foreach ($datas as $row) {

			$sub_array = array();
			$sub_array[] = $row->CS_DATE;
			$sub_array[] = $row->CS_PO;
			$sub_array[] = $row->CS_DIM;
			$sub_array[] = $row->CS_QTT;
			$sub_array[] = $row->CS_BL;
			$sub_array[] ="<a href='".$row->CS_ID."' class='btn btn-danger btn-sm delete'><i class='fa fa-trash'></i>&nbsp;Supprimer</a>";
			$data[] = $sub_array;
		}
		$output = array(
			"data" => $data
		);
		echo json_encode($output);

  }

 public function save_sortie_control_qualite(){
    $methodOk = false;
    $this->load->model("sortie_control_qualite");
    $this->load->model("stock_deuxieme_choix_plasmad");
    $refnum_commande = $this->input->post('CS_PO');
    $quantite_entre = $this->input->post('CS_QTT');
    $dim = $this->input->post('CS_DIM');
    $tail = $this->input->post('CS_TAIL');
    $data = ["SD_PO"=>$refnum_commande,"SD_TAILL"=> $tail];
    $deuxieme_choix = $this->stock_deuxieme_choix_plasmad->get_detail_stock_deuxieme_choix_plasmad($data);
    
    $methodOk = $deuxieme_choix != null;
    if($methodOk){
      $data = [
        "CS_DATE" => $this->input->post('CS_DATE'),
        "CS_QTT" => $quantite_entre,
        "CS_DIM" => $dim,
        "CS_PO" => $refnum_commande,
        "CS_BL" => $this->input->post('CS_BL'),
        "CS_PERS"=> $this->session->userdata('matricule')
       ];
      $this->sortie_control_qualite->insert_data_sortie_control_qualite($data);
        if($deuxieme_choix != null){  
        $quantite =  $deuxieme_choix->SD_QUANTITE - $quantite_entre ;
          $requette = ["SD_ID"=>$deuxieme_choix->SD_ID,"SD_TAILL"=> $tail];
          $data = ["SD_QUANTITE"=> $quantite];
          $this->stock_deuxieme_choix_plasmad->update_stock_deuxieme_choix_plasmad($requette,$data);  
        }
    }
    echo $methodOk;
 }
 public function delete_sortie_control_qualite(){
  $this->load->model("sortie_control_qualite");
  $refnum = $this->input->post('refnum');
  $param = ["CS_ID"=>$refnum];
  echo $this->sortie_control_qualite->delete_date_sortie_control_qualite($param);
 }
  public function Stock_deuxieme_choix(){
    $this->load->model("commande");
    $data = [
        'type' => $this->commande->type(),
        'type_de_matier' => $this->commande->type_de_matier()
      ];
    $this->render_view('control_qualite/Stock_deuxieme_choix',$data);
  }
  public function Entree(){
    $this->render_view('control_qualite/Entree');
  }
  public function Liste_des_entrees(){
    $this->render_view('control_qualite/Liste_des_entrees');
  }
  public function Sortie(){
    $this->render_view('control_qualite/Sortie');
  }
  public function Liste_des_sorties(){
    $this->render_view('control_qualite/Liste_des_sorties');
  }
}