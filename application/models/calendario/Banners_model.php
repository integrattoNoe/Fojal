<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banners_model extends CI_Model
{
    private $modelo;
    function __construct()
    {
        parent::__construct();
        $this->load->database();//con esto hacemos que pueda cargar nuestra base de datos con el modelo
    }

    function getBanners(){
        $datos = array();
        //$this->db->select("eventos.id as idEvento, eventos.titulo, eventos.fechaEvento, eventos.fechaPublicado, usuarios.id as idUsuario, usuarios.nombre");
        //$this->db->from("eventos");
        //$this->db->join("usuarios","eventos.autor = usuarios.id");
        $this->db->where("id",1);
        $query = $this->db->get("banners");
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $arr = array(
                    "diaInicio"=>$row->financiamientoInicio,
                    "diaFinal"=>$row->financiamientoFin,
                    "inicioplaticas"=>$row->platicasInicio,
                    "finplaticas"=>$row->platicasFin,
                    "inicioCitas1"=>$row->citasInicio1,
                    "inicioCitas2"=>$row->citasInicio2,
                    "finCitas1"=>$row->citasFin1,
                    "finCitas2"=>$row->citasFin2
                );
                array_push($datos, $arr);
            }
        }
        //$data["banners"]=$datos;
        return $datos;
    }

    function guardar($data){
        $query = $this->db->insert("banners",$data);
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

    function actualizar($data){
        $this->db->where("id",1);
        $query = $this->db->update("banners",$data);
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