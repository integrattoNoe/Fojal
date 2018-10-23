<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlaticasInformativas extends CI_Controller {
    private $i;
    private $dataMaestros;
    private $flag;
    private $algoSeActualizo;
    private $modelo;

    function __construct(){
        parent::__construct();
        $this->load->library('upload');
        $this->load->model("platicas_informativas/PlaticasInformativas_model");
    }
    function index(){
    	$data["activa"] = "platicas";
        //$datos["data"] = $this->PlaticasInformativas_model->getDatos();
        $this->load->view("header_view",$data);
        $this->load->view("platicas_informativas/PlaticasInformativas_view");
        $this->load->view("footer_view");
        //$this->cargarDatos();
        
    }
    function cargarDatos(){
        $datos = $this->PlaticasInformativas_model->getDatos();
        $this->responder($datos);
    }

    function validarForm(){
        $faltantes = array();
        if($this->input->post("accion") == "guardar"){
            if (empty($_FILES['fotoGeneral']['name'])){
                $this->form_validation->set_rules('fotoGeneral', 'General', 'required');
            }
        }
        $this->form_validation->set_rules('horario', 'Horario', 'required');
        $this->form_validation->set_rules('asistencia', 'Asistencia', 'required');
        $this->form_validation->set_rules('infoGeneral', 'General', 'required');
        $this->form_validation->set_rules('ayuda', 'Ayuda', 'required');

        if ($this->form_validation->run() === FALSE) {
            
            if($this->input->post("accion") == "guardar"){
                if(form_error("fotoGeneral"))
                    array_push($faltantes, 'fotoGeneral');
            }
            if(form_error("horario"))
                array_push($faltantes, 'horario');
            if(form_error("confirma"))
                array_push($faltantes, 'confirma');
            if(form_error("infoGeneral"))
                array_push($faltantes, 'infoGeneral');
            if(form_error("ayudaFojal"))
                array_push($faltantes, 'ayuda');
            $response["code"]=400;
            $response["msg"] = "Revisar todos los campos";
            $response["faltantes"] = $faltantes;
            $this->responder($response);
        }else{
            $this->guardar();
            /*if($this->input->post("accion") == "guardar"){
                $this->guardarCursos();
            }else if($this->input->post("accion") == "actualizar"){
                $this->actualizarCursos();
            }*/
            
        }
            
        
    }

    function guardarCursos(){
        $data = array();
        for($i = 0; $i < 20; $i++){
            if($this->input->post("accion") == "actualizar"){
                $arr = array(
                    "idTema" => ($i+1),
                    "nombre" => $this->input->post('tema'.($i+1)),
                    "modelo" => $this->modelo
                );
            }else{
                $arr = array(
                    "nombre" => $this->input->post('tema'.($i+1)),
                    "modelo" => $this->modelo,
                    "idTema" => ($i+1)
                );
            }
            
            array_push($data, $arr);
        }
        if(count($data) > 0){
            if($this->input->post("accion") == "guardar"){
                $resp = $this->PlaticasInformativas_model->guardarCursos($data);
            }else if($this->input->post("accion") == "actualizar"){
                $resp = $this->PlaticasInformativas_model->actualizarCursos($data);
            }
            $response["query"] = $resp;
            if($resp || $this->input->post("accion") == "actualizar"){
                $this->algoSeActualizo = $resp;
                $response["cursos"]["code"]=200;
                $this->guardarMaestros($response);
            }else{
                $response["cursos"]["code"]=500;
                $response["count"] = count($data);
            }
        }
        //$this->responder($response);
    }

    
    function guardarMaestros($response){
        /*$data = array();
        $flag = TRUE;*/
        $arRes = array();
        
        for($this->i = 0; $this->i<3; $this->i++){
        //if($this->i<3){
            if($this->input->post("accion") == "guardar" || !empty($_FILES['imgMaestro'.($this->i+1)]['name'])){
                $uuid = md5(uniqid(rand(), true));
                //if(!empty($_FILES['files']['name'][$i])){
                  // Define new $_FILES array - $_FILES['file']
                $_FILES['file']['name'] = $_FILES['imgMaestro'.($this->i+1)]['name'];
                $_FILES['file']['type'] = $_FILES['imgMaestro'.($this->i+1)]['type'];
                $_FILES['file']['tmp_name'] = $_FILES['imgMaestro'.($this->i+1)]['tmp_name'];
                $_FILES['file']['error'] = $_FILES['imgMaestro'.($this->i+1)]['error'];
                $_FILES['file']['size'] = $_FILES['imgMaestro'.($this->i+1)]['size'];

                  // Set preference
                $config['upload_path'] = 'uploads/img/'; 
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000'; // max_size in kb
                $config['file_name'] = $uuid;
                $arr1["maestro"] = 'imgMaestro'.($this->i+1);
                $arr1["UID"] = $uuid;

                //Load upload library
                  
                $this->upload->initialize($config);
                
                // File upload
                if($this->upload->do_upload('file')){

                // Get data about the file
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    // Initialize array
                    $response['cagada'][] = $uploadData;
                    $arr1["filename"]=$filename;
                    if($this->input->post("accion") == "actualizar"){
                        $arr = array(
                            "nombre"=>$this->input->post('nombre_maestro'.($this->i+1)),
                            "licenciatura"=>$this->input->post('licenciatura_maestro'.($this->i+1)),
                            "imagen"=>$uuid.$uploadData["file_ext"],
                            "modelo" => $this->modelo,
                            "idMaestro" => ($this->i+1)
                        );
                    }else{
                        $arr = array(
                            "nombre"=>$this->input->post('nombre_maestro'.($this->i+1)),
                            "licenciatura"=>$this->input->post('licenciatura_maestro'.($this->i+1)),
                            "imagen"=>$uuid.$uploadData["file_ext"],
                            "modelo" => $this->modelo,
                            "idMaestro" => ($this->i+1)
                        );
                    }
                    
                    $response["uuid"][$this->i]=$filename;
                    array_push($this->dataMaestros, $arr);
                }else{
                    $response["maestros"]['code']=500;
                    $response["maestros"]['error'] = $this->upload->display_errors();
                    $flag = FALSE;
                }
                //}
                array_push($arRes, $arr1);

                //$this->i++;
                //$this->guardarMaestros($response);
            }else if($this->input->post("accion") == "actualizar"){
                $arr = array(
                    "nombre"=>$this->input->post('nombre_maestro'.($this->i+1)),
                    "licenciatura"=>$this->input->post('licenciatura_maestro'.($this->i+1)),
                    "modelo" => $this->modelo,
                    "idMaestro" => ($this->i+1)
                );
                array_push($this->dataMaestros, $arr);
            }
            
        }
        if($this->flag){
            if($this->input->post("accion") == "guardar"){
                $resp = $this->PlaticasInformativas_model->guardarMaestros($this->dataMaestros);
            }else if($this->input->post("accion") == "actualizar"){
                if(count($this->dataMaestros) > 0){
                    $resp = $this->PlaticasInformativas_model->actualizarMaestros($this->dataMaestros);
                }
            }
            
            if($resp || $this->input->post("accion") == "actualizar"){
                $this->algoSeActualizo = $resp;
                $response["maestros"]["code"] = 200;
                $this->guardarPdfCorreoYfechas();
            }
        }else{
            $response["expl"] = $arRes;
            $this->responder($response);
        }
        
    }
    function guardar(){
        $config['upload_path'] = 'uploads/img/'; 
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '5000';
        $uuid = md5(uniqid(rand(), true));
        $config['file_name'] = $uuid;
        $this->upload->initialize($config);
        $response["pdfYmas"] = "vamos a guardar pdf y mas";
        if($this->input->post("accion") == "guardar" || !empty($_FILES['fotoGeneral']['name'])){
            // File upload
            if($this->upload->do_upload('fotoGeneral')){
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];
                $data = array(
                    "ayuda"=>$this->input->post('ayuda'),
                    "informacion"=>$this->input->post('infoGeneral'),
                    "asistencia"=>$this->input->post('asistencia'),
                    "horario"=>$this->input->post('horario'),
                    "foto"=>$uuid.$uploadData["file_ext"]
                );
                if($this->input->post("accion") == "guardar"){
                    $resp = $this->PlaticasInformativas_model->guardar($data);
                }else{
                    $resp = $this->PlaticasInformativas_model->actualizar($data);
                }
                
                if($resp){
                    $this->algoSeActualizo = $resp;
                    $response["code"]=200;
                }else{
                    $response["code"]=500;
                    $response["error"]="Error en el server";
                }
            }else{
                $response["extras"]['code']=500;
                $response["extras"]['error'] = $this->upload->display_errors();
            }
        }else{
            $data = array(
                "ayuda"=>$this->input->post('ayuda'),
                "informacion"=>$this->input->post('infoGeneral'),
                "asistencia"=>$this->input->post('asistencia'),
                "horario"=>$this->input->post('horario')
            );
            $resp = $this->PlaticasInformativas_model->actualizar($data);
            if($resp || $this->input->post("accion") == "actualizar"){
                $response["code"]=200;
                $this->algoSeActualizo = $resp;
            }else{
                $response["code"]=500;
                $response["error"]="Error en el server";
            }
        }
        $response["actualizado"] = $this->algoSeActualizo;
        $this->responder($response);
    }

    function responder($respuesta){
        header('Content-type: application/json');
        echo json_encode($respuesta);
    }
    
}
?>