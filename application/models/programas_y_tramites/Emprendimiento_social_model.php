<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Emprendimiento_social_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();//con esto hacemos que pueda cargar nuestra base de datos con el modelo
    }
    function getDatos(){
        $cursos = array();
        $maestros = array();
        $empre = array();
        $query = $this->db->get("cursos");
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arr = array("id"=>$row->id,"curso"=>$row->nombre);
                array_push($cursos, $arr);
            }
        }
        $query = $this->db->get("maestros");
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arr = array(
                    "id"=>$row->id,
                    "nombre"=>$row->nombre,
                    "licenciatura"=>$row->licenciatura,
                    "imagen"=>$row->imagen
                );
                array_push($maestros, $arr);
            }
        }
        $query = $this->db->get("empre_social");
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arr = array(
                    "id"=>$row->id,
                    "pdf"=>$row->pdf,
                    "correo"=>$row->correo,
                    "fechaInicio"=>$row->fecha_inicio_curso,
                    "fechaEntrega"=>$row->fecha_entrega
                );
                array_push($empre, $arr);
            }
        }
        $data["cursos"]=$cursos;
        $data["maestros"]=$maestros;
        $data["empre"]=$empre;
        return $data;
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
    function actualizarCursos($data){
        $query = $this->db->update_batch("cursos",$data,"id");
        return $query;
    }
    function actualizarMaestros($data){
        $query = $this->db->update_batch("maestros",$data,"id");
        return $query;
    }
    function actualizarPdfymas($data){
        $this->db->where("id",1);
        $query = $this->db->update("empre_social",$data);
        return $query;
    }
}

?>