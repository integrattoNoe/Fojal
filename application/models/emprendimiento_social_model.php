<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Emprendimiento_social_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();//con esto hacemos que pueda cargar nuestra base de datos con el modelo
    }

    function guardarCursos($data){
    	$query = $this->db->insert_batch("cursos",$data);
    	return $query;
    }
    function guardarMaestros($data){
    	$query = $this->db->insert_batch("maestros",$data);
    	return $query;
    }
    function guardarPdfymas($data){
    	$query = $this->db->insert("empre_social",$data);
    	return $query;
    }
}

?>