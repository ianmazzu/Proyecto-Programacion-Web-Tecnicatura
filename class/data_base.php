<?php
/* Autor: Mazzucco Ian */

try {
    // Establecer conexión PDO a la base de datos
    $conector = new PDO("mysql:dbname=mydatabase;host=127.0.0.1", "root", "");
    echo "Conexión exitosa";
} catch (PDOException $ex) {
    echo "Fallo de conexión: " . $ex->getMessage();
}

// Clase base_datos para manejar operaciones de base de datos
class base_datos {
    	private $gbd; // Objeto de conexión PDO

    // Constructor para inicializar la conexión
    function __construct($driver, $base_datos, $host, $user, $pass) {
        try {
            // Crear la cadena de conexión
            $conection = $driver . ":dbname=" . $base_datos . ";host=" . $host;
            
            // Inicializar la conexión PDO
            $this->gbd = new PDO($conection, $user, $pass);
            $this->gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activar el manejo de errores excepcionales
            
            // Verificar la conexión
            if (!$this->gbd) {
                throw new Exception("No se ha podido realizar la conexión");
            }
        } catch (PDOException $ex) {
            echo "Fallo de conexión: " . $ex->getMessage();
        }
    }

    // Método para realizar consultas SELECT
    function select($tabla, $filtros = null, $arr_prepare = null, $orden = null, $limit = null) {
        try {
            $sql = "SELECT * FROM " . $tabla;
            
            if ($filtros != null) {
                $sql .= " WHERE " . $filtros;
            }
            if ($orden != null) {
                $sql .= " ORDER BY " . $orden;
            }
            if ($limit != null) {
                $sql .= " LIMIT " . $limit;
            }
            
            $resource = $this->gbd->prepare($sql);
            $resource->execute($arr_prepare);
            
            if ($resource) {
                return $resource->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("No se pudo realizar la consulta de selección");
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    // Método para realizar consultas DELETE
    function delete($tabla, $filtros = null, $arr_prepare = null) {
        try {
            $sql = "DELETE FROM " . $tabla . " WHERE " . $filtros;
            $resource = $this->gbd->prepare($sql);
            $resource->execute($arr_prepare);
            
            if ($resource) {
                return true;
            } else {
                throw new Exception("No se pudo realizar la consulta de eliminación");
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    // Método para realizar consultas INSERT
    function insert($tabla, $campos, $valores, $arr_prepare = null) {
        try {
            $sql = "INSERT INTO " . $tabla . " (" . $campos . ") VALUES (" . $valores . ")";
            $resource = $this->gbd->prepare($sql);
            $resource->execute($arr_prepare);
            
            if ($resource) {
                return $this->gbd->lastInsertId();
            } else {
                throw new Exception("No se pudo realizar la consulta de inserción");
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    // Método para realizar consultas UPDATE
    function update($tabla, $campos, $filtros, $arr_prepare = null) {
        try {
            $sql = "UPDATE " . $tabla . " SET " . $campos . " WHERE " . $filtros;
            $resource = $this->gbd->prepare($sql);
            $resource->execute($arr_prepare);
            
            if ($resource) {
                return true;
            } else {
                throw new Exception("No se pudo realizar la consulta de actualización");
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
}
?>