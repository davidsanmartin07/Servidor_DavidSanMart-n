<?php
require_once 'Monoplaza.php';
require_once 'F4.php';

class FAcademy extends Monoplaza {
    private int $potenciaMaxima;

    public function __construct(string $nombre, string $nac, int $num, string $esc, int $puntos, int $potencia) {
        parent::__construct($nombre, $nac, $num, $esc, $puntos);
        $this->potenciaMaxima = $potencia;
    }

    public function getPotenciaMaxima(): int { return $this->potenciaMaxima; }

    public function posicionValida(int $posicion): bool {
        return $posicion >= 1 && $posicion <= 18;
    }

    public function otorgarPuntos(int $posicion, bool $vueltaRapida): void {
        if (!$this->posicionValida($posicion)) return;

        $puntos = [1=>18, 2=>15, 3=>12, 4=>10, 5=>8, 6=>6, 7=>4, 8=>2, 9=>1];

        if (isset($puntos[$posicion])) {
            $this->puntosTotales += $puntos[$posicion];
        }

        // Vuelta rápida: +1 si acaba entre los diez primeros (incluida la 10ª posición)
        if ($vueltaRapida && $posicion <= 10) {
            $this->puntosTotales += 1;
        }
    }

    public function subirCategoria(string $paisCategoria): F4 {
        return new F4($this->getNombre(), $this->getNacionalidad(), $this->getNumero(), $this->getEscuderia(), $this->getPuntos(), $paisCategoria);
    }
}
