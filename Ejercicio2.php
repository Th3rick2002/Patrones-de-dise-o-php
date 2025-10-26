<?php
interface ArchivoCompatible {
    public function abrir();
    public function guardar();
}

class ArchivoWindows7 {
    private $nombre;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
    }
    
    public function abrirWin7() {
        return "Abriendo archivo {$this->nombre} en formato Windows 7";
    }
    
    public function guardarWin7() {
        return "Guardando archivo {$this->nombre} en formato Windows 7";
    }
}

class Windows7Adapter implements ArchivoCompatible {
    private $archivoWin7;
    
    public function __construct(ArchivoWindows7 $archivoWin7) {
        $this->archivoWin7 = $archivoWin7;
    }
    
    public function abrir() {
        return $this->archivoWin7->abrirWin7() . " (adaptado para Windows 10)";
    }
    
    public function guardar() {
        return $this->archivoWin7->guardarWin7() . " (adaptado para Windows 10)";
    }
}

class Windows10 {
    public function procesarArchivo(ArchivoCompatible $archivo) {
        echo $archivo->abrir() . "\n";
        echo $archivo->guardar() . "\n";
    }
}

// Uso del Adapter
echo "\n=== EJERCICIO 2: PATRÓN ADAPTER ===\n";

$wordWin7 = new ArchivoWindows7("documento.docx");
$excelWin7 = new ArchivoWindows7("hoja_calculo.xlsx");

$adapterWord = new Windows7Adapter($wordWin7);
$adapterExcel = new Windows7Adapter($excelWin7);

$windows10 = new Windows10();

echo "Procesando Word:\n";
$windows10->procesarArchivo($adapterWord);

echo "Procesando Excel:\n";
$windows10->procesarArchivo($adapterExcel);
?>
