<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Emprendimiento_Institucional_model extends CI_Model
{
    private $modelo;
    function __construct()
    {
        parent::__construct();
        $this->load->database();//con esto hacemos que pueda cargar nuestra base de datos con el modelo
        $this->modelo = 3;//3 para institucinoal
    }
    function getDatos(){
        $cursos = array();
        $maestros = array();
        $empre = array();
        $this->db->where("modelo",$this->modelo);
        $query = $this->db->get("cursos");
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arr = array("id"=>$row->idTema,"curso"=>$row->nombre);
                array_push($cursos, $arr);
            }
        }
        $this->db->where("modelo",$this->modelo);
        $query = $this->db->get("maestros");
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arr = array(
                    "id"=>$row->idMaestro,
                    "nombre"=>$row->nombre,
                    "licenciatura"=>$row->licenciatura,
                    "imagen"=>$row->imagen
                );
                array_push($maestros, $arr);
            }
        }
        $this->db->where("modelo",$this->modelo);
        $query = $this->db->get("datos_modelos");
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
        $query = $this->db->insert("datos_modelos",$data);
        return $query;
    }
    function actualizarCursos($data){
        $this->db->where("modelo",$this->modelo);
        $query = $this->db->update_batch("cursos",$data,"idTema");
        return $query;
    }
    function actualizarMaestros($data){
        $this->db->where("modelo",$this->modelo);
        $query = $this->db->update_batch("maestros",$data,"idMaestro");
        return $query;
    }
    function actualizarPdfymas($data){
        $this->db->where("modelo",$this->modelo);
        $query = $this->db->update("datos_modelos",$data);
        return $query;
    }
}

?>