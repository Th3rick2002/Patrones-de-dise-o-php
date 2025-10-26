<?php
interface Personaje {
    public function atacar();
    public function getVelocidad();
}

class Esqueleto implements Personaje {
    public function atacar() {
        return "Esqueleto lanza una flecha!";
    }
    
    public function getVelocidad() {
        return 5;
    }
}

class Zombi implements Personaje {
    public function atacar() {
        return "Zombi muerde con fuerza!";
    }
    
    public function getVelocidad() {
        return 2;
    }
}

class PersonajeFactory {
    public static function crearPersonaje($nivel) {
        switch ($nivel) {
            case 'facil':
                return new Esqueleto();
            case 'dificil':
                return new Zombi();
            default:
                throw new Exception("Nivel no válido");
        }
    }
}


echo "=== EJERCICIO 1: PATRÓN FACTORY ===\n";

$personajeFacil = PersonajeFactory::crearPersonaje('facil');
echo "Nivel fácil: " . $personajeFacil->atacar() . " Velocidad: " . $personajeFacil->getVelocidad() . "\n";

$personajeDificil = PersonajeFactory::crearPersonaje('dificil');
echo "Nivel difícil: " . $personajeDificil->atacar() . " Velocidad: " . $personajeDificil->getVelocidad() . "\n";
?>
