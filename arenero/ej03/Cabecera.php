<?php
/*
    Ejemplo para comprobar uso de constructor

    Ejemplo para comprobar uso de namespace

*/
namespace EJEMPLOS\POO;

class Cabecera {
    private $titulo;
    private $ubicacion;

    public function __construct($title, $location) {
        $this->titulo = $title;  // No se usan [] para asignar valores
        $this->ubicacion = $location;  // No se usan [] para asignar valores
    }

    public function graficar() {
        $estilo = 'font-size: 40px; text-align: ' . $this->ubicacion;  // Se cambian las comas a punto y coma
        echo '<div style="' . $estilo . '">';
        echo '<h4>' . $this->titulo . '</h4>';  // Se cierran las etiquetas h4 correctamente
        echo '</div>';
    }
}

class Cabecera2 {
    private $titulo;
    private $ubicacion;
    private $enlace;

    public function __construct($title, $location, $link) {
        $this->titulo = $title;  
        $this->ubicacion = $location;  
        $this->enlace = $link;  
    }

    public function graficar() {
        $estilo = 'font-size: 40px; text-align: ' . $this->ubicacion; 
        echo '<div style="' . $estilo . '">';
        echo '<h4>';
        echo '<a href="'. $this->enlace . '">'. $this->titulo . '</a>';  
        echo '</h4>';
        echo '</div>';
    }
}
?>
