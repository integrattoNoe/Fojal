<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
    function index(){
    	$data["activa"] = "";
        $this->load->view("header_view",$data);
        //$this->load->view("dashboard/emprendimientoSocial_view");
        $this->load->view("footer_view");
    }
    function emprendimiento_social(){
    	$data["activa"] = "empre_social";
        $this->load->view("header_view",$data);
        $this->load->view("dashboard/emprendimientoSocial_view");
        $this->load->view("footer_view");
    }
    
}
?>