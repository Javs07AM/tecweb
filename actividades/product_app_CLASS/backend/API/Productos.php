<?php
namespace BACKEND\API;

use BACKEND\API\DataBase;

require_once __DIR__ . '/DataBase.php';

class Productos extends DataBase {
    private $response;

    public function __construct($database = 'marketzone') {
        $this->response = array();
        parent::__construct($database);
    }

    public function add($nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        // Validaciones
        if (empty($nombre) || strlen($nombre) > 100) {
            $this->response['message'] = 'El nombre debe ser requerido y tener 100 caracteres o menos.';
        } elseif (empty($marca)) {
            $this->response['message'] = 'La marca debe ser requerida.';
        } elseif (empty($modelo)) {
            $this->response['message'] = 'El modelo debe ser requerido y tener 25 caracteres o menos.';
        } elseif (!is_numeric($precio) || $precio <= 99.99) {
            $this->response['message'] = 'El precio debe ser requerido y debe ser mayor a 99.99.';
        } elseif (strlen($detalles) > 250) {
            $this->response['message'] = 'Los detalles deben tener 250 caracteres o menos.';
        } elseif (!is_numeric($unidades) || $unidades < 0) {
            $this->response['message'] = 'Las unidades deben ser requeridas y el número registrado debe ser mayor o igual a 0.';
        } else {
            // Verificar si ya existe un producto con el mismo nombre
            $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
            $result = $this->conexion->query($sql);

            if ($result->rowCount() == 0) {
                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";

                if ($this->conexion->query($sql)) {
                    $this->response['status'] = 'success';
                    $this->response['message'] = 'Producto agregado';
                } else {
                    $this->response['message'] = "ERROR: No se ejecutó la consulta SQL. " . $this->conexion->error;
                }
            }
        }
        $result->closeCursor();
        $this->conexion->close();
    }

    public function delete($id) {
        if (isset($id)) {
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";

            if ($this->conexion->query($sql)) {
                $this->response['status'] = 'success';
                $this->response['message'] = 'Producto eliminado';
            } else {
                $this->response['message'] = "ERROR: No se ejecutó la consulta SQL. " . $this->conexion->error;
            }
            $this->conexion->close();
        }
    }

    public function edit($id, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        if (isset($id, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen)) {
            $sql = "UPDATE productos SET nombre = '$nombre', marca = '$marca', modelo = '$modelo', precio = $precio, detalles = '$detalles', unidades = $unidades, imagen = '$imagen' WHERE id = $id";

            $this->conexion->set_charset("utf8");

            if ($this->conexion->query($sql)) {
                $this->response['status'] = 'success';
                $this->response['message'] = 'Producto actualizado';
            } else {
                $this->response['message'] = 'ERROR: No se ejecutó la consulta SQL. ' . $this->conexion->error;
            }
            $this->conexion->close();
        }
    }

    public function list() {
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);

            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->closeCursor();
        } else {
            $this->response['message'] = 'Query Error: ' . $this->conexion->error;
        }
        $this->conexion->close();
    }

    public function single($id) {
        if (isset($id)) {
            $sql = "SELECT * FROM productos WHERE id = $id";
            $result = $this->conexion->query($sql);

            if ($result) {
                if ($result->rowCount() > 0) {
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $this->response = $row;
                }
                $result->closeCursor();
            } else {
                $this->response['error'] = 'Error en la consulta: ' . $this->conexion->error;
            }
        }
    }

    public function search($search) {
        if (isset($search)) {
            $sql = "SELECT * FROM productos WHERE (id = '$search' OR nombre LIKE '%$search%' OR marca LIKE '%$search%' OR detalles LIKE '%$search%') AND eliminado = 0";
            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);

                if (!is_null($rows)) {
                    foreach ($rows as $num => $row) {
                        foreach ($row as $key => $value) {
                            $this->response[$num][$key] = utf8_encode($value);
                        }
                    }
                }
            } else {
                $this->response['message'] = 'Query Error: ' . $this->conexion->error;
            }
            $this->conexion->close();
        }
    }

    public function searchname($nombre) {
        if (isset($nombre)) {
            $nombre = $this->conexion->quote($nombre);
            $sql = "SELECT * FROM productos WHERE nombre = $nombre AND eliminado = 0";

            if ($result = $this->conexion->query($sql)) {
                if ($result->rowCount() > 0) {
                    $this->response['status'] = 'error';
                    $this->response['message'] = 'El nombre de producto ya existe en la base de datos';
                }
                $result->closeCursor();
            } else {
                $this->response['message'] = 'ERROR: No se ejecutó la consulta SQL. ' . $this->conexion->error;
            }
        }
        $this->conexion->close();
    }

    public function getResponse() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}
?>
