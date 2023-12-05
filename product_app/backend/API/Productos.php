<?php
namespace BACKEND\API;

use BACKEND\API\DataBase;
require_once __DIR__ . '/DataBase.php';

class Productos extends DataBase {
    private $response;

    public function __construct($database='prime') {
        $this->response = array();
        parent::__construct($database);
    }

    // Este metodo da error
    public function add($jsonOBJ) {
        // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
        $this->response = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        if(isset($jsonOBJ->nombre)) {
            // Mostrar en consola el JSON antes de realizar operaciones
            console.log('JSON enviado por el cliente:', " . json_encode($jsonOBJ) . ");
    
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "SELECT * FROM contenido WHERE tipo = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
    
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO contenido VALUES (null, 
                '{$jsonOBJ->region}', 
                '{$jsonOBJ->genero}', 
                {$jsonOBJ->titulo}, 
                '{$jsonOBJ->duracion}',
                 0,
                 '{$jsonOBJ->cuenta_id}'
                 )";
                
    
                if($this->conexion->query($sql)){
                    $this->response['status'] =  "success";
                    $this->response['message'] =  "Producto agregado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                }
            }
    
            $result->free();
            // Cierra la conexión
            $this->conexion->close();
        }
    }
    

    public function delete($id) {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->response = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "UPDATE contenido SET eliminado=1 WHERE id = {$id}";
            if ( $this->conexion->query($sql) ) {
                $this->response['status'] =  "success";
                $this->response['message'] =  "Producto eliminado";
            } else {
                $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    // Este metodo da error
    public function edit($jsonOBJ) {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->response = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($jsonOBJ->id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql =  "UPDATE contenido SET 
            tipo='{$jsonOBJ->tipo}', 
            region='{$jsonOBJ->region}',";

            $sql .= 
            "genero='{$jsonOBJ->genero}', 
            titulo={$jsonOBJ->titulo}, 
            duracion='{$jsonOBJ->duracion}',";

            $this->conexion->set_charset("utf8");
            if ( $this->conexion->query($sql) ) {
                $this->response['status'] =  "success";
                $this->response['message'] =  "Producto actualizado";
            } else {
                $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function list() {
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $this->conexion->query("SELECT * FROM contenido WHERE eliminado = 0") ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function search($search) {
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($search) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS

             // Buscar contenido por id, tipo, region, genero o título.

            $sql = "SELECT * FROM contenido WHERE (id = '{$search}' OR tipo LIKE '%{$search}%' OR region LIKE '%{$search}%' OR genero LIKE '%{$search}%' OR titulo LIKE '%{$search}')
            AND eliminado = 0";
            if ( $result = $this->conexion->query($sql) ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->response[$num][$key] = utf8_encode($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function single($id) {
        if( isset($id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM contenido WHERE id = {$id}") ) {
                // SE OBTIENEN LOS RESULTADOS
                $row = $result->fetch_assoc();
    
                if(!is_null($row)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($row as $key => $value) {
                        $this->response[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function getResponse() {
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}

//$productos = new Productos();
?>