<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba1 extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('mihelper');
    }
    function index(){
        $this->load->view("prueba/prueba");
    }
}

?>