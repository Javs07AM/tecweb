<?php
namespace BACKEND\API;
abstract class DataBase {
    protected $conexion;

    public function __construct($database) {
        $this->conexion=@mysqli_connect(
            'localhost',
            'root',
            '19Molletes*eb',
            $database
        );

        if(!$this->$conexion) {
            die('¡Base de datos NO conextada!');
        }
    }    

}

?>
