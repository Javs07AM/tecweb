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

    public function add($jsonOBJ) {
        $this->response = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese título'
        );
        if(isset($jsonOBJ->titulo) && isset($jsonOBJ->cuenta_id)) {
            $sql = "SELECT * FROM contenido WHERE titulo = '{$jsonOBJ->titulo}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO contenido VALUES (null, 
                '{$jsonOBJ->region}', 
                '{$jsonOBJ->genero}', 
                '{$jsonOBJ->titulo}', 
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
            $this->conexion->close();
        }
    }

    public function edit($jsonOBJ) {
        $this->response = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        if( isset($jsonOBJ->id) ) {
            $sql =  "UPDATE contenido SET 
            region='{$jsonOBJ->region}',
            genero='{$jsonOBJ->genero}', 
            titulo='{$jsonOBJ->titulo}', 
            duracion='{$jsonOBJ->duracion}'
            WHERE id = {$jsonOBJ->id}";
            if ( $this->conexion->query($sql) ) {
                $this->response['status'] =  "success";
                $this->response['message'] =  "Producto actualizado";
            } else {
                $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function delete($id) {
        $this->response = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        if( isset($id) ) {
            $sql = "UPDATE contenido SET eliminado=1 WHERE id = {$id}";
            if ( $this->conexion->query($sql) ) {
                $this->response['status'] =  "success";
                $this->response['message'] =  "Producto eliminado";
            } else {
                $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function list() {
        if ( $result = $this->conexion->query("SELECT * FROM contenido WHERE eliminado = 0") ) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
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
        if( isset($search) ) {
            $sql = "SELECT * FROM contenido WHERE (id = '{$search}' OR titulo LIKE '%{$search}%' OR region LIKE '%{$search}%' OR genero LIKE '%{$search}%' OR titulo LIKE '%{$search}')
            AND eliminado = 0";
            if ( $result = $this->conexion->query($sql) ) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
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
            if ( $result = $this->conexion->query("SELECT * FROM contenido WHERE id = {$id}") ) {
                $row = $result->fetch_assoc();

                if(!is_null($row)) {
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
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>
