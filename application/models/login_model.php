<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
    public function construct()
    {
        parent::__construct();
        $this->load->database();//con esto hacemos que pueda cargar nuestra base de datos con el modelo
    }
    function verificar($correo, $pass)
    {
        //$condicion = "correo = '".$correo."' AND pass = '".$pass."'";
        $this->db->where('correo', $correo);
        $this->db->where('pass', $pass);
        $query = $this->db->get('usuarios');
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}