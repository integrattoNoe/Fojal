<?
defined('BASEPATH') OR exit('No direct script access allowed');

class emprendimientoSocial extends CI_Controller {
    private $i;
    private $dataMaestros;
    private $flag;

    function __construct(){
        parent::__construct();
        $this->load->library('upload');
        $this->load->model("emprendimiento_social_model");
        $this->i = 0;
        $this->dataMaestros = array();
        $this->flag = TRUE;
    }
    function index(){
    	$data["activa"] = "empre_social";
        $this->load->view("header_view",$data);
        $this->load->view("dashboard/emprendimientoSocial_view");
        $this->load->view("footer_view");
        
    }

    function validarForm(){
        $faltantes = array();
    	for($i = 0; $i<20; $i++){
    		$this->form_validation->set_rules('tema'.($i+1), 'Tema '.($i+1), 'required');
            $this->form_validation->set_message('required', 'tema'.($i+1));
    	}
        for($i = 0; $i < 3; $i++){
            if (empty($_FILES['imgMaestro'.($i+1)]['name'])){
                $this->form_validation->set_rules('imgMaestro'.($i+1), 'Imagen del maestro '.($i+1), 'required');
            }  
            $this->form_validation->set_rules('nombre_maestro'.($i+1), 'Nombre del maestro '.($i+1), 'required');
            $this->form_validation->set_rules('licenciatura_maestro'.($i+1), 'Licenciatura del maestro '.($i+1), 'required');
        }
        if (empty($_FILES['pdf']['name']) || $_FILES['pdf']['type'] != "application/pdf"){
            $this->form_validation->set_rules('pdf', 'PDF', 'required');
        } 
        $this->form_validation->set_rules('correo', 'Correo', 'required');
        $this->form_validation->set_rules('fechaInicio', 'Fecha', 'required');
        $this->form_validation->set_rules('fechaEntrega', 'Fecha', 'required');

    	if ($this->form_validation->run() === FALSE) {
            for($i = 0; $i<20; $i++){
                if(form_error('tema'.($i+1))){
                    array_push($faltantes, 'tema'.($i+1));
                }
            }
            for($i = 0; $i < 3; $i++){
                if(form_error('imgMaestro'.($i+1))){
                    array_push($faltantes, 'imgMaestro'.($i+1));
                }
                if(form_error('nombre_maestro'.($i+1))){
                    array_push($faltantes, 'nombre_maestro'.($i+1));
                }
                if(form_error('licenciatura_maestro'.($i+1))){
                    array_push($faltantes, 'licenciatura_maestro'.($i+1));
                }
            }
            if(form_error("pdf"))
                array_push($faltantes, 'pdf');
            if(form_error("correo"))
                array_push($faltantes, 'correo');
            if(form_error("fechaInicio"))
                array_push($faltantes, 'fechaInicio');
            if(form_error("fechaEntrega"))
                array_push($faltantes, 'fechaEntrega');
            $response["code"]=400;
            $response["msg"] = "Revisar todos los campos";
            $response["faltantes"] = $faltantes;
            $response["pdf"] = $_FILES['pdf']['type'];
            $this->responder($response);
        }else{
            $this->guardarCursos();
        }
    }

    function guardarCursos(){
        $data = array();
        for($i = 0; $i < 20; $i++){
            $arr = array(
                "nombre" => $this->input->post('tema'.($i+1))
            );
            array_push($data, $arr);
        }
        if(count($data) > 0){
            $resp = $this->emprendimiento_social_model->guardarCursos($data);
            if($resp){
                $response["cursos"]["code"]=200;
                $this->guardarMaestros($response);
            }else{
                $response["cursos"]["code"]=500;
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
            $uuid = md5(uniqid(rand(), true));
            //if(!empty($_FILES['files']['name'][$i])){
              // Define new $_FILES array - $_FILES['file']
              $_FILES['file']['name'] = $_FILES['imgMaestro'.($this->i+1)]['name'];
              $_FILES['file']['type'] = $_FILES['imgMaestro'.($this->i+1)]['type'];
              $_FILES['file']['tmp_name'] = $_FILES['imgMaestro'.($this->i+1)]['tmp_name'];
              $_FILES['file']['error'] = $_FILES['imgMaestro'.($this->i+1)]['error'];
              $_FILES['file']['size'] = $_FILES['imgMaestro'.($this->i+1)]['size'];

              // Set preference
              $config['upload_path'] = 'application/uploads/img/'; 
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
                $arr = array(
                    "nombre"=>$this->input->post('nombre_maestro'.($this->i+1)),
                    "licenciatura"=>$this->input->post('licenciatura_maestro'.($this->i+1)),
                    "imagen"=>$uuid.$uploadData["file_ext"]
                );
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
        }
        if($this->flag){
            $resp = $this->emprendimiento_social_model->guardarMaestros($this->dataMaestros);
            if($resp){
                //$response["maestros"]["code"] = 200;
                $this->guardarPdfCorreoYfechas();
            }
        }
        $response["expl"] = $arRes;
        //$this->responder($response);
    }
    function guardarPdfCorreoYfechas(){
        $config['upload_path'] = 'application/uploads/pdf/'; 
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '5000';
        $this->upload->initialize($config);
        
        // File upload
        if($this->upload->do_upload('pdf')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $data = array(
                "pdf"=>$filename,
                "correo"=>$this->input->post('correo'),
                "fecha_inicio_curso"=>$this->input->post('fechaInicio'),
                "fecha_entrega"=>$this->input->post('fechaEntrega')
            );
            $resp = $this->emprendimiento_social_model->guardarPdfymas($data);
            if($resp){
                $response["code"]=200;
            }else{
                $response["code"]=500;
                $response["error"]="Error en el server";
            }
        }else{
            $response["extras"]['code']=500;
            $response["extras"]['error'] = $this->upload->display_errors();
        }
        $this->responder($response);
    }
    function responder($respuesta){
        header('Content-type: application/json');
        echo json_encode($respuesta);
    }
    
}
?>