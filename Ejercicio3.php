<?php
interface PersonajeConArma {
    public function getDescripcion();
    public function getAtaque();
}

class Guerrero implements PersonajeConArma {
    public function getDescripcion() {
        return "Guerrero";
    }
    
    public function getAtaque() {
        return 10;
    }
}

class Mago implements PersonajeConArma {
    public function getDescripcion() {
        return "Mago";
    }
    
    public function getAtaque() {
        return 8;
    }
}

abstract class ArmaDecorator implements PersonajeConArma {
    protected $personaje;
    
    public function __construct(PersonajeConArma $personaje) {
        $this->personaje = $personaje;
    }
    
    abstract public function getDescripcion();
    abstract public function getAtaque();
}

class Espada extends ArmaDecorator {
    public function getDescripcion() {
        return $this->personaje->getDescripcion() . " con Espada";
    }
    
    public function getAtaque() {
        return $this->personaje->getAtaque() + 15;
    }
}

class Arco extends ArmaDecorator {
    public function getDescripcion() {
        return $this->personaje->getDescripcion() . " con Arco";
    }
    
    public function getAtaque() {
        return $this->personaje->getAtaque() + 12;
    }
}

class VaritaMagica extends ArmaDecorator {
    public function getDescripcion() {
        return $this->personaje->getDescripcion() . " con Varita Mágica";
    }
    
    public function getAtaque() {
        return $this->personaje->getAtaque() + 20;
    }
}

echo "\n=== EJERCICIO 3: PATRÓN DECORATOR ===\n";

$guerrero = new Guerrero();
$mago = new Mago();

$guerreroConEspada = new Espada($guerrero);
echo $guerreroConEspada->getDescripcion() . " - Ataque: " . $guerreroConEspada->getAtaque() . "\n";

$guerreroConArco = new Arco($guerrero);
echo $guerreroConArco->getDescripcion() . " - Ataque: " . $guerreroConArco->getAtaque() . "\n";

$magoConVarita = new VaritaMagica($mago);
echo $magoConVarita->getDescripcion() . " - Ataque: " . $magoConVarita->getAtaque() . "\n";

$guerreroConEspadaYArco = new Arco(new Espada($guerrero));
echo $guerreroConEspadaYArco->getDescripcion() . " - Ataque: " . $guerreroConEspadaYArco->getAtaque() . "\n";
?>
