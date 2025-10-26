<?php
interface FormatoSalida {
    public function mostrar($mensaje);
}

class SalidaConsola implements FormatoSalida {
    public function mostrar($mensaje) {
        echo "CONSOLA: " . $mensaje . "\n";
    }
}

class SalidaJSON implements FormatoSalida {
    public function mostrar($mensaje) {
        $datos = [
            'mensaje' => $mensaje,
            'timestamp' => date('Y-m-d H:i:s'),
            'formato' => 'JSON'
        ];
        echo json_encode($datos, JSON_PRETTY_PRINT) . "\n";
    }
}

class SalidaTXT implements FormatoSalida {
    public function mostrar($mensaje) {
        $contenido = "[" . date('Y-m-d H:i:s') . "] " . $mensaje . "\n";
        echo $contenido;
    }
}

class SistemaMensajes {
    private $estrategia;
    
    public function __construct(FormatoSalida $estrategia) {
        $this->estrategia = $estrategia;
    }
    
    public function setEstrategia(FormatoSalida $estrategia) {
        $this->estrategia = $estrategia;
    }
    
    public function mostrarMensaje($mensaje) {
        $this->estrategia->mostrar($mensaje);
    }
}


echo "\n=== EJERCICIO 4: PATRÓN STRATEGY ===\n";

$sistema = new SistemaMensajes(new SalidaConsola());
echo "Usando salida por consola:\n";
$sistema->mostrarMensaje("Este es un mensaje de prueba");

echo "\nCambiando a salida JSON:\n";
$sistema->setEstrategia(new SalidaJSON());
$sistema->mostrarMensaje("Este es un mensaje de prueba");

echo "\nCambiando a salida TXT:\n";
$sistema->setEstrategia(new SalidaTXT());
$sistema->mostrarMensaje("Este es un mensaje de prueba");

echo "\nUsando todas las estrategias:\n";
$estrategias = [
    new SalidaConsola(),
    new SalidaJSON(),
    new SalidaTXT()
];

foreach ($estrategias as $estrategia) {
    $sistemaTemp = new SistemaMensajes($estrategia);
    $sistemaTemp->mostrarMensaje("Mensaje con diferentes formatos");
    echo "---\n";
}
?>
