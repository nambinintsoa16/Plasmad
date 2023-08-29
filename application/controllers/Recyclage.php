<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Recyclage extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("dechet");
    $this->load->model("stock_dechet");
    $this->load->model("mouvement_recyclage");
  }
  public function Enregistrer(){
    $this->render_view('recyclage/sauve_dechet');
  }
  public function Entree(){
    $this->render_view('recyclage/Entree_dechet');
  }
  public function Sortie(){
    $this->render_view('recyclage/Sortie_dechet');
  }
  public function Liste_des_entrees(){
    $this->render_view('recyclage/Liste_des_entrees');
  }
  public function Liste_des_sorties(){
    $this->render_view('recyclage/Liste_des_sorties');
  }
  public function save_new_dechet(){
    if($this->dechet->insert_data_dechet([
      "DE_PO"=>$this->input->post('po'),
      "DE_MACHINE"=>$this->input->post('MACHINES'),
      "DE_OPERATEUR"=>$this->input->post('OPERATEUR'),
      "DE_DATE"=>$this->input->post('date'),
      "DE_POIDS"=>$this->input->post('POIDS'),
      "DE_TYPE"=>$this->input->post('TYPE'),
      "DE_DECHET"=>$this->input->post('DECHETS'),
      "DE_TYPE_MATIER"=>$this->input->post('MATIERE'),
      "DE_USER"=>$this->session->userdata('matricule')
    ])){
      $data = $this->stock_dechet->get_detail_stock_dechet(["id"=>1]);
      if($data ){
        $matier = $data->stock + $this->input->post('POIDS');
              return $this->stock_dechet->update_date_stock_dechet(["id"=>1],["stock"=>$matier]);     
      }
      
    }

    }
   public function tableDecheRecycle(){
      $data = array();
      $datas = $this->dechet->selectsDechet();
      foreach ($datas as $row) {
        $sub_array = array();
        $sub_array[] = $row->DE_DATE;
        $sub_array[] = $row->DE_MACHINE;
        $sub_array[] = $row->DE_PO;
        $sub_array[] = $row->DE_OPERATEUR;
        $sub_array[] = $row->DE_DECHET;
        $sub_array[] = $row->DE_POIDS;
  
        $sub_array[] =
          '<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->DE_PO) . '" id="' . $row->DE_PO . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
         <a href="' . base_url('Administrateur/Utilisateur/supprimer/' . $row->DE_PO) . '" id="' . $row->DE_PO . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
  
        $data[] = $sub_array;
      }
      $output = array(
        "data" => $data
      );
      echo json_encode($output);
   }
  
   public function get_entree_dechet(){
    $data = array();
  
    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $datas = array();
    if( !empty($debut)  && !empty($fin)){
      $datas = $this->dechet->get_date_dechet("DE_TYPE = 'ENTRE' AND  DE_DATE BETWEEN '".$debut."' AND '".$fin."'");
    }else if(!empty($debut)){
      $datas = $this->dechet->get_date_dechet(["DE_TYPE"=>"ENTRE","DE_DATE"=>$debut]);
    }else{
      $datas = $this->dechet->get_date_dechet("DE_TYPE = 'ENTRE'AND  DE_DATE like '".date('Y-m')."%'");
    }
  
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->DE_DATE;
      $sub_array[] = $row->DE_PO;
      $sub_array[] = $row->DE_OPERATEUR;
      $sub_array[] = $row->DE_MACHINE;
      $sub_array[] = $row->DE_TYPE_MATIER;
      $sub_array[] = $row->DE_DECHET;
      $sub_array[] = $row->DE_POIDS;
      $sub_array[] =
        '<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->DE_PO) . '" id="' . $row->DE_PO . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i>&nbsp;Détail</a>';
  
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function sortieRecyclage(){
    $data = array();
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  
  public function save_entree(){
  
    if($this->mouvement_recyclage->insert_data_mouvement_recyclage([
      "MR_MACHINE"=>$this->input->post('MACHINES'),
      "MR_OPERATEUR"=>$this->input->post('OPERATEUR'),
      "MR_DATE"=>$this->input->post('DATE'),
      "MR_POIDS"=>$this->input->post('POIDS'),
      "MR_TYPE"=>$this->input->post('TYPE'),
      "MR_DECHET"=>$this->input->post('DECHETS'),
      "MR_TYPE_DECHET"=>$this->input->post('MATIERE'),
      "MR_UTILSATEUR"=>$this->session->userdata('matricule')
    ])){

    $data = $this->stock_dechet->get_detail_stock_dechet(["id"=>1]);
      if($data ){
        $matier = $data->stock + $this->input->post('POIDS');
              return $this->stock_dechet->update_date_stock_dechet(["id"=>1],["stock"=>$matier]);     
      }
    }	
  }
  
  public function save_sortie(){
    if( $this->mouvement_recyclage->insert_data_mouvement_recyclage([
      "MR_MACHINE"=>$this->input->post('MACHINES'),
      "MR_OPERATEUR"=>$this->input->post('OPERATEUR'),
      "MR_DATE"=>$this->input->post('DATE'),
      "MR_POIDS"=>$this->input->post('POIDS'),
      "MR_TYPE"=>$this->input->post('TYPE'),
      "MR_DECHET"=>$this->input->post('DECHETS'),
      "MR_TYPE_MATIER"=>$this->input->post('MATIERE'),
      "MR_UTILSATEUR"=>$this->session->userdata('matricule'),
      "MR_DECHET_SORTIE"=>$this->input->post('POIDSDECHET')
    ]))
    {

      $data = $this->stock_dechet->get_detail_stock_dechet(["id"=>1]);
        if($data ){
          $matier = $data->stock - $this->input->post('POIDS');
                return $this->stock_dechet->update_date_stock_dechet(["id"=>1],["stock"=>$matier]);     
        }
      }	
  }
  
  public function data_liste_entree(){
    $data = array();
    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $datas = array();
    if( !empty($mouvement_recyclage)  && !empty($fin)){
      $datas = $this->mouvement_recyclage->get_date_mouvement_recyclage("MR_TYPE = 'ENTRE' AND  MR_DATE BETWEEN '".$debut."' AND '".$fin."'");
    }else if(!empty($mouvement_recyclage)){
      $datas = $this->mouvement_recyclage->get_date_mouvement_recyclage(["MR_TYPE"=>"ENTRE","MR_DATE"=>$debut]);
    }else{
      $datas = $this->mouvement_recyclage->get_date_mouvement_recyclage("MR_TYPE = 'ENTRE'AND  MR_DATE like '".date('Y-m')."%'");
    }
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->MR_DATE;
      $sub_array[] = $row->MR_MACHINE;
      $sub_array[] = $row->MR_OPERATEUR;
      $sub_array[] = $row->MR_TYPE_DECHET;
      $sub_array[] = $row->MR_DECHET;
      $sub_array[] = $row->MR_POIDS;
      $sub_array[] =
        '<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->MR_ID) . '" id="' . $row->MR_ID . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i>&nbsp;Détail</a>';
  
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  
  
  
  
  public function Export_entre(){
  
    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $datas = array();
    if( !empty($debut)  && !empty($fin)){
      $datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE' AND  DE_DATE BETWEEN '".$debut."' AND '".$fin."'");
    }else if(!empty($debut)){
      $datas = $this->Controlleur_model->selectsDechet(["DE_TYPE"=>"ENTRE","DE_DATE"=>$debut]);
    }else{
      $datas = $this->Controlleur_model->selectsDechet("DE_TYPE = 'ENTRE'AND  DE_DATE like '".date('Y-m')."%'");
    }
    
      $excel = "\tSTOCK RECYCLE\t" . mois(date('m')) . " " . date('Y') . "\n";
      $excel .= "\t\n";
      $excel .= "DATE\tN°PO\tOPERATEUR\tTYPE DE MATIEER\tTYPE DE MATIEER\tTYPE DE DECHETS\tPOIDS\n";
        foreach ($datas as $key => $row) {
        
         $excel .= "$row->DE_DATE\t $row->DE_PO\t $row->DE_OPERATEUR\t$row->DE_MACHINE\t $row->DE_TYPE_MATIER\t$row->DE_DECHET\t$row->DE_POIDS\n";
        
      }
    
      header("Content-type: application/vnd.ms-excel");
      header("Content-disposition: attachment; filename=STOCK RECYCLE  : " . date("d-m-Y") . ".xls");
      print $excel;
      exit;
  
  }
  public function data_liste_sortie(){
    $data = array();
    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $datas = array();
    if( !empty($mouvement_recyclage)  && !empty($fin)){
      $datas = $this->mouvement_recyclage->get_date_mouvement_recyclage("MR_TYPE = 'SORTIE' AND  MR_DATE BETWEEN '".$debut."' AND '".$fin."'");
    }else if(!empty($mouvement_recyclage)){
      $datas = $this->mouvement_recyclage->get_date_mouvement_recyclage(["MR_TYPE"=>"SORTIE","MR_DATE"=>$debut]);
    }else{
      $datas = $this->mouvement_recyclage->get_date_mouvement_recyclage("MR_TYPE = 'SORTIE'AND  MR_DATE like '".date('Y-m')."%'");
    }
   
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->MR_DATE;
      $sub_array[] = $row->MR_MACHINE;
      $sub_array[] = $row->MR_OPERATEUR;
      $sub_array[] = $row->MR_DECHET;
      $sub_array[] = $row->MR_TYPE_MATIER;
      $sub_array[] = $row->MR_POIDS;
      $sub_array[] = $row->MR_DECHET_SORTIE;
      $sub_array[] =
        '<a href="' . base_url('Administrateur/Utilisateur/mettre_a_jour/' . $row->MR_ID) . '" id="' . $row->MR_ID . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i>&nbsp;Détail</a>';
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  
  public function print_entre_dechet(){
    $content = "";
    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $datas = array();
    if( !empty($debut)  && !empty($fin)){
      $datas = $this->dechet->selectsDechet("DE_TYPE = 'ENTRE' AND  DE_DATE BETWEEN '".$debut."' AND '".$fin."'");
    }else if(!empty($debut)){
      $datas = $this->dechet->selectsDechet(["DE_TYPE"=>"ENTRE","DE_DATE"=>$debut]);
    }else{
      $datas = $this->dechet->selectsDechet("DE_TYPE = 'ENTRE'AND  DE_DATE like '".date('Y-m')."%'");
    }
  
      $html =$this->load->view("controlleur/suivieCoupe", $datas,true);
      $filename = "SUIVIE MACHINE  COUPE du ";
  
      $dompdf = new pdf();
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'portrait');
      $dompdf->render();
      $dompdf->stream($filename);
        
  }	
}


