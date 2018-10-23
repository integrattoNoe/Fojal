<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class PlaticasInformativas_model extends CI_Model
{
    private $modelo;
    function __construct()
    {
        parent::__construct();
        $this->load->database();//con esto hacemos que pueda cargar nuestra base de datos con el modelo
        $this->modelo = 4;//4 para alto impacto
    }
    function getDatos(){
        $datos = array();
        $this->db->where("id",1);
        $query = $this->db->get("platicas");
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arr = array(
                    "id"=>$row->id,
                    "ayuda"=>$row->ayuda,
                    "infoGeneral"=>$row->informacion,
                    "asistencia"=>$row->asistencia,
                    "horario"=>$row->horario,
                    "foto"=>$row->foto
                );
                array_push($datos, $arr);
            }
        }
        $data["platicas"]=$datos;
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
    function guardar($data){
        $query = $this->db->insert("platicas",$data);
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
    function actualizar($data){
        $this->db->where("id",1);
        $query = $this->db->update("platicas",$data);
        return $query;
    }
}

?>