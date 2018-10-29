<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model("calendario/Eventos_model");
    }

    function index(){
    	$data["activa"] = "eventos";
        $this->load->view("header_view",$data);
        $this->load->view("calendario/Eventos_view");
        $this->load->view("footer_view");
    }

    function getEventos(){
    	$result = $this->Eventos_model->getEventos();
    	$this->responder($result);
    }

    function guardar(){
    	if($this->input->post("accion") == "guardar"){
    		/*nuevo evento*/
    		$nuevo = array(
    			"titulo"=>$this->input->post("titulo"),
    			"fechaEvento"=>$this->input->post("fecha"),
    			"fechaPublicado"=>date("Y-m-d"),
    			"autor"=>$this->session->userdata["logged_in"]["idUsuario"]
    		);
    		$result = $this->Eventos_model->guardar($nuevo);
    		if($result["code"]==200){
    			$response["code"] = 200;
    		}else{
    			$response["code"] = 400;
    			$response["msg"] = $result["msg"];
    		}
    		

    	}else{
    		$modif = array(
    			"titulo"=>$this->input->post("titulo"),
    			"fechaEvento"=>$this->input->post("fecha")
    		);
    		$result = $this->Eventos_model->actualizar($modif,$this->input->post("idEvento"));
    		if($result){
    			$response["code"] = 200;
    		}else{
    			$response["code"] = 400;
    		}
    	}
    	
    	$response["session"] = $this->session->userdata["logged_in"]["usuario"];
     	$this->responder($response);
    }

    function eliminar(){
    	$result = $this->Eventos_model->eliminar($this->input->post("idEliminar"));
    	$response["code"]=500;
    	if($result)
    		$response["code"]=200;
    	$this->responder($response);
    }

    function responder($respuesta){
        header('Content-type: application/json');
        echo json_encode($respuesta);
    }
}
?>