<?php

libxml_use_internal_errors(true);

$xml = new DOMDocument();
$documento = file_get_contents('serviciovod.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);

$xsd = 'serviciovod.xsd';

if (!$xml->schemaValidate($xsd)) {
    $errors = libxml_get_errors();
    $noError = 1;
    $lista = '';

    foreach ($errors as $error) {
        $lista .= '[' . ($noError++) . ']: ' . $error->message . ' ';
    }

    echo $lista;
} else {
    // Procesamiento y generación de HTML5
    ?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Catálogo VOD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

        <div class="container-fluid d-flex justify-content-between align-items-center mt-5">
            <div>
                <img class="rounded" src="primevideo.png" alt="Logo" width="130px" height="80px">
            </div>
            <div>
                <h1 class="text-center">Catálogo VOD</h1>
            </div>
        </div>
        <h2 class="display-6 text-center">Perfil de Usuario</h2>
        <div class="container mt-3">
            <?php
            // Obtener datos del perfil de usuario
            $perfilUsuario = $xml->getElementsByTagName('perfil')->item(0);
            $usuario = $perfilUsuario->getAttribute('usuario');
            $idioma = $perfilUsuario->getAttribute('idioma');

            // Mostrar datos del perfil de usuario
            echo '<p class="h5 text-center">';
            echo "<strong>Usuario:</strong> $usuario<br><strong>Idioma:</strong> $idioma";
            echo '</p>';
            ?>
        </div>
        <div class="container mt-3">
            <!-- Código para procesar el contenido de películas y series -->
            <?php
            // Conexión a la base de datos (ajusta los valores según tu configuración)
            $servername = "localhost";
            $username = "root";
            $password = "19Molletes*eb";
            $dbname = "prime";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Insertar datos en las tablas 'cuenta' y 'perfiles'
            $cuentas = $xml->getElementsByTagName('cuenta');
            foreach ($cuentas as $cuenta) {
                $correoCuenta = $cuenta->getAttribute('correo');

                // Insertar en la tabla 'cuenta'
                $sqlCuenta = $conn->prepare("INSERT INTO cuenta (correo, eliminado) VALUES (?, 0)");
                $sqlCuenta->bind_param("s", $correoCuenta);
                $sqlCuenta->execute();

                // Obtener el ID de la cuenta recién insertada
                $cuenta_id = $conn->insert_id;

                $perfiles = $cuenta->getElementsByTagName('perfil');
                foreach ($perfiles as $perfil) {
                    $usuarioPerfil = $perfil->getAttribute('usuario');
                    $idiomaPerfil = $perfil->getAttribute('idioma');

                    // Insertar en la tabla 'perfiles' con la clave foránea 'cuenta_id'
                    $sqlPerfil = $conn->prepare("INSERT INTO perfiles (usuario, idioma, eliminado, cuenta_id) VALUES (?, ?, 0, ?)");
                    $sqlPerfil->bind_param("ssi", $usuarioPerfil, $idiomaPerfil, $cuenta_id);
                    $sqlPerfil->execute();
                }
            }

            // Insertar datos en la tabla 'contenido'
            $contenido = $xml->getElementsByTagName('contenido');
            foreach ($contenido as $item) {
                $peliculas = $item->getElementsByTagName('peliculas');
                foreach ($peliculas as $pelicula) {
                    $region = $pelicula->getAttribute('region');

                    $generos = $pelicula->getElementsByTagName('genero');
                    foreach ($generos as $genero) {
                        $nombreGenero = $genero->getAttribute('nombre');
                        $titulos = $genero->getElementsByTagName('titulo');
                        foreach ($titulos as $titulo) {
                            $nombreTitulo = $titulo->nodeValue;
                            $duracionTitulo = $titulo->getAttribute('duracion');

                            // Insertar en la tabla 'contenido' con la clave foránea 'cuenta_id'
                            $sqlContenido = $conn->prepare("INSERT INTO contenido (tipo, region, genero, titulo, duracion, eliminado, cuenta_id) VALUES ('Pelicula', ?, ?, ?, ?, 0, ?)");
                            $sqlContenido->bind_param("ssssi", $region, $nombreGenero, $nombreTitulo, $duracionTitulo, $cuenta_id);
                            $sqlContenido->execute();
                        }
                    }
                }

                $series = $item->getElementsByTagName('series');
                foreach ($series as $serie) {
                    $region = $serie->getAttribute('region');

                    $generos = $serie->getElementsByTagName('genero');
                    foreach ($generos as $genero) {
                        $nombreGenero = $genero->getAttribute('nombre');
                        $titulos = $genero->getElementsByTagName('titulo');
                        foreach ($titulos as $titulo) {
                            $nombreTitulo = $titulo->nodeValue;
                            $duracionTitulo = $titulo->getAttribute('duracion');

                            // Insertar en la tabla 'contenido' con la clave foránea 'cuenta_id'
                            $sqlContenido = $conn->prepare("INSERT INTO contenido (tipo, region, genero, titulo, duracion, eliminado, cuenta_id) VALUES ('Serie', ?, ?, ?, ?, 0, ?)");
                            $sqlContenido->bind_param("ssssi", $region, $nombreGenero, $nombreTitulo, $duracionTitulo, $cuenta_id);
                            $sqlContenido->execute();
                        }
                    }
                }
            }

            // Mostrar tabla de películas y series
            $sqlContenido = "SELECT * FROM contenido";
            $resultContenido = $conn->query($sqlContenido);

            if ($resultContenido->num_rows > 0) {
                echo '<h3 class="text-center">Contenido de Películas y Series</h3>';
                echo '<table class="table table-bordered text-center">';
                echo '<thead class="table-dark">';
                echo '<tr>';
                echo '<th>Tipo</th>';
                echo '<th>Título</th>';
                echo '<th>Duración</th>';
                echo '<th>Género</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $resultContenido->fetch_assoc()) {
                    echo '<tr>';
                    echo "<td>{$row['tipo']}</td>";
                    echo "<td>{$row['titulo']}</td>";
                    echo "<td>{$row['duracion']}</td>";
                    echo "<td>{$row['genero']}</td>";
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p class="text-center">No se encontraron registros de películas y series en la base de datos.</p>';
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
            ?>
        </div>

        <!-- referencia Web a JQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
}
?>
