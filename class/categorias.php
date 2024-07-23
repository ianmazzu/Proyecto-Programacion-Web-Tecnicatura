<?php

/*Autor: Ian*/

class Categorias {
    
    protected $id;
    public $nombre;
    private $exist;
    
    function __construct($id = null) {
        if ($id != null) {
            $db = new base_datos("mysql", "mydatabase", "127.0.0.1", "root", "");
            $resp = $db->select("categorias", "id=?", array($id));
            
            if (isset($resp[0]['id'])) {
                $this->id = $resp[0]['id'];
                $this->nombre = $resp[0]['nombre_categoria'];
                $this->exist = true;
            }
        }
    }
    
    public function mostrar() {
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }
    
    public function guardar() {
        if ($this->exist) {
            return $this->actualizar();
        } else {
            return $this->insertar();
        }
    }
    
    public function eliminar() {
        $db = new base_datos("mysql", "mydatabase", "127.0.0.1", "root", "");
        return $db->delete("categorias", "id = ?", array($this->id));
    }
    
    private function insertar() {
        $db = new base_datos("mysql", "mydatabase", "127.0.0.1", "root", "");
        $resp = $db->insert("categorias", "nombre_categoria", "?", array($this->nombre));
        
        if ($resp) {
            $this->id = $resp;
            $this->exist = true;
            return true;
        } else {
            return false;
        }
    }
    
    private function actualizar() {
        $db = new base_datos("mysql", "mydatabase", "127.0.0.1", "root", "");
        return $db->update("categorias", "nombre_categoria=?", "id=?", array($this->nombre, $this->id));
    }
    
    static public function listar() {
        $db = new base_datos("mysql", "mydatabase", "127.0.0.1", "root", "");
        return $db->select("categorias");
    }
}


?>