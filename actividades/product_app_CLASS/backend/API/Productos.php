<?php

class Productos extends Database {
    private $response = [];

    public function __construct($databaseName = 'marketzone') {
        parent::__construct($databaseName);
    }

    public function getResponse() {
        // Convierte el array de respuesta a formato JSON
        return json_encode($this->response);
    }

    public function obtenerProductos() {
        // Ejemplo de consulta para obtener productos
        $sql = "SELECT * FROM productos";
        $query = $this->conexion->query($sql);
        $this->response = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agrega otros métodos para interactuar con la base de datos y almacenar la respuesta en $response
}

?>
