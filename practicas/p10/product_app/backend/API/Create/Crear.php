<?php
namespace BACKEND\API\Create;

use BACKEND\API\DataBase;

// Si estás utilizando Composer, preferiblemente usa la carga automática en lugar de require_once.

class Crear extends DataBase {
    private $response;

    public function __construct($database = 'marketzone') {
        $this->response = array();
        parent::__construct($database);
    }

    public function add($jsonOBJ) {
        $this->response = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );

        if (isset($jsonOBJ->nombre)) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);

            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";

                if ($this->conexion->query($sql)) {
                    $this->response['status'] = "success";
                    $this->response['message'] = "Producto agregado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                    // Aquí puedes registrar el error en un log en lugar de imprimirlo.
                }
            }

            $result->free();
            $this->conexion->close();
        }
    }
}
