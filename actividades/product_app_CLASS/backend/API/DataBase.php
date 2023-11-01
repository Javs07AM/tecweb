<?php

abstract class Database {
    protected $conexion;

    public function __construct($databaseName) {
        // Datos de conexión a la base de datos
        $host = 'localhost'; // Cambia esto por el nombre de tu host
        $username = 'root'; // Cambia esto por tu nombre de usuario
        $password = '19Molletes*eb'; // Cambia esto por tu contraseña

        try {
            $this->conexion = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

}

?>
