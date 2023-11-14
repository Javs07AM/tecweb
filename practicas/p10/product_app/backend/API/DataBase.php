<?php
namespace BACKEND\API;

abstract class DataBase {
    protected $conexion;
    protected $response;

    public function __construct($database) {
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            '19Molletes*eb',
            $database
        );
    
        /**
         * NOTA: si la conexión falló $conexion contendrá false
         **/
        if(!$this->conexion) {
            die('¡Base de datos NO conextada!');
        }
        /*else {
            echo 'Base de datos encontrada';
        }*/
    }

    public function getResponse() {
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>