<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Accueil extends My_Controller
{
    public function index()
    {
        $session = $this->session->userdata('fonction');
        switch ($session) {
            case 1:
                $this->commercial();
                break;
            case 2:
                $this->production();
                break;
            case 3:
                $this->comptabilite();
                break;
            case 4:
                $this->stock();
                break;
            case 5:
                $this->surplus();
                break;
            case 6:
                $this->planning();
                break;
            case 7:
                $this->recyclage();
                break;
            case 8:
                $this->gaines();
                break;
            case 9:
                $this->controlleur();
                break;
            case 10:
                $this->control_qualite();
                break;
            case 11:
                $this->Responsables_magasin();
                break;
            case 12:
                $this->Transit();
                break;
            case 13:
                $this->Finance();
                break;
            case 14:
                $this->Suivi_Commerciale();
                break;
            case 15:
                $this->wip();
                break;
            default:
                echo "Erreur de chargement de la page d'accueil";
                break;
        }
    }
    public function commercial()
    {
        $this->render_view('commercial/accueil');
    }
    public function production()
    {
        $this->render_view('production/accueil');
    }
    public function comptabilite()
    {
        $this->render_view('comptabilite/accueil');
    }
    public function stock()
    {
        $this->render_view('stock/accueil');
    }
    public function surplus()
    {
        $this->render_view('surplus/accueil');
    }
    public function planning()
    {
        $this->render_view('planning/accueil');
    }
    public function recyclage()
    {
        $this->load->model("stock_dechet");
        $reponse = $this->stock_dechet->get_detail_stock_dechet(["id" => 1]);
        $data = array("data" => $reponse);
        $this->render_view('recyclage/accueil', $data);
    }
    public function gaines()
    {
        $this->render_view('gaines/accueil');
    }
    public function controlleur()
    {
        $this->render_view('controlleur/accueil');
    }
    public function control_qualite()
    {
        $this->render_view('controlleur/accueil');
    }
    public function Responsables_magasin()
    {
        $this->render_view('controlleur/accueil');
    }
    public function Transit()
    {
        $this->render_view('controlleur/accueil');
    }
    public function Finance()
    {
        $this->render_view('Finance/accueil');
    }
    public function Suivi_commerciale()
    {
        $this->render_view('suivi_commerciale/accueil');
    }
    public function wip(){
        $this->render_view('wip/accueil');
    }
}
