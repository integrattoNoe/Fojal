<?php
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library("session");
        $this->load->model("login_model");
    }
    function index(){
        
        $this->load->view("login_view");
    }
    function login(){
        $this->form_validation->set_rules('correo', 'Correo', 'trim|required');
        $this->form_validation->set_rules('pass', 'Contraseña', 'required');
        //$this->form_validation->set_message('required', 'El campo %s es requerido');

        if ($this->form_validation->run() === FALSE) {
            if(isset($this->session->userdata["logged_in"])){
                //$this->load->view("prueba/prueba");
                header("location: ".base_url()."dashboard");
            }else{
                $this->index();
            }
            
        } else {
            $correo = $this->input->post('correo');
            $pass = $this->input->post('pass');
            //comprobamos si existen en la base de datos enviando los datos al modelo
            $login = $this->login_model->verificar($correo, $pass);
            if ($login)
            {
                $session_data = array(
                    "usuario" => $login[0]->nombre,
                    "idUsuario"=>$login[0]->id
                );
                $this->session->set_userdata("logged_in",$session_data);
                //$this->load->view("prueba/prueba",$session_data);
                header("location: ".base_url()."dashboard");
            }else{
                $data = array("msgError" => "Usuario o contraseña incorrecto");
                $this->load->view("login_view",$data);
            }
        }
    }
}

?>