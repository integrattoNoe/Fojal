<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model("calendario/Banners_model");
    }

    function index(){
    	$data["activa"] = "banners";
        $this->load->view("header_view",$data);
        $this->load->view("calendario/Banners_view");
        $this->load->view("footer_view");
    }

    function getBanners(){
    	$result = $this->Banners_model->getBanners();
    	$this->responder($result);
    }

    function guardar(){
    	if($this->input->post("accion") == "guardar"){
    		/*nuevo evento*/
    		$nuevo = array(
    			"financiamientoInicio"=>$this->input->post("diaInicio"),
    			"financiamientoFin"=>$this->input->post("diaFinal"),
    			"platicasInicio"=>$this->input->post("inicioplaticas"),
    			"platicasFin"=>$this->input->post("finplaticas"),
                "citasInicio1"=>$this->input->post("inicioCitas1"),
                "citasInicio2"=>$this->input->post("inicioCitas2"),
                "citasFin1"=>$this->input->post("finCitas1"),
                "citasFin2"=>$this->input->post("finCitas2")
    		);
    		$result = $this->Banners_model->guardar($nuevo);
    		if($result["code"]==200){
    			$response["code"] = 200;
    		}else{
    			$response["code"] = 400;
    			$response["msg"] = $result["msg"];
    		}

            $response["data"] = $this->input->post();
    		

    	}else{
    		$modif = array(
                "financiamientoInicio"=>$this->input->post("diaInicio"),
                "financiamientoFin"=>$this->input->post("diaFinal"),
                "platicasInicio"=>$this->input->post("inicioplaticas"),
                "platicasFin"=>$this->input->post("finplaticas"),
                "citasInicio1"=>$this->input->post("inicioCitas1"),
                "citasInicio2"=>$this->input->post("inicioCitas2"),
                "citasFin1"=>$this->input->post("finCitas1"),
                "citasFin2"=>$this->input->post("finCitas2")
            );
    		$result = $this->Banners_model->actualizar($modif);
    		if($result){
    			$response["code"] = 200;
    		}else{
    			$response["code"] = 400;
    		}
    	}
    	
    	//$response["session"] = $this->session->userdata["logged_in"]["usuario"];
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