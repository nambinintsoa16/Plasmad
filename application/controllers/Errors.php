<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Errors extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
public function notfound(){
    $this->render_view("erreurs/404.php");
}

}