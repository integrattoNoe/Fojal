<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Eventos_model extends CI_Model
{
    private $modelo;
    function __construct()
    {
        parent::__construct();
        $this->load->database();//con esto hacemos que pueda cargar nuestra base de datos con el modelo
    }

    function getEventos(){
        $datos = array();
        $this->db->select("eventos.id as idEvento, eventos.titulo, eventos.fechaEvento, eventos.fechaPublicado, usuarios.id as idUsuario, usuarios.nombre");
        $this->db->from("eventos");
        $this->db->join("usuarios","eventos.autor = usuarios.id");
        $query = $this->db->get();
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                array_push($datos, $row);
            }
        }
        $data["eventos"]=$datos;
        $data["hoy"] = date("Y-m-d");
        return $data;
    }

    function guardar($data){
        $query = $this->db->insert("eventos",$data);
        if($query){
            $response["code"]=200;
            $response["query"]=$query;
            return $response;
        }else{
            $error = $this->db->error();
            // If an error occurred, $error will now have 'code' and 'message' keys...
            if (isset($error['message'])) {
                $response["code"]=500;
                $response["msg"]=$error['message'];
                return $response;
            }
        }
        return false;
    }

    function actualizar($data,$id){
        $this->db->where("id",$id);
        $query = $this->db->update("eventos",$data);
        if($query){
            return $query;
        }else{
            if($this->db->error()){
                return $this->db->error();
            }
        }
        return false;
    }

    function eliminar($id){
        $this->db->where("id",$id);
        $query = $this->db->delete("eventos");
        if($query)
            return $query;
        return false;
    }
}

?>